<?php
include('db.php');
$user_email=$_GET["email"];
$newpassword=$_POST["newpassword"];
$newpassword1=$_POST["newpassword1"];
$sql = "UPDATE `user` SET `user_password` =  md5('$newpassword') WHERE `user`.`user_email` = '$user_email'";
$sql1 = "SELECT * FROM user where user_email = '$user_email'";
$result1 = mysqli_query($db,$sql1);

$row = @mysqli_fetch_assoc($result1);
//判斷帳號與密碼是否為空白

//以及MySQL資料庫裡是否有這個會員

if($newpassword != null && $newpassword==$newpassword1)

{
  if($user_email=$row["user_email"]){
  $result = mysqli_query($db,$sql);
  echo '修改成功!';
  echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
  exit();
   }
      


}

else

{

        echo '密碼不相同,請重新輸入!';


      echo '<meta http-equiv=REFRESH CONTENT=1;url=forget1.php?check=5&email='.$user_email.'>';

}

?>
