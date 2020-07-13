<?php session_start();
if($_SESSION['user_name'] != null){?>

<?php
 include('../db.php');
 @$last = strrpos($_FILES['file']['name'],'.')+1;//獲取.在文件名中最後一次出現的位置

 @$suffix = substr($_FILES['file']['name'],$last);//獲取文件名後綴
 //3.文件重命名，隨機重命名

 @$path = 'upload/'.mt_rand().time().'.'.$suffix;//上傳文件保存的位置

 @move_uploaded_file($_FILES['file']['tmp_name'], $path);//將文件保存到指定位置


$p1= $_POST["p1"];
$p2= $_POST["p2"];
$p3= $_POST["p3"];
$d1= $_POST["d1"];
$d2= $_POST["d2"];
$d3= $_POST["d3"];
$d4= $_POST["d4"];
$d5= $_POST["d5"];
$f1= $_POST["f1"];
$f2= $_POST["f2"];
$f3= $_POST["f3"];
$f4= $_POST["f4"];
$f5= $_POST["f5"];
$pe1= $_POST["pe1"];
$pe2= $_POST["pe2"];
$pe3= $_POST["pe3"];
$pe4= $_POST["pe4"];
$pe5= $_POST["pe5"];
$mid=$_GET['mid'];
@$qnme= $_POST["qname"];
@$q= $_POST["q"];
$projectname=$_POST["projectname"];
$projecttime1=$_POST["projecttime1"];
$projecttime2=$_POST["projecttime2"];
$principal=$_POST["principal"];


if(isset($_POST['imessage2'])){
$sql1="INSERT INTO `project_message` (`message_id`, `number`, `user_name`, `thing`, `message`, `file`, `message_time`) VALUES (NULL, '"
. $mid . "', '"
. $people . "',
 '$thing', '$message','$path', current_timestamp())";
$res=mysqli_query($db,$sql1);
if(!$res==0)
{

echo exit('<script>top.location.href="../message.php?mid='.$mid.'"</script>');
}
else {

    echo exit('<script>top.location.href="../message.php?mid='.$mid.'"</script>');

}

}
elseif(isset($_POST['iquestion'])){

}


elseif(isset($_POST['people'])){
  $sql3 = "update project set name='$projectname',principal='$principal',start_time='$projecttime1',end_time='$projecttime2',completed_first='$f1', completed_second='$f2', completed_third='$f3', completed_fourth='$f4', completed_fifth='$f5' where number='$mid'";
  $sql5 = "UPDATE `project_time` SET `project_time_first` = '$pe1', `project_time_second` = '$pe2', `project_time_third` = '$pe3'
  , `project_time_fourth` = '$pe4', `project_time_fifth` = '$pe5', `completed_first` = '$d1', `completed_second` = '$d2', `completed_third` = '$d3'
  , `completed_fourth` = '$d4', `completed_fifth` = '$d5' WHERE `project_time`.`number` = $mid";
  $res6=mysqli_query($db,$sql5);
  if(mysqli_query($db,$sql3))

  {

          echo '修改成功!';

        echo exit('<script>top.location.href="../message.php?mid='.$mid.'"</script>');

  }

  else

  {


          echo '修改失敗!';

          echo exit('<script>top.location.href="../message.php?mid='.$mid.'"</script>');

  }


}

else{
  echo"404 not found";
}





}




else {
    echo"無權限觀看";
}


?>
