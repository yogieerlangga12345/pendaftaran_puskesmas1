<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MasterDokterController extends Controller
{
    public function index()
    {
        $db_dokter = DB::table('db_dokter')->get();
        return view('pages.master_dokter', ['db_dokter' => $db_dokter]);
    }

    public function madd_dokter(Request $request)
    {
        $insert = DB::table('db_dokter')
            ->insert([
                'nama_dokter' => $request->input('nama_dokter'),
                'username' => $request->input('username'),
                'password' => $request->input('password'),
                'no_telp' => $request->input('no_telp')
            ]);
        if ($insert) {
            return 'success';
        } else {
            return 'error';
        }
    }
    public function mget_dokter(Request $request)
    {
        $data = DB::table('db_dokter')
            ->where('id_dokter', $request->get('id'))
            ->get();
        return $data;
    }

    public function mupdate_dokter(Request $request)
    {
        $update = DB::table('db_dokter')
            ->where('id_dokter', $request->input('id_dokter'))
            ->update([
                'nama_dokter' => $request->input('nama_dokter'),
                'username' => $request->input('username'),
                'password' => $request->input('password'),
                'no_telp' => $request->input('no_telp')
            ]);
        if ($update) {
            return 'success';
        } else {
            return 'error';
        }
    }


    public function mdelete_dokter(Request $request)
    {
        $data = DB::table('db_dokter')
            ->where('id_dokter', $request->get('id'))
            ->delete();
        if ($data < 0) {
            return 'error';
        } else {
            return 'success';
        }
    }
}
