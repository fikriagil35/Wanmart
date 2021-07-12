<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesan_model extends CI_Model
{
    public function ambil_semua_pesan()
    {
        return $this->db->get('pesan')->result_array();
    }

    public function ambil_semua_pesan_user($id)
    {
        $this->db->where('user_id', $id);
        return $this->db->get('pesan')->result_array();
    }

    public function tambah_pesan($data)
    {
        return $this->db->insert('pesan', $data);
    }

    public function ambil_detail_pesan_user($id)
    {
        $this->db->from('pesan');
        $this->db->join('user', 'user.id = pesan.user_id');
        $this->db->where(
            'pesan.id',
            $id
        );
        return $this->db->get()->result_array();
    }

    public function balas_pesan($data)
    {
        return $this->db->insert('detail_pesan', $data);
    }

    public function detail_balasan_pesan($id)
    {
        $this->db->join('user', 'user.id = detail_pesan.user_id');
        return $this->db->get_where('detail_pesan', ['pesan_id' => $id])->result_array();
    }

    public function tutup_pesan($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('pesan', $data);
    }
}
