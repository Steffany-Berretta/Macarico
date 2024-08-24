<?php
$servername = "localhost";
$username = "root";
$password = ""; // Deixe em branco se você não tiver definido uma senha
$dbname = "Macarico_DB";

// Criar a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
