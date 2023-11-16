<?php

namespace App\Http\Controllers\wasdal\pemantauan\form;

use App\Http\Controllers\Controller;
use App\Models\wasdal\pemantauan\PenggunaanModel;
use App\Models\wasdal\siman\Simanv2Model;
use Exception;
use Illuminate\Http\Request;

class FormPSPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('konten-wasdal.pemantauan.formulir.psp.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $simanv2 = Simanv2Model::where('kd_satker','015042000119532000KD')->get();
        // dd($data);
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
                'tgl_psp' => 'date|date_format:Y-m-d',
            ]);

            $user =  PenggunaanModel::create([
                'status_psp' => $request->status_psp,
                'no_psp' => $request->no_psp,
                'tgl_psp' => $request->tgl_psp,
                'ket_psp' => $request->ket_psp,
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
