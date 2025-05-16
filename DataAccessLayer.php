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

        function getAllColecoes() {
            return $this->fetchAllFromTable("colecao");
        }

        function getAllEventos() {
            return $this->fetchAllFromTable("evento");
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
                $stmt = $this->conn->prepare("INSERT INTO utilizador (nome, data_nascimento, email, password) VALUES (?, STR_TO_DATE(?, '%Y-%m-%d'), ?, ?)");
                $stmt->bind_param("ssss", $nome, $data_nascimento, $email, $senhaHash);
                return $stmt->execute();
            }
            return false;
        }


        function buscarUtilizadorPorEmail($email) {
            $stmt = $this->conn->prepare("SELECT * FROM utilizador WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        }

        function autenticarUtilizador($email, $password) {
            // Preparar a query com bind seguro
            $stmt = $this->conn->prepare("SELECT * FROM utilizador WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();

            $result = $stmt->get_result();
            $utilizador = $result->fetch_assoc();

            // Verifica se encontrou utilizador e se a password confere
            if ($utilizador && password_verify($password, $utilizador['password'])) {
                return $utilizador; // Login válido
            }

            return false; // Falha no login
        }



    }
?>