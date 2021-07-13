<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penghutang_model extends CI_Model
{
    public function ambil_semua_data_penghutang()
    {
        $this->db->from('user')
            ->where('role_id', 2);
        return $this->db->get()->result_array();
    }

    public function ambil_satu_penghutang($id_user)
    {
        $this->db->from('user')
            ->where('id', $id_user);
        return $this->db->get()->row_array();
    }

    public function hutang_aktif($id_user)
    {
        $statusHutangAktif = ['Belum lunas', 'Sedang dicicil'];

        $this->db->from('hutang')
            ->where('id_user =', $id_user)
            ->where_in('status', $statusHutangAktif);
        return $this->db->get()->result_array();
    }

    public function tambah_hutang($data)
    {
        return $this->db->insert('hutang', $data);
    }

    public function update_hutang($id_hutang, $data)
    {
        $this->db->where('id_hutang', $id_hutang);
        return $this->db->update('hutang', $data);
    }

    public function hapus_hutang($id_hutang)
    {
        return $this->db->delete('hutang', ['id_hutang' => $id_hutang]);
    }

    public function ambil_info_hutang($id_hutang)
    {
        $this->db->from('hutang')
            ->join('user', 'hutang.id_user = user.id', 'left')
            ->where('hutang.id_hutang =', $id_hutang);
        return $this->db->get()->row_array();
    }

    public function ambil_detail_hutang($id_hutang)
    {
        $this->db->from('detail_hutang')
            ->where('detail_hutang.id_hutang =', $id_hutang);
        return $this->db->get()->result_array();
    }

    public function ambil_satu_detail_hutang($id_detail_hutang)
    {
        return $this->db->get_where('detail_hutang', ['id_detail_hutang' => $id_detail_hutang])->row_array();
    }

    public function tambah_detail_hutang($data)
    {
        return $this->db->insert('detail_hutang', $data);
    }

    public function hapus_detail_hutang($id_detail_hutang)
    {
        return $this->db->delete('detail_hutang', ['id_detail_hutang' => $id_detail_hutang]);
    }
}
