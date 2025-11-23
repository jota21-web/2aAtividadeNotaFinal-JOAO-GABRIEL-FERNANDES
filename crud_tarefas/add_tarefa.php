<?php
require 'database.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = $_POST['descricao'];
    $data = $_POST['data_vencimento'];
    $stmt = $db->prepare("INSERT INTO tarefas (descricao, data_vencimento) VALUES (?, ?)");
    $stmt->execute([$descricao, $data]);
    header("Location: index.php");
    exit;
}
?>
