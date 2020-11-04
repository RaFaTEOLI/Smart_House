<?php
    // Connection Variables
    $server = "smarthouse.cfwoqgakt7t7.us-east-2.rds.amazonaws.com";    
    $user = "smart_house";
    $password = "fIHad42gf";
    $db = "smarthouse";
    $port = "3306";

    // Opens Connection
    $conn = mysqli_connect($server, $user, $password, $db);

    // Tries Connection
    if (mysqli_connect_errno()) {
        getErroBD($conn . " Número do Erro: " . mysqli_connect_errno());
        //die("Falha ao conectar-se ao banco de dados!" . mysqli_connect_errno());
    }

function getErroBD($erro) {
    if ($_SESSION["NIVEL"] == 99) {
        header("Location: /pages/dashboard/erro/erro_bd.php?erro=" . $erro);
    } else {
        header("Location: /pages/dashboard/erro/erro_bd.php");
    }
    die();
}

?>
