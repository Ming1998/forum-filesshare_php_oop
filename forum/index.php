<?php
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/post.php';
include_once '../objects/reply.php';
include_once '../layout/layout_nav.html';

$database = new Database();
$db = $database->get_connection();
 
$post = new post($db);
$reply = new reply($db);


$stmt = $post->readAll();
$num = $stmt->rowCount();
$page_title = "我师论坛";
include_once "../layout/layout_header.php";
 
echo '<div class="row">';
echo '<div class="col-10"><em >发帖教/学 格式：【教/学】+科目+自由编辑内容</em> </div>';
echo '<div class="col-2"><a class="btn btn-primary" href="post_create.php">+ 发帖</a></div><hr/>';

echo '</div><br>';

if($num>0){
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);//这一步意义何在？

    	echo '<div class="card"><div class="card-body">';
        echo '<h2>'.$row['title'].'</h2>';
        
        $body = substr($row['body'], 0, 300);//从body里截取300字
        echo nl2br($body).'...<br/>';//把这300字插把\n换成<br>
        echo '<a class="btn btn-outline-success" href="post_read.php?post_id='.$row['post_id'].'">更多</a>  ';//点击按钮跳转到post_view
        echo '<a class="btn btn-outline-warning" href="post_read.php?post_id='.$row['post_id'].'#replies">'.$row['num_replies'].'回复</a>';  //有个数量  
        echo '</div></div>';
    }
}
else{
	echo '没有想教或者想学的同学吗~';
}

include_once "../layout/layout_footer.php";
?>