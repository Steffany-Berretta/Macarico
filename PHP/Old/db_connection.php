<?php
$servername = "localhost";
$username = "root";
$password = ""; // Deixe em branco se você não tiver definido uma senha
$dbname = "macarico_db";

// Criar a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Definir o charset
$conn->set_charset("utf8");

// Função para fechar a conexão (opcional)
function closeConnection($conn) {
    $conn->close();
}
?>
