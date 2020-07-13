<?php
include('db.php');
$name = $_GET['user_name'];
$type = $_GET['user_type'];
$email = $_GET['user_email'];
$password = $_GET['user_password'];

$sql="INSERT INTO `user` (`user_email`, `user_name`, `user_password`, `user_type`, `verification`) VALUES ('$email', '$name', '$password', '$type', 'true')";
$result=mysqli_query($db,$sql);
$sql2="DELETE FROM `registered` WHERE `registered`.`user_email` = '$email'";
$result=mysqli_query($db,$sql2);
if(!$res=0)
{

 echo exit('<script>top.location.href="keyin.php"</script>');
}




?>