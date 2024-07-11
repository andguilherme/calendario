<?php

function obterMesSelecionado() {
    return isset($_POST['agendaMes']) ? $_POST['agendaMes'] : date('m');
}

function obterPregacoesPorMes($conn, $mes) {
    
    try {
        $query_pregacao = "SELECT * FROM pregacoes WHERE MONTH(data_pregacao) = :mes ORDER BY data_pregacao ASC";
        $result_pregacao = $conn->prepare($query_pregacao);
        $result_pregacao->bindParam(':mes', $mes);
        $result_pregacao->execute();

        return $result_pregacao->fetchAll();
    } catch (PDOException $i) {
        $mensagem_erro = date('[Y-m-d H:i:s] ') . $i->getMessage() . "\n";
        error_log($mensagem_erro, 3, "log/erro.log");
        return false;
    }
}

?>