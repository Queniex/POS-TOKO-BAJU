    <?= $this->extend('dashboard/templates/main'); ?>

    <?= $this->section('content'); ?>

        <div class="mt-4">
            <hr />
            <div class="d-flex flex-row mb-2">
              <h3 class="fw-semibold">TAMBAH BARANG</h3>
              <?= $validation->listErrors(); ?>
            </div>
            <hr />
            </div>
            <div class="border border-dark">
            <form action="<?= base_url('product/save') ?>" method="POST" id="create-form" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="id_barang">
                <div class="row g-3 m-3">
                <div class="col">
                    <label for="inputAddress2" class="form-label control-label">Nama Barang</label>
                    <input type="text" autofocus class="form-control form-control-border <?= ($validation->hasError('nama_barang')) ? 'is-invalid' : ''; ?>" id="nama_barang" name="nama_barang" value="<?= !empty($request->getPost('nama_barang')) ? $request->getPost('nama_barang') : '' ?>" placeholder="Nama Barang" required>
                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                        <?= $validation->getError('nama_barang'); ?>
                    </div>
                </div>
                <div class="col">
                    <label for="inputAddress2" class="form-label control-label">Jenis Barang</label>
                    <select name="id_jenis" id="id_jenis" class="form-select form-select-border" required>
                        <option value="">Pilih Jenis Barang</option>
                            <?php foreach ($jb as $row => $value) { ?>
                                <option <?= !empty($request->getPost('jb')) && $request->getPost('jb') == $value->id_jenis ? 'selected' : '' ?> value="<?= $value->id_jenis ?>"><?= $value->jenis_barang; ?></option>
                            <?php } ?>   
                    </select>
                </div>
                <div class="col">
                    <label for="inputAddress2" class="form-label control-label">Ukuran Barang</label>
                    <select name="ukuran_barang" id="ukuran_barang" class="form-select form-select-border" required>
                        <option value="">Pilih Ukuran Barang</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="XL">XL</option>
                        <option value="XXL">XXL</option>
                    </select>
                </div>
                </div>

                <div class="row g-3 mx-3 mb-3">
                <div class="col">
                    <label for="inputAddress2" class="form-label control-label">Jumlah Barang</label>
                    <input type="text" autofocus class="form-control form-control-border" id="kuantitas" name="kuantitas" value="<?= !empty($request->getPost('kuantitas')) ? $request->getPost('kuantitas') : '' ?>" required="required" placeholder="Jumlah Barang">
                </div>
                <div class="col">
                    <label for="inputAddress2" class="form-label control-label">Harga Barang</label>
                    <input type="text" autofocus class="form-control form-control-border" id="harga_per_satuan" name="harga_per_satuan" value="<?= !empty($request->getPost('harga_per_satuan')) ? $request->getPost('harga_per_satuan') : '' ?>" required="required" placeholder="Harga Barang">
                </div>
                </div>

                <!-- <div class="row g-3 mx-3 mb-3">
                <div class="col-6">
                    <div class="custom-file">
                        <input class="costum-file-input type="file" id="foto_gambar" name="foto_gambar">
                        <label for="foto_gambar" class="custom-file-label control-label">Foto Barang</label>
                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                        </div>
                    </div>            
                </div>
                </div> -->

                <div class="row g-3 mx-3 mb-3">
                <div class="col-6">
                    <label for="inputAddress2" class="form-label control-label">Foto Barang</label>
                    <input type="text" autofocus class="form-control form-control-border" id="foto_barang" name="foto_barang" value="<?= !empty($request->getPost('foto_barang')) ? $request->getPost('foto_barang') : '' ?>" required="required" placeholder="Harga Barang"> 
                </div>
                </div>
                
                <div class="text-center my-5">
                <button class="btn btn-dark" form="create-form" type="submit">
                    <i class="fa fa-save"></i> Save Details
                </button>
                <button class="btn btn-secondary" form="create-form" type="reset">
                    <i class="fa fa-times"></i> Reset
                </button>
                </div>
        </div>

    <?= $this->endSection(); ?>