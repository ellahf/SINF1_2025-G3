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

            if ($sucesso = $this->dal->insertUtilizador($nome, $data_nascimento, $email, $passwordHash)) {
                return "Registo feito!";
            }

            return "Erro ao registar utilizador.";

        }

        public function autenticarUtilizador($email, $password) {
            $utilizadores = $this->dal->getAllUtilizador();

            foreach ($utilizadores as $utilizador) {
                if ($utilizador['email'] === $email && $utilizador['password'] === $password) {
                    return $utilizador;
                }
            }

            return null;
        }

    }

?>