<?php
class database{
  private $host="localhost";
  private $db_name="woshi";
  private $username="root";
  private $password="";
  public $conn;

    public function get_connection(){
  
        $this->conn = null;
  
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        }
        catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
  
        return $this->conn;
    }
    public function redirect($uri) {
        header('location:'.$uri);
        exit;
    }

}
?>
