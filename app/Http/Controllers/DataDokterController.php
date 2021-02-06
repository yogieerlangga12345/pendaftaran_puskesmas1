<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DataDokterController extends Controller
{
    public function index()
    {
        $tb_dokter = DB::table('tb_dokter')
            ->join('tb_tempat', 'tb_tempat.id_tempat', '=', 'tb_dokter.id_tempat')
            ->get();
        $tempat = DB::table('tb_tempat')
            ->get();
        return view('pages.data_dokter', [
            'tb_dokter' => $tb_dokter,
            'tempat' => $tempat
        ]);
    }

    public function add_dokter(Request $request)
    {
        $insert = DB::table('tb_dokter')
            ->insert([
                'id_tempat' => $request->input('id_tempat'),
                'nama_dokter' => $request->input('nama_dokter'),
                'spesialis' => $request->input('spesialis'),
                'alamat' => $request->input('alamat'),
                'hari' => $request->input('hari'),
                'ruang_praktek' => $request->input('ruang_praktek'),
                'jam_masuk' => $request->input('jam_masuk'),
                'jam_pulang' => $request->input('jam_pulang'),
                'username' => $request->input('username'),
                'password' => $request->input('password')
            ]);
        if ($insert) {
            return 'success';
        } else {
            return 'error';
        }
    }
    public function get_dokter(Request $request)
    {
        $data = DB::table('tb_dokter')
            ->where('id_dokter', $request->get('id'))
            ->get();
        return $data;
    }

    public function update_dokter(Request $request)
    {
        $update = DB::table('tb_dokter')
            ->where('id_dokter', $request->input('id_dokter'))
            ->update([
                'id_tempat' => $request->input('id_tempat'),
                'nama_dokter' => $request->input('nama_dokter'),
                'spesialis' => $request->input('spesialis'),
                'alamat' => $request->input('alamat'),
                'hari' => $request->input('hari'),
                'ruang_praktek' => $request->input('ruang_praktek'),
                'jam_masuk' => $request->input('jam_masuk'),
                'jam_pulang' => $request->input('jam_pulang'),
                'username' => $request->input('username'),
                'password' => $request->input('password')
            ]);
        if ($update) {
            return 'success';
        } else {
            return 'error';
        }
    }


    public function delete_dokter(Request $request)
    {
        $data = DB::table('tb_dokter')
            ->where('id_dokter', $request->get('id'))
            ->delete();
        if ($data < 0) {
            return 'error';
        } else {
            return 'success';
        }
    }
}
