<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class IndexController extends Controller
{
    public function index()
    {
        $data['j_dokter1'] = DB::table('tb_dokter')->count();
        $data['j_petugas1'] = DB::table('db_petugas')->count();
        $data['j_pasien1'] = DB::table('tb_daftar_pasien')->count();
        $data['j_puskesmas1'] = DB::table('tb_tempat')->count();
        return view('index', $data);
    }
}
