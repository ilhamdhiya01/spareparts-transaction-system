<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Master extends CI_Controller
{
     public function __construct()
     {
        parent::__construct();
        // Sub menu model
        $this->load->model('SubMenu_model');
        $this->load->model('Model_access_menu');
        cek_access_user();
     }
    public function index() {
        $this->db->select('users.*, tb_posisi.nama_posisi');
        $this->db->join('tb_posisi', 'users.id_posisi = tb_posisi.id');
        $this->db->where('username', $this->session->userdata('username'));
        $data = [
            'judul' => 'Master Data',
            'users' => $this->db->get('users')->row_array()
        ];
        $this->load->view('templete/header', $data);
        $this->load->view('menu/master', $data);
        $this->load->view('templete/footer');
    }
    public function data_master() 
    {
        $data = [
            'master' => $this->db->get('tb_jenis_service')->result_array()
        ];
        echo json_encode($this->load->view('menu/ajax-request/data-master', $data));
    }
    public function formAddMaster() {
        echo json_encode($this->load->view('menu/ajax-request/form-add-master'));
    }
     public function formUbahMaster() {
        $data = [
            'master' => $this->db->get_where('tb_jenis_service', ['id' => $this->input->get('master_id')])->row_array(),
        ];
        echo json_encode($this->load->view('menu/ajax-request/form-ubah-master', $data));
     }
    public function add_master() {
        $this->form_validation->set_rules('nama_service', 'Nama Service', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        if ($this->form_validation->run() == false) {
            $msg = [
            "error" => [
            'nama_service' => form_error('nama_service'),
            'harga' => form_error('harga'),
            ]
        ];
        } else {
            $data = [
            'nama_service' => $_POST['nama_service'],
            'harga' => $_POST['harga'],
            ];
        $this->db->insert('tb_jenis_service', $data);
            $msg = [
            'status' => 200,
            'message' => 'Data berhasil ditambahkan'
            ];
        }
        echo json_encode($msg);
    }
    public function update_master() {
        $this->form_validation->set_rules('nama_service', 'Nama Service', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        if ($this->form_validation->run() == false) {
            $msg = [
            "error" => [
            'nama_service' => form_error('nama_service'),
            'harga' => form_error('harga'),
            ]
        ];
        } else {
            $data = [
                'nama_service' => $_POST['nama_service'],
                'harga' => $_POST['harga'],
            ];
        $this->db->update('tb_jenis_service', $data, ['id' => $this->input->post('id')]);
            $msg = [
            'status' => 200,
            'message' => 'Data berhasil diubah'
            ];
        }
        echo json_encode($msg);
    }
    public function delete_master()
    {
        $id = $_POST['master_id'];
        $this->db->delete('tb_jenis_service', ['id' => $id]);
        $data = [
        'status' => 200,
        'message' => 'Data berhasil di hapus'
        ];
        echo json_encode($data);
    }
}
