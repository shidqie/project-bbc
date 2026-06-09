<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Fix pesanan_caterings status enum
        DB::statement("ALTER TABLE pesanan_caterings MODIFY COLUMN status 
            ENUM('menunggu_konfirmasi','terkonfirmasi','diproduksi','dikirim','selesai','dibatalkan') 
            NOT NULL DEFAULT 'menunggu_konfirmasi'");

        // Fix pesanan_nasiboxes status enum
        DB::statement("ALTER TABLE pesanan_nasiboxes MODIFY COLUMN status 
            ENUM('diproses','dikirim','selesai','dibatalkan') 
            NOT NULL DEFAULT 'diproses'");

        // Migrate existing data to new status values
        DB::statement("UPDATE pesanan_caterings SET status = 'menunggu_konfirmasi' WHERE status NOT IN ('menunggu_konfirmasi','terkonfirmasi','diproduksi','dikirim','selesai','dibatalkan')");
        DB::statement("UPDATE pesanan_nasiboxes SET status = 'diproses' WHERE status NOT IN ('diproses','dikirim','selesai','dibatalkan')");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE pesanan_caterings MODIFY COLUMN status 
            ENUM('pending','proses','selesai','dibatalkan') NOT NULL DEFAULT 'pending'");
        DB::statement("ALTER TABLE pesanan_nasiboxes MODIFY COLUMN status 
            ENUM('pending','proses','selesai','dibatalkan') NOT NULL DEFAULT 'pending'");
    }
};
