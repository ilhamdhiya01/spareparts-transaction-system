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
        cek_access_user();
    }

    public function index()
    {
        $this->db->select('users.*, tb_posisi.nama_posisi');
        $this->db->join('tb_posisi', 'users.id_posisi = tb_posisi.id');
        $this->db->where('username', $this->session->userdata('username'));
        $data =  [
            'judul' => 'Dashboard',
            'users' => $this->db->get('users')->row_array()
        ];

        $this->load->view('templete/header', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('templete/footer');
    }

    // setting menu
    public function dropdown_userMenu()
    {
        $this->db->select('users.*, tb_posisi.nama_posisi');
        $this->db->join('tb_posisi', 'users.id_posisi = tb_posisi.id');
        $this->db->where('username', $this->session->userdata('username'));
        $data =  [
            'judul' => 'User Menu',
            'users' => $this->db->get('users')->row_array()
        ];
        $this->load->view('templete/header', $data);
        $this->load->view('menu/dropdown-user-menu');
        $this->load->view('templete/footer');
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
    public function formUbahMenu() {
         if ($this->input->is_ajax_request()) {
            echo json_encode($this->load->view('menu/ajax-request/form-ubah-menu'));
         } else {
            echo "Data tidak ditemukan";
         }
    }
     public function formAddUser() {
        if ($this->input->is_ajax_request()) {
            $data = [
                'level_user' => $this->db->get('level_user')->result_array(),
                'posisi' => $this->db->get('tb_posisi')->result_array(),
            ];
            echo json_encode($this->load->view('menu/ajax-request/form-add-user', $data));
        } else {
            echo "Data tidak ditemukan";
        }
     }
     public function formUbahUser() {
         $data = [
             'level_user' => $this->db->get('level_user')->result_array(),
             'posisi' => $this->db->get('tb_posisi')->result_array(),
             'user' => $this->db->get_where('users', ['id' => $this->input->get('user_id')])->row_array(),
         ];
         echo json_encode($this->load->view('menu/ajax-request/form-ubah-user', $data));
     }
    public function delete_userMenu()
    {
        $id = $_GET['menu_id'];
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
            'nama_menu' => $this->input->post('nama_menu')
        ];
        $this->db->insert('tb_user_menu', $data);
        $msg = [
            'response' => 'success',
            'message' => 'Data berhasil ditambahkan'
        ];
        echo json_encode($msg);
    }

    public function get_userMenuById()
    {
        $id =  $_GET['menu_id'];
        $data = [
            'menu' => $this->db->get_where('tb_user_menu', ['id' => $id])->row_array()
        ];
        echo json_encode($data);
    }

    public function proses_ubahUserMenu()
    {
        $this->db->set('nama_menu', $_POST['nama_menu']);
        $this->db->where('id', $_POST['menu_id']);
        $this->db->update('tb_user_menu');
        $data = [
            'response' => 'success',
            'message' => 'Data berhasil di ubah'
        ];
        echo json_encode($data);
    }

     public function proses_ubahSubMenu()
     {
        $sub_id = $this->input->post('sub_id');
        $this->db->set('sub_menu', $this->input->post('sub_menu'));
        $this->db->set('url', $this->input->post('url'));
        $this->db->set('icon', $this->input->post('icon'));
        $this->db->where('id',$sub_id);
        $this->db->update('tb_user_sub_menu');
        $data = [
            'response' => 'success',
            'message' => 'Data berhasil di ubah'
        ];
        echo json_encode($data);
     }

    // setting dropdown_submenu
    public function dropdown_subMenu()
    {
        $this->db->select('users.*, tb_posisi.nama_posisi');
        $this->db->join('tb_posisi', 'users.id_posisi = tb_posisi.id');
        $this->db->where('username', $this->session->userdata('username'));
        $data =  [
            'judul' => 'Data Sub Menu',
            'users' => $this->db->get('users')->row_array()
        ];
        $this->load->view('templete/header', $data);
        $this->load->view('menu/dropdown-user-sub-menu', $data);
        $this->load->view('templete/footer');
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
    } public function formUbahSubMenu()
        {
            $sub_id = $this->input->get('sub_id');
            $data = [
                'user_menu' => $this->db->get('tb_user_menu')->result_array(),
                'sub_by_id' => $this->db->get_where('tb_user_sub_menu', ['id' => $sub_id])->row_array(),
            ];
            if ($this->input->is_ajax_request()) {
                echo json_encode($this->load->view('menu/ajax-request/form-ubah-submenu', $data));
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
        $this->form_validation->set_rules('sub_menu', 'Sub Menu', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        if ($this->form_validation->run() == false) {
            $msg = [
                'error' => [
                    'sub_menu' => form_error('sub_menu'),
                    'url' => form_error('url'),
                    'icon' => form_error('icon')
                ]
            ];
        } else {
            $data = [
                'menu_id' => $_POST['menu_id'],
                'sub_menu' => $_POST['sub_menu'],
                'url' => $_POST['url'],
                'icon' => $_POST['icon'],
            ];
            $this->db->insert('tb_user_sub_menu', $data);
            $msg = [
                'status' => 200,
                'message' => 'Sub menu berhasil ditambahkan'
            ];
        }
        echo json_encode($msg);
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
        $id = $_GET['sub_id'];
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
        $this->db->select('users.*, tb_posisi.nama_posisi');
        $this->db->join('tb_posisi', 'users.id_posisi = tb_posisi.id');
        $this->db->where('username', $this->session->userdata('username'));
        $data =  [
            'judul' => 'Access Menu',
            'users' => $this->db->get('users')->row_array()
        ];
        $this->load->view('templete/header', $data);
        $this->load->view('menu/dropdown-user-access-menu', $data);
        $this->load->view('templete/footer');
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
        $this->form_validation->set_rules('nama_pegawai', 'Nama pegawai', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        if ($this->form_validation->run() == false) {
            $msg = [
                "error" => [
                    'nama_pegawai' => form_error('nama_pegawai'),
                    'username' => form_error('username'),
                    'password' => form_error('password'),
                ]
            ];
        } else {
            $data = [
                'nama_pegawai' => $_POST['nama_pegawai'],
                'id_posisi' => $_POST['id_posisi'],
                'gambar' => 'default.png',
                'username' => $_POST['username'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'level_id' => $_POST['level_id'],
                'is_active' => 0,
                'date_created' => time()
            ];
            $this->db->insert('users', $data);
            $msg = [
                'response' => 'success',
                'message' => 'Data berhasil ditambahkan'
            ];
        }
        echo json_encode($msg);
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
            $id = $_POST['userid'];
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
            $level_id = $this->input->get('level_id');
            // $id = $_GET['id'];
            $data = [
                'response' => 'success',
                // 'level_user' => $this->db->get_where('level_user', ['id' => $id])->row_array(),
                'level_id' => $level_id,
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
                    'response' => 'add'
                ];
                echo json_encode($msg);
            } else {
                $this->db->delete('tb_user_access_menu', $data);
                $msg = [
                    'response' => 'delete'
                ];
                echo json_encode($msg);
            }
        }
    }

    public function load_form_change_password()
    {
        $data = [
            'id_users' => $_GET['id']
        ];
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->load->view('menu/ajax-request/change-password-user', $data));
        } else {
            echo json_encode('Request failed');
        }
    }

    public function change_password()
    {
        $id = $_POST['id'];
        $passwordSaatIni = $_POST['change_password_saat_ini'];
        $konfirmasiPassword = $_POST['change_konfirmasi_password'];
        $passwordBaru = $_POST['change_password_baru'];
        $data = [
            'users' => $this->db->get_where('users', ['id' => $id])->row_array()
        ];
        $rules = [
            [
                'field' => 'change_password_saat_ini',
                'label' => 'Password saat ini',
                'rules' => 'required|min_length[8]|matches[change_konfirmasi_password]',
                'errors' => [
                    'required' => '{field} wajib di isi',
                    'min_length' => '{field} minimal 8 karakter',
                    'matches' => 'Password dan konfirmasi password harus sama'
                ]
            ],
            [
                'field' => 'change_konfirmasi_password',
                'label' => 'Konfirmasi password',
                'rules' => 'required|min_length[8]|matches[change_password_saat_ini]',
                'errors' => [
                    'required' => '{field} wajib di isi',
                    'min_length' => '{field} minimal 8 karakter',
                    'matches' => 'Password dan konfirmasi password harus sama'
                ]
            ]
        ];
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == false) {
            $msg = [
                'error' => [
                    'password1' => form_error('change_password_saat_ini'),
                    'password2' => form_error('change_konfirmasi_password')
                ]
            ];
            echo json_encode($msg);
        } else {
            $msg = [
                'password_verify' => password_verify($passwordSaatIni, $data['users']['password'])
            ];
            if ($msg['password_verify'] == false) {
                $msg = [
                    'response' => 'password_not_verify',
                    'message' => 'Password yang anda masukan salah'
                ];
                echo json_encode($msg);
            } else {
                if ($passwordBaru == $passwordSaatIni) {
                    $msg = [
                        'response' => 'password_matches',
                        'message' => 'Password baru tidak boleh sama dengan password lama'
                    ];
                    echo json_encode($msg);
                } else {
                    if (strlen($passwordBaru) < 8) {
                        $msg = [
                            'response' => 'min_length',
                            'message' => 'Password baru minimal 8 karakter'
                        ];
                        echo json_encode($msg);
                    } else {
                        $this->db->set('password', password_hash($passwordBaru, PASSWORD_DEFAULT));
                        $this->db->where('id', $id);
                        $this->db->update('users');
                        $msg = [
                            'response' => 'success',
                            'message' => 'Password berhasil diubah'
                        ];
                        echo json_encode($msg);
                    }
                }
            }
            // $this->db->set('password',password_hash($passwordBaru,PASSWORD_DEFAULT));
            // $this->db->where('id',$id);
            // $this->db->update('users');
            // $msg = [
            //     'response' => 'success',
            //     'message' => 'password berhasil di ubah'
            // ];
            // echo json_encode($msg);
        }
    }

    public function user_active()
    {
        $userid = $this->input->get('userid');
        $isactive = $this->input->get('isactive');
        $data = [
            'user_id' => $userid,
            'is_active' => $isactive,
        ];
        $this->db->set('is_active', 1);
        $this->db->where('id', $userid);
        $this->db->update('users');
        echo json_encode($data);
    }
    public function user_inactive()
    {
        $userid = $this->input->get('userid');
        $isactive = $this->input->get('isactive');
        $data = [
            'user_id' => $userid,
            'is_active' => $isactive,
        ];
        $this->db->set('is_active', 0);
        $this->db->where('id', $userid);
        $this->db->update('users');
        echo json_encode($data);
    }
    public function submenu_active() 
    {
        $subid = $this->input->get('subid');
        $isactive = $this->input->get('isactive');
        $data = [
            'is_active' => $isactive,
        ];
        $this->db->set('is_active', 1);
        $this->db->where('id', $subid);
        $this->db->update('tb_user_sub_menu');
        echo json_encode($data);
    }
    public function submenu_inactive()
    {
        $subid = $this->input->get('subid');
        $isactive = $this->input->get('isactive');
        $data = [
            'is_active' => $isactive,
        ];
        $this->db->set('is_active', 0);
        $this->db->where('id', $subid);
        $this->db->update('tb_user_sub_menu');
        echo json_encode($data);
    }
    public function dropdown_active()
    {
        $subid = $this->input->get('subid');
        $isactive = $this->input->get('isactive');
        $data = [
            'dropdown' => $isactive,
        ];
        $this->db->set('dropdown', 1);
        $this->db->where('id', $subid);
        $this->db->update('tb_user_sub_menu');
        echo json_encode($data);
    }
    public function dropdown_inactive()
    {
        $subid = $this->input->get('subid');
        $isactive = $this->input->get('isactive');
        $data = [
            'dropdown' => $isactive,
        ];
        $this->db->set('dropdown', 0);
        $this->db->where('id', $subid);
        $this->db->update('tb_user_sub_menu');
        echo json_encode($data);
    }
    public function add_access() 
    {
        $level_id = $this->input->get('level_id');
        $menu_id = $this->input->get('menu_id');
        $data = [
            'level_id' => $level_id,
            'menu_id' => $menu_id,
        ];
        $cek_access = $this->db->get_where('tb_user_access_menu', $data)->num_rows();
        $cek_access > 0 ? $this->db->delete('tb_user_access_menu', $data) : $this->db->insert('tb_user_access_menu', $data);
        echo json_encode($cek_access);
    }
    public function proses_ubahUser() {
        $user_id = $this->input->post('id');
        $nama_pegawai = $this->input->post('nama_pegawai');
        $id_posisi = $this->input->post('id_posisi');
        $level_id = $this->input->post('level_id');
        $this->db->set('nama_pegawai', $nama_pegawai);
        $this->db->set('id_posisi', $id_posisi);
        $this->db->set('level_id', $level_id);
        $this->db->set('date_created', time());
        $this->db->where('id', $user_id);
        $this->db->update('users');
        $msg = [
            'status' => 200,
            'message' => 'Update user success'
        ];
        echo json_encode($msg);
    }
}
