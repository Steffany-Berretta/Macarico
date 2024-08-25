<?php
include_once '../config/db.php';
include_once '../models/Fornecedor.php';

$database = new Database();
$db = $database->getConnection();

$fornecedor = new Fornecedor($db);

$fornecedor->nome = "Fornecedor ABC";
$fornecedor->contato = "Carlos Alberto";
$fornecedor->telefone = "1145678910";
$fornecedor->email = "carlos.alberto@fornecedorabc.com";
$fornecedor->endereco = "Rua dos Fornecedores, 456, Rio de Janeiro, RJ";

if($fornecedor->create()) {
    echo "Fornecedor criado com sucesso.";
} else {
    echo "Falha ao criar o fornecedor.";
}
?>
