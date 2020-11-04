<?php
  require_once("../../root.php");
  require_once($root . "/includes/parametros.php");
  require_once($root . "/includes/conexao/conn.php");

  testSession();

  include($root . "/dao/DaoCasa.php");

  $daoCasa = new DaoCasa();

  $casas = $daoCasa->getCasas($conn, $_SESSION["userId"]);
  
  if (isset($_POST["casaId"])) {
      $_SESSION["casaId"] = $_POST["casaId"];
      header("Location: /");
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
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition lockscreen">
  <!-- Automatic element centering -->
  <div class="lockscreen-wrapper">
    <div class="lockscreen-logo">
      <a href="../../index2.html"><b>Smart</b>House</a>
    </div>
    <!-- User name -->
    <div class="lockscreen-name">Acesse sua Casa</div>
    <br>
  </div>

  <section class="content card">
    <div class="container-fluid card-body">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <?php if ($casas->num_rows == 0) {
          echo 'Você não possui nenhuma casa'; 
        }
        ?>
        <?php while($linha = mysqli_fetch_assoc($casas)) { ?>
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <a class="small-box bg-info card-house" casaId="<?= $linha["casaId"] ?>" href="#" style="white-space: nowrap; overflow: hidden;">
            <div class="inner">
              <h4><?= $linha["nome"] ?></h4>
              <p>Proprietário: <?= $linha["dono"] ?><br>Temperatura: <?= $linha["temperatura"] ?>&deg;</p>
            </div>
            <div class="icon">
              <i class="ion ion-home"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">Acessar <i class="fas fa-arrow-circle-right"></i></a> -->
          </a>
        </div>
        <?php } ?>
      </div>
      <form action="/pages/conectar/casas.php" method="POST" id="casaForm"style="display: none;">
        <input type="hidden" name="casaId" id="campoCasa">
      </form>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<script>
      $(document).ready(function(){
          const casas = document.querySelectorAll('.card-house');
          const campoCasa = document.querySelector('#campoCasa');

          casas.forEach(house => {
            house.onclick = () => {
              const casaId = house.getAttribute('casaId');
              campoCasa.value = casaId;
              $("#casaForm").submit();
            }
          });
      });
</script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
