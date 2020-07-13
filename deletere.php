<?php
include('db.php');
$email=$_GET["user_email"];

$sql="DELETE FROM `registered` WHERE `registered`.`user_email` = '$email'";
$result=mysqli_query($db,$sql);
if(!$res=0)
{

 echo exit('<script>top.location.href="keyin.php"</script>');
}




?>
