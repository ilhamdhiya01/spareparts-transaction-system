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
        $this->load->model('Model_access_menu');
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
        $rules = [
            [
                'field' => 'nama-menu',
                'label' => 'Nama menu',
                'rules' => 'required'
            ]
        ];
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', '{field} tidak boleh kosong');
        if ($this->form_validation->run() == false) {
            $msg = [
                'nama_menu' => form_error('nama-menu'),
                'response' => 'error',
                'message' => 'Data gagal ditambahkan'
            ];
            echo json_encode($msg);
        } else {
            $data = [
                'nama_menu' => $this->input->post('nama-menu')
            ];
            if ($this->db->insert('tb_user_menu', $data)) {
                $msg = [
                    'response' => 'success',
                    'message' => 'Data berhasil ditambahkan'
                ];
                echo json_encode($msg);
            }
        }
    }

    public function get_userMenuById()
    {
        $id =  $_POST['id'];
        $data = [
            'menu' => $this->db->get_where('tb_user_menu', ['id' => $id])->row_array()
        ];
        echo json_encode($data);
    }

    public function proses_ubahUserMenu()
    {
        $data = [
            'id' => $_POST['id_menu'],
            'nama_menu' => $_POST['nama_menu']
        ];
        if ($this->db->update('tb_user_menu', $data, ['id' => $data['id']])) {
            $data = [
                'response' => 'success',
                'message' => 'Data berhasil di ubah'
            ];
        } else {
            $data = [
                'response' => 'error',
                'message' => 'Data gagal di ubah'
            ];
        }
        echo json_encode($data);
    }

    // setting dropdown_submenu
    public function dropdown_subMenu()
    {
        $data = [
            'users' => $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array()
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

    public function formSubMenu()
    {
        $data = [
            'user_menu' => $this->db->get('tb_user_menu')->result_array()
        ];
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->load->view('menu/ajax-request/form-user-sub-menu', $data));
        } else {
            $data = [
                'response' => 'error',
                'message' => 'Data tidak ditemukan'
            ];
            echo json_encode($data);
        }
    }

    public function tambah_subMenu()
    {
        $rules = [
            [
                'field' => 'sub_menu',
                'label' => 'Sub menu',
                'rules' => 'required',
                'error' => 'error'
            ],
            [
                'field' => 'url',
                'label' => 'Url',
                'rules' => 'required',
                'error' => 'error'
            ],
            [
                'field' => 'icon',
                'label' => 'Icon',
                'rules' => 'required',
                'error' => 'error'
            ]
        ];
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', '{field} tidak boleh kosong');
        if ($this->form_validation->run() == false) {
            $msg = [
                'sub_menu' => form_error('sub_menu'),
                'url' => form_error('url'),
                'icon' => form_error('icon')
            ];
            echo json_encode($msg);
        } else {
            $data = [
                'menu_id' => $_POST['menu'],
                'sub_menu' => $_POST['sub_menu'],
                'url' => $_POST['url'],
                'icon' => $_POST['icon'],
                'is_active' => $_POST['is_active'],
                'dropdown' => $_POST['dropdown']
            ];
            if ($this->db->insert('tb_user_sub_menu', $data)) {
                $msg = [
                    'response' => 'success',
                    'message' => 'Sub menu berhasil ditambahkan'
                ];
                echo json_encode($msg);
            } else {
                $msg = [
                    'response' => 'error',
                    'message' => 'Sub menu berhasil ditambahkan'
                ];
                echo json_encode($msg);
            }
        }
    }

    public function get_subMenuById()
    {
        $id = $_POST['id_sub'];
        if ($this->input->is_ajax_request()) {
            $data = [
                'response' => 'success',
                'subMenu_byId' => $this->db->get_where('tb_user_sub_menu', ['id' => $id])->row_array()
            ];
            echo json_encode($data);
        }
    }

    public function ubah_sub_menu()
    {
        $id = $_POST['id'];
        if ($this->input->is_ajax_request()) {
            $data = [
                'menu_id' => $_POST['menu_id'],
                'sub_menu' => $_POST['sub_menu'],
                'url' => $_POST['url'],
                'icon' => $_POST['icon'],
                'is_active' => $_POST['is_active'],
                'dropdown' => $_POST['dropdown']
            ];
            $this->db->update('tb_user_sub_menu', $data, ['id' => $id]);
            $msg = [
                'response' => 'success',
                'message' => 'Data berhasil diubah'
            ];
            echo json_encode($msg);
        }
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

    // dropdown user access menu
    public function dropdown_access_menu()
    {
        $data = [
            'users' => $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array()
        ];
        $this->load->view('templete/-header', $data);
        $this->load->view('menu/dropdown-user-access-menu', $data);
        $this->load->view('templete/-footer');
    }

    public function ambilDataAccessMenu()
    {
        if ($this->input->is_ajax_request()) {
            $data = [
                'access_menu' => $this->Model_access_menu->getAccessMenu()
            ];
            echo json_encode($this->load->view('menu/ajax-request/data-access-menu', $data));
        } else {
            echo json_encode('Data tidak ditemukan');
        }
    }
}
