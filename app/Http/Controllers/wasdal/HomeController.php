<?php

namespace App\Http\Controllers\wasdal;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    public function index(){
        return view ('konten-wasdal.home.index');
    }
    public function developer(){
        return view('konten-wasdal.home.developer');
    }
}
