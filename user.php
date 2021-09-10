<?php
require_once "db.php";
class User{
    private $id;
    private $email;
    private $lastlogin;
    private $db_connected;

    function __construct()
    {
        $db=new  DataBaseConn();
        $this->db_connected =$db->getConnection();
    }

    
    public function replace($email,$logintime=null)
    {
        $sql = "UPDATE users SET logintime=:logintime WHERE email=:email";

        $statement = $this->db_connected->prepare($sql);

        try {
            // if email alerady registered
           $row =  $statement->execute([
                    ':email' => $email,
                    ':logintime' => $logintime,
                ]);
            if($row){
                
                // insert a single user
                $sql = 'INSERT INTO users(email,logintime) VALUES(:email,:logintime)';

                $statement = $this->db_connected->prepare($sql);

                
                $statement->execute([
                    ':email' => $email,
                    ':logintime' => $logintime,
                ]);
            }
        } catch (\Throwable $th) {

        }
         
    }

    public function lastlogin($email)
    {
        // select a particular user by id
        $stmt = $this->db_connected->prepare("SELECT * FROM users WHERE email=:email");
        $stmt->execute(['email' => $email]); 
        $user = $stmt->fetch();
        return $user;
    }
}
