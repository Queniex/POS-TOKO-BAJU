<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;
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
    protected $perPage = 10;

    public function __construct(){
        $this->session= \Config\Services::session();
        $this->data['session'] = $this->session;
        $this->order_model = new OrderModel();
        $this->transaction_model = new TransactionModel();
        $this->product_model = new ProductModel();
        $this->employee_model = new EmployeeModel();
        $this->data['pagination'] = 10;
    }

    public function index()
    {
        $query = $this->transaction_model->orderBy('id_transaksi ASC')->select('*')->join('master_karyawan', 'master_karyawan.id_karyawan = transaksi.id_karyawan');
        $result = $query->paginate($this->perPage, "transaction");
        $this->data = [
            "page-title" => "List Order",
            "menu" => "pos-list",
            'validation' => \Config\Services::validation(),
            "transactions" => $result,
            "pager" => $this->transaction_model->pager
        ];
        return view('pos/list', $this->data);
    }

    public function add()
    {
        $this->data = [
            "page-title" => "List Order",
            "menu" => "pos-add",
            'request' => $this->request,
            'validation' => \Config\Services::validation(),
            "products" => $this->product_model->orderBy('id_barang ASC')->select('*')->where('kuantitas >', 0)->get()->getResult(),
            "user" => $this->employee_model->where('id_pengguna', session()->get('logged_in')['id'])->first()
        ];
        return view('pos/add', $this->data);
    }

    public function view($id=''){
        if(empty($id)){
            $this->session->setFlashdata('error_message','Unknown Data ID.') ;
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
        // var_dump($qry->get()->getResult());
    }

    public function edit($id=''){
        session();
        if(empty($id)){
            session()->setFlashdata('pesan', 'ID Tidak Ditemukan!');
            session()->setFlashdata('warna', 'danger');
            return redirect()->to('/pos/index');
        }
        $qry= $this->order_model->select("*")->join('transaksi', 'transaksi.id_transaksi = pemesanan.id_transaksi')->join('master_barang', 'master_barang.id_barang = pemesanan.id_barang')->where(['pemesanan.id_transaksi'=>$id]);
        $this->data = [
            "page-title" => "Edit Barang",
            "menu" => "overview",
            'request' => $this->request,
            'validation' => \Config\Services::validation(),
            "request"=>$this->request,
            "products" => $this->product_model->orderBy('id_barang ASC')->select('*')->get()->getResult(),
            "user" => $this->employee_model->where('id_pengguna', session()->get('logged_in')['id'])->first(),
            "data" => $this->transaction_model->select("*")->where(['transaksi.id_transaksi'=>$id])->first(),
            "history" => $qry->get()->getResult()
        ];
        return view('pos/edit', $this->data);
    }

     public function save(){

        session();

        $dataInput = $this->request->getVar();    
        $idBarang = array_map('intval', $dataInput['id_barang']);
        $nilaiKembali = (int)esc($dataInput['total_kembali']);
        $waktu = Time::now('America/Chicago', 'en_US');
        // dd($dataInput);

        $idPengguna = $this->employee_model->select('id_karyawan')->where('nama_karyawan', $dataInput['nama_karyawan'])->first()['id_karyawan'];
        $post = [
            'id_karyawan' => $idPengguna,
            'harga_total' => esc($dataInput['total_harga']),
            'harga_bayar' => esc($dataInput['total_bayar']),
            'total_kembalian' => $nilaiKembali,
            'nama_pembeli' => esc($dataInput['nama_pembeli']),
            'tgl_pembelian' => $waktu
        ];    
        
        if(!empty($this->request->getPost('id_transaksi'))){
                $save = $this->product_model->where(['id_transaksi'=>$this->request->getPost('id_transaksi')])->set($post)->update();
            }
            else{
                // if(!$this->validate([
                //     "harga_bayar" => [
                //         "rules" => "required",
                //         "errors" => [
                //             "required" => "Harap isi jumlah bayar terlebih dahulu"
                //         ]
                //     ]
                // ])){
                //     $validation = \Config\Services::validation();
                //     return redirect()->back()->withInput(); 
                // }
                $transaction = $this->transaction_model->insert($post);
                // var_dump($transaction);
                if($transaction) {
                    $transaction_id = $this->transaction_model->insertID();
                    foreach($idBarang as $k=>$v){
                        $post2['id_transaksi'] = $transaction_id;
                        $post2['id_barang'] = $v ;
                        $post2['jumlah'] = $dataInput['kuantitas'][$k];
                        $post2['total_harga'] = $dataInput['total_harga_barang'][$k];
                        $order = $this->order_model->insert($post2);
                        // var_dump($order);
                        // echo $v . "\n";
                        $updateQty = $dataInput['kuantitas_awal'][$k] - $dataInput['kuantitas'][$k];
                        $this->product_model->update($post2['id_barang'], ['kuantitas' => $updateQty]);
                }
            } 
            if($transaction){
                $id =!empty($this->request->getPost('id_transaksi')) ? $this->request->getPost('id_transaksi') : $transaction;
                return redirect()->to('pos/index');
            }else{
                return view('pos/add', $this->data);
            }   
        }
    }

    public function delete($id=''){
        session();
        if(empty($id)){
            session()->setFlashdata('pesan', 'ID Data Tidak Ditemukan');
            session()->setFlashdata('warna', 'danger');
            return redirect()->to(base_url('/pos/index'));
        }

        $delete = $this->transaction_model->delete($id);
        if($delete){
            session()->setFlashdata('pesan', 'Data berhasil dihapus');
            session()->setFlashdata('warna', 'danger');
            return redirect()->to('pos/index');
        }
    }

}
