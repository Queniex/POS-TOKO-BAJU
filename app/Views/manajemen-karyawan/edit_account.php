<?= $this->extend('dashboard/templates/main'); ?>

<?= $this->section('content'); ?>

        <div class="mt-4">
            <hr />
            <div class="d-flex flex-row justify-content-center mb-2">
              <h1 class="fw-semibold">EDIT PENGGUNA</h1>
            </div>
            <hr />
          </div>
          <div class="d-flex justify-content-center">
            <div class="p-2 mx-2 my-2">
              <form action="<?= base_url('employee/next') ?>" enctype="multipart&#x2F;form-data" method="POST" accept-charset="utf-8" id="create-form">
                <input type="hidden" name="id" value="<?= isset($data['id']) ? $data['id'] : '' ?>">
                <div class="row g-3 m-3">
                <div class="col-12">
                    <label for="inputAddress2" class="form-label control-label">Username :</label>
                    <input type="text" autofocus class="form-control form-control-border" id="username" name="username" value="<?= isset($data['username']) ? $data['username'] : '' ?>" placeholder="Username" required disabled>
                </div>    
                </div>
  
                <div class="row g-3 mx-3 mb-3">
                <div class="col-12">
                    <label for="inputAddress2" class="form-label control-label">Password :</label>
                    <input type="password" autofocus class="form-control form-control-border" id="passInput" name="password" value="<?= isset($data['password']) ? $data['password'] : '' ?>" required="required" placeholder="Password" disabled>
                </div>
                </div>
  
                <div class="row g-3 mx-3 mb-3">
                  <div class="col-12">
                      <label for="inputAddress2" class="form-label control-label">Email :</label>
                      <input type="email" autofocus class="form-control form-control-border" id="email" name="email" value="<?= isset($data['email']) ? $data['email'] : '' ?>" required="required" placeholder="Email" disabled>
                  </div>
                  <div class="col-12">
                    <label for="role" class="control-label">Role : </label>
                      <div class="form-group radio">
                    <label class="form-check-label">
                      <input class="form-check-input" name="role" type="radio" id="role" value="admin" <?= !empty(isset($data['role'])) && isset($data['role']) == 'admin' ? 'checked' : '' ?> disabled>
                        ADMIN 
                    <label>
                
                    <label class="form-check-label ms-3">
                      <input class="form-check-input" name="role" type="radio" id="role" value="kasir" <?= !empty(isset($data['role'])) && isset($data['role']) == 'kasir' ? 'checked' : '' ?> disabled>
                        KASIR 
                    </label>
                  </div>
                </div>
                </div>
                
                <div class="d-flex justify-content-end">
                  <div class="mx-3 d-flex justify-content-center">
                    <div class="text-start g-3">
                      <button type="submit" class="btn btn-dark"  form="create-form">
                      <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Next
                      </a>
                      </button>
                          <a class="btn btn-danger" href="<?= base_url('employee/index') ?>"><i class="fa fa-times"></i> Cancel</a>
                      </div>
                  </div>
                </div>
              </form>
            </div>
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