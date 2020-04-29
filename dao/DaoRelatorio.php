<?php
class DaoRelatorio {
    
    function getCountRelatorios($conn) {
        $sql = "SELECT COUNT(*) AS relatorios FROM relatorio";

        $query = mysqli_query($conn, $sql);

        if(!$query) {
            die("Falha na consulta!");
        }

        $query = mysqli_fetch_assoc($query);

        return $query["ativacoes"];
    }

    function getRelatorios($conn) {
        $sql = "SELECT * FROM relatorio";

        $query = mysqli_query($conn, $sql);

        if(!$query) {
            die("Falha na consulta!");
        }

        return $query;
    }

    function getRelatorio($conn, $relatorioId) {
        $sql = "SELECT * FROM relatorio WHERE relatorioId = {$relatorioId}";

        $query = mysqli_query($conn, $sql);

        if(!$query) {
            die("Falha na consulta!");
        }

        return $query = mysqli_fetch_assoc($query);
    }

    function runRelatorio($conn, $relatorio) {
        $relatorio = $this->replaceParameters($relatorio);
        $query = mysqli_query($conn, $relatorio);

        if(!$query) {
            die("Falha na consulta!");
        }

        return $query;
    }

    function replaceParameters($sql) {
        $casaId = $_SESSION["casaId"];
        $sql = str_replace("__CASAID__", "$casaId", $sql);
        return $sql;
    }
}
?>