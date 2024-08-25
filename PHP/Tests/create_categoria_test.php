<?php
include_once '../config/db.php';
include_once '../models/Categoria.php';

$database = new Database();
$db = $database->getConnection();

$categoria = new Categoria($db);

$categoria->nome = "Bebidas";
$categoria->descricao = "Todas as bebidas não alcoólicas.";

if($categoria->create()) {
    echo "Categoria criada com sucesso.";
} else {
    echo "Falha ao criar a categoria.";
}
?>
