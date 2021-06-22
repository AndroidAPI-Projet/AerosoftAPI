<?php
    class Pilote{

        // Connection
        private $conn;

        // Table
        private $db_table = "pilote";

        // Columns
        public $IdPilote;
        public $NomPilote;
        public $PrenomPilote;
        public $Matricule;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getPilote(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getSinglePilote(){
            $sqlQuery = "SELECT
                        IdPilote, 
                        NomPilote, 
                        PrenomPilote, 
                        Matricule
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       IdPilote = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->IdPilote);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $itemCount = $stmt->rowCount();

            if($itemCount > 0){
            
                $this->NomPilote = $dataRow['NomPilote'];
                $this->PrenomPilote = $dataRow['PrenomPilote'];
                $this->Matricule = $dataRow['Matricule'];

            }else{

                $this->NomPilote = "";
                $this->PrenomPilote = "";
                $this->Matricule = "";
            }
        }        
    }
    
?>

