<?php
 include("db.php");
$fullName= $_POST["fullName"];
$principal=$_POST["principal"];
$addressLine1= $_POST["addressLine1"];
$addressLine2= $_POST["addressLine2"];

  $sql="Insert into project_father(name,principal,start_time,end_time,status)values('"
  . $fullName . "','"
  . $principal . "','"
  . $addressLine1 . "','"
  . $addressLine2 . "','"
  . "進行中" . "')";

$res=mysqli_query($db,$sql);
  $sql3="SELECT * FROM project_father where name='$fullName'";
$result3=mysqli_query($db,$sql3);
$row3 = mysqli_fetch_array($result3);
$mid=$row3['number'];

    echo exit('<script>top.location.href="search1.php?key='.$mid.'"</script>');






?>
