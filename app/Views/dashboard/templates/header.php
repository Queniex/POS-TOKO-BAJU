<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="/">POS - TOKO BAJU [👗👖]</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <?php if($menu == 'product-list' || $menu == 'product-add') {
    $link = '/product';
  } else if ($menu == 'employee-list' || $menu == 'employee-add') {
    $link = '/employee';
  } else {
    $link = '/pos';
  }; ?>

  <form class="d-flex w-100" role="search" action="<?= $link; ?>" method="GET">
      <input class="form-control form-control-dark w-100 rounded-0 border-0 bg-light" type="search" placeholder="Masukkan kata pencarian..." aria-label="Search" name="keyword" value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
      <button class="btn btn-outline-success me-2" type="submit">Search</button>
  </form>
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <form action="/logout" method="post">
        <!-- @csrf -->
        <button class="nav-link px-3 bg-dark border-0">Logout <span data-feather="log-out" class="align-text-bottom"></span></button>
      </form>
    </div>
  </div>
</header>