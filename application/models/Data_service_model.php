<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Data_service_model extends CI_Model
{
    public function getAllDataService()
    {
        $this->db->select('tb_data_service.kd_service, tb_data_mobil.tipe_mobil, tb_pelanggan.nama_pelanggan, tb_spareparts_service.status');
        $this->db->from('tb_spareparts_service');
        $this->db->join('tb_data_service', 'tb_spareparts_service.id_service = tb_data_service.id');
        $this->db->join('tb_data_mobil', 'tb_spareparts_service.id_mobil = tb_data_mobil.id');
        $this->db->join('tb_pelanggan', 'tb_spareparts_service.id_pelanggan = tb_pelanggan.id');
        $this->db->group_by('tb_spareparts_service.id_pelanggan');
        $this->db->order_by('tb_spareparts_service.id','DESC');
        $result = $this->db->get()->result_array();

        return $result;
    }
}
