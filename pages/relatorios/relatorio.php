<?php
require_once("../../root.php");
require_once($root . "/includes/parametros.php");
require_once($root . "/includes/conexao/conn.php");

testSession();
testHouseSession();

include($root . "/dao/DaoRelatorio.php");

$daoRelatorio = new DaoRelatorio();

if (isset($_GET["id"])) {
  $where = $_GET["id"];
  $relatorio = $daoRelatorio->getRelatorio($conn, $where);
} else {
  if (isset($_POST["aparelhoId"])) {
    $where = $_POST["aparelhoId"];
    $relatorio = $daoRelatorio->getRelatorio($conn, $where);
  }

  if (!isset($_POST["aparelhoId"])) {
    header("Location: relatorios.php");
  }
}

$relatorioQuery = $daoRelatorio->runRelatorio($conn, $relatorio["sql"]);

$fields = mysqli_fetch_fields($relatorioQuery);

$colunas = $relatorioQuery->field_count;
$linhas = $relatorioQuery->num_rows;
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
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="/plugins/jqvmap/jqvmap.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="/plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
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
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Relatório</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Relatório</a></li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <div class="d-flex justify-content-between">
              <h3 class="card-title"><?= utf8_encode($relatorio["nome"]) ?></h3>
              <a type="button" href="relatorios.php" class="btn btn-secondary btn-sm"><i class="fas fa-undo"></i></a>
            </div>
          </div>
          <div class="card-body">
            <strong>Descrição: </strong><?= utf8_encode($relatorio["descricao"]) ?><br><br>
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <?php foreach ($fields as $field) { ?>
                    <th scope="col"><?= utf8_encode($field->name) ?></th>
                  <?php } ?>
                </tr>
              </thead>
              <tbody>
                <?php while ($row = mysqli_fetch_array($relatorioQuery)) { ?>
                  <tr>
                    <?php for ($c = 0; $c < $colunas; $c++) { ?>
                      <td><?= utf8_encode($row[$c]) ?></td>
                    <?php } ?>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
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
  <script src="/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="/plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="/plugins/sparklines/sparkline.js"></script>
  <!-- DataTables -->
  <script src="/plugins/datatables/jquery.dataTables.js"></script>
  <script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
  <script>
    $(function() {
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

      const aparelhoInserido = $('#aparelhoInserido').val();

      if (aparelhoInserido == "true") {
        printToast("Ação realizada!", "success");
      } else if (aparelhoInserido == "false") {
        printToast("Ação não realizada!", "error");
      }
    });
  </script>
  <!-- JQVMap -->
  <script src="/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toastr -->
  <script src="/plugins/toastr/toastr.min.js"></script>
  <!-- daterangepicker -->
  <script src="/plugins/moment/moment.min.js"></script>
  <script src="/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="/dist/js/adminlte.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="/dist/js/pages/dashboard.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="/dist/js/demo.js"></script>
</body>

</html>
