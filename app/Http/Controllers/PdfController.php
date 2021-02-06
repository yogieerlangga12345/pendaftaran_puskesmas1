<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class PdfController extends Controller
{
    public function generatePDF(Request $request)

    {
        $data = DB::table('tb_daftar_pasien')
            ->join('tb_pasien', 'tb_pasien.id_pasien', '=', 'tb_daftar_pasien.id_pasien')
            ->join('tb_jadwal_dokter', 'tb_jadwal_dokter.id_jadwal', '=', 'tb_daftar_pasien.id_jadwal')
            ->join('tb_dokter', 'tb_dokter.id_dokter', '=', 'tb_jadwal_dokter.id_dokter')
            ->join('tb_tempat', 'tb_tempat.id_tempat', '=', 'tb_dokter.id_tempat')
            ->where('id_daftar', $request->get('id'))
            ->get();


        $pdf = PDF::loadView('pages.myPDF', [
            'pasien' => $data
        ]);
        // return $pdf->download('laporan-pdf.pdf');
        return $pdf->stream();
    }

    public function cetakPDF(Request $request)
    {
        $data = DB::table('tb_daftar_pasien')
            ->leftJoin('tb_pasien', 'tb_pasien.id_pasien', '=', 'tb_daftar_pasien.id_pasien')
            ->leftJoin('tb_jadwal_dokter', 'tb_jadwal_dokter.id_jadwal', '=', 'tb_daftar_pasien.id_jadwal')
            ->leftJoin('tb_dokter', 'tb_dokter.id_dokter', '=', 'tb_jadwal_dokter.id_dokter')
            ->leftJoin('tb_tempat', 'tb_tempat.id_tempat', '=', 'tb_dokter.id_tempat')
            ->where('tb_dokter.id_tempat', $request->get('pus'))
            ->whereBetween('tgl_daftar', [$request->get('first'), $request->get('last')])
            ->get();

        $pdf = PDF::loadView('pages.cetak_datapasien', [
            'datapasien' => $data
        ]);

        return $pdf->stream();
    }

    public function pdf_qr(Request $request)

    {
        $data = DB::table('tb_daftar_pasien')
            ->join('tb_pasien', 'tb_pasien.id_pasien', '=', 'tb_daftar_pasien.id_pasien')
            ->join('tb_jadwal_dokter', 'tb_jadwal_dokter.id_jadwal', '=', 'tb_daftar_pasien.id_jadwal')
            ->join('tb_dokter', 'tb_dokter.id_dokter', '=', 'tb_jadwal_dokter.id_dokter')
            ->join('tb_tempat', 'tb_tempat.id_tempat', '=', 'tb_dokter.id_tempat')
            ->where('id_daftar', $request->get('id'))
            ->get();


        $pdf = PDF::loadView('pages.pdf_qr', [
            'qr' => $data
        ]);
        // return $pdf->download('laporan-pdf.pdf');
        return $pdf->stream();
    }

    public function laporanPDF(Request $request)
    {
        $data = DB::table('tb_daftar_pasien')
            ->leftJoin('tb_pasien', 'tb_pasien.id_pasien', '=', 'tb_daftar_pasien.id_pasien')
            ->leftJoin('tb_jadwal_dokter', 'tb_jadwal_dokter.id_jadwal', '=', 'tb_daftar_pasien.id_jadwal')
            ->leftJoin('tb_dokter', 'tb_dokter.id_dokter', '=', 'tb_jadwal_dokter.id_dokter')
            ->leftJoin('tb_tempat', 'tb_tempat.id_tempat', '=', 'tb_dokter.id_tempat')
            ->where('tb_dokter.id_tempat', $request->get('pus1'))
            ->whereBetween('tgl_daftar', [$request->get('first1'), $request->get('last1')])
            ->get();

        $laporanPDF = PDF::loadView('pages.laporanPdf', [
            'laporanPDF' => $data
        ]);

        return $laporanPDF->stream();
    }

    public function laporanDokter(Request $request)
    {
        $data = DB::table('tb_daftar_pasien')
            ->leftJoin('tb_pasien', 'tb_pasien.id_pasien', '=', 'tb_daftar_pasien.id_pasien')
            ->leftJoin('tb_jadwal_dokter', 'tb_jadwal_dokter.id_jadwal', '=', 'tb_daftar_pasien.id_jadwal')
            ->leftJoin('tb_dokter', 'tb_dokter.id_dokter', '=', 'tb_jadwal_dokter.id_dokter')
            ->leftJoin('tb_tempat', 'tb_tempat.id_tempat', '=', 'tb_dokter.id_tempat')
            ->where('tb_dokter.id_tempat', $request->get('pus2'))
            ->whereBetween('tgl_daftar', [$request->get('first2'), $request->get('last2')])
            ->get();

        $laporanDokter = PDF::loadView('pages.laporanDokter', [
            'laporanDokter' => $data
        ]);

        return $laporanDokter->stream();
    }
}
