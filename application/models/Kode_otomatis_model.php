<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Kode_otomatis_model extends CI_Model
{
    public function getKode()
    {
        $str = "SRV";
        $query = "SELECT max(kd_service) as kode_service FROM tb_data_service";
        $data = $this->db->query($query)->row_array();
        $max_kode = $data["kode_service"];
        $max_kode2 = (int)substr($max_kode, 3, 3);
        $urutan = $max_kode2 + 1;
        $kode = $str . sprintf("%03s", $urutan);

        return $kode;
    }

    public function getKodeInvoice($id_pelanggan)
    {
        $str = "INV";
        $date = date('dmY');
        $this->db->select('id as kd_invoice');
        $this->db->where('id', $id_pelanggan);
        $data = $this->db->get('tb_pelanggan')->row_array();
        $kode = $str . $date . $data['kd_invoice'];

        return $kode;
    }

    public function getKodeSpareparts()
    {
        $str = 'SPR';
        $this->db->select_max('tb_spareparts.kd_spareparts');
        $data = $this->db->get('tb_spareparts')->row_array();
        $max_kode = $data['kd_spareparts'];
        $max_kode2 = (int)substr($max_kode, 4, 4);
        $urutan = $max_kode2 + 1;
        $kode = $str . sprintf('%04s', $urutan);

        return $kode;
    }
}
