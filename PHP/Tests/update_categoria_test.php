<?php
include_once '../config/db.php';
include_once '../models/Categoria.php';

$database = new Database();
$db = $database->getConnection();

$categoria = new Categoria($db);

$categoria->id_categoria = 1; // Substitua pelo ID real da categoria que deseja atualizar
$categoria->nome = "Bebidas Alcoólicas";
$categoria->descricao = "Todas as bebidas alcoólicas.";

if($categoria->update()) {
    echo "Categoria atualizada com sucesso.";
} else {
    echo "Falha ao atualizar a categoria.";
}
?>
