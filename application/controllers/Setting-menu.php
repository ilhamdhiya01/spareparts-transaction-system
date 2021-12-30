<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_menu');
        cek_access_user();
    }

    public function queryMenu()
    {
        $this->db->select('users.*, tb_posisi.nama_posisi');
        $this->db->join('tb_posisi', 'users.id_posisi = tb_posisi.id');
        $this->db->where('username', $this->session->userdata('username'));
        $data =  [
            'judul' => 'Dashboard',
            'users' => $this->db->get('users')->row_array()
        ];

        $this->load->view('templete/header', $data);
        $this->load->view('dashboard/index');
        $this->load->view('templete/footer');
    }
}
