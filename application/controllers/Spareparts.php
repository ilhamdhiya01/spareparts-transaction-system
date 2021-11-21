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
            'users' => $this->db->get('users')->row_array(),
            'kd_spareparts' => $this->Kode_otomatis_model->getKodeSpareparts()
        ];
        $this->load->view('templete/header', $data);
        $this->load->view('menu/ajax-request-spareparts/jenis-spareparts', $data);
        $this->load->view('templete/footer');
    }

    public function load_tb_jenis_service()
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
}
