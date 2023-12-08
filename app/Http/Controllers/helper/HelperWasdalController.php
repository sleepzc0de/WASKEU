<?php

namespace App\Http\Controllers\helper;

use App\Http\Controllers\Controller;
use App\Models\wasdal\pemantauan\PenggunaanModel;
use App\Models\wasdal\referensi\ref_kode_barang_simanold;
use App\Models\wasdal\siman\Simanv2Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HelperWasdalController extends Controller
{

    public function GenerateDataPemantauanPenggunaan()
    {
        try {

            $countStatusPenggunaan06 = Simanv2Model::where('kd_status', '06')
                ->where('kd_satker_6digit', Auth::user()->satker)
                ->count();

            $isCompletedForm3 = $countStatusPenggunaan06 === 0 ? true : false;

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

            // LOGIC ROLE GENERATE

            $KPB = $user->hasRole('KPB');
            $KANWIL = $user->hasRole('PPB-W');
            $ES1 = $user->hasRole('PPB-E1');
            $PENGGUNA = $user->hasRole('PB');
            $PENGELOLA = $user->hasRole('PENGELOLA');
            $AUDITOR = $user->hasRole('AUDITOR');

            if ($KPB) {

                $dataToInsert = DB::table('SIMAN_V2_ALL AS a')->leftJoin('rp4_penggunaan AS b', 'a.unik', '=', 'b.rp4_penggunaan_uniq')->leftJoin('rp4_pemanfaatan AS c', 'b.rp4_penggunaan_uniq', '=', 'c.rp4_pemanfaatan_uniq')->leftJoin('rp4_pemindahtanganan AS d', 'c.rp4_pemanfaatan_uniq', '=', 'd.rp4_pemindahtanganan_uniq')->leftJoin('rp4_penghapusan AS e', 'd.rp4_pemindahtanganan_uniq', '=', 'e.rp4_penghapusan_uniq')->where('kd_satker_6digit', Auth::user()->satker)->get();
                foreach ($dataToInsert as $data) {

                    $identifier = [
                        'unik' => $data->unik
                    ];

                    // Logika untuk isRP4Penggunaan dan isRPPenghapusan
                    $isRP4Penggunaan = !empty($data->rp4_penggunaan_uniq) ? true : false;
                    $isRP4Pemanfaatan = !empty($data->rp4_pemanfaatan_uniq) ? true : false;
                    $isRP4Pemindahtanganan = !empty($data->rp4_pemindahtanganan_uniq) ? true : false;
                    $isRPPenghapusan = !empty($data->rp4_penghapusan_uniq) ? true : false;


                    $newData = [
                        'isGenerated' => true,
                        'tahun' => session('tahun_wasdal'),
                        'periode' => session('periode_wasdal'),
                        'jenis_pemantauan' => session('jenis_pemantauan_wasdal'),
                        'role' => $role,
                        'ue1' => $data->ur_eselon1,
                        'nama_satker' => $data->ur_satker,
                        'kode_satker' => $data->kd_satker_6digit,
                        'nama_anak_satker' => $data->ur_satker,
                        'kode_anak_satker' => $data->kd_satker,
                        'jenis_barang' => $data->nm_jns_bmn,
                        'nama_barang' => $data->ur_sskel,
                        'kode_barang' => $data->kd_brg,
                        'nup' => $data->no_aset,
                        'nilai_buku' => $data->rph_buku,
                        'tanggal_psp' => $data->tgl_psp,
                        'nomor_psp' => $data->no_psp,
                        'status_penggunaan' => $data->kd_status,
                        'luas_sbsk' => $data->sbsk,
                        'luas_ts_db' => $data->luas,
                        'bentuk_rp4_penggunaan' => $data->rp4_penggunaan_bentuk,
                        'bentuk_rp4_pemanfaatan' => $data->rp4_pemanfaatan_bentuk,
                        'bentuk_rp4_pemindahtanganan' => $data->rp4_pemindahtanganan_bentuk,
                        'bentuk_rp4_penghapusan' => $data->rp4_penghapusan_alasan_rencana_penghapusan,
                        'isRP4Penggunaan' => $isRP4Penggunaan,
                        'isRP4Pemanfaatan' => $isRP4Pemanfaatan,
                        'isRP4Pemindahtanganan' => $isRP4Pemindahtanganan,
                        'isRPPenghapusan' => $isRPPenghapusan

                    ];

                    // Periksa apakah data sudah di-generate sebelumnya
                    $existingData = PenggunaanModel::where($identifier)->first();
                    if (!$existingData || !$existingData->isGenerated) {
                        // Jika data belum di-generate atau belum ada, lakukan operasi create/update
                        PenggunaanModel::updateOrCreate($identifier, $newData);
                        $allDataGenerated = false;
                    }

                    // PenggunaanModel::create($newData);
                }
            } elseif ($KANWIL) {

                $dataToInsert = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,9) = ?', [Auth::user()->satker])->get();

                foreach ($dataToInsert as $data) {

                    $newData = [
                        'tahun' => $data->tahun,
                        'periode' => $data->periode,
                        'jenis_pemantauan' => $data->jenis_pemantauan,
                        'role' => $role,
                        'ue1' => $data->ue1,
                        'nama_satker' => $data->nama_satker,
                        'kode_satker' => $data->kode_satker,
                        'nama_anak_satker' => $data->nama_anak_satker,
                        'kode_anak_satker' => $data->kode_anak_satker,
                        'jenis_barang' => $data->jenis_barang,
                        'nama_barang' => $data->nama_barang,
                        'kode_barang' => $data->kode_barang,
                        'nup' => $data->nup,
                        'nilai_buku' => $data->nilai_buku,
                        'status_psp' => $data->status_psp,
                        'tanggal_psp' => $data->tanggal_psp,
                        'nomor_psp' => $data->nomor_psp,
                        'ket_psp' => $data->ket_psp,
                        'status_sesuai_Form1' => $data->status_sesuai_Form1,
                        'kesesuaian_psp' => $data->kesesuaian_psp,
                        'digunakan_sebagai' => $data->digunakan_sebagai,
                        'rencana_alih_fungsi' => $data->rencana_alih_fungsi,
                        'status_penggunaan' => $data->status_penggunaan,
                        'status_sesuai_Form2' => $data->status_sesuai_Form2,
                        'status_penggunaan' => $data->status_penggunaan,
                        'rencana' => $data->rencana,
                        'penilai_persentase_kesesuaian_sbsk' => $data->penilai_persentase_kesesuaian_sbsk,
                        'luas_sbsk' => $data->luas_sbsk,
                        'luas_pengurang' => $data->luas_pengurang,
                        'luas_ts_db' => $data->luas_ts_db,
                        'luas_digunakan' => $data->luas_digunakan,
                        'persentase_penilaian_pengelola_pengguna' => $data->persentase_penilaian_pengelola_pengguna,
                        'isCompletedForm1' => $data->isCompletedForm1,
                        'isCompletedForm2' => $data->isCompletedForm2,
                        'isCompletedForm3' => $data->isCompletedForm3,
                        'isCompletedForm4' => $data->isCompletedForm4,
                        'isCompletedForm5' => $data->isCompletedForm5,
                        'isCompletedForm6' => $data->isCompletedForm6,
                        'isCompletedForm7' => $data->isCompletedForm7,
                        'isCompletedForm8' => $data->isCompletedForm8,

                    ];

                    PenggunaanModel::create($newData);
                }
            } elseif ($ES1) {
                $dataToInsert = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,5) = ?', [Auth::user()->satker])->get();

                foreach ($dataToInsert as $data) {

                    $newData = [
                        'tahun' => $data->tahun,
                        'periode' => $data->periode,
                        'jenis_pemantauan' => $data->jenis_pemantauan,
                        'role' => $role,
                        'ue1' => $data->ue1,
                        'nama_satker' => $data->nama_satker,
                        'kode_satker' => $data->kode_satker,
                        'nama_anak_satker' => $data->nama_anak_satker,
                        'kode_anak_satker' => $data->kode_anak_satker,
                        'jenis_barang' => $data->jenis_barang,
                        'nama_barang' => $data->nama_barang,
                        'kode_barang' => $data->kode_barang,
                        'nup' => $data->nup,
                        'nilai_buku' => $data->nilai_buku,
                        'status_psp' => $data->status_psp,
                        'tanggal_psp' => $data->tanggal_psp,
                        'nomor_psp' => $data->nomor_psp,
                        'ket_psp' => $data->ket_psp,
                        'status_sesuai_Form1' => $data->status_sesuai_Form1,
                        'kesesuaian_psp' => $data->kesesuaian_psp,
                        'digunakan_sebagai' => $data->digunakan_sebagai,
                        'rencana_alih_fungsi' => $data->rencana_alih_fungsi,
                        'status_penggunaan' => $data->status_penggunaan,
                        'status_sesuai_Form2' => $data->status_sesuai_Form2,
                        'status_penggunaan' => $data->status_penggunaan,
                        'rencana' => $data->rencana,
                        'penilai_persentase_kesesuaian_sbsk' => $data->penilai_persentase_kesesuaian_sbsk,
                        'luas_sbsk' => $data->luas_sbsk,
                        'luas_pengurang' => $data->luas_pengurang,
                        'luas_ts_db' => $data->luas_ts_db,
                        'luas_digunakan' => $data->luas_digunakan,
                        'persentase_penilaian_pengelola_pengguna' => $data->persentase_penilaian_pengelola_pengguna,
                        'isCompletedForm1' => $data->isCompletedForm1,
                        'isCompletedForm2' => $data->isCompletedForm2,
                        'isCompletedForm3' => $data->isCompletedForm3,
                        'isCompletedForm4' => $data->isCompletedForm4,
                        'isCompletedForm5' => $data->isCompletedForm5,
                        'isCompletedForm6' => $data->isCompletedForm6,
                        'isCompletedForm7' => $data->isCompletedForm7,
                        'isCompletedForm8' => $data->isCompletedForm8,

                    ];

                    PenggunaanModel::create($newData);
                }
            } elseif ($PENGGUNA) {
                $dataToInsert = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,3) = ?', [Auth::user()->satker])->get();

                foreach ($dataToInsert as $data) {

                    $newData = [
                        'tahun' => $data->tahun,
                        'periode' => $data->periode,
                        'jenis_pemantauan' => $data->jenis_pemantauan,
                        'role' => $role,
                        'ue1' => $data->ue1,
                        'nama_satker' => $data->nama_satker,
                        'kode_satker' => $data->kode_satker,
                        'nama_anak_satker' => $data->nama_anak_satker,
                        'kode_anak_satker' => $data->kode_anak_satker,
                        'jenis_barang' => $data->jenis_barang,
                        'nama_barang' => $data->nama_barang,
                        'kode_barang' => $data->kode_barang,
                        'nup' => $data->nup,
                        'nilai_buku' => $data->nilai_buku,
                        'status_psp' => $data->status_psp,
                        'tanggal_psp' => $data->tanggal_psp,
                        'nomor_psp' => $data->nomor_psp,
                        'ket_psp' => $data->ket_psp,
                        'status_sesuai_Form1' => $data->status_sesuai_Form1,
                        'kesesuaian_psp' => $data->kesesuaian_psp,
                        'digunakan_sebagai' => $data->digunakan_sebagai,
                        'rencana_alih_fungsi' => $data->rencana_alih_fungsi,
                        'status_penggunaan' => $data->status_penggunaan,
                        'status_sesuai_Form2' => $data->status_sesuai_Form2,
                        'status_penggunaan' => $data->status_penggunaan,
                        'rencana' => $data->rencana,
                        'penilai_persentase_kesesuaian_sbsk' => $data->penilai_persentase_kesesuaian_sbsk,
                        'luas_sbsk' => $data->luas_sbsk,
                        'luas_pengurang' => $data->luas_pengurang,
                        'luas_ts_db' => $data->luas_ts_db,
                        'luas_digunakan' => $data->luas_digunakan,
                        'persentase_penilaian_pengelola_pengguna' => $data->persentase_penilaian_pengelola_pengguna,
                        'isCompletedForm1' => $data->isCompletedForm1,
                        'isCompletedForm2' => $data->isCompletedForm2,
                        'isCompletedForm3' => $data->isCompletedForm3,
                        'isCompletedForm4' => $data->isCompletedForm4,
                        'isCompletedForm5' => $data->isCompletedForm5,
                        'isCompletedForm6' => $data->isCompletedForm6,
                        'isCompletedForm7' => $data->isCompletedForm7,
                        'isCompletedForm8' => $data->isCompletedForm8,

                    ];

                    PenggunaanModel::create($newData);
                }
            } elseif ($PENGELOLA) {
                $dataToInsert = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,3) = ?', [Auth::user()->satker])->get();

                foreach ($dataToInsert as $data) {

                    $newData = [
                        'tahun' => $data->tahun,
                        'periode' => $data->periode,
                        'jenis_pemantauan' => $data->jenis_pemantauan,
                        'role' => $role,
                        'ue1' => $data->ue1,
                        'nama_satker' => $data->nama_satker,
                        'kode_satker' => $data->kode_satker,
                        'nama_anak_satker' => $data->nama_anak_satker,
                        'kode_anak_satker' => $data->kode_anak_satker,
                        'jenis_barang' => $data->jenis_barang,
                        'nama_barang' => $data->nama_barang,
                        'kode_barang' => $data->kode_barang,
                        'nup' => $data->nup,
                        'nilai_buku' => $data->nilai_buku,
                        'status_psp' => $data->status_psp,
                        'tanggal_psp' => $data->tanggal_psp,
                        'nomor_psp' => $data->nomor_psp,
                        'ket_psp' => $data->ket_psp,
                        'status_sesuai_Form1' => $data->status_sesuai_Form1,
                        'kesesuaian_psp' => $data->kesesuaian_psp,
                        'digunakan_sebagai' => $data->digunakan_sebagai,
                        'rencana_alih_fungsi' => $data->rencana_alih_fungsi,
                        'status_penggunaan' => $data->status_penggunaan,
                        'status_sesuai_Form2' => $data->status_sesuai_Form2,
                        'status_penggunaan' => $data->status_penggunaan,
                        'rencana' => $data->rencana,
                        'penilai_persentase_kesesuaian_sbsk' => $data->penilai_persentase_kesesuaian_sbsk,
                        'luas_sbsk' => $data->luas_sbsk,
                        'luas_pengurang' => $data->luas_pengurang,
                        'luas_ts_db' => $data->luas_ts_db,
                        'luas_digunakan' => $data->luas_digunakan,
                        'persentase_penilaian_pengelola_pengguna' => $data->persentase_penilaian_pengelola_pengguna,
                        'isCompletedForm1' => $data->isCompletedForm1,
                        'isCompletedForm2' => $data->isCompletedForm2,
                        'isCompletedForm3' => $data->isCompletedForm3,
                        'isCompletedForm4' => $data->isCompletedForm4,
                        'isCompletedForm5' => $data->isCompletedForm5,
                        'isCompletedForm6' => $data->isCompletedForm6,
                        'isCompletedForm7' => $data->isCompletedForm7,
                        'isCompletedForm8' => $data->isCompletedForm8,

                    ];

                    PenggunaanModel::create($newData);
                }
            } elseif ($AUDITOR) {
                $dataToInsert = PenggunaanModel::whereRaw('LEFT(kode_anak_satker,3) = ?', [Auth::user()->satker])->get();

                foreach ($dataToInsert as $data) {

                    $newData = [
                        'tahun' => $data->tahun,
                        'periode' => $data->periode,
                        'jenis_pemantauan' => $data->jenis_pemantauan,
                        'role' => $role,
                        'ue1' => $data->ue1,
                        'nama_satker' => $data->nama_satker,
                        'kode_satker' => $data->kode_satker,
                        'nama_anak_satker' => $data->nama_anak_satker,
                        'kode_anak_satker' => $data->kode_anak_satker,
                        'jenis_barang' => $data->jenis_barang,
                        'nama_barang' => $data->nama_barang,
                        'kode_barang' => $data->kode_barang,
                        'nup' => $data->nup,
                        'nilai_buku' => $data->nilai_buku,
                        'status_psp' => $data->status_psp,
                        'tanggal_psp' => $data->tanggal_psp,
                        'nomor_psp' => $data->nomor_psp,
                        'ket_psp' => $data->ket_psp,
                        'status_sesuai_Form1' => $data->status_sesuai_Form1,
                        'kesesuaian_psp' => $data->kesesuaian_psp,
                        'digunakan_sebagai' => $data->digunakan_sebagai,
                        'rencana_alih_fungsi' => $data->rencana_alih_fungsi,
                        'status_penggunaan' => $data->status_penggunaan,
                        'status_sesuai_Form2' => $data->status_sesuai_Form2,
                        'status_penggunaan' => $data->status_penggunaan,
                        'rencana' => $data->rencana,
                        'penilai_persentase_kesesuaian_sbsk' => $data->penilai_persentase_kesesuaian_sbsk,
                        'luas_sbsk' => $data->luas_sbsk,
                        'luas_pengurang' => $data->luas_pengurang,
                        'luas_ts_db' => $data->luas_ts_db,
                        'luas_digunakan' => $data->luas_digunakan,
                        'persentase_penilaian_pengelola_pengguna' => $data->persentase_penilaian_pengelola_pengguna,
                        'isCompletedForm1' => $data->isCompletedForm1,
                        'isCompletedForm2' => $data->isCompletedForm2,
                        'isCompletedForm3' => $data->isCompletedForm3,
                        'isCompletedForm4' => $data->isCompletedForm4,
                        'isCompletedForm5' => $data->isCompletedForm5,
                        'isCompletedForm6' => $data->isCompletedForm6,
                        'isCompletedForm7' => $data->isCompletedForm7,
                        'isCompletedForm8' => $data->isCompletedForm8,

                    ];

                    PenggunaanModel::create($newData);
                }
            }


            return redirect()->route('home-penggunaan.index')->with('success', 'Data berhasil digenerate');
        } catch (QueryException $e) {
            return redirect()->route('home-penggunaan.index')->with('failed', 'Gagal melakukan proses generate: ' . $e->getMessage());
        }
    }

    public function getKodeBarangAll()
    {
        $kodeBarang = ref_kode_barang_simanold::all();
        return response()->json($kodeBarang);
    }
}
