<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $order->id }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            line-height: 1.5;
            color: #333;
        }
        .container {
            padding: 20px;
        }
        h2 {
            color: #000000;
            margin-bottom: 20px;
        }
        .info {
            margin-bottom: 30px;
        }
        .info p {
            margin: 2px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f1f1f1;
        }
        .total {
            text-align: right;
            font-weight: bold;
        }
        .badge {
            padding: 5px 10px;
            border-radius: 4px;
            color: white;
            font-size: 12px;
        }
        .bg-success {
            background-color: #198754;
        }
        .bg-secondary {
            background-color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Invoice Pembayaran</h2>

        <div class="info">
            <p><strong>ID Order:</strong> #{{ $order->id }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ $order->payment_method ?? 'Transfer Bank' }}</p>
            <p><strong>Tanggal Cetak:</strong> {{ $order->created_at->format('d M Y') }}</p>
            <p><strong>Jatuh Tempo:</strong> -</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td>Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                </tr>
                @endforeach
                <tr>
                    <td class="total">Total</td>
                    <td><strong>Rp{{ number_format($order->total, 0, ',', '.') }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
