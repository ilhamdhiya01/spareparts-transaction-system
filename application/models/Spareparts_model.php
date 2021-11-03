<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Spareparts_model extends CI_Model
{
    public function getSubSpareparts()
    {
        $this->db->select('tb_spareparts.kd_spareparts, tb_sub_spareparts.*');
        $this->db->from('tb_sub_spareparts');
        $this->db->join('tb_spareparts', 'tb_spareparts.id = tb_sub_spareparts.id_spareparts');

        return $this->db->get()->result_array();
    }
}
