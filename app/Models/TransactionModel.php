<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class TransactionModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'transaksi';
    protected $primaryKey       = 'id_transaksi';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_karyawan', 'total_barang', 'harga_total', 'harga_bayar', 'nama_pembeli', 'tgl_pembelian'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'tgl_pembelian';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    // function get_join($id) {
    //     $builder = $this->db->table('mahasiswa');
    //     $builder->join('jp', 'jp.id = mahasiswa.id_jp');
    //     $query = $builder->where('mahasiswa.id', $id)->get();
    //     $result = $query->getRow();

    //     return $result;
    // }

    public function getJenisBarang()
    {
        return $this->findAll(); 
    }
}