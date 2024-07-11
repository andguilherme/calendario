<?php

// método para visualizar os dados no formulário de edição

function obterPregacaoPorId($conn, $id) {
    $query = "SELECT * FROM pregacoes WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->bindParam(':id', $id);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}

$pregacao = obterPregacaoPorId($conn, $id);

?>
