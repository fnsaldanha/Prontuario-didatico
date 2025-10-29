<?php
// URL da API
$apiUrl = "http://localhost/api.php";

// Faz a requisição GET para a API
$response = file_get_contents($apiUrl);

// Verifica se a resposta é válida
if ($response === FALSE) {
    die("Erro ao acessar a API.");
}

// Converte o JSON em array PHP
$pacientes = json_decode($response, true);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Lista de Pacientes</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f6f8;
        margin: 0;
        padding: 0;
    }
    header {
        background-color: #2c3e50;
        color: #fff;
        text-align: center;
        padding: 20px;
        font-size: 1.5em;
    }
    main {
        margin: 40px auto;
        width: 90%;
        max-width: 1000px;
        background: #fff;
        padding: 20px 30px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 20px;
    }
    th, td {
        border: 1px solid #ccc;
        padding: 10px 12px;
        text-align: left;
    }
    th {
        background-color: #34495e;
        color: #fff;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    tr:hover {
        background-color: #e9f3ff;
    }
    .footer {
        margin-top: 40px;
        text-align: center;
        font-size: 0.9em;
        color: #666;
    }
    .btn-refresh {
        background-color: #2ecc71;
        border: none;
        color: white;
        padding: 10px 20px;
        font-size: 1em;
        border-radius: 5px;
        cursor: pointer;
    }
    .btn-refresh:hover {
        background-color: #27ae60;
    }
</style>
</head>
<body>
<header>
    🏥 Sistema de Prontuário Didático – Lista de Pacientes
</header>
<main>
    <form method="get">
        <button class="btn-refresh" type="submit">🔄 Atualizar Lista</button>
    </form>

    <?php if (!empty($pacientes)): ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Data de Nascimento</th>
            <th>CPF</th>
            <th>Telefone</th>
            <th>Email</th>
        </tr>
        <?php foreach ($pacientes as $p): ?>
        <tr>
            <td><?= htmlspecialchars($p['id']) ?></td>
            <td><?= htmlspecialchars($p['nome']) ?></td>
            <td><?= htmlspecialchars($p['data_nascimento']) ?></td>
            <td><?= htmlspecialchars($p['cpf']) ?></td>
            <td><?= htmlspecialchars($p['telefone']) ?></td>
            <td><?= htmlspecialchars($p['email']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php else: ?>
        <p>Nenhum paciente encontrado.</p>
    <?php endif; ?>
</main>

<div class="footer">
    Desenvolvido para fins educacionais
</div>
</body>
</html>

