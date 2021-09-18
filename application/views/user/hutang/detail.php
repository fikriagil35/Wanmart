<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <?= $this->session->flashdata('message'); ?>

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

        if ($hutang['status_hutang'] != "Lunas") {
        ?>
            <div class="card-header">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bayarModal">Bayar</button>
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
                            <th scope="col">Status Pembayaran</th>
                            <th scope="col" class="text-center">Opsi</th>
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
                                <td><?= $dh['status_pembayaran'] ?></td>
                                <?php if ($dh['status_pembayaran'] == "Terverifikasi") {
                                    echo "<td class='text-center'> - <?td>";
                                } else { ?>
                                    <td class="text-right">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#ubahBayarModal-<?= $dh['id_detail_hutang'] ?>">Perbarui</button>
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

<div class="modal fade" tabindex="-1" id="bayarModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bayar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('user/simpanPembayaran') ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_hutang" value="<?= $hutang['id_hutang'] ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Bank Pengirim</label>
                        <select class="form-control" name="bank_pengirim" id="listBankTambahData"></select>
                    </div>
                    <div class="form-group">
                        <label>Nama Pemilik Rekening</label>
                        <input type="text" class="form-control" name="nama_pengirim">
                    </div>
                    <div class="form-group">
                        <label>No Rekening</label>
                        <input type="number" class="form-control" name="nomor_rekening">
                    </div>
                    <div class="form-group">
                        <label>Bank Tujuan</label>
                        <select class="form-control" name="id_bank">
                            <?php foreach ($databank as $db) : ?>
                                <option value="<?= $db['id_bank'] ?>"><?= $db['nama_bank'] ?>(<?= $db['rekening_bank'] ?>) a/n <?= $db['nama_pemilik_bank'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Bukti Pembayaran</label>
                        <input type="file" name="foto" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label>Total Dibayarkan</label>
                        <input type="number" class="form-control" name="total_bayar">
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
                <form action="<?= base_url('user/ubahPembayaran') ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_detail_hutang" value="<?= $detail['id_detail_hutang'] ?>">
                    <input type="hidden" name="id_hutang" value="<?= $detail['id_hutang'] ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Bank Pengirim</label>
                            <select class="form-control" name="bank_pengirim" id="listBankUbahData">
                                <option value="<?= $detail['bank_pengirim'] ?>"><?= $detail['bank_pengirim'] ?></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Pemilik Rekening</label>
                            <input type="text" class="form-control" name="nama_pengirim" value="<?= $detail['nama_pengirim'] ?>">
                        </div>
                        <div class="form-group">
                            <label>No Rekening</label>
                            <input type="number" class="form-control" name="nomor_rekening" value="<?= $detail['nomor_rekening'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Bank Tujuan</label>
                            <select class="form-control" name="id_bank">
                                <?php foreach ($databank as $db) : ?>
                                    <option value="<?= $db['id_bank'] ?>" <?php if ($detail['id_bank'] == $db['id_bank']) { echo 'selected';} ?>><?= $db['nama_bank'] ?>(<?= $db['rekening_bank'] ?>) a/n <?= $db['nama_pemilik_bank'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Bukti Pembayaran <br/>
                                <small><code>Pilih foto jika ingin mengubah bukti pembayaran.</code></small>
                            </label>
                            <input type="file" name="foto" class="form-control-file">
                        </div>
                        <div class="form-group">
                            <label>Total Dibayarkan</label>
                            <input type="number" class="form-control" name="total_bayar" value="<?= $detail['total_bayar_hutang'] ?>">
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

<script>
    let dataBank
    listBankTambahData = document.getElementById("listBankTambahData")
    listBankUbahData = document.querySelectorAll("#listBankUbahData")
    listBankUbahDataArray = [...listBankUbahData]

    fetch("<?= base_url('assets/bank.json') ?>")
        .then(res => res.json())
        .then(data => {
            const panjangData = data.length

            for (let i = 0; i < panjangData; i++) {
                let option = document.createElement("option");
                option.text = data[i].name;
                option.value = data[i].name;
                listBankTambahData.appendChild(option)
            }

            listBankUbahDataArray.forEach(sel => {
                for (let i = 0; i < panjangData; i++) {
                    let option = document.createElement("option");
                    option.text = data[i].name;
                    option.value = data[i].name;
                    sel.appendChild(option)
                }
            })
        })
        .catch(err => {
            console.log(err)
            console.error("Error load bank!")
        })
</script>