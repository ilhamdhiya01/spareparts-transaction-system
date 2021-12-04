<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Service extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kode_otomatis_model');
        $this->load->model('Spareparts_model');
        $this->load->model('Data_service_model');
        cek_access_user();
    }

    public function index()
    {
        $this->db->select('users.*, tb_posisi.nama_posisi');
        $this->db->join('tb_posisi', 'users.id_posisi = tb_posisi.id');
        $this->db->where('username', $this->session->userdata('username'));
        $data =  [
            'judul' => 'Data Service',
            'users' => $this->db->get('users')->row_array()
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

        $this->form_validation->set_rules('nama_pelanggan', 'Nama pelanggan', 'trim|required');
        $this->form_validation->set_rules('no_tlp', 'No HP/WA', 'trim|required');
        $this->form_validation->set_rules('nik', 'NIK', 'trim|required|min_length[16]|max_length[16]|is_unique[tb_pelanggan.nik]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        if ($this->form_validation->run() == false) {
            $msg = [
                'error' => [
                    'nama_pelanggan' => form_error('nama_pelanggan'),
                    'no_tlp' => form_error('no_tlp'),
                    'nik' => form_error('nik'),
                    'alamat' => form_error('alamat')
                ]
            ];
        } else {
            $data = [
                'nama_pelanggan' => $_POST['nama_pelanggan'],
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
            $this->db->select('tb_pelanggan.*');
            $this->db->order_by('id', 'DESC');
            $this->db->limit(1);
            $data = [
                'pelanggan' => $this->db->get('tb_pelanggan')->row_array()
            ];
            if (is_null($data['pelanggan'])) {
                $data = [
                    'message' => 'Data pelanggan masih kosong, silahkan tambahkan pelanggan terlebih dahulu'
                ];
                echo json_encode($this->load->view('menu/ajax-request/error-page', $data));
            } else {
                echo json_encode($this->load->view('menu/ajax-request/form-add-data-mobil', $data));
            }
        } else {
            echo json_encode('Request failed');
        }
    }

    public function add_data_mobil()
    {
        $this->form_validation->set_rules('id_pelanggan', 'Id_pelanggan', 'is_unique[tb_data_mobil.id_pelanggan]');
        $this->form_validation->set_rules('jenis_mobil', 'Jenis mobil', 'trim|required');
        $this->form_validation->set_rules('tipe_mobil', 'Tipe mobil', 'trim|required');
        $this->form_validation->set_rules('merek_mobil', 'Merek mobil', 'trim|required');
        $this->form_validation->set_rules('nomor_rangka', 'Nomor rangka', 'trim|required|is_unique[tb_data_mobil.nomor_rangka]');
        $this->form_validation->set_rules('nomor_mesin', 'Nomor mesin', 'trim|required|is_unique[tb_data_mobil.nomor_mesin]');
        $this->form_validation->set_rules('nomor_polisi', 'Nomor polisi', 'trim|required|is_unique[tb_data_mobil.nomor_polisi]');
        $this->form_validation->set_rules('warna_mobil', 'Warna mobil', 'trim|required');
        $this->form_validation->set_rules('tahun_mobil', 'Tahun mobil', 'trim|required');

        if ($this->form_validation->run() == false) {
            $msg = [
                'error' => [
                    'id_pelanggan' => form_error('id_pelanggan'),
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
                'id_pelanggan' => $_POST['id_pelanggan'],
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
        // $hasil = $data++;
        if ($this->input->is_ajax_request()) {
            $this->db->select('tb_pelanggan.id');
            $this->db->order_by('id', 'DESC');
            $this->db->limit(1);

            $data = [
                'kd_service' => $this->Kode_otomatis_model->getKode(),
                'nama_service' => $_GET['nama_service'],
                'harga_jasa' => $_GET['harga_jasa'],
                'nama_sub_service' => @$_GET['nama_sub_service'],
                'message' => 'Data pelanggan masih kosong, silahkan tambahkan pelanggan terlebih dahulu',
                'id_pelanggan' => $this->db->get('tb_pelanggan')->row_array()
            ];
            if (is_null($data['id_pelanggan'])) {
                // echo json_encode($this->load->view('menu/ajax-request/form-add-service', $data));
                echo json_encode($this->load->view('menu/ajax-request/error-page', $data));
            } else {
                echo json_encode($this->load->view('menu/ajax-request/form-add-service', $data));
            }
        } else {
            echo json_encode("Request failed");
        }
    }

    public function loadPageError()
    {
        if ($this->input->is_ajax_request()) {
            $data = [
                "message" => "Tambahkan pelanggan baru, agar dapat mengakses halaman ini"
            ];
            echo json_encode($this->load->view('menu/ajax-request/error-page', $data));
        }
    }

    public function addTuneUpService()
    {
        $this->form_validation->set_rules('id_pelanggan', 'id_pelanggan', 'is_unique[tb_data_service.id_pelanggan]');
        $this->form_validation->set_rules('tgl_service', 'Tgl service', 'required');
        if ($this->form_validation->run() == false) {
            $msg = [
                'error' => [
                    'id_pelanggan' => form_error('id_pelanggan'),
                    'tgl_service' => form_error('tgl_service')
                ]
            ];
        } else {
            $data = [
                'id_pelanggan' => $_POST['id_pelanggan'],
                'kd_service' => $_POST['kd_service'],
                'jenis_service' => $_POST['jenis_service'],
                'harga' => reset_rupiah($_POST['harga']),
                'sub_service' => $_POST['sub_service'],
                'service_lain' => $_POST['service_lain'],
                'tgl_service' => $_POST['tgl_service'],
                'info_lain' => $_POST['info_lain']
            ];
            $this->db->insert('tb_data_service', $data);
            $msg = [
                'status' => 201,
                'message' => 'Data berhasil ditambahkan'
            ];
        }
        echo json_encode($msg);
    }

    public function addServiceLain()
    {
        $this->form_validation->set_rules('id_pelanggan', 'id_pelanggan', 'is_unique[tb_data_service.id_pelanggan]');
        $this->form_validation->set_rules('service_lain', 'Service lain', 'required');
        $this->form_validation->set_rules('tgl_service', 'Tgl service', 'required');
        if ($this->form_validation->run() == false) {
            $msg = [
                'error' => [
                    'id_pelanggan' => form_error('id_pelanggan'),
                    'service_lain' => form_error('service_lain'),
                    'tgl_service' => form_error('tgl_service')
                ]
            ];
        } else {
            $data = [
                'id_pelanggan' => $_POST['id_pelanggan'],
                'kd_service' => $_POST['kd_service'],
                'jenis_service' => $_POST['jenis_service'],
                'harga' => reset_rupiah($_POST['harga']),
                'sub_service' => $_POST['sub_service'],
                'service_lain' => $_POST['service_lain'],
                'tgl_service' => $_POST['tgl_service'],
                'info_lain' => $_POST['info_lain']
            ];
            $this->db->insert('tb_data_service', $data);
            $msg = [
                'status' => 201,
                'message' => 'Data berhasil ditambahkan'
            ];
        }
        echo json_encode($msg);
    }

    public function addServiceBerkala()
    {
        $this->form_validation->set_rules('id_pelanggan', 'id_pelanggan', 'is_unique[tb_data_service.id_pelanggan]');
        $this->form_validation->set_rules('tgl_service', 'Tgl service', 'required');
        if ($this->form_validation->run() == false) {
            $msg = [
                'error' => [
                    'id_pelanggan' => form_error('id_pelanggan'),
                    'tgl_service' => form_error('tgl_service')
                ]
            ];
        } else {
            $data = [
                'id_pelanggan' => $_POST['id_pelanggan'],
                'kd_service' => $_POST['kd_service'],
                'jenis_service' => $_POST['jenis_service'],
                'harga' => reset_rupiah($_POST['harga']),
                'sub_service' => $_POST['sub_service'],
                'service_lain' => $_POST['service_lain'],
                'tgl_service' => $_POST['tgl_service'],
                'info_lain' => $_POST['info_lain']
            ];
            $this->db->insert('tb_data_service', $data);
            $msg = [
                'status' => 201,
                'message' => 'Data berhasil ditambahkan'
            ];
        }
        echo json_encode($msg);
    }

    public function loadPilihSpareparts()
    {
        if ($this->input->is_ajax_request()) {
            $id_pelanggan = $_GET['id_pelanggan'];
            $data = [
                'spareparts' => $this->db->get('tb_spareparts')->result_array(),
                'id_pelanggan' => $id_pelanggan,
                'id_service' => $this->db->get_where('tb_data_service', ['id_pelanggan' => $id_pelanggan])->row_array(),
                'id_mobil' => $this->db->get_where('tb_data_mobil', ['id_pelanggan' => $id_pelanggan])->row_array()
            ];
            echo json_encode($this->load->view('menu/ajax-request/data-spareparts', $data));
        } else {
            echo json_encode('Request failed');
        }
    }

    public function editDataSpareparts()
    {
        if ($this->input->is_ajax_request()) {
            $data = [
                'spareparts' => $this->db->get('tb_spareparts')->result_array(),
                'id_pelanggan' => $_GET['id_pelanggan'],
                'id_status' => $_GET['id_status']
            ];
            echo json_encode($this->load->view('menu/ajax-request/edit-spareparts', $data));
        } else {
            echo json_encode('Request failed');
        }
    }

    public function change_spareparts()
    {
        $data = [
            'id_spareparts' => $_POST['id_spareparts'],
            'id_sub_spareparts' => $_POST['id_sub_spareparts'],
            'id_pelanggan' => $_POST['id_pelanggan'],
            'id_mobil' => $_POST['id_mobil'],
            'id_service' => $_POST['id_service'],
            'id_status' => 1
        ];
        // echo json_encode($data);
        $result = $this->db->get_where('tb_spareparts_service', $data);
        if ($this->input->is_ajax_request()) {
            if ($result->num_rows() < 1) {
                $this->db->insert('tb_spareparts_service', $data);
                $msg = [
                    'response' => 201,
                    'message' => 'Spareparts berhasil ditambahkan'
                ];
                echo json_encode($msg);
            } else {
                $this->db->delete('tb_spareparts_service', $data);
                $msg = [
                    'message' => 'Spareparts tidak ditambahkan'
                ];
                echo json_encode($msg);
            }
        }
    }

    public function change_edit_spareparts()
    {
        $data = [
            'id_service' => $_POST['id_service'],
            'id_mobil' => $_POST['id_mobil'],
            'id_spareparts' => $_POST['id_spareparts'],
            'id_sub_spareparts' => $_POST['id_sub_spareparts'],
            'id_pelanggan' => $_POST['id_pelanggan'],
            'id_status' => $_POST['id_status']
        ];

        $result = $this->db->get_where('tb_spareparts_service', $data);
        if ($this->input->is_ajax_request()) {
            if ($result->num_rows() < 1) {
                $this->db->insert('tb_spareparts_service', $data);
                $msg = [
                    'response' => 201,
                    'message' => 'Spareparts berhasil di tambahkan'
                ];
                echo json_encode($msg);
            } else {
                $this->db->delete('tb_spareparts_service', $data);
                // $this->db->update('tb_spareparts_service', $data);
                $msg = [
                    'message' => 'Spareparts berhasil di ubah'
                ];
                echo json_encode($msg);
            }
        }
        // echo json_encode($data);
    }

    public function loadTableDataSpk()
    {
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->load->view('menu/ajax-request/data-spk'));
        } else {
            echo json_encode("Request failed");
        }
    }

    public function data_spk()
    {
        $data = [
            'data_service' => $this->Data_service_model->getAllDataService(),
            'status_service' => $this->db->get('tb_status_service')->result_array()
        ];
        echo json_encode($data);
    }

    public function detail_service()
    {
        if ($this->input->is_ajax_request()) {
            $id_service = $_GET['id_service'];
            $id_pelanggan = $_GET['id_pelanggan'];

            $data = [
                "detail_data_service" => $this->Data_service_model->detail_data_service($id_service, $id_pelanggan),
                "data_spareparts" => $this->Data_service_model->get_sub_spareparts_by_id($id_service, $id_pelanggan)
            ];

            echo json_encode($this->load->view('menu/ajax-request/detail-service', $data));
        } else {
            echo json_encode("Request failed");
        }
    }

    public function delete_data_spk()
    {
        $id_service = $_POST['id_service'];
        $id_pelanggan = $_POST['id_pelanggan'];
        $id_mobil = $_POST['id_mobil'];

        $this->db->delete('tb_data_service', ['id' => $id_service]);
        $this->db->delete('tb_spareparts_service', ['id_service' => $id_service]);

        $msg = [
            'status' => 200,
            'message' => 'Data berhasil di hapus'
        ];
        echo json_encode($msg);
    }

    public function update_data_spk()
    {
        if ($this->input->is_ajax_request()) {
            $id_service = $_GET['id_service'];
            $id_pelanggan = $_GET['id_pelanggan'];
            $data = [
                'id_pelanggan' => $this->db->get('tb_pelanggan')->row_array(),
                'jenis_service' => $this->db->get('tb_jenis_service')->result_array(),
                'sub_service' => $this->db->get('tb_sub_jenis_service')->result_array(),
                "detail_data_service" => $this->Data_service_model->detail_data_service($id_service, $id_pelanggan),
            ];
            echo json_encode($this->load->view('menu/ajax-request/edit-data-spk', $data));
            // echo json_encode($data);
        } else {
            echo json_encode('Request failed');
        }
    }

    public function get_service_spareparts_by_id()
    {
        $data = [
            'id_service' => $_POST['id_service'],
            'id_pelanggan' => $_POST['id_pelanggan']
        ];

        echo json_encode($data);
    }

    public function getHargaService()
    {
        $jenis_service = $_POST['jenis_service'];
        $data = [
            'harga_jasa' => $this->db->get_where('tb_jenis_service', ['nama_service' => $jenis_service])->row_array()
        ];

        echo json_encode($data);
    }

    public function getHargaSubService()
    {
        $sub_service = $_POST['sub_service'];
        $data = [
            'harga_jasa' => $this->db->get_where('tb_sub_jenis_service', ['nama_sub_service' => $sub_service])->row_array()
        ];
        echo json_encode($data);
    }

    public function prosess_ubah_data_service()
    {
        $id_service = $_POST['id_service'];
        $data = [
            'id_pelanggan' => $_POST['id_pelanggan'],
            'kd_service' => $_POST['kd_service'],
            'jenis_service' => $_POST['jenis_service'],
            'harga' => $_POST['harga_jasa'],
            'sub_service' => $_POST['sub_service'],
            'service_lain' => $_POST['service_lain'],
            'tgl_service' => $_POST['tgl_service'],
            'info_lain' => $_POST['info_lain']
        ];
        if ($this->input->is_ajax_request()) {
            $this->db->update('tb_data_service', $data, ['id' => $id_service]);
            $msg = [
                'response' => 200,
                'message' => 'Data berhasil di ubah'
            ];
            echo json_encode($msg);
        } else {
            echo json_encode("Request failed");
        }
    }

    public function status_service()
    {
        $id_service = $_POST['id_service'];
        $status = $_POST['status'];
        $this->db->set('id_status', $status);
        $this->db->where('id_service', $id_service);
        $this->db->update('tb_spareparts_service');
        $msg = [
            'response' => 200,
            'message' => 'Status di ubah'
        ];
        echo json_encode($msg);
    }

    public function cetak_spk()
    {
        if ($this->input->is_ajax_request()) {
            $id_service = $_GET['id_service'];
            $id_pelanggan = $_GET['id_pelanggan'];
            $data = [
                "detail_data_service" => $this->Data_service_model->detail_data_service($id_service, $id_pelanggan),
                "data_spareparts" => $this->Data_service_model->get_sub_spareparts_by_id($id_service, $id_pelanggan)
            ];
            echo json_encode($this->load->view('menu/ajax-request/cetak-spk', $data));
        } else {
            echo json_encode("Request failed");
        }
    }

    public function proses_cetak_spk()
    {
        if ($this->input->is_ajax_request()) {
            $id_service = $_GET['id_service'];
            $id_pelanggan = $_GET['id_pelanggan'];
            $data = [
                "detail_data_service" => $this->Data_service_model->detail_data_service($id_service, $id_pelanggan),
                "data_spareparts" => $this->Data_service_model->get_sub_spareparts_by_id($id_service, $id_pelanggan)
            ];
            echo json_encode($this->load->view('menu/ajax-request/spk', $data));
        } else {
            echo json_encode("Request failed");
        }
    }

    public function cetak_invoice()
    {
        if ($this->input->is_ajax_request()) {
            $id_service = $_GET["id_service"];
            $id_pelanggan = $_GET["id_pelanggan"];
            $data = [
                "detail_invoice" => $this->Data_service_model->detail_data_service($id_service, $id_pelanggan),
                "kd_invoice" => $this->Kode_otomatis_model->getKodeInvoice($id_pelanggan),
                "data_spareparts" => $this->Data_service_model->get_sub_spareparts_by_id($id_service, $id_pelanggan),
                // "total_biaya" => $this->Data_service_model->get_total_biaya($id_service)
            ];
            echo json_encode($this->load->view('menu/ajax-request/invoice', $data));
        } else {
            echo json_encode("Request failed");
        }
    }

    public function proses_cetak_invoice()
    {
        if ($this->input->is_ajax_request()) {
            $id_service = $_GET["id_service"];
            $id_pelanggan = $_GET["id_pelanggan"];
            $data = [
                "detail_invoice" => $this->Data_service_model->detail_data_service($id_service, $id_pelanggan),
                "kd_invoice" => $this->Kode_otomatis_model->getKodeInvoice($id_pelanggan),
                "data_spareparts" => $this->Data_service_model->get_sub_spareparts_by_id($id_service, $id_pelanggan),
                // "total_biaya" => $this->Data_service_model->get_total_biaya($id_service)
            ];
            echo json_encode($this->load->view('menu/ajax-request/proses_cetak_invoice', $data));
        } else {
            echo json_encode("Request failed");
        }
    }

    public function data_pelanggan()
    {
        $this->db->select('users.*, tb_posisi.nama_posisi');
        $this->db->join('tb_posisi', 'users.id_posisi = tb_posisi.id');
        $this->db->where('username', $this->session->userdata('username'));
        $data =  [
            'judul' => 'Data Pelanggan',
            'users' => $this->db->get('users')->row_array()
        ];

        $this->load->view('templete/header', $data);
        $this->load->view('menu/menu-data-pelanggan', $data);
        $this->load->view('templete/footer');
    }

    public function load_table_pelanggan()
    {
        if ($this->input->is_ajax_request()) {
            $data = [
                'data_pelanggan' => $this->Data_service_model->semua_data_pelanggan()
                // 'data_pelanggan' => $this->db->get('tb_pelanggan')->result_array()
            ];
            echo json_encode($this->load->view('menu/ajax-request/table-data-pelanggan', $data));
        } else {
            echo json_encode('Request failed');
        }
    }

    public function hapus_data_pelanggan()
    {
        $id_pelanggan = $_POST['id_pelanggan'];
        $id_mobil = $_POST['id_mobil'];
        if ($this->input->is_ajax_request()) {
            $this->db->delete('tb_data_mobil', ['id' => $id_mobil]);
            $this->db->delete('tb_pelanggan', ['id' => $id_pelanggan]);
            $this->db->delete('tb_data_service', ['id_pelanggan' => $id_pelanggan]);
            $this->db->delete('tb_spareparts_service', ['id_pelanggan' => $id_pelanggan]);
            $msg = [
                'status' => 200,
                'message' => 'Data berhasil di hapus'
            ];
            echo json_encode($msg);
        } else {
            echo json_encode("Request failed");
        }
    }

    public function ubah_data_pelanggan()
    {
        $id_pelanggan = $_POST['id_pelanggan'];
        if ($this->input->is_ajax_request()) {
            $data = [
                'data_pelanggan_by_id' => $this->Data_service_model->get_data_pelanggan_by_id($id_pelanggan)
            ];
            echo json_encode($data);
        } else {
            echo json_encode("Request failed");
        }
    }

    public function proses_ubah_pelanggan()
    {
        $id_pelanggan = $_POST['id_pelanggan'];
        $id_mobil = $_POST['id_mobil'];
        $data_pelanggan = [
            'nama_pelanggan' => $_POST['nama_pelanggan'],
            'no_tlp' => $_POST['no_tlp'],
            'nik' => $_POST['nik'],
            'alamat' => $_POST['alamat']
        ];

        $data_mobil = [
            'jenis_mobil' => $_POST['jenis_mobil'],
            'tipe_mobil' => $_POST['tipe_mobil'],
            'merek_mobil' => $_POST['merek_mobil'],
            'nomor_rangka' => $_POST['nomor_rangka'],
            'nomor_mesin' => $_POST['nomor_mesin'],
            'nomor_polisi' => $_POST['nomor_polisi'],
            'warna_mobil' => $_POST['warna_mobil'],
            'tahun_mobil' => $_POST['tahun_mobil']
        ];

        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('nama_pelanggan', 'Nama pelanggan', 'required');
            $this->form_validation->set_rules('no_tlp', 'No tlp', 'required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required');
            $this->form_validation->set_rules('jenis_mobil', 'Jenis mobil', 'required');
            $this->form_validation->set_rules('tipe_mobil', 'Tipe mobil', 'required');
            $this->form_validation->set_rules('merek_mobil', 'Merek mobil', 'required');
            $this->form_validation->set_rules('warna_mobil', 'Warna mobil', 'required');
            $this->form_validation->set_rules('tahun_mobil', 'Tahun mobil', 'required');

            if ($this->form_validation->run() == false) {
                $msg = [
                    'error' => [
                        'nama_pelanggan' => form_error('nama_pelanggan'),
                        'no_tlp' => form_error('no_tlp'),
                        'alamat' => form_error('alamat'),
                        'jenis_mobil' => form_error('jenis_mobil'),
                        'tipe_mobil' => form_error('tipe_mobil'),
                        'merek_mobil' => form_error('merek_mobil'),
                        'warna_mobil' => form_error('warna_mobil'),
                        'tahun_mobil' => form_error('tahun_mobil')
                    ]
                ];
            } else {
                $this->db->update('tb_pelanggan', $data_pelanggan, ['id' => $id_pelanggan]);
                $this->db->update('tb_data_mobil', $data_mobil, ['id' => $id_mobil]);
                $msg = [
                    'status' => 200,
                    'message' => 'Data berhasil diubah',
                    'id_pelanggan' => $id_pelanggan,
                    'id_mobil' => $id_mobil
                ];
            }
            echo json_encode($msg);
        } else {
            echo json_encode('Request failed');
        }
    }

    public function load_form_data_pelanggan()
    {
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->load->view('menu/ajax-request/form-data-pelanggan'));
        } else {
            echo json_encode("Request failed");
        }
    }

    public function loadBtnJenisServicePelanggan()
    {
        if ($this->input->is_ajax_request()) {
            $id_pelanggan = $_GET['id_pelanggan'];
            $id_mobil = $_GET['id_mobil'];
            $data = [
                "jenis_service" => $this->db->get("tb_jenis_service")->result_array(),
                'id_pelanggan' => $id_pelanggan,
                'id_mobil' => $id_mobil
            ];
            echo json_encode($this->load->view('menu/ajax-request/jenis-service-pelanggan', $data));
        } else {
            echo json_encode("Request failed");
        }
    }

    public function loadSubServicePelanggan()
    {
        if ($this->input->is_ajax_request()) {
            $id_pelanggan = $_GET['id_pelanggan'];
            $this->db->select('tb_sub_jenis_service.*,tb_jenis_service.nama_service');
            $this->db->from('tb_sub_jenis_service');
            $this->db->join('tb_jenis_service', 'tb_sub_jenis_service.id_jenis_service = tb_jenis_service.id');
            $data = [
                "sub_jenis_service" => $this->db->get()->result_array(),
                'id_pelanggan' => $id_pelanggan
            ];
            echo json_encode($this->load->view('menu/ajax-request/sub-jenis-service-pelanggan', $data));
        } else {
            echo json_encode("Request failed");
        }
    }

    public function loadFormDataServicePelanggan()
    {
        if ($this->input->is_ajax_request()) {
            $id_pelanggan = $_GET['id_pelanggan'];
            $this->db->select('tb_data_mobil.id_pelanggan');
            $this->db->where('id_pelanggan', $id_pelanggan);
            $data = [
                'kd_service' => $this->Kode_otomatis_model->getKode(),
                'nama_service' => $_GET['nama_service'],
                'harga_jasa' => $_GET['harga_jasa'],
                'nama_sub_service' => @$_GET['nama_sub_service'],
                'message' => 'Data pelanggan masih kosong, silahkan tambahkan pelanggan terlebih dahulu',
                'id_pelanggan' => $this->db->get('tb_data_mobil')->row_array()
            ];
            echo json_encode($this->load->view('menu/ajax-request/form-add-service-pelanggan', $data));
        } else {
            echo json_encode("Request failed");
        }
    }

    public function addTuneUpServicePelanggan()
    {
        $data = [
            'id_pelanggan' => $_POST['id_pelanggan'],
            'kd_service' => $_POST['kode_service'],
            'jenis_service' => $_POST['jenis_service'],
            'harga' => reset_rupiah($_POST['harga']),
            'sub_service' => $_POST['sub_service'],
            'service_lain' => $_POST['service_lain'],
            'tgl_service' => $_POST['tgl_service'],
            'info_lain' => $_POST['info_lain']
        ];
        $this->db->insert('tb_data_service', $data);
        $msg = [
            'status' => 201,
            'message' => 'Data berhasil ditambahkan'
        ];
        echo json_encode($msg);
    }

    public function addServiceLainPelanggan()
    {
        $data = [
            'id_pelanggan' => $_POST['id_pelanggan'],
            'kd_service' => $_POST['kode_service'],
            'jenis_service' => $_POST['jenis_service'],
            'harga' => reset_rupiah($_POST['harga']),
            'sub_service' => $_POST['sub_service'],
            'service_lain' => $_POST['service_lain'],
            'tgl_service' => $_POST['tgl_service'],
            'info_lain' => $_POST['info_lain']
        ];
        $this->db->insert('tb_data_service', $data);
        $msg = [
            'status' => 201,
            'message' => 'Data berhasil ditambahkan'
        ];
        echo json_encode($msg);
    }

    public function addServiceBerkalaPelanggan()
    {
        $data = [
            'id_pelanggan' => $_POST['id_pelanggan'],
            'kd_service' => $_POST['kode_service'],
            'jenis_service' => $_POST['jenis_service'],
            'harga' => reset_rupiah($_POST['harga']),
            'sub_service' => $_POST['sub_service'],
            'service_lain' => $_POST['service_lain'],
            'tgl_service' => $_POST['tgl_service'],
            'info_lain' => $_POST['info_lain']
        ];
        $this->db->insert('tb_data_service', $data);
        $msg = [
            'status' => 201,
            'message' => 'Data berhasil ditambahkan'
        ];
        echo json_encode($msg);
    }

    public function loadPilihSparepartsPelanggan()
    {
        if ($this->input->is_ajax_request()) {
            $data = [
                'spareparts' => $this->db->get('tb_spareparts')->result_array(),
                'id_pelanggan' => $_GET['id_pelanggan']
            ];
            echo json_encode($this->load->view('menu/ajax-request/data-spareparts-pelanggan', $data));
        } else {
            echo json_encode('Request failed');
        }
    }

    public function change_spareparts_pelanggan()
    {
        $data = [
            'id_spareparts' => $_POST['id_spareparts'],
            'id_sub_spareparts' => $_POST['id_sub_spareparts'],
            'id_pelanggan' => $_POST['id_pelanggan'],
            'id_mobil' => $_POST['id_mobil'],
            'id_service' => $_POST['id_service'],
            'id_status' => 1
        ];
        // echo json_encode($data);
        $result = $this->db->get_where('tb_spareparts_service', $data);
        if ($this->input->is_ajax_request()) {
            if ($result->num_rows() < 1) {
                $this->db->insert('tb_spareparts_service', $data);
                $msg = [
                    'response' => 201,
                    'message' => 'Spareparts berhasil ditambahkan'
                ];
                echo json_encode($msg);
            } else {
                $this->db->delete('tb_spareparts_service', $data);
                $msg = [
                    'message' => 'Spareparts tidak ditambahkan'
                ];
                echo json_encode($msg);
            }
        }
    }

    public function cek_id_pelanggan()
    {
        if ($this->input->is_ajax_request()) {
            $id_pelanggan = $_POST['id_pelanggan'];
            $result = $this->db->get_where('tb_spareparts_service', ['id_pelanggan' => $id_pelanggan]);
            if ($result->num_rows() < 1) {
                $msg = [
                    'status' => 200
                ];
            } else {
                $msg = [
                    'status' => 403,
                    'message' => 'Data service pelanggan sudah ada'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function page_error_data_service_sudah_ada()
    {
        if ($this->input->is_ajax_request()) {
            $data = [
                'message' => 'Data service pelanggan sudah ada'
            ];
            echo json_encode($this->load->view('menu/ajax-request/error-page', $data));
        } else {
            echo json_encode("Request failed");
        }
    }

    public function proses_tambah_pelanggan()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('nama_pelanggan', 'Nama pelanggan', 'required');
            $this->form_validation->set_rules('no_tlp', 'No tlp', 'required');
            $this->form_validation->set_rules('nik', 'nik', 'required|max_length[16]|min_length[16]');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required');

            if ($this->form_validation->run() == false) {
                $msg = [
                    'error' => [
                        'nama_pelanggan' => form_error('nama_pelanggan'),
                        'no_tlp' => form_error('no_tlp'),
                        'nik' => form_error('nik'),
                        'alamat' => form_error('alamat'),
                    ]
                ];
            } else {
                $data_pelanggan = [
                    'nama_pelanggan' => $_POST['nama_pelanggan'],
                    'no_tlp' => $_POST['no_tlp'],
                    'nik' => $_POST['nik'],
                    'alamat' => $_POST['alamat']
                ];

                $this->db->insert('tb_pelanggan', $data_pelanggan);

                $msg = [
                    'status' => 201,
                    'message' => 'Data berhasil di tambahkan'
                ];
            }

            echo json_encode($msg);
        } else {
            echo json_encode("Request failed");
        }
    }

    public function get_pelanggan_last_input()
    {
        if ($this->input->is_ajax_request()) {
            $this->db->select_max("tb_pelanggan.id");
            $this->db->from("tb_pelanggan");
            $result = $this->db->get()->row_array();

            echo json_encode($result);
        } else {
            echo json_encode("Request failed");
        }
    }

    public function get_data_pelanggan_last_input()
    {
        if ($this->input->is_ajax_request()) {
            $this->db->select("tb_pelanggan.*");
            $this->db->from("tb_pelanggan");
            $this->db->where("id", $_POST["id_pelanggan"]);
            $result = $this->db->get()->row_array();

            echo json_encode($result);
        } else {
            echo json_encode("Request failed");
        }
    }

    public function proses_tambah_mobil()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('jenis_mobil', 'Jenis mobil', 'required');
            $this->form_validation->set_rules('tipe_mobil', 'Tipe mobil', 'required');
            $this->form_validation->set_rules('merek_mobil', 'Merek mobil', 'required');
            $this->form_validation->set_rules('nomor_rangka', 'Nomor rangka', 'required');
            $this->form_validation->set_rules('nomor_mesin', 'Nomor mesin', 'required');
            $this->form_validation->set_rules('nomor_polisi', 'Nomor polisi', 'required');
            $this->form_validation->set_rules('warna_mobil', 'Warna mobil', 'required');
            $this->form_validation->set_rules('tahun_mobil', 'Tahun mobil', 'required');

            if ($this->form_validation->run() == false) {
                $msg = [
                    'error' => [
                        'jenis_mobil' => form_error('jenis_mobil'),
                        'tipe_mobil' => form_error('tipe_mobil'),
                        'merek_mobil' => form_error('merek_mobil'),
                        'nomor_rangka' => form_error('nomor_rangka'),
                        'nomor_mesin' => form_error('nomor_mesin'),
                        'nomor_polisi' => form_error('nomor_polisi'),
                        'no_tlp' => form_error('no_tlp'),
                        'no_tlp' => form_error('no_tlp'),
                        'warna_mobil' => form_error('warna_mobil'),
                        'tahun_mobil' => form_error('tahun_mobil')
                    ]
                ];
            } else {
                $data_mobil = [
                    'id_pelanggan' => $_POST['id_pelanggan'],
                    'jenis_mobil' => $_POST['jenis_mobil'],
                    'tipe_mobil' => $_POST['tipe_mobil'],
                    'merek_mobil' => $_POST['merek_mobil'],
                    'nomor_rangka' => $_POST['nomor_rangka'],
                    'nomor_mesin' => $_POST['nomor_mesin'],
                    'nomor_polisi' => $_POST['nomor_polisi'],
                    'warna_mobil' => $_POST['warna_mobil'],
                    'tahun_mobil' => $_POST['tahun_mobil']
                ];
                $this->db->insert('tb_data_mobil', $data_mobil);
                $msg = [
                    'status' => 201,
                    'message' => 'Data berhasil di tambahkan'
                ];
            }
            echo json_encode($msg);
        } else {
            echo json_encode("Request failed");
        }
    }

    public function hapus_semua_data_pelanggan()
    {
        if ($this->input->is_ajax_request()) {
            $id_pelanggan = $_POST['id_pelanggan'];
            for ($i = 0; $i < count($id_pelanggan); $i++) {
                $this->db->delete('tb_pelanggan', ['id' => $id_pelanggan[$i]]);
                $this->db->delete('tb_data_mobil', ['id_pelanggan' => $id_pelanggan[$i]]);
                $this->db->delete('tb_data_service', ['id_pelanggan' => $id_pelanggan[$i]]);
                $this->db->delete('tb_spareparts_service', ['id_pelanggan' => $id_pelanggan[$i]]);
            }
            $msg = [
                'status' => 200,
                'message' => 'Data berhasil di hapus'
            ];

            echo json_encode($msg);
        }
    }
}
