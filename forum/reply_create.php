<?php 
include_once '../config/database.php';
include_once '../objects/post.php';
include_once '../objects/reply.php';

$database = new Database();
$db = $database->get_connection();
 
$reply = new Reply($db);
$post = new Post($db);
if($_POST){
    // set reply property values
    $reply->guest = $_POST['guest'];
    $reply->contact = $_POST['contact'];
    $reply->content = $_POST['content'];
    $reply->post_id = $_GET['post_id'];
    $post->update_num_replies();
    if($reply->create()){
        $database->redirect('post_read.php?post_id='. $reply->post_id);
    }
 
    // if unable to create the reply, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to create reply.</div>";
    }
}

?>