<?php

require_once("DaoLog.php");

class DaoAparelho
{

    function getCountAparelhos($conn, $casaId)
    {
        $sql = "SELECT COUNT(*) AS aparelhos FROM aparelho a
        INNER JOIN comodo cm
        ON a.comodoId = cm.comodoId
        INNER JOIN casa c
        ON c.casaId = cm.casaId
        WHERE c.casaId = '{$casaId}'";

        $query = mysqli_query($conn, $sql);

        if (!$query) {
            die("Falha na consulta!");
        }

        $query = mysqli_fetch_assoc($query);

        return $query["aparelhos"];
    }

    function getAparelho($conn, $aparelhoId)
    {
        $sql = "SELECT ap.*, cm.nome AS comodoNome, ca.nome AS casaNome FROM aparelho ap
        INNER JOIN comodo cm
        ON cm.comodoId = ap.comodoId
        INNER JOIN casa ca
        ON cm.casaId = ca.casaId
        WHERE aparelhoId = '{$aparelhoId}'";

        $query = mysqli_query($conn, $sql);

        if (!$query) {
            die("Falha na consulta!");
        }

        return mysqli_fetch_assoc($query);
    }

    function getAparelhos($conn, $casaId, $comodoId = null)
    {
        $sql = "SELECT ap.*, cm.nome AS comodoNome FROM aparelho ap
        INNER JOIN comodo cm
        ON cm.comodoId = ap.comodoId
        INNER JOIN casa c
        ON c.casaId = cm.casaId
        WHERE c.casaId = '{$casaId}'";

        if ($comodoId != null) {
            $sql .= " AND cm.comodoId = '{$comodoId}'";
        }

        $query = mysqli_query($conn, $sql);

        if (!$query) {
            die("Falha na consulta!");
        }

        return $query;
    }

    function salvarAparelho($conn, $aparelho)
    {
        $daoLog = new DaoLog();

        $nome = utf8_decode($conn->real_escape_string($aparelho["nome"]));
        $descricao = $conn->real_escape_string($aparelho["descricao"]);
        $comodoId = $conn->real_escape_string($aparelho["comodo"]);

        $salvarAparelho = "INSERT INTO aparelho (nome, descricao, comodoId) VALUES
        ('{$nome}', '{$descricao}', '{$comodoId}')";

        $query = mysqli_query($conn, $salvarAparelho);

        if (!$query) {
            die("Falha na consulta!" . mysqli_error($conn));
        }

        $log = [
            "acao" => "Inserir",
            "descricao" => $_SESSION["userNome"] . " inseriu um aparelho, ID: " . mysqli_insert_id($conn),
        ];

        $daoLog->salvarLog($conn, $log);

        return true;
    }

    function alterarAparelho($conn, $aparelho)
    {
        $daoLog = new DaoLog();

        $aparelhoId = $conn->real_escape_string($aparelho["aparelhoId"]);
        $comodoId = $conn->real_escape_string($aparelho["comodo"]);
        $nome = utf8_decode($conn->real_escape_string($aparelho["nome"]));
        $descricao = $conn->real_escape_string($aparelho["descricao"]);

        $salvarComodo = "UPDATE aparelho ";
        $salvarComodo .= "SET nome = '{$nome}', descricao = '{$descricao}' ";
        $salvarComodo .= "SET comodoId = '{$comodoId}' ";
        $salvarComodo .= "WHERE aparelhoId = '{$aparelhoId}'";

        $query = mysqli_query($conn, $salvarComodo);

        if (!$query) {
            die("Falha na consulta!" . mysqli_error($conn));
        }

        $log = [
            "acao" => "Alterar",
            "descricao" => $_SESSION["userNome"] . " alterou um aparelho, ID: " . $aparelhoId,
        ];

        $daoLog->salvarLog($conn, $log);

        return true;
    }

    function excluirAparelho($conn, $aparelho)
    {
        $daoLog = new DaoLog();

        $sql = "DELETE FROM aparelho WHERE aparelhoId = '{$aparelho}'";

        $query = mysqli_query($conn, $sql);

        if (!$query) {
            die("Falha na consulta!");
        }

        $row_cnt = mysqli_affected_rows($conn);

        $log = [
            "acao" => "Excluir",
            "descricao" => $_SESSION["userNome"] . " excluiu um aparelho, ID: " . $aparelho,
        ];

        $daoLog->salvarLog($conn, $log);

        if ($row_cnt > 0) {
            return true;
        } else {
            return false;
        }
    }

    function ativarOuDesativarAparelho($conn, $aparelho, $statusAtual, $rotina = null)
    {
        if ($rotina == null) {
            $daoAtivacao = new DaoAtivacao();
        }

        if ($statusAtual == 0) {
            $novoStatus = 1;
            $acaoStatus = "ligou";
        } else {
            $novoStatus = 0;
            $acaoStatus = "desligou";
        }

        $dados = $this->getAparelho($conn, $aparelho);

        $sql = "UPDATE aparelho SET status = {$novoStatus} WHERE aparelhoId = {$aparelho}";
        $query = mysqli_query($conn, $sql);

        if (!$query) {
            die("Falha na consulta!");
        }

        if ($rotina == null) {

            $ativacao = [
                "aparelhoId" => $aparelho,
                "pessoaId" => $_SESSION["userId"],
                "acao" => $novoStatus,
                "descricao" => $_SESSION["userNome"] . " " . $acaoStatus . " " . $dados["nome"],
            ];

            $daoAtivacao->salvarAtivacao($conn, $ativacao);
        }

        $row_cnt = mysqli_affected_rows($conn);

        if ($row_cnt > 0) {
            return true;
        } else {
            return false;
        }
    }
}
