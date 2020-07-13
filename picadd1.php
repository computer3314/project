<?php
include("db.php");
if($_FILES['file22']['name']!=null){
$last = strrpos($_FILES['file22']['name'],'.')+1;//獲取.在文件名中最後一次出現的位置

$suffix = substr($_FILES['file22']['name'],$last);//獲取文件名後綴
//3.文件重命名，隨機重命名

$path = 'upload/'.mt_rand().time().'.'.$suffix;//上傳文件保存的位置

move_uploaded_file($_FILES['file22']['tmp_name'], $path);//將文件保存到指定位置
}

$mid=$_GET["mid"];
$file1 = fopen($_FILES["back"]["tmp_name"], "rb");
// 讀入圖片檔資料
$fileContents1 = fread($file1, filesize($_FILES["back"]["tmp_name"]));
//關閉圖片檔
fclose($file1);
// 圖片檔案資料編碼
$fileContents1 = base64_encode($fileContents1);
$text=$_POST["dd2"];
$sid=$_POST["snumber1"];
$sql="INSERT INTO `back` (`id`, `description`, `img`, `time`, `number`, `sid`, `upload`) VALUES (NULL, '"
. $text . "',  '"
. "data:image/png;base64," . $fileContents1 . "', current_timestamp(),'"
. $mid . "','"
. $sid . "', '"
. $path . "')";

$res=mysqli_query($db,$sql);
if(!$res=0)
{
 echo exit('<script>top.location.href="message.php?mid='.$mid.'"</script>');
}


?>
