<?php

namespace App\Http\Controllers\wasdal\pemantauan\form;

use App\Http\Controllers\Controller;
use App\Models\wasdal\pemantauan\PenggunaanModel;
use App\Models\wasdal\referensi\ref_jenis_barang_simannew;
use App\Models\wasdal\referensi\ref_kesesuaian_psp;
use App\Models\wasdal\referensi\ref_kode_barang_simanold;
use App\Models\wasdal\siman\Simanv2Model;
use Exception;
use Illuminate\Http\Request;

class FormKesesuaianPSPController extends Controller
// {
//     /**
//      * Display a listing of the resource.
//      */
//     public function index   ()
//     {

//         //      $x = PenggunaanModel::rightJoin('SIMAN_V2_ALL', 't_pemantauan_penggunaan.kode_satker', '=', 'SIMAN_V2_ALL.kd_satker')->whereNotNull('SIMAN_V2_ALL.no_psp')
//         // ->whereNotNull('SIMAN_V2_ALL.tgl_psp')->where('kd_satker','015050900035519000KD')->take(10)->get();
//         //     dd($x);
//         $query = PenggunaanModel::rightJoin('SIMAN_V2_ALL', 't_pemantauan_penggunaan.kode_satker', '=', 'SIMAN_V2_ALL.kd_satker')->where('kd_satker', '015050900035519000KD')->select('*');

//         if (request()->ajax()) {
//             $dataTable = datatables()->of($query)
//                 ->addColumn('opsi', function ($query) {
//                     $edit = route('form-kesesuaian-psp.edit', $query->id_aset);
//                     return ' <a href="' . $edit . '" class="btn btn-outline-info">Edit</a>
//                 ';
//                 })

//                 ->editColumn('isCompletedForm1', function ($query) {
//                     $x = '';
//                     if ($query->isCompletedForm1) {
//                         $x = '<span class="mdi mdi-check-circle"></span>';
//                     }
//                     if (!$query->isCompletedForm1) {
//                         $x = '<span class="mdi mdi-alert"></span>';
//                     }

//                     return $x;
//                 })



//                 ->rawColumns(
//                     [
//                         'opsi',
//                         'isCompletedForm1'
//                     ]
//                 )
//                 ->addIndexColumn();

//             $filterableColumns = [
//                 'kd_brg',
//                 'nm_jns_bmn',
//                 'no_aset',
//                 'rph_buku',
//                 'tgl_psp',
//                 'status_psp',
//                 'no_psp',
//                 'status_sesuai_Form1'
//             ];

//             foreach ($filterableColumns as $column) {
//                 $dataTable->filterColumn($column, function ($query, $keyword) use ($column) {
//                     $query->whereRaw("$column LIKE ?", ["%{$keyword}%"]);
//                 });
//             }
//             return $dataTable->make(true);
//         }
//         return view('konten-wasdal.pemantauan.formulir.kesesuaian-psp.index');
//     }

//     /**
//      * Show the form for creating a new resource.
//      */
//     public function create()
//     {

//         $simanv2 = PenggunaanModel::rightJoin('SIMAN_V2_ALL', 't_pemantauan_penggunaan.kode_satker', '=', 'SIMAN_V2_ALL.kd_satker')->select('kd_jns_bmn', 'nm_jns_bmn')->whereNotNull('SIMAN_V2_ALL.no_psp')
//             ->whereNotNull('SIMAN_V2_ALL.tgl_psp')->where('kd_satker', '015050900035519000KD')->groupBy('kd_jns_bmn', 'nm_jns_bmn')->orderBy('kd_jns_bmn', 'asc')->get();

//         $refBarang = PenggunaanModel::rightJoin('SIMAN_V2_ALL', 't_pemantauan_penggunaan.kode_satker', '=', 'SIMAN_V2_ALL.kd_satker')->select('kd_brg', 'ur_sskel')->where('kd_satker', '015050900035519000KD')->groupBy('kd_brg', 'ur_sskel')->orderBy('kd_brg', 'asc')->get();
//         // dd($simanv2);

//         $data = [
//             'siman' => $simanv2,
//             'refBarang' => $refBarang
//         ];
//         return view('konten-wasdal.pemantauan.formulir.kesesuaian-psp.create', compact('data'));
//     }

//     /**
//      * Store a newly created resource in storage.
//      */
//     public function store(Request $request)
//     {
//         try {
//             //code...
//             $request->validate([
//                 // 'tgl_psp' => 'date|date_format:Y-m-d',
//             ]);

//             $status_sesuai_Form2 = ($request->kesesuaian_psp === 'SESUAI_PSP') ? 'SESUAI' : 'TIDAK SESUAI';

