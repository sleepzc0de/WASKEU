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
        Schema::create('t_pemantauan_penggunaan', function (Blueprint $table) {
            $table->id();
            $table->string('tahun')->nullable()->default('KOSONG');
            $table->string('periode')->nullable()->default('KOSONG');
            $table->string('jenis_pemantauan')->nullable()->default('KOSONG');
            $table->string('role')->nullable()->default('KOSONG');
            $table->string('ue1')->nullable()->default('KOSONG');
            $table->string('nama_satker')->nullable()->default('KOSONG');
            $table->string('kode_satker')->nullable()->default('KOSONG');
            $table->string('nama_anak_satker')->nullable()->default('KOSONG');
            $table->string('kode_anak_satker')->nullable()->default('KOSONG');
            $table->string('jenis_barang')->nullable()->default('KOSONG');
            $table->string('nama_barang')->nullable()->default('KOSONG');
            $table->string('kode_barang')->nullable()->default('KOSONG');
            $table->string('nup')->nullable()->default('KOSONG');
            $table->float('nilai_buku')->nullable()->default('KOSONG');
            $table->string('status_psp')->nullable()->default('KOSONG');
            $table->string('no_psp')->nullable()->default('KOSONG');
            $table->date('tgl_psp')->nullable();
            $table->text('ket_psp')->nullable()->default('KOSONG');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_pemantauan_penggunaan');
    }
};
