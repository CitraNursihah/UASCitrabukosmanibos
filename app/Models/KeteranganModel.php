<?php

namespace App\Models;

use CodeIgniter\Model;

class KeteranganModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_keterangan';
    protected $primaryKey       = 'kode_keterangan';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['kode_keterangan', 'nama_rak', 'nama_keterangan', 'jumlah_item'];
}
