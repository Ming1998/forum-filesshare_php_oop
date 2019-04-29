<?php 
include_once '../config/database.php';
include_once '../objects/post.php';
include_once '../layout/layout_nav.html';
$database = new Database();
$db = $database->get_connection();
 
$post = new Post($db);

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
    if($post->create()){
        $database->redirect('index.php');
    }
 
    // if unable to create the post, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to create post.</div>";
    }
}

?>

<h2>发帖教/学</h2>
<form method="post" class="form-group" enctype="multipart/form-data">
    
    
            <label for="title" >标题</label>
            <input type="text" name="title" id="title"  class="form-control" placeholder="【教/学】+科目+自由编辑内容" />
            <br>

            <label for="body">正文</label>
            <textarea name="body" id="body"  class="form-control"></textarea>
            <br>
            
            <label for="host">昵称</label>
            <input name="host" id="host"  class="form-control"/>
            <br>  

            <label for="contact">联系方式</label>
            <input name="contact" id="contact"  class="form-control"/>
            <br>

            <input type="submit" value="提交"  class="btn btn-primary"/>
            <input type="reset"  value="重置"  class="btn btn-danger"/>
</form>
<?php

include_once '../layout/layout_footer.php';
?>