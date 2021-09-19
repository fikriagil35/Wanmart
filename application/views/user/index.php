<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Profil Anggota</h1>

    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <?= $notifHutang ?>

    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="<?= base_url('assets/img/profile/') . $user['image_user'] ?>" class="card-img">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Nama: <?= $user['name_user']; ?></h5>
                                <p class="card-text">Email: <?= $user['email_user']; ?></p>
                                <p class="card-text"><small class="text-muted">Anggota Sejak: <?= date(' d F Y', $user['date_created_user']); ?></small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg">
            <div class="card">
                <div class="card-header">
                    Data Diri
                </div>
                <form action="<?= base_url('user/updateDataDiri') ?>" method="POST">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>NIK</label>
                                    <input type="number" class="form-control" name="nik" placeholder="NIK kamu" value="<?= $dataDiri['nik']; ?>">
                                    <?= form_error('nik', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Penghasilan Perbulan</label>
                                    <input type="number" class="form-control" name="penghasilan_perbulan" placeholder="Penghasilan per bulan" value="<?= $dataDiri['penghasilan_perbulan']; ?>">
                                    <?= form_error('penghasilan_perbulan', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Nomor WA</label>
                                    <input type="text" class="form-control" name="no_wa" placeholder="Nomor WA kamu" value="<?= $dataDiri['nomor_wa']; ?>">
                                    <?= form_error('no_wa', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="form-group">
                                    <label>Alamat Rumah</label>
                                    <textarea name="alamat" cols="30" rows="8" class="form-control" placeholder="Alamat rumah"><?= $dataDiri['alamat'] ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Simpan Data Diri</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
</div>