<?php

require_once("DaoLog.php");

class DaoPessoa {
    
    function getCountPessoas($conn, $casaId) {
        $sql = "SELECT COUNT(*) AS pessoas FROM pessoa WHERE statusId = 1";

        $query = mysqli_query($conn, $sql);

        if(!$query) {
            die("Falha na consulta!");
        }

        $query = mysqli_fetch_assoc($query);

        return $query["pessoas"];
    }

    function existeUsuario($conn, $pessoa) {
        $usuario = $conn->real_escape_string($pessoa["usuario"]);

        $sql = "SELECT COUNT(*) AS existe FROM pessoa WHERE usuario = '{$usuario}' AND statusId = 1 LIMIT 1";

        $query = mysqli_query($conn, $sql);

        if (!$query) {
            die("Falha na consulta");
        }

        $existe = mysqli_fetch_assoc($query);

        if ($existe["existe"] == 1) {
            return true;
        } else {
            return false;
        }
    }

    function salvarPessoa($conn, $pessoa, $foto = null) {
        $nome = utf8_decode($conn->real_escape_string($pessoa["nome"]));
        $sobrenome = utf8_decode($conn->real_escape_string($pessoa["sobrenome"]));
        $email = $conn->real_escape_string($pessoa["email"]);
        $usuario = $conn->real_escape_string($pessoa["usuario"]);
        $senha = $conn->real_escape_string($pessoa["senha"]);

        if (isset($pessoa["tipo"])) {
            $admin = $conn->real_escape_string($pessoa["tipo"]);
        } else {
            $admin = 0;
        }

        if (isset($pessoa["notificacaoEmail"])) {
            $notifyEmail = $conn->real_escape_string($pessoa["notificacaoEmail"]);
        } else {
            $notifyEmail = 1;
        }
        
        $salvarPessoa = "INSERT INTO pessoa (nome, sobrenome, email, usuario, senha, admin, notifyEmail, foto) VALUES
        ('{$nome}', '{$sobrenome}', '{$email}', '{$usuario}', MD5('{$senha}'), '{$admin}', '{$notifyEmail}', '{$foto}')";

        $query = mysqli_query($conn, $salvarPessoa);

        if (!$query) {
            die("Falha na consulta!" . mysqli_error($conn));
        }

        if (isset($_SESSION["userNome"])) {
          $daoLog = new DaoLog();
          $log = [
              "acao" => "Inserir",
              "descricao" => $_SESSION["userNome"] . " inseriu uma pessoa, ID: " . mysqli_insert_id($conn),
          ];

          $daoLog->salvarLog($conn, $log);
        }

        return true;
    }

    function alterarPessoa($conn, $pessoa, $foto = null) {
        $pessoaId = $conn->real_escape_string($pessoa["pessoaId"]);
        $nome = utf8_decode($conn->real_escape_string($pessoa["nome"]));
        $sobrenome = utf8_decode($conn->real_escape_string($pessoa["sobrenome"]));
        $email = $conn->real_escape_string($pessoa["email"]);
        $usuario = $conn->real_escape_string($pessoa["usuario"]);
        $senha = $conn->real_escape_string($pessoa["senha"]);
        $admin = $conn->real_escape_string($pessoa["tipo"]);
        $notifyEmail = $conn->real_escape_string($pessoa["notificacaoEmail"]);

        $salvarPessoa = "UPDATE pessoa ";
        $salvarPessoa .= "SET nome = '{$nome}', sobrenome = '{$sobrenome}', email = '{$email}', usuario = '{$usuario}', senha = MD5('{$senha}'), ";
        $salvarPessoa .="admin = '{$admin}', notifyEmail = '{$notifyEmail}'";
        if ($foto != null) {
            $salvarPessoa .=", foto = '{$foto}' ";
        }
        $salvarPessoa .= "WHERE pessoaId = '{$pessoaId}'";

        $query = mysqli_query($conn, $salvarPessoa);

        if (!$query) {
            die("Falha na consulta!" . mysqli_error($conn));
        }

        $daoLog = new DaoLog();
        $log = [
            "acao" => "Alterar",
            "descricao" => $_SESSION["userNome"] . " alterou uma pessoa, ID: " . $pessoaId,
        ];

        $daoLog->salvarLog($conn, $log);
        
        return true;
    }

    function getUsuariosPorStatusId($conn, $statusId) {
        $sql = "SELECT * FROM pessoa
        WHERE statusId = '{$statusId}'";

        $query = mysqli_query($conn, $sql);

        if(!$query) {
            die("Falha na consulta!");
        }

        return $query;
    }

    function setStatusUsuario($conn, $pessoaId, $statusId) {
        $sql = "UPDATE pessoa
        SET statusId = '{$statusId}'
        WHERE pessoaId = '{$pessoaId}'";

        $query = mysqli_query($conn, $sql);

        if(!$query) {
            die("Falha na consulta!");
        }

        if($row_cnt = mysqli_affected_rows($conn) > 0) {
            return true;
        } else {
            return false;
        }
    }

    function getPessoa($conn, $pessoaId) {
        $sql = "SELECT * FROM pessoa
        WHERE pessoaId = '{$pessoaId}'";

        $query = mysqli_query($conn, $sql);

        if(!$query) {
            die("Falha na consulta!");
        }

        return mysqli_fetch_assoc($query);
    }

    function getPessoas($conn) {
        $sql = "SELECT * FROM pessoa WHERE statusId = 1";

        $query = mysqli_query($conn, $sql);

        if(!$query) {
            die("Falha na consulta!");
        }

        return $query;
    }

    function validarPessoa($conn, $usuario) {
        $sql = "SELECT COUNT(*) AS pessoa FROM pessoa
        WHERE usuario = '{$usuario}'";

        $query = mysqli_query($conn, $sql);

        if(!$query) {
            die("Falha na consulta!");
        }

        $pessoa = mysqli_fetch_assoc($query);

        if ($pessoa["pessoa"] > 0) {
            return true;
        } else {
            return false;
        }
    }

    function excluirPessoa($conn, $pessoa) {
        $sql = "DELETE FROM pessoa WHERE pessoaId = '{$pessoa}'";

        $query = mysqli_query($conn, $sql);

        if(!$query) {
            die("Falha na consulta!");
        }

        $row_cnt = mysqli_affected_rows($conn);

        $daoLog = new DaoLog();
        $log = [
            "acao" => "Excluir",
            "descricao" => $_SESSION["userNome"] . " excluiu uma pessoa, ID: " . $pessoa,
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
