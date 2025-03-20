<?php
require_once ('config.php');

// Verifica se o parâmetro de pesquisa foi enviado
if (isset($_GET['query'])) {
    $query = $_GET['query'];
    
    // Consulta para pesquisar produtos
    $sql = "SELECT * FROM produtos WHERE descricao LIKE '%$query%' OR detalhes LIKE '%$query%'";
    
    // Executa a consulta
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Exibe os resultados da pesquisa em um modal
        echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#resultadoModal">';
        echo 'Resultados da Pesquisa';
        echo '</button>';
        
        echo '<div class="modal fade" id="resultadoModal" tabindex="-1" role="dialog" aria-labelledby="resultadoModalLabel" aria-hidden="true">';
        echo '<div class="modal-dialog" role="document">';
        echo '<div class="modal-content">';
        echo '<div class="modal-header">';
        echo '<h5 class="modal-title" id="resultadoModalLabel">Resultados da Pesquisa</h5>';
        echo '<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">';
        echo '<span aria-hidden="true">&times;</span>';
        echo '</button>';
        echo '</div>';
        echo '<div class="modal-body">';
        echo '<ul class="list-group">';
        while($row = $result->fetch_assoc()) {
            echo '<li class="list-group-item">';
            echo '<a href="cat_detalhes_produtos.php?id_produto=' . $row['id_produto'] . '">';
            echo $row["descricao"] . ': ' . $row["detalhes"];
            echo '</a>';
            echo '</li>';
        }
        echo '</ul>';
        echo '</div>';
        echo '<div class="modal-footer">';
        echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    } else {
        echo "Nenhum resultado encontrado.";
    }
} else {
    echo "Nenhum termo de pesquisa fornecido.";
}

$conn->close();