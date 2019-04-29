<?php
// post_delete.php
include_once '../config/database.php';
include_once '../objects/post.php';
include_once '../objects/reply.php';

$database = new Database();
$db = $database->get_connection();

$post = new Post($db);
$reply = new Reply($db);

$post->post_id = $_POST['post_id'];
$reply->post_id = $_POST['post_id'];

//由于数据库中存在外键束缚，必须先删除帖子的评论才能删除帖子
if($reply->delete_with_post()){
     if($post->delete()){
     echo json_encode('post_reply_succuss');
}
else{
	 echo json_encode('reply_failed');
}
}

?>