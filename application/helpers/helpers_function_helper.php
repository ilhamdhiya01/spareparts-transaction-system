<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function cek_access_user()
{
    $ci = get_instance();
    if (!$ci->session->userdata('username')) {
        $ci->session->set_flashdata('flash','Login terlebih dulu !');
        redirect('auth');
    }
}


function change_access($level_id, $menu_id)
{
    $ci = get_instance();
    $ci->db->where('level_id', $level_id);
    $ci->db->where('menu_id', $menu_id);
    $reuslt = $ci->db->get('tb_user_access_menu');
    if ($reuslt->num_rows() > 0) {
        return "checked='checked'";
    }
}

function rupiah($angka)
{
    $hasil = "Rp. " . number_format($angka, 0, ',', '.');
    return $hasil;
}

function reset_rupiah($rupiah)
{
    $format = preg_replace("/[Rp.]/", "", $rupiah);
    return $format;
}

function change_spareparts_checked($id_pelanggan, $id_sub_spareparts)
{
    $ci = get_instance();
    $ci->db->where('id_pelanggan', $id_pelanggan);
    $ci->db->where('id_sub_spareparts', $id_sub_spareparts);
    $result = $ci->db->get('tb_spareparts_service');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
