<?php

class File{

    private $conn;
    private $table_name = 'files';

	public $file_id;
    public $uploader;
    public $subject;
    public $title;
    public $file;

    public function __construct($db){
        $this->conn = $db;
    }
 
    // create product
    function create(){
 
        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    uploader=:uploader, subject=:subject, title=:title, file=:file";
 
        $stmt = $this->conn->prepare($query);
 
        // posted values      

        $this->uploader=htmlspecialchars(strip_tags($this->uploader));
        $this->subject=htmlspecialchars(strip_tags($this->subject));
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->file=htmlspecialchars(strip_tags($this->file));
 

 
        // bind values 
        $stmt->bindParam(":uploader", $this->uploader);
        $stmt->bindParam(":subject", $this->subject);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":file", $this->file);
 
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
 
    }

    function read(){
    $query = "SELECT*
    FROM
        " . $this->table_name;
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
 
    return $stmt;
    }

    function search($subject){
    $query = "SELECT*
    FROM
        " . $this->table_name."
    WHERE subject LIKE ".$subject;
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
 
    return $stmt;
    }

}


?>