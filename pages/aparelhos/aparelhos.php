<?php
  require_once("../../root.php");
  require_once($root . "/includes/parametros.php");
  require_once($root . "/includes/conexao/conn.php");

  testSession();
  testHouseSession();

  include($root . "/dao/DaoAparelho.php");

  $daoAparelho = new DaoAparelho();

  if (isset($_GET["comodoId"])) {
    $aparelhos = $daoAparelho->getAparelhos($conn, $_SESSION["casaId"], $_GET["comodoId"]);
  } else {
    $aparelhos = $daoAparelho->getAparelhos($conn, $_SESSION["casaId"]);
  }

  if (isset($_GET["success"])) {
    if ($_GET["success"] == 1) {
      echo '<input type="hidden" id="aparelhoInserido" value="true">';
    } else {
      echo '<input type="hidden" id="aparelhoInserido" value="false">';
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
            <h1 class="m-0 text-dark">Aparelhos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Aparelhos</a></li>
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
                <h3 class="card-title">Aparelhos</h3>
                <?php if (isset($_GET["comodoId"])) {
                  $cadastrar = "cadastrar_aparelho.php?comodoId=" . $_GET["comodoId"];
                } else {
                  $cadastrar = "cadastrar_aparelho.php";
                }
                ?>
                <a type="button" href="<?= $cadastrar ?>" class="btn btn-secondary btn-sm"><i class="fas fa-plus"></i></a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                <?php while ($aparelho = mysqli_fetch_assoc($aparelhos)) { ?>
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success" onclick="location.href='aparelho.php?id=<?= $aparelho['aparelhoId'] ?>';" style="cursor: pointer;">
                      <div class="inner">
                        <a id="ativar" href="ativar_aparelho.php?id=<?= $aparelho["aparelhoId"] ?>" style="position:absolute; right:60px;top:5px; font-size: 18px;" class="text-primary"><i class="fas fa-power-off"></i></a>
                        <a id="alterar" href="alterar_aparelho.php?id=<?= $aparelho["aparelhoId"] ?>" style="position:absolute; right:30px;top:5px; font-size: 18px;" class="text-warning"><i class="fas fa-edit"></i></a>
                        <a id="remover" href="excluir_aparelho.php?id=<?= $aparelho["aparelhoId"] ?>" style="position:absolute; right:5px;top:5px; font-size: 18px;" class="text-danger"><i class="fas fa-trash"></i></a>
                        <h3><?= $aparelho["nome"] ?></h3>

                        <p><?= $aparelho["comodoNome"] ?></p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-tv"></i>
                      </div>
                    </div>
                    <!-- small box / -->
                  </div>
                <?php } ?>
                </div>
              </div>
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

    const ativar = aparelhoId => {
      alert('Clicou');
      event.preventDefault();
      $.ajax({
          type: 'POST',
          url: 'ajax/ativarAparelho.php',
          data: aparelhoId,
          success: function(data) {
              printToast('Ação realizada!');
          }
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
