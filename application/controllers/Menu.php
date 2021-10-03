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
            $msg = [
                'response' => 'error',
                'message' => 'Data tidak ditemukan'
            ];
            echo json_encode($msg);
        }
    }

    public function tambah_subMenu()
    {
        $rules = [
            [
                'field' => 'menu',
                'label' => 'User menu',
                'rules' => 'required',
                'errors' => [
                    'required' => 'User menu wajib di isi'
                ]
            ],
            [
                'field' => 'sub_menu',
                'label' => 'Sub menu',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Sub menu wajib di isi'
                ]
            ],
            [
                'field' => 'url',
                'label' => 'Url',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Url wajib di isi'
                ]
            ],
            [
                'field' => 'icon',
                'label' => 'Icon',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Icon wajib di isi'
                ]
            ]
        ];
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == false) {
            $msg = [
                'error' => [
                    'menu_user' => form_error('menu'),
                    'sub_menu' => form_error('sub_menu'),
                    'url' => form_error('url'),
                    'icon' => form_error('icon')
                ]
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

    public function formAccessMenu()
    {
        if ($this->input->is_ajax_request()) {
            $data = [
                'posisi' => $this->db->get('tb_posisi')->result_array(),
                'level' => $this->db->get('level_user')->result_array()
            ];
            echo json_encode($this->load->view('menu/ajax-request/form-access-menu', $data));
        } else {
            echo json_encode('Data tidak ditemukan');
        }
    }

    public function add_user()
    {
        $rules = [
            [
                'field' => 'nama',
                'label' => 'Nama pegawai',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            [
                'field' => 'posisi',
                'label' => 'Posisi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            [
                'field' => 'level',
                'label' => 'Level user',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            [
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required|is_unique[users.username]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => 'Username atau email sudah digunakan'
                ]
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|min_length[8]|matches[konfirmasi_password]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => 'Password minimal 8 karakter',
                    'matches' => 'Password dan Konfirmasi password harus sama'
                ]
            ],
            [
                'field' => 'konfirmasi_password',
                'label' => 'Konfirmasi password',
                'rules' => 'required|min_length[8]|matches[password]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => 'Password minimal 8 karakter',
                    'matches' => 'Password dan Konfirmasi password harus sama'
                ]
            ]
        ];
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == false) {
            $msg = [
                "error" => [
                    'nama_pegawai' => form_error('nama'),
                    'posisi_pegawai' => form_error('posisi'),
                    'level_id' => form_error('level'),
                    'username' => form_error('username'),
                    'password' => form_error('password'),
                    'konfirmasi_password' => form_error('konfirmasi_password')
                ]
            ];
            echo json_encode($msg);
        } else {
            $data = [
                'nama_pegawai' => $_POST['nama'],
                'id_posisi' => $_POST['posisi'],
                'gambar' => 'default.png',
                'username' => $_POST['username'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'level_id' => $_POST['level'],
                'is_active' => $_POST['is_active'],
                // 'konfirmasi_password' => $_POST['konfirmasi_password'],
                'date_created' => time()
            ];
            if ($this->db->insert('users', $data)) {
                $msg = [
                    'response' => 'success',
                    'message' => 'Data berhasil ditambahkan'
                ];
                echo json_encode($msg);
            } else {
                $msg = [
                    'response' => 'error',
                    'message' => 'Data gagal ditambahkan'
                ];
                echo json_encode($msg);
            }
        }
    }

    public function get_access_menu_by_id()
    {
        if ($this->input->is_ajax_request()) {
            $id = $_POST['id'];
            $data = [
                'response' => 'success',
                'data_by_id' => $this->db->get_where('users', ['id' => $id])->row_array()
            ];
            echo json_encode($data);
        }
    }

    public function proses_ubah_access_menu()
    {
        if ($this->input->is_ajax_request()) {
            $id = $_POST['id'];
            $data = [
                'nama_pegawai' => $_POST['nama_pegawai'],
                'id_posisi' => $_POST['id_posisi'],
                'gambar' => $_POST['gambar'],
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'level_id' => $_POST['level_id'],
                'is_active' => $_POST['is_active'],
                'date_created' => $_POST['date_created']
            ];
            if ($this->db->update('users', $data, ['id' => $id])) {
                $msg = [
                    'response' => 'success',
                    'message' => 'Daa berhasil diubah'
                ];
                echo json_encode($msg);
            } else {
                $msg = [
                    'response' => 'error',
                    'message' => 'Daa gagal diubah'
                ];
                echo json_encode($msg);
            }
        }
    }

    public function delete_access_menu()
    {
        if ($this->input->is_ajax_request()) {
            $id = $_POST['id'];
            if ($this->db->delete('users', ['id' => $id])) {
                $msg = [
                    'response' => 'success',
                    'message' => 'Data berhasil dihapus'
                ];
                echo json_encode($msg);
            } else {
                $msg = [
                    'response' => 'error',
                    'message' => 'Data gagal dihapus'
                ];
                echo json_encode($msg);
            }
        }
    }

    // dropdown menu
    public function tambah_dropdown_menu()
    {
        $rules = [
            [
                'field' => 'url_dropdown',
                'label' => 'Url dropdown',
                'rules' => 'required'
            ]
        ];

        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message("required", "{field} tidak boleh kosong");
        if ($this->form_validation->run() == false) {
            $msg = [
                'url_dropdown' => form_error('url_dropdown'),
                'response' => 'error'
            ];
            echo json_encode($msg);
        } else {
            $data = [
                'sub_menu_id' => $_POST['sub_menu_id'],
                'dropdown_nama' => $_POST['dropdown_menu'],
                'url' => $_POST['url_dropdown']
            ];
            if ($this->db->insert('dropdown_menu', $data)) {
                $msg = [
                    'response' => 'success',
                    'message' => 'Data berhasil ditambahkan'
                ];
                echo json_encode($msg);
            } else {
                $msg = [
                    'response' => 'error',
                    'message' => 'Data gagal ditambahkan'
                ];
                echo json_encode($msg);
            }
        }
    }

    public function ambilDataDropdownMenu()
    {
        // $id = $_GET["id_sub"];
        $data = [
            'dropdown_menu' => $this->SubMenu_model->getAllDropdownMenu($_GET['id_sub'])
        ];
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->load->view('menu/ajax-request/data-dropdown-menu', $data));
        } else {
            echo json_encode("Data tidak ditemukan");
        }
    }

    public function cek_dropdown_aktif_atau_tidak()
    {
        if ($this->input->is_ajax_request()) {
            $id = $_POST['id'];
            $this->db->select('tb_user_sub_menu.dropdown');
            $this->db->from('tb_user_sub_menu');
            $this->db->where('id', $id);

            $msg = [
                'response' => 'success',
                'aktivasi_dropdown' => $this->db->get()->row_array(),
                'message' => 'Menu dropdown belum di aktifkan'
            ];
            echo json_encode($msg);
        } else {
            echo json_encode("Request failed");
        }
    }

    public function hapus_dropdown_menu()
    {
        if ($this->input->is_ajax_request()) {
            $id = $_POST['id'];
            if ($this->db->delete('dropdown_menu', ['id' => $id])) {
                $msg = [
                    'response' => 'success',
                    'message' => 'Data berhasil di hapus'
                ];
                echo json_encode($msg);
            } else {
                $msg = [
                    'response' => 'error',
                    'message' => 'Data gagal di hapus'
                ];
                echo json_encode($msg);
            }
        }
    }

    public function get_dropdown_by_id()
    {
        if ($this->input->is_ajax_request()) {
            $id = $_POST['id'];
            $data = [
                'dropdown_by_id' => $this->db->get_where('dropdown_menu', ['id' => $id])->row_array(),
                'response' => 'success'
            ];
            echo json_encode($data);
        }
    }

    public function proses_ubah_dropdown()
    {
        if ($this->input->is_ajax_request()) {
            $id = $_POST['id_dropdown'];
            $data = [
                'sub_menu_id' => $_POST['sub_menu_id'],
                'dropdown_nama' => $_POST['nama_dropdown'],
                'url' => $_POST['url_dropdown']
            ];
            $query = $this->db->update('dropdown_menu', $data, ['id' => $id]);
            if (!$query) {
                $msg = [
                    'response' => 'error',
                    'message' => 'Data gagal diubah'
                ];
                echo json_encode($msg);
            } else {
                $msg = [
                    'response' => 'success',
                    'message' => 'Data berhasil diubah'
                ];
                echo json_encode($msg);
            }
        }
    }

    public function userAccess()
    {
        if ($this->input->is_ajax_request()) {
            $id = $_GET['id'];
            $data = [
                'response' => 'success',
                'level_user' => $this->db->get_where('level_user', ['id' => $id])->row_array(),
                'user_access' => $this->db->get('tb_user_menu')->result_array()
            ];
            echo json_encode($this->load->view('menu/ajax-request/data-user-access', $data));
        } else {
            echo json_encode("Data tidak ditemukan");
        }
    }

    public function change_access()
    {
        if ($this->input->is_ajax_request()) {
            $data = [
                'level_id' => $_POST['level_id'],
                'menu_id' => $_POST['menu_id']
            ];
            $result = $this->db->get_where('tb_user_access_menu', $data);
            if ($result->num_rows() < 1) {
                $this->db->insert('tb_user_access_menu', $data);
                $msg = [
                    'response' => 'add',
                    'message' => 'Access ditambahkan'
                ];
                echo json_encode($msg);
            } else {
                $this->db->delete('tb_user_access_menu', $data);
                $msg = [
                    'response' => 'delete',
                    'message' => 'Access dihapus'
                ];
                echo json_encode($msg);
            }
        }
    }
}
