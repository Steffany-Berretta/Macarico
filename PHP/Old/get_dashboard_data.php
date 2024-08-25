<?php
include 'db_connection.php';

// Consultas para obter os dados do dashboard
$sales_query = "SELECT SUM(quantidade_vendida) AS total_sales FROM vendas";
$inventory_query = "SELECT SUM(quantidade_em_estoque) AS total_inventory FROM produtos";
$purchases_query = "SELECT SUM(quantidade) AS total_purchases FROM compras";

// Executar as consultas e armazenar os resultados
$sales_result = $conn->query($sales_query);
$inventory_result = $conn->query($inventory_query);
$purchases_result = $conn->query($purchases_query);

$sales_total = $sales_result->fetch_assoc()['total_sales'];
$inventory_total = $inventory_result->fetch_assoc()['total_inventory'];
$purchases_total = $purchases_result->fetch_assoc()['total_purchases'];

// Exibir os resultados em JSON
echo json_encode([
    'total_sales' => $sales_total,
    'total_inventory' => $inventory_total,
    'total_purchases' => $purchases_total
]);

$conn->close();
?>
