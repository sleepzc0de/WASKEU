<?php

namespace App\Models\wasdal\pemantauan;

use App\Models\wasdal\referensi\ref_kesesuaian_psp;
use App\Models\wasdal\referensi\ref_status_psp;
use App\Models\wasdal\referensi\StatusPSPModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PenggunaanModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 't_pemantauan_penggunaan';
    protected $fillable = [
        'unik',
        'isGenerated',
        'tahun',
        'periode',
        'jenis_pemantauan',
        'role',
        'ue1',
        'nama_satker',
        'kode_satker',
        'kode_anak_satker',
        'nama_anak_satker',
        'jenis_barang',
        'kode_barang',
        'nama_barang',
        'nup',
        'nilai_buku',
        'status_psp',
        'nomor_psp',
        'tanggal_psp',
        'ket_psp',
        'status_sesuai_Form1',
        'kesesuaian_psp',
        'digunakan_sebagai',
        'rencana_alih_fungsi',
        'status_sesuai_Form2',
        'status_penggunaan',
        'rencana',
        'penilai_persentase_kesesuaian_sbsk',
        'luas_sbsk',
        'luas_pengurang',
        'luas_ts_db',
        'luas_digunakan',
        'persentase_penilaian_pengelola_pengguna',
        'status_sesuai_Form3',
        // PENGGUNAAN SEMENTARA
        'dok_rp4',
        'ket_dok_rp4',
        'status_persetujuan',
        'bentuk_persetujuan',
        'ket_persetujuan',
        'status_pelaksanaan',
        'ket_pelaksanaan',
        'status_sesuai_Form4',
        'bentuk_rp4_penggunaan',
        'bentuk_rp4_pemanfaatan',
        'bentuk_rp4_pemindahtanganan',
        'bentuk_rp4_penghapusan',
        'status_sesuai_Form5',
        // END PENGGUNAAN SEMENTARA
        // TINJUT TEMUAN APIP
        'ket_hasil_temuan_apip',
        'tindak_lanjut_apip',
        'ket_tinjut_apip',
        'status_sesuai_Form7',
        // END TINJUT TEMUAN APIP
        // TINJUT TEMUAN BPK
        'ket_hasil_temuan_bpk',
        'tindak_lanjut_bpk',
        'ket_tinjut_bpk',
        'status_sesuai_Form8',
        // END TINJUT TEMUAN BPK
        // CHECK RP4
        'isRP4Penggunaan',
        'isRP4Pemanfaatan',
        'isRP4Pemindahtanganan',
        'isRP4Penghapusan',
        // END CHECK RP4
        'isCompletedForm1', 'isCompletedForm2', 'isCompletedForm3', 'isCompletedForm4', 'isCompletedForm5', 'isCompletedForm6', 'isCompletedForm7', 'isCompletedForm8',
        'isDeletedForm1', 'isDeletedForm2', 'isDeletedForm3', 'isDeletedForm4', 'isDeletedForm5', 'isDeletedForm6', 'isDeletedForm7', 'isDeletedForm8'
    ];
    protected $dates = ['deleted_at'];





    public function ref_status_psp()
    {
        return $this->belongsTo(ref_status_psp::class, 'status_psp', 'id');
    }
    public function ref_kesesuaian_psp()
    {
        return $this->belongsTo(ref_kesesuaian_psp::class, 'kesesuaian_psp', 'id');
    }
}
