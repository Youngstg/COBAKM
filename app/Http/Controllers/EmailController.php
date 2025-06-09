<?php

namespace App\Http\Controllers;

use App\Mail\SendEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'content.nama_pelanggan' => 'required|string|max:255',
            'content.id_pembelian' => 'required|string|max:255',
            'content.barang' => 'required|array|min:1',
            'content.barang.*.nama' => 'required|string|max:255',
            'content.barang.*.kuantitas' => 'required|integer|min:1',
            'content.barang.*.harga' => 'required|numeric|min:0',
            'content.subtotal' => 'required|numeric|min:0',
            'content.biaya_administrasi' => 'required|numeric|min:0',
            'content.total' => 'required|numeric|min:0',
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validatedData->errors(),
            ], 422); // HTTP status code 422: Unprocessable Entity
        }

        $email = $request->email;
        $subject = $request->subject;
        $content = $request->content;

        Mail::to($email)->send(new SendEmailNotification($subject, $content));

        return response()->json(['message' => 'Emails sent successfully']);
    }
}
