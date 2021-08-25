<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Encryption\DecryptException;
use App\M_Supplier;

class Registrasi extends Controller
{
    public function index(){
    	return view('registrasi.registrasi');
    }

    public function regist(Request $request){
    	$this->validate($request,
    		[
    			'nama_badan' => 'required',
    			'email' => 'required',
    			'alamat' => 'required',
    			'npwp' => 'required',
    			'password' => 'required'
    		]
    	);

    	if(M_Supplier::create(
    		[
    			'nama_badan' => $request->nama_badan,
    			'email' => $request->email,
    			'alamat' => $request->alamat,
    			'npwp' => $request->npwp,
    			'password' => encrypt ($request->password)
    		]
    	)){
    		return redirect('/registrasi')->with('berhasil', 'Data Berhasil Disimpan');
    	}else{
    		return redirect('/registrasi')->with('gagal', 'Data Gagal Disimpan');
    	}
    }
}
