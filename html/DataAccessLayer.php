 <?php   
    class DAL {
        private $conn;
        function __construct() {
            $this->conn = new mysqli('localhost', 'root', '', 'sinf1_g3');
        }

        function getAllUtilizador() {
            if($this->conn) {
                $recordset = $this->conn->query("SELECT * FROM utilizador");
                $dataset = $recordset->fetch_all(MYSQLI_ASSOC);
                $this->conn->close();
                return $dataset;
            }
            return null;
        }

        function getAllColecoes() {
            if($this->conn) {
                $recordset = $this->conn->query("SELECT * FROM colecao");
                $dataset = $recordset->fetch_all(MYSQLI_ASSOC);
                $this->conn->close();
                return $dataset;
            }
            return null;
        }

        function getAllEventos() {
            if($this->conn) {
                $recordset = $this->conn->query("SELECT * FROM evento");
                $dataset = $recordset->fetch_all(MYSQLI_ASSOC);
                $this->conn->close();
                return $dataset;
            }
            return null;
        }

        function getAllItens() {
            if($this->conn) {
                $recordset = $this->conn->query("SELECT * FROM item");
                $dataset = $recordset->fetch_all(MYSQLI_ASSOC);
                $this->conn->close();
                return $dataset;
            }
            return null;
        }

        function getAllClassificacaoEvento() {
            if($this->conn) {
                $recordset = $this->conn->query("SELECT * FROM classificacao_evento");
                $dataset = $recordset->fetch_all(MYSQLI_ASSOC);
                $this->conn->close();
                return $dataset;
            }
            return null;
        }
    }
?>