<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use App\Models\ProductModel;
use App\Models\OrderModel;
use App\Controllers\BaseController;

class OrderController extends BaseController
{
    protected $order_model, $product_model, $employee_model;
    protected $data, $session;
    protected $helpers = ['form'];

    public function __construct(){
        $this->session= \Config\Services::session();
        $this->data['session'] = $this->session;
        $this->order_model = new OrderModel();
        $this->product_model = new ProductModel();
        $this->employee_model = new EmployeeModel();
    }

    public function index()
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

    public function view()
    {
        $this->data = [
            "page-title" => "List Order",
            "menu" => "pos-add",
            'validation' => \Config\Services::validation(),
            // "list" => $this->order_model->orderBy('id_pemesanan ASC')->select('*')->get()->getResult()
        ];
        return view('pos/view', $this->data);
    }

    public function list()
    {
        $this->data = [
            "page-title" => "List Order",
            "menu" => "pos-list",
            'validation' => \Config\Services::validation(),
            // "list" => $this->order_model->orderBy('id_pemesanan ASC')->select('*')->get()->getResult()
        ];
        return view('pos/list', $this->data);
    }
}
