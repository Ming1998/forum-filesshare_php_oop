<?php
// reply_delete.php

include_once '../config/database.php';
include_once '../objects/post.php';
include_once '../objects/reply.php';

$database = new Database();
$db = $database->get_connection();

$post = new Post($db);
$reply = new Reply($db);
$reply->post_id = $_GET['post_id'];

if($post ->dedate_num_replies()){
$reply->delete();
}

$database->redirect('post_read.php?post_id='. $reply->post_id);
?>