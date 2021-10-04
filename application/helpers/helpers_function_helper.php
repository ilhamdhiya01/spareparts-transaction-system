<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function change_access($level_id, $menu_id){
    $ci = get_instance();
    $ci->db->where('level_id',$level_id);
    $ci->db->where('menu_id',$menu_id);
    $reuslt = $ci->db->get('tb_user_access_menu');
    if($reuslt->num_rows() > 0){
        return "checked='checked'";
    }
}