<?php
// Inclui os arquivos necessários
include_once '../config/db.php';
include_once '../models/Produtos.php'; // Verifique o nome exato do arquivo

// Instancia a conexão com o banco de dados
$database = new Database();
$db = $database->getConnection();

// Instancia o objeto Produto
$produto = new Produto($db);

// Executa o método read()
$stmt = $produto->read();

// Conta o número de registros retornados
$num = $stmt->rowCount();

if($num > 0) {
    // Cria um array de produtos
    $produtos_arr = array();
    $produtos_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $produto_item = array(
            "id_produto" => $id_produto,
            "nome" => $nome,
            "descricao" => $descricao,
            "codigo_de_barras" => $codigo_de_barras,
            "preco_custo" => $preco_custo,
            "preco_venda" => $preco_venda,
            "quantidade_estoque" => $quantidade_estoque,
            "data_criacao" => $data_criacao,
            "data_atualizacao" => $data_atualizacao
        );

        array_push($produtos_arr["records"], $produto_item);
    }

    // Define o código de resposta - 200 OK
    http_response_code(200);

    // Exibe os dados em formato JSON
    echo json_encode($produtos_arr);
} else {
    // Define o código de resposta - 404 Not found
    http_response_code(404);

    echo json_encode(
        array("message" => "Nenhum produto encontrado.")
    );
}
?>
