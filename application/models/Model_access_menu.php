<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Model_access_menu extends CI_Model
{
    public function getAccessMenu()
    {
        $this->db->select('users.*,tb_posisi.nama_posisi');
        $this->db->from('users');
        $this->db->join('tb_posisi', 'users.id_posisi = tb_posisi.id');
        $result = $this->db->get()->result_array();
        return $result;
    }
}