//             $user =  PenggunaanModel::create([
//                 'jenis_barang' => $request->jenis_barang,
//                 'kode_barang' => $request->kode_barang,
//                 'nup' => $request->nup,
//                 'nilai_buku' => $request->nilai_buku,
//                 'kesesuaian_psp' => $request->kesesuaian_psp,
//                 'digunakan_sebagai' => $request->digunakan_sebagai,
//                 'rencana_alih_fungsi' => $request->rencana_alih_fungsi,
//                 'status_sesuai_Form2' => $status_sesuai_Form2,
//                 'isCompletedForm2' => true
//             ]);


//             return redirect()->back()->with(['success' => 'Data Berhasil Disimpan']);
//         } catch (Exception $e) {
//             return redirect()->back()->with(['failed' => 'Ada Kesalahan Sistem! error :' . $e->getMessage()]);
//             //throw $th;
//         }
//     }

//     /**
//      * Display the specified resource.
//      */
//     public function show(string $id)
//     {
//         //
//     }

//     /**
//      * Show the form for editing the specified resource.
//      */
//     public function edit(string $id)
//     {

//         $dataEdit = PenggunaanModel::rightJoin('SIMAN_V2_ALL', 't_pemantauan_penggunaan.kode_satker', '=', 'SIMAN_V2_ALL.kd_satker')->whereNotNull('SIMAN_V2_ALL.no_psp')
//             ->whereNotNull('SIMAN_V2_ALL.tgl_psp')->where('kd_satker', '015050900035519000KD')->where('id_aset', $id)->first();
//         // dd($simanv2);

//         $refBarang = PenggunaanModel::rightJoin('SIMAN_V2_ALL', 't_pemantauan_penggunaan.kode_satker', '=', 'SIMAN_V2_ALL.kd_satker')->select('kd_brg', 'ur_sskel')->where('kd_satker', '015050900035519000KD')->groupBy('kd_brg', 'ur_sskel')->orderBy('kd_brg', 'asc')->get();

//         // dd($refBarang);

//         $statusPSPOptions = [
//             'SESUAI_PSP' => 'Sesuai PSP',
//             'TIDAK_SESUAI_PSP' => 'Tidak Sesuai PSP'
//         ];

//         $oldStatusPSP = $dataEdit->kesesuaian_psp;

//         $data = [
//             'dataEdit' => $dataEdit,
//             'statusPSPOptions' => $statusPSPOptions,
//             'oldStatusPSP' => $oldStatusPSP,
//             'refBarang' => $refBarang

//         ];

//         // dd($data['refBarang']->kd_brg);

//         return view('konten-wasdal.pemantauan.formulir.kesesuaian-psp.edit', compact('data'));
//     }

//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(Request $request, string $id)
//     {
//           try {
//             //code...
//             $request->validate([
//                 // 'tgl_psp' => 'date|date_format:Y-m-d',
//             ]);

//             $status_sesuai_Form2 = ($request->kesesuaian_psp === 'SESUAI_PSP') ? 'SESUAI' : 'TIDAK SESUAI';

//             $data = [
//                 'jenis_barang' => $request->jenis_barang,
//                 'kode_barang' => $request->kode_barang,
//                 'nup' => $request->nup,
//                 'nilai_buku' => $request->nilai_buku,
//                 'kesesuaian_psp' => $request->kesesuaian_psp,
//                 'digunakan_sebagai' => $request->digunakan_sebagai,
//                 'rencana_alih_fungsi' => $request->rencana_alih_fungsi,
//                 'status_sesuai_Form2' => $status_sesuai_Form2,
//                 'isCompletedForm1' => true
//             ];

//             PenggunaanModel::rightJoin('SIMAN_V2_ALL', 't_pemantauan_penggunaan.kode_satker', '=', 'SIMAN_V2_ALL.kd_satker')->where('kd_satker','015050900035519000KD')->where('id_aset',$id)->first()->update($data);

