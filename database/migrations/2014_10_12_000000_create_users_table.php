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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('kode_satker')->nullable();
            $table->string('satker')->nullable();
            $table->string('nip')->nullable();
            $table->string('nama_pegawai')->nullable();
            $table->string('id_satker')->nullable();
            $table->string('jenis_satker')->nullable();
            $table->string('fullname')->nullable();
            $table->unsignedBigInteger('tipe_id')->nullable();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
