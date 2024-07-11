<?php
session_start();
ob_start();

$id_evt = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

try {
    require '../bd/conexao.php';
    $query_user = "DELETE from eventos where id = :id LIMIT 1";
    $delete_user = $conn->prepare($query_user);
    $delete_user->bindParam(':id', $id_evt);
    $value = $delete_user->execute();

    if ($value) {
        $_SESSION['logado'] = "<p id='msg' style='color: green;'>Evento apagado com sucesso! </p>";
        header("Location: ../listarAgenda.php");
    }
} catch (PDOException $err) {
    $mensagem_erro = date('[Y-m-d H:i:s] ') . $err->getMessage() . "\n";
    error_log($mensagem_erro, 3, "log/erro.log");
    echo "Erro: Falha na conexão com banco de dados ";
}



