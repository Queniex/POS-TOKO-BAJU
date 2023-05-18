<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="position-sticky pt-3 sidebar-sticky">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link <?= $menu == "overview" ? 'active' : ''; ?>" aria-current="page" href="<?= base_url('/dashboard'); ?>">
          <span data-feather="home" class="align-text-bottom"></span>
          Dashboard
        </a>
      </li>
    </ul>

    <!-- Manajemen Barang -->
    <ul class="nav flex-column">
      <h6 class="sidebar-heading text-muted d-flex flex-col justify-content-between align-items-center px-3 mt-4 fs-6 fw-bold">
        Manajemen Barang
      </h6>
      <li class="nav-item">
        <a class="nav-link <?= $menu == 'product-list' ? 'active' : ''; ?>" href="<?= base_url('/product/index'); ?>">
          <span data-feather="file-text" class="align-text-bottom"></span>
          Daftar Barang
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= $menu == "product-add" ? 'active' : ''; ?>" href="<?= base_url('/product/create'); ?>">
          <span data-feather="file-plus" class="align-text-bottom"></span>
          Tambah Barang
        </a>
      </li>
    </ul>

    <!-- Manajemen Pemesanan -->
    <ul class="nav flex-column">
      <h6 class="sidebar-heading text-muted d-flex flex-col justify-content-between align-items-center px-3 mt-4 fs-6 fw-bold">
        POS Manajemen
      </h6>
      <li class="nav-item">
        <a class="nav-link <?= $menu == 'pos-list' ? 'active' : ''; ?>" href="<?= base_url('/pos/index'); ?>">
          <span data-feather="file-text" class="align-text-bottom"></span>
          Daftar Transaksi
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= $menu == "pos-add" ? 'active' : ''; ?>" href="<?= base_url('/pos/add'); ?>">
          <span data-feather="file-plus" class="align-text-bottom"></span>
          Tambah Pemesanan
        </a>
      </li>
    </ul>

    <!-- Manajemen Karyawan -->
    <ul class="nav flex-column">
      <h6 class="sidebar-heading text-muted d-flex flex-col justify-content-between align-items-center px-3 mt-4 fs-6 fw-bold">
        Manajemen Karyawan
      </h6>
      <li class="nav-item">
        <a class="nav-link <?= $menu == "employee-list" ? 'active' : ''; ?>" href="<?= base_url('/employee/index'); ?>">
          <span data-feather="file-text" class="align-text-bottom"></span>
          Daftar Karyawan
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= $menu == "employee-add" ? 'active' : ''; ?>" href="<?= base_url('/employee/create'); ?>">
          <span data-feather="file-plus" class="align-text-bottom"></span>
          Tambah Karyawan
        </a>
      </li>
    </ul>
  </div>
</nav>