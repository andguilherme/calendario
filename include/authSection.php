<?php
session_start();
if (!isset($_SESSION['logado']) || $_SESSION['logado'] != true) {
    header("Location: login.php"); // Redireciona para o login se não estiver logado
    exit;
}
?>