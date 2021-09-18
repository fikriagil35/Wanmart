<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bank_model extends CI_Model
{
    public function ambil_semua_data_bank()
    {
        return $this->db->get('bank')->result_array();
    }

    public function ambil_satu_bank($id)
    {
        $this->db->from('bank')
            ->where('id_bank', $id);
        return $this->db->get()->row_array();
    }

    public function tambah_bank($data)
    {
        return $this->db->insert('bank', $data);
    }
    
    public function ubah_bank($data, $id)
    {
        $this->db->where('id_bank', $id);
        return $this->db->update('bank', $data);
    }
}
