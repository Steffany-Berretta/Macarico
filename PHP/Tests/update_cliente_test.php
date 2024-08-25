<?php
include_once '../config/db.php';
include_once '../models/Cliente.php';

$database = new Database();
$db = $database->getConnection();

$cliente = new Cliente($db);

$cliente->id_cliente = 1; // Substitua pelo ID real do cliente que deseja atualizar
$cliente->nome = "João da Silva";
$cliente->telefone = "11987654321";
$cliente->email = "joao.silva.updated@example.com";
$cliente->endereco = "Avenida Paulista, 1234, São Paulo, SP";
$cliente->cpf_cnpj = "123.456.789-00";

if($cliente->update()) {
    echo "Cliente atualizado com sucesso.";
} else {
    echo "Falha ao atualizar o cliente.";
}
?>
