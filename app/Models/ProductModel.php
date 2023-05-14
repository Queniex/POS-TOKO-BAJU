<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class ProductModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'master_barang';
    protected $primaryKey       = 'id_barang';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_barang', 'id_jenis','foto_barang', 'kuantitas', 'ukuran_barang', 'harga_per_satuan'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
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

    public function getBarang()
    {
        return $this->findAll(); 
    }
}