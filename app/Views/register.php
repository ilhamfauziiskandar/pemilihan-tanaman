<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $title ?> | SPK Pemilihan Tanaman</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url() ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="shortcut icon" type="image/png" href="<?= base_url('/leaf.png')?>"/>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
  	<H3>SPK PEMILIHAN TANAMAN</H3>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
    
      <H5 class="login-box-msg">Register Account</H5>
      <?php if(!empty(session()->getFlashData('warning'))) { ?>
      <div class="alert alert-warning alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <?php echo session()->getFlashData('warning'); ?>
      </div>  	
  	<?php } ?>

  	<?php if(!empty(session()->getFlashData('danger'))) { ?> 
  	<div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  		<?php echo session()->getFlashData('danger'); ?>
  	</div>
  	<?php } ?>

      <form action="<?= base_url('login/daftar') ?>" method="post">
      <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama" required="">
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="username" required="">
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" required="">
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password1" required="">
        </div>
        <div class="row">
          <div class="col-6">
          	<a href="<?= base_url('login'); ?>" class="text-center">Back</a>
          </div>
          <!-- /.col -->
          <div class="col-6">
            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <BR>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>/dist/js/adminlte.min.js"></script>

</body>
</html>
