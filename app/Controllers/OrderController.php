<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Controllers\BaseController;

class OrderController extends BaseController
{
    protected $order_model;
    protected $data, $session;
    protected $helpers = ['form'];

    public function __construct(){
        $this->session= \Config\Services::session();
        $this->data['session'] = $this->session;
        $this->order_model = new OrderModel();
    }

    public function index()
    {
        $this->data = [
            "page-title" => "List Order",
            "menu" => "pos-list",
            'validation' => \Config\Services::validation(),
            "list" => $this->order_model->orderBy('id_pemesanan ASC')->select('*')->get()->getResult()
        ];
        return view('pos/add', $this->data);
    }
}
