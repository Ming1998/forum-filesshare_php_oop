<?php
//设置时区
date_default_timezone_set("PRC");

class Post{
    //声明属性
    private $conn;
    private $table_name = 'posts';

	public $post_id;
    public $title;
    public $body;
    public $host;
    public $contact;
    public $num_replies;
    public $date;

    //构造器，通过$db建立与数据库的连接
    public function __construct($db){
        $this->conn = $db;
    }
 
    // create post
    function create(){
 
        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    title=:title, body=:body, host=:host, contact=:contact, date=:date";
 
        $stmt = $this->conn->prepare($query);
 
        // posted values      

        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->body=htmlspecialchars(strip_tags($this->body));
        $this->host=htmlspecialchars(strip_tags($this->host));
        $this->contact=htmlspecialchars(strip_tags($this->contact));

        $this->date=date('Y-m-d H:i:s');
 

 
        // bind values 
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":body", $this->body);
        $stmt->bindParam(":host", $this->host);
        $stmt->bindParam(":contact", $this->contact);
        $stmt->bindParam(":date", $this->date);
 
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
 
    }
    function readAll(){
 
    $query = "SELECT
                post_id,title, body, host, contact, date,num_replies
            FROM
                " . $this->table_name . "
            ORDER BY
                date DESC";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
 
    return $stmt;
    }
    function readOne(){
    $query = "SELECT
                post_id,title, body, host, contact, date,num_replies
            FROM
                " . $this->table_name . "
            WHERE
                post_id=".$this->post_id."
            LIMIT 1";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->id);
    $stmt->execute();
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    $this->title = $row['title'];
    $this->body = $row['body'];
    $this->host = $row['host'];
    $this->contact = $row['contact'];
    $this->date = $row['date'];
    return $stmt;
}

    function delete(){
    $query = "DELETE FROM
                " . $this->table_name . "
            WHERE
                post_id=".$this->post_id;//直接改成数字是可以删除的
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
 
    return $stmt;

    }

    //删除评论后相应加减帖子中的评论数量这一属性的值
    function update_num_replies(){ 

     $query = "UPDATE
                " . $this->table_name . "
                SET num_replies=num_replies+1 
                  WHERE post_id=".$_GET['post_id'];
 
     $stmt = $this->conn->prepare( $query );
     $stmt->execute();
     return $stmt;
    }
    function dedate_num_replies(){ 

     $query = "UPDATE
                " . $this->table_name . "
                SET num_replies=num_replies-1 
                  WHERE post_id=".$_GET['post_id'];
 
     $stmt = $this->conn->prepare( $query );
     $stmt->execute();
     return $stmt;
    }

    function update(){
 
        //write query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    title=:title, body=:body, host=:host, contact=:contact, date=:date
                WHERE post_id=:post_id";
 
        $stmt = $this->conn->prepare($query);
 
        // posted values      

        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->body=htmlspecialchars(strip_tags($this->body));
        $this->host=htmlspecialchars(strip_tags($this->host));
        $this->contact=htmlspecialchars(strip_tags($this->contact));

        $this->date=date('Y-m-d H:i:s');
 

 
        // bind values 
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":body", $this->body);
        $stmt->bindParam(":host", $this->host);
        $stmt->bindParam(":contact", $this->contact);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":post_id", $this->post_id);
 
    if($stmt->execute()){
        return true;
    } 
    return false;
    }

}

?>