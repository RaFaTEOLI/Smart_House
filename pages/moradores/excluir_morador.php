<?php
  require_once("../../root.php");
  require_once($root . "/includes/parametros.php");
  require_once($root . "/includes/conexao/conn.php");
  require_once($root . "/email/Email.php");

  testSession();
  testHouseSession();

  include($root . "/dao/DaoMorador.php");

  $daoMorador = new DaoMorador();

  if (isset($_GET["id"])) {
      if($daoMorador->excluirMorador($conn, $_GET["id"])) {
        header("Location: moradores.php?success=1");
      } else {
        header("Location: moradores.php?success=0");
      }    
  }

?>