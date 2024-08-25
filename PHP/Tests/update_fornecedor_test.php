<?php
include_once '../config/db.php';
include_once '../models/Fornecedor.php';

$database = new Database();
$db = $database->getConnection();

$fornecedor = new Fornecedor($db);

$fornecedor->id_fornecedor = 1; // Substitua pelo ID real do fornecedor que deseja atualizar
$fornecedor->nome = "Fornecedor XYZ";
$fornecedor->contato = "Ana Paula";
$fornecedor->telefone = "1122334455";
$fornecedor->email = "ana.paula@fornecedorxyz.com";
$fornecedor->endereco = "Avenida dos Fornecedores, 789, Belo Horizonte, MG";

if($fornecedor->update()) {
    echo "Fornecedor atualizado com sucesso.";
} else {
    echo "Falha ao atualizar o fornecedor.";
}
?>
