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

    // Initialize Objects
    public function __construct(){
        $this->product_model = new ProductModel();
        $this->product_type_model = new ProductTypeModel();
        $this->data['session'] = \Config\Services::session();
    }

    public function index()
    {
        $this->data = [
            "page-title" => "List Barang",
            "menu" => "product-list",
            "list" => $this->product_model->orderBy('id_barang ASC')->select('*')->join('jenis_barang', 'jenis_barang.id_jenis = master_barang.id_jenis')->get()->getResult()
        ];
        return view('manajemen-barang/list', $this->data);
    }

    // Create Form Page
    public function create(){
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
                $fileSampul = $this->request->getFile('foto_barang');
                $fileSampul->move('img/product');
                $namaSampul = $fileSampul->getName();
                $post['foto_barang'] = $namaSampul;

                $save = $this->product_model->insert($post);
            } 
            if($save){
                    if(!empty($this->request->getPost('id_barang')))
                    // $this->session->setFlashdata('success_message','Data has been updated successfully') ;
                    // else
                    // $this->session->setFlashdata('success_message','Data has been updated successfully') ;
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

        $foto = $this->product_model->select('foto_barang')->where('id_barang', $id)->first()['foto_barang'];
        unlink('img/product/' . $foto);

        $delete = $this->product_model->delete($id);
        if($delete){
            // session()->setFlashdata('pesan', 'Data berhasil terhapus');
            // session()->setFlashdata('warna', 'danger');
            return redirect()->to('product/index');
        }
    }

}
