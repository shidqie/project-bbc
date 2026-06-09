<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('kasir','dapur','manager','pemilik','pelayan') NOT NULL DEFAULT 'kasir'");
    }

    public function down(): void
    {
        // Hapus user pelayan dulu sebelum rollback enum
        DB::table('users')->where('role', 'pelayan')->delete();
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('kasir','dapur','manager','pemilik') NOT NULL DEFAULT 'kasir'");
    }
};
