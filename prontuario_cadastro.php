<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}
?>
<?php
$host = 'localhost';
$db   = 'prontuario_medico';
$user = 'SIS';
$pass = 'maloca';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die('Erro na conexão: ' . $e->getMessage());
}

// INSERÇÃO DE PRONTUÁRIO
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['paciente_id'])) {
    $stmt = $pdo->prepare('INSERT INTO prontuarios (paciente_id, queixa_principal, diagnostico, prescricao, observacoes) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$_POST['paciente_id'], $_POST['queixa_principal'], $_POST['diagnostico'], $_POST['prescricao'], $_POST['observacoes']]);
    $msg = "Prontuário cadastrado com sucesso!";
}

// LISTAGEM DE PACIENTES PARA SELECT
$pacientes = $pdo->query('SELECT id, nome FROM pacientes ORDER BY nome ASC')->fetchAll();

// LISTAGEM DE PRONTUÁRIOS
$prontuarios = $pdo->query('SELECT p.id, pa.nome, p.data_registro, p.queixa_principal, p.diagnostico
                            FROM prontuarios p
                            JOIN pacientes pa ON pa.id = p.paciente_id
                            ORDER BY p.data_registro DESC')->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Cadastro de Prontuário</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">

    <div class="card shadow mb-4">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0">Cadastro de Prontuário</h4>
        </div>
        <div class="card-body">
            <?php if (!empty($msg)): ?>
            <div class="alert alert-success"><?= htmlspecialchars($msg) ?></div>
            <?php endif; ?>
            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Paciente</label>
                    <select name="paciente_id" class="form-select" required>
                        <option value="">Selecione um paciente</option>
                        <?php foreach ($pacientes as $p): ?>
                            <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Queixa Principal</label>
                    <textarea name="queixa_principal" class="form-control" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Diagnóstico</label>
                    <textarea name="diagnostico" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Prescrição</label>
                    <textarea name="prescricao" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Observações</label>
                    <textarea name="observacoes" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-info">Salvar</button>
            </form>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header bg-secondary text-white">
            <h4 class="mb-0">Prontuários Cadastrados</h4>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Paciente</th>
                        <th>Data</th>
                        <th>Queixa Principal</th>
                        <th>Diagnóstico</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($prontuarios as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p['id']) ?></td>
                        <td><?= htmlspecialchars($p['nome']) ?></td>
                        <td><?= htmlspecialchars($p['data_registro']) ?></td>
                        <td><?= htmlspecialchars($p['queixa_principal']) ?></td>
                        <td><?= htmlspecialchars($p['diagnostico']) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
</body>
</html>
