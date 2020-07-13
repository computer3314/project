<?php session_start(); ?>



<?php

$email= $_POST["Email"];
$password= $_POST["Password"];
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

if($email != null && $password != null && $row['user_email'] == $email && $row['user_password'] == md5($password) && $row['verification'] != NULL)

{
  if(!isset($_SESSION)){ session_start();}  //判斷session是否已啟動
  if($_SESSION['check_word'] == $_POST['checkword']){
  $_SESSION['check_word'] = ''; //比對正確後，清空或寫入下一動作代碼
  setcookie("email","$email", " time()+3600*24*365");
  setcookie("password","$password", " time()+3600*24*365");
  $type=$row['user_type'];
  $_SESSION['user_name'] = $name;
  $_SESSION['user_password'] = $password;
  $_SESSION['type'] = $type;
  echo "c";
  $userip = $_SERVER['REMOTE_ADDR'];
  date_default_timezone_set('Asia/Taipei');


  $datetime= date("Y/m/d H:i:s");
setcookie("time","$datetime", " time()+3600*24*365");

  $insert="INSERT INTO `ccol` (`ip`,`name`,`time`) VALUES ('$userip','$name','$datetime')";
   $result = mysqli_query($db,$insert);



  exit();
   }else{
  echo "u";

   }
        //將帳號寫入session，方便驗證使用者身份


}

else

{
      echo "n";

}

?>
