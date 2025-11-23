<?php
require 'database.php';
$pendentes = $db->query("SELECT * FROM tarefas WHERE concluida = 0 ORDER BY data_vencimento ASC")->fetchAll(PDO::FETCH_ASSOC);
$concluidas = $db->query("SELECT * FROM tarefas WHERE concluida = 1 ORDER BY data_vencimento ASC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Tarefas</title>
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
    margin-top: 40px;
    margin-bottom: 10px;
}
.container {
    width: 80%;
    margin: auto;
}
table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    margin-bottom: 30px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
}
th {
    background: #6a0dad; 
    color: white;
    padding: 12px;
    font-size: 14px;
    text-transform: uppercase;
}
td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
}
tr:hover {
    background: #ffe8d1;
}
.concluida {
    background: #e0d1f7; 
    text-decoration: line-through;
    color: #555;
}
form {
    background: white;
    padding: 20px;
    border-radius: 6px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}
label {
    display: block;
    font-weight: bold;
    color: #6a0dad;
    margin-bottom: 6px;
}
input[type="text"],
input[type="date"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #b38cd9;
    border-radius: 4px;
}
input[type="text"]:focus,
input[type="date"]:focus {
    border-color: #ff7a00;
    outline: none;
}
button {
    background: #ff7a00; 
    color: white;
    border: none;
    padding: 10px 18px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
    transition: 0.3s;
}
button:hover {
    background: #cc6300;
}
.btn-small {
    padding: 6px 12px;
    font-size: 13px;
}
.btn-concluir {
    background: #6a0dad;
}
.btn-concluir:hover {
    background: #4e067f;
}
.btn-excluir {
    background: #ff3b3b;
}
.btn-excluir:hover {
    background: #c72a2a;
}
@media (max-width: 700px) {
    table, tr, td, th {
        font-size: 12px;
    }
    button, .btn-small {
        width: 100%;
        margin-bottom: 8px;
    }
}
     </style>
    <script>
function validarFormulario() {
    const desc = document.getElementById("descricao").value.trim();
    const data = document.getElementById("data").value;

    if (desc === "" || data === "") {
        alert("Preencha todos os campos!");
        return false;
    }
    return true;
}
function confirmarExclusao(id) {
    if (confirm("Deseja realmente excluir esta tarefa?")) {
        window.location.href = "delete_tarefa.php?id=" + id;
    }
}
    </script>

</head>
<body>

<h1>Planilha de tarefas</h1>
<h2>Adicionar Tarefas</h2>

<form action="add_tarefa.php" method="POST" onsubmit="return validarFormulario();">
    <label>Tarefas:</label><br>
    <input type="text" id="descricao" name="descricao" required><br><br>
    <label>Data:</label><br>
    <input type="date" id="data" name="data_vencimento" required><br><br>
    <button type="submit">Adicionar</button>
</form>
<hr>
<h2>Tarefas a serem realizadas</h2>
<?php if (count($pendentes) === 0): ?>
    <p>Nenhuma tarefa pendente.</p>
<?php else: ?>
<table border="1" cellpadding="10">
    <tr>
        <th>Descrição</th>
        <th>Vencimento</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($pendentes as $t): ?>
    <tr>
        <td><?= $t['descricao'] ?></td>
        <td><?= $t['data_vencimento'] ?></td>
        <td>
            <a href="update_tarefa.php?id=<?= $t['id'] ?>">Concluir</a>
            |
            <button onclick="confirmarExclusao(<?= $t['id'] ?>)">Excluir</button>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>
<hr>
<h2>Tarefas Concluídas</h2>
<?php if (count($concluidas) === 0): ?>
    <p>Nenhuma tarefa concluída.</p>
<?php else: ?>
<table border="1" cellpadding="10">
    <tr>
        <th>Descrição</th>
        <th>Vencimento</th>
        <th>Status</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($concluidas as $t): ?>
    <tr>
        <td><?= $t['descricao'] ?></td>
        <td><?= $t['data_vencimento'] ?></td>
        <td>✔ Concluída</td>
        <td>
            <button onclick="confirmarExclusao(<?= $t['id'] ?>)">Excluir</button>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>
</body>
</html>