<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class ProductTypeModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jenis_barang';
    protected $primaryKey       = 'id_jenis';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['jenis_barang'];

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

    public function getJenisBarang()
    {
        return $this->findAll(); 
    }
}