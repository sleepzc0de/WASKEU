<?php

namespace App\Http\Controllers\wasdal\pemantauan\form;

use App\Http\Controllers\Controller;
use App\Models\wasdal\pemantauan\PenggunaanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormPenggunaanSementaraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = PenggunaanModel::where('kode_satker', Auth::user()->satker)->whereIn('jenis_barang', ['TANAH','BANGUNAN DAN GEDUNG','RUMAH NEGARA'])->select('*');
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
        $data = PenggunaanModel::where('kode_satker', Auth::user()->satker)->whereIn('jenis_barang', ['TANAH','BANGUNAN DAN GEDUNG','RUMAH NEGARA'])->get();
        return view('konten-wasdal.pemantauan.formulir.tingkat-kesesuaian-sbsk.index', compact('data'));
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
