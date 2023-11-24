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
