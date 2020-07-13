<?php
include('db.php');
$updata="UPDATE `process` SET `state` = '已完成',`end` = current_timestamp() WHERE `process`.`id` = '$_POST[id]'";
$res=mysqli_query($db,$updata);
?>
