<?php session_start(); ?>



<?php

$email= $_COOKIE["email"];
$password= $_COOKIE["password"];
//連接資料庫

//只要此頁面上有用到連接MySQL就要include它
include('db.php');

//搜尋資料庫資料

$sql = "SELECT * FROM user where user_email = '$email'";

$result = mysqli_query($db,$sql);

$row = @mysqli_fetch_assoc($result);


//判斷帳號與密碼是否為空白

//以及MySQL資料庫裡是否有這個會員
$name=$row['user_name'];

if($row['user_email'] == $email && $row['user_password'] == md5($password) && $row['verification'] != NULL)

{


  $_SESSION['check_word'] = ''; //比對正確後，清空或寫入下一動作代碼

  $type=$row['user_type'];
  $_SESSION['user_name'] = $name;
  $_SESSION['user_password'] = $password;
  $_SESSION['type'] = $type;

  $userip = $_SERVER['REMOTE_ADDR'];



  $userip = $_SERVER['REMOTE_ADDR'];
  date_default_timezone_set('Asia/Taipei');


  $datetime= date("Y/m/d H:i:s");
  setcookie("time","$datetime", " time()+3600*24*365");

  $insert="INSERT INTO `ccol` (`ip`,`name`,`time`) VALUES ('$userip','$name','$datetime')";
   $result = mysqli_query($db,$insert);


  echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';

}

else

{
  setcookie("email","", " time()+3600*24*365");
  setcookie("password","", " time()+3600*24*365");
  echo '密碼錯誤';
  echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';

}

?>
