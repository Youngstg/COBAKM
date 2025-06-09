<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentResource;
use App\Http\Resources\TransaksiResource;
use App\Mail\SendEmailNotification;
use App\Models\ItemTransaksi;
use App\Models\Payment;
use App\Models\Transaksi;
use App\Models\VarianProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Session::has("unique_user_id")) {
                Session::put("unique_user_id", Str::uuid()->toString());
            }
            return $next($request);
        });
    }

    private function getCartKey()
    {
        return "cart_" . Session::get("unique_user_id");
    }
    public function getTransactions()
    {
        return TransaksiResource::collection(Transaksi::all());
    }

    public function getTransactionDetail($id)
    {
        return new TransaksiResource(Transaksi::findOrFail($id));
    }

    public function getPayments()
    {
        return PaymentResource::collection(Payment::all());
    }

    public function getPaymentDetail($id)
    {
        return Payment::findOrFail($id);
    }

    public function createTransaction(Request $req)
    {
        $cartKey = $this->getCartKey();
        $cartItems = Session::get($cartKey, []);
        $updatedCartItems = [];
        $total_harga = 0;

        foreach ($cartItems as $id => $item) {
            // Ensure all necessary keys are present in the item, with default values if missing
            $item = array_merge(
                [
                    "product_id" => null,
                    "variant_id" => null,
                    "name" => "",
                    "photo_url" => null,
                    "price" => 0,
                    "quantity" => 0,
                    "variant" => "",
                    "ukuran" => "",
                    "max_stock" => 99,
                ],
                $item
            );
            $total_harga += $item["price"] * $item["quantity"];
            array_push($updatedCartItems, $item);
        }

        $transaksi = Transaksi::create([
            "nama" => $req->nama,
            "no_wa" => $req->no_wa,
            "email" => $req->email,
            "total_harga" => $total_harga,
            "status_barang" => "menunggu_pembayaran",
        ]);

        foreach ($updatedCartItems as $produk) {
            ItemTransaksi::create([
                "harga_satuan" => $produk["price"],
                "jumlah" => $produk["quantity"],
                "produk_id" => $produk["product_id"],
                "varian_produk_id" => $produk["variant_id"],
                "transaksi_id" => $transaksi->id,
            ]);
            VarianProduk::where("id", $produk["variant_id"])->decrement(
                "stok",
                $produk["quantity"]
            );
        }

        $payment = $this->createPayment(
            $transaksi->id,
            $total_harga,
            $req->nama,
            $req->no_wa,
            $req->email
        );

        if ($payment["redirect_url"]) {
            return redirect($payment["redirect_url"]);
        }

        return response(
            [
                "message" => "something went wrong!",
            ],
            500
        );
    }

    public function createPayment($id, $total_harga, $nama, $no_wa, $email)
    {
        $this->initPaymentGateway();
        $params = [
            "transaction_details" => [
                "order_id" => $id,
                "gross_amount" => $total_harga,
            ],
            "customer_details" => [
                "first_name" => $nama,
                "phone" => $no_wa,
                "email" => $email,
            ],
            "enabled_payments" => ["other_qris"],
            "callbacks" => [
                "finish" => route("ecommerce.payment.updatePayment"),
                "error" => route("ecommerce.cart"),
                "close" => route("ecommerce.cart"),
            ],
            "expiry" => [
                "unit" => "minutes",
                "duration" => 60,
            ],
        ];
        $snap = \Midtrans\Snap::createTransaction($params);

        Payment::create([
            "total_harga" => $total_harga,
            "transaksi_id" => $id,
            "metode_pembayaran" => "qris",
            "status_pembayaran" => "belum_dibayar",
            "redirect_url" => $snap->redirect_url,
            "token" => $snap->token,
        ]);

        return [
            "redirect_url" => $snap->redirect_url,
            "token" => $snap->token,
        ];
    }

    public function updatePayment(Request $req)
    {
        $this->initPaymentGateway();
        $response = \Midtrans\Transaction::status($req->order_id);
        $status = $response->{'transaction_status'};
        if ($status == "settlement" || $status == "capture") {
            Payment::where("transaksi_id", $req->order_id)->update([
                "status_pembayaran" => "dibayar",
            ]);
            Transaksi::where("id", $req->order_id)->update([
                "status_barang" => "diproses",
            ]);

            $cartKey = $this->getCartKey();
            Session::forget($cartKey);

            if (is_null(Session::get("order"))) {
                Session::push("order", $req->order_id);
            }
            $transaksi = Transaksi::where("id", $req->order_id)
                ->with(["daftar_produk" => ["produk", "varian_produk"]])
                ->first();
            $subject = "Konfirmasi Pembelian Anda";
            $barang = [];
            foreach ($transaksi["daftar_produk"] as $key => $value) {
                array_push($barang, [
                    "nama" => $value->produk->nama_produk,
                    "varian" => $value->varian_produk->nama_varian,
                    "ukuran" => $value->varian_produk->ukuran,
                    "kuantitas" => $value->jumlah,
                    "harga" => $value->harga_satuan,
                ]);
            }
            $admin = 0;
            $content = [
                "nama_pelanggan" => $transaksi->nama,
                "id_pembelian" => $transaksi->id,
                "barang" => $barang,
                "subtotal" => $transaksi->total_harga - $admin,
                "biaya_administrasi" => $admin,
                "total" => $transaksi->total_harga,
            ];

            $email = $transaksi->email;
            Mail::to($email)->send(
                new SendEmailNotification($subject, $content)
            );

            return redirect(route("ecommerce.order"));
        }
        if ($status == "pending") {
            return response(
                [
                    "message" => "Menunggu pembayaran",
                    "status" => "belum_dibayar",
                ],
                200
            );
        }
        if (
            $status == "cancel" ||
            $status == "expire" ||
            $status == "failure"
        ) {
            Payment::where("transaksi_id", $req->order_id)->update([
                "status_pembayaran" => "kadaluarsa",
            ]);

            return response(
                [
                    "message" => "Pembayaran Kadaluarsa",
                    "status" => "kadaluarsa",
                ],
                200
            );
        }

        return response("Something went wrong!", 403);
    }
}
