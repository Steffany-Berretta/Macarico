<?php
// Inclui os arquivos necessários
include_once '../config/db.php';
include_once '../models/Produtos.php'; // Ajuste conforme o nome do arquivo no seu sistema

// Instancia a conexão com o banco de dados
$database = new Database();
$db = $database->getConnection();

// Instancia o objeto Produto
$produto = new Produto($db);

// Define o ID do produto a ser atualizado
$produto->id_produto = 1; // Substitua pelo ID real do produto que deseja atualizar

// Define os novos valores para o produto
$produto->nome = "Café Gourmet Premium";
$produto->descricao = "Café de altíssima qualidade, torrado e moído, sabor intenso.";
$produto->codigo_de_barras = "7891234567890"; // Certifique-se de que este código é único
$produto->preco_custo = 17.00;
$produto->preco_venda = 28.00;
$produto->quantidade_estoque = 150;

// Tenta atualizar o produto
if($produto->update()) {
    echo "Produto atualizado com sucesso.";
} else {
    echo "Falha ao atualizar o produto.";
}
?>
