<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-sm-6 offset-md-1">
            <?= $this->session->flashdata('message'); ?>

            <form action="<?= base_url('user/gantipassword'); ?>" method="post">
                <div class="form-group">
                    <label for="current_password">Password Saat Ini</label>
                    <input type="password" class="form-control" id="current_password" name="current_password">
                </div>
                <div class="form-group">
                    <label for="new_password1">Password Baru</label>
                    <input type="password" class="form-control" id="new_password1" name="new_password1">
                </div>
                <div class="form-group">
                    <label for="new_password2">Konfirmasi Password Baru</label>
                    <input type="password" class="form-control" id="new_password2" name="new_password2">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Ganti Password</button>
                </div>
            </form>

        </div>

    </div>


</div>
</div>
<!-- End of Main Content -->