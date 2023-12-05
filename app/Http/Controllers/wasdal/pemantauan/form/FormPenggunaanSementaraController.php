<?php

namespace App\Http\Controllers\wasdal\pemantauan\form;

use App\Http\Controllers\Controller;
use App\Models\wasdal\pemantauan\PenggunaanModel;
use App\Models\wasdal\referensi\ref_bentuk_persetujuan;
use App\Models\wasdal\referensi\ref_dok_rp4;
use App\Models\wasdal\referensi\ref_status_pelaksanaan;
use App\Models\wasdal\referensi\ref_status_persetujuan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FormPenggunaanSementaraController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {

        $user = Auth::user();
        $KPB = $user->hasRole('KPB');
        $KANWIL = $user->hasRole('PPB-W');
        $ES1 = $user->hasRole('PPB-E1');
        $PENGGUNA = $user->hasRole('PB');
        $PENGELOLA = $user->hasRole('PENGELOLA');
        $AUDITOR = $user->hasRole('AUDITOR');

        if ($KPB) {
            $query = PenggunaanModel::where('kode_satker', Auth::user()->satker)->where('bentuk_rp4', 'LIKE','sementara')->where('role', 'KPB')->select('*');
            // dd($query);

            if (request()->ajax()) {
                // $dataTable = datatables()->of($query)
                return datatables()->of($query)
                    ->addColumn('opsi', function ($query) {
                        // $preview = route('form-penggunaan-sementara.show', $query->id);
                        $edit = route('form-penggunaan-sementara.edit', $query->id);
                        $hapus = route('form-penggunaan-sementara.destroy', $query->id);
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
            $data = PenggunaanModel::where('kode_satker', Auth::user()->satker)->where('bentuk_rp4', 'LIKE','sementara')->where('role', 'KPB')->get();
        } elseif ($KANWIL) {
            $query = PenggunaanModel::with(['ref_status_psp'])->whereRaw('LEFT(kode_anak_satker,9) = ?', [Auth::user()->satker])->where('status_psp', 'SUDAH_PSP')->where('role', 'PPB-W')->select('*');

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
            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,9) = ?', [Auth::user()->satker])->where('bentuk_rp4', 'LIKE','sementara')->where('role', 'PPB-W')->get();
        } elseif ($ES1) {
            $query = PenggunaanModel::with(['ref_status_psp'])->whereRaw('LEFT(kode_anak_satker,5) = ?', [Auth::user()->satker])->where('status_psp', 'SUDAH_PSP')->where('role', 'PPB-E1')->select('*');

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
            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,5) = ?', [Auth::user()->satker])->where('bentuk_rp4', 'LIKE','sementara')->where('role', 'PPB-E1')->get();
        } elseif ($PENGGUNA) {
            $query = PenggunaanModel::with(['ref_status_psp'])->whereRaw('LEFT(kode_anak_satker,3) = ?', [Auth::user()->satker])->where('status_psp', 'SUDAH_PSP')->where('role', 'PB')->select('*');

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
            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,3) = ?', [Auth::user()->satker])->where('bentuk_rp4', 'LIKE','sementara')->where('role', 'PB')->get();
        } elseif ($PENGELOLA) {
            $query = PenggunaanModel::with(['ref_status_psp'])->whereRaw('LEFT(kode_anak_satker,3) = ?', [Auth::user()->satker])->where('status_psp', 'SUDAH_PSP')->where('role', 'PENGELOLA')->select('*');

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
            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,3) = ?', [Auth::user()->satker])->where('bentuk_rp4', 'LIKE','sementara')->where('role', 'PENGELOLA')->get();
        } elseif ($AUDITOR) {
            $query = PenggunaanModel::with(['ref_status_psp'])->whereRaw('LEFT(kode_anak_satker,3) = ?', [Auth::user()->satker])->where('status_psp', 'SUDAH_PSP')->where('role', 'AUDITOR')->select('*');

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
            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,3) = ?', [Auth::user()->satker])->where('bentuk_rp4', 'LIKE','sementara')->where('role', 'AUDITOR')->get();
        }

        return view('konten-wasdal.pemantauan.formulir.penggunaan-sementara.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $dok_rp4 = ref_dok_rp4::all();
        $status_persetujuan = ref_status_persetujuan::all();
        $bentuk_persetujuan = ref_bentuk_persetujuan::all();
        $status_pelaksanaan = ref_status_pelaksanaan::all();

        $user = Auth::user();
        $KPB = $user->hasRole('KPB');
        $KANWIL = $user->hasRole('PPB-W');
        $ES1 = $user->hasRole('PPB-E1');
        $PENGGUNA = $user->hasRole('PB');
        $PENGELOLA = $user->hasRole('PENGELOLA');
        $AUDITOR = $user->hasRole('AUDITOR');

        if ($KPB) {
            $data = PenggunaanModel::where('kode_satker', Auth::user()->satker)->where('bentuk_rp4', 'LIKE','sementara')->where('role', 'KPB')->findOrFail($id);
        } elseif ($KANWIL) {

            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,9) = ?', [Auth::user()->satker])->where('bentuk_rp4', 'LIKE','sementara')->where('role', 'PPB-W')->findOrFail($id);
        } elseif ($ES1) {
            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,5) = ?', [Auth::user()->satker])->where('bentuk_rp4', 'LIKE','sementara')->where('role', 'PPB-E1')->findOrFail($id);
        } elseif ($PENGGUNA) {
            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,3) = ?', [Auth::user()->satker])->where('bentuk_rp4', 'LIKE','sementara')->where('role', 'PB')->findOrFail($id);
        } elseif ($PENGELOLA) {
            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,3) = ?', [Auth::user()->satker])->where('bentuk_rp4', 'LIKE','sementara')->where('role', 'PENGELOLA')->findOrFail($id);
        } elseif ($AUDITOR) {
            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,3) = ?', [Auth::user()->satker])->where('bentuk_rp4', 'LIKE','sementara')->where('role', 'AUDITOR')->findOrFail($id);
        }
        // $refKodeBarang = ref_kode_barang_simanold::whereRaw("LEFT(KD_BRG,1)=LEFT('{$data->kode_barang}',1)")->get();


        return view('konten-wasdal.pemantauan.formulir.penggunaan-sementara.edit', compact(['data', 'dok_rp4','status_persetujuan','bentuk_persetujuan','status_pelaksanaan']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // VALIDASI DATA
            $request->validate([]);

            $status_sesuai_Form5 = ($request->status_persetujuan != 'TANPA_PERSETUJUAN') ? 'SESUAI' : 'TIDAK SESUAI';

            // TAMPUNGAN REQUEST DATA DARI FORM
            $data = [
                'nilai_buku' => $request->nilai_buku,
                'dok_rp4' => $request->dok_rp4,
                'status_persetujuan' => $request->status_persetujuan,
                'bentuk_persetujuan' => $request->bentuk_persetujuan,
                'ket_persetujuan' => $request->ket_persetujuan,
                'status_pelaksanaan' => $request->status_pelaksanaan,
                'ket_pelaksanaan' => $request->ket_pelaksanaan,
                'status_sesuai_Form5' => $status_sesuai_Form5,
                'isCompletedForm5' => true
            ];


            PenggunaanModel::findOrFail($id)->update($data);
            return redirect()->route('form-penggunaan-sementara.index')->with('success', "Data berhasil diupdate!");
        } catch (Exception $e) {
            return redirect()->route('form-penggunaan-sementara.index')->with(['failed' => 'Data gagal diupdate! error :' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
