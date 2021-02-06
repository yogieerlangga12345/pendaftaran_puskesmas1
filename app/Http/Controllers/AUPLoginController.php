<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;

class AUPLoginController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function proses_login(Request $request)
    {
        $admin = $this->cek_admin($request->input('username'));
        $petugas = $this->cek_petugas($request->input('username'));
        $pasien = $this->cek_pasien($request->input('username'));
        $dokter = $this->cek_dokter($request->input('username'));

        $condition = false;

        if ($admin != null) {
            if ($admin->username == $request->input('username') && $admin->password == $request->input('password')) {
                $condition = true;
            }

            if ($condition) {
                Session::put('id_user', $admin->id_admin);
                Session::put('nama_admin', $admin->nama_admin);
                Session::put('nmr_telp', $admin->nmr_telp);
                Session::put('role', 'Admin');
            }
        } else if ($petugas != null) {
            if ($petugas->username == $request->input('username') && $petugas->password == $request->input('password')) {
                $condition = true;
            }

            if ($condition) {
                Session::put('id_user', $petugas->id_petugas);
                Session::put('nama_petugas', $petugas->nama_petugas);
                Session::put('nmr_telp', $petugas->nmr_telp);
                Session::put('role', 'Petugas');
            }
        } else if ($pasien != null) {
            if ($pasien->nik == $request->input('username') && $pasien->password == $request->input('password')) {
                $condition = true;
            }

            if ($condition) {
                Session::put('id_user', $pasien->id_pasien);
                Session::put('nama_pasien', $pasien->nama_pasien);
                Session::put('nik', $pasien->nik);
                Session::put('nmr_telp', $pasien->nmr_telp);
                Session::put('role', 'Pasien');
            }
        } else if ($dokter != null) {
            if ($dokter->username == $request->input('username') && $dokter->password == $request->input('password')) {
                $condition = true;
            }

            if ($condition) {
                Session::put('id_user', $dokter->id_dokter);
                Session::put('nama_dokter', $dokter->nama_dokter);
                Session::put('role', 'Dokter');
            }
        } else {
            $condition = false;
        }

        if ($condition) {
            Session::put('is_login', true);
            return 'success';
        } else {
            return 'error';
        }
    }

    public function cek_petugas($username)
    {
        return DB::table('db_petugas')->where('username', $username)->first();
    }

    public function cek_admin($username)
    {
        return DB::table('db_admin')->where('username', $username)->first();
    }

    public function cek_dokter($username)
    {
        return DB::table('tb_dokter')->where('username', $username)->first();
    }

    public function cek_pasien($nik)
    {
        return DB::table('tb_pasien')->where('nik', $nik)->first();
    }



    function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('login');
    }
}
