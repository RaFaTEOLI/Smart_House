<?php
    // Connection Variables
    $server = "localhost";    
    $user = "smart_house";
    $password = "fIHad42gf";
    $db = "smart_house";
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
