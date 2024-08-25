<?php
include_once '../config/db.php';
include_once '../models/Compra.php';

class CompraController {
    private $db;
    private $compra;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->compra = new Compra($this->db);
    }

    public function create() {
        if (isset($_POST['id_fornecedor']) && isset($_POST['data_compra']) && isset($_POST['valor_total'])) {
            $this->compra->id_fornecedor = $_POST['id_fornecedor'];
            $this->compra->data_compra = $_POST['data_compra'];
            $this->compra->valor_total = $_POST['valor_total'];

            if ($this->compra->create()) {
                echo json_encode(["message" => "Compra criada com sucesso."]);
            } else {
                echo json_encode(["message" => "Falha ao criar a compra."]);
            }
        } else {
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function read() {
        $stmt = $this->compra->read();
        $num = $stmt->rowCount();

        if ($num > 0) {
            $compras_arr = array();
            $compras_arr["records"] = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $compra_item = array(
                    "id_compra" => $id_compra,
                    "id_fornecedor" => $id_fornecedor,
                    "data_compra" => $data_compra,
                    "valor_total" => $valor_total
                );
                array_push($compras_arr["records"], $compra_item);
            }

            echo json_encode($compras_arr);
        } else {
            echo json_encode(array("message" => "Nenhuma compra encontrada."));
        }
    }

    public function update() {
        if (isset($_POST['id_compra']) && isset($_POST['id_fornecedor']) && isset($_POST['data_compra']) && isset($_POST['valor_total'])) {
            $this->compra->id_compra = $_POST['id_compra'];
            $this->compra->id_fornecedor = $_POST['id_fornecedor'];
            $this->compra->data_compra = $_POST['data_compra'];
            $this->compra->valor_total = $_POST['valor_total'];

            if ($this->compra->update()) {
                echo json_encode(["message" => "Compra atualizada com sucesso."]);
            } else {
                echo json_encode(["message" => "Falha ao atualizar a compra."]);
            }
        } else {
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function delete() {
        if (isset($_POST['id_compra'])) {
            $this->compra->id_compra = $_POST['id_compra'];

            if ($this->compra->delete()) {
                echo json_encode(["message" => "Compra excluída com sucesso."]);
            } else {
                echo json_encode(["message" => "Falha ao excluir a compra."]);
            }
        } else {
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }
}
?>
