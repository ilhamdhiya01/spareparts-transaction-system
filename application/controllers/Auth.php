<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data =  [
            'judul' => 'login-page'
        ];
        $this->load->view('auth/auth-header', $data);
        $this->load->view('auth/login');
        $this->load->view('auth/auth-footer');
    }

    public function registration()
    {
        $data =  [
            'judul' => 'registration-page',
            'posisi' => $this->db->get('tb_posisi')->result_array()
        ];
        $this->form_validation->set_rules('nama_pegawai', 'name', 'required');
        $this->form_validation->set_rules('posisi', 'position', 'required');
        $this->form_validation->set_rules('username', 'username', 'required|is_unique[users.username]|min_length[5]|trim');
        $this->form_validation->set_rules('password', 'password', 'required|min_length[5]|matches[konfirmasi-password]');
        $this->form_validation->set_rules('konfirmasi-password', 'confrimation password', 'required|min_length[5]|matches[password]');

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/auth-header', $data);
            $this->load->view('auth/registration', $data);
            $this->load->view('auth/auth-footer');
        } else {
            $data = [
                'nama_pegawai' => $this->input->post('nama_pegawai'),
                'id_posisi' => $this->input->post('posisi'),
                'gambar' => 'default.png',
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'),PASSWORD_DEFAULT),
                'level_id' => 1,
                'is_active' => 1,
                'date_created' => time()
            ];
        }
    }
}
