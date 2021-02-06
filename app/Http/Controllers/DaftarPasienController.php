<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class DaftarPasienController extends Controller
{
    public function index()
    {
        $last = array();
        $daftar = DB::table('tb_daftar_pasien')->where('id_pasien', Session::get('id_user'))->latest('tgl_daftar')->first();
        $dokter = DB::table('tb_dokter')->get();
        $last = DB::table('tb_daftar_pasien')->where('id_pasien', Session::get('id_user'))->latest('tgl_daftar')->first();
        $tempat = DB::table('tb_tempat')->get();
        return view('pages.daftar_pasien', [
            'daftar' => $daftar,
            'dokter' => $dokter,
            'tempat' => $tempat,
            'last' => (array)$last
        ]);
    }

    public function cari_dokter(Request $request)
    {
        $tgl = DB::table('tb_jadwal_dokter')
            ->join('tb_dokter', 'tb_dokter.id_dokter', '=', 'tb_jadwal_dokter.id_dokter')
            ->where('tb_jadwal_dokter.id_dokter', $request->get('id'))->where('id_tempat', $request->get('tempat'))->where('tanggal', '>', date('Y-m-d'))->get();
        foreach ($tgl as $key => $v) {
            echo "<option value='" . $v->id_jadwal . "'>" . $v->tanggal . "</option>";
        }
    }
    public function add_daftar(Request $request)
    {

        $insert = DB::table('tb_daftar_pasien')
            ->insert([
                'id_pasien' => Session::get('id_user'),
                'alamat' => $request->input('alamat'),
                'tanggal_lahir' => $request->input('tanggal_lahir'),
                'tempat' => $request->input('tempat'),
                'umur' => $request->input('umur'),
                'id_jadwal' => $request->input('id_jadwal'),
                'keluhan' => $request->input('keluhan'),
                'tgl_daftar' => date('Y-m-d')
            ]);
        if ($insert) {
            return 'success';
        } else {
            return 'error';
        }
    }
    public function get_daftar(Request $request)
    {
        $data = DB::table('tb_daftar_pasien')
            ->where('id_daftar', $request->get('id'))
            ->get();
        return $data;
    }
}
