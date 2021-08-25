<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\M_Supplier;
use App\M_Pengadaan;

class Home extends Controller
{
    public function index(){
    	$token = Session::get('token');

		$tokenDB = M_Supplier::where('token', $token)->count();
		if($tokenDB > 0){
			$data['token'] = $token;
		}else{
			$data['token'] = "kosong";
		}

		$data['pengadaan'] = M_Pengadaan::where('status', '1')->paginate(15);
    	return view('utama.home', $data);
    }
}
