<?php session_start();
if($_SESSION['user_name'] != null)
{

}
  else{
    echo '您無權限觀看此頁面!';

     header('Location: index.php');
  }?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<?php


include('db.php');



$verification= $_POST["K1"];


$name=$_POST["name"];

$sql2="UPDATE `user` SET `verification` = '$verification' WHERE `user`.`user_name` = '$name'; ";
$result2=mysqli_query($db,$sql2);

echo exit('<script>top.location.href="keyin.php"</script>');




?>
