<?php
include 'db_connection.php';

// Consulta para obter as compras realizadas
$sql = "SELECT data_pedido, id_fornecedor, id_produto, quantidade, status FROM compras";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Exibir os dados como uma tabela HTML ou JSON
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row['data_pedido']."</td>
                <td>".$row['id_fornecedor']."</td>
                <td>".$row['id_produto']."</td>
                <td>".$row['quantidade']."</td>
                <td>".$row['status']."</td>
              </tr>";
    }
} else {
    echo "Nenhuma compra encontrada.";
}

$conn->close();
?>
