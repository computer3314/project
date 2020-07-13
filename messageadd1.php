<?php session_start();
if($_SESSION['user_name'] != null)
{

}
  else{
    echo '您無權限觀看此頁面!';

   header('Location: index.php');
  }?>
<?php
include('db.php');
$name=$_POST['name'];
$qid=$_POST['qid'];
$formid=$_POST['formid'];
$answer1=$_POST['answer1'];




$sql2="INSERT INTO `meshistory` (`id`, `qid`, `formid`, `name`, `thing`, `time`)
VALUES (NULL,'$formid','$qid','$name', '$answer1', current_timestamp())";
$res1=mysqli_query($db,$sql2);

$sql1="INSERT INTO `project_message` (`message_id`, `question_id`, `number`, `user_name`, `message`, `message_time`)
VALUES (NULL, '$formid', '$qid', '$name', '$answer1', current_timestamp())";
$res=mysqli_query($db,$sql1);
if(!$res==0)
{

echo "y";
}
else {

  echo "n";
}
?>
