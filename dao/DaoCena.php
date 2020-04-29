<?php

require_once("DaoLog.php");

class DaoCena
{

    function getCenas($conn)
    {
        $sql = "SELECT * FROM cenas";

        $query = mysqli_query($conn, $sql);

        if (!$query) {
            die("Falha na consulta!");
        }

        return $query;
    }

    function getCena($conn, $cenaId)
    {
        $sql = "SELECT * FROM cenas
        WHERE cenaId = '{$cenaId}'";

        $query = mysqli_query($conn, $sql);

        if (!$query) {
            die("Falha na consulta!");
        }

        return mysqli_fetch_assoc($query);
    }

    function excluirCena($conn, $cena)
    {
        $sql = "DELETE FROM cena WHERE cenaId = '{$cena}'";

        $query = mysqli_query($conn, $sql);

        if (!$query) {
            die("Falha na consulta!");
        }

        $row_cnt = mysqli_affected_rows($conn);

        $daoLog = new DaoLog();
        $log = [
            "acao" => "Excluir",
            "descricao" => $_SESSION["userNome"] . " excluiu uma cena, ID: " . $cena,
        ];

        $daoLog->salvarLog($conn, $log);

        if ($row_cnt > 0) {
            return true;
        } else {
            return false;
        }
    }

    function dateBRtoUSA($date)
    {
        $dia = substr($date, 0, 2);
        $mes = substr($date, 3, 2);
        $ano = substr($date, 6, 4);
        $hora = substr($date, 10, 6);

        return $ano . "-" . $mes . "-" . $dia . ' ' . $hora;
    }

    function salvarCena($conn, $cena)
    {
        $nome = $conn->real_escape_string($cena["nome"]);
        $descricao = utf8_decode($conn->real_escape_string($cena["descricao"]));
        $dataHora = $this->dateBRtoUSA($conn->real_escape_string($cena["dataHora"]));

        $salvarCena = "INSERT INTO cenas (nome, descricao, dataHora) VALUES
        ('{$nome}', '{$descricao}', '{$dataHora}')";

        $query = mysqli_query($conn, $salvarCena);

        if (!$query) {
            die("Falha na consulta!" . mysqli_error($conn));
        }

        $insertId = mysqli_insert_id($conn);

        $daoLog = new DaoLog();
        $log = [
            "acao" => "Inserir",
            "descricao" => $_SESSION["userNome"] . " inseriu uma cena, ID: " . mysqli_insert_id($conn),
        ];

        $daoLog->salvarLog($conn, $log);

        return $insertId;
    }

    function alterarCena($conn, $cena)
    {
        $cenaId = $conn->real_escape_string($cena["id"]);
        $nome = $conn->real_escape_string($cena["nome"]);
        $descricao = utf8_decode($conn->real_escape_string($cena["descricao"]));
        $dataHora = $this->dateBRtoUSA($conn->real_escape_string($cena["dataHora"]));

        $salvarCena = "UPDATE cenas ";
        $salvarCena .= "SET nome = '{$nome}', descricao = '{$descricao}', ";
        $salvarCena .= "dataHora = '{$dataHora}' ";
        $salvarCena .= "WHERE cenaId = '{$cenaId}'";

        $query = mysqli_query($conn, $salvarCena);

        if (!$query) {
            die("Falha na consulta!" . mysqli_error($conn));
        }

        $row_cnt = mysqli_affected_rows($conn);

        $daoLog = new DaoLog();
        $log = [
            "acao" => "Alterar",
            "descricao" => $_SESSION["userNome"] . " alterou uma cena, ID: " . $cena,
        ];

        $daoLog->salvarLog($conn, $log);

        if ($row_cnt > 0) {
            return true;
        } else {
            return false;
        }
    }
}
