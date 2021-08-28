<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data =  [
            'judul' => 'dashboard',
            'users' => $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array()
        ];

        $this->load->view('templete/-header', $data);
        $this->load->view('dashboard/index');
        $this->load->view('templete/-footer');
    }


    // service
    public function dropdown_tambahService()
    {
        $data =  [
            'judul' => 'dashboard',
            'users' => $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array()
        ];
        $this->load->view('templete/-header', $data);
        $this->load->view('menu/tambah-service');
        $this->load->view('templete/-footer');
    }

    // setting menu
    public function dropdown_userMenu()
    {
        $data =  [
            'judul' => 'User Menu',
            'users' => $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array(),
            'user_menu' => $this->db->get('tb_user_menu')->result_array()
        ];
        $this->load->view('templete/-header', $data);
        $this->load->view('menu/dropdown-user-menu');
        $this->load->view('templete/-footer');
    }
    public function delete_userMenu($id)
    {
        $this->db->delete('tb_user_menu', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success auth-alert alert-dismissible fade show" role="alert">
        Delete success
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect('menu/dropdown_userMenu');
    }
}
