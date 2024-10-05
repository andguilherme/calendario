<?php
include_once "bd/conexao.php";
include_once "include/authSection.php";
include_once "include/consultaPregacao.php";
$dados =  filter_input_array(INPUT_POST, FILTER_DEFAULT);

$mes = obterMesSelecionado();
$pregacoes = obterPregacoesPorMes($conn, $mes);


?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <title>Calendário Ministerial</title>
  <link rel="stylesheet" href="css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Marck+Script&display=swap" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.3.4/purify.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

  <script src="script/geraPdf.js"></script>
</head>

<body>
  <div class="menu_lateral">
  <div class="container_menu">
      <a href="index.php" id="home"><i class='bx bx-home'></i></a>
      <a href="listarAgenda.php" id="lista_agenda"><i class='bx bx-book-open'></i></a>
      <a href="listarPregacao.php" id="lista_pregacao"><i class='bx bx-bible'></i></a>
      <a href="#" onclick="gerarPDF()" class="btn btn" id="lista_pdf"><i class='bx bxs-file-pdf'></i></a>
      <a href="pesquisaPregacao.php" id="lista_pregacao"><i class='bx bx-search' ></i></a>
    </div>
  </div>

  <header class="kbc_lista">
    <h2>Calendário Ministerial</h2>

    <div class="assnt">
      <span style="font-family: 'Marck Script', cursive; font-size: 28pt">Anderson </span>
    </div>

    <!-- <div class="col-12 text-end">
      <?php
      header('Content-Type: text/html; charset=utf-8');

      // Definir o local para português do Brasil
      setlocale(LC_TIME, 'pt_BR.UTF-8', 'pt_BR', 'portuguese');

      // Exibir a data de hoje por extenso
      echo strftime('%A, %d de %B de %Y');
      ?>
    </div> -->

  </header>


  <div class="listAgenda">
    <div class="col_agenda">
      <h1>Calendário de Pregações</h1>
      <!--  <h3 class="totalLista">Total de membros cadastrados:<?php echo $total ?></h3> -->
    </div>
    <form action="" method="post">
      <select name="agendaMes" id="agendaMes" onchange="this.form.submit()">
        <option value="">Selecione um Mês</option>
        <option value="1" <?= $mes == '1' ? 'selected' : '' ?>>Janeiro</option>
        <option value="2" <?= $mes == '2' ? 'selected' : '' ?>>Fevereiro</option>
        <option value="3" <?= $mes == '3' ? 'selected' : '' ?>>Março</option>
        <option value="4" <?= $mes == '4' ? 'selected' : '' ?>>Abril</option>
        <option value="5" <?= $mes == '5' ? 'selected' : '' ?>>Maio</option>
        <option value="6" <?= $mes == '6' ? 'selected' : '' ?>>Junho</option>
        <option value="7" <?= $mes == '7' ? 'selected' : '' ?>>Julho</option>
        <option value="8" <?= $mes == '8' ? 'selected' : '' ?>>Agosto</option>

      </select>
    </form>
    <table class="tlista">
      <tr>

        <td>Data</td>
        <td>Hora</td>
        <td>Tema</td>
        <!-- <td></td> -->
        <td>Observações</td>
        <td>Ações</td>
      </tr>
      <tr>
        <td colspan='4'></td>
      </tr>
    </table>
    <table class='tab_listagem'>
      <?php
      foreach ($pregacoes as $pregacao) {
        extract($pregacao);

        $dataFormatada = new DateTime($data_pregacao);
        $horaFormatada = new DateTime($horario_pregacao);
        $numeroDiaSemana = $dataFormatada->format('N');

        $diasSemana = [
          'Segunda-feira',
          'Terça-feira',
          'Quarta-feira',
          'Quinta-feira',
          'Sexta-feira',
          'Sábado',
          'Domingo'
        ];

        $diaSemana = ($numeroDiaSemana >= 1 && $numeroDiaSemana <= 7) ? $diasSemana[$numeroDiaSemana - 1] : 'Data Inválida';

        $formattedDate = $dataFormatada->format('d/m/Y');
        $formattedTime = $horaFormatada->format('H:i');

        echo "<tr>";
        echo "<td> {$diaSemana} - {$formattedDate}</td>";

        // Verifica se o dia da semana é quarta-feira
        if ($numeroDiaSemana != 3) {
          echo "<td id='col15'>{$formattedTime} - " . (($formattedTime < '12:00' && $formattedTime > '06:00') ? 'manhã' : 'noite') . "</td>";
        } else {
          echo "<td id='col15'>{$formattedTime}</td>";
        }

        echo "<td>{$titulo_pregacao}</td>";
        echo "<td>{$conteudo}</td>";
        echo "
              <td style='text-align: right; display: inline-flex;'>
                  <a href='editarPregacaoForm.php?id={$id}' class='' title='Editar dados'><i class='bx bxs-edit-alt'></i></a>
                  <a href='include/deletePregacao.php?id={$id}' class='' title='Excluir dados' onclick='return confirm(\"Tem certeza que deseja excluir esta pregação?\")'><i class='bx bxs-trash'></i></a>
              </td>
              ";
        echo "</tr>";
        echo "<tr><td colspan='4'><hr></td></tr>";
      }

      ?>
    </table>
  </div>

  <script src="script/script.js"></script>
  </div>
</body>
<footer>
  <br><br><br>
</footer>

</html>