<?php
defined('BASEPATH') or exit('No direct script access allowed');

class admin extends CI_Controller
{
    private $user;

    public function __construct()
    {
        parent::__construct();
        cek_logged_in();
        is_admin();

        $this->user = $this->db->get_where('user', ['email_user' =>
        $this->session->userdata('email')])->row_array();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->user;


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
        $data['user'] = $this->user;

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
        $data['user'] = $this->user;

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

    public function penghutang($id = NULL)
    {
        $this->load->model('penghutang_model');

        if ($id == NULL) {
            $user = $this->db->get_where('user', ['email_user' =>
            $this->session->userdata('email')])->row_array();
            $dataPenghutang = $this->penghutang_model->ambil_semua_data_penghutang();
            $data = [
                'title' => 'Penghutang',
                'user' => $user,
                'dataPenghutang' => $dataPenghutang
            ];

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/penghutang/index', $data);
            $this->load->view('templates/footer');
        } else {
            $user = $this->db->get_where('user', ['email_user' =>
            $this->session->userdata('email')])->row_array();
            $dataPenghutang = $this->penghutang_model->ambil_satu_penghutang($id);
            $hutangAktif = $this->penghutang_model->hutang_aktif($id);
            $hutangLunas = $this->penghutang_model->hutang_lunas($id);

            $data = [
                'title' => 'Penghutang',
                'user' => $user,
                'dataPenghutang' => $dataPenghutang,
                'hutangAktif' => $hutangAktif,
                'hutangLunas' => $hutangLunas
            ];
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/penghutang/detail', $data);
            $this->load->view('templates/footer');
        }
    }

    public function tambahHutang()
    {
        $this->load->model('penghutang_model');

        $id_user = $this->input->post('id_user');
        $data = [
            'id_user' => $id_user,
            'nama_hutang' => $this->input->post('nama_hutang'),
            'keterangan_hutang' => $this->input->post('keterangan_hutang'),
            'jumlah_hutang' => $this->input->post('jumlah_hutang'),
            'tanggal_hutang' => $this->input->post('tanggal_hutang'),
            'tenggat_waktu_hutang' => $this->input->post('tenggat_waktu_hutang'),
            'status_hutang' => 'Belum lunas'
        ];

        $proses = $this->penghutang_model->tambah_hutang($data);

        if ($proses) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menambahkan hutang!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambahkan hutang!</div>');
        }

        redirect('admin/penghutang/' . $id_user);
    }

    public function hapusHutang($id_hutang)
    {
        $this->load->model('penghutang_model');

        $hutang = $this->penghutang_model->ambil_info_hutang($id_hutang);
        $id_user = $hutang['id_user'];

        $proses = $this->penghutang_model->hapus_hutang($id_hutang);

        if ($proses) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menghapus hutang!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menghapus hutang!</div>');
        }

