<?php
$mid=$_GET["mid"];

include("db.php");

  $sql="DELETE FROM project WHERE number=$mid";
  $result=mysqli_query($db,$sql);
  if($result!=0){
    $sql9="DELETE FROM project_father WHERE number=$mid";
    $result9=mysqli_query($db,$sql9);
  }
  $sql1="DELETE FROM back WHERE number=$mid";
  $result1=mysqli_query($db,$sql1);
  $sql2="DELETE FROM front WHERE number=$mid";
  $result2=mysqli_query($db,$sql2);
  $sql3="DELETE FROM project_message WHERE number=$mid";
  $result3=mysqli_query($db,$sql3);
  $sql4="DELETE FROM project_question WHERE number=$mid";
  $result4=mysqli_query($db,$sql4);
  $sql5="DELETE FROM project_time WHERE number=$mid";
  $result5=mysqli_query($db,$sql5);
  $sql6="DELETE FROM project_work WHERE number=$mid";
  $result6=mysqli_query($db,$sql6);

  echo exit('<script>top.location.href="index1.php"</script>');


?>
