<?php

namespace App\Http\Controllers\helper;

use App\Http\Controllers\Controller;
use App\Models\wasdal\pemantauan\PenggunaanModel;
use App\Models\wasdal\referensi\ref_kode_barang_simanold;
use App\Models\wasdal\siman\Simanv2Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class HelperWasdalController extends Controller
{


     public function getKodeBarang(Request $request) {
        $kodeBarang = Simanv2Model::select('kd_brg','ur_sskel')->where('kd_satker','015050900035519000KD')->whereRaw("LEFT(kd_brg,1) in ('2','3','4','5','8') ")->whereNotIn('kd_brg',[ '6070101001',
        '6070201001',
        '6070301001',
        '6070401001',
        '6070501001',])->where('kd_jns_bmn', $request->kd_jns_bmn)->groupBy('kd_brg','ur_sskel')->orderBy('kd_brg','asc')->get();

        // session(['kd_brg' => $request->kd_brg]);
        // session(['kd_jns_bmn' => $request->kd_jns_bmn]);

        return response()->json($kodeBarang);
    }

    public function getNupBarang(Request $request) {
        $kd_jns_bmn = $request->kd_jns_bmn;
        $kd_brg = $request->kd_brg;


        $nupBarang = Simanv2Model::select('kd_brg','no_aset')->where('kd_satker','015050900035519000KD')->whereRaw("LEFT(kd_brg,1) in ('2','3','4','5','8') ")->whereNotIn('kd_brg',[ '6070101001',
        '6070201001',
        '6070301001',
        '6070401001',
        '6070501001',])->where('kd_jns_bmn', $kd_jns_bmn)->where('kd_brg', $kd_brg)->get();
        // dd($nupBarang);
        return response()->json($nupBarang);
    }

     public function getNilaiBukuBarang(Request $request) {
        $kd_jns_bmn = $request->kd_jns_bmn;
        $kd_brg = $request->kd_brg;
        $no_aset = $request->no_aset;


        $nilaiBuku = Simanv2Model::select('rph_buku')->where('kd_satker','015050900035519000KD')->whereRaw("LEFT(kd_brg,1) in ('2','3','4','5','8') ")->whereNotIn('kd_brg',[ '6070101001',
        '6070201001',
        '6070301001',
        '6070401001',
        '6070501001',])->where('kd_jns_bmn', $kd_jns_bmn)->where('kd_brg', $kd_brg)->where('no_aset', $no_aset)->get();
        // dd($nilaiBuku);
        return response()->json($nilaiBuku);
    }


     public function GenerateDataPemantauanPenggunaan()
    {
       try {
            $dataToInsert = Simanv2Model::where('kd_satker_6digit', '330171')->whereRaw("LEFT(kd_brg,1) in ('2','3','4','5','8') ")->whereNotIn('kd_brg',[ '6070101001',
        '6070201001',
        '6070301001',
        '6070401001',
        '6070501001',])
                ->get();

            foreach ($dataToInsert as $data) {
                $newData = [
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
                      'nomor_psp'=>$data->no_psp
                ];

                PenggunaanModel::create($newData);
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
