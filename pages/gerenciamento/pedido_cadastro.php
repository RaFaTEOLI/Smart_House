<?php
  require_once("../../root.php");
  require_once($root . "/includes/parametros.php");
  require_once($root . "/includes/conexao/conn.php");
  require_once($root . "/email/Email.php");
  require_once($root . "/email/aprovacao.php");
  require_once($root . "/email/reprovacao.php");

  testSession();
  testHouseSession();
  testAdmin();

  include($root . "/dao/DaoPessoa.php");

  $daoPessoa = new DaoPessoa();

  $pedidos = $daoPessoa->getUsuariosPorStatusId($conn, 2);

  if (isset($_GET["aprovar"])) {
    if ($daoPessoa->setStatusUsuario($conn, $_GET["aprovar"], 1)) {

      $pessoa = $daoPessoa->getPessoa($conn, $_GET["aprovar"]);

      $array_email = array(
        "nome" => $pessoa["nome"],
        "email" => $pessoa["email"],
        "assunto" => "Cadastro Aprovado!",
        "corpo" => getCorpoAprovacao($pessoa["nome"] . " " . $pessoa["sobrenome"])
      );

      if (enviarEmail($array_email)) {
          header("Location: /pages/gerenciamento/pedidos_ativacao.php?aprovar=true");
      } else {
          header("Location: /pages/error/500.php?erro=" . "Email Não Enviado!");
      }
    }
  } else if (isset($_GET["reprovar"])) {
    if ($daoPessoa->setStatusUsuario($conn, $_GET["reprovar"], 3)) {

      $pessoa = $daoPessoa->getPessoa($conn, $_GET["reprovar"]);

      $array_email = array(
        "nome" => $pessoa["nome"],
        "email" => $pessoa["email"],
        "assunto" => "Cadastro Reprovado!",
        "corpo" => getCorpoReprovacao($pessoa["nome"] . " " . $pessoa["sobrenome"], false)
      );

      if (enviarEmail($array_email)) {
          header("Location: /pages/gerenciamento/pedidos_ativacao.php?reprovar=true");
      } else {
          header("Location: /pages/error/500.php?erro=" . "Email Não Enviado!");
      }
      
    }
  }

?>
