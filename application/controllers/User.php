<?php
defined('BASEPATH') or exit('No direct script access allowed');

class user extends CI_Controller
{
    private $user;

    public function __construct()
    {
        parent::__construct();
        cek_logged_in();
        $this->user = $this->db->get_where('user', ['email_user' =>
        $this->session->userdata('email')])->row_array();
    }

    public function cekHutangDeadline()
    {
        $this->load->model('penghutang_model');
        $id_user = $this->user['id_user'];
        $tanggal = date("Y-m-d", time() - 86400); // Hari ini - 1 hari.
        $hutang = $this->penghutang_model->hutang_berdasarkan_tanggal($tanggal, $id_user);
        $noHutang = count($hutang);
        if ($noHutang > 0) {
            return "<div style='padding:15px;margin-bottom:20px;border:1px solid transparent;border-radius:4px' class='alert-danger'>
                            Anda memiliki " . $noHutang . " hutang yang akan segera jatuh tempo. Harap segera dibayar!
                            </div>
            ";
        }
    }

    public function index()
    {
        $data['title'] = 'Profil Saya';
        $data['user'] = $this->user;
        $data['notifHutang'] = $this->cekHutangDeadline();
        $data['dataDiri'] = $this->db->get_where('data_diri_penghutang', ['id_user' => $this->user['id_user']])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function updateDataDiri()
    {
        $this->form_validation->set_rules('nik', 'NIK', 'required|trim|exact_length[16]');
        $this->form_validation->set_rules('penghasilan_perbulan', 'Penghasilan per bulan', 'required|trim');
        $this->form_validation->set_rules('no_wa', 'Nomor WA', 'required|trim|numeric|min_length[10]|max_length[13]');
        $this->form_validation->set_rules('alamat', 'Alamat rumah', 'required|trim');

        $id_user = $this->user['id_user'];

        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $dataDiri = [
                'nik' => htmlspecialchars($this->input->post('nik', true)),
                'penghasilan_perbulan' => htmlspecialchars($this->input->post('penghasilan_perbulan', true)),
                'nomor_wa' => htmlspecialchars($this->input->post('no_wa', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
            ];

            $this->db->where('id_user', $id_user);
            $this->db->update('data_diri_penghutang', $dataDiri);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil memperbarui data diri.
            </div>');
            redirect('user');
        }
    }

    public function hutang($id_hutang = NULL)
    {
        $this->load->model('penghutang_model');

        $user = $this->user;

        if ($id_hutang == NULL) {
            $hutangAktif = $this->penghutang_model->hutang_aktif($user['id_user']);
            $hutangLunas = $this->penghutang_model->hutang_lunas($user['id_user']);

            $data = [
                'title' => 'Hutang Saya',
                'user' => $user,
                'hutangAktif' => $hutangAktif,
                'hutangLunas' => $hutangLunas
            ];

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/hutang/index', $data);
            $this->load->view('templates/footer');
        } else {
            $hutang = $this->penghutang_model->ambil_info_hutang($id_hutang);
            $detailHutang = $this->penghutang_model->ambil_detail_hutang($id_hutang);

            $this->load->model('bank_model');

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
            $this->load->view('user/hutang/detail', $data);
            $this->load->view('templates/footer');
        }
    }


    public function edit()
    {
        $data['title'] = 'Edit Profil';
        $data['user'] = $this->user;

        $this->form_validation->set_rules('name', 'Nama Panjang', 'required|trim');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types']    = 'gif|jpg|png';
                $config['max_size']         = '2048';
                $config['upload_path']      = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image_user'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'asssets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image_user', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('name_user', $name);
            $this->db->where('email_user', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Selamat! Profil anda berhasil diubah!
            </div>');
            redirect('user');
        }
    }

    public function gantiPassword()
    {
        $data['title'] = 'Ganti Password';
        $data['user'] = $this->user;

        $this->form_validation->set_rules('current_password', 'Password Saat Ini', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'Password Baru', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Konfirmasi Password Baru', 'required|trim|min_length[3]|matches[new_password1]');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/gantipassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password_user'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Password Saat Ini Salah!</div>');
                redirect('user/gantipassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Password Baru Tidak Boleh Sama Dengan Password Lama!</div>');
                    redirect('user/gantipassword');
                } else {
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);


                    $this->db->set('password_user', $password_hash);
                    $this->db->where('email_user', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Password Berhasil Diubah!</div>');
                    redirect('user/gantipassword');
                }
            }
        }
    }

