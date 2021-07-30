<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <?= $this->session->flashdata('message'); ?>

    <div class="card shadow mb-4">
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <th width="30%"><strong>Nama</strong></th>
                    <td><?php echo $dataPenghutang['name_user']; ?></td>
                </tr>
                <tr>
                    <th width="30%"><strong>Email</strong></th>
                    <td><?php echo $dataPenghutang['email_user']; ?></td>
                </tr>
            </table>
        </div>
    </div>

    <h1 class="h3 mb-4 text-gray-800">Hutang Aktif</h1>

    <div class="card shadow mb-4">
        <div class="card-header">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">Tambah Data</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tabel-data-hutang" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Hutang</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Status</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Tenggat Waktu</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;

                        foreach ($hutangAktif as $ha) :
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $ha['nama_hutang'] ?></td>
                                <td><?= $ha['keterangan_hutang'] ?></td>
                                <td>Rp<?= $ha['jumlah_hutang'] ?>-,</td>
                                <td><?= $ha['status_hutang'] ?></td>
                                <td><?= $ha['tanggal_hutang'] ?></td>
                                <td><?= $ha['tenggat_waktu_hutang'] ?></td>
                                <td>
                                    <a href="<?= base_url('admin/detailHutang/' . $ha['id_hutang']) ?>" class="btn btn-success">Detail</a>
                                    <a href="<?= base_url('admin/hapusHutang/' . $ha['id_hutang']) ?>" onclick="return confirm('Apakah kamu yakin ingin menghapus?');" class="btn btn-danger">Hapus</a>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <h1 class="h3 mb-4 text-gray-800">Hutang Lunas</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tabel-hutang-lunas" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Hutang</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Status</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Tenggat Waktu</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;

                        foreach ($hutangLunas as $hl) :
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $hl['nama_hutang'] ?></td>
                                <td><?= $hl['keterangan_hutang'] ?></td>
                                <td>Rp<?= $hl['jumlah_hutang'] ?>-,</td>
                                <td><?= $hl['status_hutang'] ?></td>
                                <td><?= $hl['tanggal_hutang'] ?></td>
                                <td><?= $hl['tenggat_waktu_hutang'] ?></td>
                                <td>
                                    <a href="<?= base_url('admin/detailHutang/' . $hl['id_hutang']) ?>" class="btn btn-success">Detail</a>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


<div class="modal fade" id="tambahModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Hutang Aktif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/tambahHutang'); ?>" method="POST">
                <input type="hidden" name="id_user" value="<?= $dataPenghutang['id_user'] ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Hutang</label>
                        <input type="text" class="form-control" name="nama_hutang">
                    </div>
                    <div class="form-group">
                        <label>Keterangan Hutang</label>
                        <textarea name="keterangan_hutang" class="form-control" cols="30" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Hutang</label>
                        <input type="number" class="form-control" name="jumlah_hutang">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Hutang</label>
                        <input type="date" class="form-control" name="tanggal_hutang">
                    </div>
                    <div class="form-group">
                        <label>Tenggat Waktu Hutang</label>
                        <input type="date" class="form-control" name="tenggat_waktu_hutang">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>