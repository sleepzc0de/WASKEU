<?php

namespace App\Models\wasdal\siman;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simanv2Model extends Model
{
    use HasFactory;
     protected $table = 'SIMAN_V2_ALL';
     protected $primaryKey = 'unik'; // Ganti 'nama_primary_key' dengan nama primary key tabel Anda


}
