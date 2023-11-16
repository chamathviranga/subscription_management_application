<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Subscription Manager</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('/plugins/fontawesome-free/css/all.min.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('/dist/css/adminlte.min.css'); ?>">

  <link rel="stylesheet" href="<?= base_url('/plugins/sweetalert2/sweetalert2.min.css'); ?>">
</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <?= view('includes/navbar.inc.php') ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?= view('includes/side.inc.php') ?>

    <!-- Content Wrapper. Contains page content -->
    <?= $this->renderSection('content') ?>
    <!-- /.content-wrapper -->

    <?= view('includes/footer.inc.php'); ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="<?= base_url('/plugins/jquery/jquery.min.js'); ?>"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url('/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('/dist/js/adminlte.min.js'); ?>"></script>
  <!-- AdminLTE for demo purposes -->
  <!-- <script src="<?= base_url('/dist/js/demo.js'); ?>"></script> -->

  <script src="<?= base_url('/plugins/sweetalert2/sweetalert2.min.js'); ?>"></script>

  <?= $this->renderSection('scripts') ?>

</body>

</html>