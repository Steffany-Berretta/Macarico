<?php
include_once '../config/db.php';
include_once '../models/Cliente.php';

class ClienteController {
    private $db;
    private $cliente;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->cliente = new Cliente($this->db);
    }

    public function create() {
        if (isset($_POST['nome']) && isset($_POST['cpf_cnpj'])) {
            $this->cliente->nome = $_POST['nome'];
            $this->cliente->telefone = $_POST['telefone'] ?? '';
            $this->cliente->email = $_POST['email'] ?? '';
            $this->cliente->endereco = $_POST['endereco'] ?? '';
            $this->cliente->cpf_cnpj = $_POST['cpf_cnpj'];

            if ($this->cliente->create()) {
                echo json_encode(["message" => "Cliente criado com sucesso."]);
            } else {
                echo json_encode(["message" => "Falha ao criar o cliente."]);
            }
        } else {
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function read() {
        $stmt = $this->cliente->read();
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
            echo json_encode(array("message" => "Nenhum cliente encontrado."));
        }
    }

    public function update() {
        if (isset($_POST['id_cliente']) && isset($_POST['nome']) && isset($_POST['cpf_cnpj'])) {
            $this->cliente->id_cliente = $_POST['id_cliente'];
            $this->cliente->nome = $_POST['nome'];
            $this->cliente->telefone = $_POST['telefone'] ?? '';
            $this->cliente->email = $_POST['email'] ?? '';
            $this->cliente->endereco = $_POST['endereco'] ?? '';
            $this->cliente->cpf_cnpj = $_POST['cpf_cnpj'];

            if ($this->cliente->update()) {
                echo json_encode(["message" => "Cliente atualizado com sucesso."]);
            } else {
                echo json_encode(["message" => "Falha ao atualizar o cliente."]);
            }
        } else {
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function delete() {
        if (isset($_POST['id_cliente'])) {
            $this->cliente->id_cliente = $_POST['id_cliente'];

            if ($this->cliente->delete()) {
                echo json_encode(["message" => "Cliente excluído com sucesso."]);
            } else {
                echo json_encode(["message" => "Falha ao excluir o cliente."]);
            }
        } else {
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }
}
?>
