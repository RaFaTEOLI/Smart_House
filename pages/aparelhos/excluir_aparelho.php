<?php
  require_once("../../root.php");
  require_once($root . "/includes/parametros.php");
  require_once($root . "/includes/conexao/conn.php");

  testSession();
  testHouseSession();

  include($root . "/dao/DaoAparelho.php");

  $daoAparelho = new DaoAparelho();

  if (isset($_GET["id"])) {
      if($daoAparelho->excluirAparelho($conn, $_GET["id"])) {
        header("Location: aparelhos.php?success=1");
      } else {
        header("Location: aparelhos.php?success=0");
      }    
  }

?>