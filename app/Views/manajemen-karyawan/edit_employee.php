<?= $this->extend('dashboard/templates/main'); ?>

<?= $this->section('content'); ?>
    <div class="mt-4">
        <hr />
        <div class="d-flex flex-row justify-content-center mb-2">
          <h1 class="fw-semibold">EDIT PENGGUNA</h1>
        </div>
        <hr />
        </div>
        <div class="p-2 mx-5 my-2">
            <div class="row g-3 mx-3">
            <div class="col-8">
        <form action="<?= base_url('employee/save') ?>" enctype="multipart&#x2F;form-data" method="POST" accept-charset="utf-8" id="create-form">
                <input type="hidden" name="id_karyawan" value="<?= isset($list['id_karyawan']) ? $list['id_karyawan'] : '' ?>">
                <input type="hidden" value="<?= (old('foto_karyawan')) ? old('foto_karyawan') : $list['foto_karyawan']; ?>" name="oldGambar">
                <label for="inputAddress2" class="form-label control-label">Informasi Account : </label>
                <input class="form-control" type="text" id="disabledInput" type="text" placeholder="Username : <?= $list['username']; ?> || Role : <?= $list['role']; ?>" disabled>
            </div>
                <input type="hidden" value="<?= $list['username']; ?>" name="username">
                <input type="hidden" value="<?= $list['email']; ?>" name="email">
                <input type="hidden" value="<?= $list['password']; ?>" name="password">
                <input type="hidden" value="<?= $list['role']; ?>" name="role">
            </div>

            <div class="row g-3 mx-3 mt-1">
            <div class="col-8">
                <label for="foto_karyawan" class="form-label">Foto Karyawan</label>
                <img src="/img/employee/<?= old('foto_karyawan') ? old('foto_karyawan') : $list['foto_karyawan']; ?>" alt="" class="img-preview d-block my-3" width="200" height="200">
                <input type="file" class="form-control" name="foto_karyawan" id="foto_karyawan">
            </div>  
            </div>

            <div class="row g-3 mx-3 mb-3 mt-1">
            <div class="col-8">
                <label for="inputAddress2" class="form-label control-label">Nama Karyawan : </label>
                <input type="text" autofocus class="form-control form-control-border" id="nama_karyawan" name="nama_karyawan" value="<?= isset($list['nama_karyawan']) ? $list['nama_karyawan'] : '' ?>" required="required" placeholder="Nama Karyawan">
            </div>
            </div>

            <div class="row g-3 mx-3 mb-1">
            <div class="col-6">
                <label for="inputAddress2" class="form-label control-label">No Telp :</label>
                <input type="text" autofocus class="form-control form-control-border" id="no_tlp" name="no_tlp" value="<?= isset($list['no_tlp']) ? $list['no_tlp'] : '' ?>" required="required" placeholder="Nomor Telphone">
            </div>
            <div class="col-6">
                <div class="input-group mt-2">
                <span class="input-group-text">Alamat : </span>
                <textarea class="form-control" name="alamat" aria-label="With textarea"><?= !empty(isset($list['alamat'])) ? $list['alamat'] : '' ?></textarea>
                </div>
            </div>
            </div>

            <div class="row g-3 mx-3 mb-1">
            <div class="col-12">
                <label for="jenis_kelamin" class="control-label">jenis_kelamin : </label>
                <div class="form-group radio">
                <label class="form-check-label">
                <input class="form-check-input" name="jenis_kelamin" type="radio" id="jenis_kelamin" value="Laki-Laki" <?= !empty(isset($list['jenis_kelamin'])) && isset($list['jenis_kelamin']) == 'Laki-Laki' ? 'checked' : '' ?>>
                    Laki - Laki 
                <label>
            
                <label class="form-check-label ms-3">
                <input class="form-check-input" name="jenis_kelamin" type="radio" id="jenis_kelamin" value="Perempuan" <?= !empty(isset($list['jenis_kelamin'])) && isset($list['jenis_kelamin']) == 'Perempuan' ? 'checked' : '' ?>>
                    Perempuan 
                </label>
            </div>
            </div>
        </div>
            
        <div class="d-flex justify-content-end">
            <div class="mx-3 d-flex justify-content-center">
                <div class="text-start g-3">
                  <button class="btn btn-success" form="create-form" type="submit">
                      <i class="fa fa-save"></i> Submit
                  </button>
                  </button>
                      <a class="btn btn-danger me-2" href="<?= base_url('employee/index') ?>"><i class="fa fa-times"></i> Cancel</a>
                </div>
            </div>
        </div>
        </form>
    </div>

    <script>
    // Image Preview
    const img_preview = document.querySelector(".img-preview");
    const input_img = document.getElementById("foto_karyawan");
    input_img.addEventListener("change", function(e) {
        img_preview.src = URL.createObjectURL(this.files[0]);
        img_preview.classList.remove("d-none");
    });

    function checkFunction() {
    var x = document.getElementById("passInput");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
    }
    </script>

<?= $this->endSection(); ?>