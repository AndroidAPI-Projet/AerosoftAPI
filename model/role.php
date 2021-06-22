<?php
    class Role{

        // Connection
        private $conn;

        // Table
        private $db_table = "roles";

        // Columns
        public $IdRole;
        public $RoleNom;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getRole(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getSingleRole(){
            $sqlQuery = "SELECT
                        IdRole, 
                        RoleNom
                      FROM
                        ". $this->db_table ."
                    WHERE 
                    IdRole = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->IdRole);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $itemCount = $stmt->rowCount();

            if($itemCount > 0){
            
                $this->RoleNom = $dataRow['RoleNom'];

            }else{

                $this->RoleNom = ""; 
            }
        }        
    }
    
?>

