<?php

namespace App\Http\Controllers\wasdal\pemantauan\periodik;

use App\Http\Controllers\Controller;
use App\Models\wasdal\pemantauan\PenggunaanModel;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class PemantauanPenggunaanPeriodikController extends Controller
{
    public function index()
    {

        // dd(Hash::make('W4sd4lK3u!@#!@#!@#1Nd0n35!A'));

        $query = PenggunaanModel::with(['ref_status_psp'])->where('kode_satker', Auth::user()->satker)->select('*');

        if (request()->ajax()) {
             return datatables()->of($query)
                ->addIndexColumn()
                ->make(true);
        }
        $data = PenggunaanModel::where('kode_satker', Auth::user()->satker)->get();
        return view('konten-wasdal.pemantauan.periodik.penggunaan.index', compact('data'));
    }

    // public function destroy(string $id)
    // {
    //     try {

    //         PenggunaanModel::findOrFail($id)->delete();
    //         return redirect()->route('periodik-penggunaan.index')->with('success', "Data berhasil dihapus!");
    //     } catch (Exception $e) {
    //         return redirect()->route('periodik-penggunaan.index')->with(['failed' => 'Data Yang Dihapus Tidak Ada ! error :' . $e->getMessage()]);
    //     }
    // }
}
