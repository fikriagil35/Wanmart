<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <table class="table table-striped">
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
                    <td><?php echo $hutang['jumlah_hutang']; ?></td>
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
                    <td><?php echo $hutang['status']; ?></td>
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
                                <td><?= $dh['total_bayar'] ?></td>
                                <td><?= $dh['tanggal_bayar'] ?></td>
                                <td class="text-right">
                                    <a href="<?= base_url('admin/hapus_detail_hutang/' . $dh['id_detail_hutang']) ?>" onclick="return confirm('Apakah kamu yakin ingin menghapus?');" class="btn btn-danger">Hapus</a>
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
