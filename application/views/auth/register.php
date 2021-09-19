<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-8 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Silahkan Membuat Akun Baru!</h1>
                        </div>
                        <form class="user" method="post" action="<?= base_url('auth/register'); ?>">
                            <div class="form-group">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nama Panjang" value="<?= set_value('name'); ?>">
                                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email Kamu" value="<?= set_value('email'); ?>">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control" id="password1" name="password1" placeholder="Masukkan Password"> <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" id="password2" name="password2" placeholder="Ulangi Password">
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <input type="number" class="form-control" name="nik" placeholder="NIK kamu" value="<?= set_value('nik'); ?>">
                                <?= form_error('nik', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" name="penghasilan_perbulan" placeholder="Penghasilan per bulan" value="<?= set_value('penghasilan_perbulan'); ?>">
                                <?= form_error('penghasilan_perbulan', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="no_wa" placeholder="Nomor WA kamu" value="<?= set_value('no_wa'); ?>">
                                <?= form_error('no_wa', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <textarea name="alamat" cols="30" rows="10" class="form-control" placeholder="Alamat rumah"><?= set_value('alamat'); ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-info btn-lg btn-block">
                                Registrasi Akun
                            </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('auth'); ?>">Sudah Punya Akun? Silahkan Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>