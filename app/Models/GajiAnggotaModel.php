<?php

namespace App\Models;

use CodeIgniter\Model;

class GajiAnggotaModel extends Model
{
    protected $table = 'gaji_anggota';
    protected $primaryKey = 'id_gaji_anggota';
    protected $allowedFields = ['id_anggota', 'id_komponen_gaji', 'jumlah'];
    protected $returnType = 'array';
}