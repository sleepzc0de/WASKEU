<?php

namespace App\Models\wasdal\pemantauan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenggunaanModel extends Model
{
    use HasFactory;
    protected $table = 't_pemantauan_penggunaan';
     protected $fillable = ['status_psp', 'no_psp', 'tgl_psp', 'ket_psp'];

}
