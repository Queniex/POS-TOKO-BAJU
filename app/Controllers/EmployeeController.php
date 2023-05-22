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
    protected $perPage = 2;

    // Initialize Objects
    public function __construct(){
        // $this->session= \Config\Services::session();
        // $this->data['session'] = $this->session;
        $this->employee_model = new EmployeeModel();
        $this->user_model = new UserModel();
        $this->data['pagination'] = 2;
    }

    public function index()
    {
        $keyword = $this->request->getVar('keyword');
        $query = $this->employee_model->orderBy('id_karyawan ASC')->select('*')->join('master_pengguna', 'master_pengguna.id = master_karyawan.id_pengguna');
        if ($keyword) {
            $query->like('nama_karyawan', $keyword);
        }
        $result = $query->paginate($this->perPage, "employees");
        $this->data = [
            "page-title" => "List Karyawan",
            "menu" => "employee-list",
            'validation' => \Config\Services::validation(),
            "list" => $result,
            "pager" => $this->employee_model->pager
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
        session();
        $id = $this->request->getPost('id');

        if($id != NULL){
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
            

            $idKaryawan = $this->employee_model->select('id_karyawan')->where('id_pengguna', $id)->first()['id_karyawan'];
            $qry= $this->employee_model->select('*')->join('master_pengguna', 'master_pengguna.id = master_karyawan.id_pengguna')->where(['id_karyawan'=>$idKaryawan]);
            $this->data["list"] = $qry->first();
            return view('manajemen-karyawan/edit_employee', $this->data);
        } else {
            if(!$this->validate([
                "username" => [
                    "rules" => "required|max_length[20]|is_unique[master_pengguna.username]",
                    "errors" => [
                        "required" => "Harap isi {field} terlebih dahulu",
                        "max_length" => "{field} maksimal karakter 20",
                        "is_unique" => "{field} sudah terdaftar",
                    ]
                ],
                "password" => [
                    "rules" => "required",
                    "errors" => [
                        "required" => "Harap isi {field} terlebih dahulu"
                    ]
                ],
                "role" => [
                    "rules" => "required",
                    "errors" => [
                        "required" => "Harap isi {field} terlebih dahulu"
                    ]
                ],
                "email" => [
                    "rules" => "required|valid_email|max_length[50]",
                    "errors" => [
                        "required" => "Harap isi {field} terlebih dahulu",
                        "valid_email" => "format {field} salah",
                        "max_length" => "{field} maksimal karakter 50",
                    ]
                ],
            ])){
                $validation = \Config\Services::validation();
                return redirect()->back()->withInput(); 
            }
    
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
            
            return view('manajemen-karyawan/add_employee', $this->data);
        }
    }

    // Save Form Page
    public function save(){
        session();
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

            if(!$this->validate([
                "nama_karyawan" => [
                    "rules" => "required|is_unique[master_karyawan.nama_karyawan]",
                    "errors" => [
                        "required" => "Harap isi nama karyawan terlebih dahulu",
                        "is_unique" => "Nama karyawan sudah terdaftar",
                    ]
                ],
                "jenis_kelamin" => [
                    "rules" => "required",
                    "errors" => [
                        "required" => "Harap isi jenis kelamin karyawan terlebih dahulu"
                    ]
                ],
                "alamat" => [
                    "rules" => "required",
                    "errors" => [
                        "required" => "Harap isi {field} terlebih dahulu"
                    ]
                ],
                "no_tlp" => [
                    "rules" => "required|max_length[20]",
                    "errors" => [
                        "required" => "Harap isi nomor telepon terlebih dahulu",
                        "max_length" => "Digit nomor telepon maks. 20",
                    ]
                ],
                "foto_karyawan" => [
                    "rules" => "uploaded[foto_karyawan]|max_size[foto_karyawan,2048]|mime_in[foto_karyawan,image/png,image/jpg,image/jpeg]",
                    "errors" => [
                        "uploaded" => "Harap cantumkan foto karyawan terlebih dahulu",
                        "max_size" => "Ukuran maks. foto karyawan 2 MB",
                        "mime_in" => "Format foto karyawan hanya dalam bentuk png, jpg, dan jpeg",
                    ]
                ],
            ])){
                $validation = \Config\Services::validation();
                return redirect()->back()->withInput(); 
            }

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
            if(!empty($this->request->getPost('id_karyawan'))) {
                session()->setFlashdata('pesan', 'Data berhasil diupdate');
                session()->setFlashdata('warna', 'primary');
            } else {
                session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
                session()->setFlashdata('warna', 'success');
            }
            $id =!empty($this->request->getPost('id_karyawan')) ? $this->request->getPost('id_karyawan') : $save;
            return redirect()->to('/employee/index');
        }else{
            return view('manajemen-karyawan/add_employee', $this->data);
        }     

    }
    
    // Edit Form Page
    public function edit($id=''){
        if(empty($id)){
            session()->setFlashdata('pesan', 'ID Tidak Ditemukan!');
            session()->setFlashdata('warna', 'danger');
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
            session()->setFlashdata('pesan', 'ID Data Tidak Ditemukan');
            session()->setFlashdata('warna', 'danger');
            return redirect()->to(base_url('/login'))->with('daftar_berhasil', 'Pendaftaran Akun Berhasil');
        }

        $foto = $this->employee_model->select('foto_karyawan')->where('id_karyawan', $id)->first()['foto_karyawan'];
        unlink('img/employee/' . $foto);
        $idPengguna = $this->employee_model->select('id_pengguna')->where('id_karyawan', $id)->first()['id_pengguna'];
        $delete = $this->employee_model->delete($id);
        $deletes = $this->user_model->delete($idPengguna);

        if($delete && $deletes){
            session()->setFlashdata('pesan', 'Data berhasil dihapus');
            session()->setFlashdata('warna', 'danger');
            return redirect()->to('employee/index');
        }
    }
}
