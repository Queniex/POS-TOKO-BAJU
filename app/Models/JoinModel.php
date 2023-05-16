<?php

namespace App\Models;

use CodeIgniter\Model;

class JoinModel extends Model
{
    protected $table_x = 'master_barang';
    protected $table_y = 'jenis_barang';

    public function get_join_data()
    {
        return $this->db->table('table_x')
        ->select('table_x.*, table_y.jenis_barang')
        ->join('table_x', 'table_x.id_jenis = table_y.id_jenis', 'left')
        ->Get()>getResultArray();
    }
}
