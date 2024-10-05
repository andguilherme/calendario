<?php
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

if (isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])) {
  $usuarioCorreto = $_ENV['USUARIO'];
  $senhaCorreta = $_ENV['SENHA'];

  session_start();

  if ($_POST['username'] == $usuarioCorreto && $_POST['password'] == $senhaCorreta) {
    $_SESSION['logado'] = true;
    header("Location: index.php"); // Redireciona para o calendário
  } else {
    /*  echo "<p class='erro'>Usuário ou senha incorretos!<p>"; */
    echo "
    <div class='alert alert-danger w-25 mx-auto position-absolute bottom-0 start-50 translate-middle-x' role='alert'>
   Usuário ou senha incorretos!
  </div>

    
    ";
    // Redireciona de volta para o login após 3 segundos
    //header("refresh:3;url=index.php");
  }
}
?>