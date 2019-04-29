<?php

class Reply{

    private $conn;
    private $table_name = 'replies';

	public $reply_id;
    public $post_id;
    public $guest;
    public $contact;
    public $content;
    public $date;

    public function __construct($db){
        $this->conn = $db;
    }
 
    // create reply
    function create(){
 
        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    post_id=:post_id,guest=:guest, content=:content, contact=:contact, date=:date";
 
        $stmt = $this->conn->prepare($query);


        // posted values      
        $this->post_id=htmlspecialchars(strip_tags($this->post_id));
        $this->guest=htmlspecialchars(strip_tags($this->guest));
        $this->content=htmlspecialchars(strip_tags($this->content));
        $this->contact=htmlspecialchars(strip_tags($this->contact));

        $this->date=date('Y-m-d H:i:s',time());


 
        // bind values 
        $stmt->bindParam(":post_id", $this->post_id);
        $stmt->bindParam(":guest", $this->guest);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":contact", $this->contact);
        $stmt->bindParam(":date", $this->date);
 
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }

 
    }
    function read(){//不管有没有统配选择器*貌似都能正常run
    $query = "SELECT*
                FROM
                    " . $this->table_name . "
                WHERE 
                   post_id = ".$_GET['post_id']."
                ORDER BY
                    date";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
 
    return $stmt;
    }

    function delete(){
    $query = "DELETE FROM
                " . $this->table_name . "
            WHERE
                reply_id=".$_GET['reply_id'];
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
 
    return $stmt;

    }
    function delete_with_post(){
    $query = "DELETE FROM
                " . $this->table_name . "
            WHERE
                post_id=".$this->post_id;
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
 
    return $stmt;

    }

}


?>