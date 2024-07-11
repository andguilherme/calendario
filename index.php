
<?php
include_once "bd/conexao.php";
$dados =  filter_input_array(INPUT_POST, FILTER_DEFAULT);
include 'include/authSection.php'?>

<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <!--  <meta name="viewport" content="width=device-width, initial-scale=2.0"> -->
  <title>Calendário Ministerial</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" type="image/x-icon" href="favicon.ico">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Marck+Script&display=swap" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
  <div class="menu_lateral">
    <div class="container_menu">
      <!-- Ícone do Menu Hambúrguer -->
      <!-- <div id="icone-menu">
        &#9776;
      </div> -->
      <a href="listarAgenda.php" id="lista_agenda"><i class='bx bx-book-open'></i></a>
      <a href="listarPregacao.php" id="lista_pregacao"><i class='bx bx-bible' ></i></a>
      <a href="logout.php" id="logout"><i class='bx bx-log-in'></i></a>
    </div>
  </div>
  <header>
    <h2>Calendário Ministerial</h2>
    <div class="ass">
    <span style = "font-family: 'Marck Script', cursive; font-size: 28pt">Anderson</span>
    </div>
  </header>
  <section class="sec_calendario">
    <!-- Menu que será mostrado ou escondido -->
    <!-- <div id="menu" class="menu-escondido">
    <a href="#">Opção 1</a>
    <a href="#">Opção 2</a>
    <a href="#">Opção 3</a>
  </div> -->


    <div class="calendario-container">
      <div class="controle">
        <button id="mes-anterior">&#8592;</button>
        <h2 id="nome-mes">Janeiro 2023</h2>
        <button id="proximo-mes">&#8594;</button>
      </div>

      <div class="dias-da-semana">
        <div class="domingo">Dom</div>
        <div>Seg</div>
        <div>Ter</div>
        <div>Qua</div>
        <div>Qui</div>
        <div>Sex</div>
        <div>Sab</div>
      </div>

      <div class="dias-do-mes" id="dias">
        <!-- Os dias serão inseridos aqui pelo JavaScript -->

      </div>
    </div>

    <!-- Modal de Adicionar Evento -->

   <?php include 'include/cadastrar.php' ?>

    <div id="eventoModal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <!-- Formulário de adição de evento -->


        <div class="btn-tag">
          <div class="btn-evento btn-ativo">Agenda</div>
          <div class="btn-evento">Pregação</div>
        </div>
        <br>

        <form action="" method="post" id="formularioEvento" class="formularioEvento">
          <div class="modal-header">
            <input type="text" id="evento-titulo" name="tituloEvento" placeholder="Adicionar título e horário" required>
          </div>
          <div class="modal-section">
            <p>Data do Evento: <input type="date" id="data-evento" name="dataEvento" required></p>
          </div>

          <div class="modal-section">
            <label for="evento-horario">Horário do Evento</label>
            <input type="time" id="evento-horario" name="horarioEvento">
          </div>

          <div class="modal-section">

            <textarea name="descricao" id="evento-texto" cols="50" rows="7" placeholder="Descrição"></textarea>
          </div>

          <div class="modal-footer">
            <!-- <button id="salvar-evento">Salvar</button> -->
            <input id="salvar-evento" type="submit" value="Salvar" name="cadEvento" />
            <!--           <input id="salvar-evento" type="reset" value="Limpar"> -->
          </div>
        </form>


        <form action="" method="post" class="formularioTarefa" id="formularioTarefa">
          <div class="modal-header">
            <input type="text" id="evento-titulo" name="tituloPregacao" placeholder="Adicionar título e horário">
          </div>
          <p>Data da Pregação: <input type="date" name="dataPregacao" id="data-tarefa"></p>

          <label for="tarefa-horario">Horário da Pregação</label>
          <input type="time" id="tarefa-horario" name="horarioPregacao">

          <p><textarea name="conteudo" id="tarefa-texto" cols="50" rows="7" placeholder="Pregação"></textarea></p>

          <div class="modal-footer">
            <!-- <button id="salvar-evento">Salvar</button> -->
            <input id="salvar-evento" type="submit" value="Salvar" name="CadPregacao" />
          </div>
        </form>
      </div>
    </div>
    <script src="script/script.js"></script>
  </section>
</body>

</html>