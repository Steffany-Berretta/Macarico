<?php
include_once '../config/db.php';
include_once '../models/Cliente.php';

$database = new Database();
$db = $database->getConnection();

$cliente = new Cliente($db);

$cliente->nome = "João Silva";
$cliente->telefone = "11987654321";
$cliente->email = "joao.silva@example.com";
$cliente->endereco = "Rua das Flores, 123, São Paulo, SP";
$cliente->cpf_cnpj = "123.456.789-00";

if($cliente->create()) {
    echo "Cliente criado com sucesso.";
} else {
    echo "Falha ao criar o cliente.";
}
?>
