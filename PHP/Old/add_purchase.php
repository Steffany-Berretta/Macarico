<?php
include 'db_connection.php';

// Capturar os dados enviados pelo formulário
$fornecedor = $_POST['fornecedor'];
$produto = $_POST['produto'];
$quantidade = $_POST['quantidade'];
$data_pedido = $_POST['data-pedido'];
$status = $_POST['status-pedido'];

// Verificar se os valores não estão vazios
if (!empty($fornecedor) && !empty($produto) && !empty($quantidade) && !empty($data_pedido) && !empty($status)) {
    // Preparar a consulta SQL para inserir uma nova compra
    $sql = "INSERT INTO compras (id_fornecedor, id_produto, quantidade, data_pedido, status) 
            VALUES ((SELECT id_fornecedor FROM fornecedores WHERE nome = '$fornecedor'), 
                    (SELECT id_produto FROM produtos WHERE nome_produto = '$produto'), 
                    $quantidade, '$data_pedido', '$status')";

    // Executar a consulta e verificar se foi bem-sucedida
    if ($conn->query($sql) === TRUE) {
        echo "Nova compra adicionada com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Por favor, preencha todos os campos.";
}

// Fechar a conexão
$conn->close();
?>
