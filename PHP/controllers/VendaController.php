<?php
include_once '../config/db.php';
include_once '../models/Venda.php';

class VendaController {
    private $db;
    private $venda;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->venda = new Venda($this->db);
    }

    public function create() {
        // Validação de id_cliente
        if (!isset($_POST['id_cliente']) || !is_numeric($_POST['id_cliente']) || $_POST['id_cliente'] <= 0) {
            echo json_encode(["message" => "ID do cliente inválido."]);
            return;
        }

        // Verificação se o cliente existe
        if (!$this->venda->clienteExiste($_POST['id_cliente'])) {
            echo json_encode(["message" => "Cliente não encontrado."]);
            return;
        }

        // Validação de data_venda
        if (!isset($_POST['data_venda']) || strtotime($_POST['data_venda']) === false) {
            echo json_encode(["message" => "Data da venda inválida."]);
            return;
        }

        // Validação de valor_total
        if (!isset($_POST['valor_total']) || !is_numeric($_POST['valor_total']) || $_POST['valor_total'] <= 0) {
            echo json_encode(["message" => "Valor total inválido."]);
            return;
        }

        // Validação de tipo_pagamento
        if (!isset($_POST['tipo_pagamento']) || empty(trim($_POST['tipo_pagamento']))) {
            echo json_encode(["message" => "Tipo de pagamento inválido."]);
            return;
        }

        $this->venda->id_cliente = $_POST['id_cliente'];
        $this->venda->data_venda = $_POST['data_venda'];
        $this->venda->valor_total = $_POST['valor_total'];
        $this->venda->tipo_pagamento = $_POST['tipo_pagamento'];

        if ($this->venda->create()) {
            echo json_encode(["message" => "Venda criada com sucesso."]);
        } else {
            echo json_encode(["message" => "Falha ao criar a venda."]);
        }
    }

    public function read() {
        $stmt = $this->venda->read();
        $num = $stmt->rowCount();

        if ($num > 0) {
            $vendas_arr = array();
            $vendas_arr["records"] = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $venda_item = array(
                    "id_venda" => $id_venda,
                    "id_cliente" => $id_cliente,
                    "data_venda" => $data_venda,
                    "valor_total" => $valor_total,
                    "tipo_pagamento" => $tipo_pagamento
                );
                array_push($vendas_arr["records"], $venda_item);
            }

            echo json_encode($vendas_arr);
        } else {
            echo json_encode(array("message" => "Nenhuma venda encontrada."));
        }
    }

    public function update() {
        if (isset($_POST['id_venda']) && isset($_POST['id_cliente']) && isset($_POST['data_venda']) && isset($_POST['valor_total']) && isset($_POST['tipo_pagamento'])) {
            // Validação de id_cliente
            if (!is_numeric($_POST['id_cliente']) || $_POST['id_cliente'] <= 0) {
                echo json_encode(["message" => "ID do cliente inválido."]);
                return;
            }

            // Verificação se o cliente existe
            if (!$this->venda->clienteExiste($_POST['id_cliente'])) {
                echo json_encode(["message" => "Cliente não encontrado."]);
                return;
            }

            // Validação de data_venda
            if (strtotime($_POST['data_venda']) === false) {
                echo json_encode(["message" => "Data da venda inválida."]);
                return;
            }

            // Validação de valor_total
            if (!is_numeric($_POST['valor_total']) || $_POST['valor_total'] <= 0) {
                echo json_encode(["message" => "Valor total inválido."]);
                return;
            }

            // Validação de tipo_pagamento
            if (empty(trim($_POST['tipo_pagamento']))) {
                echo json_encode(["message" => "Tipo de pagamento inválido."]);
                return;
            }

            $this->venda->id_venda = $_POST['id_venda'];
            $this->venda->id_cliente = $_POST['id_cliente'];
            $this->venda->data_venda = $_POST['data_venda'];
            $this->venda->valor_total = $_POST['valor_total'];
            $this->venda->tipo_pagamento = $_POST['tipo_pagamento'];

            if ($this->venda->update()) {
                echo json_encode(["message" => "Venda atualizada com sucesso."]);
            } else {
                echo json_encode(["message" => "Falha ao atualizar a venda."]);
            }
        } else {
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function delete() {
        if (isset($_POST['id_venda'])) {
            $this->venda->id_venda = $_POST['id_venda'];

            if ($this->venda->delete()) {
                echo json_encode(["message" => "Venda excluída com sucesso."]);
            } else {
                echo json_encode(["message" => "Falha ao excluir a venda."]);
            }
        } else {
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }
}
?>
