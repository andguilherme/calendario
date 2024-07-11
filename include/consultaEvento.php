<?php
function obterEventosPorMes($conn, $mes) {
  try {
    $query_agenda = "SELECT * FROM eventos WHERE MONTH(data_evento) = :mes";
    $result_agenda = $conn->prepare($query_agenda);
    $result_agenda->bindParam(':mes', $mes);
    $result_agenda->execute();
    return $result_agenda->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    $mensagem_erro = date('[Y-m-d H:i:s] ') . $e->getMessage() . "\n";
    error_log($mensagem_erro, 3, "log/erro.log");
    return false;
  }
}
?>
