<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    function index()
    {
        $data['j_dokter'] = DB::table('tb_dokter')->count();
        $data['j_petugas'] = DB::table('db_petugas')->count();
        $data['j_pasien'] = DB::table('tb_daftar_pasien')->count();
        $data['j_puskesmas'] = DB::table('tb_tempat')->count();
        $data['j_acc'] = DB::table('tb_daftar_pasien')->where('status', 1)->count();
        $data['j_belum'] = DB::table('tb_daftar_pasien')->where('status', 0)->count();
        return view('pages.dashboard', $data);
    }
}
