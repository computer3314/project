<?php
include('db.php');
$id=$_GET["id"];
$mid=$_GET["mid"];
$sql="DELETE FROM `back` WHERE id=$id";
$result=mysqli_query($db,$sql);
if(!$res=0)
{
 echo exit('<script>top.location.href="message.php?mid='.$mid.'"</script>');
}


?>
