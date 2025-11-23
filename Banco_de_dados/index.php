<?php
require 'database.php';

$livros = $db->query("SELECT * FROM livros ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <link rel="stylesheet" href="style.css">
<style>
body {
    font-family: Arial, Helvetica, sans-serif;
    background: #f5f0ff;
    margin: 0;
    padding: 20px;
}
h1 {
    text-align: center;
    color: #6a0dad; 
    margin-bottom: 30px;
}
h2 {
    color: #6a0dad;
    margin-top: 20px;
}
table {
    width: 80%;
    margin: 0 auto 30px auto;
    border-collapse: collapse;
    background: white;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
}
th {
    background: #6a0dad;
    color: white;
    padding: 10px;
    text-transform: uppercase;
}
td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
}
tr:hover {
    background: #ffe8d1;
}
form {
    width: 70%;
    margin: 0 auto 25px auto;
    background: white;
    padding: 20px;
    border-radius: 8px;
}
button {
    background: #ff7a00;
    color: white;
    padding: 10px 18px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
    transition: 0.3s;
}
button:hover {
    background: #cc6300;
}
.btn-excluir {
    background: #ff7a00;
}
.btn-excluir:hover {
    background: #cc6300;
}
</style>
<head>
    <meta charset="UTF-8">
    <title>Livraria - Banco de Dados</title>
</head>
<body>

<h1>Livraria</h1>
<h2>Adicionar Livro</h2>
<form action="add_book.php" method="POST">
    <label>Título:</label><br>
    <input type="text" name="titulo" required><br><br>

    <label>Autor:</label><br>
    <input type="text" name="autor" required><br><br>

    <label>Ano:</label><br>
    <input type="number" name="ano" required><br><br>

    <button type="submit">Adicionar</button>
</form>

<hr>

<h2>Livros Cadastrados</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Autor</th>
        <th>Ano</th>
        <th>Ação</th>
    </tr>

    <?php foreach ($livros as $livro): ?>
        <tr>
            <td><?= $livro['id']; ?></td>
            <td><?= $livro['titulo']; ?></td>
            <td><?= $livro['autor']; ?></td>
            <td><?= $livro['ano']; ?></td>
            <td>
                <a href="delete_book.php?id=<?= $livro['id']; ?>" 
                   onclick="return confirm('Excluir este livro?');">
                   Excluir
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>