{{-- Partial reusable filter --}}
@props(['route','startDate','endDate'])
<div class="card" style="padding:16px 20px;margin-bottom:20px;">
    <form method="GET" action="{{ route($route) }}" style="display:flex;gap:12px;align-items:flex-end;flex-wrap:wrap;">
        <div>
            <label style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:#999;display:block;margin-bottom:4px;">Dari</label>
            <input type="date" name="start_date" value="{{ $startDate }}" style="font-size:13px;border:1px solid #E5E5E5;border-radius:8px;padding:7px 11px;">
        </div>
        <div>
            <label style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:#999;display:block;margin-bottom:4px;">Sampai</label>
            <input type="date" name="end_date" value="{{ $endDate }}" style="font-size:13px;border:1px solid #E5E5E5;border-radius:8px;padding:7px 11px;">
        </div>
        <button type="submit" class="btn-primary" style="font-size:12px;padding:8px 16px;">Filter</button>
        <button type="button" onclick="window.print()" class="btn-ghost" style="font-size:12px;padding:8px 16px;">Cetak</button>
    </form>
</div>
