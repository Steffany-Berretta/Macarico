<?php
include_once '../config/db.php';
include_once '../models/Categoria.php';

$database = new Database();
$db = $database->getConnection();

$categoria = new Categoria($db);

$stmt = $categoria->read();
$num = $stmt->rowCount();

if($num > 0) {
    $categorias_arr = array();
    $categorias_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $categoria_item = array(
            "id_categoria" => $id_categoria,
            "nome" => $nome,
            "descricao" => $descricao
        );
        array_push($categorias_arr["records"], $categoria_item);
    }

    echo json_encode($categorias_arr);
} else {
    echo json_encode(array("message" => "Nenhuma categoria encontrada."));
}
?>
