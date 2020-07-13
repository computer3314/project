<?php
include('db.php');
$id=$_GET["id"];

$wid=$_GET["wid"];
$sql="DELETE FROM `project_work` WHERE work_id='$wid'";
$result=mysqli_query($db,$sql);

if(!$result=0)
{
 echo exit('<script>top.location.href="message.php?mid='.$id.'"</script>');
}




?>
