<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Fitur Pesan</h1>

    <?php
    if ($this->session->flashdata('sukses')) {
    ?>
        <div class="alert alert-success" role="alert">
            <?= $this->session->flashdata('sukses') ?>
        </div>
    <?php } ?>

    <?php
    if ($this->session->flashdata('eror')) {
    ?>
        <div class="alert alert-danger" role="alert">
            <?= $this->session->flashdata('eror') ?>
        </div>
    <?php } ?>


    <div class="row">
        <div class="col-lg">
            <div class="card shadow mb-4">

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabel-data-hutang" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">Pesan Kamu</th>
                                    <th scope="col">Balasan dari Admin</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($pesan as $dh) : ?>
                                    <tr>
                                        <td><?= $dh['pesan']; ?></td>
                                        <td><?= $dh['balasan']; ?></td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-10">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahKomentar">Buat Pesan</button>
    </div>


</div>
<!-- /.container-fluid -->

<div class="modal fade" id="tambahKomentar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url('user/kirim_pesan'); ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="pesan">Masukkan Pesan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pesan" name="pesan" />
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit">Kirim</button>
                    </div>
                </div>
        </form>
    </div>
</div>

</div>
<!-- End of Main Content -->

<!-- ?php foreach ($datauser as $us) : ?>
    <div class="modal fade" id="hapususer<?= $us['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="hapususerLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapususerLabel">Yakin ingin hapus?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Hapus" jika ingin menghapus.</div>
                <div class="modal-body">
                    Mau hapus <?= $us['name']; ?>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-success" href="<?= base_url('admin/hapususer/'); ?><?= $us['id']; ?>">Hapus</a>
                </div>
            </div>
        </div>
    </div>
?php endforeach; ?> -->