<?php
include_once '../config/db.php';
include_once '../models/Encomenda.php';

class EncomendaController {
    private $db;
    private $encomenda;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->encomenda = new Encomenda($this->db);
    }

    public function create() {
        if (isset($_POST['id_cliente']) && isset($_POST['data_encomenda']) && isset($_POST['valor_total'])) {
            $this->encomenda->id_cliente = $_POST['id_cliente'];
            $this->encomenda->data_encomenda = $_POST['data_encomenda'];
            $this->encomenda->status = $_POST['status'] ?? 'Pendente';
            $this->encomenda->valor_total = $_POST['valor_total'];

            if ($this->encomenda->create()) {
                echo json_encode(["message" => "Encomenda criada com sucesso."]);
            } else {
                echo json_encode(["message" => "Falha ao criar a encomenda."]);
            }
        } else {
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function read() {
        $stmt = $this->encomenda->read();
        $num = $stmt->rowCount();

        if ($num > 0) {
            $encomendas_arr = array();
            $encomendas_arr["records"] = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $encomenda_item = array(
                    "id_encomenda" => $id_encomenda,
                    "id_cliente" => $id_cliente,
                    "data_encomenda" => $data_encomenda,
                    "status" => $status,
                    "valor_total" => $valor_total
                );
                array_push($encomendas_arr["records"], $encomenda_item);
            }

            echo json_encode($encomendas_arr);
        } else {
            echo json_encode(array("message" => "Nenhuma encomenda encontrada."));
        }
    }

    public function update() {
        if (isset($_POST['id_encomenda']) && isset($_POST['id_cliente']) && isset($_POST['data_encomenda']) && isset($_POST['valor_total'])) {
            $this->encomenda->id_encomenda = $_POST['id_encomenda'];
            $this->encomenda->id_cliente = $_POST['id_cliente'];
            $this->encomenda->data_encomenda = $_POST['data_encomenda'];
            $this->encomenda->status = $_POST['status'] ?? 'Pendente';
            $this->encomenda->valor_total = $_POST['valor_total'];

            if ($this->encomenda->update()) {
                echo json_encode(["message" => "Encomenda atualizada com sucesso."]);
            } else {
                echo json_encode(["message" => "Falha ao atualizar a encomenda."]);
            }
        } else {
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function delete() {
        if (isset($_POST['id_encomenda'])) {
            $this->encomenda->id_encomenda = $_POST['id_encomenda'];

            if ($this->encomenda->delete()) {
                echo json_encode(["message" => "Encomenda excluída com sucesso."]);
            } else {
                echo json_encode(["message" => "Falha ao excluir a encomenda."]);
            }
        } else {
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }
}
?>
