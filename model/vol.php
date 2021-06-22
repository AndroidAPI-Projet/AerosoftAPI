<?php
    class Vol{

        // Connection
        private $conn;

        // Table
        private $db_table = "vol";

        // Columns
        public $NumVol;
        public $AeroportDept;
        public $HDepart;
        public $AeroportArr;
        public $HArrivee;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getVol(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createVol(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        NumVol = :NumVol,
                        AeroportDept = :AeroportDept, 
                        HDepart = :HDepart, 
                        AeroportArr = :AeroportArr,
                        HArrivee = :HArrivee";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->NumVol=htmlspecialchars(strip_tags($this->NumVol));
            $this->AeroportDept=htmlspecialchars(strip_tags($this->AeroportDept));
            $this->HDepart=htmlspecialchars(strip_tags($this->HDepart));
            $this->AeroportArr=htmlspecialchars(strip_tags($this->AeroportArr));
            $this->HArrivee=htmlspecialchars(strip_tags($this->HArrivee));
        
            // bind data
            $stmt->bindParam(":NumVol", $this->NumVol);
            $stmt->bindParam(":AeroportDept", $this->AeroportDept);
            $stmt->bindParam(":HDepart", $this->HDepart);
            $stmt->bindParam(":AeroportArr", $this->AeroportArr);
            $stmt->bindParam(":HArrivee", $this->HArrivee);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // Single
        public function getSingleVol(){
            $sqlQuery = "SELECT
                        NumVol, 
                        AeroportDept, 
                        HDepart, 
                        AeroportArr, 
                        HArrivee
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       NumVol = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->NumVol);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $itemCount = $stmt->rowCount();

            if($itemCount > 0){
            
                $this->AeroportDept = $dataRow['AeroportDept'];
                $this->HDepart = $dataRow['HDepart'];
                $this->AeroportArr = $dataRow['AeroportArr'];
                $this->HArrivee = $dataRow['HArrivee'];

            }else{

                $this->AeroportDept = "";
                $this->HDepart = "";
                $this->AeroportArr = "";
                $this->HArrivee = "";
            }
        }        

        // UPDATE
        public function updateVol(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        AeroportDept = :AeroportDept, 
                        HDepart = :HDepart, 
                        AeroportArr = :AeroportArr, 
                        HArrivee = :HArrivee
                    WHERE 
                        NumVol = :NumVol";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->AeroportDept=htmlspecialchars(strip_tags($this->AeroportDept));
            $this->HDepart=htmlspecialchars(strip_tags($this->HDepart));
            $this->AeroportArr=htmlspecialchars(strip_tags($this->AeroportArr));
            $this->HArrivee=htmlspecialchars(strip_tags($this->HArrivee));
            $this->NumVol=htmlspecialchars(strip_tags($this->NumVol));
        
            // bind data
            $stmt->bindParam(":AeroportDept", $this->AeroportDept);
            $stmt->bindParam(":HDepart", $this->HDepart);
            $stmt->bindParam(":AeroportArr", $this->AeroportArr);
            $stmt->bindParam(":HArrivee", $this->HArrivee);
            $stmt->bindParam(":NumVol", $this->NumVol);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteVol(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE NumVol = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->NumVol=htmlspecialchars(strip_tags($this->NumVol));
        
            $stmt->bindParam(1, $this->NumVol);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>

