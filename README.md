# Prontuário Didático 🏥 

Este projeto é um **prontuário médico simples**, desenvolvido com **PHP**, **MySQL** e **HTML/CSS**, com o objetivo de **demonstrar os elementos básicos da programação web** para estudantes da área da saúde.

---

## 🎯 Objetivo Educacional

O **Prontuário Didático** foi criado como material de apoio para disciplinas de **Informática em Saúde**, permitindo que alunos compreendam de forma prática:
- O funcionamento de um servidor web;
- A estrutura de uma aplicação PHP;
- O uso de banco de dados relacional (MySQL);
- Conceitos de variáveis, formulários, autenticação e CRUD (Create, Read, Update, Delete).

---

## 🧱 Estrutura do Projeto

```
/prontuario-didatico
│
├── index.php                # Página inicial com menu e iframes
├── login.php                # Tela de autenticação
├── logout.php               # Encerramento da sessão
├── cadastro_paciente.php    # Cadastro e listagem de pacientes
├── cadastro_prontuario.php  # Cadastro e listagem de prontuários
├── conexao.php              # Conexão com o banco de dados MySQL
├── api.php                  # Demonstração de API
├── Listar_pacientes.php     # Consome a api.php e gera uma lista
└── README.md                # Este arquivo
```

---

## ⚙️ Requisitos

- **Servidor Apache**
- **PHP 8+**
- **MySQL 8+**
- Sistema operacional Linux (Debian recomendado)

---

## 🚀 Instalação

1. **Instale os pacotes necessários:**
   ```bash
   sudo apt update
   sudo apt install apache2 php libapache2-mod-php php-mysql mysql-server -y
   ```

2. **Clone o repositório:**
   ```bash
   git clone https://github.com/seuusuario/prontuario-didatico.git
   ```

3. **Copie os arquivos para o servidor web:**
   ```bash
   sudo cp -r prontuario-didatico /var/www/html/
   ```

4. **Crie o banco de dados e tabelas:**
   ```sql
   CREATE DATABASE prontuario_medico;
   USE prontuario_medico;

   CREATE TABLE pacientes (
     id INT AUTO_INCREMENT PRIMARY KEY,
     nome VARCHAR(100),
     data_nascimento DATE,
     cpf VARCHAR(14)
   );

   CREATE TABLE prontuarios (
     id INT AUTO_INCREMENT PRIMARY KEY,
     paciente_id INT,
     descricao TEXT,
     data DATETIME DEFAULT CURRENT_TIMESTAMP,
     FOREIGN KEY (paciente_id) REFERENCES pacientes(id)
   );
   ```

5. **Acesse no navegador:**
   ```
   http://localhost/prontuario-didatico
   ```

---

## 🔐 Credenciais Padrão

| Usuário | Senha  |
|----------|--------|
| admin    | admin |

---

## 🧠 Conteúdos Didáticos Envolvidos

- Estrutura de um servidor web (Apache + PHP + MySQL)
- Conexão com banco de dados
- Criação de formulários e envio de dados
- Estrutura de autenticação simples
- Exibição dinâmica de dados em tabelas HTML

---

## 👨‍🏫 Autor

**Fabiano Francisco Noetzold Saldanha**  
Setor de Tecnologia da Informação e Saúde Digital – HUB/UnB  
Projeto criado para fins educacionais na disciplina **Tecnologias de Informação e Comunicação em Saúde**.

---

## 📄 Licença

Este projeto é de uso **didático e livre** para fins educacionais.
