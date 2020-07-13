<?php
include('db.php');
$time=$_POST["time"];

$sql = "delete from project_message where message_time = '$time'";
$result = mysqli_query($db,$sql);
$sql1 = "delete from meshistory where time = '$time'";
$result1 = mysqli_query($db,$sql1);


?>
