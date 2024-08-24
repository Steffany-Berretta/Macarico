<?php
// Exibir todos os erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir a conexão com o banco de dados
include 'db_connection.php';

// Capturar os dados enviados pelo formulário
$nome_produto = $_POST['nome_produto'];
$preco = $_POST['preco'];
$quantidade_em_estoque = $_POST['quantidade_em_estoque'];

// Verificar se os valores não estão vazios
if (!empty($nome_produto) && !empty($preco) && !empty($quantidade_em_estoque)) {
    // Preparar a consulta SQL para inserir um novo produto
    $sql = "INSERT INTO produtos (nome_produto, preco, quantidade_em_estoque) 
            VALUES ('$nome_produto', $preco, $quantidade_em_estoque)";

    // Executar a consulta e verificar se foi bem-sucedida
    if ($conn->query($sql) === TRUE) {
        echo "Novo produto adicionado com sucesso!";
    } else {
        // Se houver um erro, exiba a consulta SQL e a mensagem de erro
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Por favor, preencha todos os campos.";
}

// Fechar a conexão
$conn->close();
?>
