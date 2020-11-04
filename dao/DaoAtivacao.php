<?php
class DaoAtivacao {
    
    function getCountAtivacoes($conn, $aparelhoId) {
        $sql = "SELECT COUNT(*) AS ativacoes FROM ativacao
        WHERE aparelhoId = '{$aparelhoId}'";

        $query = mysqli_query($conn, $sql);

        if(!$query) {
            die("Falha na consulta!");
        }

        $query = mysqli_fetch_assoc($query);

        return $query["ativacoes"];
    }

    function getAtivacoes($conn, $casaId, $aparelhoId = null) {
        $sql = "SELECT at.*, p.nome AS nomePessoa,
        p.sobrenome AS sobrenomePessoa,
        ap.nome AS nomeAparelho
        FROM ativacao at
        INNER JOIN pessoa p ON p.pessoaId = at.pessoaId
        INNER JOIN aparelho ap ON at.aparelhoId = ap.aparelhoId
        INNER JOIN comodo cm ON cm.comodoId = ap.comodoId
        INNER JOIN casa c ON c.casaId = cm.casaId
        WHERE c.casaId = '{$casaId}'";

        if ($aparelhoId != null) {
            $sql .= " AND at.aparelhoId = '{$aparelhoId}'";
        }

        $query = mysqli_query($conn, $sql);

        if(!$query) {
            die("Falha na consulta!");
        }

        return $query;
    }

    function salvarAtivacao($conn, $ativacao) {
        $aparelhoId = $ativacao["aparelhoId"];
        $pessoaId = $ativacao["pessoaId"];
        $acao = $ativacao["acao"];
        $descricao = $ativacao["descricao"];

        $salvarAtivacao = "INSERT INTO ativacao (aparelhoId, pessoaId, acao, descricao, dataHora) VALUES
        ('{$aparelhoId}', '{$pessoaId}', '{$acao}', '{$descricao}', NOW())";

        $query = mysqli_query($conn, $salvarAtivacao);

        if (!$query) {
            die("Falha na consulta!" . mysqli_error($conn));
        }

        return true;
    }

    function alterarAparelho($conn, $aparelho) {
        $aparelhoId = $conn->real_escape_string($aparelho["aparelhoId"]);
        $comodoId = $conn->real_escape_string($aparelho["comodo"]);
        $nome = $conn->real_escape_string($aparelho["nome"]);
        $descricao = $conn->real_escape_string($aparelho["descricao"]);

        $salvarComodo = "UPDATE aparelho ";
        $salvarComodo .= "SET nome = '{$nome}', descricao = '{$descricao}' ";
        $salvarComodo .= "SET comodoId = '{$comodoId}' ";
        $salvarComodo .= "WHERE aparelhoId = '{$aparelhoId}'";

        $query = mysqli_query($conn, $salvarComodo);

        if (!$query) {
            die("Falha na consulta!" . mysqli_error($conn));
        }
        
        return true;
    }

    function excluirAparelho($conn, $aparelho) {
        $sql = "DELETE FROM aparelho WHERE aparelhoId = '{$aparelho}'";

        $query = mysqli_query($conn, $sql);

        if(!$query) {
            die("Falha na consulta!");
        }

        $row_cnt = mysqli_affected_rows($conn);

        if ($row_cnt > 0) {
            return true;
        } else {
            return false;
        }
    }
}
?>
