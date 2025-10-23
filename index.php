<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Prontuário Médico - Sistema</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      overflow: hidden;
    }
    #menu {
      height: 100vh;
      background-color: #0d6efd;
      color: white;
      padding-top: 30px;
      position: fixed;
      width: 250px;
    }
    #menu h4 {
      text-align: center;
      margin-bottom: 30px;
    }
    #menu a {
      color: white;
      text-decoration: none;
      display: block;
      padding: 10px 20px;
      border-radius: 5px;
      margin: 5px 10px;
    }
    #menu a:hover {
      background-color: rgba(255, 255, 255, 0.2);
    }
    #conteudo {
      margin-left: 250px;
      height: 100vh;
      width: calc(100% - 250px);
      border: none;
    }
  </style>
</head>
<body>

  <div id="menu">
    <h4>🩺 Prontuário Médico</h4>
    <a href="paciente_cadastro.php" target="painel">Cadastrar Paciente</a>
    <a href="prontuario_cadastro.php" target="painel">Cadastrar Prontuário</a>
    <hr style="border-color:white;">
    <a href="index.php" target="_self">Tela Inicial</a>
    <a href="logout.php" target="painel">Sair</a>
  </div>

  <iframe id="conteudo" name="painel" src="paciente_cadastro.php"></iframe>

</body>
</html>
