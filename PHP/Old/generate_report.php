<?php
include 'db_connection.php';

// Capturar os dados do formulário de filtro
$report_type = $_POST['report-type'];
$report_period = $_POST['report-period'];

// Preparar a consulta SQL com base nos filtros selecionados
$sql = "SELECT * FROM $report_type WHERE data BETWEEN DATE_SUB(NOW(), INTERVAL $report_period) AND NOW()";

// Executar a consulta e exibir os resultados
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Exibir os resultados do relatório
    while($row = $result->fetch_assoc()) {
        // Código para exibir os dados do relatório
    }
} else {
    echo "Nenhum dado encontrado para o relatório selecionado.";
}

$conn->close();
?>
