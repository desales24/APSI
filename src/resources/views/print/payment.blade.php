<!DOCTYPE html>
<html>
<head>
    <title>Struk Pembayaran</title>
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background-color: #f5f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .struk { 
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 380px;
            max-width: 100%;
            position: relative;
            overflow: hidden;
        }
        .struk::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 8px;
            background: linear-gradient(90deg, #4f46e5, #10b981);
        }
        h2 { 
            text-align: center; 
            color: #1f2937;
            margin-bottom: 25px;
            font-weight: 600;
            position: relative;
            padding-bottom: 10px;
        }
        h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, #4f46e5, #10b981);
            border-radius: 3px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
        }
        .info-label {
            font-weight: 600;
            color: #4b5563;
            flex: 1;
        }
        .info-value {
            font-weight: 500;
            color: #1f2937;
            flex: 1;
            text-align: right;
        }
        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #e5e7eb, transparent);
            margin: 20px 0;
            border: none;
        }
        .payment-method {
            background-color: #f3f4f6;
            padding: 12px 15px;
            border-radius: 8px;
            margin: 15px 0;
        }
        .payment-method-title {
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .payment-method-icon {
            width: 20px;
            height: 20px;
        }
        .qr-container {
            background: white;
            padding: 15px;
            border-radius: 8px;
            border: 1px dashed #d1d5db;
            margin: 15px auto;
            display: inline-block;
        }
        .proof-image {
            max-width: 100%;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            margin-top: 10px;
        }
        .thank-you {
            text-align: center;
            font-weight: 600;
            color: #4f46e5;
            margin-top: 20px;
            font-size: 15px;
        }
        .items-list {
            list-style-type: none;
            padding: 0;
            margin: 15px 0;
        }
        .items-list li {
            padding: 8px 0;
            border-bottom: 1px solid #f3f4f6;
            display: flex;
            justify-content: space-between;
        }
        .items-list li:last-child {
            border-bottom: none;
        }
        .total-amount {
            font-size: 18px;
            font-weight: 700;
            color: #1f2937;
            text-align: right;
            margin-top: 15px;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .status-paid {
            background-color: #d1fae5;
            color: #065f46;
        }
        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }
    </style>
</head>
<body>
    <div class="struk">
        <h2>Struk Pembayaran</h2>

        <div class="info-row">
            <span class="info-label">Nama Pelanggan:</span>
            <span class="info-value">{{ $payment->order->customer_name }}</span>
        </div>
        
        <div class="info-row">
            <span class="info-label">Tanggal Bayar:</span>
            <span class="info-value">{{ $payment->paid_at }}</span>
        </div>
        
        <div class="info-row">
            <span class="info-label">Status:</span>
            <span class="info-value">
                <span class="status-badge status-{{ strtolower($payment->status) }}">
                    {{ ucfirst($payment->status) }}
                </span>
            </span>
        </div>

        <hr class="divider">

        <div class="payment-method">
            <div class="payment-method-title">
                @if($payment->payment_method === 'BCA')
                <svg class="payment-method-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 5H19C20.1046 5 21 5.89543 21 7V17C21 18.1046 20.1046 19 19 19H5C3.89543 19 3 18.1046 3 17V7C3 5.89543 3.89543 5 5 5Z" stroke="#1D4ED8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke="#1D4ED8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Transfer Bank BCA
                @elseif($payment->payment_method === 'QRIS')
                <svg class="payment-method-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 17V7C3 5.89543 3.89543 5 5 5H9M3 17C3 18.1046 3.89543 19 5 19H9M3 17V17C3 17 6 17 9 17M9 17H13M9 17V13M9 5H13M9 5V9M13 5H19C20.1046 5 21 5.89543 21 7V13M13 5V9M13 19H19C20.1046 19 21 18.1046 21 17V13M13 19V15M21 13H17M17 13V9M17 13H13M13 13V15M13 9H17" stroke="#10B981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                QRIS
                @elseif($payment->payment_method === 'COD')
                <svg class="payment-method-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8 13V17M16 13V17M3 3H21L19 12H5L3 3ZM3 3L2 8M21 3L22 8M18 23L20 21M20 21L22 23M20 21L18 19M6 23L4 21M4 21L2 23M4 21L6 19" stroke="#EF4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Cash on Delivery
                @endif
            </div>
            
            @if($payment->payment_method === 'BCA')
                <div class="info-row">
                    <span class="info-label">Nomor Rekening:</span>
                    <span class="info-value">1234567890</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Atas Nama:</span>
                    <span class="info-value">Toko Sepatu Online</span>
                </div>

                <div class="total-amount">
                    Rp {{ number_format($payment->order->total, 0, ',', '.') }}
                </div>

                @if($payment->proof_of_payment)
                    <div style="margin-top: 15px;">
                        <div style="font-weight: 500; color: #4b5563; margin-bottom: 5px;">Bukti Transfer:</div>
                        <img src="{{ asset('storage/' . $payment->proof_of_payment) }}" class="proof-image">
                    </div>
                @endif

            @elseif($payment->payment_method === 'QRIS')
                <div class="total-amount">
                    Rp {{ number_format($payment->order->total, 0, ',', '.') }}
                </div>

                <div style="text-align: center; margin-top: 20px;">
                    <div style="font-weight: 500; color: #4b5563; margin-bottom: 10px;">Scan QR untuk Pembayaran:</div>
                    <div class="qr-container">
                        @if($payment->proof_of_payment)
                            {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(180)->generate($payment->proof_of_payment) !!}
                        @else
                            {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(180)->generate('https://qris.id/transaksi/' . $payment->id) !!}
                        @endif
                    </div>
                    <div style="font-size: 12px; color: #6b7280; margin-top: 10px;">
                        Berlaku hingga 24 jam setelah transaksi
                    </div>
                </div>

            @elseif($payment->payment_method === 'COD')
                <div style="margin-top: 15px;">
                    <div style="font-weight: 500; color: #4b5563; margin-bottom: 5px;">Detail Pesanan:</div>
                    <ul class="items-list">
                        @foreach ($payment->order->items as $item)
                            <li>
                                <span>{{ $item->shoe->name }}</span>
                                <span>x{{ $item->quantity }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="total-amount">
                    Rp {{ number_format($payment->order->total, 0, ',', '.') }}
                </div>
            @endif
        </div>

        <hr class="divider">

        <div class="thank-you">
            Terima kasih telah berbelanja di Toko Sepatu Online!
        </div>
    </div>
</body>
</html>