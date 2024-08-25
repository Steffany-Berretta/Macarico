<?php
include_once '../config/db.php';
include_once '../models/Cliente.php';

$database = new Database();
$db = $database->getConnection();
$cliente = new Cliente($db);

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action == 'create') {
    $cliente->nome = $_POST['nome'];
    $cliente->telefone = $_POST['telefone'];
    $cliente->email = $_POST['email'];
    $cliente->endereco = $_POST['endereco'];
    $cliente->cpf_cnpj = $_POST['cpf_cnpj'];

    if($cliente->create()) {
        echo json_encode(["message" => "Cliente criado com sucesso."]);
    } else {
        echo json_encode(["message" => "Erro ao criar cliente."]);
    }
}

if ($action == 'read') {
    $stmt = $cliente->read();
    $num = $stmt->rowCount();

    if ($num > 0) {
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
        echo json_encode(["message" => "Nenhum cliente encontrado."]);
    }
}

if ($action == 'update') {
    $cliente->id_cliente = $_POST['id_cliente'];
    $cliente->nome = $_POST['nome'];
    $cliente->telefone = $_POST['telefone'];
    $cliente->email = $_POST['email'];
    $cliente->endereco = $_POST['endereco'];
    $cliente->cpf_cnpj = $_POST['cpf_cnpj'];

    if($cliente->update()) {
        echo json_encode(["message" => "Cliente atualizado com sucesso."]);
    } else {
        echo json_encode(["message" => "Erro ao atualizar cliente."]);
    }
}

if ($action == 'delete') {
    $cliente->id_cliente = $_POST['id_cliente'];

    if($cliente->delete()) {
        echo json_encode(["message" => "Cliente excluído com sucesso."]);
    } else {
        echo json_encode(["message" => "Erro ao excluir cliente."]);
    }
}
?>
