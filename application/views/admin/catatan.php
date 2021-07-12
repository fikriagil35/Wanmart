<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Buku Hutang</h1>
    <div class="row">

        <div class="col-sm-7 offset-md-1">
            <div class="card">
                <div class="card-body">
                    <?= $this->session->flashdata('message'); ?>
                    <h5 class="card-title">Catatan Hutang Baru</h5>
                    <form action="<?= base_url('admin/catatan'); ?>" method="POST">
                        <div class="form-group">
                            <label for="nama">Masukkan Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" aria-describedby="emailHelp">

                        </div>
                        <div class="form-group">
                            <label for="nama">Masukkan Jumlah Hutang </label>
                            <input type="number" class="form-control" id="hutang" name="hutang" aria-describedby="emailHelp">

                        </div>
                        <div class="form-group">
                            <label for="nama">Tenggat Hutang</label>
                            <input type="date" class="form-control" id="hutang" name="tenggat_hutang" aria-describedby="emailHelp">

                        </div>

                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Buat Catatan Baru
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>