<?php include_once '../layout/layout_nav.html';?>
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">

    <li class="nav-item">
      <?php echo '<div class="col-2"><a class="btn btn-primary" href="file_create.php" id=file_upload>上传资料</a></div><hr/>';?>
    </li>
    <li class="nav-item">
    <form class="form-inline" method="post"><!--这个表单的目的是获取用户输入的keyword，method="post"不要忘了-->
    <div class="form-group">
      <input type="text" class="form-control" name="subject" id="subject">
    </div>
    <button type="submit" name="btn-name" class="btn btn-default">科目搜索</button><!--这里的name值要与line41对应-->

    </form>
    </li>    
    </ul>
  </div>
<?php
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/file.php';

$database = new Database();
$db = $database->get_connection();
 
$file = new File($db);
function query(){
$database = new Database();
$db = $database->get_connection();
 
$file = new File($db);
	$file_stmt = $file->read();
    if(isset($_POST['btn-name'])){
       $file_stmt = $file -> search($_POST['subject']);
    }
    return $file_stmt;
}

$file_stmt = query();

$file_num = $file_stmt->rowCount();

$page_title = "资料分享";
include_once "../layout/layout_header.php";

echo '<ul class="list-group">';
        if($file_num>0){
          while($row = $file_stmt->fetch(PDO::FETCH_ASSOC)) {
          $uploader = $row['uploader'];
          $subject = $row['subject'];
          $title = $row['title'];
          $file = $row['file'];
   
          echo '<li class="list-group-item">';
          echo '由<strong class="text-muted"> '. $uploader. '</strong>'.'提供的<strong class="text-muted"> '. $subject. '</strong> '.'资料<strong class="text-muted"> '.$title . '</strong>';
          echo '<a href="'.'files/'.$file.'">'.' '.$file.'</a>';
          echo '</li>';

        }
echo '</ul>';
        }
         else{
	      echo '呀，暂时还没有你要的资料';
        }



include_once "../layout/layout_footer.php";
?>
