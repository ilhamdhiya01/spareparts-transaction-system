<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Auth_model extends CI_Model
{
    public function getUser($username){
        $this->db->select('users.*,level_user.*');
        $this->db->from('users');
        $this->db->join('level_user','users.level_id = level_user.id');
        $this->db->where('username',$username);
        $query = $this->db->get()->row_array();
        return $query;
    }
}
