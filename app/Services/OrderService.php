<?php

namespace App\Services;

use App\Models\Transaksi;

class OrderService
{
    public function getOrders($savedOrderIds)
    {
        return Transaksi::whereIn('id', $savedOrderIds)
            ->with(['payment', 'daftar_produk' => ['produk', 'varian_produk']])
            ->get()
            ->map([$this, 'formatTransaction']);
    }

    public function getOrderById($id)
    {
        $transaction = Transaksi::with(['payment', 'daftar_produk' => ['produk', 'varian_produk']])
            ->find($id);

        return $transaction ? $this->formatTransaction($transaction) : null;
    }

    public function formatTransaction($transaction)
    {
        return [
            'id' => $transaction->id,
            'name' => $this->maskName($transaction->nama),
            'no_wa' => $this->maskPhoneNumber($transaction->no_wa),
            'email' => $this->maskEmail($transaction->email),
            'total_harga' => $transaction->total_harga,
            'payment' => $transaction->payment,
            'daftar_produk' => $transaction->daftar_produk,
        ];
    }

    private function maskName($name)
    {
        $parts = explode(' ', $name);
        $maskedParts = array_map(function ($part) {
            return substr($part, 0, 1).str_repeat('*', strlen($part) - 1);
        }, $parts);

        return implode(' ', $maskedParts);
    }

    private function maskPhoneNumber($number)
    {
        return substr($number, 0, 4).str_repeat('*', strlen($number) - 8).substr($number, -4);
    }

    private function maskEmail($email)
    {
        $parts = explode('@', $email);
        $name = $parts[0];
        $domain = $parts[1];
        $maskedName = substr($name, 0, 3).str_repeat('*', strlen($name) - 3);

        return $maskedName.'@'.$domain;
    }
}
