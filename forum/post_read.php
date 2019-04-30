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

$post->post_id=$_GET['post_id'];

$post_stmt = $post->readOne();
$post_num = $post_stmt->rowCount();//rowcount是POD对象执行query函数后得到的数据的行数

$reply_stmt = $reply->read();
$reply_num = $reply_stmt->rowCount();



$page_title = "我师论坛";
include_once "../layout/layout_header.php";


//打印帖子
if($post_num>0) {
   $row = $post_stmt->fetch(PDO::FETCH_ASSOC);

echo '<h2>'.$post->title.'</h2>';
echo '<h5>'.$post->host.'</h5>';
echo '<em>Posted '.$post->date.'</em><br><hr>';
echo '通过'.$post->contact.'联系我'.'<br>';
echo nl2br($post->body).'<br/>';
echo '<br>
    <a class="btn btn-outline-success" href="post_update.php?post_id='.$_GET['post_id'].'">编辑</a>  
    <button class="btn btn-outline-danger" id='.$_GET['post_id'].'>删除</button>  
    <a class="btn btn-outline-info" href="index.php">返回论坛</a>';
}
else{
	echo '帖子 #'.$_GET['post_id'].' 不见了';
}


//如果已有评论就打印评论，评论这一块代码写得很一般
echo '<ol id="replies" class="list-group">';

 while($row1 = $reply_stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '<li id="post-'.$row1['post_id'].'" class="list-group-item">';//这里的id值得注意
    echo '<strong>'.$row1['guest'].'</strong>';
    echo $row1['contact'];
    echo '<a href="reply_delete.php?reply_id='.$row1['reply_id'].'&post_id='.$_GET['post_id'].'" class="badge badge-danger">删除</a><br/>';
    echo '<small>'.date($row1['date']).'</small><br/>';
    echo nl2br($row1['content']);
    echo '</li>';
 }

echo '</ol>';?>

<!--评论的提交表单-->
<div class="card">

 <div class="card-body">

     <form method="post" action="<?php echo "reply_create.php?post_id={$_GET['post_id']}" ?>" class="form-group">
    
         <label for="guest">昵称:</label>
         <input class="form-control" name="guest" id="guest"  />
                
         <label for="contact">联系方式:</label>
         <input class="form-control" name="contact" id="contact" />
               
         <label for="content">内容:</label>
         <textarea class="form-control" name="content" id="content"></textarea>
        
         <br>
            
         <input type="submit" class="btn btn-primary" value="提交"/>
          
     </form>
 </div>
</div>

<?php
include_once "../layout/layout_footer.php";
?>

<!--line40按钮对应的删除时ajax方法-->
<script type="text/javascript">
        $(document).on('click' , '.btn-outline-danger' ,function(){
        if(confirm("确定删除吗?")) {
            var post_id = $(this).attr("id");
            $.ajax({
                url: 'post_delete.php',
                method: 'POST',
                dataType: 'JSON',
                data: {"post_id":post_id},
            
                success: function(response){
                    //alert(response);
                    window.location = "index.php";
                }});


            
        }
    });
</script>
