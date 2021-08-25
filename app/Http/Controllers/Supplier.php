<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use \Firebase\JWT\JWT;
use App\M_Supplier;
use App\M_Admin;

class Supplier extends Controller
{
	public function login(){
		return view ('login_supp.login');
	}

	public function masukSupplier(Request $request){
		$this->validate($request,
			[
				'email' => 'required',
				'password' => 'required'
			]
		);

		$cek = M_Supplier::where('email', $request->email)->count();

		$supp = M_Supplier::where('email', $request->email)->get();

		if($cek > 0){
			foreach($supp as $su){
				if(decrypt($su->password) == $request->password){
					$key = env('APP_KEY');
					$data = array(
						"id_supplier" =>$su->id_supplier
					);
					
					$jwt = JWT::encode($data, $key);

					if(M_Supplier::where('id_supplier', $su->id_supplier)->update(['token' => $jwt])){
						Session::put('token', $jwt);
						return redirect('/listSupplier');
					}else{
						return redirect('/login')->with('gagal', 'Token Gagal Diupdate');
					}

				}else{
					return redirect ('/login')->with('gagal', 'Password Tidak Sesuai');    			
				}
			}
		}else{
			return redirect ('/login')->with('gagal', 'Email Tidak Terdaftar');
		}

	}

	public function keluarSupplier(){
		$token = Session::get('token');

		if(M_Supplier::where('token', $token)->update(
			[
				'token' => 'keluar'
			]
		)){
			Session::put('token', "");
			return redirect('/');
		}else{
			return redirect('masukSupplier')->with('gagal', 'Mohon Maaf, Terjadi Kesalahan Saat Logout');
		}
	}

	public function listSupplier(){
		$token = Session::get('token');
		$tokenDB = M_Admin::where('token', $token)->count();

		if($tokenDB > 0){
			$data['supplier'] = M_Supplier::paginate(15);
			return view ('admin.listSupplier', $data);
		}else{
			return redirect ('/masukAdmin')->with('gagal', 'Anda Harus Login Terlebih Dahulu');
		}
	}

	public function aktif($id){
		$token = Session::get('token');
		$tokenDB = M_Admin::where('token', $token)->count();

		if($tokenDB > 0){
			if(M_Supplier::where('id_supplier', $id)->update(["status"=>"1"])){
				return redirect ('/listSupplier')->with('berhasil', 'Supplier Berhasil Diproses');
			}else{
				return redirect ('/listSupplier')->with('gagal', 'Supplier Gagal Diproses');

			}
		}else{
			return redirect ('/masukAdmin')->with('gagal', 'Anda Harus Login Terlebih Dahulu');
		}
	}

	public function nonAktif($id){
		$token = Session::get('token');
		$tokenDB = M_Admin::where('token', $token)->count();

		if($tokenDB > 0){
			if(M_Supplier::where('id_supplier', $id)->update(["status"=>"0"])){
				return redirect ('/listSupplier')->with('berhasil', 'Supplier Berhasil Diproses');
			}else{
				return redirect ('/listSupplier')->with('gagal', 'Supplier Gagal Diproses');

			}
		}else{
			return redirect ('/masukAdmin')->with('gagal', 'Anda Harus Login Terlebih Dahulu');
		}
	}

	public function ubahPassword(Request $request){
		$token = Session::get('token');
		$tokenDB = M_Supplier::where('token', $token)->count();

		if($tokenDB > 0){
			$sup = M_Supplier::where('token', $token)->first();
			$key = env('APP_KEY');
			$decode = JWT::decode($token, $key, array('HS256'));
			$decode_array = (array) $decode;
			
			if(decrypt($sup->password) == $request->passwordlama){
				if($request->password == $request->retype){
					if(M_Supplier::where('id_supplier', $decode_array['id_supplier'])->update(["password"=>encrypt($request->password)])){
						return redirect ('/login')->with('berhasil', 'Password Berhasil Diubah. Silahkan Login Kembali');
					}else{
						return redirect ('/listSupplier')->with('gagal', 'Password Gagal Diubah. Silahkan Login Kembali');
					}
				}else{
					return redirect ('/listSupplier')->with('gagal', 'Password Baru dan Ulangi Harus Sama');
				}
			}else{
				return redirect ('/listSupplier')->with('gagal', 'Password Lama Tidak Sesuai');
			}
		}else{
			return redirect ('/login')->with('gagal', 'Anda Harus Login Terlebih Dahulu');
		}	
	}
}
