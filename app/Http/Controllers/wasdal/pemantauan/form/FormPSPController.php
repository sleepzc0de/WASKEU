<?php

namespace App\Http\Controllers\wasdal\pemantauan\form;

use App\Http\Controllers\Controller;
use App\Models\wasdal\pemantauan\PenggunaanModel;
use App\Models\wasdal\referensi\ref_jenis_barang_simannew;
use App\Models\wasdal\referensi\ref_kode_barang_simanold;
use App\Models\wasdal\referensi\ref_status_psp;
use App\Models\wasdal\siman\Simanv2Model;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Models\User;

class FormPSPController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {

        // dd(Hash::make('W4sd4lK3u!@#!@#!@#1Nd0n35!A'));

        $query = PenggunaanModel::with(['ref_status_psp'])->where('kode_satker', Auth::user()->satker)->select('*');

        if (request()->ajax()) {
            // $dataTable = datatables()->of($query)
             return datatables()->of($query)
                ->addColumn('opsi', function ($query) {
                    // $preview = route('form-psp.show', $query->id);
                    $edit = route('form-psp.edit', $query->id);
                    $hapus = route('form-psp.destroy', $query->id);
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
        return view('konten-wasdal.pemantauan.formulir.psp.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status_psp = ref_status_psp::all();
        $refKodeBarang = ref_kode_barang_simanold::all();
        $refJenisBarang = ref_jenis_barang_simannew::all();
        $data = PenggunaanModel::with(['ref_status_psp'])->where('kode_satker', Auth::user()->satker)->get();


        return view('konten-wasdal.pemantauan.formulir.psp.create', compact(['data', 'status_psp', 'refKodeBarang', 'refJenisBarang']));
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

            $status_sesuai_Form1 = ($request->status_psp === 'SUDAH_PSP') ? 'SESUAI' : 'TIDAK SESUAI';

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
                'status_psp' => $request->status_psp,
                'no_psp' => $request->no_psp,
                'tanggal_psp' => $request->tanggal_psp,
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

        $status_psp = ref_status_psp::all();

        $data = PenggunaanModel::with(['ref_status_psp'])->where('kode_satker', Auth::user()->satker)->findOrFail($id);
        // dd($status_psp);

        return view('konten-wasdal.pemantauan.formulir.psp.edit', compact(['data', 'status_psp']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // VALIDASI DATA
            $request->validate([]);

            $status_sesuai_Form1 = ($request->status_psp === 'SUDAH_PSP') ? 'SESUAI' : 'TIDAK SESUAI';

            // TAMPUNGAN REQUEST DATA DARI FORM
            $data = [
                'status_psp' => $request->status_psp,
                'nomor_psp' => $request->nomor_psp,
                'tanggal_psp' => $request->tanggal_psp,
                'ket_psp' => $request->ket_psp,
                'status_sesuai_Form1' => $status_sesuai_Form1,
                'isCompletedForm1' => true
            ];


            PenggunaanModel::findOrFail($id)->update($data);
            return redirect()->route('form-psp.index')->with('success', "Data berhasil diupdate!");
        } catch (Exception $e) {
            return redirect()->route('form-psp.index')->with(['failed' => 'Data gagal diupdate! error :' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = [
                'isDeletedForm1' => true,
            ];
            PenggunaanModel::findOrFail($id)->update($data);
            PenggunaanModel::findOrFail($id)->delete($data);
            return redirect()->route('form-psp.index')->with('success', "Data berhasil dihapus!");
        } catch (Exception $e) {
            return redirect()->route('form-psp.index')->with(['failed' => 'Data Yang Dihapus Tidak Ada ! error :' . $e->getMessage()]);
        }
    }
}
