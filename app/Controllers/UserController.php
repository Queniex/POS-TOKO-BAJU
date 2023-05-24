<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\EmployeeModel;
use App\Models\ProductModel;
// use \Config\Services;
use App\Controllers\BaseController;
use Config\Services;

class UserController extends BaseController
{
    protected $data;
    protected $model, $session, $employees, $products;

    public function __construct()
    {
        $this->model = new UserModel();
        $this->employees = new EmployeeModel();
        $this->products = new ProductModel();
        $this->data['session'] = \Config\Services::session();
    }
    public function index()
    {
        //
        $this->data = [
            "page-title" => "Dashboard",
            "menu" => "overview",
            "user" => $this->employees->where('id_pengguna', session()->get('logged_in')['id'])->first(),
            "count_employees" => count($this->employees->findAll()),
            "count_products" => count($this->products->findAll())
        ];
        return view('dashboard/index', $this->data);
    }

    public function login()
    {
        return view('login-register/login');
    }

    public function logout()
    {
        session()->removeTempdata('logged_in');
        session()->setFlashdata('logout', "berhasil logout, silahkan login kembali");
        return redirect()->to(base_url('/login'));
    }

    public function register()
    {
        // helper('form');
        // $this->data['validation'] = \Config\Services::validation();
        // d($this->session);
        // d($this->data['validation']);
        return view('login-register/register', $this->data);
    }

    public function store()
    {

        $dataInput = $this->request->getVar();

        $filterData = [
            "username" => esc($dataInput['username']),
            "email" => esc($dataInput['email']),
            "password" => password_hash(esc($dataInput['password']), PASSWORD_BCRYPT),
        ];

        $rulesSet = [
            "username" => [
                "rules" => "required|max_length[8]|is_unique[master_pengguna.username]",
                "errors" => [
                    "required" => "Harap isi {field} terlebih dahulu",
                    "max_length" => "{field} maksimal karakter 20",
                    "is_unique" => "{field} sudah terdaftar",
                ]
            ],
            "email" => [
                "rules" => "required|valid_email",
                "errors" => [
                    "required" => "Harap isi {field} terlebih dahulu",
                    "valid_email" => "format {field} salah",
                ]
            ],
            "password" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Harap isi password terlebih dahulu"
                ]
            ],
        ];

        // dd($this->validate($rulesSet));
        if (!$this->validate($rulesSet)) {
            return redirect()->to(base_url('/register'))->withInput();
        }

        // Insert ke db
        $this->model->insert($filterData);
        $this->authenticate();
        return redirect()->to(base_url('/login'))->with('daftar_berhasil', 'Pendaftaran Akun Berhasil');
    }

    public function authenticate()
    {
        $dataInput = $this->request->getVar();
        $filterData = [
            "username" => esc($dataInput['username']),
            "password" => esc($dataInput['password']),
        ];

        // dd($filterData["username"]);
        $role = $this->model->select('role')->where('username', $filterData["username"])->first()['role'];

        $rulesSet = [
            "username" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Harap isi {field} terlebih dahulu",
                ]
            ],
            "password" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Harap isi password terlebih dahulu"
                ]
            ],
        ];

        if (!$this->validate($rulesSet)) {
            return redirect()->to(base_url('/login'))->withInput();
        }

        // Cari akun pengguna
        $login_account = $this->model->getAccountByUsername($filterData['username']);

        // Cek passwordnya
        if ($login_account) {
            $password = $login_account['password'];
            if (password_verify($filterData['password'], $password)) {

                if($role == "admin") {
                    session()->set([
                        'role' => 'admin',
                        'logged_in' => $login_account
                    ]);
                    return redirect()->to(base_url('/dashboard'));
                } else if ($role == "kasir") {
                    session()->set([
                        'role' => 'kasir',
                        'logged_in' => $login_account
                    ]);
                    return redirect()->to(base_url('/dashboard'));
                } else {
                    session()->setFlashdata('Gagal', "Role tidak dikenali, silahkan login kembali");
                    return redirect()->back();
                }
            }
        }

        // Kalo ga ditemukan
        return redirect()->to(base_url('/login'))->with('not_found', 'Username atau password salah');
    }

}
