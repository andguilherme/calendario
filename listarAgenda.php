<?php
include_once "bd/conexao.php";
include_once "include/authSection.php";
include_once "include/consultaEvento.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$mes = (isset($_POST['agendaMes']) && !empty($_POST['agendaMes'])) ? $_POST['agendaMes'] : date('m');
$eventos = obterEventosPorMes($conn, $mes);

?>
<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <title>Calendário Ministerial</title>
  <link rel="stylesheet" href="css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Marck+Script&display=swap" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
  <div class="menu_lateral">
    <div class="container_menu">
      <a href="index.php" id="home"><i class='bx bx-home'></i></a>
      <a href="listarAgenda.php" id="lista_agenda"><i class='bx bx-book-open'></i></a>
      <a href="listarPregacao.php" id="lista_pregacao"><i class='bx bx-bible'></i></a>
    </div>
  </div>
  <header class="kbc_lista">
    <h2>Calendário Ministerial</h2>
    <hr>

    <div class="assnt">
      <span style="font-family: 'Marck Script', cursive; font-size: 28pt">Anderson </span>
    </div>
  </header>

  <div class="listAgenda">
    <div class="col_agenda">
      <h1>Lista de compromissos do mês</h1>
    </div>
    <form action="" method="post">
      <select name="agendaMes" id="agendaMes" onchange="this.form.submit()">
        <option value="">Selecione um Mês</option>
        <option value="1" <?php if (isset($_POST['agendaMes']) && $_POST['agendaMes'] == '2') echo 'selected'; ?>>Janeiro</option>
        <option value="2" <?php if (isset($_POST['agendaMes']) && $_POST['agendaMes'] == '2') echo 'selected'; ?>>Fevereiro</option>
        <option value="3" <?php if (isset($_POST['agendaMes']) && $_POST['agendaMes'] == '3') echo 'selected'; ?>>Março</option>
        <option value="4" <?php if (isset($_POST['agendaMes']) && $_POST['agendaMes'] == '4') echo 'selected'; ?>>Abril</option>
        <option value="5" <?php if (isset($_POST['agendaMes']) && $_POST['agendaMes'] == '5') echo 'selected'; ?>>Maio</option>
        <option value="6" <?php if (isset($_POST['agendaMes']) && $_POST['agendaMes'] == '6') echo 'selected'; ?>>Junho</option>
        <option value="7" <?php if (isset($_POST['agendaMes']) && $_POST['agendaMes'] == '7') echo 'selected'; ?>>Julho</option>
        <option value="8" <?php if (isset($_POST['agendaMes']) && $_POST['agendaMes'] == '8') echo 'selected'; ?>>Agosto</option>
      </select>
    </form>
    <table class="tlista">
      <tr>
        <td>Título</td>
        <td>Data</td>
        <td>Hora</td>
        <td>Descrição</td>
        <td>Ações</td>
      </tr>
    </table>
    <table class='tab_listagem_agenda'>
      <?php
      foreach ($eventos as $evento) {
        $dataFormatada = new DateTime($evento['data_evento']);
        $horaFormatada = new DateTime($evento['horario_evento']);
      ?>
        <tr>
          <td><?php echo $evento['titulo_evento']; ?></td>
          <td><?php echo $dataFormatada->format('d/m/Y'); ?></td>
          <td><?php echo $horaFormatada->format('H:i'); ?></td>
          <td><?php echo $evento['descricao']; ?></td>
          <td style='text-align: right; display: inline-flex;'>
            <a href='#' class='' title='Editar dados'><i class='bx bxs-edit-alt'></i></a>
            <a href='include/deleteEvento.php?id=<?php echo $evento['id']; ?>' class='' title='Excluir dados' onclick='return confirm("Tem certeza que deseja excluir este evento?")'><i class='bx bxs-trash'></i></a>
          </td>
        </tr>
        <tr>
          <td colspan='4'>
            <hr>
          </td>
        </tr>
      <?php } ?>
    </table>
  </div>

  <script src="script/script.js"></script>
  </div>
</body>

</html>