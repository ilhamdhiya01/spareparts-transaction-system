<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class SubMenu_model extends CI_Model
{
    // public function _getAllSubMenu_SideBar(){

    // }
    public function getAllSubMenu()
    {
        $this->db->select('tb_user_sub_menu.*, tb_user_menu.nama_menu');
        $this->db->from('tb_user_sub_menu');
        $this->db->join('tb_user_menu', 'tb_user_menu.id = tb_user_sub_menu.menu_id');
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function getAllDropdownMenu()
    {
        $this->db->select('dropdown_menu.*, tb_user_sub_menu.sub_menu');
        $this->db->from('dropdown_menu');
        $this->db->join('tb_user_sub_menu', 'tb_user_sub_menu.id = dropdown_menu.sub_menu_id');
        $query = $this->db->get()->result_array();
        return $query;
    }
}
