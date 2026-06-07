<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('rental_extensions', function (Blueprint $table) {
            // Menambahkan kolom order_id dan snap_token setelah kolom id
            $table->string('order_id')->nullable()->unique()->after('id');
            $table->string('snap_token')->nullable()->after('order_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rental_extensions', function (Blueprint $table) {
            // Menghapus kolom jika rollback dilakukan
            $table->dropColumn(['order_id', 'snap_token']);
        });
    }
};