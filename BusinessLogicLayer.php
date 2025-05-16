<?php
    include "DataAccessLayer.php";
    
    class BLL {
        private $dal;

        function __construct() {
            $this->dal = new DAL();
        }

        function registarUtilizador($nome, $data_nascimento, $email, $password) {
            // Verifica se o email já existe
            $utilizadores = $this->dal->getAllUtilizador();
            foreach ($utilizadores as $u) {
                if ($u['email'] === $email) {
                    return "Este email já está registado.";
                }
            }

            // Verifica se a password tem pelo menos 6 caracteres
            if (strlen($password) < 6) {
                return "A palavra-passe deve ter pelo menos 6 caracteres.";
            }

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            if ($sucesso = $this->dal->criarUtilizador($nome, $data_nascimento, $email, $passwordHash)) {
                return "Registo feito!";
            }

            return "Erro ao registar utilizador.";

        }

        public function obterUtilizadorPorEmail($email) {
            // Conectar à base de dados (ajusta esta parte conforme tua conexão)
            $conn = new mysqli("localhost", "teu_usuario", "tua_senha", "nome_da_base");

            if ($conn->connect_error) {
                die("Conexão falhou: " . $conn->connect_error);
            }

            // Preparar a query para evitar SQL Injection
            $stmt = $conn->prepare("SELECT * FROM utilizadores WHERE email = ?");
            if (!$stmt) {
                die("Erro na preparação da query: " . $conn->error);
            }

            $stmt->bind_param("s", $email);
            $stmt->execute();

            $result = $stmt->get_result();
            $utilizador = $result->fetch_assoc();

            $stmt->close();
            $conn->close();

            return $utilizador; // array com dados do utilizador ou null se não encontrar
        }


        public function fazerLogin($email, $password) {
            session_start();

            $dal = new DAL();
            $utilizador = $dal-> obterUtilizadorPorEmail($email);

            if ($utilizador && password_verify($password, $utilizador["password"])) {
                $_SESSION["email"] = $email;
                return true;
            }
            return false;
        }

    }

?>