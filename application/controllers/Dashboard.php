<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($id)
    {
        $data =  [
            'judul' => 'dashboard',
            'id' => $id,
            'users' => $this->db->get_where('users',['username' => $this->session->userdata('username')])->row_array()
        ];

        $this->load->view('templete/header', $data);
        $this->load->view('dashboard/index');
        $this->load->view('templete/footer');
    }
}
