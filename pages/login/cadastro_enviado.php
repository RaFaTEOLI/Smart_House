<?php
  require_once("../../root.php");
  require_once($root . "/includes/parametros.php");
  require_once($root . "/includes/conexao/conn.php");
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
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="/smart_house/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="/smart_house/plugins/toastr/toastr.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/smart_house/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/smart_house/dist/css/adminlte.min.css">
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
      <h3 class="login-box-msg">Cadastro enviado!</h3>
      <i class="far fa-envelope fa-5x d-flex justify-content-center"></i><br>
      <p class="login-box-msg">Estamos aguardando a aprovação do seu cadastro pelo administrador do sistema 
        e assim que seu cadastro for aprovado, você será notificado via email.</p>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="/smart_house/plugins/jquery/jquery.min.js"></script>
<!-- SweetAlert2 -->
<script src="/smart_house/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="/smart_house/plugins/toastr/toastr.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/smart_house/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/smart_house/dist/js/adminlte.min.js"></script>
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
