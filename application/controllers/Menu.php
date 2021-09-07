<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Sub menu model
        $this->load->model('SubMenu_model');
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


        ];
        $this->load->view('templete/-header', $data);
        $this->load->view('menu/dropdown-user-menu');
        $this->load->view('templete/-footer');
    }
    public function ambilDataUserMenu()
    {
        if ($this->input->is_ajax_request()) {
            $data = [
                'user_menu' => $this->db->get('tb_user_menu')->result_array()
            ];
            echo json_encode($this->load->view('menu/ajax-request/data-user-menu', $data));
        } else {
            echo "Data tidak ditemukan";
        }
    }
    public function formUserMenu()
    {
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->load->view('menu/ajax-request/form-user-menu'));
        } else {
            echo "Data tidak ditemukan";
        }
    }
    public function delete_userMenu()
    {
        $id = $_POST['id'];
        if ($this->input->is_ajax_request()) {
            if ($this->db->delete('tb_user_menu', ['id' => $id])) {
                $data = [
                    'response' => 'success',
                    'message' => 'Data berhasil di hapus'
                ];
            } else {
                $data = [
                    'response' => 'error',
                    'message' => 'Data gagal di hapus'
                ];
            }
            echo json_encode($data);
        } else {
            echo "Request failed";
        }
    }
    public function tambah_userMenu()
    {
        $data = [
            'nama_menu' => $this->input->post('nama-menu')
        ];
        if ($this->db->insert('tb_user_menu', $data)) {
            $data = [
                'response' => 'success',
                'message' => 'Data berhasil ditambahkan'
            ];
        } else {
            $data = [
                'response' => 'error',
                'message' => 'Data gagal ditambahkan'
            ];
        }
        echo json_encode($data);
    }
    public function get_userMenuById()
    {
        $id =  $_POST['id'];
        $data = [
            'menu' => $this->db->get_where('tb_user_menu', ['id' => $id])->row_array()
        ];
        echo json_encode($data);
    }
    // public function ubah_userMenu()
    // {
    //     $id = $_POST['id'];
    //     $data = [
    //         'menu_id' => $this->db->get_where('tb_user_menu',['id' => $id])->row_array()
    //     ];
    //     echo json_encode($data);
    // }

    // setting dropdown_submenu
    public function dropdown_subMenu()
    {
        $data = [
            'users' => $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array(),
            'user_menu' => $this->db->get('tb_user_menu')->result_array(),
        ];
        $this->load->view('templete/-header', $data);
        $this->load->view('menu/dropdown-user-sub-menu', $data);
        $this->load->view('templete/-footer');
    }
    // ambil data sub menu
    public function ambilDataSubMenu()
    {
        if ($this->input->is_ajax_request()) {
            $data = [
                'sub_menu' => $this->SubMenu_model->getAllSubMenu()
            ];
            echo json_encode($this->load->view('menu/ajax-request/data-sub-menu', $data));
        } else {
            echo "data tidak ditemukan";
        }
    }
    public function tambah_subMenu()
    {
        $data = [
            'menu_id' => $this->input->post('user-menu'),
            'sub_menu' => $this->input->post('sub_menu'),
            'url' => $this->input->post('url'),
            'icon' => $this->input->post('icon'),
            'is_active' => $this->input->post('is_active')
        ];
        if ($this->db->insert('tb_user_sub_menu', $data)) {
            $data = [
                'response' => 'success',
                'message' => 'Sub menu berhasil ditambahkan'
            ];
        } else {
            $data = [
                'response' => 'error',
                'message' => 'Sub menu gagal ditambahkan'
            ];
        }
        echo json_encode($data);
    }
    public function get_subMenuById()
    {
        $id = $this->input->post('id');
        $data = $this->db->get_where('tb_user_sub_menu', ['id' => $id])->row_array();
        echo json_encode($data);
    }

    public function delete_subMenu()
    {
        $id = $_POST['id'];
        if ($this->db->delete('tb_user_sub_menu', ['id' => $id])) {
            $data = [
                'response' => 'success',
                'message' => 'Data berhasil di hapus'
            ];
        } else {
            $data = [
                'response' => 'error',
                'message' => 'Data gagal di hapus'
            ];
        }
        echo json_encode($data);
    }
}
