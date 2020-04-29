<?php

require_once("DaoLog.php");

class DaoComodo {
    
    function getCountComodos($conn, $casaId) {
        $sql = "SELECT COUNT(*) AS comodos FROM comodo cm
        INNER JOIN casa c
        ON cm.casaId = c.casaId
        WHERE c.casaId = '{$casaId}'";

        $query = mysqli_query($conn, $sql);

        if(!$query) {
            die("Falha na consulta!");
        }

        $query = mysqli_fetch_assoc($query);

        return $query["comodos"];
    }

    function getComodo($conn, $comodoId) {
        $sql = "SELECT * FROM comodo
        WHERE comodoId = '{$comodoId}'";

        $query = mysqli_query($conn, $sql);

        if(!$query) {
            die("Falha na consulta!");
        }

        return mysqli_fetch_assoc($query);
    }

    function getComodos($conn, $casaId) {
        $sql = "SELECT cm.* FROM comodo cm
        INNER JOIN casa c
        ON cm.casaId = c.casaId
        WHERE c.casaId = '{$casaId}'";

        $query = mysqli_query($conn, $sql);

        if(!$query) {
            die("Falha na consulta!");
        }

        return $query;
    }

    function salvarComodo($conn, $comodo) {
        $nome = utf8_decode($conn->real_escape_string($comodo["nome"]));
        $andar = $conn->real_escape_string($comodo["andar"]);
        $casaId = $conn->real_escape_string($comodo["casaId"]);

        $salvarCasa = "INSERT INTO comodo (nome, andar, casaId) VALUES
        ('{$nome}', '{$andar}', '{$casaId}')";

        $query = mysqli_query($conn, $salvarCasa);

        if (!$query) {
            die("Falha na consulta!" . mysqli_error($conn));
        }

        $daoLog = new DaoLog();
        $log = [
            "acao" => "Inserir",
            "descricao" => $_SESSION["userNome"] . " inseriu um cômodo, ID: " . mysqli_insert_id($conn),
        ];

        $daoLog->salvarLog($conn, $log);

        return true;
    }

    function alterarComodo($conn, $comodo) {
        $comodoId = $conn->real_escape_string($comodo["comodoId"]);
        $nome = utf8_decode($conn->real_escape_string($comodo["nome"]));
        $andar = $conn->real_escape_string($comodo["andar"]);

        $salvarComodo = "UPDATE comodo ";
        $salvarComodo .= "SET nome = '{$nome}', andar = '{$andar}' ";
        $salvarComodo .= "WHERE comodoId = '{$comodoId}'";

        $query = mysqli_query($conn, $salvarComodo);

        if (!$query) {
            die("Falha na consulta!" . mysqli_error($conn));
        }

        $daoLog = new DaoLog();
        $log = [
            "acao" => "Alterar",
            "descricao" => $_SESSION["userNome"] . " alterou um cômodo, ID: " . $comodoId,
        ];

        $daoLog->salvarLog($conn, $log);
        
        return true;
    }

    function excluirComodo($conn, $comodo) {
        $sql = "DELETE FROM comodo WHERE comodoId = '{$comodo}'";

        $query = mysqli_query($conn, $sql);

        if(!$query) {
            die("Falha na consulta!");
        }

        $row_cnt = mysqli_affected_rows($conn);

        $daoLog = new DaoLog();
        $log = [
            "acao" => "Excluir",
            "descricao" => $_SESSION["userNome"] . " excluiu um cômodo, ID: " . $comodo,
        ];

        $daoLog->salvarLog($conn, $log);

        if ($row_cnt > 0) {
            return true;
        } else {
            return false;
        }
    }
}
?>