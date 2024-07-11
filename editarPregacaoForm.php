<?php include 'bd/conexao.php' ?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <!--  <meta name="viewport" content="width=device-width, initial-scale=2.0"> -->
    <title>Calendário Ministerial</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Marck+Script&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<?php
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($formData['sendEditPregacao'])) {
    include 'include/editarPregacao.php';
}

if (!empty($id)) {
    include 'include/visualizar.php';

    // Trecho otimizado
    $pregacao = obterPregacaoPorId($conn, $id);
?>

    <div class="modal-content border rounded shadow">
        <span class="close">&times;</span>
        <form action="" method="post" id="formularioEvento" class="formularioEvento" name="formularioEvento">
            <div class="modal-header">
                <input type='hidden' id='dob' name='id' placeholder='' value='<?php echo $id ?>'>
                <div class="form-group">
                    <label for="evento-titulo">Título da Pregação</label>
                    <input type="text" class="form-control" id="evento-titulo" name="tituloEvento" placeholder="Adicionar título e horário" value="<?php echo $pregacao['titulo_pregacao'] ?>">
                </div>
            </div>
            <div class="modal-section">
                <div class="form-group">
                    <label for="data-evento">Data da Pregação</label>
                    <input type="date" class="form-control" id="data-evento" name="dataEvento" value="<?php echo $pregacao['data_pregacao'] ?>">
                </div>
            </div>
            <div class="modal-section">
                <div class="form-group">
                    <label for="evento-horario">Horário da Pregação</label>
                    <input type="time" class="form-control" id="evento-horario" name="horarioEvento" value="<?php echo $pregacao['horario_pregacao'] ?>">
                </div>
            </div>
            <div class="modal-section">
                <div class="form-group">
                    <label for="evento-texto">Descrição</label>
                    <textarea class="form-control" id="evento-texto" name="descricao" rows="7" placeholder="Descrição"><?php echo $pregacao['conteudo'] ?></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="salvar-evento" name="sendEditPregacao">Salvar</button>
                <div class="mx-1"></div>
                <button type="button" class="btn btn-secondary" onclick="window.location.href='listarPregacao.php'">Cancelar</button>
            </div>
        </form>
    </div>

<?php } ?>


    
    </div>
    <script src="script/script.js"></script>
</body>