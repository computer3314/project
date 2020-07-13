<?php
include('db.php');
$mid=$_GET["mid"];
$A1= $_POST["A1"];
$A2= $_POST["A2"];
$sql6="UPDATE `project_father` SET `address` = '$A1',`address1` = '$A2' WHERE `project_father`.`number` = $mid";

$res4=mysqli_query($db,$sql6);



echo exit('<script>top.location.href="search1.php?key='.$mid.'"</script>');








?>
