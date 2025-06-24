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
        Schema::create('permintaans', function (Blueprint $table) {
            $table->id();
            $table->string('id_permintaan')->unique();
            $table->dateTime('tanggal_permintaan');
            $table->string('issued_by'); // issued_by refers to the user who made the request
            $table->string('id_barang');
            $table->string('jumlah_permintaan');
            $table->string('status_permintaan')->default('pending'); // pending, approved
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaans');
    }
};
