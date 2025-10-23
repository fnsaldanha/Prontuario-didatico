CREATE DATABASE prontuario_medico CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE prontuario_medico;

CREATE TABLE pacientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    data_nascimento DATE,
    cpf VARCHAR(20) UNIQUE,
    telefone VARCHAR(20),
    email VARCHAR(100)
);

CREATE TABLE prontuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    paciente_id INT NOT NULL,
    data_registro DATETIME DEFAULT CURRENT_TIMESTAMP,
    queixa_principal TEXT,
    diagnostico TEXT,
    prescricao TEXT,
    observacoes TEXT,
    FOREIGN KEY (paciente_id) REFERENCES pacientes(id)
);
