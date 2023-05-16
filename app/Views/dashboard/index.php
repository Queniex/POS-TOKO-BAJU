<?= $this->extend('dashboard/templates/main'); ?>

<?= $this->section('content'); ?>
<div class="row">
  <h1 class="my-4">Selamat datang, <?= $user['nama_karyawan']; ?> - <?= ucfirst(session()->get('logged_in')['role']); ?></h1>

  <!-- Grafik data -->
  <div class="col">
    <div class="row">
      <div class="col-md-3">
        <a href="<?= base_url('/product/index'); ?>" class="text-decoration-none">
          <div class="card mb-3 text-white bg-dark rounded-3" >
            <div class="card-header fs-5 bold">Produk Tersedia</div>
            <div class="card-body">
              <h5 class="card-title"><?= $count_products; ?></h5>
            </div>
          </div>
        </a>
      </div>
      <div class="col-md-3">
        <a href="<?= base_url('/employee/index'); ?>" class="text-decoration-none">
          <div class="card text-white mb-3 bg-dark rounded-3" >
            <div class="card-header fs-5 bold">Karyawan</div>
            <div class="card-body">
              <h5 class="card-title"><?= $count_employees; ?></h5>
            </div>
          </div>
        </a>
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