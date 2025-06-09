<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembelian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .header {
            background-color: #022f40;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }

        .content {
            padding: 20px;
        }

        .content h2 {
            color: #38a9cc;
            margin-bottom: 10px;
        }

        .content table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .content table,
        .content th,
        .content td {
            border: 1px solid #dddddd;
        }

        .content th,
        .content td {
            padding: 12px;
            text-align: left;
        }

        .content th {
            background-color: #f4f4f4;
        }

        .content .summary {
            font-size: 18px;
            font-weight: bold;
            text-align: right;
        }

        .content .contact {
            margin-top: 20px;
        }

        .content .contact p {
            margin: 5px 0;
        }

        .footer {
            background-color: #022f40;
            color: #ffffff;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Terima Kasih atas Pembelian Anda!</h1>
        </div>
        <div class="content">
            <div style="display: flex; ">
                <div style="width: 70%;">
                    <p>Halo {{ $content['nama_pelanggan'] }},</p>
                    <p>Terima kasih telah berbelanja di toko kami. Berikut adalah ringkasan pesanan Anda:</p>
                </div>
                <div style="width: 30%; display: flex;">
                    <img style="margin: auto;" src="{{$message->embed('assets/images/logo/GASENDRA-comp.png')}}"
                        alt="Logo Kabinet Gasendra" />
                </div>
            </div>
            <h2>Ringkasan Pesanan</h2>
            <p><strong>ID Pembelian/Invoice:</strong> {{ $content['id_pembelian'] }}</p>
            <table>
                <thead>
                    <tr>
                        <th>Barang</th>
                        <th>Varian</th>
                        <th>Ukuran</th>
                        <th>Kuantitas</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($content['barang'] as $item)
                        <tr>
                            <td>{{ $item['nama'] }}</td>
                            <td>{{ $item['varian'] }}</td>
                            <td>{{ $item['ukuran'] }}</td>
                            <td>{{ $item['kuantitas'] }}</td>
                            <td>Rp{{ number_format($item['harga'], 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="summary">
                <p>Subtotal: Rp{{ number_format($content['subtotal'], 0, ',', '.') }}</p>
                <p>Biaya Administrasi: Rp{{ number_format($content['biaya_administrasi'], 0, ',', '.') }}</p>
                <p><strong>Total: Rp{{ number_format($content['total'], 0, ',', '.') }}</strong></p>
            </div>
            <div class="contact">
                <h2>Hubungi Kami</h2>
                <p>Silahkan hubungi contact person dibawah untuk konfirmasi pesanan anda, hubungi kami di:</p>
                <p>Email: ekraf.kmitera24@gmail.com</p>
                <p>Nomor WA 1: <a href="https://wa.me/+6281997006039">081997006039</a></p>
                <p>Nomor WA 2: <a href="https://wa.me/+6285658742390">085658742390</a></p>
            </div>
        </div>
        <div class="footer">
            <p>&copy; 2024 Ekonomi Kreatif Kabinet Gasendra.</p>
        </div>
    </div>
</body>

</html>