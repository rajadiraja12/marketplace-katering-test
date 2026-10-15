<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { 
            font-family: sans-serif; 
            font-size: 12px; }
        .header { 
            text-align: center; 
            margin-bottom: 20px; }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 10px; }
        th, td { 
            border: 1px solid #ccc; 
            padding: 6px; }
        .total { 
            text-align: right; 
            font-weight: bold; 
        }
        @media print {
            .no-print { 
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>INVOICE</h2>
        <p>No: {{ $order->invoice_number }}</p>
    </div>

    <table>
        <tr>
            <td><b>Merchant</b></td>
            <td>{{ $order->merchant->company_name }}</td>
        </tr>
        <tr>
            <td><b>Customer</b></td>
            <td>{{ $order->customer->name }}</td>
        </tr>
        <tr>
            <td><b>Tanggal Kirim</b></td>
            <td>{{ $order->delivery_date }}</td>
        </tr>
        <tr>
            <td><b>Status</b></td>
            <td>{{ $order->status }}</td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th>Menu</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->menu->name }}</td>
                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="total">Total: Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
    <center>
        <button class="bg-blue-800 py-2 px-2 rounded text-white" onclick="window.print()" class="no-print">Print</button>
    </center>
</body>
</html>