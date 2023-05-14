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
    protected $data;

    // Initialize Objects
    public function __construct(){
        $this->product_model = new ProductModel();
        $this->product_type_model = new ProductTypeModel();
        $this->session= \Config\Services::session();
        $this->data['session'] = $this->session;
    }

    public function index()
    {
        $this->data = [
            "page-title" => "List Barang",
            "menu" => "overview",
            "list" => $this->product_model->orderBy('id_barang ASC')->select('*')->get()->getResult()
        ];
        return view('manajemen-barang/list', $this->data);
    }

    // Create Form Page
    public function create(){
        $this->data = [
            "page-title" => "Tambah Barang",
            "menu" => "overview",
            'validation' => \Config\Services::validation(),
            "request"=>$this->request,
            "jb" => $this->product_type_model->orderBy('id_jenis ASC')->select('*')->get()->getResult()
        ];
        return view('manajemen-barang/create', $this->data);
    }

    // Save Form Page
    public function save(){
        $this->data['request'] = $this->request;
        $post = [
                    'nama_barang' => $this->request->getPost('nama_barang'),
                    'id_jenis' => $this->request->getPost('id_jenis'),
                    'foto_barang' => $this->request->getPost('foto_barang'),
                    'kuantitas' => $this->request->getPost('kuantitas'),
                    'ukuran_barang' => $this->request->getPost('ukuran_barang'),
                    'harga_per_satuan' => $this->request->getPost('harga_per_satuan')
            ];
        if(!empty($this->request->getPost('id_barang')))
            $save = $this->product_model->where(['id_barang'=>$this->request->getPost('id_barang')])->set($post)->update();
        else 
            $save = $this->product_model->insert($post);
        if($save){
                if(!empty($this->request->getPost('id_barang')))
                $this->session->setFlashdata('success_message','Data has been updated successfully') ;
                else
                $this->session->setFlashdata('success_message','Data has been updated successfully') ;
                $id =!empty($this->request->getPost('id_barang')) ? $this->request->getPost('id_barang') : $save;
                return redirect()->to('/product/index');
            }else{
                return view('manajemen-barang/create', $this->data);
            }   
    }
    

    // Edit Form Page
    public function edit($id=''){
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
        if(empty($id)){
            // session()->setFlashdata('pesan', 'ID Tidak Ditemukan!');
            // session()->setFlashdata('warna', 'danger');
            return redirect()->to(base_url('/login'))->with('daftar_berhasil', 'Pendaftaran Akun Berhasil');
        }

        // // 1. Mencari file gambar berdasarkan id :
        // $gambar = $this->product_model->find($id);
        // // 2. Cek gambar bukan default.jpg :
        // if ($gambar['foto_barang'] != 'default.jpg') {
        //   // 3. Hapus gambar dari file img :
        //   unlink('img/product/' . $gambar['foto_barang']);   
        // }

        $delete = $this->product_model->delete($id);
        if($delete){
            // session()->setFlashdata('pesan', 'Data berhasil terhapus');
            // session()->setFlashdata('warna', 'danger');
            return redirect()->to('product/index');
        }
    }

}
