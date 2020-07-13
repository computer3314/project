<?php
include('db.php');
$email=$_POST["user_email"];
$name=$_POST["user_name"];
$password=md5($_POST["user_password"]);
$password2=$_POST["user_password"];
$password1=$_POST["user_password1"];
$type=$_POST["type"];
$sql="INSERT INTO `registered` (`user_email`, `user_name`, `user_password`, `user_type`,`state`) VALUES ('$email', '$name', '$password', '$type','0')";
$result=mysqli_query($db,$sql);
if($email != null && $name!= null && $password2==$password1){
if(!$result==0)
{


  echo "已發送申請,等待管理員審查後傳送驗證碼至電子信箱";
    echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';

}
}
else{
  echo "資料沒有輸入完整或密碼相同,請重新輸入";
    echo '<meta http-equiv=REFRESH CONTENT=2;url=registered.html>';
}



?>
