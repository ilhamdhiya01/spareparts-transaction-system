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
        $this->session->set_flashdata('flash', '<div class="alert alert-success auth-alert alert-dismissible fade show" role="alert">
        Delete success
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect('menu/dropdown_userMenu');
    }
    public function tambah_userMenu()
    {
        $data = [
            'users' => $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array(),
            'user_menu' => $this->db->get('tb_user_menu')->result_array()
        ];
        $this->form_validation->set_rules('nama-menu', 'nama menu', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templete/-header', $data);
            $this->load->view('menu/dropdown-user-menu');
            $this->load->view('templete/-footer');
        } else {
            $nama_menu = $this->input->post('nama-menu');
            $data = [
                'nama_menu' => $nama_menu
            ];
            $this->db->insert('tb_user_menu', $data);
            $this->session->set_flashdata('flash', '<div class="alert alert-success auth-alert alert-dismissible fade show" role="alert">
            Tambah menu success
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('menu/dropdown_userMenu');
        }
    }
    public function get_userMenuById()
    {
        $id =  $_POST['id'];
        $data = $this->db->get_where('tb_user_menu', ['id' => $id])->row_array();
        echo json_encode($data);
    }
    public function ubah_userMenu()
    {
        $data = [
            'id' => $this->input->post('id-menu'),
            'nama_menu' => $this->input->post('nama-menu')
        ];
        $this->db->update('tb_user_menu',$data,['id' => $data['id']]);
        $this->session->set_flashdata('flash', '<div class="alert alert-success auth-alert alert-dismissible fade show" role="alert">
        Ubah menu success
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect('menu/dropdown_userMenu');
    }
}
