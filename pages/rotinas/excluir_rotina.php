<?php
  require_once("../../root.php");
  require_once($root . "/includes/parametros.php");
  require_once($root . "/includes/conexao/conn.php");
  

  testSession();
  testHouseSession();

  include($root . "/dao/DaoRotina.php");

  $daoRotina = new DaoRotina();

  if (isset($_GET["id"])) {
      if($daoRotina->excluirRotina($conn, $_GET["id"])) {
        header("Location: rotinas.php?success=1");
      } else {
        header("Location: rotinas.php?success=0");
      }    
  }

?>
