<?php
 include('db.php');
 $mid=$_GET["mid"];
$p1= $_POST["p1"];
$p2= $_POST["p2"];
$p3= $_POST["p3"];
$sql4="INSERT INTO `project_work` (`work_id`,`number`,`user_name`,`work_matter`)
VALUES (NULL, '"
. $p1 . "', '"
. $p2 . "', '"
. $p3 . "');";
$res2=mysqli_query($db,$sql4);
if(!$res2==0){


echo exit('<script>top.location.href="message.php?mid='.$mid.'"</script>');
}
else {

echo exit('<script>top.location.href="message.php?mid='.$mid.'"</script>');

}

?>
