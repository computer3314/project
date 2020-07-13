<?php
 include("db.php");
 $mid=$_GET["mid"];

 if($_FILES['file11']['name']!=null){
 $last = strrpos($_FILES['file11']['name'],'.')+1;//獲取.在文件名中最後一次出現的位置

 $suffix = substr($_FILES['file11']['name'],$last);//獲取文件名後綴
 //3.文件重命名，隨機重命名

 $path = 'upload/'.mt_rand().time().'.'.$suffix;//上傳文件保存的位置

 move_uploaded_file($_FILES['file11']['tmp_name'], $path);//將文件保存到指定位置
 }

 $file = fopen($_FILES["out"]["tmp_name"], "rb");
 // 讀入圖片檔資料
 $fileContents = fread($file, filesize($_FILES["out"]["tmp_name"]));
 //關閉圖片檔
 fclose($file);
 // 圖片檔案資料編碼
 $fileContents = base64_encode($fileContents);
$text=$_POST["dd1"];
$sid=$_POST["snumber"];




 $sql="INSERT INTO `front` (`id`, `description`, `img`, `time`, `number`, `sid`, `upload`) VALUES (NULL, '"
 . $text . "',  '"
 . "data:image/png;base64," . $fileContents . "', current_timestamp(),'"
 . $mid . "','"
 . $sid . "',  '"
 . $path . "')";

 $res=mysqli_query($db,$sql);
 if(!$res=0)
 {

  echo exit('<script>top.location.href="message.php?mid='.$mid.'"</script>');
 }


?>
