<?= $this->extend('dashboard/templates/main'); ?>

<?= $this->section('content'); ?>

        <div class="mt-4">
            <hr />
            <div class="d-flex flex-row justify-content-center mb-2">
              <h1 class="fw-semibold">TAMBAH PENGGUNA</h1>
            </div>
            <hr />
          </div>
          <div class="d-flex justify-content-center">
            <div class="p-2 mx-2 my-2">
            <?php $validation->listErrors(); ?>
              <form action="<?= base_url('employee/next') ?>" enctype="multipart&#x2F;form-data" method="POST" accept-charset="utf-8" id="create-form">
              <?php $validation->listErrors(); ?>
              
                <div class="row g-3 m-3">
                <div class="col-12">
                    <label for="inputAddress2" class="form-label control-label">Username :</label>
                    <input type="text" autofocus class="form-control form-control-border <?= (validation_show_error('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" value="" placeholder="Username">
                    <div class="invalid-feedback">
                      <?= validation_show_error('username'); ?>
                    </div>
                </div>    
                </div>
  
                <div class="row g-3 mx-3 mb-3">
                <div class="col-12">
                    <label for="inputAddress2" class="form-label control-label">Password :</label>
                    <input type="password" autofocus class="form-control form-control-border <?= (validation_show_error('password')) ? 'is-invalid' : ''; ?>" id="passInput" name="password" value="" placeholder="Password">
                    <div class="invalid-feedback">
                      <?= validation_show_error('password'); ?>
                    </div>
                    <div class="form-check form-switch">
                      <input class="form-check-input" onclick="checkFunction()" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                      <label class="form-check-label" for="flexSwitchCheckDefault">Show Password</label>
                    </div>
                </div>
                </div>
  
                <div class="row g-3 mx-3 mb-3">
                  <div class="col-12">
                      <label for="inputAddress2" class="form-label control-label">Email :</label>
                      <input type="email" autofocus class="form-control form-control-border <?= (validation_show_error('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" value="" placeholder="Email">
                      <div class="invalid-feedback">
                        <?= validation_show_error('email'); ?>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <label for="status" class="control-label">Role : </label>
                      <div class="form-group radio">
                          <label class="form-check-label me-3">
                            <input class="form-check-input" name="role" type="checkbox" id="admin" value="admin" <?= !empty($request->getPost('role')) && $request->getPost('role') == 'admin' ? 'checked' : '' ?> >
                            ADMIN
                          </label>
                    
                          <label class="form-check-label">
                            <input class="form-check-input" name="role" type="checkbox" id="kasir" value="kasir" <?= !empty($request->getPost('role')) && $request->getPost('role') == 'kasir' ? 'checked' : '' ?> >
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