<?php
    session_start();
    unset($_SESSION["userId"]);
    unset($_SESSION["userNome"]);
    unset($_SESSION["userNivel"]);
    unset($_SESSION["userAdmin"]);
    unset($_SESSION["userFoto"]);
    header("Location: /pages/login/login.php");
?>
