<?php
  require_once("../../root.php");
  require_once($root . "/includes/parametros.php");
  require_once($root . "/includes/conexao/conn.php");
  

  testSession();
  testHouseSession();

  include($root . "/dao/DaoCena.php");

  $daoCena = new DaoCena();

  if (isset($_GET["id"])) {
      if($daoCena->excluirCena($conn, $_GET["id"])) {
        header("Location: cenas.php?success=1");
      } else {
        header("Location: cenas.php?success=0");
      }    
  }
