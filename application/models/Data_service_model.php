<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Data_service_model extends CI_Model
{
    public function getAllDataService()
    {
        $this->db->select('tb_data_service.kd_service, tb_data_service.id as id_service,  tb_data_mobil.tipe_mobil, tb_data_mobil.id as id_mobil, tb_pelanggan.nama_pelanggan, tb_pelanggan.id as id_pelanggan, tb_status_service.*, tb_spareparts_service.id_status, tb_spareparts_service.id');
        $this->db->from('tb_spareparts_service');
        $this->db->join('tb_data_service', 'tb_spareparts_service.id_service = tb_data_service.id');
        $this->db->join('tb_data_mobil', 'tb_spareparts_service.id_mobil = tb_data_mobil.id');
        $this->db->join('tb_pelanggan', 'tb_spareparts_service.id_pelanggan = tb_pelanggan.id');
        $this->db->join('tb_status_service', 'tb_spareparts_service.id_status = tb_status_service.id');
        $this->db->group_by('tb_spareparts_service.id_pelanggan');
        // $this->db->order_by('tb_spareparts_service.id', 'DESC');
        $result = $this->db->get()->result_array();

        return $result;
    }

    public function detail_data_service($id_service, $id_pelanggan)
    {
        $this->db->select('tb_pelanggan.*, tb_data_mobil.*, tb_data_service.*, tb_spareparts_service.id_service, tb_spareparts_service.id_status');
        $this->db->join('tb_pelanggan', 'tb_spareparts_service.id_pelanggan = tb_pelanggan.id');
        $this->db->join('tb_data_mobil', 'tb_spareparts_service.id_mobil = tb_data_mobil.id');
        $this->db->join('tb_data_service', 'tb_spareparts_service.id_service = tb_data_service.id');
        $this->db->where('tb_spareparts_service.id_service', $id_service);
        $this->db->where('tb_spareparts_service.id_pelanggan', $id_pelanggan);
        $result = $this->db->get('tb_spareparts_service')->row_array();

        return $result;
    }

    public function get_sub_spareparts_by_id($id_service, $id_pelanggan)
    {
        $this->db->select('tb_sub_spareparts.nama_spareparts, tb_sub_spareparts.harga as harga_spareparts, kd_spareparts, tb_spareparts.nama_spareparts as spareparts');
        $this->db->join('tb_spareparts','tb_spareparts_service.id_spareparts = tb_spareparts.id');
        $this->db->join('tb_sub_spareparts', 'tb_spareparts_service.id_sub_spareparts = tb_sub_spareparts.id');
        $this->db->where('tb_spareparts_service.id_service', $id_service);
        $this->db->where('tb_spareparts_service.id_pelanggan', $id_pelanggan);
        $result = $this->db->get('tb_spareparts_service')->result_array();

        return $result;
    }
}
