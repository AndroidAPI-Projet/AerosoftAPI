<?php
    class Aeroport{

        // Connection
        private $conn;

        // Table
        private $db_table = "aeroport";

        // Columns
        public $IdAeroport;
        public $NomAeroport;
        public $NomVilleDesservie;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getAeroport(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getSingleAeroport(){
            $sqlQuery = "SELECT
                        IdAeroport, 
                        NomAeroport, 
                        NomVilleDesservie
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       IdAeroport = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->IdAeroport);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $itemCount = $stmt->rowCount();
            
            if($itemCount > 0){
                
                $this->NomAeroport = $dataRow['NomAeroport'];
                $this->NomVilleDesservie = $dataRow['NomVilleDesservie'];

            }else{
                $this->NomAeroport = "";
                $this->NomVilleDesservie = "";

            }
        }        
    }
    
?>

