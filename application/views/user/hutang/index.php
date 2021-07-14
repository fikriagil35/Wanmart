<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="card shadow mb-4">
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
                                <td><?= $ha['jumlah_hutang'] ?></td>
                                <td><?= $ha['status'] ?></td>
                                <td><?= $ha['tanggal_hutang'] ?></td>
                                <td><?= $ha['tenggat_waktu_hutang'] ?></td>
                                <td>
                                    <a href="<?= base_url('user/hutang/' . $ha['id_hutang']) ?>" class="btn btn-success">Detail</a>
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
                                <td><?= $hl['jumlah_hutang'] ?></td>
                                <td><?= $hl['status'] ?></td>
                                <td><?= $hl['tanggal_hutang'] ?></td>
                                <td><?= $hl['tenggat_waktu_hutang'] ?></td>
                                <td>
                                    <a href="<?= base_url('user/hutang/' . $hl['id_hutang']) ?>" class="btn btn-success">Detail</a>
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
