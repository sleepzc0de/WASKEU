<?php

namespace App\Http\Controllers\wasdal\pemantauan\form;

use App\Http\Controllers\Controller;
use App\Models\wasdal\pemantauan\PenggunaanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\wasdal\referensi\ref_bentuk_persetujuan;
use App\Models\wasdal\referensi\ref_dok_rp4;
use App\Models\wasdal\referensi\ref_jenis_barang_simannew;
use App\Models\wasdal\referensi\ref_kode_barang_simanold;
use App\Models\wasdal\referensi\ref_status_pelaksanaan;
use App\Models\wasdal\referensi\ref_status_persetujuan;
use Exception;

class FormPenggunaanDioperasikanPihakLainController extends Controller
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
            // $dataToInsert = DB::table('SIMAN_V2_ALL AS a')->leftJoin('rp4_penggunaan AS b', 'a.unik', '=', 'b.rp4_penggunaan_uniq')->leftJoin('rp4_pemanfaatan AS c', 'b.rp4_penggunaan_uniq', '=', 'c.rp4_pemanfaatan_uniq')->leftJoin('rp4_pemindahtanganan AS d', 'c.rp4_pemanfaatan_uniq', '=', 'd.rp4_pemindahtanganan_uniq')->leftJoin('rp4_penghapusan AS e', 'd.rp4_pemindahtanganan_uniq', '=', 'e.rp4_penghapusan_uniq')->where('kd_satker_6digit', Auth::user()->satker)->take(5)->get();
            // dd($dataToInsert);
            $query = PenggunaanModel::where('kode_satker', Auth::user()->satker)->where('bentuk_rp4_penggunaan', 'LIKE','%pihak lain%')->where('isRP4Penggunaan',true)->where('role', 'KPB')->select('*');
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
            $data = PenggunaanModel::where('kode_satker', Auth::user()->satker)->where('bentuk_rp4_penggunaan', 'LIKE','%pihak lain%')->where('isRP4Penggunaan',true)->where('role', 'KPB')->get();
            // dd($data);
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
            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,9) = ?', [Auth::user()->satker])->where('bentuk_rp4_penggunaan', 'LIKE','%pihak lain%')->where('isRP4Penggunaan',true)->where('role', 'PPB-W')->get();
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
            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,5) = ?', [Auth::user()->satker])->where('bentuk_rp4_penggunaan', 'LIKE','%pihak lain%')->where('isRP4Penggunaan',true)->where('role', 'PPB-E1')->get();
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
            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,3) = ?', [Auth::user()->satker])->where('bentuk_rp4_penggunaan', 'LIKE','%pihak lain%')->where('isRP4Penggunaan',true)->where('role', 'PB')->get();
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
            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,3) = ?', [Auth::user()->satker])->where('bentuk_rp4_penggunaan', 'LIKE','%pihak lain%')->where('isRP4Penggunaan',true)->where('role', 'PENGELOLA')->get();
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
            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,3) = ?', [Auth::user()->satker])->where('bentuk_rp4_penggunaan', 'LIKE','%pihak lain%')->where('isRP4Penggunaan',true)->where('role', 'AUDITOR')->get();
        }


        return view('konten-wasdal.pemantauan.formulir.penggunaan-dioperasikan-pihak-lain.index', compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dok_rp4 = ref_dok_rp4::all();
        $status_persetujuan = ref_status_persetujuan::all();
        $bentuk_persetujuan = ref_bentuk_persetujuan::all();
        $status_pelaksanaan = ref_status_pelaksanaan::all();
        $refKodeBarang = ref_kode_barang_simanold::all();
        $refJenisBarang = ref_jenis_barang_simannew::all();

        $user = Auth::user();
        $KPB = $user->hasRole('KPB');
        $KANWIL = $user->hasRole('PPB-W');
        $ES1 = $user->hasRole('PPB-E1');
        $PENGGUNA = $user->hasRole('PB');
        $PENGELOLA = $user->hasRole('PENGELOLA');
        $AUDITOR = $user->hasRole('AUDITOR');

        if ($KPB) {
            $data = PenggunaanModel::where('kode_satker', Auth::user()->satker)->where('bentuk_rp4_penggunaan', 'LIKE','%pihak lain%')->where('isRP4Penggunaan',true)->where('role', 'KPB')->get();
        } elseif ($KANWIL) {

            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,9) = ?', [Auth::user()->satker])->where('bentuk_rp4_penggunaan', 'LIKE','%pihak lain%')->where('isRP4Penggunaan',true)->where('role', 'PPB-W')->get();
        } elseif ($ES1) {
            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,5) = ?', [Auth::user()->satker])->where('bentuk_rp4_penggunaan', 'LIKE','%pihak lain%')->where('isRP4Penggunaan',true)->where('role', 'PPB-E1')->get();
        } elseif ($PENGGUNA) {
            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,3) = ?', [Auth::user()->satker])->where('bentuk_rp4_penggunaan', 'LIKE','%pihak lain%')->where('isRP4Penggunaan',true)->where('role', 'PB')->get();
        } elseif ($PENGELOLA) {
            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,3) = ?', [Auth::user()->satker])->where('bentuk_rp4_penggunaan', 'LIKE','%pihak lain%')->where('isRP4Penggunaan',true)->where('role', 'PENGELOLA')->get();
        } elseif ($AUDITOR) {
            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,3) = ?', [Auth::user()->satker])->where('bentuk_rp4_penggunaan', 'LIKE','%pihak lain%')->where('isRP4Penggunaan',true)->where('role', 'AUDITOR')->get();
        }

        // $refKodeBarang = ref_kode_barang_simanold::whereRaw("LEFT(KD_BRG,1)=LEFT('{$data->kode_barang}',1)")->get();


        return view('konten-wasdal.pemantauan.formulir.penggunaan-dioperasikan-pihak-lain.create', compact(['data', 'dok_rp4','status_persetujuan','bentuk_persetujuan','status_pelaksanaan','refKodeBarang','refJenisBarang']));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // VALIDASI DATA
            $request->validate([]);

            $user = Auth::user();
            $role = '';

            $status_sesuai_Form5 = ($request->status_persetujuan != 'TANPA_PERSETUJUAN') ? 'SESUAI' : 'TIDAK SESUAI';

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
            if (substr($user->kode_satker, 0, 5) === '01501') {
                $ue1 = 'SEKRETARIAT JENDERAL';
            } elseif (substr($user->kode_satker, 0, 5) === '01502') {
                $ue1 = 'INSPEKTORAT JENDERAL';
            } elseif (substr($user->kode_satker, 0, 5) === '01503') {
                $ue1 = 'DIREKTORAT JENDERAL ANGGARAN';
            } elseif (substr($user->kode_satker, 0, 5) === '01504') {
                $ue1 = 'DIREKTORAT JENDERAL PAJAK';
            } elseif (substr($user->kode_satker, 0, 5) === '01505') {
                $ue1 = 'DIREKTORAT JENDERAL BEA DAN CUKAI';
            } elseif (substr($user->kode_satker, 0, 5) === '01506') {
                $ue1 = 'DIREKTORAT JENDERAL PERIMBANGAN KEUANGAN';
            } elseif (substr($user->kode_satker, 0, 5) === '01507') {
                $ue1 = 'DITJEN PENGELOLAAN PEMBIAYAAN DAN RISIKO';
            } elseif (substr($user->kode_satker, 0, 5) === '01508') {
                $ue1 = 'DIREKTORAT JENDERAL PERBENDAHARAAN';
            } elseif (substr($user->kode_satker, 0, 5) === '01509') {
                $ue1 = 'DIREKTORAT JENDERAL KEKAYAAN NEGARA';
            } elseif (substr($user->kode_satker, 0, 5) === '01511') {
                $ue1 = 'BADAN PENDIDIKAN DAN PELATIHAN KEUANGAN';
            } elseif (substr($user->kode_satker, 0, 5) === '01512') {
                $ue1 = 'BADAN KEBIJAKAN FISKAL';
            } elseif (substr($user->kode_satker, 0, 5) === '01513') {
                $ue1 = 'LEMBAGA NATIONAL SINGLE WINDOW';
            } elseif (substr($user->kode_satker, 0, 5) === '01599') {
                $ue1 = 'AUDITOR';
            } else {
                $ue1 = 'KEMENTERIAN KEUANGAN';
            }
            // TAMPUNGAN REQUEST DATA DARI FORM

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
                'dok_rp4' => $request->dok_rp4,
                'status_persetujuan' => $request->status_persetujuan,
                'bentuk_persetujuan' => $request->bentuk_persetujuan,
                'ket_persetujuan' => $request->ket_persetujuan,
                'status_pelaksanaan' => $request->status_pelaksanaan,
                'ket_pelaksanaan' => $request->ket_pelaksanaan,
                'status_sesuai_Form5' => $status_sesuai_Form5,
                'bentuk_rp4_penggunaan' => 'Penggunaan BMN untuk dioperasikan oleh pihak lain',
                'isCompletedForm5' => true,
                'isRP4Penggunaan' => true
        ]);

            return redirect()->route('form-operasi-pihak-lain.index')->with('success', "Data berhasil ditambah!");
        } catch (Exception $e) {
            return redirect()->route('form-operasi-pihak-lain.index')->with(['failed' => 'Data gagal ditambah! error :' . $e->getMessage()]);
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
            $data = PenggunaanModel::where('kode_satker', Auth::user()->satker)->where('bentuk_rp4_penggunaan', 'LIKE','%pihak lain%')->where('isRP4Penggunaan',true)->where('role', 'KPB')->findOrFail($id);
        } elseif ($KANWIL) {

            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,9) = ?', [Auth::user()->satker])->where('bentuk_rp4_penggunaan', 'LIKE','%pihak lain%')->where('isRP4Penggunaan',true)->where('role', 'PPB-W')->findOrFail($id);
        } elseif ($ES1) {
            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,5) = ?', [Auth::user()->satker])->where('bentuk_rp4_penggunaan', 'LIKE','%pihak lain%')->where('isRP4Penggunaan',true)->where('role', 'PPB-E1')->findOrFail($id);
        } elseif ($PENGGUNA) {
            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,3) = ?', [Auth::user()->satker])->where('bentuk_rp4_penggunaan', 'LIKE','%pihak lain%')->where('isRP4Penggunaan',true)->where('role', 'PB')->findOrFail($id);
        } elseif ($PENGELOLA) {
            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,3) = ?', [Auth::user()->satker])->where('bentuk_rp4_penggunaan', 'LIKE','%pihak lain%')->where('isRP4Penggunaan',true)->where('role', 'PENGELOLA')->findOrFail($id);
        } elseif ($AUDITOR) {
            $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,3) = ?', [Auth::user()->satker])->where('bentuk_rp4_penggunaan', 'LIKE','%pihak lain%')->where('isRP4Penggunaan',true)->where('role', 'AUDITOR')->findOrFail($id);
        }



        return view('konten-wasdal.pemantauan.formulir.penggunaan-dioperasikan-pihak-lain.edit', compact(['data', 'dok_rp4','status_persetujuan','bentuk_persetujuan','status_pelaksanaan','refKodeBarang']));
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
             return redirect()->route('penggunaan-dioperasikan-pihak-lain.index')->with('success', "Data berhasil diupdate!");
         } catch (Exception $e) {
             return redirect()->route('penggunaan-dioperasikan-pihak-lain.index')->with(['failed' => 'Data gagal diupdate! error :' . $e->getMessage()]);
         }
     }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $datas = [
                'isDeletedForm6' => true,
            ];

            $user = Auth::user();
            $KPB = $user->hasRole('KPB');
            $KANWIL = $user->hasRole('PPB-W');
            $ES1 = $user->hasRole('PPB-E1');
            $PENGGUNA = $user->hasRole('PB');
            $PENGELOLA = $user->hasRole('PENGELOLA');
            $AUDITOR = $user->hasRole('AUDITOR');


            if ($KPB) {
                $data = PenggunaanModel::where('kode_satker', Auth::user()->satker)->where('bentuk_rp4_penggunaan', 'LIKE','%pihak lain%')->where('isRP4Penggunaan',true)->where('role', 'KPB')->findOrFail($id);
            } elseif ($KANWIL) {

                $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,9) = ?', [Auth::user()->satker])->where('bentuk_rp4_penggunaan', 'LIKE','%pihak lain%')->where('isRP4Penggunaan',true)->where('role', 'PPB-W')->findOrFail($id);
            } elseif ($ES1) {
                $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,5) = ?', [Auth::user()->satker])->where('bentuk_rp4_penggunaan', 'LIKE','%pihak lain%')->where('isRP4Penggunaan',true)->where('role', 'PPB-E1')->findOrFail($id);
            } elseif ($PENGGUNA) {
                $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,3) = ?', [Auth::user()->satker])->where('bentuk_rp4_penggunaan', 'LIKE','%pihak lain%')->where('isRP4Penggunaan',true)->where('role', 'PB')->findOrFail($id);
            } elseif ($PENGELOLA) {
                $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,3) = ?', [Auth::user()->satker])->where('bentuk_rp4_penggunaan', 'LIKE','%pihak lain%')->where('isRP4Penggunaan',true)->where('role', 'PENGELOLA')->findOrFail($id);
            } elseif ($AUDITOR) {
                $data = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,3) = ?', [Auth::user()->satker])->where('bentuk_rp4_penggunaan', 'LIKE','%pihak lain%')->where('isRP4Penggunaan',true)->where('role', 'AUDITOR')->findOrFail($id);
            }

            // PenggunaanModel::findOrFail($id)->update($data);
            // PenggunaanModel::findOrFail($id)->delete($data);
            return redirect()->route('penggunaan-dioperasikan-pihak-lain.index')->with('success', "Data berhasil dihapus!");
        } catch (Exception $e) {
            return redirect()->route('penggunaan-dioperasikan-pihak-lain.index')->with(['failed' => 'Data Yang Dihapus Tidak Ada ! error :' . $e->getMessage()]);
        }
    }
}
