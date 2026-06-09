<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pesanan_caterings', function (Blueprint $table) {
            $table->text('catatan')->nullable()->after('total_harga');
        });

        Schema::table('pesanan_nasiboxes', function (Blueprint $table) {
            $table->text('catatan')->nullable()->after('total_harga');
        });
    }

    public function down(): void
    {
        Schema::table('pesanan_caterings', function (Blueprint $table) {
            $table->dropColumn('catatan');
        });

        Schema::table('pesanan_nasiboxes', function (Blueprint $table) {
            $table->dropColumn('catatan');
        });
    }
};
