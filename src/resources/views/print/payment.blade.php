<!DOCTYPE html>
<html>
<head>
    <title>Struk Pembayaran</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .struk { border: 1px solid #ccc; padding: 20px; width: 320px; }
        h2 { text-align: center; }
        p, li { margin: 5px 0; font-size: 14px; }
        ul { padding-left: 20px; margin-top: 5px; }
        .qr { text-align: center; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="struk">
        <h2>Struk Pembayaran</h2>

        <p><strong>Nama Pelanggan:</strong> {{ $payment->order->customer_name }}</p>
        <p><strong>Tanggal Bayar:</strong> {{ $payment->paid_at }}</p>
        <p><strong>Status:</strong> {{ ucfirst($payment->status) }}</p>
        <p><strong>Metode Pembayaran:</strong> {{ $payment->payment_method }}</p>

        <hr>

        @if($payment->payment_method === 'BCA')
            <p><strong>Nomor Rekening:</strong></p>
            <p>1234567890 (a.n. Toko Sepatu Online)</p>

            <p><strong>Total Bayar:</strong> Rp {{ number_format($payment->order->total, 0, ',', '.') }}</p>

            @if($payment->proof_of_payment)
                <p><strong>Bukti Transfer:</strong></p>
                <img src="{{ asset('storage/' . $payment->proof_of_payment) }}" style="width: 100px">
            @endif

        @elseif($payment->payment_method === 'QRIS')
            <p><strong>Total Bayar:</strong> Rp {{ number_format($payment->order->total, 0, ',', '.') }}</p>

            <p><strong>Scan QR untuk Pembayaran:</strong></p>
            <div class="qr">
                @if($payment->proof_of_payment)
                    {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(150)->generate($payment->proof_of_payment) !!}
                @else
                    {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(150)->generate('https://qris.id/transaksi/' . $payment->id) !!}
                @endif
            </div>

        @elseif($payment->payment_method === 'COD')
            <p><strong>Detail Pesanan:</strong></p>
            <ul>
                @foreach ($payment->order->items as $item)
                    <li>{{ $item->shoe->name }} (x{{ $item->quantity }})</li>
                @endforeach
            </ul>
            <p><strong>Total Bayar:</strong> Rp {{ number_format($payment->order->total, 0, ',', '.') }}</p>
        @endif

        <hr>
        <p style="text-align: center;">Terima kasih telah berbelanja!</p>
    </div>
</body>
</html>
