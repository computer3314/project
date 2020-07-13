<?php session_start(); ?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<?php
include('db.php');
$userip = $_SERVER['REMOTE_ADDR'];
$name= $_SESSION['user_name'];
$delete="DELETE FROM `ccol` where name='$name'";
 $result = mysqli_query($db,$delete);
setcookie("email",""," time()+3600*24*365");
setcookie("password",""," time()+3600*24*365");
setcookie("time",""," time()+3600*24*365");
//將session清空

session_unset();

echo '登出中......';

echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';

?>
