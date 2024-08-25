<?php
// Inclui os arquivos necessários
include_once '../config/db.php';
include_once '../models/Produtos.php'; // Certifique-se de que o nome do arquivo está correto

// Instancia a conexão com o banco de dados
$database = new Database();
$db = $database->getConnection();

// Instancia o objeto Produto
$produto = new Produto($db);

// Define as propriedades do produto
$produto->nome = "Café Gourmet";
$produto->descricao = "Café de alta qualidade, torrado e moído.";
$produto->codigo_de_barras = "7891234567890";
$produto->preco_custo = 15.50;
$produto->preco_venda = 25.00;
$produto->quantidade_estoque = 100;

// Tenta criar o produto
if($produto->create()) {
    echo "Produto criado com sucesso.";
} else {
    echo "Falha ao criar o produto.";
}
?>
