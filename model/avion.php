<?php
    class Avion{

        // Connection
        private $conn;

        // Table
        private $db_table = "avion";

        // Columns
        public $NumAvion;
        public $TypeAvion;
        public $BaseAeroport;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getAvion(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getSingleAvion(){
            $sqlQuery = "SELECT
                        NumAvion, 
                        TypeAvion, 
                        BaseAeroport
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       NumAvion = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->NumAvion);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $itemCount = $stmt->rowCount();

            if($itemCount > 0){
            
                $this->TypeAvion = $dataRow['TypeAvion'];
                $this->BaseAeroport = $dataRow['BaseAeroport'];

            }else{

                $this->TypeAvion = "";
                $this->BaseAeroport = "";
            }
        }        
    }
    
?>

