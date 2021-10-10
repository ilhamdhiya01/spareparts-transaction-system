<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Model_access_menu extends CI_Model
{
    public function getAccessMenu()
    {
        $this->db->select('users.*,tb_posisi.nama_posisi,level_user.level');
        $this->db->from('users');
        $this->db->join('tb_posisi', 'users.id_posisi = tb_posisi.id');
        $this->db->join('level_user', 'users.level_id = level_user.id');
        $this->db->order_by('id','ASC');
        $result = $this->db->get()->result_array();
        return $result;
    }
}
