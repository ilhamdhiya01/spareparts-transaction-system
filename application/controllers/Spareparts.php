<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Spareparts extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kode_otomatis_model');
    }

    public function index()
    {
        $this->db->select('users.*, tb_posisi.nama_posisi');
        $this->db->join('tb_posisi', 'users.id_posisi = tb_posisi.id');
        $this->db->where('username', $this->session->userdata('username'));
        $data =  [
            'judul' => 'Data Spareparts',
            'users' => $this->db->get('users')->row_array()
        ];
        $this->load->view('templete/header', $data);
        $this->load->view('menu/ajax-request-spareparts/jenis-spareparts', $data);
        $this->load->view('templete/footer');
    }

    public function load_tb_spareparts()
    {
        if ($this->input->is_ajax_request()) {
            $data = [
                'jenis_spareparts' => $this->db->get('tb_spareparts')->result_array()
            ];
            echo json_encode($this->load->view('menu/ajax-request-spareparts/tb-jenis-spareparts', $data));
        } else {
            echo json_encode('Request failed');
        }
    }

    public function load_form_spareparts()
    {
        if ($this->input->is_ajax_request()) {
            $data = [
                'kd_spareparts' => $this->Kode_otomatis_model->getKodeSpareparts()
            ];
            echo json_encode($this->load->view('menu/ajax-request-spareparts/form-data-spareparts', $data));
        } else {
            echo json_encode('Request failed');
        }
    }

    public function add_jenis_spareparts()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('nama_spareparts', 'Nama spareparts', 'required');
            if ($this->form_validation->run() == false) {
                $msg = [
                    'error' => [
                        'nama_spareparts' => form_error('nama_spareparts')
                    ]
                ];
            } else {
                $data = [
                    'kd_spareparts' => $_POST['kd_spareparts'],
                    'nama_spareparts' => $_POST['nama_spareparts']
                ];

                $this->db->insert('tb_spareparts', $data);
                $msg = [
                    'status' => 201,
                    'message' => 'Data berhasil di tambahkan'
                ];
            }
            echo json_encode($msg);
        } else {
            echo json_encode('Request failed');
        }
    }

    public function hapus_data_spareparts()
    {
        if ($this->input->is_ajax_request()) {
            $id_spareparts = $_POST['id_spareparts'];
            $this->db->delete('tb_spareparts', ['id' => $id_spareparts]);
            $msg = [
                'status' => 200,
                'message' => 'Data berhasil di hapus'
            ];
            echo json_encode($msg);
        } else {
            echo json_encode('Request failed');
        }
    }

    public function ambil_data_spareparts()
    {
        if ($this->input->is_ajax_request()) {
            $id_spareparts = $_POST['id_spareparts'];
            $msg = [
                'data_by_id' => $this->db->get_where('tb_spareparts', ['id' => $id_spareparts])->row_array()
            ];
            echo json_encode($msg);
        } else {
            echo json_encode('Request failed');
        }
    }

    public function proses_ubah_spareparts()
    {
        if ($this->input->is_ajax_request()) {
            $id_spareparts = $_POST['id_spareparts'];
            $data = [
                'kd_spareparts' => $_POST['kd_spareparts'],
                'nama_spareparts' => $_POST['nama_spareparts']
            ];
            $this->db->update('tb_spareparts', $data, ['id' => $id_spareparts]);
            $msg = [
                'status' => 200,
                'message' => 'Data berhasil diubah'
            ];
            echo json_encode($msg);
        } else {
            echo json_encode('Request failed');
        }
    }

    public function load_sub_spareparts()
    {
        if ($this->input->is_ajax_request()) {
            $id_jenis_spareparts = $_GET['id_jenis_spareparts'];
            // $this->db->select('kd_spareparts,tb_spareparts.id as id_spareparts, tb_spareparts.nama_spareparts as jenis_spareparts');
            // $this->db->join('tb_spareparts', 'tb_sub_spareparts.id_spareparts = tb_spareparts.id');
            // $this->db->where('tb_spareparts.id', $id_jenis_spareparts);
            $data = [
                'jenis_spareparts' => $this->db->get_where('tb_spareparts', ['id' => $id_jenis_spareparts])->row_array()
            ];
            echo json_encode($this->load->view('menu/ajax-request-spareparts/form-data-sub-spareparts', $data));
        } else {
            echo json_encode('Request failed');
        }
    }

    public function load_tb_sub_spareparts()
    {
        if ($this->input->is_ajax_request()) {
            $data = [
                'jenis_spareparts' => $this->db->get('tb_spareparts')->result_array()
            ];
            echo json_encode($this->load->view('menu/ajax-request-spareparts/tb-sub-spareparts', $data));
        } else {
            echo json_encode('Request failed');
        }
    }

    public function hapus_sub()
    {
        $id_sub = $this->input->post('id_sub');
        $this->db->delete('tb_sub_spareparts', ['id' => $id_sub]);
        $msg = [
            'status' => 200,
            'message' => 'Data berhasil di hapus'
        ];
        echo json_encode($msg);
    }

    public function proses_tambah_sub_spareparts()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('nama_spareparts', 'Nama spareparts', 'required');
            $this->form_validation->set_rules('harga', 'Harga spareparts', 'required|numeric');

            if ($this->form_validation->run() == false) {
                $msg = [
                    'error' => [
                        'nama_spareparts' => form_error('nama_spareparts'),
                        'harga' => form_error('harga')
                    ]
                ];
            } else {
                $data = [
                    'id_spareparts' => $_POST['id_spareparts'],
                    'nama_spareparts' => $_POST['nama_spareparts'],
                    'harga' => $_POST['harga']
                ];
                $this->db->insert('tb_sub_spareparts', $data);
                $msg = [
                    'status' => 201,
                    'message' => 'Data berhasil di tambahkan'
                ];
            }
            echo json_encode($msg);
        } else {
            echo json_encode('Request failed');
        }
    }

    public function load_ubah_sub_spareparts()
    {
        if ($this->input->is_ajax_request()) {
            $id_jenis_spareparts = $_GET['id_jenis_spareparts'];
            $id_sub_spareparts = $_GET['id_sub_spareparts'];
            $this->db->select('kd_spareparts,tb_spareparts.id as id_spareparts, tb_spareparts.nama_spareparts as jenis_spareparts');
            $this->db->join('tb_spareparts', 'tb_sub_spareparts.id_spareparts = tb_spareparts.id');
            $this->db->where('id_spareparts', $id_jenis_spareparts);
            $data = [
                'jenis_spareparts' => $this->db->get('tb_sub_spareparts')->row_array(),
                'sub_spareparts' => $this->db->get_where('tb_sub_spareparts', ['id' => $id_sub_spareparts])->row_array()
            ];
            echo json_encode($this->load->view('menu/ajax-request-spareparts/form-ubah-sub-spareparts', $data));
        } else {
            echo json_encode('Request failed');
        }
    }

    public function proses_ubah_sub_spareparts()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('nama_spareparts', 'Nama spareparts', 'required');
            $this->form_validation->set_rules('harga', 'Harga spareparts', 'required|numeric');
            $id_sub = $_POST['id'];
            if ($this->form_validation->run() == false) {
                $msg = [
                    'error' => [
                        'nama_spareparts' => form_error('nama_spareparts'),
                        'harga' => form_error('harga')
                    ]
                ];
            } else {
                $data = [
                    'id' => $_POST['id'],
                    'id_spareparts' => $_POST['id_spareparts'],
                    'nama_spareparts' => $_POST['nama_spareparts'],
                    'harga' => $_POST['harga']
                ];
                $this->db->update('tb_sub_spareparts', $data, ['id' =>  $id_sub]);
                $msg = [
                    'status' => 201,
                    'message' => 'Data berhasil di ubah'
                ];
            }
            echo json_encode($msg);
        } else {
            echo json_encode('Request failed');
        }
    }

    public function hapus_spareparts()
    {
        if ($this->input->is_ajax_request()) {
            $id_jenis = $_POST['id_jenis'];
            $this->db->delete('tb_spareparts', ['id' => $id_jenis]);
            $msg = [
                'status' => 200,
                'message' => 'Data berhasil di hapus'
            ];
            echo json_encode($msg);
        } else {
            echo json_encode('Request failed');
        }
    }
}
