<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Sesuaikan nama tabel jika berbeda
        Schema::dropIfExists('cancellation_policies'); 
    }

    public function down(): void
    {
        // Jika Anda ingin bisa me-rollback dan mengembalikan tabelnya
        Schema::create('cancellation_policies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained()->cascadeOnDelete();
            $table->integer('days_before');
            $table->integer('refund_percentage');
            $table->timestamps();
        });
    }
};