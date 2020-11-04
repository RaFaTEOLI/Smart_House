<?php
    session_start();
    $titulo = "Smart House";
    $nomeMenu = "Smart House";    
    $favicon = "/dist/img/favicon.ico";
    $botao_alterar = "btn btn-success btn-sm";
    $botao_cancelar = "btn btn-info btn-sm";
    $botao_excluir = "btn btn-danger btn-sm";

    
    function testSession() {
        if (!isset($_SESSION["userId"])) {
            header("Location: login.php");
        }
    }

    function testHouseSession() {
        if (!isset($_SESSION["userId"])) {
          header("Location: login.php");
          exit;
        }
        if (!isset($_SESSION["casaId"])) {
            header("Location: /pages/conectar/casas.php");
        }
    }

    function testAdmin() {
        if(!$_SESSION["userAdmin"]) {
            header("Location: /pages/error/403.php");
        }
    }

    function getErro($erro) {
        header("Location: /pages/error/error.php?erro=" . $erro);
        die();
    }

    function buscarParametros($conn) {
        $parametros_sql = "SELECT * FROM parametros";
        $executar = mysqli_query($conn, $parametros_sql);

        if (!$executar) {
            getErro(mysqli_error($conn));
            //die("Falha na consulta!");
        }

        $informacao = mysqli_fetch_assoc($executar);
        return $informacao;
    }

    function getCasas($conn, $pessoaId, $nivel) {
        $casas_sql = "SELECT c.* FROM casa c
                            LEFT JOIN morador m
                            ON c.casaId = m.casaId
                            WHERE c.proprietarioId = '{$pessoaId}' OR m.pessoaId = '{$pessoaId}'";

        $casas_query = mysqli_query($conn, $casas_sql);

        if (!$casas_query) {
            getErro(mysqli_error($conn));
        }

        return $casas_query;
    }

    function autenticarUsuario($conn, $usuario, $senha) {
        $usuario = $conn->real_escape_string($usuario);
        $senha = $conn->real_escape_string($senha);

        $login_sql = "SELECT * FROM pessoa WHERE usuario = '{$usuario}' AND senha = MD5('{$senha}') AND statusId = 1 LIMIT 1";

        $login_query = mysqli_query($conn, $login_sql);

        if (!$login_query) {
            //getErro(mysqli_error($conn));
            echo $login_sql;
            die(mysqli_error($conn));
        }

        $usuario = mysqli_fetch_assoc($login_query);

        if (empty($usuario)) {
            return false;
        } else {
            $_SESSION["userId"] = $usuario["pessoaId"];
            $_SESSION["userNome"] = $usuario["nome"];
            $_SESSION["userNivel"] = $usuario["nivel"];
            $_SESSION["userAdmin"] = $usuario["admin"];
            $_SESSION["userFoto"] = $usuario["foto"];
            return true;
        }
    }

    function getEstados($conn) {
        $sql = "SELECT * FROM estado";

        $query = mysqli_query($conn, $sql);

        if (!$query) {
            getErro(mysqli_error($conn));
        }

        return $query;
    }
?>
