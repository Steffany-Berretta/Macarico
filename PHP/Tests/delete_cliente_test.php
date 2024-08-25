<?php
include_once '../config/db.php';
include_once '../models/Cliente.php';

$database = new Database();
$db = $database->getConnection();

$cliente = new Cliente($db);

$cliente->id_cliente = 1; // Substitua pelo ID real do cliente que deseja excluir

if($cliente->delete()) {
    echo "Cliente excluído com sucesso.";
} else {
    echo "Falha ao excluir o cliente.";
}
?>
