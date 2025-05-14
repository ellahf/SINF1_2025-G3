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
    }
?>