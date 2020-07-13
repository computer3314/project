<?php
 include("db.php");
$fullName= $_POST["fullName"];
$principal=$_POST["principal"];
$addressLine1= $_POST["addressLine1"];
$addressLine2= $_POST["addressLine2"];
$pre1=$_POST["pre1"];
$pre2=$_POST["pre2"];
$pre3= $_POST["pre3"];
$pre4= $_POST["pre4"];
$pre5= $_POST["pre5"];
$ok1=$_POST["ok1"];
$ok2=$_POST["ok2"];
$ok3= $_POST["ok3"];
$ok4= $_POST["ok4"];
$ok5= $_POST["ok5"];
$person1= $_POST["person1"];
$job1= $_POST["job1"];
$person2= $_POST["person2"];
$job2= $_POST["job2"];


  $sql="Insert into project(f_number,name,principal,start_time,end_time,status)values('"
  . $_POST["fid"] . "','"
  . $fullName . "','"
  . $principal . "','"
  . $addressLine1 . "','"
  . $addressLine2 . "','"

  . "進行中" . "')";

$res=mysqli_query($db,$sql);
  $sql3="SELECT * FROM project where name='$fullName'";
$result3=mysqli_query($db,$sql3);
$row3 = mysqli_fetch_array($result3);
$mid=$row3['number'];

$sql1="Insert into project_work(number,user_name,work_matter)values('"
. $mid . "','"
. $person1 . "','"
. $job1 . "'),
('"
. $mid . "','"
. $person2 . "','"
. $job2 . "')
";
$res1=mysqli_query($db,$sql1);


$sql4="INSERT INTO `project_time` (`time_id`, `number`, `project_time_first`, `project_time_second`,
   `project_time_third`, `project_time_fourth`, `project_time_fifth`, `completed_first`, `completed_second`,
    `completed_third`, `completed_fourth`, `completed_fifth`) VALUES
    (NULL, '" . $mid . "', '"
    . $pre1 . "', '"
    . $pre2 . "', '"
    . $pre3 . "', '"
    . $pre4 . "', '"
    . $pre5 . "', '"
    . $ok1 . "', '"
    . $ok2 . "', '"
    . $ok3 . "', '"
    . $ok4 . "', '"
    . $ok1 . "')
";
$result4=mysqli_query($db,$sql4);

if(!$res==0 && $res1==0)
{



    echo exit('<script>top.location.href="message.php?mid='.$mid.'"</script>');




 }

 else
 {



     echo exit('<script>top.location.href="message.php?mid='.$mid.'"</script>');





}



?>
