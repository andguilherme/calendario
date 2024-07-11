<?php
include_once "bd/conexao.php";

$dados =  filter_input_array(INPUT_POST, FILTER_DEFAULT);

//var_dump($dados);

session_start();
if (!isset($_SESSION['logado']) || $_SESSION['logado'] != true) {
    header("Location: login.php"); // Redireciona para o login se não estiver logado
    exit;
}
?>