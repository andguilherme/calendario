<?php

if (!empty($dados['tituloEvento'])) {
  $query = "INSERT INTO eventos (titulo_evento, data_evento, horario_evento, descricao ) VALUES (:tituloEvento, :dataEvento, :horarioEvento, :descricao)";
  $cadastroEvento = $conn->prepare($query);
  $cadastroEvento->bindParam(':tituloEvento', $dados['tituloEvento']);
  $cadastroEvento->bindParam(':dataEvento', $dados['dataEvento']);
  $cadastroEvento->bindParam(':horarioEvento', $dados['horarioEvento']);
  $cadastroEvento->bindParam(':descricao', $dados['descricao']);
  $cadastroEvento->execute();

  if ($cadastroEvento->rowCount() > 0) {
    //echo "<script>confirm('Evento cadastrado com sucesso!')</script>";
    echo "<p class='acerto'>Evento cadastrado com sucesso!</p>";
    header("refresh:3;url=index.php");
  } else {
    echo '<script>confirm("Erro: Evento não cadastrado com sucesso!")</script>';
  }
}

if (!empty($dados['tituloPregacao'])) {
  // Verifica se já existe uma pregação para o mesmo dia e hora
  $query_verificacao = "SELECT COUNT(*) FROM pregacoes WHERE data_pregacao = :dataPregacao AND horario_pregacao = :horarioPregacao";
  $verificacao = $conn->prepare($query_verificacao);
  $verificacao->bindParam(':dataPregacao', $dados['dataPregacao']);
  $verificacao->bindParam(':horarioPregacao', $dados['horarioPregacao']);
  $verificacao->execute();
  $resultado_verificacao = $verificacao->fetchColumn();

  if ($resultado_verificacao > 0) {
    echo "<span style='color: red; font-size: 16pt; position: absolute; top: 20%;'>Já existe uma pregação cadastrada para essa data e hora. </span>";
    header("Refresh: 3");
      
  } else {
      // Insere a pregação apenas se não houver conflito de data e hora
      $query_pregacao = "INSERT INTO pregacoes (titulo_pregacao, data_pregacao, horario_pregacao, conteudo ) VALUES (:tituloPregacao, :dataPregacao, :horarioPregacao, :conteudo)";
      $cadastroPregacao = $conn->prepare($query_pregacao);
      $cadastroPregacao->bindParam(':tituloPregacao', $dados['tituloPregacao']);
      $cadastroPregacao->bindParam(':dataPregacao', $dados['dataPregacao']);
      $cadastroPregacao->bindParam(':horarioPregacao', $dados['horarioPregacao']);
      $cadastroPregacao->bindParam(':conteudo', $dados['conteudo']);
      $cadastroPregacao->execute();

      if ($cadastroPregacao->rowCount() > 0) {
        echo "<p class='acerto'>pregacao cadastrada com sucesso!</p>";
      }else{
          echo "Erro: pregação não cadastrado com sucesso!<br>";
      }
  }
}

?>