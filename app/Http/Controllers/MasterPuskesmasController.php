<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MasterPuskesmasController extends Controller
{
    public function index()
    {
        $tb_tempat = DB::table('tb_tempat')->get();
        return view('pages.master_puskesmas', ['tb_tempat' => $tb_tempat]);
    }

    public function add_puskesmas(Request $request)
    {
        $insert = DB::table('tb_tempat')
            ->insert([
                'nama_puskesmas' => $request->input('nama_puskesmas'),
                'alamat_puskesmas' => $request->input('alamat_puskesmas'),
                'no_telp' => $request->input('no_telp')
            ]);
        if ($insert) {
            return 'success';
        } else {
            return 'error';
        }
    }
    public function get_puskesmas(Request $request)
    {
        $data = DB::table('tb_tempat')
            ->where('id_tempat', $request->get('id'))
            ->get();
        return $data;
    }

    public function update_puskesmas(Request $request)
    {
        $update = DB::table('tb_tempat')
            ->where('id_tempat', $request->input('id_tempat'))
            ->update([
                'nama_puskesmas' => $request->input('nama_puskesmas'),
                'alamat_puskesmas' => $request->input('alamat_puskesmas'),
                'no_telp' => $request->input('no_telp')
            ]);
        if ($update) {
            return 'success';
        } else {
            return 'error';
        }
    }


    public function delete_puskesmas(Request $request)
    {
        $data = DB::table('tb_tempat')
            ->where('id_tempat', $request->get('id'))
            ->delete();
        if ($data < 0) {
            return 'error';
        } else {
            return 'success';
        }
    }
}
