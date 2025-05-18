 <?php     
    class DAL {
        private $conn;

        function __construct() {
            $this->conn = new mysqli('localhost', 'root', '', 'sinf1_g3');
            if ($this->conn->connect_error) {
                die("Erro de conexão: " . $this->conn->connect_error);
            }
        }

        function __destruct() {
            if ($this->conn) {
                $this->conn->close();
            }
        }

        private function fetchAllFromTable($tableName) {
            $stmt = $this->conn->prepare("SELECT * FROM $tableName");
            if ($stmt) {
                $stmt->execute();
                $result = $stmt->get_result();
                return $result->fetch_all(MYSQLI_ASSOC);
            }
            return null;
        }

        function getAllUtilizador() {
            return $this->fetchAllFromTable("utilizador");
        }

        function getAllEventos() {
            return $this->fetchAllFromTable("evento");
        }

        function getAllColecoes() {
            return $this->fetchAllFromTable("colecao");
        }

        function getAllItens() {
            return $this->fetchAllFromTable("item");
        }

        function getAllClassificacaoEvento() {
            return $this->fetchAllFromTable("classificacao_evento");
        }

        function criarUtilizador($nome, $data_nascimento, $email, $password) {
            if ($this->conn) {
                $senhaHash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $this->conn->prepare("
                    INSERT INTO utilizador (nome, data_nascimento, email, passw)
                    VALUES (?, STR_TO_DATE(?, '%Y-%m-%d'), ?, ?)
                ");
                $stmt->bind_param("ssss", $nome, $data_nascimento, $email, $senhaHash);

                if ($stmt->execute()) {
                    return $this->conn->insert_id; // retorna o ID do novo utilizador
                }
            }
            return false;
        }

        function autenticarUtilizador($email, $password) {
            $stmt = $this->conn->prepare("SELECT * FROM utilizador WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result && $user = $result->fetch_assoc()) {
                if (password_verify($password, $user['passw'])) {
                    return $user; // Login bem-sucedido
                }
            }
            return false; // Falha
        }

        function criarEvento($nome, $descricao, $localizacao, $data, $imagem, $colecoes_id) {
            if ($this->conn) {
                $stmt = $this->conn->prepare("
                    INSERT INTO evento (nome, descricao, localizacao, data, imagem, colecoes_id, utilizador_id) 
                    VALUES (?, ?, ?, STR_TO_DATE(?, '%Y-%m-%d'), ?, ?, ?)
                ");
                $stmt->bind_param("sssssi", $nome, $descricao, $localizacao, $data, $imagem, $colecoes_id);
                return $stmt->execute();
            }
            return false;
        }

        function deletarEvento($colecoes_id) {
            if ($this->conn) {
                $stmt = $this->conn->prepare("DELETE FROM evento WHERE id = ?");
                $stmt->bind_param("i", $colecoes_id);
                return $stmt->execute();
            }
            return false;
        }

        function criarColecao($nome, $tipo, $imagem) {
            if ($this->conn) {
                $stmt = $this->conn->prepare("
                    INSERT INTO colecao (nome, tipo, imagem) 
                    VALUES (?, ?, ?)
                ");
                $stmt->bind_param("sss", $nome, $tipo, $imagem);
                return $stmt->execute();
            }
            return false;
        }

        function deletarColecao($colecao_id) {
            if ($this->conn) {
                $stmt = $this->conn->prepare("DELETE FROM colecao WHERE colecoes_id = ?");
                $stmt->bind_param("i", $colecao_id);
                return $stmt->execute();
            }
            return false;
        }

        function editarColecao($colecoes_id, $nome, $tipo, $imagem = null) {
            if ($this->conn) {
                if ($imagem) {
                    $stmt = $this->conn->prepare("UPDATE colecao SET nome = ?, tipo = ?, imagem = ? WHERE colecoes_id = ?");
                    $stmt->bind_param("sssi", $nome, $tipo, $imagem, $colecoes_id);
                } else {
                    $stmt = $this->conn->prepare("UPDATE colecao SET nome = ?, tipo = ? WHERE colecoes_id = ?");
                    $stmt->bind_param("ssi", $nome, $tipo, $colecoes_id);
                }

                return $stmt->execute();
            }
            return false;
        }



    }
?>