<?php
include_once '../config/db.php';
include_once '../models/Fornecedor.php';

$database = new Database();
$db = $database->getConnection();

$fornecedor = new Fornecedor($db);

$stmt = $fornecedor->read();
$num = $stmt->rowCount();

if($num > 0) {
    $fornecedores_arr = array();
    $fornecedores_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $fornecedor_item = array(
            "id_fornecedor" => $id_fornecedor,
            "nome" => $nome,
            "contato" => $contato,
            "telefone" => $telefone,
            "email" => $email,
            "endereco" => $endereco
        );
        array_push($fornecedores_arr["records"], $fornecedor_item);
    }

    echo json_encode($fornecedores_arr);
} else {
    echo json_encode(array("message" => "Nenhum fornecedor encontrado."));
}
?>
