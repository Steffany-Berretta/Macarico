<?php
include_once '../config/db.php';
include_once '../models/Categoria.php';

$database = new Database();
$db = $database->getConnection();

$categoria = new Categoria($db);

$categoria->id_categoria = 1; // Substitua pelo ID real da categoria que deseja excluir

if($categoria->delete()) {
    echo "Categoria excluída com sucesso.";
} else {
    echo "Falha ao excluir a categoria.";
}
?>
