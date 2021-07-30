<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <?= $this->session->flashdata('message'); ?>

    <div class="card shadow mb-4">
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <th width="30%"><strong>Nama</strong></th>
                    <td><?php echo $hutang['name_user']; ?></td>
                </tr>
                <tr>
                    <th width="30%"><strong>Email</strong></th>
                    <td><?php echo $hutang['email_user']; ?></td>
                </tr>
                <tr>
                    <th width="30%"><strong>Nama</strong></th>
                    <td><?php echo $hutang['nama_hutang']; ?></td>
                </tr>
                <tr>
                    <th width="30%"><strong>Keterangan</strong></th>
                    <td><?php echo $hutang['keterangan_hutang']; ?></td>
                </tr>
                <tr>
                    <th width="30%"><strong>Jumlah</strong></th>
                    <td>Rp<?php echo $hutang['jumlah_hutang']; ?>-,</td>
                </tr>
                <tr>
                    <th width="30%"><strong>Tanggal</strong></th>
                    <td><?php echo $hutang['tanggal_hutang']; ?></td>
                </tr>
                <tr>
                    <th width="30%"><strong>Tenggat Waktu</strong></th>
                    <td><?php echo $hutang['tenggat_waktu_hutang']; ?></td>
                </tr>
                <tr>
                    <th width="30%"><strong>Status</strong></th>
                    <td><?php echo $hutang['status_hutang']; ?></td>
                </tr>
            </table>
        </div>
    </div>

    <h1 class="h3 mb-4 text-gray-800">Riwayat Bayar Hutang</h1>

    <div class="card shadow mb-4">
        <?php
        // Tampilkan tombol tambah bayar jika hutang belum lunas
        if ($hutang['status_hutang'] != "Lunas") {
        ?>
            <div class="card-header">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">Tambah Bayar</button>
            </div>
        <?php } ?>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tabel-data-hutang" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Total</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;

                        foreach ($detailHutang as $dh) :
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>Rp<?= $dh['total_bayar_hutang'] ?>-,</td>
                                <td><?= $dh['tanggal_bayar_hutang'] ?></td>
                                <td class="text-right">
                                    <?php
                                    // Tampilkan tombol tambah bayar jika hutang belum lunas
                                    if ($hutang['status_hutang'] != "Lunas") {
                                    ?>
                                        <a href="<?= base_url('admin/hapus_detail_hutang/' . $dh['id_detail_hutang']) ?>" onclick="return confirm('Apakah kamu yakin ingin menghapus?');" class="btn btn-danger">Hapus</a>
                                    <?php } else { ?>
                                        <button type="button" class="btn btn-danger" disabled>Hapus</button>
                                    <?php } ?>

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
                <h5 class="modal-title">Tambah Bayar Hutang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/tambahDetailHutang'); ?>" method="POST">
                <input type="hidden" name="id_hutang" value="<?= $hutang['id_hutang'] ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Total Bayar</label>
                        <input type="text" class="form-control" name="total_bayar">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Bayar</label>
                        <input type="date" class="form-control" name="tanggal_bayar">
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