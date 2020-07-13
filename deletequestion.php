<?php
include('db.php');
$time=$_GET["time"];
$mid=$_GET["mid"];
$sql1="SELECT * FROM project_question where project_question_time	 = '$time'";
$result1 = mysqli_query($db,$sql1);
$row=mysqli_fetch_assoc($result1);
$qid=$row["question_id"];
$sql = "delete from project_question where project_question_time	 = '$time'";
$result = mysqli_query($db,$sql);

$sql2 = "delete from project_message where question_id	 = '$qid'";

$res=mysqli_query($db,$sql2);
$sql3 = "delete from meshistory where time = '$time'";
$result3 = mysqli_query($db,$sql3);
$sql4 = "delete from meshistory where qid = '$qid'";
$result4 = mysqli_query($db,$sql4);
if(!$result==0)
{

echo exit('<script>top.location.href="message.php?mid='.$mid.'"</script>');
}
else
{

  echo exit('<script>top.location.href="message.php?mid='.$mid.'"</script>');
}



?>
