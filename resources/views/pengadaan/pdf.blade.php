<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pembelian — PO-{{ str_pad($pengadaan->id,4,'0',STR_PAD_LEFT) }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 12px; color: #111; padding: 32px; }
        .header { text-align: center; margin-bottom: 24px; border-bottom: 2px solid #111; padding-bottom: 16px; }
        .header h1 { font-size: 18px; font-weight: 700; margin-bottom: 4px; }
        .header p { font-size: 11px; color: #666; }
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 20px; }
        .info-box p { font-size: 11px; color: #999; margin-bottom: 2px; }
        .info-box span { font-size: 13px; font-weight: 600; color: #111; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { text-align: left; padding: 8px 10px; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .05em; color: #999; border-bottom: 1px solid #E5E5E5; background: #FAFAFA; }
        td { padding: 9px 10px; font-size: 12px; border-bottom: 1px solid #F5F5F5; }
        .total-row td { font-weight: 700; font-size: 13px; border-top: 2px solid #111; border-bottom: none; padding-top: 12px; }
        .footer { margin-top: 40px; display: grid; grid-template-columns: 1fr 1fr; gap: 40px; }
        .sign-box { text-align: center; }
        .sign-box p { font-size: 11px; color: #666; margin-bottom: 48px; }
        .sign-line { border-top: 1px solid #111; padding-top: 6px; font-size: 12px; font-weight: 600; }
    </style>
</head>
<body>
    <div class="header">
        <h1>WARUNG BBC</h1>
        <p>DAFTAR PEMBELIAN / PURCHASE ORDER</p>
    </div>

    <div class="info-grid">
        <div class="info-box">
            <p>No. PO</p>
            <span>PO-{{ str_pad($pengadaan->id,4,'0',STR_PAD_LEFT) }}</span>
        </div>
        <div class="info-box">
            <p>Tanggal</p>
            <span>{{ \Carbon\Carbon::parse($pengadaan->tanggal ?? $pengadaan->created_at)->format('d F Y') }}</span>
        </div>
        <div class="info-box">
            <p>Supplier</p>
            <span>{{ $pengadaan->supplier->nama ?? '-' }}</span>
        </div>
        <div class="info-box">
            <p>Status</p>
            <span>{{ ucfirst($pengadaan->status) }}</span>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width:32px;">No</th>
                <th>Bahan Baku</th>
                <th>Satuan</th>
                <th style="text-align:right;">Qty</th>
                <th style="text-align:right;">Harga Satuan</th>
                <th style="text-align:right;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengadaan->detail as $i => $d)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $d->bahanBaku->nama ?? '-' }}</td>
                <td>{{ $d->bahanBaku->satuan ?? '-' }}</td>
                <td style="text-align:right;">{{ $d->qty }}</td>
                <td style="text-align:right;">Rp {{ number_format($d->harga_satuan,0,',','.') }}</td>
                <td style="text-align:right;">Rp {{ number_format($d->subtotal,0,',','.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="5">TOTAL</td>
                <td style="text-align:right;">Rp {{ number_format($pengadaan->detail->sum('subtotal'),0,',','.') }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <div class="sign-box">
            <p>Dibuat oleh</p>
            <div class="sign-line">{{ $pengadaan->user->name ?? 'Admin' }}</div>
        </div>
        <div class="sign-box">
            <p>Disetujui oleh</p>
            <div class="sign-line">Pemilik</div>
        </div>
    </div>
</body>
</html>
