<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MasterAdminController extends Controller
{
    public function index()
    {
        $db_admin = DB::table('db_admin')->get();
        return view('pages.master_admin', ['db_admin' => $db_admin]);
    }

    public function add_admin(Request $request)
    {
        $insert = DB::table('db_admin')
            ->insert([
                'nama_admin' => $request->input('nama_admin'),
                'username' => $request->input('username'),
                'password' => $request->input('password'),
                'nmr_telp' => $request->input('nmr_telp')
            ]);
        if ($insert) {
            return 'success';
        } else {
            return 'error';
        }
    }
    public function get_admin(Request $request)
    {
        $data = DB::table('db_admin')
            ->where('id_admin', $request->get('id'))
            ->get();
        return $data;
    }

    public function update_admin(Request $request)
    {
        $update = DB::table('db_admin')
            ->where('id_admin', $request->input('id_admin'))
            ->update([
                'nama_admin' => $request->input('nama_admin'),
                'username' => $request->input('username'),
                'password' => $request->input('password'),
                'nmr_telp' => $request->input('nmr_telp')
            ]);
        if ($update) {
            return 'success';
        } else {
            return 'error';
        }
    }


    public function delete_admin(Request $request)
    {
        $data = DB::table('db_admin')
            ->where('id_admin', $request->get('id'))
            ->delete();
        if ($data < 0) {
            return 'error';
        } else {
            return 'success';
        }
    }
}
