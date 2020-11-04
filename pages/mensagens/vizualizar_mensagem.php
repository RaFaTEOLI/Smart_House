<?php
require_once("../../root.php");
require_once($root . "/includes/parametros.php");
require_once($root . "/includes/conexao/conn.php");


testSession();
testHouseSession();

include($root . "/dao/DaoMensagem.php");
$daoMensagem = new DaoMensagem();

if (isset($_GET["id"])) {
  if ($daoMensagem->marcarComoLida($conn, $_GET["id"])) {
    header("Location: mensagens.php?success=1");
  } else {
    header("Location: mensagens.php?success=0");
  }
}
