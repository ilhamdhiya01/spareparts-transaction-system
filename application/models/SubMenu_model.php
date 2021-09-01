<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class SubMenu_model extends CI_Model
{
    public function getAllSubMenu()
    {
        $this->db->select('tb_user_sub_menu.*, tb_user_menu.nama_menu');
        $this->db->from('tb_user_sub_menu');
        $this->db->join('tb_user_menu','tb_user_menu.id = tb_user_sub_menu.menu_id');
        $query = $this->db->get()->result_array();
        return $query;
    }
}
