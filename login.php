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

<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Calendário Ministerial</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Marck+Script&display=swap" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
 
  <header>
    <h2>Calendário Ministerial</h2>
    <div class="ass">
      <span style="font-family: 'Marck Script', cursive; font-size: 28pt">Anderson</span>
    </div>
  </header>

	<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-lg-4 col-md-6 col-sm-8">
            <form class="border p-4 rounded-4 shadow bg-white" method="post">
                <h2 class="text-center mb-4">Login</h2>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Usuário</label>
                    <input type="text" name="username" class="form-control" id="input_login" aria-describedby="emailHelp" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Senha</label>
                    <input type="password" name="password"    class="form-control" id="input_senha" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Lembre de mim</label>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Entrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>