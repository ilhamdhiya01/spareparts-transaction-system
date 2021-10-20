<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Service extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = [
            'users' => $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array()
        ];
        $this->load->view('templete/-header', $data);
        $this->load->view('menu/tambah-service');
        $this->load->view('templete/-footer');
    }

    public function add_service()
    {

        $this->form_validation->set_rules('nama_customer', 'Nama customer', 'trim|required');
        $this->form_validation->set_rules('no_tlp', 'No HP/WA', 'trim|required');
        $this->form_validation->set_rules('nik', 'NIK', 'trim|required|min_length[16]|max_length[16]|is_unique[tb_pelanggan.nik]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        if ($this->form_validation->run() == false) {
            $msg = [
                'error' => [
                    'nama_customer' => form_error('nama_customer'),
                    'no_tlp' => form_error('no_tlp'),
                    'nik' => form_error('nik'),
                    'alamat' => form_error('alamat')
                ]
            ];
        } else {
            $data = [
                'nama_pelanggan' => $_POST['nama_customer'],
                'no_tlp' => $_POST['no_tlp'],
                'nik' => $_POST['nik'],
                'alamat' => $_POST['alamat']
            ];
            $this->db->insert('tb_pelanggan', $data);
            $msg = [
                'response' => 201,
                'message' => 'Data berhasil di tambahkan'
            ];
        }
        echo json_encode($msg);
    }

    public function get_nik()
    {
        $nik = $_POST['nik'];
        if ($nik == '' || empty($nik)) {
            $quwry = "SELECT nik FROM tb_pelanggan WHERE nik = '0'";
            $msg = [
                'status' => 'null',
                'nik' => $this->db->query($quwry)->row_array()['nik']
            ];
        } else {
            $quwry = "SELECT nik FROM tb_pelanggan WHERE nik = '$nik'";
            $msg = [
                'status' => 'success',
                'nik' => $this->db->query($quwry)->row_array()['nik']
            ];
        }
        echo json_encode($msg);
    }
}
