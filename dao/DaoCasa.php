<?php

require_once("DaoLog.php");

class DaoCasa {
    
    function getCountCasas($conn) {
        $sql = "SELECT COUNT(*) AS casas FROM casa";

        $query = mysqli_query($conn, $sql);

        if(!$query) {
            die("Falha na consulta!");
        }

        $query = mysqli_fetch_assoc($query);

        return $query["casas"];
    }

    function getCasas($conn, $pessoaId) {
        $sql = "SELECT DISTINCT c.*, p.nome AS dono FROM casa c
        INNER JOIN morador m
        ON c.casaId = m.casaId
        INNER JOIN pessoa p
        ON p.pessoaId = c.proprietarioId ";
        if ($pessoaId != "") {
            $sql .= "WHERE p.pessoaId = '{$pessoaId}' OR m.pessoaId = '{$pessoaId}' OR c.proprietarioId = '{$pessoaId}';";
        }

        $query = mysqli_query($conn, $sql);

        if(!$query) {
            die("Falha na consulta!");
        }

        return $query;
    }

    function getAll($conn) {
        $sql = "SELECT c.*, p.nome AS pessoaNome, p.pessoaId, p.foto AS pessoaFoto FROM casa c
        INNER JOIN pessoa p
        ON p.pessoaId = c.proprietarioId";

        $query = mysqli_query($conn, $sql);

        if(!$query) {
            die("Falha na consulta!");
        }

        return $query;
    }

    function getCasa($conn, $casaId) {
        $sql = "SELECT * FROM casa
        WHERE casaId = '{$casaId}'";

        $query = mysqli_query($conn, $sql);

        if(!$query) {
            die("Falha na consulta!");
        }

        return mysqli_fetch_assoc($query);
    }

    function salvarCasa($conn, $casa, $foto) {
        $nome = utf8_decode($conn->real_escape_string($casa["nome"]));
        $endereco = utf8_decode($conn->real_escape_string($casa["endereco"]));
        $cidade = utf8_decode($conn->real_escape_string($casa["cidade"]));
        $estado = $conn->real_escape_string($casa["estado"]);
        $cep = $conn->real_escape_string($casa["cep"]);
        $proprietario = $conn->real_escape_string($casa["proprietario"]);

        $salvarCasa = "INSERT INTO casa (nome, endereco, cidade, estadoId, cep, proprietarioId, foto) VALUES
        ('{$nome}', '{$endereco}', '{$cidade}', '{$estado}', '{$cep}', '{$proprietario}', '{$foto}')";

        $query = mysqli_query($conn, $salvarCasa);

        if (!$query) {
            die("Falha na consulta!" . mysqli_error($conn));
        }

        $daoLog = new DaoLog();
        $log = [
            "acao" => "Inserir",
            "descricao" => $_SESSION["userNome"] . " inseriu uma casa, ID: " . mysqli_insert_id($conn),
        ];

        $daoLog->salvarLog($conn, $log);

        return true;
    }

    function alterarCasa($conn, $casa, $foto = null) {
        $casaId = $conn->real_escape_string($casa["casaId"]);
        $nome = utf8_decode($conn->real_escape_string($casa["nome"]));
        $endereco = utf8_decode($conn->real_escape_string($casa["endereco"]));
        $cidade = utf8_decode($conn->real_escape_string($casa["cidade"]));
        $estado = $conn->real_escape_string($casa["estado"]);
        $cep = $conn->real_escape_string($casa["cep"]);
        $proprietario = $conn->real_escape_string($casa["proprietario"]);

        $salvarCasa = "UPDATE casa ";
        $salvarCasa .= "SET nome = '{$nome}', endereco = '{$endereco}', cidade = '{$cidade}', estadoId = '{$estado}', cep = '{$cep}', ";
        $salvarCasa .="proprietarioId = '{$proprietario}'";
        if ($foto != null) {
            $salvarCasa .=", foto = '{$foto}' ";
        }
        $salvarCasa .= "WHERE casaId = '{$casaId}'";

        $query = mysqli_query($conn, $salvarCasa);

        if (!$query) {
            die("Falha na consulta!" . mysqli_error($conn));
        }

        $daoLog = new DaoLog();
        $log = [
            "acao" => "Alterar",
            "descricao" => $_SESSION["userNome"] . " alterou uma casa, ID: " . $casaId,
        ];

        $daoLog->salvarLog($conn, $log);

        
        return true;
    }

    function validarCasa($conn, $cep) {
        $sql = "SELECT COUNT(*) AS casa FROM casa
        WHERE cep = '{$cep}'";

        $query = mysqli_query($conn, $sql);

        if(!$query) {
            die("Falha na consulta!");
        }

        $casa = mysqli_fetch_assoc($query);

        if ($casa["casa"] > 0) {
            return true;
        } else {
            return false;
        }
    }

    function excluirCasa($conn, $casa) {
        $sql = "DELETE FROM casa WHERE casaId = '{$casa}'";

        $query = mysqli_query($conn, $sql);

        if(!$query) {
            die("Falha na consulta!");
        }

        $row_cnt = mysqli_affected_rows($conn);

        $daoLog = new DaoLog();
        $log = [
            "acao" => "Excluir",
            "descricao" => $_SESSION["userNome"] . " excluiu uma casa, ID: " . $casa,
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