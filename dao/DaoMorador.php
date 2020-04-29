<?php

require_once("DaoLog.php");

class DaoMorador {
    
    function getCountMoradores($conn, $casaId) {
        $sql = "SELECT COUNT(*) AS moradores FROM morador m
        INNER JOIN casa c
        ON m.casaId = c.casaId
        WHERE c.casaId = '{$casaId}'";

        $query = mysqli_query($conn, $sql);

        if(!$query) {
            die("Falha na consulta!");
        }

        $query = mysqli_fetch_assoc($query);

        return $query["moradores"];
    }

    function getNovosMoradores($conn, $casaId) {
        $sql = "SELECT COUNT(*) AS moradores FROM morador m
        INNER JOIN casa c
        ON m.casaId = c.casaId
        WHERE c.casaId = '{$casaId}' AND MONTH(data_cadastro) = MONTH(NOW())";

        $query = mysqli_query($conn, $sql);

        if(!$query) {
            die("Falha na consulta!");
        }

        $query = mysqli_fetch_assoc($query);

        return $query["moradores"];
    }

    function getMoradoresPorCasaId($conn, $casaId) {
        $sql = "SELECT p.*, m.moradorId FROM morador m
        INNER JOIN pessoa p
        ON p.pessoaId = m.pessoaId
        INNER JOIN casa c
        ON m.casaId = c.casaId
        WHERE c.casaId = '{$casaId}'";

        $query = mysqli_query($conn, $sql);

        if(!$query) {
            die("Falha na consulta!");
        }

        return $query;
    }

    function salvarMorador($conn, $morador) {
        $pessoaId = $conn->real_escape_string($morador["pessoa"]);
        $casaId = $conn->real_escape_string($morador["casaId"]);

        $sql = "INSERT INTO morador (pessoaId, casaId, data_cadastro) VALUES ('{$pessoaId}', '{$casaId}', NOW())";

        $query = mysqli_query($conn, $sql);

        if(!$query) {
            die("Falha na consulta!");
        }

        $daoLog = new DaoLog();
        $log = [
            "acao" => "Inserir",
            "descricao" => $_SESSION["userNome"] . " inseriu um morador, ID: " . mysqli_insert_id($conn),
        ];

        $daoLog->salvarLog($conn, $log);

        return true;
    }

    function excluirMorador($conn, $moradorId) {
        $sql = "DELETE FROM morador WHERE moradorId = '{$moradorId}'";

        $query = mysqli_query($conn, $sql);

        if(!$query) {
            die("Falha na consulta!");
        }

        $row_cnt = mysqli_affected_rows($conn);

        $daoLog = new DaoLog();
        $log = [
            "acao" => "Excluir",
            "descricao" => $_SESSION["userNome"] . " excluiu um morador, ID: " . $moradorId,
        ];

        $daoLog->salvarLog($conn, $log);

        if ($row_cnt > 0) {
            return true;
        } else {
            die($sql);
            return false;
        }
        
    }

    function validarMorador($conn, $casaId, $pessoaId) {
        $sql = "SELECT COUNT(*) AS morador FROM morador m
        INNER JOIN pessoa p
        ON p.pessoaId = m.pessoaId
        INNER JOIN casa c
        ON m.casaId = c.casaId
        WHERE c.casaId = '{$casaId}' AND m.pessoaId = '{$pessoaId}'";

        $query = mysqli_query($conn, $sql);

        if(!$query) {
            die("Falha na consulta!");
        }

        $morador = mysqli_fetch_assoc($query);

        if ($morador["morador"] > 0) {
            return true;
        } else {
            return false;
        }
    }
}
?>