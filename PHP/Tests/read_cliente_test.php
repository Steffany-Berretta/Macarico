<?php
include_once '../config/db.php';
include_once '../models/Cliente.php';

$database = new Database();
$db = $database->getConnection();

$cliente = new Cliente($db);

$stmt = $cliente->read();
$num = $stmt->rowCount();

if($num > 0) {
    $clientes_arr = array();
    $clientes_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $cliente_item = array(
            "id_cliente" => $id_cliente,
            "nome" => $nome,
            "telefone" => $telefone,
            "email" => $email,
            "endereco" => $endereco,
            "cpf_cnpj" => $cpf_cnpj
        );
        array_push($clientes_arr["records"], $cliente_item);
    }

    echo json_encode($clientes_arr);
} else {
    echo json_encode(array("message" => "Nenhum cliente encontrado."));
}
?>
