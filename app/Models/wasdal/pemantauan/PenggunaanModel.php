<?php

namespace App\Models\wasdal\pemantauan;

use App\Models\wasdal\referensi\ref_status_psp;
use App\Models\wasdal\referensi\StatusPSPModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenggunaanModel extends Model
{
    use HasFactory;
    protected $table = 't_pemantauan_penggunaan';
     protected $fillable = ['ue1','nama_satker','kode_satker','kode_anak_satker','nama_anak_satker','jenis_barang','kode_barang','nama_barang','nup','nilai_buku','status_psp', 'nomor_psp', 'tanggal_psp', 'ket_psp','status_sesuai_Form1','kesesuaian_psp','digunakan_sebagai','rencana_alih_fungsi','status_sesuai_Form2','isCompletedForm1','isCompletedForm2','isCompletedForm3','isCompletedForm4','isCompletedForm5','isCompletedForm6','isCompletedForm7','isCompletedForm8'];


    public function ref_status_psp()
    {
        return $this->belongsTo(ref_status_psp::class, 'status_psp', 'id');
    }

}
