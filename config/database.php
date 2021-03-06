<?php 
    class Database {
        private $host = "127.0.0.1";
        private $database_name = "aerosoft";
        private $username = "root";
        private $password = "";

        public $conn;

        public function getConnection(){
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Nous n'avons pas pu nous connecter à la base de données: " . $exception->getMessage();
            }
            return $this->conn;
        }
    }  
?>