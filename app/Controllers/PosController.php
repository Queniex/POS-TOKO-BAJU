<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use App\Models\ProductModel;
use App\Models\OrderModel;
use App\Models\TransactionModel;
use App\Controllers\BaseController;

class PosController extends BaseController
{
    protected $pos_model, $product_model, $employee_model, $transaction_model;
    protected $data, $session;
    protected $helpers = ['form'];

    public function __construct(){
        $this->session= \Config\Services::session();
        $this->data['session'] = $this->session;
        $this->order_model = new OrderModel();
        $this->transaction_model = new TransactionModel();
        $this->product_model = new ProductModel();
        $this->employee_model = new EmployeeModel();
    }

    public function index()
    {
        $this->data = [
            "page-title" => "List Order",
            "menu" => "pos-list",
            'validation' => \Config\Services::validation(),
            "transactions" => $this->transaction_model->orderBy('id_transaksi ASC')->select('*')->join('master_karyawan', 'master_karyawan.id_karyawan = transaksi.id_karyawan')->get()->getResult()
        ];
        return view('pos/list', $this->data);
    }

    public function add()
    {
        $this->data = [
            "page-title" => "List Order",
            "menu" => "pos-add",
            'validation' => \Config\Services::validation(),
            "products" => $this->product_model->orderBy('id_barang ASC')->select('*')->get()->getResult(),
            "user" => $this->employee_model->where('id_pengguna', session()->get('logged_in')['id'])->first()
        ];
        return view('pos/add', $this->data);
    }

    public function view($id=''){
        if(empty($id)){
            // $this->session->setFlashdata('error_message','Unknown Data ID.') ;
            return redirect()->to('/pos/list');
        }

        $qry= $this->order_model->select("*")->join('transaksi', 'transaksi.id_transaksi = pemesanan.id_transaksi')->join('master_barang', 'master_barang.id_barang = pemesanan.id_barang')->join('master_karyawan', 'master_karyawan.id_karyawan = transaksi.id_karyawan')->where(['transaksi.id_transaksi'=>$id]);
        $this->data = [
            "page-title" => "List Order",
            "menu" => "pos-add",
            'validation' => \Config\Services::validation(),
            "items" => $qry->get()->getResult()
        ];
        return view('pos/view', $this->data);
    }

    public function delete($id=''){
        session();
        if(empty($id)){
            // session()->setFlashdata('pesan', 'Id Data Tidak Ditemukan');
            // session()->setFlashdata('warna', 'danger');
            return redirect()->to(base_url('/pos/index'));
        }

        $delete = $this->transaction_model->delete($id);
        if($delete){
            // session()->setFlashdata('pesan', 'Data berhasil dihapus');
            // session()->setFlashdata('warna', 'success');
            return redirect()->to('pos/index');
        }
    }

}
