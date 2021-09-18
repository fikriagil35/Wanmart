<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran_model extends CI_Model
{
    public function simpan_pembayaran($data)
    {
        $this->db->insert('bukti_pembayaran', $data);
        return $this->db->insert_id();
    }

    public function ambil_satu_pembayaran($id)
    {
        return $this->db->get_where('bukti_pembayaran', ['id_pembayaran' => $id])->result_array();
    }
    
    public function ubah_pembayaran($data, $id)
    {
        $this->db->where('id_pembayaran', $id);
        return $this->db->update('bukti_pembayaran', $data);
    }

    public function hapus_pembayaran($id)
    {
        return $this->db->delete('bukti_pembayaran', ['id_bukti_pembayaran' => $id]);
    }
}