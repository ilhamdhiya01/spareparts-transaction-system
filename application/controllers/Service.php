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
            'users' => $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array(),
            'judul' => 'Data Service'
        ];
        $this->load->view('templete/header', $data);
        $this->load->view('menu/tambah-service');
        $this->load->view('templete/footer');
    }

    public function loadFormAddCustomer()
    {
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->load->view('menu/ajax-request/form-add-customer'));
        } else {
            echo json_encode('Request failed');
        }
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

    public function loadFormDataMobil()
    {
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->load->view('menu/ajax-request/form-add-data-mobil'));
        } else {
            echo json_encode('Request failed');
        }
    }

    public function add_data_mobil()
    {
        $this->form_validation->set_rules('jenis_mobil', 'Jenis mobil', 'trim|required', [
            'required' => '{field} wajib di isi'
        ]);
        $this->form_validation->set_rules('tipe_mobil', 'Tipe mobil', 'trim|required', [
            'required' => '{field} wajib di isi'
        ]);
        $this->form_validation->set_rules('merek_mobil', 'Merek mobil', 'trim|required', [
            'required' => '{field} wajib di isi'
        ]);
        $this->form_validation->set_rules('nomor_rangka', 'Nomor rangka', 'trim|required|is_unique[tb_data_mobil.nomor_rangka]', [
            'required' => '{field} wajib di isi',
            'is_unique' => '{field} sudah ada'
        ]);
        $this->form_validation->set_rules('nomor_mesin', 'Nomor mesin', 'trim|required|is_unique[tb_data_mobil.nomor_mesin]', [
            'required' => '{field} wajib di isi',
            'is_unique' => '{field} sudah ada'
        ]);
        $this->form_validation->set_rules('nomor_polisi', 'Nomor polisi', 'trim|required|is_unique[tb_data_mobil.nomor_polisi]', [
            'required' => '{field} wajib di isi',
            'is_unique' => '{field} sudah ada'
        ]);
        $this->form_validation->set_rules('warna_mobil', 'Warna mobil', 'trim|required', [
            'required' => '{field} wajib di isi'
        ]);
        $this->form_validation->set_rules('tahun_mobil', 'Tahun mobil', 'trim|required', [
            'required' => '{field} wajib di isi'
        ]);

        if ($this->form_validation->run() == false) {
            $msg = [
                'error' => [
                    'jenis_mobil' => form_error('jenis_mobil'),
                    'tipe_mobil' => form_error('tipe_mobil'),
                    'merek_mobil' => form_error('merek_mobil'),
                    'nomor_rangka' => form_error('nomor_rangka'),
                    'nomor_mesin' => form_error('nomor_mesin'),
                    'nomor_polisi' => form_error('nomor_polisi'),
                    'warna_mobil' => form_error('warna_mobil'),
                    'tahun_mobil' => form_error('tahun_mobil')
                ]
            ];
        } else {
            $data = [
                'jenis_mobil' => $_POST['jenis_mobil'],
                'tipe_mobil' => $_POST['tipe_mobil'],
                'merek_mobil' => $_POST['merek_mobil'],
                'nomor_rangka' => $_POST['nomor_rangka'],
                'nomor_mesin' => $_POST['nomor_mesin'],
                'nomor_polisi' => $_POST['nomor_polisi'],
                'warna_mobil' => $_POST['warna_mobil'],
                'tahun_mobil' => $_POST['tahun_mobil']
            ];
            $this->db->insert('tb_data_mobil', $data);
            $msg = [
                'status' => 201,
                'message' => 'Data berhasil di tambahkan'
            ];
        }
        echo json_encode($msg);
    }

    public function loadBtnJenisService()
    {
        if ($this->input->is_ajax_request()) {
            $data = [
                "jenis_service" => $this->db->get("tb_jenis_service")->result_array()
            ];
            echo json_encode($this->load->view('menu/ajax-request/jenis-service', $data));
        } else {
            echo json_encode("Request failed");
        }
    }

    public function loadSubService()
    {
        if ($this->input->is_ajax_request()) {
            $this->db->select('tb_sub_jenis_service.*,tb_jenis_service.nama_service');
            $this->db->from('tb_sub_jenis_service');
            $this->db->join('tb_jenis_service', 'tb_sub_jenis_service.id_jenis_service = tb_jenis_service.id');
            $data = [
                "sub_jenis_service" => $this->db->get()->result_array()
            ];
            echo json_encode($this->load->view('menu/ajax-request/sub-jenis-service', $data));
        } else {
            echo json_encode("Request failed");
        }
    }

    public function loadFormDataService()
    {
        $this->db->select_max("kd_service", "kode");
        $data = $this->db->get("tb_data_service")->row_array();
        $kd_service = $data["kode"];
        $urutan = (int) substr($kd_service, 3, 3);
        $urutan++;
        $kode = "SRV" . sprintf("%05s", $urutan);
        // $hasil = $data++;
        if ($this->input->is_ajax_request()) {
            $data = [
                'kd_service' => $kode
            ];
            echo json_encode($this->load->view('menu/ajax-request/form-add-service', $data));
        } else {
            echo json_encode("Request failed");
        }
    }
}
