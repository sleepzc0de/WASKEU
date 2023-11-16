<?php

namespace App\Http\Controllers\wasdal\pemantauan\periodik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PemantauanPenggunaanPeriodikController extends Controller
{
    public function index(){
        return view('konten-wasdal.pemantauan.periodik.penggunaan.index');
    }
}