        redirect('admin/penghutang/' . $id_user);
    }

    public function detailHutang($id_hutang)
    {
        $this->load->model('penghutang_model');
        $this->load->model('bank_model');

        $user = $this->user;

        $hutang = $this->penghutang_model->ambil_info_hutang($id_hutang);
        $detailHutang = $this->penghutang_model->ambil_detail_hutang($id_hutang);

        $data = [
            'title' => 'Detail Hutang',
            'user' => $user,
            'hutang' => $hutang,
            'detailHutang' => $detailHutang,
            'databank' => $this->bank_model->ambil_semua_data_bank()
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/penghutang/detail_hutang', $data);
        $this->load->view('templates/footer');
    }

    public function perbaruiPembayaran()
    {
        $this->load->model('penghutang_model');
        $this->load->model('pembayaran_model');

        $id_hutang = $this->input->post('id_hutang');

        $id_detail_hutang = $this->input->post('id_detail_hutang');
        $satuDetailHutang = $this->penghutang_model->ambil_satu_detail_hutang($id_detail_hutang);

        $id_pembayaran = $satuDetailHutang['id_pembayaran'];
        $total_bayar = $satuDetailHutang['total_bayar_hutang'];

        $hutang = $this->penghutang_model->ambil_info_hutang($id_hutang);
        $detailHutang = $this->penghutang_model->ambil_detail_hutang($id_hutang);
        $jumlahBayar = count($detailHutang);

        $statusPembayaran = [
            'status_pembayaran' => $this->input->post('status_pembayaran')
        ];

        $this->pembayaran_model->ubah_pembayaran($statusPembayaran, $id_pembayaran);

        if ($statusPembayaran['status_pembayaran'] == "Terverifikasi") {

            if ($jumlahBayar > 0) {
                $totalDibayar = !empty($this->input->post('total_bayar')) ? $this->input->post('total_bayar') : 0;
                $bayar = $totalDibayar;

                foreach ($detailHutang as $dh) :
                    $totalDibayar += $dh['total_bayar_hutang'];
                endforeach;

                $dataDetailHutang = [
                    'id_hutang' => $id_hutang,
                    'total_bayar_hutang' => $bayar
                ];

                $proses = $this->penghutang_model->ubah_detail_hutang($dataDetailHutang, $id_detail_hutang);

                if ($proses) {
                    if ($totalDibayar >= $hutang['jumlah_hutang']) {
                        $data = [
                            'status_hutang' => 'Lunas'
                        ];

                        $this->penghutang_model->update_hutang($id_hutang, $data);
                    }
                }
            } else {
                $totalDibayar = !empty($this->input->post('total_bayar')) ? $this->input->post('total_bayar') : $total_bayar;
                $dataDetailHutang = [
                    'id_hutang' => $id_hutang,
                    'total_bayar_hutang' => $totalDibayar,
                    'tanggal_bayar_hutang' => $this->input->post('tanggal_bayar')
                ];

                $proses = $this->penghutang_model->tambah_detail_hutang($dataDetailHutang);

                if ($totalDibayar >= $hutang['jumlah_hutang']) {
                    $data = [
                        'status_hutang' => 'Lunas'
                    ];
                } else {
                    $data = [
                        'status_hutang' => 'Sedang dicicil'
                    ];
                }

                $this->penghutang_model->update_hutang($id_hutang, $data);
            }
            if ($proses) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menyimpan bayaran hutang!</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menyimpan bayaran hutang!</div>');
            }
            redirect('admin/detailHutang/' . $id_hutang);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menyimpan bayaran hutang!</div>');
            redirect('admin/detailHutang/' . $id_hutang);
        }
    }

    public function tambahDetailHutang()
    {
        $this->load->model('penghutang_model');
        $this->load->model('pembayaran_model');

        $id_hutang = $this->input->post('id_hutang');
        $hutang = $this->penghutang_model->ambil_info_hutang($id_hutang);
        $detailHutang = $this->penghutang_model->ambil_detail_hutang($id_hutang);
        $jumlahBayar = count($detailHutang);

        $pembayaran = [
            "nama_pengirim" => "Bayar di tempat",
            "nomor_rekening" => "Bayar di tempat",
            "bank_pengirim" => "Bayar di tempat",
            "status_pembayaran" => "Terverifikasi"
        ];

        $id_pembayaran = $this->pembayaran_model->simpan_pembayaran($pembayaran);

        if ($jumlahBayar > 0) {
            $totalDibayar = 0;

            foreach ($detailHutang as $dh) :
                $totalDibayar += $dh['total_bayar_hutang'];
            endforeach;

            $dataDetailHutang = [
                'id_hutang' => $id_hutang,
                'total_bayar_hutang' => $this->input->post('total_bayar'),
                'tanggal_bayar_hutang' => $this->input->post('tanggal_bayar'),
                'id_pembayaran' => $id_pembayaran
            ];

            $proses = $this->penghutang_model->tambah_detail_hutang($dataDetailHutang);

            if ($proses) {
                if ($totalDibayar >= $hutang['jumlah_hutang']) {
                    $data = [
                        'status_hutang' => 'Lunas'
                    ];

                    $this->penghutang_model->update_hutang($id_hutang, $data);
                }
            }
        } else {
            $totalDibayar = $this->input->post('total_bayar');
            $dataDetailHutang = [
                'id_hutang' => $id_hutang,
                'total_bayar_hutang' => $totalDibayar,
                'tanggal_bayar_hutang' => $this->input->post('tanggal_bayar'),
                'id_pembayaran' => $id_pembayaran
            ];

            $proses = $this->penghutang_model->tambah_detail_hutang($dataDetailHutang);

            if ($totalDibayar >= $hutang['jumlah_hutang']) {
                $data = [
                    'status_hutang' => 'Lunas'
                ];
            } else {
                $data = [
                    'status_hutang' => 'Sedang dicicil'
                ];
            }

            $this->penghutang_model->update_hutang($id_hutang, $data);
        }

        if ($proses) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menambahkan bayaran hutang!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambahkan bayaran hutang!</div>');
        }

        redirect('admin/detailHutang/' . $id_hutang);
    }

    public function hapus_detail_hutang($id_detail_hutang)
    {
        $this->load->model('penghutang_model');

        $satuDetailHutang = $this->penghutang_model->ambil_satu_detail_hutang($id_detail_hutang);
        $id_hutang = $satuDetailHutang['id_hutang'];
        $hutang = $this->penghutang_model->ambil_info_hutang($id_hutang);

        $proses = $this->penghutang_model->hapus_detail_hutang($id_detail_hutang);

        $detailHutang = $this->penghutang_model->ambil_detail_hutang($id_hutang);
        $jumlahBayar = count($detailHutang);

        if ($jumlahBayar == 0) {
            $data = [
                'status_hutang' => 'Belum lunas'
            ];
        } else {
            $totalDibayar = 0;

            foreach ($detailHutang as $dh) :
                $totalDibayar += $dh['total_bayar_hutang'];
            endforeach;

            if ($totalDibayar >= $hutang['jumlah_hutang']) {
                $data = [
                    'status_hutang' => 'Lunas'
                ];
            } else {
                $data = [
                    'status_hutang' => 'Sedang dicicil'
                ];
            }
        }

        $this->penghutang_model->update_hutang($id_hutang, $data);


        if ($proses) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menghapus bayaran hutang!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menghapus bayaran hutang!</div>');
        }

        redirect('admin/detailHutang/' . $id_hutang);
    }

    public function pesan()
    {
        $this->load->model('pesan_model');
        $this->load->model('penghutang_model');

        $dataPenghutang = $this->penghutang_model->ambil_semua_data_penghutang();
        $user = $this->user;

        $data = [
            'title' => 'Pesan',
            'user' => $user,
            'pesan' =>  $this->pesan_model->ambil_semua_pesan(),
            'penghutang' => $dataPenghutang
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/pesan', $data);
        $this->load->view('templates/footer');
    }

    public function tambahPesan()
    {
        $this->load->model('pesan_model');
        $data = [
            'id_user' => $this->input->post('id_user'),
            'isi_pesan' => $this->input->post('isi_pesan'),
            'status_pesan' => 'Open',
            'tanggal_pesan' => date("Y-m-d H:i:s")
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
        $user = $this->user;

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
        $user = $this->user;
        $data = [
            'id_user' => $user['id'],
            'id_pesan' => $this->input->post('pesan_id'),
            'balasan_pesan' => $this->input->post('isi_balasan'),
            'tanggal_balasan_pesan' => date("Y-m-d H:i:s")
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
            'status_pesan' => 'Selesai'
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

    public function bank()
    {
        $this->load->model('bank_model');

        $user = $this->user;

        $data = [
            'title' => 'Data Bank',
            'user' => $user,
            'databank' => $this->bank_model->ambil_semua_data_bank()
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/bank', $data);
        $this->load->view('templates/footer');
    }

    public function tambahBank()
    {
        $this->load->model('bank_model');
        $data = [
            'nama_bank' => $this->input->post('nama_bank'),
            'nama_pemilik_bank' => $this->input->post('nama_pemilik_bank'),
            'rekening_bank' => $this->input->post('rekening_bank')
        ];

        $proses = $this->bank_model->tambah_bank($data);

        if ($proses) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menambahkan bank.</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Bank gagal ditambahkan.</div>');
        }

        redirect('admin/bank');
    }

    public function ubahBank()
    {
        $this->load->model('bank_model');
        $data = [
            'nama_bank' => $this->input->post('nama_bank'),
            'nama_pemilik_bank' => $this->input->post('nama_pemilik_bank'),
            'rekening_bank' => $this->input->post('rekening_bank')
        ];

        $id = $this->input->post('id');

        $proses = $this->bank_model->ubah_bank($data, $id);

        if ($proses) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil mengubah bank.</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Bank gagal diubah.</div>');
        }

        redirect('admin/bank');
    }

    public function hapusBank($id)
    {
        $this->load->model('bank_model');

        $proses = $this->bank_model->hapus_bank($id);

        if ($proses) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menghapus bank.</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Bank gagal dihapus.</div>');
        }

        redirect('admin/bank');
    }
}
