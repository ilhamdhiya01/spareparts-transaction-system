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
                    'level_id' => $data['users']['level_id']
                ];
                echo json_encode($data);
                $this->session->set_userdata($user_data);
                // if (password_verify($password, $data['users']['password'])) {
                //     $user_data = [
                //         'id' => $data['users']['id'],
                //         'username' => $data['users']['username'],
                //         'level_id' => $data['users']['level_id']
                //     ];
                //     $this->session->set_userdata($user_data);
                //     $msg = [
                //         'users' => $data['users'],
                //         'response' => 'password_correct'
                //     ];
                //     echo json_encode($msg);
                // } else {
                //     $msg = [
                //         'response' => 'password_incorrect'
                //     ];
                //     echo json_encode($msg);
                // }
            }
        }
    }
    // public function index()
    // {
    //     $data =  [
    //         'judul' => 'login-page'
    //     ];

    //     $this->form_validation->set_rules('username', 'username', 'required|trim');
    //     $this->form_validation->set_rules('password', 'password', 'required|min_length[5]');

    //     if ($this->form_validation->run() == false) {
    //         $this->load->view('auth/auth-header', $data);
    //         $this->load->view('auth/login');
    //         $this->load->view('auth/auth-footer');
    //     } else {
    //         $username = $this->input->post('username');
    //         $password = $this->input->post('password');
    //         $users = $this->db->get_where('users', ['username' => $username])->row_array();
    //         if (is_null($users)) {
    //             $this->session->set_flashdata('message', '<div class="alert alert-danger auth-alert alert-dismissible fade show" role="alert">
    //             Username belum terdaftar !
    //             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    //             <span aria-hidden="true">&times;</span>
    //             </button>
    //             </div>');
    //             redirect('auth');
    //         } else {
    //             if ($users['is_active'] == 1) {
    //                 if (password_verify($password, $users['password'])) {
    //                     $data = [
    //                         'id' => $users['id'],
    //                         'username' => $users['username'],
    //                         'level_id' => $users['level_id']
    //                     ];
    //                     $this->session->set_userdata($data);
    //                     if ($users['level_id'] == 1) {
    //                         redirect('menu');
    //                     } else {
    //                         redirect('menu');
    //                     }
    //                 } else {
    //                     $this->session->set_flashdata('message', '<div class="alert alert-danger auth-alert alert-dismissible fade show" role="alert">
    //                     Password yang anda masukan salah !
    //                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    //                     <span aria-hidden="true">&times;</span>
    //                     </button>
    //                     </div>');
    //                     redirect('auth');
    //                 }
    //             } else {
    //                 $this->session->set_flashdata('message', '<div class="alert alert-danger auth-alert alert-dismissible fade show" role="alert">
    //                 Akun belum teraktivasi !
    //                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    //                 <span aria-hidden="true">&times;</span>
    //                 </button>
    //                 </div>');
    //                 redirect('auth');
    //             }
    //         }
    //     }
    // }

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
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'level_id' => 1,
                'is_active' => 1,
                'date_created' => time()
            ];
            $this->db->insert('users', $data);
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('level_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success auth-alert alert-dismissible fade show" role="alert">
        Logout success
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button></div>');
        redirect('auth');
    }
}
