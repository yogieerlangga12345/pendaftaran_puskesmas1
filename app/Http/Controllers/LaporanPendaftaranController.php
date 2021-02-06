<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class LaporanPendaftaranController extends Controller
{
    public function index()
    {
        if (Session::get('role') == 'Pasien') {
            $laporan = DB::table('tb_daftar_pasien')
                ->join('tb_pasien', 'tb_pasien.id_pasien', '=', 'tb_daftar_pasien.id_pasien')
                ->join('tb_jadwal_dokter', 'tb_jadwal_dokter.id_jadwal', '=', 'tb_daftar_pasien.id_jadwal')
                ->join('tb_dokter', 'tb_dokter.id_dokter', '=', 'tb_jadwal_dokter.id_dokter')
                ->join('tb_tempat', 'tb_tempat.id_tempat', '=', 'tb_dokter.id_tempat')
                ->where('tb_daftar_pasien.id_pasien', Session::get('id_user'))
                ->get();
        } else {
            $laporan = DB::table('tb_daftar_pasien')
                ->join('tb_pasien', 'tb_pasien.id_pasien', '=', 'tb_daftar_pasien.id_pasien')
                ->join('tb_jadwal_dokter', 'tb_jadwal_dokter.id_jadwal', '=', 'tb_daftar_pasien.id_jadwal')
                ->join('tb_dokter', 'tb_dokter.id_dokter', '=', 'tb_jadwal_dokter.id_dokter')
                ->join('tb_tempat', 'tb_tempat.id_tempat', '=', 'tb_dokter.id_tempat')
                ->get();
        }
        $tempat2 = DB::table('tb_tempat')
            ->get();
        return view('pages.laporan_pendaftaran', [
            'laporan' => $laporan,
            'tempat2' => $tempat2
        ]);
    }

    public function add_laporan(Request $request)
    {
        $insert = DB::table('tb_daftar_pasien')
            ->insert([
                'id_pasien' => Session::get('id_user'),
                'nama_pasien' => $request->input('nama_pasien'),
                'nik' => $request->input('nik'),
                'nama_puskesmas' => $request->input('nama_puskesmas'),
                'nmr_antrian' => $request->input('nmr_antrian'),
                'nama_dokter' => $request->input('nama_dokter'),
                'spesialis' => $request->input('spesialis'),
                'ruang_praktek' => $request->input('ruang_praktek'),
                'tanggal' => $request->input('tanggal'),

            ]);
        if ($insert) {
            return 'success';
        } else {
            return 'error';
        }
    }
}
