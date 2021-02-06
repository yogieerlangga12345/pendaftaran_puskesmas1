<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class HalamanDokterController extends Controller
{
    public function index()
    {

        $data = DB::table('tb_daftar_pasien')
            ->join('tb_pasien', 'tb_pasien.id_pasien', '=', 'tb_daftar_pasien.id_pasien')
            ->join('tb_jadwal_dokter', 'tb_jadwal_dokter.id_jadwal', '=', 'tb_daftar_pasien.id_jadwal')
            ->join('tb_dokter', 'tb_dokter.id_dokter', '=', 'tb_jadwal_dokter.id_dokter')
            ->join('tb_tempat', 'tb_tempat.id_tempat', '=', 'tb_dokter.id_tempat')
            ->where('tb_jadwal_dokter.id_dokter', Session::get('id_user'))
            ->get();
        $tempat3 = DB::table('tb_tempat')
            ->get();
        return view('pages.halaman_dokter', [
            'dokter' => $data,
            'tempat3' => $tempat3
        ]);
    }
    public function update_diagnosa(Request $request)
    {
        $update = DB::table('tb_daftar_pasien')
            ->where('id_daftar', $request->input('id_daftar'))
            ->update([
                'diagnosa' => $request->input('diagnosa'),
                'status' => 2
            ]);
        if ($update) {
            return 'success';
        } else {
            return 'error';
        }
    }
}
