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
        $data = PenggunaanModel::where('kode_satker', Auth::user()->satker)->where('status_psp', 'SUDAH_PSP')->get();
        return view('konten-wasdal.pemantauan.formulir.kesesuaian-psp.index', compact('data'));
    }

    public function create()
    {
        $kesesuaian_psp = ref_kesesuaian_psp::all();
        $refKodeBarang = ref_kode_barang_simanold::all();
        $refJenisBarang = ref_jenis_barang_simannew::all();
        $data = PenggunaanModel::with(['ref_kesesuaian_psp'])->where('kode_satker', Auth::user()->satker)->where('status_psp', 'SUDAH_PSP')->get();


        return view('konten-wasdal.pemantauan.formulir.kesesuaian-psp.create', compact(['data', 'kesesuaian_psp', 'refKodeBarang', 'refJenisBarang']));
    }


    public function store(Request $request)
    {
        try {
            //code...
            $request->validate([
                // 'tanggal_psp' => 'date|date_format:Y-m-d',
            ]);

            $status_sesuai_Form2 = ($request->kesesuaian_psp === 'SESUAI_PSP') ? 'SESUAI' : 'TIDAK SESUAI';

            // LOGIKA WASDAL GENERATE DATA SIMAN V2
            $user = Auth::user();
            $role = '';

            if ($user->id_satker === 'ANAK SATKER' || $user->id_satker === 'INDUK SATKER') {
                $role = 'KPB';
            } elseif ($user->id_satker === 'KANWIL') {
                $role = 'PPB-W';
            } elseif ($user->id_satker === 'ES1') {
                $role = 'PPB-E1';
            } elseif ($user->id_satker === 'PENGGUNA') {
                $role = 'PB';
            } elseif ($user->id_satker === 'PENGELOLA') {
                $role = 'PENGELOLA';
            } elseif ($user->id_satker === 'AUDITOR') {
                $role = 'AUDITOR';
            } else {
                $role = 'TAMU';
            }

            // inputan ue1
            // substr(Auth::user()->kode_satker,0,5);
            if (substr($user->kode_satker,0,5) === '01501') {
                $ue1 = 'SEKRETARIAT JENDERAL';
            } elseif (substr($user->kode_satker,0,5) === '01502') {
                $ue1 = 'INSPEKTORAT JENDERAL';
            } elseif (substr($user->kode_satker,0,5) === '01503') {
                $ue1 = 'DIREKTORAT JENDERAL ANGGARAN';
            } elseif (substr($user->kode_satker,0,5) === '01504') {
                $ue1 = 'DIREKTORAT JENDERAL PAJAK';
            } elseif (substr($user->kode_satker,0,5) === '01505') {
                $ue1 = 'DIREKTORAT JENDERAL BEA DAN CUKAI';
            } elseif (substr($user->kode_satker,0,5) === '01506') {
                $ue1 = 'DIREKTORAT JENDERAL PERIMBANGAN KEUANGAN';
            } elseif (substr($user->kode_satker,0,5) === '01507') {
                $ue1 = 'DITJEN PENGELOLAAN PEMBIAYAAN DAN RISIKO';
            } elseif (substr($user->kode_satker,0,5) === '01508') {
                $ue1 = 'DIREKTORAT JENDERAL PERBENDAHARAAN';
            } elseif (substr($user->kode_satker,0,5) === '01509') {
                $ue1 = 'DIREKTORAT JENDERAL KEKAYAAN NEGARA';
            } elseif (substr($user->kode_satker,0,5) === '01511') {
                $ue1 = 'BADAN PENDIDIKAN DAN PELATIHAN KEUANGAN';
            } elseif (substr($user->kode_satker,0,5) === '01512') {
                $ue1 = 'BADAN KEBIJAKAN FISKAL';
            } elseif (substr($user->kode_satker,0,5) === '01513') {
                $ue1 = 'LEMBAGA NATIONAL SINGLE WINDOW';
            } elseif (substr($user->kode_satker,0,5) === '01599') {
                $ue1 = 'AUDITOR';
            }else {
                $ue1 = 'KEMENTERIAN KEUANGAN';
            }


            $user =  PenggunaanModel::create([
                'tahun' => session('tahun_wasdal'),
                'periode' => session('periode_wasdal'),
                'jenis_pemantauan' => session('jenis_pemantauan_wasdal'),
                'ue1' => $ue1,
                'nama_satker' => Auth::user()->nama_pegawai,
                'kode_satker' => Auth::user()->satker,
                'nama_anak_satker' => Auth::user()->nama_pegawai,
                'kode_anak_satker' => Auth::user()->kode_satker,
                'role' => $role,
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


    public function show(string $id)
    {
        return null;
    }

    public function edit(string $id)
    {

        $kesesuaian_psp = ref_kesesuaian_psp::all();
        $data = PenggunaanModel::where('kode_satker', Auth::user()->satker)->where('status_psp', 'SUDAH_PSP')->findOrFail($id);
        $refKodeBarang = ref_kode_barang_simanold::whereRaw("LEFT(KD_BRG,1)=LEFT('{$data->kode_barang}',1)")->get();


        return view('konten-wasdal.pemantauan.formulir.kesesuaian-psp.edit', compact(['data', 'kesesuaian_psp', 'refKodeBarang']));
    }

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
            return redirect()->route('form-kesesuaian-psp.index')->with('success', "Data berhasil diupdate!");
        } catch (Exception $e) {
            return redirect()->route('form-kesesuaian-psp.index')->with(['failed' => 'Data gagal diupdate! error :' . $e->getMessage()]);
        }
    }

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
