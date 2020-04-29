<?php
class DaoMensagem
{

    function getCountMensagens($conn, $casaId)
    {
        $sql = "SELECT COUNT(*) AS mensagens FROM mensagens m
        INNER JOIN casa c
        ON c.casaId = m.casaId
        WHERE c.casaId = '{$casaId}'";

        $query = mysqli_query($conn, $sql);

        if (!$query) {
            die("Falha na consulta!");
        }

        $query = mysqli_fetch_assoc($query);

        return $query["mensagens"];
    }

    function getMensagem($conn, $mensagemId)
    {
        $sql = "SELECT * FROM mensagens
        WHERE mensagemId = '{$mensagemId}'";

        $query = mysqli_query($conn, $sql);

        if (!$query) {
            die("Falha na consulta!");
        }

        return mysqli_fetch_assoc($query);
    }

    function getMensagens($conn, $casaId)
    {
        $sql = "SELECT * FROM mensagens m
        INNER JOIN casa c
        ON c.casaId = m.casaId
        WHERE c.casaId = '{$casaId}' AND m.lida = 0";

        $query = mysqli_query($conn, $sql);

        if (!$query) {
            die("Falha na consulta!");
        }

        return $query;
    }

    function salvarMensagem($conn, $mensagem)
    {
        $_mensagem = $conn->real_escape_string($mensagem["mensagem"]);

        $salvarAparelho = "INSERT INTO mensagens (dataMensagem, mensagem) VALUES
        (NOW(), '{$_mensagem}')";

        $query = mysqli_query($conn, $salvarAparelho);

        if (!$query) {
            die("Falha na consulta!" . mysqli_error($conn));
        }

        return true;
    }
    function marcarComoLida($conn, $mensagemId)
    {

        $ler = "UPDATE mensagens SET lida = 1 WHERE mensagemId = {$mensagemId}";

        $query = mysqli_query($conn, $ler);

        if (!$query) {
            die("Falha na consulta!" . mysqli_error($conn));
        }

        return true;
    }
}
