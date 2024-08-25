<?php
include_once '../config/db.php';
include_once '../models/Fornecedor.php';

class FornecedorController {
    private $db;
    private $fornecedor;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->fornecedor = new Fornecedor($this->db);
    }

    public function create() {
        if (isset($_POST['nome'])) {
            $this->fornecedor->nome = $_POST['nome'];
            $this->fornecedor->contato = $_POST['contato'] ?? '';
            $this->fornecedor->telefone = $_POST['telefone'] ?? '';
            $this->fornecedor->email = $_POST['email'] ?? '';
            $this->fornecedor->endereco = $_POST['endereco'] ?? '';

            if ($this->fornecedor->create()) {
                echo json_encode(["message" => "Fornecedor criado com sucesso."]);
            } else {
                echo json_encode(["message" => "Falha ao criar o fornecedor."]);
            }
        } else {
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function read() {
        $stmt = $this->fornecedor->read();
        $num = $stmt->rowCount();

        if ($num > 0) {
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
    }

    public function update() {
        if (isset($_POST['id_fornecedor']) && isset($_POST['nome'])) {
            $this->fornecedor->id_fornecedor = $_POST['id_fornecedor'];
            $this->fornecedor->nome = $_POST['nome'];
            $this->fornecedor->contato = $_POST['contato'] ?? '';
            $this->fornecedor->telefone = $_POST['telefone'] ?? '';
            $this->fornecedor->email = $_POST['email'] ?? '';
            $this->fornecedor->endereco = $_POST['endereco'] ?? '';

            if ($this->fornecedor->update()) {
                echo json_encode(["message" => "Fornecedor atualizado com sucesso."]);
            } else {
                echo json_encode(["message" => "Falha ao atualizar o fornecedor."]);
            }
        } else {
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function delete() {
        if (isset($_POST['id_fornecedor'])) {
            $this->fornecedor->id_fornecedor = $_POST['id_fornecedor'];

            if ($this->fornecedor->delete()) {
                echo json_encode(["message" => "Fornecedor excluído com sucesso."]);
            } else {
                echo json_encode(["message" => "Falha ao excluir o fornecedor."]);
            }
        } else {
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }
}
?>
