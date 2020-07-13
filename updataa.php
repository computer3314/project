<?php
include('db.php');

$sql="UPDATE `process` SET `state` = '$_POST[state]', `strat` = '$_POST[start]', `end` = '$_POST[end]', `reson` = '$_POST[dont]' WHERE `process`.`id` = '$_POST[id]'";
$res=mysqli_query($db,$sql);
echo "y";







?>
