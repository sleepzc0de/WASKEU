<?php

namespace App\Models\wasdal\pemantauan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenggunaanModel extends Model
{
    use HasFactory;
    protected $table = 't_pemantauan_penggunaan';
     protected $fillable = ['jenis_barang','kode_barang','nama_barang','nup','nilai_buku','status_psp', 'no_psp', 'tgl_psp', 'ket_psp','status_sesuai_Form1','isCompletedForm1','isCompletedForm2','isCompletedForm3','isCompletedForm4','isCompletedForm5','isCompletedForm6','isCompletedForm7','isCompletedForm8'];

}
