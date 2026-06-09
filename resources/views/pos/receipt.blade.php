<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran #{{ $transaksi->id }}</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            background-color: #f3f4f6;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
        }
        .receipt-card {
            background-color: #fff;
            width: 300px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .font-bold { font-weight: bold; }
        .mb-2 { margin-bottom: 8px; }
        .mt-4 { margin-top: 16px; }
        .dashed-line {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }
        .item-row {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
        }
        .flex { display: flex; }
        .justify-between { justify-content: space-between; }
        
        @media print {
            body {
                background-color: transparent;
                padding: 0;
            }
            .receipt-card {
                box-shadow: none;
                width: 100%;
                max-width: 300px;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>

    <div class="receipt-card">
        <div class="text-center mb-2">
            <h2 style="margin:0; font-family: 'Google Sans', sans-serif;">WARUNG BBC</h2>
            <p style="margin:5px 0 0 0; font-size:12px;">Jl. Raya Kuliner No. 123</p>
            <p style="margin:0; font-size:12px;">Telp: 0812-3456-7890</p>
        </div>

        <div class="dashed-line"></div>

        <div style="font-size:12px; margin-bottom: 10px;">
            <div class="flex justify-between">
                <span>Waktu:</span>
                <span>{{ $transaksi->created_at->format('d/m/Y H:i') }}</span>
            </div>
            <div class="flex justify-between">
                <span>Meja:</span>
                <span>{{ $transaksi->meja ? $transaksi->meja->nomor : '-' }}</span>
            </div>
            <div class="flex justify-between">
                <span>Kasir:</span>
                <span>{{ $transaksi->user->name }}</span>
            </div>
            <div class="flex justify-between">
                <span>ID TRX:</span>
                <span>#{{ str_pad($transaksi->id, 5, '0', STR_PAD_LEFT) }}</span>
            </div>
        </div>

        <div class="dashed-line"></div>

        <div style="margin-bottom:10px;">
            @foreach($transaksi->detail as $item)
            <div style="font-size:12px; margin-bottom: 5px;">
                <div class="font-bold">{{ $item->menu->nama }}</div>
                <div class="item-row">
                    <span>{{ $item->qty }} x {{ number_format($item->harga_satuan, 0, ',', '.') }}</span>
                    <span>{{ number_format($item->subtotal, 0, ',', '.') }}</span>
                </div>
            </div>
            @endforeach
        </div>

        <div class="dashed-line"></div>

        <div style="font-size:14px; margin-bottom: 10px;">
            <div class="flex justify-between font-bold">
                <span>TOTAL:</span>
                <span>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
            </div>
            @if($transaksi->pembayaran->count() > 0)
                @php $bayar = $transaksi->pembayaran->first(); @endphp
                <div class="flex justify-between mt-4 text-sm" style="font-size:12px;">
                    <span>Bayar ({{ ucfirst($bayar->metode) }}):</span>
                    <span>Rp {{ number_format($bayar->jumlah_bayar, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between" style="font-size:12px;">
                    <span>Kembali:</span>
                    <span>Rp {{ number_format($bayar->kembalian, 0, ',', '.') }}</span>
                </div>
            @endif
        </div>

        <div class="dashed-line"></div>

        <div class="text-center mt-4" style="font-size:12px;">
            <p>Terima Kasih Atas Kunjungan Anda!</p>
            <p>-- Lunas --</p>
        </div>

        <div class="text-center mt-4 no-print">
            <button onclick="window.print()" style="padding: 10px 20px; background-color: #3B82F6; color: white; border: none; border-radius: 4px; cursor: pointer; font-family: 'Google Sans', sans-serif;">
                🖨️ Cetak Struk
            </button>
            <br><br>
            <a href="{{ route('pos.index') }}" style="color: #6B7280; text-decoration: none; font-family: 'Google Sans', sans-serif;">Kembali ke Kasir</a>
        </div>
    </div>

</body>
</html>
