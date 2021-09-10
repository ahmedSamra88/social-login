<?php

class DataBaseConn{
    private $servername= "sql11.freemysqlhosting.net:3306";
    private $db="sql11436229";
    private $username = "sql11436229";
    private $password = "BM2Q8Im6qN";
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
