<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;
use App\Models\UserModel;


class EmployeeController extends BaseController
{
    // Model 
    protected $data, $employee_model, $user_model;
    protected $helpers = ['form'];

    // Initialize Objects
    public function __construct(){
        $this->session= \Config\Services::session();
        $this->data['session'] = $this->session;
        $this->employee_model = new EmployeeModel();
        $this->user_model = new UserModel();
    }

    public function index()
    {
        $this->data = [
            "page-title" => "List Karyawan",
            "menu" => "employee-list",
            'validation' => \Config\Services::validation(),
            "list" => $this->employee_model->orderBy('id_karyawan ASC')->select('*')->join('master_pengguna', 'master_pengguna.id = master_karyawan.id_pengguna')->get()->getResult()
        ];
        return view('manajemen-karyawan/list', $this->data);
    }

    // Create Form Page
    public function create(){
        session();
        $this->data = [
            "page-title" => "Tambah Karyawan",
            "menu" => "employee-add",
            'validation' => \Config\Services::validation(),
            "request"=>$this->request
        ];
        return view('manajemen-karyawan/add_account', $this->data);
    }

    public function next($id=''){
        // var_dump($this->request->getPost('username'));

        $id = $this->request->getPost('id');
        
        session();  
        $this->data = [
            "page-title" => "Tambah Karyawan",
            'validation' => \Config\Services::validation(),
            "menu" => "employee-add",
            "username" => $this->request->getPost('username'),
            "email" => $this->request->getPost('email'),
            "password" => $this->request->getPost('password'),
            "role" => $this->request->getPost('role'),
            "request"=>$this->request
        ];

        if($id != NULL){
            $idKaryawan = $this->employee_model->select('id_karyawan')->where('id_pengguna', $id)->first()['id_karyawan'];
            $qry= $this->employee_model->select('*')->join('master_pengguna', 'master_pengguna.id = master_karyawan.id_pengguna')->where(['id_karyawan'=>$idKaryawan]);
            $this->data["list"] = $qry->first();
            return view('manajemen-karyawan/edit_employee', $this->data);
        } else {
            return view('manajemen-karyawan/add_employee', $this->data);
        }
    }

    // Save Form Page
    public function save(){
        $dataInput = $this->request->getVar();    

        $dataAkun = [
            "username" => esc($dataInput['username']),
            "email" => esc($dataInput['email']),
            "password" => password_hash(esc($dataInput['password']), PASSWORD_BCRYPT),
            "role" => esc($dataInput['role'])
        ];   

        if(!empty($this->request->getPost('id_karyawan'))){
            $idPengguna = $this->user_model->select('id')->where('username', $dataAkun['username'])->first()['id'];

            $post = [
                'nama_karyawan' => esc($dataInput['nama_karyawan']),
                'jenis_kelamin' => esc($dataInput['jenis_kelamin']),
                'no_tlp' => esc($dataInput['no_tlp']),
                'alamat' => esc($dataInput['alamat']),
                'id_pengguna' => $idPengguna
            ];  

            $fileSampul = $this->request->getFile('foto_karyawan');
  
            if ($fileSampul->getError() != 4) {
                unlink('img/employee/' . $this->request->getVar("oldGambar"));
                $fileSampul->move('img/employee');
                $namaSampul = $fileSampul->getName();
                $post['foto_karyawan'] = $namaSampul;
            }
            
            $save = $this->employee_model->where(['id_karyawan'=>$this->request->getPost('id_karyawan')])->set($post)->update();
        }
        else{
            $this->user_model->insert($dataAkun);
            $idPengguna = $this->user_model->select('id')->where('username', $dataAkun['username'])->first()['id'];

            $post = [
                'nama_karyawan' => esc($dataInput['nama_karyawan']),
                'jenis_kelamin' => esc($dataInput['jenis_kelamin']),
                'no_tlp' => esc($dataInput['no_tlp']),
                'alamat' => esc($dataInput['alamat']),
                'id_pengguna' => $idPengguna
            ];   

            $fileSampul = $this->request->getFile('foto_karyawan');
            $fileSampul->move('img/employee');
            $namaSampul = $fileSampul->getName();
            $post['foto_karyawan'] = $namaSampul;

            $save = $this->employee_model->insert($post);
        } 
        if($save){
            if(!empty($this->request->getPost('id_karyawan')))
            $this->session->setFlashdata('success_message','Data has been updated successfully') ;
            else
            $this->session->setFlashdata('success_message','Data has been updated successfully') ;
            $id =!empty($this->request->getPost('id_karyawan')) ? $this->request->getPost('id_karyawan') : $save;
            return redirect()->to('/employee/index');
        }else{
            return view('manajemen-karyawan/add_employee', $this->data);
        }     

    }
    
    // Edit Form Page
    public function edit($id=''){
        if(empty($id)){
            // session()->setFlashdata('pesan', 'ID Tidak Ditemukan!');
            // session()->setFlashdata('warna', 'danger');
            return redirect()->to('/employee/index');
        }
        $idPengguna = $this->employee_model->select('id_pengguna')->where('id_karyawan', $id)->first()['id_pengguna'];
        $qry= $this->user_model->select('*')->where(['id'=>$idPengguna]);

        $this->data = [
            "page-title" => "Edit Karyawan",
            "menu" => "overview",
            'validation' => \Config\Services::validation(),
            "request"=>$this->request,
            "data" => $qry->first()
        ];
        return view('manajemen-karyawan/edit_account', $this->data);
    }

    // Delete Data
    public function delete($id=''){
        if(empty($id)){
            return redirect()->to(base_url('/login'))->with('daftar_berhasil', 'Pendaftaran Akun Berhasil');
        }

        $foto = $this->employee_model->select('foto_karyawan')->where('id_karyawan', $id)->first()['foto_karyawan'];
        unlink('img/employee/' . $foto);
        $idPengguna = $this->employee_model->select('id_pengguna')->where('id_karyawan', $id)->first()['id_pengguna'];
        $delete = $this->employee_model->delete($id);
        $deletes = $this->user_model->delete($idPengguna);

        if($delete && $deletes){
            return redirect()->to('employee/index');
        }
    }
}
