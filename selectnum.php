<?php
$qid=$_GET["qid"];
include('db.php');
$sql3="SELECT * FROM project_message where question_id='$qid'";
$result31=mysqli_query($db,$sql3);
$num1=mysqli_num_rows($result31);
$num1=$num1-1;
if($num1==0)
{
echo "尚無留言";
}
else{
  echo "查看所有留言<sup style='color:red'>$num1 </sup>";
}

?>
