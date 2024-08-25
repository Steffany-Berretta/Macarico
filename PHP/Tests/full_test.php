<?php
// Inclui os arquivos necessários
include_once '../config/db.php';
include_once '../models/Produtos.php';

// Instancia a conexão com o banco de dados
$database = new Database();
$db = $database->getConnection();

// Instancia o objeto Produto
$produto = new Produto($db);

echo "<h2>Teste de Criação</h2>";

// Teste de Criação
$produto->nome = "Chá Verde";
$produto->descricao = "Chá verde orgânico de alta qualidade.";
$produto->codigo_de_barras = "7890987654321";
$produto->preco_custo = 10.00;
$produto->preco_venda = 15.00;
$produto->quantidade_estoque = 200;

if($produto->create()) {
    echo "Produto criado com sucesso.<br>";
    $novo_id = $db->lastInsertId();
} else {
    echo "Falha ao criar o produto.<br>";
    exit();
}

echo "<h2>Teste de Leitura</h2>";

// Teste de Leitura
$stmt = $produto->read();
$num = $stmt->rowCount();

if($num > 0) {
    echo "Produtos encontrados: $num<br>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        echo "ID: $id_produto - Nome: $nome - Preço: $preco_venda<br>";
    }
} else {
    echo "Nenhum produto encontrado.<br>";
}

echo "<h2>Teste de Atualização</h2>";

// Teste de Atualização
$produto->id_produto = $novo_id;
$produto->nome = "Chá Verde Premium";
$produto->descricao = "Chá verde orgânico premium com sabor refinado.";
$produto->codigo_de_barras = "7890987654321";
$produto->preco_custo = 12.00;
$produto->preco_venda = 18.00;
$produto->quantidade_estoque = 180;

if($produto->update()) {
    echo "Produto atualizado com sucesso.<br>";
} else {
    echo "Falha ao atualizar o produto.<br>";
}

echo "<h2>Teste de Exclusão</h2>";

// Teste de Exclusão
$produto->id_produto = $novo_id;

if($produto->delete()) {
    echo "Produto excluído com sucesso.<br>";
} else {
    echo "Falha ao excluir o produto.<br>";
}
?>
