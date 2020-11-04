<?php
  require_once("../../root.php");
  require_once($root . "/includes/parametros.php");
  require_once($root . "/includes/conexao/conn.php");
  

  testSession();
  testHouseSession();

  include($root . "/dao/DaoPessoa.php");

  $daoPessoa = new DaoPessoa();

  if (isset($_GET["id"])) {
      if($daoPessoa->excluirPessoa($conn, $_GET["id"])) {
        header("Location: usuarios.php?success=1");
      } else {
        header("Location: usuarios.php?success=0");
      }    
  }

?>
