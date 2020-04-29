<?php
  require_once("../../root.php");
  require_once($root . "/includes/parametros.php");
  require_once($root . "/includes/conexao/conn.php");

  testSession();
  testHouseSession();

  include($root . "/dao/DaoAparelho.php");
  include($root . "/dao/DaoAtivacao.php");

  $daoAparelho = new DaoAparelho();
  $daoAtivacao = new DaoAtivacao();

  if (isset($_GET["id"]) && isset($_GET["statusAtual"])) {
    $aparelhoId = $_GET["id"];
    if($daoAparelho->ativarOuDesativarAparelho($conn, $aparelhoId, $_GET["statusAtual"])) {
      header("Location: aparelho.php?id={$aparelhoId}&success=1");
    } else {
      header("Location: aparelho.php?id={$aparelhoId}&success=0");
    }
  }

  if (isset($_GET["id"])) {
    $where = $_GET["id"];
    $aparelho = $daoAparelho->getAparelho($conn, $where);
  } else {
    if (isset($_POST["aparelhoId"])) {
        $where = $_POST["aparelhoId"];
        $aparelho = $daoAparelho->getAparelho($conn, $where);
    }
    
    if (!isset($_POST["aparelhoId"])) {
        header("Location: aparelhos.php");
    }
  }

  $aparelhoId = $aparelho["aparelhoId"];
  $statusAtual = $aparelho["status"];

  $ativacoes = $daoAtivacao->getCountAtivacoes($conn, $aparelhoId);

  if ($aparelho["status"]) {
    $aparelhoAtivo = "on";
  } else {
    $aparelhoAtivo = "off";
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
  <style>
    .device-button {
      margin-left: 16px;
      display: flex;
      align-self: center;
      justify-content: center;
    }
    .device-button:hover {
      margin-left: 16px;
      display: flex;
      align-self: center;
      justify-content: center;
      color: grey;
    }
    .on {
      color: green;
    }
    .off {
      color: red;
    }
  </style>
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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Aparelho</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Aparelho</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <a href="aparelhos.php" class="btn btn-primary btn-block mb-3">Voltar</a>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Ações</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-0">
                <ul class="nav nav-pills flex-column">
                  <li class="nav-item">
                    <a href="/smart_house/pages/ativacoes/ativacoes.php?aparelhoId=<?= $aparelhoId ?>" class="nav-link">
                      <i class="fas fa-history"></i> Histórico de Ativações
                      <span class="badge bg-primary float-right"><?= $ativacoes ?></span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-file-alt"></i> Relatórios de Consumo
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-file-alt"></i> Relatórios de Uso
                    </a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Ligar/Desligar</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="nav nav-pills flex-column">
                  <li class="nav-item">
                    <form action="aparelho.php" method="post">
                      <input type="hidden" name="statusAtual" value="<?= $aparelho["status"] ?>">
                      <input type="hidden" name="aparelhoId" value="<?= $aparelho["aparelhoId"] ?>">
                      <a class="device-button" <?= $aparelhoAtivo ?> href="aparelho.php?id=<?= $aparelhoId ?>&desligar=<?= $aparelhoId ?>&statusAtual=<?= $statusAtual ?>"><i class="fas fa-toggle-<?= $aparelhoAtivo ?> fa-5x"></i></i></a>
                    </form>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        <div class="col-md-9">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h2 class="card-title"><?= $aparelho["nome"] ?></h2>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-read-info">
                <h6><i class="fas fa-home"></i> <?= $aparelho["casaNome"] ?></h6>
                <h6><i class="fas fa-door-open"></i> <?= $aparelho["comodoNome"] ?></h6>
              </div>
              <!-- /.mailbox-read-info -->
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
                <p><?= $aparelho["descricao"] ?></p>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.card-footer -->
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

    const aparelhoInserido = $('#aparelhoInserido').val();

    if (aparelhoInserido == "true") {
      printToast("Ação realizada!", "success");
    } else if (aparelhoInserido == "false") {
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

