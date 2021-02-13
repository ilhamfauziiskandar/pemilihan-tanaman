  <?php $id_user = session()->get('id_user'); ?>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a href="<?= base_url('home')?>"class="nav-link"><h5><b>SPK Pemilihan Tanaman</b></h5></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= base_url('alternatif')?>" class="nav-link">Alternatif</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= base_url('kriteria')?>" class="nav-link">Kriteria</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= base_url('ranking')?>" class="nav-link">Ranking</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
        	<?= session()->get('nama_user'); ?>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" href="<?= base_url('login/logout') ?>">
          Logout
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Pages</li>
              <li class="breadcrumb-item"><?= $title ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-body">