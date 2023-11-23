<?php

namespace App\Http\Controllers\helper;

use App\Http\Controllers\Controller;
use App\Models\wasdal\pemantauan\PenggunaanModel;
use App\Models\wasdal\referensi\ref_kode_barang_simanold;
use App\Models\wasdal\siman\Simanv2Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HelperWasdalController extends Controller
{


    //  public function getKodeBarang(Request $request) {
    //     // $kodeBarang = Simanv2Model::select('kd_brg','ur_sskel')->where('kd_satker_6digit', Auth::user()->satker)->whereRaw("LEFT(kd_brg,1) in ('2','3','4','5','8') ")->whereNotIn('kd_brg',[ '6070101001',
    //     // '6070201001',
    //     // '6070301001',
    //     // '6070401001',
    //     // '6070501001',])->where('kd_jns_bmn', $request->kd_jns_bmn)->groupBy('kd_brg','ur_sskel')->orderBy('kd_brg','asc')->get();
    //     $kodeBarang = ref_kode_barang_simanold::select('KD_BRG','NM_BRG')->whereRaw("LEFT(KD_BRG,1) in ('2','3','4','5','8') ")->whereNotIn('KD_BRG',[ '6070101001',
    //     '6070201001',
    //     '6070301001',
    //     '6070401001',
    //     '6070501001',])->orderBy('KD_BRG','ASC')->get();

    //     // session(['kd_brg' => $request->kd_brg]);
    //     // session(['kd_jns_bmn' => $request->kd_jns_bmn]);

    //     return response()->json($kodeBarang);
    // }

    // public function getNupBarang(Request $request) {
    //     $kd_jns_bmn = $request->kd_jns_bmn;
    //     $kd_brg = $request->kd_brg;


    //     $nupBarang = Simanv2Model::select('kd_brg','no_aset')->where('kd_satker_6digit', Auth::user()->satker)->whereRaw("LEFT(kd_brg,1) in ('2','3','4','5','8') ")->whereNotIn('kd_brg',[ '6070101001',
    //     '6070201001',
    //     '6070301001',
    //     '6070401001',
    //     '6070501001',])->where('kd_jns_bmn', $kd_jns_bmn)->where('kd_brg', $kd_brg)->get();
    //     // dd($nupBarang);
    //     return response()->json($nupBarang);
    // }

    //  public function getNilaiBukuBarang(Request $request) {
    //     $kd_jns_bmn = $request->kd_jns_bmn;
    //     $kd_brg = $request->kd_brg;
    //     $no_aset = $request->no_aset;


    //     $nilaiBuku = Simanv2Model::select('rph_buku')->where('kd_satker_6digit', Auth::user()->satker)->whereRaw("LEFT(kd_brg,1) in ('2','3','4','5','8') ")->whereNotIn('kd_brg',[ '6070101001',
    //     '6070201001',
    //     '6070301001',
    //     '6070401001',
    //     '6070501001',])->where('kd_jns_bmn', $kd_jns_bmn)->where('kd_brg', $kd_brg)->where('no_aset', $no_aset)->get();
    //     // dd($nilaiBuku);
    //     return response()->json($nilaiBuku);
    // }


     public function GenerateDataPemantauanPenggunaan()
    {
       try {

        $countStatusPenggunaan06 = Simanv2Model::where('kd_status', '06')
        ->where('kd_satker_6digit', Auth::user()->satker)
        ->count();

         $isCompletedForm3 = $countStatusPenggunaan06 === 0 ? true : false;

          // LOGIKA WASDAL GENERATE DATA SIMAN V2
          $user = Auth::user();
          $role = '';

          if ($user->id_satker === 'ANAK SATKER' || $user->id_satker === 'INDUK SATKER') {
              $role = 'KPB';
          } elseif ($user->id_satker === 'KANWIL') {
              $role = 'PPB-W';
          } elseif ($user->id_satker === 'ES1') {
              $role = 'PPB-E1';
          } elseif ($user->id_satker === 'PENGGUNA') {
              $role = 'PB';
          } elseif ($user->id_satker === 'PENGELOLA') {
              $role = 'PENGELOLA';
          } elseif ($user->id_satker === 'AUDITOR') {
              $role = 'AUDITOR';
          } else {
              $role = 'TAMU';
          }



        //     $dataToInsert = Simanv2Model::where('kd_satker_6digit', Auth::user()->satker)->whereRaw("LEFT(kd_brg,1) in ('2','3','4','5','8') ")->whereNotIn('kd_brg',[ '6070101001',
        // '6070201001',
        // '6070301001',
        // '6070401001',
        // '6070501001',])
        //         ->get();

        // LOGIC ROLE GENERATE

        $KPB = $user->hasRole('KPB');
        $KANWIL = $user->hasRole('PPB-W');
        $ES1 = $user->hasRole('PPB-E1');
        $PENGGUNA = $user->hasRole('PB');
        $PENGELOLA = $user->hasRole('PENGELOLA');
        $AUDITOR = $user->hasRole('AUDITOR');

        if ($KPB) {
            $dataToInsert = Simanv2Model::where('kd_satker_6digit', Auth::user()->satker)->get();

            foreach ($dataToInsert as $data) {

                $newData = [
                    'tahun' => session('tahun_wasdal'),
                    'periode'=>session('periode_wasdal'),
                    'jenis_pemantauan'=> session('jenis_pemantauan_wasdal'),
                    'role' => $role,
                    'ue1' => $data->ur_eselon1,
                    'nama_satker' => $data->ur_satker,
                    'kode_satker' => $data->kd_satker_6digit,
                    'nama_anak_satker' => $data->ur_satker,
                    'kode_anak_satker' => $data->kd_satker,
                    'jenis_barang' => $data->nm_jns_bmn,
                    'nama_barang' => $data->ur_sskel,
                    'kode_barang' => $data->kd_brg,
                    'nup' => $data->no_aset,
                    'nilai_buku'=>$data->rph_buku,
                     'tanggal_psp'=>$data->tgl_psp,
                      'nomor_psp'=>$data->no_psp,
                      'status_penggunaan' => $data->kd_status,
                      'luas_sbsk' => $data->sbsk,
                      'luas_ts_db' => $data->luas,

                ];

                PenggunaanModel::create($newData);
            }

        }
        elseif ($KANWIL) {
            $dataToInsert = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,9) = ?',[Auth::user()->satker])->get();

            foreach ($dataToInsert as $data) {

                $newData = [
                    'tahun' => $data->tahun,
                    'periode'=>$data->periode,
                    'jenis_pemantauan'=> $data->jenis_pemantauan,
                    'role' => $role,
                    'ue1' => $data->ue1,
                    'nama_satker' => $data->nama_satker,
                    'kode_satker' => $data->kode_satker,
                    'nama_anak_satker' => $data->nama_anak_satker,
                    'kode_anak_satker' => $data->kode_anak_satker,
                    'jenis_barang' => $data->jenis_barang,
                    'nama_barang' => $data->nama_barang,
                    'kode_barang' => $data->kode_barang,
                    'nup' => $data->nup,
                    'nilai_buku'=>$data->nilai_buku,
                    'status_psp'=>$data->status_psp,
                    'tanggal_psp'=>$data->tanggal_psp,
                    'nomor_psp'=>$data->nomor_psp,
                    'ket_psp'=>$data->ket_psp,
                    'status_sesuai_Form1'=>$data->status_sesuai_Form1,
                    'kesesuaian_psp'=>$data->kesesuaian_psp,
                    'digunakan_sebagai'=>$data->digunakan_sebagai,
                    'rencana_alih_fungsi'=>$data->rencana_alih_fungsi,
                    'status_penggunaan' => $data->status_penggunaan,
                    'status_sesuai_Form2'=>$data->status_sesuai_Form2,
                    'status_penggunaan'=>$data->status_penggunaan,
                    'rencana'=>$data->rencana,
                    'penilai_persentase_kesesuaian_sbsk'=>$data->penilai_persentase_kesesuaian_sbsk,
                    'luas_sbsk' => $data->luas_sbsk,
                    'luas_pengurang' => $data->luas_pengurang,
                    'luas_ts_db' => $data->luas_ts_db,
                    'luas_digunakan' => $data->luas_digunakan,
                    'persentase_penilaian_pengelola_pengguna' => $data->persentase_penilaian_pengelola_pengguna,
                    'isCompletedForm1' =>$data->isCompletedForm1,
                    'isCompletedForm2' =>$data->isCompletedForm2,
                    'isCompletedForm3' =>$data->isCompletedForm3,
                    'isCompletedForm4' =>$data->isCompletedForm4,
                    'isCompletedForm5' =>$data->isCompletedForm5,
                    'isCompletedForm6' =>$data->isCompletedForm6,
                    'isCompletedForm7' =>$data->isCompletedForm7,
                    'isCompletedForm8' =>$data->isCompletedForm8,

                ];

                PenggunaanModel::create($newData);
            }

        }
        elseif ($ES1) {
            # code...
        }
        elseif ($PENGGUNA) {
            # code...
        }
        elseif ($PENGELOLA) {
            # code...
        }
        elseif ($AUDITOR) {
            # code...
        }


            return redirect()->back()->with('success', 'Data berhasil digenerate');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Gagal melakukan proses generate: ' . $e->getMessage());
        }
    }

    public function getKodeBarangAll() {
        $kodeBarang = ref_kode_barang_simanold::all();
        return response()->json($kodeBarang);
    }

}
