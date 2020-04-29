<?php
  require_once("../../root.php");
  require_once($root . "/includes/parametros.php");
  require_once($root . "/includes/conexao/conn.php");

  testSession();
  testHouseSession();

  include($root . "/dao/DaoCasa.php");

  $daoCasa = new DaoCasa();

  if (isset($_GET["id"])) {
      if($daoCasa->excluirCasa($conn, $_GET["id"])) {
        header("Location: casas.php?success=1");
      } else {
        header("Location: casas.php?success=0");
      }    
  }

?>