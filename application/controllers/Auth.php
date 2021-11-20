<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
    }

    public function index()
    {
        if ($this->session->userdata('username')) {
            redirect('menu');
        }
        $data =  [
            'judul' => 'login-page'
        ];
        $this->load->view('auth/auth-header', $data);
        $this->load->view('auth/login');
        $this->load->view('auth/auth-footer');
    }

    public function login()
    {
        $rules = [
            [
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi'
                ]
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => '{field} wajib di isi',
                    'min_length' => 'Password minimal 8 karakter'
                ]
            ]
        ];
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == false) {
            $msg = [
                'error' => [
                    'username' => form_error('username'),
                    'password' => form_error('password')
                ]
            ];
            echo json_encode($msg);
        } else {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $data = [
                'users' => $this->Auth_model->getUser($username)
            ];
            if (is_null($data['users'])) {
                $msg = [
                    'response' => 'username_null',
                    'message' => 'Username belum terdaftar'
                ];
                echo json_encode($msg);
            } else {
                $data = [
                    'users' => $data['users'],
                    'cek_password' => password_verify($password, $data['users']['password'])
                ];
                $user_data = [
                    'id' => $data['users']['id'],
                    'username' => $data['users']['username'],
                    'level_id' => $data['users']['level_id'],
                    'level' => $data['users']['level']
                ];
                echo json_encode($data);
                $this->session->set_userdata($user_data);
            }
        }
    }

    public function sign_out()
    {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('level_id');

        $msg = [
            'response' => 'success',
            'message' => 'Logout berhasil'
        ];
        echo json_encode($msg);
    }
}
