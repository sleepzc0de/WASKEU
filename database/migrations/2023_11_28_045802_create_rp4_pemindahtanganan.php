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
        Schema::create('rp4_pemindahtanganan', function (Blueprint $table) {
            $table->id();
            $table->string('rp4_uniq')->nullable();
            $table->string('rp4_tahun_rencana')->nullable();
            $table->string('rp4_no')->nullable();
            $table->string('rp4_kode_satker')->nullable();
            $table->string('rp4_nama_satker')->nullable();
            $table->string('rp4_kode_barang')->nullable();
            $table->string('rp4_uraian_barang')->nullable();
            $table->string('rp4_nup')->nullable();
            $table->string('rp4_identitas_barang')->nullable();
            $table->string('rp4_tahun_perolehan')->nullable();
            $table->float('rp4_luas_tanah_bangunan')->nullable();
            $table->bigInteger('rp4_jumlah_barang')->nullable();
            $table->float('rp4_nilai_perolehan')->nullable();
            $table->string('rp4_bentuk_pemindahtanganan')->nullable();
            $table->text('rp4_alasan_rencana_pemindahtanganan')->nullable();
            $table->text('rp4_ket')->nullable();
            $table->string('rp4_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rp4_pemindahtanganan');
    }
};
