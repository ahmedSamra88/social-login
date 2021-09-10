<?php

class DataBaseConn{
    private $servername= "localhost";
    private $db="google_facebook_login";
    private $username = "root";
    private $password = "";
    private $conn;
    function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->db", $this->username, $this->password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
    }
    public function getConnection(){
        return $this->conn;
    }
    
}
?>