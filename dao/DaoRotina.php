<?php

require_once("DaoLog.php");

class DaoRotina
{

    function getRotinasNow($conn)
    {
        $sql = "SELECT * FROM rotina WHERE SUBSTRING(dataHora, 1, 16) = SUBSTRING(NOW(), 1, 16)";

        $query = mysqli_query($conn, $sql);

        if (!$query) {
            die("Falha na consulta!");
        }

        return $query;
    }

    function getRotinas($conn, $casaId, $cenaId = null)
    {
        $sql = "SELECT r.*, ap.nome as nomeAparelho FROM rotina r
        INNER JOIN aparelho ap
        ON r.aparelhoId = ap.aparelhoId
        INNER JOIN comodo cm
        ON cm.comodoId = ap.comodoId
        INNER JOIN casa c
        ON c.casaId = cm.casaId
        WHERE c.casaId = '{$casaId}' ";

        if ($cenaId != null) {
            $sql .= " AND cenaId = '{$cenaId}'";
        } else {
            $sql .= "AND r.dataHora > NOW()";
        }

        $query = mysqli_query($conn, $sql);

        if (!$query) {
            die("Falha na consulta!");
        }

        return $query;
    }

    function getRotina($conn, $rotinaId)
    {
        $sql = "SELECT * FROM rotina
        WHERE rotinaId = '{$rotinaId}'";

        $query = mysqli_query($conn, $sql);

        if (!$query) {
            die("Falha na consulta!");
        }

        return mysqli_fetch_assoc($query);
    }

    function excluirRotina($conn, $rotina)
    {
        $sql = "DELETE FROM rotina WHERE rotinaId = '{$rotina}'";

        $query = mysqli_query($conn, $sql);

        if (!$query) {
            die("Falha na consulta!");
        }

        $row_cnt = mysqli_affected_rows($conn);

        $daoLog = new DaoLog();
        $log = [
            "acao" => "Excluir",
            "descricao" => $_SESSION["userNome"] . " excluiu uma rotina, ID: " . $rotina,
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

    function salvarRotina($conn, $rotina)
    {
        $aparelhoId = $conn->real_escape_string($rotina["aparelhoId"]);
        $descricao = $conn->real_escape_string($rotina["descricao"]);
        $dataHora = $this->dateBRtoUSA($conn->real_escape_string($rotina["dataHora"]));
        $acao = $conn->real_escape_string($rotina["acao"]);
        $cenaId = $rotina["cenaId"];

        if ($acao == "on") {
            $acao = 1;
        } else {
            $acao = 0;
        }

        if ($cenaId != null) {
            $salvarRotina = "INSERT INTO rotina (aparelhoId, descricao, dataHora, acao, cenaId) VALUES
            ('{$aparelhoId}', '{$descricao}', '{$dataHora}', '{$acao}', '{$cenaId}')";
        } else {
            $salvarRotina = "INSERT INTO rotina (aparelhoId, descricao, dataHora, acao) VALUES
            ('{$aparelhoId}', '{$descricao}', '{$dataHora}', '{$acao}')";
        }


        $query = mysqli_query($conn, $salvarRotina);

        if (!$query) {
            die("Falha na consulta!" . mysqli_error($conn));
        }

        $daoLog = new DaoLog();
        $log = [
            "acao" => "Inserir",
            "descricao" => $_SESSION["userNome"] . " inseriu uma rotina, ID: " . mysqli_insert_id($conn),
        ];

        $daoLog->salvarLog($conn, $log);

        return true;
    }

    function alterarRotina($conn, $rotina)
    {
        $rotinaId = $conn->real_escape_string($rotina["rotinaId"]);
        $aparelhoId = $conn->real_escape_string($rotina["aparelhoId"]);
        $descricao = $conn->real_escape_string($rotina["descricao"]);
        $dataHora = $this->dateBRtoUSA($conn->real_escape_string($rotina["dataHora"]));
        $acao = $conn->real_escape_string($rotina["acao"]);

        $salvarRotina = "UPDATE rotina ";
        $salvarRotina .= "SET aparelhoId = '{$aparelhoId}', descricao = '{$descricao}', ";
        $salvarRotina .= "dataHora = '{$dataHora}', acao = '{$acao}' ";
        $salvarRotina .= "WHERE rotinaId = '{$rotinaId}'";

        $query = mysqli_query($conn, $salvarRotina);

        if (!$query) {
            die("Falha na consulta!" . mysqli_error($conn));
        }

        $row_cnt = mysqli_affected_rows($conn);

        $daoLog = new DaoLog();
        $log = [
            "acao" => "Alterar",
            "descricao" => $_SESSION["userNome"] . " alterou uma rotina, ID: " . $rotinaId,
        ];

        $daoLog->salvarLog($conn, $log);

        if ($row_cnt > 0) {
            return true;
        } else {
            return false;
        }
    }
}
