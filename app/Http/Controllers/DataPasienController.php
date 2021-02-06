<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DataPasienController extends Controller
{
    public function index()
    {
        $data_pasien = DB::table('tb_daftar_pasien')
            ->join('tb_pasien', 'tb_pasien.id_pasien', '=', 'tb_daftar_pasien.id_pasien')
            ->join('tb_jadwal_dokter', 'tb_jadwal_dokter.id_jadwal', '=', 'tb_daftar_pasien.id_jadwal')
            ->join('tb_dokter', 'tb_dokter.id_dokter', '=', 'tb_jadwal_dokter.id_dokter')
            ->join('tb_tempat', 'tb_tempat.id_tempat', '=', 'tb_dokter.id_tempat')
            ->get();
        $tempat = DB::table('tb_tempat')->get();
        return view('pages.data_pasien', [
            'tb_daftar_pasien' => $data_pasien,
            'tempat' => $tempat
        ]);
    }

    public function add_data_pasien(Request $request)
    {
        $insert = DB::table('tb_daftar_pasien')
            ->insert([
                'id_pasien' => Session::get('id_user'),
                'alamat' => $request->input('alamat'),
                'tanggal_lahir' => $request->input('tanggal_lahir'),
                'tempat' => $request->input('tempat'),
                'umur' => $request->input('umur'),
                'nama_puskesmas' => $request->input('nama_puskesmas'),
                'id_jadwal' => $request->input('id_jadwal'),
                'tgl_daftar' => date('Y-m-d')
            ]);
        if ($insert) {
            return 'success';
        } else {
            return 'error';
        }
    }
    public function acc_data(Request $request)
    {
        $antr = $this->cek_antrian($request->get('jad'))->nmr_antrian;
        if ($antr == null) {
            $ant = 1;
        } else {
            $ant = $antr + 1;
        }
        $update = DB::table('tb_daftar_pasien')
            ->where('id_daftar', $request->get('id'))
            ->update([
                'status' => 1,
                'nmr_antrian' => $ant
            ]);
        if ($update) {
            return 'success';
        } else {
            return 'error';
        }
    }

    public function cek_antrian($id)
    {
        return DB::table('tb_daftar_pasien')->where('id_jadwal', $id)->orderBy('nmr_antrian', 'DESC')->first();
    }

    public function selesai(Request $request)
    {

        $update = DB::table('tb_daftar_pasien')
            ->where('id_daftar', $request->get('id'))
            ->update([
                'status' => 2

            ]);
        if ($update) {
            return 'success';
        } else {
            return 'error';
        }
    }
}
