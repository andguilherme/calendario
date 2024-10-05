<?php
include_once "bd/conexao.php";
include_once "include/authSection.php";
include_once "include/pesquisaPregacao.php";

// Inicializa os dados de entrada e a variável $pregacoes como array vazio por padrão
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$pregacoes = [];

// Verifica qual tipo de pesquisa foi solicitado e realiza a consulta correspondente
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipoPesquisa = isset($dados['tipoPesquisa']) ? $dados['tipoPesquisa'] : '';
    $mes = isset($dados['agendaMes']) ? $dados['agendaMes'] : '';
    $tema = isset($dados['temaPregacao']) ? $dados['temaPregacao'] : '';
    $dataPregacao = isset($dados['dataPregacao']) ? $dados['dataPregacao'] : '';

    // Chama a função correta para buscar pregações com base nos filtros selecionados
    $pregacoes = obterPregacoesPorFiltros($conn, $tipoPesquisa, $mes, $tema, $dataPregacao);
}

// Função para obter pregações com base nos filtros
function obterPregacoesPorFiltros($conn, $tipoPesquisa, $mes, $tema, $dataPregacao)
{
    try {
        $query_pregacao = "SELECT * FROM pregacoes WHERE 1=1";

        // Filtro por mês - Verifica se o tipo de pesquisa é "mes" e o valor de mês foi preenchido
        if ($tipoPesquisa === 'mes' && !empty($mes)) {
            $query_pregacao .= " AND MONTH(data_pregacao) = :mes";
        }

        // Filtro por tema - Verifica se o tipo de pesquisa é "tema" e o tema foi preenchido
        if ($tipoPesquisa === 'tema' && !empty($tema)) {
            $query_pregacao .= " AND titulo_pregacao LIKE :tema";
        }

        // Filtro por data - Verifica se o tipo de pesquisa é "data" e a data foi preenchida
        if ($tipoPesquisa === 'data' && !empty($dataPregacao)) {
            $query_pregacao .= " AND DATE(data_pregacao) = :dataPregacao";
        }

        // Ordenar os resultados por data
        $query_pregacao .= " ORDER BY data_pregacao ASC";
        $stmt = $conn->prepare($query_pregacao);

        // Vinculação dos parâmetros
        if (!empty($mes) && $tipoPesquisa === 'mes') {
            $stmt->bindParam(':mes', $mes, PDO::PARAM_INT);
        }

        if (!empty($tema) && $tipoPesquisa === 'tema') {
            // Adiciona coringas '%' ao redor do valor do tema para buscar parcialmente
            $tema = "%$tema%";
            $stmt->bindParam(':tema', $tema, PDO::PARAM_STR);
        }

        if (!empty($dataPregacao) && $tipoPesquisa === 'data') {
            $stmt->bindParam(':dataPregacao', $dataPregacao, PDO::PARAM_STR);
        }

        // Executa a consulta e retorna os resultados
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Log de erro em arquivo
        error_log($e->getMessage(), 3, "log/erro.log");
        return [];
    }
}
