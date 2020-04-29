<?php
  require_once("../../root.php");
  require_once($root . "/includes/parametros.php");
  require_once($root . "/includes/conexao/conn.php");

  testSession();
  testHouseSession();

  include($root . "/dao/DaoComodo.php");

  $daoComodo = new DaoComodo();

  if (isset($_POST["nome"]) && isset($_POST["andar"])) {
    if ($daoComodo->salvarComodo($conn, $_POST)) {
      header("Location: comodos.php?success=1");
    }
  }
  
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $titulo ?></title>
  <link rel="shortcut icon" href="<?php echo $favicon ?>" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/smart_house/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="/smart_house/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/smart_house/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="/smart_house/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="/smart_house/plugins/jqvmap/jqvmap.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="/smart_house/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="/smart_house/plugins/toastr/toastr.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="/smart_house/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="/smart_house/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/smart_house/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/smart_house/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="/smart_house/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="/smart_house/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script>
  </script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <?php include_once($root . '/template/navbar.php') ?>
  <!-- /.navbar -->

  <!-- Sidebar -->
  <?php include_once($root . '/template/sidebar.php') ?>
  <!-- /.sidebar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Cômodos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Cômodos</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="d-flex justify-content-between">
                <h3 class="card-title">Cadastrar Cômodos</h3>
                <a type="button" href="comodos.php" class="btn btn-secondary btn-sm"><i class="fas fa-undo"></i></a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form role="form" id="quickForm" action="cadastrar_comodo.php" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-6">
                        <label for="nome">Nome *</label>
                        <input type="text" name="nome" class="form-control" id="nome" placeholder="Digite o nome">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="andar">Andar *</label>
                        <input type="number" name="andar" class="form-control" id="andar" placeholder="Digite o andar">
                    </div>
                  </div>
                  <input type="hidden" name="casaId" value="<?= $_SESSION["casaId"] ?>">
                  <div class="row">
                    <div class="col-md-6">
                      <button type="submit" name="submit" class="btn btn-primary">Cadastrar</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include_once($root . '/template/footer.php') ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/smart_house/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/smart_house/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- jquery-validation -->
<script src="/smart_house/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="/smart_house/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- Select2 -->
<script src="/smart_house/plugins/select2/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="/smart_house/plugins/moment/moment.min.js"></script>
<script src="/smart_house/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/smart_house/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/smart_house/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/smart_house/plugins/sparklines/sparkline.js"></script>
<!-- DataTables -->
<script src="/smart_house/plugins/datatables/jquery.dataTables.js"></script>
<script src="/smart_house/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
$(document).ready(function () {
  $('.select2').select2();

  $('[data-mask]').inputmask();

  //Initialize Select2 Elements
  $('.select2bs4').select2({
    theme: 'bootstrap4'
  });

  $('#quickForm').validate({
    rules: {
      nome: {
        required: true,
      },
      andar: {
        required: true,
      },
    },
    messages: {
      nome: {
        required: "Por favor informe um nome!",
      },
      andar: {
        required: "Por favor informe um andar!",
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
$(function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    const printToast = (mensagem, tipo = 'warning') => {
      Toast.fire({
        type: tipo,
        title: `${mensagem}!`
      });
    }

    const comodoDuplicado = $('#comodoDuplicado').val();

    if (comodoDuplicado == "true") {
      printToast("Cômodo Duplicada!", "error");
    }
  });
</script>
<!-- JQVMap -->
<script src="/smart_house/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/smart_house/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="/smart_house/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- SweetAlert2 -->
<script src="/smart_house/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="/smart_house/plugins/toastr/toastr.min.js"></script>
<!-- daterangepicker -->
<script src="/smart_house/plugins/moment/moment.min.js"></script>
<script src="/smart_house/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/smart_house/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/smart_house/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/smart_house/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/smart_house/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/smart_house/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/smart_house/dist/js/demo.js"></script>
</body>
</html>
