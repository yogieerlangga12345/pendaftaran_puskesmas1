<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class JadwalPraktekController extends Controller
{

    public function index()
    {
        $tb_jadwal_dokter = DB::table('tb_jadwal_dokter')
            ->join('tb_dokter', 'tb_dokter.id_dokter', '=', 'tb_jadwal_dokter.id_dokter')
            ->get();
        $dokter = DB::table('tb_dokter')->get();
        return view('pages.jadwal_praktek', [
            'tb_jadwal_dokter' => $tb_jadwal_dokter,
            'dokter' => $dokter
        ]);
    }

    public function add_jadwaldokter(Request $request)
    {
        $insert = DB::table('tb_jadwal_dokter')
            ->insert([
                'id_dokter' => $request->input('id_dokter'),
                'tanggal' => $request->input('tanggal')
            ]);
        if ($insert) {
            return 'success';
        } else {
            return 'error';
        }
    }
    public function get_jadwaldokter(Request $request)
    {
        $data = DB::table('tb_jadwal_dokter')
            ->where('id_jadwal', $request->get('id'))
            ->get();
        return $data;
    }

    public function update_jadwaldokter(Request $request)
    {
        $update = DB::table('tb_jadwal_dokter')
            ->where('id_jadwal', $request->input('id_jadwal'))
            ->update([

                'id_dokter' => $request->input('id_dokter'),
                'tanggal' => $request->input('tanggal')
            ]);
        if ($update) {
            return 'success';
        } else {
            return 'error';
        }
    }


    public function delete_jadwaldokter(Request $request)
    {
        $data = DB::table('tb_jadwal_dokter')
            ->where('id_jadwal', $request->get('id'))
            ->delete();
        if ($data < 0) {
            return 'error';
        } else {
            return 'success';
        }
    }
}
