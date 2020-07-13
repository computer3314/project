<?php $mid=$_GET['mid'];
include('db.php');
if($_FILES['file6']['name']!=null){
$last = strrpos($_FILES['file6']['name'],'.')+1;//獲取.在文件名中最後一次出現的位置

$suffix = substr($_FILES['file6']['name'],$last);//獲取文件名後綴
//3.文件重命名，隨機重命名

$path = 'upload/'.mt_rand().time().'.'.$suffix;//上傳文件保存的位置

move_uploaded_file($_FILES['file6']['tmp_name'], $path);//將文件保存到指定位置
}
$thing= $_POST["thing"];
$people= $_POST["people"];
$message= $_POST["message"];
$sql2="INSERT INTO `project_question` (`question_id`, `number`, `user_name`, `q_type`, `project_question`, `file`, `project_question_time`)
VALUES (NULL, '"
. $mid . "', '"
. $people . "', '"
. $thing . "', '"
. $message . "','"
. @$path . "', current_timestamp());";
$res1=mysqli_query($db,$sql2);
$sql3="SELECT question_id FROM project_question where project_question_time=current_timestamp()";
$res=mysqli_query($db,$sql3);
$row=mysqli_fetch_assoc($res);
$qid=$row["question_id"];
$sql1="INSERT INTO `project_message` (`message_id`, `question_id`, `number`, `user_name`, `message`, `message_time`)
VALUES (NULL, '$qid', '$mid', '', '', current_timestamp())";
$res=mysqli_query($db,$sql1);

echo exit('<script>top.location.href="father.php?mid='.$mid.'"</script>');






?>
