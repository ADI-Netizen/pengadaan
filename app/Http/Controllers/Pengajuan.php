<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use \Firebase\JWT\JWT;
use App\M_Admin;
use App\M_Pengajuan;
use App\M_Supplier;
use App\M_Pengadaan;
use App\M_Laporan;

class Pengajuan extends Controller
{
    public function pengajuan(){
    	$key = env('APP_KEY');
    	$token = Session::get('token');
    	$tokenDB = M_Admin::where('token', $token)->count();

    	if($tokenDB > 0){
            $pengajuan=M_Pengajuan::where('status', '1')->paginate(15);
            $dataP = array();

            foreach ($pengajuan as $p) {
                $pengadaan = M_Pengadaan::where('id_pengadaan', $p->id_pengadaan)->first();
                $sup = M_Supplier::where('id_supplier', $p->id_supplier)->first();
                $dataP[]=array(
                    "id_pengajuan"=>$p->id_pengajuan,
                    "nama_pengadaan"=>$pengadaan->nama_pengadaan,
                    "gambar"=>$pengadaan->gambar,
                    "anggaran"=>$p->anggaran,
                    "proposal"=>$p->proposal,
                    "anggaran_pengajuan"=>$p->anggaran,
                    "status_pengajuan"=>$p->status,
                    "nama_supplier"=>$sup->nama_badan,
                    "email_supplier"=>$sup->email,
                    "alamat_supplier"=>$sup->alamat
                );
            }
            $data['adm'] = M_Admin::where('token', $token)->first();
            $data['pengajuan'] = $dataP;
            return view('pengajuan.list', $data);
        }else{
          return redirect ('/masukAdmin')->with('gagal', 'Anda Harus Login Sebagai Admin Terlebih Dahulu');
      }
  }

  public function tambahPengajuan(Request $request){
    $key = env('APP_KEY');
    $token = Session::get('token');
    $tokenDB = M_Supplier::where('token', $token)->count();

    $decode = JWT::decode($token, $key, array('HS256'));
    $decode_array = (array) $decode;

    if($tokenDB > 0){
        $this->validate($request,
            [
                'id_pengadaan' => 'required',
                'anggaran' => 'required|numeric',
                'proposal' => 'required|mimes:pdf|max:2000'
            ]);
        
        $cekPengajuan = M_Pengajuan::where('id_supplier', $decode_array['id_supplier'])->where('id_pengadaan', $request->id_pengadaan)->count();

        if($cekPengajuan == 0){
            $path = $request->file('proposal')->store('public/proposal');
            if(M_Pengajuan::create([
                "id_pengadaan" => $request->id_pengadaan,
                "id_supplier" => $decode_array['id_supplier'],
                "proposal" => $path,
                "anggaran" => $request->anggaran
            ])){
                return redirect ('/listSupplier')->with('berhasil', 'Pengajuan Berhasil Disimpan');
            } else{
                return redirect ('/listSupplier')->with('gagal', 'Pengajuan Gagal Disimpan');   
            }
        }else{
            return redirect ('/listSupplier')->with('gagal', 'Pengajuan Sudah Pernah Dilakukan');
        }
    }else{
        return redirect ('/masukSupplier')->with('gagal', 'Anda Harus Login Terlebih Dahulu');
    }
    }

    public function terimaPengajuan($id){
        $token = Session::get('token');
        $tokenDB = M_Admin::where('token', $token)->count();

        if($tokenDB > 0){
            if(M_Pengajuan::where('id_pengajuan', $id)->update(
                [
                    "status" => "2"
                ]
            )){
             return redirect ('/pengajuan')->with('berhasil', 'Status Pengajuan Berhasil Diupdate');   
            }else{
             return redirect ('/pengajuan')->with('gagal', 'Status Pengajuan Gagal Diupdate');   
            }
        }else{
            return redirect ('/masukAdmin')->with('gagal', 'Anda Harus Login Sebagai Admin Terlebih Dahulu');
        }
    }

    public function tolakPengajuan($id){
        $token = Session::get('token');
        $tokenDB = M_Admin::where('token', $token)->count();

        if($tokenDB > 0){
            if(M_Pengajuan::where('id_pengajuan', $id)->update(
                [
                    "status" => "0"
                ]
            )){
             return redirect ('/pengajuan')->with('berhasil', 'Status Pengajuan Berhasil Diupdate');   
            }else{
             return redirect ('/pengajuan')->with('gagal', 'Status Pengajuan Gagal Diupdate');   
            }
        }else{
            return redirect ('/masukAdmin')->with('gagal', 'Anda Harus Login Sebagai Admin Terlebih Dahulu');
        }
    }

