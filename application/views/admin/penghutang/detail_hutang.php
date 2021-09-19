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
                    <td>Rp. <?php echo $hutang['jumlah_hutang']; ?>-,</td>
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
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tabel-data-hutang" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Total</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Status Pembayaran</th>
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
                                <td>Rp. <?= number_format($dh['total_bayar_hutang']) ?>-,</td>
                                <td><?= $dh['tanggal_bayar_hutang'] ?></td>
                                <td><?= $dh['status_pembayaran'] ?></td>
                                <td class="text-right">
                                    <?php

                                    if ($hutang['status_hutang'] != "Lunas") {
                                    ?>
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#ubahBayarModal-<?= $dh['id_detail_hutang'] ?>">Perbarui</button>
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

<?php foreach ($detailHutang as $detail) : ?>
    <div class="modal fade" tabindex="-1" id="ubahBayarModal-<?= $detail['id_detail_hutang'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bayar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/perbaruiPembayaran') ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_detail_hutang" value="<?= $detail['id_detail_hutang'] ?>">
                    <input type="hidden" name="id_hutang" value="<?= $detail['id_hutang'] ?>">
                    <div class="modal-body">
                        <table class="table table-striped">
                            <tr>
                                <th width="30%"><strong>Nama Bank Pengirim</strong></th>
                                <td><?= $detail['bank_pengirim'] ?></td>
                            </tr>
                            <tr>
                                <th width="30%"><strong>Nama Pemilik Rekening</strong></th>
                                <td><?= $detail['nama_pengirim'] ?></td>
                            </tr>
                            <tr>
                                <th width="30%"><strong>No Rekening</strong></th>
                                <td><?= $detail['nomor_rekening'] ?></td>
                            </tr>
                            <tr>
                                <th width="30%"><strong>Bank Tujuan</strong></th>
                                <td>
                                    <?php foreach ($databank as $db) :
                                        if ($detail['id_bank'] == $db['id_bank']) {
                                            echo $db['nama_bank'] . "(" . $db['rekening_bank'] . ") a/n " . $db['nama_pemilik_bank'];
                                        }
                                    endforeach; ?>
                                </td>
                            </tr>
                            <tr>
                                <th width="30%"><strong>Total Pembayaran</strong></th>
                                <td>Rp. <?= number_format($detail['total_bayar_hutang']) ?></td>
                            </tr>
                        </table>

                        <div class="form-group">
                            <label>Bukti Pembayaran</label>
                            <img class="img-fluid rounded mx-auto d-block" src="<?= base_url('assets/img/bukti_pembayaran/') . $detail['foto_bukti_pembayaran'] ?>" alt="Bukti Pembayaran" width="100" height="100">
                        </div>

                        <div class="form-group">
                            <label>Status Pembayaran</label>
                            <select name="status_pembayaran" class="form-control">
                                <option value="Menunggu Verifikasi" <?php if ($detail['status_pembayaran'] == 'Menunggu Verifikasi') {
                                                                        echo 'selected';
                                                                    } ?>>Menunggu Verifikasi</option>
                                <option value="Terverifikasi" <?php if ($detail['status_pembayaran'] == 'Terverifikasi') {
                                                                    echo 'selected';
                                                                } ?>>Terverifikasi</option>
                                <option value="Tidak Valid" <?php if ($detail['status_pembayaran'] == 'Tidak Valid') {
                                                                echo 'selected';
                                                            } ?>>Tidak Valid</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach ?>