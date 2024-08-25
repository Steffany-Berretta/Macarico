<?php
include 'db_connection.php';

// Consulta para obter o inventário atual
$sql = "SELECT nome_produto, quantidade_em_estoque FROM produtos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Exibir os dados como uma tabela HTML ou JSON
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row['nome_produto']."</td>
                <td>".$row['quantidade_em_estoque']."</td>
              </tr>";
    }
} else {
    echo "Nenhum produto encontrado.";
}

$conn->close();
?>
