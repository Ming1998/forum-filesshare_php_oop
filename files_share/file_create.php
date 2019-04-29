<?php 
include_once '../config/database.php';
include_once '../objects/file.php';

$database = new Database();
$db = $database->get_connection();
 
$file = new File($db);

$page_title = "资料上传";
include_once "../layout/layout_header.php";
 
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right'>Read Files</a>";
echo "</div>";
 
?>
<?php

if($_POST){
    // set file property values
    $file->uploader = $_POST['uploader'];
    $file->subject = $_POST['subject'];
    $file->title = $_POST['title'];
    $file->file = $_FILES['file']['name'];
    $target = "files/".$file->file;
    move_uploaded_file($_FILES['file']['tmp_name'], $target);
    // create the file
    if($file->create()){
        $database->redirect('file_read.php');
    }
 
    // if unable to create the file, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to create file.</div>";
    }
}

?>
<div class="container">
      <h3>谢谢你学习好还愿意分享资料</h3>

      <form method="post" class="form-group" enctype="multipart/form-data">    
        
          <label class="col-form-label" for="uploader">上传者</label>
          <input type="text" class="form-control" name="uploader" id="uploader" placeholder="做好事留个名吧" required>
        
        
          <label class="col-form-label" for="subject">科目</label>
          <input type="text" class="form-control" name="subject" id="subject" placeholder="请填写全称便于搜索哦" required>
        
          <label class="col-form-label" for="title">标题</label>
          <input type="text" class="form-control" name="title" id="title" placeholder="简要介绍你分享的资料" required>
        
          <label class="col-form-label" for="file">文件</label>
          <input type="file" class="form-control" name="file" id="file" required>
          <br>
          <input type="submit" value="提交"  class="btn btn-primary"/>
          <input type="reset"  value="重置"  class="btn btn-danger"/>
      </form>
    </div>
<?php

include_once '../layout/layout_footer.php';
?>