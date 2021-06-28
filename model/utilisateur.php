<?php
    class Utilisateur{

        // Connection
        private $conn;

        // Table
        private $db_table = "utilisateur";

        // Columns
        public $IdUtilisateur;
        public $Mail;
        public $MotDePasse;
        public $Statut;
        public $IdRole;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getUtilisateur(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getSingleUtilisateur(){
            $sqlQuery = "SELECT
                        IdUtilisateur, 
                        Mail, 
                        MotDePasse, 
                        Statut,
                        IdRole
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       IdUtilisateur = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->IdUtilisateur);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $itemCount = $stmt->rowCount();

            if($itemCount > 0){
            
                $this->Mail = $dataRow['Mail'];
                $this->MotDePasse = $dataRow['MotDePasse'];
                $this->Statut = $dataRow['Statut'];
                $this->IdRole = $dataRow['IdRole'];

            }else{

                $this->Mail = "";
                $this->MotDePasse = "";
                $this->Statut = "";
                $this->IdRole = "";
            }
        }     
        
        public function loginUtilisateur() {
            $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE Mail = ?  AND MotDePasse = ? AND Statut = true LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->Mail=htmlspecialchars(strip_tags($this->Mail));
            $this->MotDePasse=htmlspecialchars(strip_tags($this->MotDePasse));

            $stmt->bindParam(1, $this->Mail);
            $stmt->bindParam(2, $this->MotDePasse);
        
            // var_dump($stmt);

            $stmt->execute();
            
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $id = $dataRow['IdUtilisateur'];

            if ($dataRow) {
                $this->IdUtilisateur = $dataRow['IdUtilisateur'];
                $this->Mail = $dataRow['Mail'];
                $this->MotDePasse = $dataRow['MotDePasse'];
                $this->Statut = $dataRow['Statut'];
                $this->IdRole = $dataRow['IdRole'];
            }

            return $id;
        }
    }
    
?>

