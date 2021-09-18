<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?= $this->session->flashdata('message'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="float-right">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">Tambah Data</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tabel-data-laundry" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Bank</th>
                            <th scope="col">Nama Pemilik</th>
                            <th scope="col">Nomor Rekening</th>
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($databank as $db) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $db['nama_bank']; ?></td>
                                <td><?= $db['nama_pemilik_bank']; ?></td>
                                <td><?= $db['rekening_bank']; ?></td>
                                <td class="text-right">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ubahModal-<?= $db['id_bank'] ?>">Ubah</button>
                                    <a href="<?= base_url('admin/hapusBank/') . $db['id_bank'] ?>" onclick="return confirm('Apakah kamu yakin ingin menghapus data ini?')" class="btn btn-danger">Hapus</a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Tambah Data -->
<div class="modal fade" tabindex="-1" id="tambahModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Bank</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/tambahBank') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Bank</label>
                        <select class="form-control" name="nama_bank" id="listBankTambahData"></select>
                    </div>
                    <div class="form-group">
                        <label>Pemilik</label>
                        <input type="text" class="form-control" name="nama_pemilik_bank">
                    </div>
                    <div class="form-group">
                        <label>No Rekening</label>
                        <input type="number" class="form-control" name="rekening_bank">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php foreach ($databank as $d) : ?>
    <div class="modal fade" tabindex="-1" id="ubahModal-<?= $d['id_bank'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Data Bank</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/ubahBank') ?>" method="POST">
                <input type="hidden" name="id" value="<?= $d['id_bank'] ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Bank</label>
                            <select class="form-control" name="nama_bank" id="listBankUbahData">
                                <option value="<?= $d['nama_bank'] ?>"><?= $d['nama_bank'] ?></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Pemilik</label>
                            <input type="text" class="form-control" name="nama_pemilik_bank" value="<?= $d['nama_pemilik_bank'] ?>">
                        </div>
                        <div class="form-group">
                            <label>No Rekening</label>
                            <input type="number" class="form-control" name="rekening_bank" value="<?= $d['rekening_bank'] ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

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