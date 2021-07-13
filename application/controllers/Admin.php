<?php
defined('BASEPATH') or exit('No direct script access allowed');

class admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_logged_in();
        is_admin();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();


        $data['data_user'] = $this->db->get('user')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }

    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');


        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
            Akses Anda Telah Berubah!
          </div>');
    }
    public function catatan()
    {
        $data['title'] = 'Catatan';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['data_user'] = $this->db->get('user')->result_array();
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('hutang', 'Hutang', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/catatan', $data);
            $this->load->view('templates/footer');
        } else {
            $tanggalHoetanq = date("y/m/d"); // Tanggal hari ini
            $data = [
                'nama_hutang' => $this->input->post('nama'),
                'jumlah_hutang' => $this->input->post('hutang'),
                'tanggal_hutang' => $tanggalHoetanq,
                'tenggat_hutang' => $this->input->post('tenggat_hutang')
            ];
            if (!preg_match("/^[a-zA-Z ]*$/", $data['nama_hutang'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Angka tidak diizinkan!</div>');
                redirect('admin/catatan');
            } else {
            }
            $this->db->insert('catatan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Selamat! Data Hutang Berhasil Dimasukkan!
          </div>');
            redirect('admin/catatan');
        }
    }

    public function lunas()
    {
        $data['title'] = 'Hutang Lunas';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['datahutang'] = $this->db->get('catatan')->result_array();


        $data['data_user'] = $this->db->get('user')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/lunas', $data);
        $this->load->view('templates/footer');
    }
    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('catatan');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Hutang berhasil dihapus!</div>');
        redirect('admin/lunas');
    }



    // Pesan
    public function pesan()
    {
        $this->load->model('pesan_model');
        $user =
            $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data = [
            'title' => 'Pesan',
            'user' => $user,
            'pesan' =>  $this->pesan_model->ambil_semua_pesan()
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/pesan/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambahPesan()
    {
        $this->load->model('pesan_model');
        $user =
            $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data = [
            'user_id' => $user['id'],
            'isi_pesan' => $this->input->post('isi_pesan'),
            'status' => 'Open',
            'tanggal' => date("Y-m-d H:i:s")
        ];

        $proses = $this->pesan_model->tambah_pesan($data);

        if ($proses) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menambahkan pesan!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambahkan pesan!</div>');
        }

        redirect('admin/pesan');
    }

    public function detailPesan()
    {
        $this->load->model('pesan_model');
        $user =
            $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $id = $this->uri->segment('3');

        $data = [
            'title' => 'Pesan',
            'user' => $user,
            'pesan' =>  $this->pesan_model->ambil_detail_pesan_user($id),
            'detailPesan' => $this->pesan_model->detail_balasan_pesan($id)
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/pesan/detail', $data);
        $this->load->view('templates/footer');
    }

    public function balasPesan()
    {
        $this->load->model('pesan_model');
        $user =
            $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data = [
            'user_id' => $user['id'],
            'pesan_id' => $this->input->post('pesan_id'),
            'isi_balasan' => $this->input->post('isi_balasan'),
            'tanggal' => date("Y-m-d H:i:s")
        ];

        $proses = $this->pesan_model->balas_pesan($data);

        if ($proses) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menambahkan pesan!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambahkan pesan!</div>');
        }

        redirect('user/detailPesan/' . $this->input->post('pesan_id'));
    }

    public function tutupPesan()
    {
        $this->load->model('pesan_model');
        $data = [
            'status' => 'Selesai'
        ];
        $id = $this->input->post('pesan_id');

        $proses = $this->pesan_model->tutup_pesan($data, $id);

        if ($proses) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pesan selesai.</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Pesan gagal selesai.</div>');
        }

        redirect('admin/pesan');
    }
}
