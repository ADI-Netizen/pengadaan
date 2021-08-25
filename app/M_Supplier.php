<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class M_Supplier extends Model
{
    protected $table = 'tb_supplier';
    protected $primaryKey = 'id_supplier';
    protected $fillable = ['id_supplier', 'nama_badan', 'email', 'alamat', 'npwp', 'password', 'status', 'token'];
}
