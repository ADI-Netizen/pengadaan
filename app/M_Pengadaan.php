<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class M_Pengadaan extends Model
{
    protected $table = 'tb_pengadaan';
    protected $primaryKey = 'id_pengadaan';
    protected $fillable = ['id_pengadaan', 'nama_pengadaan', 'deskripsi', 'gambar', 'anggaran', 'status'];
}
