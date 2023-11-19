<?php

namespace App\Http\Controllers\wasdal\pemantauan\periodik;

use App\Http\Controllers\Controller;
use App\Models\wasdal\pemantauan\PenggunaanModel;
use Exception;
use Illuminate\Http\Request;

class PemantauanPenggunaanPeriodikController extends Controller
{
    public function index(){

        $query = PenggunaanModel::where('kode_satker','015050900035519000KD')->select('*');
          if (request()->ajax()) {
            return datatables()->of($query)
               ->addColumn('opsi', function ($query) {
                    // $preview = route('periodik-penggunaan.show', $query->id);
                    $edit = route('periodik-penggunaan.edit', $query->id);
                    $hapus = route('periodik-penggunaan.destroy', $query->id);
                    return '
                    <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="' . $edit . '" class="btn btn-outline-info">Edit</a>
                    <form action="' . $hapus . '" method="POST">
													' . @csrf_field() . '
													' . @method_field('DELETE') . '
					<button type="submit" name="submit" class="btn btn-outline-danger">Hapus</button>
					</form>
                    </div>
                ';
                })



                ->rawColumns(['opsi'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('konten-wasdal.pemantauan.periodik.penggunaan.index');
    }

    public function destroy(string $id)
    {
        try {

            PenggunaanModel::findOrFail($id)->delete();
            return redirect()->route('periodik-penggunaan.index')->with('success', "Data berhasil dihapus!");
        } catch (Exception $e) {
            return redirect()->route('periodik-penggunaan.index')->with(['failed' => 'Data Yang Dihapus Tidak Ada ! error :' . $e->getMessage()]);
        }
    }
}
