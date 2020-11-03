<?php
require_once("../../root.php");

include($root . "/dao/DaoAparelho.php");
include($root . "/dao/DaoAtivacao.php");
require_once($root . "/includes/conexao/conn.php");

$daoAparelho = new DaoAparelho();
$daoAtivacao = new DaoAtivacao();

$aparelhoId = $_GET["id"];

$retorno = $daoAparelho->ativarOuDesativarAparelho($conn, $aparelhoId);

if ($retorno) {
  header("Location: aparelhos.php?success=1");
} else {
  header("Location: aparelhos.php?success=0");
}
