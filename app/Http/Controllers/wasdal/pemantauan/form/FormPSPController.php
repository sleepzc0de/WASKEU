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

     public function index()
    {


        $query = PenggunaanModel::where('kode_satker','330171')->select('*');

        if (request()->ajax()) {
            $dataTable = datatables()->of($query)
                ->addColumn('opsi', function ($query) {
                    // $preview = route('form-psp.show', $query->id);
                    $edit = route('form-psp.edit', $query->id);
                    // $hapus = route('form-psp.destroy', $query->id);
                    return ' <a href="' . $edit . '" class="btn btn-outline-info">Edit</a>
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
                    'no_aset',
                    'rph_buku',
                    'tgl_psp',
                    'status_psp',
                    'no_psp',
                    'status_sesuai_Form1'
    ];

                foreach ($filterableColumns as $column) {
        $dataTable->filterColumn($column, function ($query, $keyword) use ($column) {
            $query->whereRaw("$column LIKE ?", ["%{$keyword}%"]);
        });
    }
                    return $dataTable->make(true);

        }
        $data = PenggunaanModel::where('kode_satker','330171')->get();
        return view('konten-wasdal.pemantauan.formulir.psp.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $simanv2 = Simanv2Model::select('kd_jns_bmn','nm_jns_bmn')->where('kd_satker_6digit','330171')->whereRaw("LEFT(kd_brg,1) in ('2','3','4','5','8') ")->whereNotIn('kd_brg',[ '6070101001',
        '6070201001',
        '6070301001',
        '6070401001',
        '6070501001',])->groupBy('kd_jns_bmn','nm_jns_bmn')->orderBy('kd_jns_bmn','asc')->get();

        $data = [
            'siman' => $simanv2
        ];
        return view('konten-wasdal.pemantauan.formulir.psp.create',compact('data'));
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


        $dataEdit = PenggunaanModel::rightJoin('SIMAN_V2_ALL', 't_pemantauan_penggunaan.kode_satker', '=', 'SIMAN_V2_ALL.kd_satker_6digit')->where('kd_satker_6digit','330171')->where('id_aset',$id)->first();
        //   dd($dataEdit->rph_buku);

         $statusPSPOptions = [
        'SUDAH_PSP' => 'Sudah PSP',
        'BELUM_PSP' => 'Belum PSP'
        ];

        // dd($statusPSPOptions);

        $oldStatusPSP = $dataEdit->status_psp;

        $data = [
            'dataEdit' => $dataEdit,
            'statusPSPOptions' => $statusPSPOptions,
            'oldStatusPSP' => $oldStatusPSP
        ];

        // dd($data['dataEdit']->kd_jns_bmn);

         return view('konten-wasdal.pemantauan.formulir.psp.edit',compact('data'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          try {
            //code...
            $request->validate([
                // 'tgl_psp' => 'date|date_format:Y-m-d',
            'jenis_barang' => 'string',
            'kode_barang' => 'string',
            'nup' => 'string',
            'nilai_buku' => 'numeric',
            'status_psp' => 'in:SUDAH_PSP,BELUM_PSP',
            'nomor_psp' => 'string',
            'tanggal_psp' => 'date_format:Y-m-d',
            'ket_psp' => 'nullable|string'
            ]);

            $status_sesuai_Form1 = ($request->status_psp === 'SUDAH_PSP') ? 'SESUAI' : 'TIDAK SESUAI';

            $data = [
                'jenis_barang' => $request->jenis_barang,
                'kode_barang' => $request->kode_barang,
                'nup' => $request->nup,
                'nilai_buku' => $request->nilai_buku,
                'status_psp' => $request->status_psp,
                'nomor_psp' => $request->nomor_psp,
                'tanggal_psp' => $request->tanggal_psp,
                'ket_psp' => $request->ket_psp,
                'status_sesuai_Form1' => $status_sesuai_Form1,
                'isCompletedForm1' => true
            ];

            $record = PenggunaanModel::rightJoin('SIMAN_V2_ALL', 't_pemantauan_penggunaan.kode_satker', '=', 'SIMAN_V2_ALL.kd_satker_6digit')->where('kd_satker_6digit','330171')->where('id_aset',$id)->firstOrFail();

            $record->create($data);

            return redirect()->back()->with(['success' => 'Data Berhasil Diubah']);
        } catch (Exception $e) {
            return redirect()->back()->with(['failed' => 'Ada Kesalahan Sistem! error :' . $e->getMessage()]);
            //throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
    //       try {

    //          PenggunaanModel::rightJoin('SIMAN_V2_ALL', 't_pemantauan_penggunaan.kode_satker', '=', 'SIMAN_V2_ALL.kd_satker')->where('kd_satker','015050900035519000KD')->where('id_aset',$id)->first()->delete();
    //         return redirect()->route('form-psp.index')->with('success', "Data berhasil dihapus!");
    //     } catch (Exception $e) {
    //         return redirect()->route('form-psp.index')->with(['failed' => 'Data Yang Dihapus Tidak Ada ! error :' . $e->getMessage()]);
    //     }
    // }

}