    public function selesaiPengajuan($id){
        $token = Session::get('token');
        $tokenDB = M_Admin::where('token', $token)->count();

        if($tokenDB > 0){
            if(M_Pengajuan::where('id_pengajuan', $id)->update(
                [
                    "status" => "3"
                ]
            )){
             return redirect ('/laporan')->with('berhasil', 'Status Pengajuan Berhasil Diupdate');   
            }else{
             return redirect ('/laporan')->with('gagal', 'Status Pengajuan Gagal Diupdate');   
            }
        }else{
            return redirect ('/masukAdmin')->with('gagal', 'Anda Harus Login Sebagai Admin Terlebih Dahulu');
        }
    }

    public function riwayat(){
        $key = env('APP_KEY');
        $token = Session::get('token');
        $tokenDB = M_Supplier::where('token', $token)->count();

        $decode = JWT::decode($token, $key, array('HS256'));
        $decode_array = (array) $decode;

        if($tokenDB > 0){
            $pengajuan = M_Pengajuan::where('id_supplier', $decode_array['id_supplier'])->get();
            $dataArr = array();

            foreach($pengajuan as $p){
                $pengadaan = M_Pengadaan::where('id_pengadaan', $p->id_pengadaan)->first();
                $sup = M_Supplier::where('id_supplier', $decode_array['id_supplier'])->first();
                $lapCount = M_Laporan::where('id_pengajuan', $p->id_pengajuan)->count();
                $lap = M_Laporan::where('id_pengajuan', $p->id_pengajuan)->first();

                if($lapCount > 0){
                    $lapLink = $lap->laporan;
                }else{
                    $lapLink = "-";
                }

                $dataArr[]=array(
                    "id_pengajuan"=>$p->id_pengajuan,
                    "nama_pengadaan"=>$pengadaan->nama_pengadaan,
                    "gambar"=>$pengadaan->gambar,
                    "anggaran"=>$p->anggaran,
                    "proposal"=>$p->proposal,
                    "anggaran_pengajuan"=>$p->anggaran,
                    "status_pengajuan"=>$p->status,
                    "nama_supplier"=>$sup->nama_badan,
                    "email_supplier"=>$sup->email,
                    "alamat_supplier"=>$sup->alamat,
                    "laporan"=>$lapLink
                );
            }
            $data['su'] = M_Supplier::where('token', $token)->first();
            $data['pengajuan'] = $dataArr;
            return view ('login_supp.riwayat_pengajuan', $data);
        }else{
            return redirect ('/listSupplier')->with('gagal', 'Pengajuan Sudah Pernah Dilakukan');
        }
    }

    public function tambahLaporan(Request $request){
    $key = env('APP_KEY');
    $token = Session::get('token');
    $tokenDB = M_Supplier::where('token', $token)->count();

    $decode = JWT::decode($token, $key, array('HS256'));
    $decode_array = (array) $decode;

    if($tokenDB > 0){
        $this->validate($request,
            [
                'id_pengajuan' => 'required',
                'laporan' => 'required|mimes:pdf|max:2000'
            ]);
        
        $cekLaporan = M_Laporan::where('id_supplier', $decode_array['id_supplier'])->where('id_pengajuan', $request->id_pengajuan)->count();

        if($cekLaporan == 0){
            $path = $request->file('laporan')->store('public/laporan');
            if(M_Laporan::create([
                "id_pengajuan" => $request->id_pengajuan,
                "id_supplier" => $decode_array['id_supplier'],
                "laporan" => $path
            ])){
                return redirect ('/riwayat')->with('berhasil', 'Laporan Berhasil Diupload');
            } else{
                return redirect ('/riwayat')->with('gagal', 'Laporan Gagal Diupload');   
            }
        }else{
            return redirect ('/riwayat')->with('gagal', 'Laporan Sudah Pernah Diupload');
        }
    }else{
        return redirect ('/masukSupplier')->with('gagal', 'Anda Harus Login Terlebih Dahulu');
    }
    }

