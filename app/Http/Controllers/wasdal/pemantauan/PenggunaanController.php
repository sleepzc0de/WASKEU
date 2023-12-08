<?php

namespace App\Http\Controllers\wasdal\pemantauan;

use App\Http\Controllers\Controller;
use App\Models\wasdal\pemantauan\PenggunaanModel;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\wasdal\siman\Simanv2Model;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenggunaanController extends Controller
{
    public function index()
    {


        // dd(Hash::make('W4sd4lK3u!@#!@#!@#1Nd0n35!A'));
        // $dataToInsert = DB::table('SIMAN_V2_ALL AS a')->leftJoin('rp4_penggunaan  AS b','a.unik','=','b.rp4_uniq')->leftJoin('rp4_pemanfaatan AS c','b.rp4_uniq','=','c.rp4_uniq')->leftJoin('rp4_pemindahtanganan AS d','c.rp4_uniq','=','d.rp4_uniq')->whereRaw('LEFT(a.kd_satker,3)=015')->where('c.rp4_uniq','015010400117109000KD40101010012')->take(1)->first();
        // dd($dataToInsert->a.ur_eselon1);

        $user = Auth::user();
        $KPB = $user->hasRole('KPB');
        $KANWIL = $user->hasRole('PPB-W');
        $ES1 = $user->hasRole('PPB-E1');
        $PENGGUNA = $user->hasRole('PB');
        $PENGELOLA = $user->hasRole('PENGELOLA');
        $AUDITOR = $user->hasRole('AUDITOR');

        if ($KPB) {
            $query = PenggunaanModel::with(['ref_status_psp'])->where('kode_satker', Auth::user()->satker)->select('*');

            if (request()->ajax()) {
                 return datatables()->of($query)
                    ->addIndexColumn()
                    ->make(true);
            }
            $data = PenggunaanModel::where('kode_satker', Auth::user()->satker)->get();
        } elseif ($KANWIL) {
            $query = PenggunaanModel::with(['ref_status_psp'])->whereRaw('LEFT(kode_anak_satker,9) = ?',[Auth::user()->satker])->where('role','PPB-W')->select('*');

            if (request()->ajax()) {
                 return datatables()->of($query)
                    ->addIndexColumn()
                    ->make(true);
            }

            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,9) = ?',[Auth::user()->satker])->where('role','PPB-W')->get();
        } elseif ($ES1) {
            $query = PenggunaanModel::with(['ref_status_psp'])->whereRaw('LEFT(kode_anak_satker,5) = ?',[Auth::user()->satker])->where('role','PPB-E1')->select('*');

            if (request()->ajax()) {
                 return datatables()->of($query)
                    ->addIndexColumn()
                    ->make(true);
            }

            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,5) = ?',[Auth::user()->satker])->where('role','PPB-E1')->get();
        } elseif ($PENGGUNA) {
            $query = PenggunaanModel::with(['ref_status_psp'])->whereRaw('LEFT(kode_anak_satker,3) = ?',[Auth::user()->satker])->where('role','PB')->select('*');

            if (request()->ajax()) {
                 return datatables()->of($query)
                    ->addIndexColumn()
                    ->make(true);
            }

            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,3) = ?',[Auth::user()->satker])->where('role','PB')->get();
        } elseif ($PENGELOLA) {
            $query = PenggunaanModel::with(['ref_status_psp'])->whereRaw('LEFT(kode_anak_satker,3) = ?',[Auth::user()->satker])->where('role','PENGELOLA')->select('*');

            if (request()->ajax()) {
                 return datatables()->of($query)
                    ->addIndexColumn()
                    ->make(true);
            }

            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,3) = ?',[Auth::user()->satker])->where('role','PENGELOLA')->get();
        }




        return view('konten-wasdal.pemantauan.penggunaan.index', compact('data'));
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
