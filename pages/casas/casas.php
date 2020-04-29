<?php
  require_once("../../root.php");
  require_once($root . "/includes/parametros.php");
  require_once($root . "/includes/conexao/conn.php");

  testSession();
  testHouseSession();

  include($root . "/dao/DaoCasa.php");

  $daoCasa = new DaoCasa();

  $casas = $daoCasa->getAll($conn);

  if (isset($_GET["success"])) {
    if ($_GET["success"] == 1) {
      echo '<input type="hidden" id="casaInserida" value="true">';
    } else {
      echo '<input type="hidden" id="casaInserida" value="false">';
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
            <h1 class="m-0 text-dark">Casas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Casas</a></li>
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
                <h3 class="card-title">Casas</h3>
                <a type="button" href="cadastrar_casa.php" class="btn btn-secondary btn-sm"><i class="fas fa-plus"></i></a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="ativacoes" class="table table-bordered table-striped table-responsive-sm">
                <thead>
                <tr>
                  <th>Foto</th>
                  <th>Nome</th>
                  <th>Proprietário</th>
                  <th class="d-none d-lg-block">Cidade</th>
                  <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php while ($linha = mysqli_fetch_assoc($casas)) { ?>
                  <tr>
                    <td align="center"><img height="40" width="40" src="<?php echo $linha["foto"] ? $linha["foto"] : "/smart_house/dist/img/smarthouselogo.png" ?>" class="img-circle elevation-2" alt="House Image"></td>
                    <td><?= $linha["nome"] ?></td>
                    <td><?= $linha["pessoaNome"] ?></td>
                    <td class="d-none d-lg-block"><?= $linha["cidade"] ?></td>
                    <td align="center">
                      <div class="btn-group">
                          <a type="button" href="alterar_casa.php?id=<?= $linha["casaId"] ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                          <a type="button" href="excluir_casa.php?id=<?= $linha["casaId"] ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                      </div>
                    </td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
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
  $(function () {
    $("#ativacoes").DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese.json"
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

    const casaInserida = $('#casaInserida').val();

    if (casaInserida == "true") {
      printToast("Ação realizada!", "success");
    } else if (casaInserida == "false") {
      printToast("Ação não realizada!", "error");
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
