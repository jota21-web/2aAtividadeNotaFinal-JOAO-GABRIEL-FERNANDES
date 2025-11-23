<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "tarefas";
try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->exec("
        CREATE TABLE IF NOT EXISTS tarefas (
            id INT AUTO_INCREMENT PRIMARY KEY,
            descricao VARCHAR(255) NOT NULL,
            data_vencimento DATE NOT NULL,
            concluida TINYINT(1) DEFAULT 0
        )
    ");
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>
