<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\ProductTypeModel;

class ProductController extends BaseController
{
    // Model 
    protected $product_model;
    protected $product_type_model;
    protected $data, $session;
    protected $helpers = ['form'];
    protected $perPage = 3;

    // Initialize Objects
    public function __construct(){
        $this->product_model = new ProductModel();
        $this->product_type_model = new ProductTypeModel();
        $this->data['pagination'] = 3;
    }

    public function index()
    {
        $keyword = $this->request->getVar('keyword');
        $query = $this->product_model->orderBy('id_barang ASC')->select('*')->join('jenis_barang', 'jenis_barang.id_jenis = master_barang.id_jenis');
        if ($keyword) {
            $query->like('nama_barang', $keyword);
        }
        $result = $query->paginate($this->perPage, "products");

        $this->data = [
            "page-title" => "List Barang",
            "menu" => "product-list",
            'validation' => \Config\Services::validation(),
            "list" => $result,
            "pager" => $this->product_model->pager
        ];
        return view('manajemen-barang/list', $this->data);
        //dd($result[0]);
    }

    // Create Form Page
    public function create(){
        session();
        $this->data = [
            "page-title" => "Tambah Barang",
            "menu" => "product-add",
            'validation' => \Config\Services::validation(),
            "request"=>$this->request,
            "jb" => $this->product_type_model->orderBy('id_jenis ASC')->select('*')->get()->getResult()
        ];
        return view('manajemen-barang/create', $this->data);
    }

    // Save Form Page
    public function save(){

        session();

        $dataInput = $this->request->getVar();    
    
        $post = [
            'nama_barang' => esc($dataInput['nama_barang']),
            'id_jenis' => esc($dataInput['id_jenis']),
            'kuantitas' => esc($dataInput['kuantitas']),
            'ukuran_barang' => esc($dataInput['ukuran_barang']),
            'harga_per_satuan' => esc($dataInput['harga_per_satuan'])
        ];    

        if(!empty($this->request->getPost('id_barang'))){
            $fileSampul = $this->request->getFile('foto_barang');

            if ($fileSampul->getError() != 4) {
                unlink('img/product/' . $this->request->getVar("oldGambar"));
                $fileSampul->move('img/product');
                $namaSampul = $fileSampul->getName();
                $post['foto_barang'] = $namaSampul;
            }

                $save = $this->product_model->where(['id_barang'=>$this->request->getPost('id_barang')])->set($post)->update();
            }
            else{

                if(!$this->validate([
                    "nama_barang" => [
                        "rules" => "required|is_unique[master_barang.nama_barang]",
                        "errors" => [
                            "required" => "Harap isi nama produk terlebih dahulu",
                            "is_unique" => "Nama produk sudah terdaftar",
                        ]
                    ],
                    "jenis_barang" => [
                        "rules" => "required",
                        "errors" => [
                            "required" => "Harap isi jenis barang terlebih dahulu"
                        ]
                    ],
                    "ukuran_barang" => [
                        "rules" => "required",
                        "errors" => [
                            "required" => "Harap isi ukuran barang terlebih dahulu"
                        ]
                    ],
                    "kuantitas" => [
                        "rules" => "required|max_length[5]",
                        "errors" => [
                            "required" => "Harap isi {field} terlebih dahulu",
                            "max_length" => "Digit untuk jumlah satuan maks. 5",
                        ]
                    ],
                    "harga" => [
                        "rules" => "required|max_length[11]",
                        "errors" => [
                            "required" => "Harap isi harga satuan terlebih dahulu",
                            "max_length" => "Digit untuk harga satuan maks. 11",
                        ]
                    ],
                    "foto_barang" => [
                        "rules" => "uploaded[foto_barang]|max_size[foto_barang,2048]|mime_in[foto_barang,image/png,image/jpg,image/jpeg]",
                        "errors" => [
                            "uploaded" => "Harap cantumkan foto barang terlebih dahulu",
                            "max_size" => "Ukuran maks. foto barang 2 MB",
                            "mime_in" => "Format foto barang hanya dalam bentuk png, jpg, dan jpeg",
                        ]
                    ],
                ])){
                    $validation = \Config\Services::validation();
                    return redirect()->back()->withInput(); 
                }

                $fileSampul = $this->request->getFile('foto_barang');
                $fileSampul->move('img/product');
                $namaSampul = $fileSampul->getName();
                $post['foto_barang'] = $namaSampul;

                $save = $this->product_model->insert($post);
            } 
            if($save){
                // if(!empty($this->request->getPost('id_barang'))){
                //     session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
                //     session()->setFlashdata('warna', 'success');
                // } else {
                //     session()->setFlashdata('pesan', 'Data berhasil diupdate');
                //     session()->setFlashdata('warna', 'primary');
                // }
                $id =!empty($this->request->getPost('id_barang')) ? $this->request->getPost('id_barang') : $save;
                return redirect()->to('/product/index');
            }else{
                return view('manajemen-barang/create', $this->data);
            }   
    }
    

    // Edit Form Page
    public function edit($id=''){
        session();
        if(empty($id)){
            // session()->setFlashdata('pesan', 'ID Tidak Ditemukan!');
            // session()->setFlashdata('warna', 'danger');
            return redirect()->to('/product/index');
        }
        $qry= $this->product_model->select('*')->where(['id_barang'=>$id]);
        $this->data = [
            "page-title" => "Edit Barang",
            "menu" => "overview",
            'validation' => \Config\Services::validation(),
            "request"=>$this->request,
            "jb" => $this->product_type_model->orderBy('id_jenis ASC')->select('*')->get()->getResult(),
            "data" => $qry->first()
        ];
        return view('manajemen-barang/edit', $this->data);
    }

    // Delete Data
    public function delete($id=''){
        session();
        if(empty($id)){
            session()->setFlashdata('pesan', 'Id Data Tidak Ditemukan');
            session()->setFlashdata('warna', 'danger');
            return redirect()->to(base_url('/login'))->with('daftar_berhasil', 'Pendaftaran Akun Berhasil');
        }

        $foto = $this->product_model->select('foto_barang')->where('id_barang', $id)->first()['foto_barang'];
        unlink('img/product/' . $foto);

        $delete = $this->product_model->delete($id);
        if($delete){
            session()->setFlashdata('pesan', 'Data berhasil dihapus');
            session()->setFlashdata('warna', 'success');
            return redirect()->to('product/index');
        }
    }

}
