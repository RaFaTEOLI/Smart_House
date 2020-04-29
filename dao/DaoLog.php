<?php

class DaoLog {
    
    function getLogs($conn, $casaId) {
        $sql = "SELECT l.*, p.nome AS nomePessoa, p.sobrenome AS sobrenomePessoa FROM log l
        INNER JOIN pessoa p
        ON p.pessoaId = l.pessoaId
        WHERE casaId = '{$casaId}'";

        $query = mysqli_query($conn, $sql);

        if(!$query) {
            die("Falha na consulta!");
        }

        return $query;
    }

    function salvarLog($conn, $log) {
        $pessoaId = $_SESSION["userId"];
        $casaId = $_SESSION["casaId"];
        $acao = $log["acao"];
        $descricao = $log["descricao"];
        $ip = $this->getUserIpAddr();

        $salvarLog = "INSERT INTO log (pessoaId, casaId, acao, dataHora, descricao, ip) VALUES
        ('{$pessoaId}', '{$casaId}', '{$acao}', NOW(), '{$descricao}', '{$ip}')";

        $query = mysqli_query($conn, $salvarLog);

        if (!$query) {
            die("Falha na consulta!" . mysqli_error($conn));
        }

        return true;
    }

    function getUserIpAddr(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip da internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip do proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
}
?>