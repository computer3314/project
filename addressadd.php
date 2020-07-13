<?php
include('db.php');
$mid=$_GET["mid"];
$A1= $_POST["A1"];
$A2= $_POST["A2"];
$sql6="UPDATE `project` SET `address` = '$A1',`address1` = '$A2' WHERE `project`.`number` = $mid";
$res4=mysqli_query($db,$sql6);
if(!$res4==0){


echo exit('<script>top.location.href="message.php?mid='.$mid.'"</script>');
}
else {

echo exit('<script>top.location.href="message.php?mid='.$mid.'"</script>');

}


?>
