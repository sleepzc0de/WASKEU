<?php

namespace App\Http\Controllers\wasdal\pemantauan\form;

use App\Http\Controllers\Controller;
use App\Models\wasdal\pemantauan\PenggunaanModel;
use App\Models\wasdal\siman\Simanv2Model;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class FormPSPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     return view('konten-wasdal.pemantauan.formulir.psp.index');
    // }
     public function index()
    {

        $query = PenggunaanModel::rightJoin('SIMAN_V2_ALL', 't_pemantauan_penggunaan.kode_satker', '=', 'SIMAN_V2_ALL.kd_satker')->where('kd_satker','015050900035519000KD')->select('*');

        if (request()->ajax()) {
            $dataTable = datatables()->of($query)
                ->addColumn('opsi', function ($query) {
                    // $preview = route('form-psp.show', $query->id);
                    $edit = route('form-psp.edit', $query->id_aset);
                    // $hapus = route('form-psp.destroy', $query->id);
                    $create = route('form-psp.create');
                    return '
                                          <div class="demo-inline-spacing">

                    <div class="btn-group" id="hover-dropdown-demo">
                          <button
                            type="button"
                            class="btn btn-block btn-primary dropdown-toggle"
                            data-bs-toggle="dropdown"
                            data-trigger="hover">
                            <span class="mdi mdi-dots-horizontal-circle-outline"></span>

                          </button>
                          <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="' . $edit . '">Edit</a></li>
                            <li><a class="dropdown-item" href="' . $create . '">Test Create</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
                          </ul>
                        </div>
                        </div>
                ';
                })

                ->editColumn('isCompletedForm1', function ($query) {
                    $x = '';
                    if ($query->isCompletedForm1) {
                        $x = '<span class="mdi mdi-check-circle"></span>';
                    }
                    if (!$query->isCompletedForm1) {
                        $x = '<span class="mdi mdi-alert"></span>';
                    }

                    return $x;
                })



                ->rawColumns(
                    ['opsi',
                    'isCompletedForm1'
                      ])
                ->addIndexColumn();

                 $filterableColumns = [
                    'kd_brg',
                    'nm_jns_bmn',
                    'no_aset'
    ];

                foreach ($filterableColumns as $column) {
        $dataTable->filterColumn($column, function ($query, $keyword) use ($column) {
            $query->whereRaw("$column LIKE ?", ["%{$keyword}%"]);
        });
    }
                    return $dataTable->make(true);

        }
        return view('konten-wasdal.pemantauan.formulir.psp.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $simanv2 = Simanv2Model::select('kd_jns_bmn','nm_jns_bmn')->where('kd_satker','015050900035519000KD')->whereRaw("LEFT(kd_brg,1) in ('2','3','4','5','8') ")->whereNotIn('kd_brg',[ '6070101001',
        '6070201001',
        '6070301001',
        '6070401001',
        '6070501001',])->groupBy('kd_jns_bmn','nm_jns_bmn')->orderBy('kd_jns_bmn','asc')->get();

        $data = [
            'siman' => $simanv2
        ];
        return view('konten-wasdal.pemantauan.formulir.psp.create',compact('data'));
    }

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


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         try {
            //code...
            $request->validate([
                // 'tgl_psp' => 'date|date_format:Y-m-d',
            ]);

            $status_sesuai_Form1 = ($request->status_psp === 'SUDAH_PSP') ? 'SESUAI' : 'TIDAK SESUAI';

            $user =  PenggunaanModel::create([
                'jenis_barang' => $request->jenis_barang,
                'kode_barang' => $request->kode_barang,
                'nup' => $request->nup,
                'nilai_buku' => $request->nilai_buku,
                'status_psp' => $request->status_psp,
                'no_psp' => $request->no_psp,
                'tgl_psp' => $request->tgl_psp,
                'ket_psp' => $request->ket_psp,
                'status_sesuai_Form1' => $status_sesuai_Form1,
                'isCompletedForm1' => true
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
