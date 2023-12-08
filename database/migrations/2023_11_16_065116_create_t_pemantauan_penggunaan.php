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
            $table->string('unik')->nullable()->default('KOSONG');
            $table->boolean('isGenerated')->nullable()->default(false);
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
            $table->float('nilai_buku')->nullable()->default(0);
            $table->string('status_psp')->nullable()->default('KOSONG');
            $table->string('nomor_psp')->nullable()->default('KOSONG');
            $table->date('tanggal_psp')->nullable();
            $table->text('ket_psp')->nullable()->default('KOSONG');
            $table->string('status_sesuai_Form1')->nullable()->default('KOSONG');
            $table->string('kesesuaian_psp')->nullable()->default('KOSONG');
            $table->string('digunakan_sebagai')->nullable()->default('KOSONG');
            $table->string('rencana_alih_fungsi')->nullable()->default('KOSONG');
            $table->string('status_sesuai_Form2')->nullable()->default('KOSONG');
            $table->string('status_penggunaan')->nullable()->default('KOSONG');
            $table->string('rencana')->nullable()->default('KOSONG');
            $table->string('penilai_persentase_kesesuaian_sbsk')->nullable()->default('KOSONG');
            $table->float('luas_sbsk')->nullable()->default(0);
            $table->float('luas_pengurang')->nullable()->default(0);
            $table->float('luas_ts_db')->nullable()->default(0);
            $table->float('luas_digunakan')->nullable()->default(0);
            $table->float('persentase_penilaian_pengelola_pengguna')->nullable()->default(0);
            $table->string('status_sesuai_Form3')->nullable()->default('KOSONG');
            $table->string('dok_rp4')->nullable()->default('KOSONG');
            $table->text('ket_dok_rp4')->nullable()->default('KOSONG');
            $table->string('status_persetujuan')->nullable()->default('KOSONG');
            $table->string('bentuk_persetujuan')->nullable()->default('KOSONG');
            $table->text('ket_persetujuan')->nullable()->default('KOSONG');
            $table->string('status_pelaksanaan')->nullable()->default('KOSONG');
            $table->text('ket_pelaksanaan')->nullable()->default('KOSONG');
            $table->string('status_sesuai_Form4')->nullable()->default('KOSONG');
            $table->text('bentuk_rp4_penggunaan')->nullable()->default('KOSONG');
            $table->text('bentuk_rp4_pemanfaatan')->nullable()->default('KOSONG');
            $table->text('bentuk_rp4_pemindahtanganan')->nullable()->default('KOSONG');
            $table->text('bentuk_rp4_penghapusan')->nullable()->default('KOSONG');
            $table->string('status_sesuai_Form5')->nullable()->default('KOSONG');
            $table->string('status_sesuai_Form6')->nullable()->default('KOSONG');
            $table->text('ket_hasil_temuan_apip')->nullable()->default('KOSONG');
            $table->string('tindak_lanjut_apip')->nullable()->default('KOSONG');
            $table->text('ket_tinjut_apip')->nullable()->default('KOSONG');
            $table->string('status_sesuai_Form7')->nullable()->default('KOSONG');
            $table->text('ket_hasil_temuan_bpk')->nullable()->default('KOSONG');
            $table->string('tindak_lanjut_bpk')->nullable()->default('KOSONG');
            $table->text('ket_tinjut_bpk')->nullable()->default('KOSONG');
            $table->string('status_sesuai_Form8')->nullable()->default('KOSONG');
            $table->boolean('isRP4Penggunaan')->nullable()->default(false);
            $table->boolean('isRP4Pemanfaatan')->nullable()->default(false);
            $table->boolean('isRP4Pemindahtanganan')->nullable()->default(false);
            $table->boolean('isRP4Penghapusan')->nullable()->default(false);
            $table->boolean('isCompletedForm1')->nullable()->default(false);
            $table->boolean('isCompletedForm2')->nullable()->default(false);
            $table->boolean('isCompletedForm3')->nullable()->default(false);
            $table->boolean('isCompletedForm4')->nullable()->default(false);
            $table->boolean('isCompletedForm5')->nullable()->default(false);
            $table->boolean('isCompletedForm6')->nullable()->default(false);
            $table->boolean('isCompletedForm7')->nullable()->default(false);
            $table->boolean('isCompletedForm8')->nullable()->default(false);
            $table->boolean('isDeletedForm1')->nullable()->default(false);
            $table->boolean('isDeletedForm2')->nullable()->default(false);
            $table->boolean('isDeletedForm3')->nullable()->default(false);
            $table->boolean('isDeletedForm4')->nullable()->default(false);
            $table->boolean('isDeletedForm5')->nullable()->default(false);
            $table->boolean('isDeletedForm6')->nullable()->default(false);
            $table->boolean('isDeletedForm7')->nullable()->default(false);
            $table->boolean('isDeletedForm8')->nullable()->default(false);
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
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
