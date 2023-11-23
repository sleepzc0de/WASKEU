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
use Illuminate\Support\Facades\Auth;

class FormKesesuaianPSPController extends Controller

{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {


        $query = PenggunaanModel::where('kode_satker', Auth::user()->satker)->where('status_psp', 'SUDAH_PSP')->select('*');
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
        $data = PenggunaanModel::where('kode_satker', Auth::user()->satker)->get();
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
        return null;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $kesesuaian_psp = ref_kesesuaian_psp::all();
        $data = PenggunaanModel::where('kode_satker', Auth::user()->satker)->where('status_psp', 'SUDAH_PSP')->findOrFail($id);
        $refKodeBarang = ref_kode_barang_simanold::whereRaw("LEFT(KD_BRG,1)=LEFT('{$data->kode_barang}',1)")->get();


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

            $status_sesuai_Form2 = ($request->kesesuaian_psp === 'SESUAI_PSP') ? 'SESUAI' : 'TIDAK SESUAI';

            $digunakan_sebagai = ($request->kesesuaian_psp === 'SESUAI_PSP') ? '' : $request->digunakan_sebagai;

            $rencana_alih_fungsi = ($request->kesesuaian_psp === 'SESUAI_PSP') ? '' : $request->rencana_alih_fungsi;



            // TAMPUNGAN REQUEST DATA DARI FORM
            $data = [
                'kesesuaian_psp' => $request->kesesuaian_psp,
                'digunakan_sebagai' => $digunakan_sebagai,
                'rencana_alih_fungsi' => $rencana_alih_fungsi,
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
            $data = [
                'isDeletedForm2' => true,
            ];
            PenggunaanModel::findOrFail($id)->update($data);
            PenggunaanModel::findOrFail($id)->delete($data);
            return redirect()->route('form-kesesuaian-psp.index')->with('success', "Data berhasil dihapus!");
        } catch (Exception $e) {
            return redirect()->route('form-kesesuaian-psp.index')->with(['failed' => 'Data Yang Dihapus Tidak Ada ! error :' . $e->getMessage()]);
        }
    }
}
