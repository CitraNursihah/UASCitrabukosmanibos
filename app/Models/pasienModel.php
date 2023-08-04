<?php

namespace App\Models;

use CodeIgniter\Model;

class pasienModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_pasien';
    protected $primaryKey       = 'kode_pasien';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['kode_pasien', 'nama_pasien', 'dosis', 'harga','jenis_obat'];
}
