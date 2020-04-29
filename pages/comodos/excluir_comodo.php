<?php
  require_once("../../root.php");
  require_once($root . "/includes/parametros.php");
  require_once($root . "/includes/conexao/conn.php");

  testSession();
  testHouseSession();

  include($root . "/dao/DaoComodo.php");

  $daoComodo = new DaoComodo();

  if (isset($_GET["id"])) {
      if($daoComodo->excluirComodo($conn, $_GET["id"])) {
        header("Location: comodos.php?success=1");
      } else {
        header("Location: comodos.php?success=0");
      }    
  }

?>