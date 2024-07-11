<?php
 try {
    $queryEditPregacao = "UPDATE pregacoes SET titulo_pregacao = :tituloPregacao, 
                                               data_pregacao = :dataPregacao, 
                                               horario_pregacao = :horarioPregacao, 
                                               conteudo = :conteudo
                          WHERE id = :id";

    $editPregacao = $conn->prepare($queryEditPregacao);
    $editPregacao->bindParam(':id', $formData['id']);
    $editPregacao->bindParam(':tituloPregacao', $formData['tituloEvento']);
    $editPregacao->bindParam(':dataPregacao', $formData['dataEvento']);
    $editPregacao->bindParam(':horarioPregacao', $formData['horarioEvento']);
    $editPregacao->bindParam(':conteudo', $formData['descricao']);
    $editPregacao->execute();

    if ($editPregacao->rowCount()) {
        echo "
        <div class='alert alert-success text-center' role='alert'>
        <i class='bx bx-check-circle'></i> 
        <p>Alterações salvas com sucesso!</p>
        <a class='btn btn-primary' href='listarPregacao.php'>OK</a>
    </div>
    
        ";
    } else {
        echo "
        <div class='alert alert-danger text-center' role='alert'>
        <i class='bx bx-x-circle'></i> <!-- Ícone de erro -->
        <p>Nenhuma alteração foi feita.</p>
        <a class='btn btn-primary' href='listarPregacao.php'>OK</a>
    </div>
    
        ";
    }
} catch (PDOException $i) {
    $mensagem_erro = date('[Y-m-d H:i:s] ') . $i->getMessage() . "\n";
    error_log($mensagem_erro, 3, "log/erro.log");
    echo "
        <div class='telaSucesso'>
        <i class='bx bx-check-circle'></i> 
        <p>Erro ao salvar as alterações. Por favor, tente novamente.</p>
        <a class='botaoForm' href='listarPregacao.php'>OK</a>
        </div>
    ";
}