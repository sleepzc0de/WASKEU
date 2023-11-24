<?php

namespace App\Http\Controllers\wasdal\pemantauan\form;

use App\Http\Controllers\Controller;
use App\Models\wasdal\pemantauan\PenggunaanModel;
use App\Models\wasdal\referensi\ref_rencana;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormBMNTidakDigunakanController extends Controller
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
            $query = PenggunaanModel::where('kode_satker', Auth::user()->satker)->where('status_penggunaan', '06')->where('role', 'KPB')->select('*');
            // dd($query);

            if (request()->ajax()) {
                // $dataTable = datatables()->of($query)
                return datatables()->of($query)
                    ->addColumn('opsi', function ($query) {
                        // $preview = route('form-bmn-tidak-digunakan.show', $query->id);
                        $edit = route('form-bmn-tidak-digunakan.edit', $query->id);
                        $hapus = route('form-bmn-tidak-digunakan.destroy', $query->id);
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
            $data = PenggunaanModel::where('kode_satker', Auth::user()->satker)->where('status_penggunaan', '06')->where('role', 'KPB')->get();
        } elseif ($KANWIL) {

            $query = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,9) = ?', [Auth::user()->satker])->where('status_penggunaan', '06')->where('role', 'PPB-W')->select('*');
            // dd($query);

            if (request()->ajax()) {
                // $dataTable = datatables()->of($query)
                return datatables()->of($query)
                    ->addColumn('opsi', function ($query) {
                        // $preview = route('form-bmn-tidak-digunakan.show', $query->id);
                        $edit = route('form-bmn-tidak-digunakan.edit', $query->id);
                        $hapus = route('form-bmn-tidak-digunakan.destroy', $query->id);
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
            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,9) = ?', [Auth::user()->satker])->where('status_penggunaan', '06')->where('role', 'PPB-W')->get();

        } elseif ($ES1) {

            $query = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,5) = ?', [Auth::user()->satker])->where('status_penggunaan', '06')->where('role', 'PPB-E1')->select('*');
            // dd($query);

            if (request()->ajax()) {
                // $dataTable = datatables()->of($query)
                return datatables()->of($query)
                    ->addColumn('opsi', function ($query) {
                        // $preview = route('form-bmn-tidak-digunakan.show', $query->id);
                        $edit = route('form-bmn-tidak-digunakan.edit', $query->id);
                        $hapus = route('form-bmn-tidak-digunakan.destroy', $query->id);
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
            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,5) = ?', [Auth::user()->satker])->where('status_penggunaan', '06')->where('role', 'PPB-E1')->get();

        } elseif ($PENGGUNA) {
            $query = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,3) = ?', [Auth::user()->satker])->where('status_penggunaan', '06')->where('role', 'PB')->select('*');
            // dd($query);

            if (request()->ajax()) {
                // $dataTable = datatables()->of($query)
                return datatables()->of($query)
                    ->addColumn('opsi', function ($query) {
                        // $preview = route('form-bmn-tidak-digunakan.show', $query->id);
                        $edit = route('form-bmn-tidak-digunakan.edit', $query->id);
                        $hapus = route('form-bmn-tidak-digunakan.destroy', $query->id);
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
            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,3) = ?', [Auth::user()->satker])->where('status_penggunaan', '06')->where('role', 'PB')->get();

        } elseif ($PENGELOLA) {
            $query = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,3) = ?', [Auth::user()->satker])->where('status_penggunaan', '06')->where('role', 'PENGELOLA')->select('*');
            // dd($query);

            if (request()->ajax()) {
                // $dataTable = datatables()->of($query)
                return datatables()->of($query)
                    ->addColumn('opsi', function ($query) {
                        // $preview = route('form-bmn-tidak-digunakan.show', $query->id);
                        $edit = route('form-bmn-tidak-digunakan.edit', $query->id);
                        $hapus = route('form-bmn-tidak-digunakan.destroy', $query->id);
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
            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,3) = ?', [Auth::user()->satker])->where('status_penggunaan', '06')->where('role', 'PENGELOLA')->get();

        } elseif ($AUDITOR) {

            $query = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,3) = ?', [Auth::user()->satker])->where('status_penggunaan', '06')->where('role', 'AUDITOR')->select('*');
            // dd($query);

            if (request()->ajax()) {
                // $dataTable = datatables()->of($query)
                return datatables()->of($query)
                    ->addColumn('opsi', function ($query) {
                        // $preview = route('form-bmn-tidak-digunakan.show', $query->id);
                        $edit = route('form-bmn-tidak-digunakan.edit', $query->id);
                        $hapus = route('form-bmn-tidak-digunakan.destroy', $query->id);
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
            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,3) = ?', [Auth::user()->satker])->where('status_penggunaan', '06')->where('role', 'AUDITOR')->get();

        }

        return view('konten-wasdal.pemantauan.formulir.bmn-tidak-digunakan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

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
        $user = Auth::user();
        $KPB = $user->hasRole('KPB');
        $KANWIL = $user->hasRole('PPB-W');
        $ES1 = $user->hasRole('PPB-E1');
        $PENGGUNA = $user->hasRole('PB');
        $PENGELOLA = $user->hasRole('PENGELOLA');
        $AUDITOR = $user->hasRole('AUDITOR');


        if ($KPB) {

            $data = PenggunaanModel::where('kode_satker', Auth::user()->satker)->where('status_penggunaan', '06')->where('role', 'KPB')->findOrFail($id);
        }
        elseif ($KANWIL) {
            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,9) = ?', [Auth::user()->satker])->where('status_penggunaan', '06')->where('role', 'PPB-W')->findOrFail($id);
        }
        elseif ($ES1) {
            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,5) = ?', [Auth::user()->satker])->where('status_penggunaan', '06')->where('role', 'PPB-E1')->findOrFail($id);
        }
        elseif ($PENGGUNA) {
            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,3) = ?', [Auth::user()->satker])->where('status_penggunaan', '06')->where('role', 'PB')->findOrFail($id);
        }
        elseif ($PENGELOLA) {
            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,3) = ?', [Auth::user()->satker])->where('status_penggunaan', '06')->where('role', 'PENGELOLA')->findOrFail($id);
        }
        elseif ($AUDITOR) {
            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,3) = ?', [Auth::user()->satker])->where('status_penggunaan', '06')->where('role', 'AUDITOR')->findOrFail($id);
        }

        $rencana = ref_rencana::all();

        return view('konten-wasdal.pemantauan.formulir.bmn-tidak-digunakan.edit', compact(['data','rencana']));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // VALIDASI DATA
            $request->validate([]);

                // TAMPUNGAN REQUEST DATA DARI FORM
            $data = [
                'rencana' => $request->rencana,
                'nilai_buku' => $request->nilai_buku,
            ];

            PenggunaanModel::findOrFail($id)->update($data);
            return redirect()->route('form-bmn-tidak-digunakan.index')->with('success', "Data berhasil diupdate!");
        } catch (Exception $e) {
            return redirect()->route('form-bmn-tidak-digunakan.index')->with(['failed' => 'Data gagal diupdate! error :' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $datas = [
                'isDeletedForm3' => true,
            ];

            $user = Auth::user();
            $KPB = $user->hasRole('KPB');
            $KANWIL = $user->hasRole('PPB-W');
            $ES1 = $user->hasRole('PPB-E1');
            $PENGGUNA = $user->hasRole('PB');
            $PENGELOLA = $user->hasRole('PENGELOLA');
            $AUDITOR = $user->hasRole('AUDITOR');


            if ($KPB) {

                $data = PenggunaanModel::where('kode_satker', Auth::user()->satker)->where('status_penggunaan', '06')->where('role', 'KPB')->findOrFail($id);
                $data->update($datas);
                $data->delete($datas);
            }
            elseif ($KANWIL) {
                $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,9) = ?', [Auth::user()->satker])->where('status_penggunaan', '06')->where('role', 'PPB-W')->findOrFail($id);
                 $data->update($datas);
                $data->delete($datas);
            }
            elseif ($ES1) {
                $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,5) = ?', [Auth::user()->satker])->where('status_penggunaan', '06')->where('role', 'PPB-E1')->findOrFail($id);
                 $data->update($datas);
                $data->delete($datas);
            }
            elseif ($PENGGUNA) {
                $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,3) = ?', [Auth::user()->satker])->where('status_penggunaan', '06')->where('role', 'PB')->findOrFail($id);
                 $data->update($datas);
                $data->delete($datas);
            }
            elseif ($PENGELOLA) {
                $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,3) = ?', [Auth::user()->satker])->where('status_penggunaan', '06')->where('role', 'PENGELOLA')->findOrFail($id);
                 $data->update($datas);
                $data->delete($datas);
            }
            elseif ($AUDITOR) {
                $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,3) = ?', [Auth::user()->satker])->where('status_penggunaan', '06')->where('role', 'AUDITOR')->findOrFail($id);
                 $data->update($datas);
                $data->delete($datas);
            }
            // PenggunaanModel::findOrFail($id)->update($data);
            // PenggunaanModel::findOrFail($id)->delete($data);
            return redirect()->route('form-bmn-tidak-digunakan.index')->with('success', "Data berhasil dihapus!");
        } catch (Exception $e) {
            return redirect()->route('form-bmn-tidak-digunakan.index')->with(['failed' => 'Data Yang Dihapus Tidak Ada ! error :' . $e->getMessage()]);
        }
    }
}
