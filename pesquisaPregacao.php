<?php
include_once "bd/conexao.php";
include_once "include/authSection.php";
include_once "include/pesquisaPregacao.php";
$dados =  filter_input_array(INPUT_POST, FILTER_DEFAULT);



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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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

  </header>


  <div class="listAgenda">
    <div class="col_agenda">
      <h1>Calendário de Pregações</h1>
      <!--  <h3 class="totalLista">Total de membros cadastrados:<?php echo $total ?></h3> -->
    </div>
    <form action="" method="post" class="mb-4">
      <div class="mb-3 row">
        <!-- Seleção de tipo de pesquisa -->
        <label for="tipoPesquisa" class="col-sm-1 col-form-label">Pesquisar por:</label>
        <div class="col-sm-4">
          <select name="tipoPesquisa" id="tipoPesquisa" class="form-select form-select-md" onchange="exibirCamposDePesquisa()">
          <!--   <option value="mes" <?= isset($dados['tipoPesquisa']) && $dados['tipoPesquisa'] == 'mes' ? 'selected' : '' ?>>Mês</option> -->
            <option value="tema" <?= isset($dados['tipoPesquisa']) && $dados['tipoPesquisa'] == 'tema' ? 'selected' : '' ?>>Tema</option>
            <option value="data" <?= isset($dados['tipoPesquisa']) && $dados['tipoPesquisa'] == 'data' ? 'selected' : '' ?>>Data</option>
          </select>
        </div>
      </div>

      <!-- Campo para selecionar o mês -->
      <div id="campoMes" class="mb-3 row" style="display: none;">
        <label for="agendaMes" class="col-sm-2 col-form-label">Selecione um Mês:</label>
        <div class="col-sm-4">
          <select name="agendaMes" id="agendaMes" class="form-select form-select-sm">
            <option value="">Todos os Meses</option>
            <option value="1" <?= isset($dados['agendaMes']) && $dados['agendaMes'] == '1' ? 'selected' : '' ?>>Janeiro</option>
            <option value="2" <?= isset($dados['agendaMes']) && $dados['agendaMes'] == '2' ? 'selected' : '' ?>>Fevereiro</option>
            <!-- Continue com os outros meses -->
          </select>
        </div>
      </div>

      <!-- Campo para digitar o tema -->
      <div id="campoTema" class="mb-3 row" style="display: none;">
        <label for="temaPregacao" class="col-sm-2 col-form-label">Digite o Tema:</label>
        <div class="col-sm-6">
          <input type="text" name="temaPregacao" id="temaPregacao" class="form-control form-control-md" placeholder="Digite o tema da pregação" value="<?= isset($dados['temaPregacao']) ? $dados['temaPregacao'] : '' ?>">
        </div>
      </div>

      <!-- Campo para selecionar a data -->
      <div id="campoData" class="mb-3 row" style="display: none;">
        <label for="dataPregacao" class="col-sm-2 col-form-label">Selecione uma Data:</label>
        <div class="col-sm-4">
          <input type="date" name="dataPregacao" id="dataPregacao" class="form-control form-control-md" value="<?= isset($dados['dataPregacao']) ? $dados['dataPregacao'] : '' ?>">
        </div>
      </div>

      <!-- Botão de submissão -->
      <div class="mb-3 row">
        <div class="col-sm-4 offset-sm-2">
          <button type="submit" class="btn btn-primary btn-sm">Pesquisar</button>
        </div>
      </div>
    </form>


    <!-- JavaScript para exibir/esconder os campos de acordo com a seleção -->
    <script>
      function exibirCamposDePesquisa() {
        var tipoPesquisa = document.getElementById('tipoPesquisa').value;

        document.getElementById('campoMes').style.display = (tipoPesquisa === 'mes') ? 'block' : 'none';
        document.getElementById('campoTema').style.display = (tipoPesquisa === 'tema') ? 'block' : 'none';
        document.getElementById('campoData').style.display = (tipoPesquisa === 'data') ? 'block' : 'none';
      }

      // Chamar a função ao carregar a página para garantir que os campos corretos estejam visíveis
      window.onload = exibirCamposDePesquisa;
    </script>

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
      if (is_array($pregacoes) && !empty($pregacoes)) {
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
                </td>";
          echo "</tr>";
          echo "<tr><td colspan='4'><hr></td></tr>";
        }
      } else {
        echo "<tr><td colspan='5'>Nenhuma pregação encontrada.</td></tr>";
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</html>