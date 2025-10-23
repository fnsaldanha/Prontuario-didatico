<?php
// api.php
// API simples para listar e cadastrar pacientes em formato JSON

header('Content-Type: application/json; charset=utf-8');

// Configuração do banco
$host = 'localhost';
$db   = 'prontuario_medico';
$user = 'SIS';
$pass = 'maloca';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['erro' => 'Falha na conexão com o banco de dados']);
    exit;
}

// Detecta o método HTTP
$metodo = $_SERVER['REQUEST_METHOD'];

// =========================
// MÉTODO GET → LISTAR PACIENTES
// =========================
if ($metodo === 'GET') {
    $stmt = $pdo->query("SELECT id, nome, data_nascimento, cpf, telefone, email FROM pacientes ORDER BY nome ASC");
    $pacientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($pacientes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit;
}

// =========================
// MÉTODO POST → CADASTRAR PACIENTE
// =========================
if ($metodo === 'POST') {
    // Lê o JSON enviado no corpo da requisição
    $dados = json_decode(file_get_contents("php://input"), true);

    if (!isset($dados['nome']) || empty($dados['nome'])) {
        http_response_code(400);
        echo json_encode(['erro' => 'O campo "nome" é obrigatório.']);
        exit;
    }

    // Prepara e executa a inserção
    $sql = "INSERT INTO pacientes (nome, data_nascimento, cpf, telefone, email)
            VALUES (:nome, :data_nascimento, :cpf, :telefone, :email)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nome' => $dados['nome'],
        ':data_nascimento' => $dados['data_nascimento'] ?? null,
        ':cpf' => $dados['cpf'] ?? null,
        ':telefone' => $dados['telefone'] ?? null,
        ':email' => $dados['email'] ?? null,
    ]);

    // Retorna resposta JSON com o ID do novo paciente
    echo json_encode([
        'mensagem' => 'Paciente cadastrado com sucesso!',
        'id' => $pdo->lastInsertId(),
        'dados' => $dados
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit;
}

// =========================
// MÉTODOS NÃO SUPORTADOS
// =========================
http_response_code(405);
echo json_encode(['erro' => 'Método não permitido. Use GET ou POST.']);
exit;
