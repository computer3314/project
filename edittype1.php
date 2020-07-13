<?php
include('db.php');
$id=$_GET['id'];
$wid=$_GET['wid'];
$name=$_POST['p1'];
$thing=$_POST['t1'];
$sql="UPDATE `project_work` SET `user_name` = '$name',`work_matter` = '$thing' WHERE `project_work`.`work_id` = $wid";
$result=mysqli_query($db,$sql);
echo exit('<script>top.location.href="message.php?mid='.$id.'"</script>');
?>
