<?php
// Caminho corrigido para incluir o arquivo de configuração do banco de dados
include_once 'config/db.php';

// Instancia a classe Database
$database = new Database();
$db = $database->getConnection();

// Verifica se a conexão foi estabelecida com sucesso
if($db) {
    echo "Conexão com o banco de dados estabelecida com sucesso!";
} else {
    echo "Falha na conexão com o banco de dados.";
}
?>
