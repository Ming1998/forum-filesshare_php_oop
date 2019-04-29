<?php 
include_once '../config/database.php';
include_once '../objects/post.php';
include_once '../layout/layout_nav.html';
$database = new Database();
$db = $database->get_connection();
 
$post = new Post($db);

$post->post_id = $_GET['post_id'];
$post->readOne();

$page_title = "发贴";
include_once "../layout/layout_header.php";
 
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right'>Read posts</a>";
echo "</div>";

?>
<?php

if($_POST){
    // set post property values
    $post->title = $_POST['title'];
    $post->body = $_POST['body'];
    $post->host = $_POST['host'];
    $post->contact = $_POST['contact'];



    // create the post
    if($post->update()){
        $database->redirect('post_read.php?post_id='. $post->post_id);
    }
 
    // if unable to create the post, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to update post.</div>";
    }
}

?>
<h2>发帖教/学</h2>
<form method="post" class="form-group">
            <label for="title">标题</label>
            <input class="form-control" name="title" id="title" value="<?php echo $post->title ?>" />
            <br>
    
            <label for="body">正文</label>
            <textarea class="form-control" name="body" id="body"><?php echo $post->body ?></textarea>
            <br>
        
            <label for="host">昵称</label>
            <input class="form-control" name="host" id="host" value="<?php echo $post->host ?>" />
            <br>

            <label for="contact">联系方式</label>
            <input class="form-control" name="contact" id="contact" value="<?php echo $post->contact ?>" />
            <br>
            <input type="submit" value="保存" class="btn btn-primary"/></td>
        
</form>
<?php
include_once '../layout/layout_footer.php';
?>