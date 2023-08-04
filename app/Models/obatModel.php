<?php

namespace App\Models;

use CodeIgniter\Model;

class obatModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_obat';
    protected $primaryKey       = 'kode_obat';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['kode_obat', 'nama_obat', 'harga_obat', 'stok', 'keterangan'];
}
