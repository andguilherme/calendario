<?php 

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "calendario";
$port = 3306;

try {
    
   $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    /* echo "Conexão com banco de dados realizado com sucesso."; */
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
/* echo "banco de dados conectado com sucesso"; */
} catch (PDOException $err) {
    $mensagem_erro = date('[Y-m-d H:i:s] ') . $i->getMessage() . "\n";
    error_log($mensagem_erro, 3, "log/erro.log");
    echo "Erro: Falha na conexão com banco de dados ";
}

?>