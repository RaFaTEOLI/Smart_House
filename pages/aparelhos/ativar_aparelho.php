<?php
require_once("../../root.php");
require_once($root . "/includes/parametros.php");
require_once($root . "/includes/conexao/conn.php");

include($root . "/dao/DaoAparelho.php");
include($root . "/dao/DaoAtivacao.php");

$daoAparelho = new DaoAparelho();
$daoAtivacao = new DaoAtivacao();

$aparelhoId = $_GET["id"];

$retorno = $daoAparelho->ativarOuDesativarAparelho($conn, $aparelhoId);

if ($retorno) {
  header("Location: aparelhos.php?success=1");
} else {
  header("Location: aparelhos.php?success=0");
}
