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

        function obterTodasColecoes() {
            return $this->dal->getAllColecoes();
        }

        function setDropBoxOptionsColecao() {
            try {
                $colecoes = $this->dal->getAllColecoes();
                foreach ($colecoes as $colecao) {
                    echo "<option value='" . $colecao["colecoes_id"] . "'>" . $colecao["nome"] . "</option>";
                }
            } catch (RuntimeException $e) {
                echo "<option value='ERR'>" . $e->getMessage() . "</option>";
            }
        }

        function obterTodosEventos() {
            return $this->dal->getAllEventos();
        }

        function criarColecao($nome, $tipo, $imagem) {
            return $this->dal->criarColecao($nome, $tipo, $imagem);
        }


        function apagarColecao($colecoes_id) {
            return $this->dal->deletarColecao($colecoes_id);
        }

        function editarColecao($colecao_id, $nome, $tipo, $imagem = null) {
            return $this->dal->editarColecao($colecao_id, $nome, $tipo, $imagem);
        }

        function setDropBoxOptionsEventos() {
            try {
                $eventos = $this->dal->getAllEventos(); 
                foreach ($eventos as $evento) {
                    echo "<option value='" . $evento["evento_id"] . "'>" . $evento["nome"] . "</option>";
                }
            } catch (RuntimeException $e) {
                echo "<option value='ERR'>" . $e->getMessage() . "</option>";
            }
        }

        function ordenarColecaoPorNome(array &$colecoes, string $campo = 'nome'): void {
            usort($colecoes, function($a, $b) use ($campo) {
                return strcmp($a[$campo], $b[$campo]);
            });
        }

        function criarEvento($nome, $descricao, $localizacao, $data, $imagem, $colecoes_id) {
            return $this->dal->criarEvento($nome, $descricao, $localizacao, $data, $imagem, $colecoes_id);
        }

        function apagarEvento($evento_id) {
            return $this->dal->deletarEvento($evento_id);
        }

        function obterNomeColecaoPorId($colecao_id) {
            return $this->dal->obterNomeColecaoPorId($colecao_id);
        }

        public function editarEvento($evento_id, $nome, $descricao, $data, $localizacao, $colecoes_id, $imagem = null) {
            return $this->dal->editarEvento($evento_id, $nome, $descricao, $data, $localizacao, $colecoes_id, $imagem);
        }

        public function criarItem($colecao_id, $nome, $descricao, $importancia, $peso, $preco, $data_aquisicao, $imagem) {
            return $this->dal->criarItem($colecao_id, $nome, $descricao, $importancia, $peso, $preco, $data_aquisicao, $imagem);
        }

        public function obterTodosItens() {
            return $this->dal->getAllItens();
        }

        public function editarItem($item_id, $colecao_id, $nome, $descricao, $importancia, $peso, $preco, $data_aquisicao, $imagem = null) {
            return $this->dal->editarItem($item_id, $colecao_id, $nome, $descricao, $importancia, $peso, $preco, $data_aquisicao, $imagem);
        }

        function apagarItem($item_id) {
            return $this->dal->deletarItem($item_id);
        }

        function setDropBoxOptionsItens() {
            try {
                $itens = $this->dal->getAllItens(); 
                foreach ($itens as $item) {
                    echo "<option value='" . $item["item_id"] . "'>" . $item["nome"] . "</option>";
                }
            } catch (RuntimeException $e) {
                echo "<option value='ERR'>" . $e->getMessage() . "</option>";
            }
        }

    }

?>