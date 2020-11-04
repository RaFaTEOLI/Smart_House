<?php
  require_once("../../root.php");
  require_once($root . "/includes/parametros.php");
  require_once($root . "/includes/conexao/conn.php");
  

  include($root . "/dao/DaoPessoa.php");
  
  $daoPessoa = new DaoPessoa();

  if (isset($_POST["usuario"]) && isset($_POST["senha"])) {
      if ($daoPessoa->existeUsuario($conn, $_POST)) {
        echo '<input type="hidden" id="usuarioExiste" value="true">';
      } else {
        echo '<input type="hidden" id="usuarioExiste" value="false">';

        if ($daoPessoa->salvarPessoa($conn, $_POST)) {
          $array_email = $_POST;
          array_push($array_email, $array_email["assunto"] = "Cadastro Enviado!");
          array_push($array_email, $array_email["corpo"] = "Enviado");

          header("Location: /pages/login/cadastro_enviado.php?email=true");
          // if (enviarEmail($array_email)) {
          //     header("Location: /pages/login/cadastro_enviado.php?email=true");
          // } else {
          //     header("Location: /pages/login/cadastro_enviado.php?email=false");
          // }
        } else {
            header("Location: /pages/error/500.php");
        }
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
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="/plugins/toastr/toastr.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="#"><b>Smart</b>House</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Cadastre-se</p>

      <form action="/pages/login/cadastrar.php" id="form-cadastro" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="sobrenome" id="sobrenome" placeholder="Sobrenome">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" id="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuário">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="confirmarSenha" id="confirmarSenha" placeholder="Confirmar Senha">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" id="botao-cadastrar" class="btn btn-primary btn-block">Registrar</button>
          </div>
        </div>
      </form>

      <a href="/smart_house/login.php" class="text-center">Já tenho conta</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- SweetAlert2 -->
<script src="/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="/plugins/toastr/toastr.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.min.js"></script>
<script>
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

    const usuarioExiste = $('#usuarioExiste').val();

    if (usuarioExiste == "true") {
      printToast("Usuário já existe", "error");
    }

    $('#form-cadastro').submit(function(e) {

        if ($('#nome').val() == "") {
            e.preventDefault();
            printToast("Preencha o nome");
        } 
        
        else if ($('#sobrenome').val() == "") {
            e.preventDefault();
            printToast("Preencha o sobrenome");
        } 
        
        else if ($('#email').val() == "") {
            e.preventDefault();
            printToast("Preencha o email");
        } 
        
        else if ($('#usuario').val() == "") {
            e.preventDefault();
            printToast("Preencha o usuário");
        } 
        
        else if ($('#senha').val() == "") {
            e.preventDefault();
            printToast("Preencha a senha");
        } 
        
        else if ($('#confirmarSenha').val() == "") {
            e.preventDefault();
            printToast("Preencha a senha novamente");
        } 
        
        else if ($('#senha').val() !== $('#confirmarSenha').val()) {
            e.preventDefault();
            printToast("Senhas não conferem", "error");
        } 
        
        else {
            return;
        }
        
    });
  });
</script>
</body>
</html>
