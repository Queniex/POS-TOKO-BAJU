<?= $this->extend('dashboard/templates/main'); ?>

<?= $this->section('content'); ?>

<div class="container d-flex justify-content-center mt-5">
  <div class="row mt-5"> 
    <div class="d-flex justify-content-center">
      <h1 class="my-4">Selamat datang, <span class="text-decoration-underline">
        <?= $user['nama_karyawan']; ?> - <?= ucfirst(session()->get('logged_in')['role']); ?>
        <img class="ms-2 mb-2" src="img/dashboard/hello.gif" width="50" height="50" alt="">
      </span></h1>
    </div>

    <!-- Grafik data -->
    <div class="col">
      <div class="row">
        <div class="d-flex justify-content-center">

        <div class="col-md-3 me-2">
          <a href="<?= base_url('/product/index'); ?>" class="text-decoration-none">
            <div class="card mb-3 text-white bg-dark rounded-3" >
              <div class="card-header fs-5 bold">Produk Tersedia</div>
              <div class="card-body">
                <h5 class="card-title"><?= $count_products; ?></h5>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-3 ms-2 me-2">
          <a href="<?= base_url('/employee/index'); ?>" class="text-decoration-none">
            <div class="card text-white mb-3 bg-dark rounded-3" >
              <div class="card-header fs-5 bold">Karyawan</div>
              <div class="card-body">
                <h5 class="card-title"><?= $count_employees; ?></h5>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-3 ms-2">
          <a href="<?= base_url('/product/index'); ?>" class="text-decoration-none">
            <div class="card mb-3 text-white bg-dark rounded-3" >
              <div class="card-header fs-5 bold">Transaksi</div>
              <div class="card-body">
                <h5 class="card-title"><?= $count_products; ?></h5>
              </div>
            </div>
          </a>
        </div>

        </div>
        
      </div>
    </div>
  </div>
</div>


<script>
  $(function() {
    <?php if (session()->has("not_admin")) : ?>
      Swal.fire({
        icon: 'warning',
        title: 'Peringatan!',
        text: '<?= session("not_admin") ?>'
      })
    <?php endif; ?>
  });
</script>
<?= $this->endSection(); ?>