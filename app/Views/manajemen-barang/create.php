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
            <form action="<?= base_url('product/save') ?>" enctype="multipart&#x2F;form-data" method="POST" accept-charset="utf-8" id="create-form">
                <?= csrf_field(); ?>
                <div class="row g-3 m-3">
                <div class="col">
                    <label for="inputAddress2" class="form-label control-label">Nama Barang</label>
                    <input type="text" autofocus class="form-control form-control-border <?= (validation_show_error('nama_barang')) ? 'is-invalid' : ''; ?>" id="nama_barang" name="nama_barang" value="<?= !empty($request->getPost('nama_barang')) ? $request->getPost('nama_barang') : '' ?>" placeholder="Nama Barang">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                        <?= validation_show_error('nama_barang'); ?>
                    </div>
                </div>
                <div class="col">
                    <label for="id_jenis" class="form-label control-label">Jenis Barang</label>
                    <select name="id_jenis" id="id_jenis" class="form-select form-select-border <?= (validation_show_error('jenis_barang')) ? 'is-invalid' : ''; ?>" required>
                        <option selected value="">Pilih Jenis Barang</option>
                            <?php foreach ($jb as $row => $value) { ?>
                                <option value="<?= $value->id_jenis ?>"><?= $value->jenis_barang; ?></option>
                            <?php } ?>   
                    </select>
                    <div class="invalid-feedback">
                        <?= validation_show_error('jenis_barang'); ?>
                    </div>
                </div>
                <div class="col">
                    <label for="inputAddress2" class="form-label control-label">Ukuran Barang</label>
                    <select name="ukuran_barang" id="ukuran_barang" class="form-select form-select-border <?= (validation_show_error('ukuran_barang')) ? 'is-invalid' : ''; ?>">
                        <option value="">Pilih Ukuran Barang</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="XL">XL</option>
                        <option value="XXL">XXL</option>
                    </select>
                    <div class="invalid-feedback">
                        <?= validation_show_error('ukuran_barang'); ?>
                    </div>
                </div>
                </div>

                <div class="row g-3 mx-3 mb-3">
                <div class="col">
                    <label for="inputAddress2" class="form-label control-label">Jumlah Barang</label>
                    <input type="number" autofocus class="form-control form-control-border <?= (validation_show_error('kuantitas')) ? 'is-invalid' : ''; ?>" id="kuantitas" name="kuantitas" value="<?= !empty($request->getPost('kuantitas')) ? $request->getPost('kuantitas') : '' ?>"  placeholder="Jumlah Barang">
                    <div class="invalid-feedback">
                        <?= validation_show_error('kuantitas'); ?>
                    </div>
                </div>
                <div class="col">
                    <label for="inputAddress2" class="form-label control-label">Harga Barang</label>
                    <input type="number" autofocus class="form-control form-control-border <?= (validation_show_error('harga_per_satuan')) ? 'is-invalid' : ''; ?>" id="harga_per_satuan" name="harga_per_satuan" value="<?= !empty($request->getPost('harga_per_satuan')) ? $request->getPost('harga_per_satuan') : '' ?>" placeholder="Harga Barang">
                    <div class="invalid-feedback">
                        <?= validation_show_error('harga_per_satuan'); ?>
                    </div>
                </div>
                </div>

                <div class="row m-3">
                    <div class="col-6">
                        <label for="foto_barang" class="form-label">Foto Barang</label>
                        <img src="<?= old('foto_barang'); ?>" alt="" class="img-preview d-block my-3 d-none" width="200" height="200">
                        <input type="file" class="form-control <?= (validation_show_error('foto_barang')) ? 'is-invalid' : ''; ?>" name="foto_barang" id="foto_barang">
                        <div class="invalid-feedback">
                            <?= validation_show_error('foto_barang'); ?>
                        </div>
                    </div>
                </div>
                
                <div class="text-center my-5">
                <button class="btn btn-dark" form="create-form" type="submit">
                    <i class="fa fa-save"></i> Tambah
                </button>
                </button>
                    <a class="btn btn-danger" href="<?= base_url('product/index') ?>"><i class="fa fa-times"></i> Cancel</a>
                </div>
                </div>
                </form>
        </div>

        <script>
        // Image Preview
        const img_preview = document.querySelector(".img-preview");
        const input_img = document.getElementById("foto_barang");
        input_img.addEventListener("change", function(e) {
            img_preview.src = URL.createObjectURL(this.files[0]);
            img_preview.classList.remove("d-none");
        });
        </script>

    <?= $this->endSection(); ?>