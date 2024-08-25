<?php
// Inclui os arquivos necessários
include_once '../config/db.php';
include_once '../models/Produtos.php';

// Instancia a conexão com o banco de dados
$database = new Database();
$db = $database->getConnection();

// Instancia o objeto Produto
$produto = new Produto($db);

// Define o ID do produto a ser excluído
$produto->id_produto = 1; // Substitua pelo ID real do produto que deseja excluir

// Tenta excluir o produto
if($produto->delete()) {
    echo "Produto excluído com sucesso.";
} else {
    echo "Falha ao excluir o produto.";
}
?>