    public function pesan()
    {
        $this->load->model('pesan_model');
        $user =
            $this->user;

        $data = [
            'title' => 'Pesan',
            'user' => $user,
            'pesan' =>  $this->pesan_model->ambil_semua_pesan_user($user['id_user'])
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
            $this->user;
        $data = [
            'id_user' => $user['id_user'],
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

        redirect('user/pesan');
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
        $user =
            $this->user;
        $data = [
            'id_user' => $user['id_user'],
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

        redirect('user/pesan');
    }

    public function _uploadBuktiPembayaran($foto)
    {
        $config['upload_path']          = './assets/img/bukti_pembayaran/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name']            = md5($foto['foto']['name']);
        $config['max_size']             = 100;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto')) {
            print $this->upload->display_errors();
            die();
        } else {
            return $this->upload->data();
        }
    }

    public function simpanPembayaran()
    {
        $this->load->model('penghutang_model');
        $this->load->model('pembayaran_model');

        $id_hutang = $this->input->post('id_hutang');

        // Simpan Bukti Pembayaran
        $data = [
            "nama_pengirim" => $this->input->post('nama_pengirim'),
            "nomor_rekening" => $this->input->post('nomor_rekening'),
            "bank_pengirim" => $this->input->post('bank_pengirim'),
            "id_bank" => $this->input->post('id_bank'),
            "status_pembayaran" => "Menunggu Verifikasi"
        ];

        $id_pembayaran = 0;

        if (!empty($_FILES['foto']['name'])) {
            $upload = $this->_uploadBuktiPembayaran($_FILES);

            if ($upload) {

                $data['foto_bukti_pembayaran'] = $upload['file_name'];

                $id_pembayaran = $this->pembayaran_model->simpan_pembayaran($data);
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal mengunggah bukti pembayaran :(</div>');
                redirect('user/hutang/' . $id_hutang);
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Harus memasukkan foto!</div>');
            redirect('user/hutang/' . $id_hutang);
        }

        $dataDetailHutang = [
            'id_hutang' => $id_hutang,
            'total_bayar_hutang' => $this->input->post('total_bayar'),
            'tanggal_bayar_hutang' => date('Y-m-d'),
            'id_pembayaran' => $id_pembayaran
        ];

        $proses = $this->penghutang_model->tambah_detail_hutang($dataDetailHutang);

        if ($proses) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menambahkan bayaran hutang!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambahkan bayaran hutang!</div>');
        }

        redirect('user/hutang/' . $id_hutang);
    }

    public function ubahPembayaran()
    {
        $this->load->model('penghutang_model');
        $this->load->model('pembayaran_model');

        $id_detail_hutang = $this->input->post('id_detail_hutang');
        $satuDetailHutang = $this->penghutang_model->ambil_satu_detail_hutang($id_detail_hutang);

        $id_hutang = $this->input->post('id_hutang');
        $id_pembayaran = $satuDetailHutang['id_pembayaran'];

        // Simpan Bukti Pembayaran
        $data = [
            "nama_pengirim" => $this->input->post('nama_pengirim'),
            "nomor_rekening" => $this->input->post('nomor_rekening'),
            "bank_pengirim" => $this->input->post('bank_pengirim'),
            "id_bank" => $this->input->post('id_bank'),
            "status_pembayaran" => "Menunggu Verifikasi"
        ];

        if (!empty($_FILES['foto']['name'])) {
            $upload = $this->_uploadBuktiPembayaran($_FILES);
            if ($upload) {
                $data['foto_bukti_pembayaran'] = $upload['file_name'];
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal mengunggah bukti pembayaran :(</div>');
                redirect('user/hutang/' . $id_hutang);
            }
        }

        $this->pembayaran_model->ubah_pembayaran($data, $id_detail_hutang);

        $dataDetailHutang = [
            'id_hutang' => $id_hutang,
            'total_bayar_hutang' => $this->input->post('total_bayar'),
            'tanggal_bayar_hutang' => date('Y-m-d'),
            'id_pembayaran' => $id_pembayaran
        ];

        $proses = $this->penghutang_model->ubah_detail_hutang($dataDetailHutang, $id_detail_hutang);

        if ($proses) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil mengubah bayaran hutang!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal mengubah bayaran hutang!</div>');
        }

        redirect('user/hutang/' . $id_hutang);
    }

    public function hapusPembayaran($id_detail_hutang)
    {
        $this->load->model('penghutang_model');
        $this->load->model('pembayaran_model');

        $satuDetailHutang = $this->penghutang_model->ambil_satu_detail_hutang($id_detail_hutang);
        $id_hutang = $satuDetailHutang['id_hutang'];
        $id_pembayaran = $satuDetailHutang['id_pembayaran'];
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
        $this->pembayaran_model->hapus_pembayaran($id_pembayaran);

        if ($proses) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menghapus bayaran hutang!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menghapus bayaran hutang!</div>');
        }
    }
}
