<?php
include_once '../controllers/CategoriaController.php';

$controller = new CategoriaController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'create':
                $controller->create();
                break;
            case 'update':
                $controller->update();
                break;
            case 'delete':
                $controller->delete();
                break;
            default:
                echo json_encode(["message" => "Ação não reconhecida."]);
                break;
        }
    } else {
        echo json_encode(["message" => "Nenhuma ação especificada."]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller->read();
} else {
    echo json_encode(["message" => "Método HTTP não suportado."]);
}
?>
