<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use \Firebase\JWT\JWT;
use App\M_Admin;
use App\M_Pengadaan;
use App\M_Supplier;

class Pengadaan extends Controller
{
	public function index(){
		$token = Session::get('token');
		$tokenDB = M_Admin::where('token', $token)->count();

		if($tokenDB > 0 ){
			$data['pengadaan'] = M_Pengadaan::where('status', '1')->paginate(1);
			return view('pengadaan.list', $data);
		}else{
			return redirect ('/masukAdmin')->with('gagal', 'Anda Harus Login Terlebih Dahulu');
		}
	}

	public function tambahPengadaan(Request $request){
		$token = Session::get('token');
		$tokenDB = M_Admin::where('token', $token)->count();

		if($tokenDB > 0){
			$this->validate($request,
				[
					'nama_pengadaan' => 'required',
					'deskripsi' => 'required',
					'gambar' => 'required|image|mimes:jpg,jpeg,png,gif|max:2000',
					'anggaran' => 'required|numeric'
				]);
			$path = $request->file('gambar')->store('public/gambar');

			if(M_Pengadaan::create([
				"nama_pengadaan" => $request->nama_pengadaan,
				"deskripsi" => $request->deskripsi,
				"gambar" => $path,
				"anggaran" => $request->anggaran
			])){
				return redirect ('/pengadaan')->with('berhasil', 'Data Berhasil Disimpan');
			} else{
				return redirect ('/pengadaan')->with('gagal', 'Data Gagal Disimpan');	
			}

		}else{
			return redirect ('/masukAdmin')->with('gagal', 'Anda Harus Login Terlebih Dahulu');
		}
	}

	public function ubahPengadaan(Request $request){
		$token = Session::get('token');
		$tokenDB = M_Admin::where('token', $token)->count();

		if($tokenDB > 0){
			$this->validate($request,
				[
					'u_nama_pengadaan' => 'required',
					'u_deskripsi' => 'required',
					'u_anggaran' => 'required|numeric'
				]);

			if(M_Pengadaan::where('id_pengadaan', $request->id_pengadaan)->update(
				[
					"nama_pengadaan" => $request->u_nama_pengadaan,
					"deskripsi" => $request->u_deskripsi,
					"anggaran" => $request->u_anggaran
				])){
				return redirect ('/pengadaan')->with('berhasil', 'Data Berhasil Diubah');
			} else{
				return redirect ('/pengadaan')->with('gagal', 'Data Gagal Diubah');	
			}

		}else{
			return redirect ('/masukAdmin')->with('gagal', 'Anda Harus Login Terlebih Dahulu');
		}
	}


	public function hapusPengadaan($id){
		$token = Session::get('token');
		$tokenDB = M_Admin::where('token', $token)->count();

		if($tokenDB > 0){
			$pengadaan = M_Pengadaan::where('id_pengadaan', $id)->count();

			if($pengadaan > 0){
				$dataPengadaan = M_Pengadaan::where('id_pengadaan', $id)->first();

				if(Storage::delete($dataPengadaan->gambar)){
					if(M_Pengadaan::where('id_pengadaan', $id)->delete()){
						return redirect ('/pengadaan')->with('berhasil', 'Data Berhasil Dihapus');
					}else{
						return redirect ('/pengadaan')->with('gagal', 'Data Gagal Dihapus');							
					}
				}else{
					return redirect ('/pengadaan')->with('gagal', 'Data Gagal Dihapus');	
				}
			}else{
				return redirect ('/pengadaan')->with('gagal', 'Data Tidak Ditemukan');
			}
		}else{
			return redirect ('/masukAdmin')->with('gagal', 'Anda Harus Login Terlebih Dahulu');	
		}
	}

	public function uploadGambar(Request $request){
		$token = Session::get('token');
		$tokenDB = M_Admin::where('token', $token)->count();

		if($tokenDB > 0){
			$this->validate($request,
				[
					'gambar' => 'required|image|mimes:jpg,jpeg,png,gif|max:2000',
				]);
			$path = $request->file('gambar')->store('public/gambar');

			if(M_Pengadaan::where('id_pengadaan', $request->id_pengadaan)->update(["gambar" => $path])){
				return redirect ('/pengadaan')->with('berhasil', 'Gambar Berhasil Diupload');
			} else{
				return redirect ('/pengadaan')->with('gagal', 'Gambar Gagal Diupload');	
			}

		}else{
			return redirect ('/masukAdmin')->with('gagal', 'Anda Harus Login Terlebih Dahulu');
		}
	}

	public function hapusGambar($id){
		$token = Session::get('token');
		$tokenDB = M_Admin::where('token', $token)->count();

		if($tokenDB > 0){
			$pengadaan = M_Pengadaan::where('id_pengadaan', $id)->count();

			if($pengadaan > 0){
				$dataPengadaan = M_Pengadaan::where('id_pengadaan', $id)->first();

				if(Storage::delete($dataPengadaan->gambar)){
					if(M_Pengadaan::where('id_pengadaan', $id)->update(['gambar'=>"-"])){
						return redirect ('/pengadaan')->with('berhasil', 'Gambar Berhasil Dihapus');
					}else{
						return redirect ('/pengadaan')->with('gagal', 'Gambar Gagal Dihapus');							
					}
				}else{
					return redirect ('/pengadaan')->with('gagal', 'Gambar Gagal Dihapus');	
				}
			}else{
				return redirect ('/pengadaan')->with('gagal', 'Data Tidak Ditemukan');
			}
		}else{
			return redirect ('/masukAdmin')->with('gagal', 'Anda Harus Login Terlebih Dahulu');	
		}
	}

	public function listSupplier(){
		$token = Session::get('token');
		$tokenDB = M_Supplier::where('token', $token)->count();

		if($tokenDB > 0 ){
			$data['su'] = M_Supplier::where('token', $token)->first();
			$data['pengadaan'] = M_Pengadaan::where('status', '1')->paginate(15);
			return view('login_supp.pengadaan', $data);
		}else{
			return redirect('masukSupplier')->with('gagal', 'Anda Harus Login Terlebih Dahulu');
		}
	}
}

