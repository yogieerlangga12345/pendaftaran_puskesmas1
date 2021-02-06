<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MasterPetugasController extends Controller
{
   public function index()
    {
        $db_petugas=DB::table('db_petugas')->get();
        return view('pages.master_petugas',['db_petugas'=>$db_petugas]);
    }

    public function add_petugas(Request $request)
    {
       $insert=DB::table('db_petugas') 
       ->insert([
           'nama_petugas' => $request->input('nama_petugas'),
           'username' => $request->input('username'),
           'password' => $request->input('password'),
           'nmr_telp'=> $request->input('nmr_telp')
       ]);
       if ($insert){
           return 'success';
       }else{
           return 'error';
       }

    }
    public function get_petugas(Request $request){
        $data=DB::table('db_petugas')
        ->where('id_petugas',$request->get('id'))
        ->get();
        return $data;

    }

    public function update_petugas(Request $request)
    {
       $update=DB::table('db_petugas') 
       ->where('id_petugas',$request->input('id_petugas'))
       ->update([
           'nama_petugas' => $request->input('nama_petugas'),
           'username' => $request->input('username'),
           'password' => $request->input('password'),
           'nmr_telp'=> $request->input('nmr_telp')
       ]);
       if ($update){
        return 'success';
       }else{
        return 'error';
    }

 }
      

      public function delete_petugas(Request $request){
        $data=DB::table('db_petugas')
        ->where('id_petugas',$request->get('id'))
        ->delete();
       if($data < 0){
           return 'error';
       }else{
           return'success';
       }

    }
}
