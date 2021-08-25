<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class M_Laporan extends Model
{
    protected $table = 'tb_laporan';
    protected $primaryKey = 'id_laporan';
    protected $fillable = ['id_laporan', 'id_pengajuan', 'id_supplier', 'laporan'];
}
