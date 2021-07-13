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
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($dataPenghutang as $dp) :
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $dp['name']; ?></td>
                                <td><?= $dp['email']; ?></td>
                                <td class="text-right">
                                    <div class="btn-group" role="group" aria-label="Aksi">
                                        <a href="<?= base_url('admin/penghutang/' . $dp['id']) ?>" class="btn btn-primary">Detail</a>
                                        <button type="button" class="btn btn-danger">Hapus</button>
                                    </div>
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