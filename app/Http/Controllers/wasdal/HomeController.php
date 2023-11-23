<?php

namespace App\Http\Controllers\wasdal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function developer(){
        return view('konten-wasdal.home.developer');
    }
}