//             return redirect()->back()->with(['success' => 'Data Berhasil Diubah']);
//         } catch (Exception $e) {
//             return redirect()->back()->with(['failed' => 'Ada Kesalahan Sistem! error :' . $e->getMessage()]);
//             //throw $th;
//         }
//     }

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy(string $id)
//     {
//         //
//     }
// }
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {


        $query = PenggunaanModel::with(['ref_status_psp'])->where('kode_satker', '330171')->where('status_psp', 'SUDAH_PSP')->select('*');
        // dd($query);

        if (request()->ajax()) {
            // $dataTable = datatables()->of($query)
            return datatables()->of($query)
                ->addColumn('opsi', function ($query) {
                    // $preview = route('form-kesesuaian-psp.show', $query->id);
                    $edit = route('form-kesesuaian-psp.edit', $query->id);
                    $hapus = route('form-kesesuaian-psp.destroy', $query->id);
                    return '
                    <div style="display: flex; justify-content: space-between;">

                    <a href="' . $edit . '" class="btn btn-outline-info">Edit</a>
                    <form action="' . $hapus . '" method="POST">
													' . @csrf_field() . '
													' . @method_field('DELETE') . '
													<button type="submit" name="submit" class="btn btn-outline-danger">Hapus</button>
													</form>
                                                    </div>
                ';
                })
                ->rawColumns(
                    [
                        'opsi'
                    ]
                )
                ->addIndexColumn()
                ->make(true);
        }
        $data = PenggunaanModel::where('kode_satker', '330171')->get();
        return view('konten-wasdal.pemantauan.formulir.kesesuaian-psp.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kesesuaian_psp = ref_kesesuaian_psp::all();
        $refKodeBarang = ref_kode_barang_simanold::all();
        $refJenisBarang = ref_jenis_barang_simannew::all();
        $data = PenggunaanModel::with(['ref_kesesuaian_psp'])->where('kode_satker', '330171')->get();


        return view('konten-wasdal.pemantauan.formulir.kesesuaian-psp.create', compact(['data', 'kesesuaian_psp', 'refKodeBarang', 'refJenisBarang']));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            //code...
            $request->validate([
                // 'tanggal_psp' => 'date|date_format:Y-m-d',
            ]);

            $status_sesuai_Form2 = ($request->kesesuaian_psp === 'SESUAI_PSP') ? 'SESUAI' : 'TIDAK SESUAI';

            $user =  PenggunaanModel::create([
                'ue1' => 'DIREKTORAT JENDERAL PERBENDAHARAAN',
                'nama_satker' => 'KANWIL DJPB PROP. PAPUA BARAT',
                'kode_satker' => '330171',
                'nama_anak_satker' => 'KANWIL DJPB PROP. PAPUA BARAT',
                'kode_anak_satker' => '015083300330171000KD',
                'jenis_barang' => $request->jenis_barang,
                'kode_barang' => $request->kode_barang,
                'nup' => $request->nup,
                'nilai_buku' => $request->nilai_buku,
                'kesesuaian_psp' => $request->kesesuaian_psp,
                'digunakan_sebagai' => $request->digunakan_sebagai,
                'rencana_alih_fungsi' => $request->rencana_alih_fungsi,
                'status_sesuai_Form2' => $status_sesuai_Form2,
                'isCompletedForm2' => true
            ]);


            return redirect()->back()->with(['success' => 'Data Berhasil Disimpan']);
        } catch (Exception $e) {
            return redirect()->back()->with(['failed' => 'Ada Kesalahan Sistem! error :' . $e->getMessage()]);
            //throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $kesesuaian_psp = ref_kesesuaian_psp::all();
        $refKodeBarang = ref_kode_barang_simanold::all();
        $data = PenggunaanModel::with(['ref_kesesuaian_psp'])->where('kode_satker', '330171')->where('status_psp', '1')->findOrFail($id);
        // dd($status_psp);

        return view('konten-wasdal.pemantauan.formulir.kesesuaian-psp.edit', compact(['data', 'kesesuaian_psp', 'refKodeBarang']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // VALIDASI DATA
            $request->validate([]);

            $status_sesuai_Form2 = ($request->kesesuaian_psp === '1') ? 'SESUAI' : 'TIDAK SESUAI';

            // TAMPUNGAN REQUEST DATA DARI FORM
            $data = [
                'kesesuaian_psp' => $request->status_psp,
                'digunakan_sebagai' => $request->digunakan_sebagai,
                'rencana_alih_fungsi' => $request->rencana_alih_fungsi,
                'nilai_buku' => $request->nilai_buku,
                'status_sesuai_Form2' => $status_sesuai_Form2,
                'isCompletedForm2' => true
            ];


            PenggunaanModel::findOrFail($id)->update($data);
            // $berita = Berita::find($id)->update($data);
            return redirect()->route('form-kesesuaian-psp.index')->with('success', "Data berhasil diupdate!");
        } catch (Exception $e) {
            return redirect()->route('form-kesesuaian-psp.index')->with(['failed' => 'Data gagal diupdate! error :' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            PenggunaanModel::findOrFail($id)->delete();
            return redirect()->route('form-kesesuaian-psp.index')->with('success', "Data berhasil dihapus!");
        } catch (Exception $e) {
            return redirect()->route('form-kesesuaian-psp.index')->with(['failed' => 'Data Yang Dihapus Tidak Ada ! error :' . $e->getMessage()]);
        }
    }
}
