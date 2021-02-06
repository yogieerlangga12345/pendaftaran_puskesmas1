<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class RegisterController extends Controller
{
    public function index()
    {
        return view('pages.register');
    }
    public function add_register(Request $request)
    {
        
        $checking = $this->check_pasien($request->input('nik'));
 
        if($checking == null){
            $insert=DB::table('tb_pasien') 
            ->insert([
                'nama_pasien'=> $request->input('username'),
                'nik'=> $request->input('nik'),
                'nmr_telp'=> $request->input('nmr_telp'),
                'password'=> $request->input('password')  
            ]);
            if ($insert){
                return 'success';
            }else{
                return 'error';   
            }
        }else{
            return 'error';   
        }  

    }
    public function check_pasien($nik)
    {
        return DB::table('tb_pasien')->where('nik',$nik)->first();
    }
}
