<?php
include_once '../config/db.php';
include_once '../models/Fornecedor.php';

$database = new Database();
$db = $database->getConnection();

$fornecedor = new Fornecedor($db);

$fornecedor->id_fornecedor = 1; // Substitua pelo ID real do fornecedor que deseja excluir

if($fornecedor->delete()) {
    echo "Fornecedor excluído com sucesso.";
} else {
    echo "Falha ao excluir o fornecedor.";
}
?>
