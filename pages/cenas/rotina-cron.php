<?php
// * * * * * php /var/www/html/smart_house/pages/rotinas/rotina-cron.php >> rotina-cron.log
require_once("../../root.php");
require_once($root . "/includes/conexao/conn.php");

include($root . "/dao/DaoRotina.php");
include($root . "/dao/DaoAparelho.php");

$daoRotina = new DaoRotina();
$daoAparelho = new DaoAparelho();

logAction("Iniciando RotinaCron...");

logAction("Buscando rotinas de agora...");
$rotinasNow = $daoRotina->getRotinasNow($conn);

if (mysqli_num_rows($rotinasNow) > 0) {
    logAction("Rotinas encontradas: " . mysqli_num_rows($rotinasNow));
    while ($rotina = mysqli_fetch_assoc($rotinasNow)) {
        $dadosAp = $daoAparelho->getAparelho($conn, $rotina["aparelhoId"]);
        $retorno = $daoAparelho->ativarOuDesativarAparelho($conn, $rotina["aparelhoId"], $dadosAp["status"], true);
        if ($retorno) {
            logAction("Ação realizada!");
        }
    }
} else {
    logAction("Sem rotinas para agora...");
}

logAction("Finalizando RotinaCron...");

function logAction($descricao)
{
    $data = date("d/m/Y H:i:s");
    echo $data . " | " . $descricao . "\n" . "<br>";
}