    public function laporan(){
        $key = env('APP_KEY');
        $token = Session::get('token');
        $tokenDB = M_Admin::where('token', $token)->count();

        if($tokenDB > 0){
            $pengajuan=M_Pengajuan::where('status', '2')->paginate(15);
            $dataP = array();

            foreach ($pengajuan as $p) {
                $pengadaan = M_Pengadaan::where('id_pengadaan', $p->id_pengadaan)->first();
                $sup = M_Supplier::where('id_supplier', $p->id_supplier)->first();
                $c_laporan = M_Laporan::where('id_pengajuan', $p->id_pengajuan)->count();
                $laporan = M_Laporan::where('id_pengajuan', $p->id_pengajuan)->first();

                if($c_laporan > 0){
                $dataP[]=array(
                    "id_pengajuan"=>$p->id_pengajuan,
                    "nama_pengadaan"=>$pengadaan->nama_pengadaan,
                    "gambar"=>$pengadaan->gambar,
                    "anggaran"=>$p->anggaran,
                    "proposal"=>$p->proposal,
                    "anggaran_pengajuan"=>$p->anggaran,
                    "status_pengajuan"=>$p->status,
                    "nama_supplier"=>$sup->nama_badan,
                    "email_supplier"=>$sup->email,
                    "alamat_supplier"=>$sup->alamat,
                    "laporan"=>$laporan->laporan,
                    "id_laporan"=>$laporan->id_laporan
                );
                }
            }
            $data['pengajuan'] = $dataP;
            return view('admin.laporan', $data);
        }else{
          return redirect ('/masukAdmin')->with('gagal', 'Anda Harus Login Sebagai Admin Terlebih Dahulu');
      }
  }

  public function pengajuanselesai(){
        $key = env('APP_KEY');
        $token = Session::get('token');
        $tokenDB = M_Supplier::where('token', $token)->count();

        $decode = JWT::decode($token, $key, array('HS256'));
        $decode_array = (array) $decode;

        if($tokenDB > 0){
            $pengajuan = M_Pengajuan::where('id_supplier', $decode_array['id_supplier'])->where('status', '3')->get();
            $dataArr = array();

            foreach($pengajuan as $p){
                $pengadaan = M_Pengadaan::where('id_pengadaan', $p->id_pengadaan)->first();
                $sup = M_Supplier::where('id_supplier', $decode_array['id_supplier'])->first();
                $lapCount = M_Laporan::where('id_pengajuan', $p->id_pengajuan)->count();
                $lap = M_Laporan::where('id_pengajuan', $p->id_pengajuan)->first();

                if($lapCount > 0){
                    $lapLink = $lap->laporan;
                }else{
                    $lapLink = "-";
                }

                $dataArr[]=array(
                    "id_pengajuan"=>$p->id_pengajuan,
                    "nama_pengadaan"=>$pengadaan->nama_pengadaan,
                    "gambar"=>$pengadaan->gambar,
                    "anggaran"=>$p->anggaran,
                    "proposal"=>$p->proposal,
                    "anggaran_pengajuan"=>$p->anggaran,
                    "status_pengajuan"=>$p->status,
                    "nama_supplier"=>$sup->nama_badan,
                    "email_supplier"=>$sup->email,
                    "alamat_supplier"=>$sup->alamat,
                    "laporan"=>$lapLink
                );
            }
            $data['su'] = M_Supplier::where('token', $token)->first();
            $data['pengajuan'] = $dataArr;
            return view ('login_supp.pengajuanselesai', $data);
        }else{
            return redirect ('/listSupplier')->with('gagal', 'Pengajuan Sudah Pernah Dilakukan');
        }
    }

    public function tolakLaporan($id){
        $token = Session::get('token');
        $tokenDB = M_Admin::where('token', $token)->count();

        if($tokenDB > 0){
            $laporan = M_Laporan::where('id_laporan', $id)->count();

            if($laporan > 0){
                $dataLaporan = M_Laporan::where('id_laporan', $id)->first();

                if(Storage::delete($dataLaporan->laporan)){
                    if(M_Laporan::where('id_laporan', $id)->delete()){
                        return redirect ('/laporan')->with('berhasil', 'Laporan Berhasil Ditolak');
                    }else{
                        return redirect ('/laporan')->with('gagal', 'Laporan Gagal Ditolak');                          
                    }
                }else{
                    return redirect ('/laporan')->with('gagal', 'Laporan Gagal Ditolak');  
                }
            }else{
                return redirect ('/laporan')->with('gagal', 'Laporan Tidak Ditemukan');
            }
        }else{
            return redirect ('/masukAdmin')->with('gagal', 'Anda Harus Login Terlebih Dahulu'); 
        }
    }
}
