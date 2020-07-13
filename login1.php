<?php session_start(); ?>

<!--上方語法為啟用session，此語法要放在網頁最前方-->

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php


$ver= $_GET["ver"];
$email= $_GET["email"];
$password= $_GET["password"];
//連接資料庫
//只要此頁面上有用到連接MySQL就要include它
include('db.php');

//搜尋資料庫資料
$sql1="UPDATE `user` SET `verification` = '$ver' WHERE `user`.`user_email` = '$email'";
$result1 = mysqli_query($db,$sql1);

$sql = "SELECT * FROM user where user_email = '$email'";

$result = mysqli_query($db,$sql);

$row = @mysqli_fetch_assoc($result);


//判斷帳號與密碼是否為空白

//以及MySQL資料庫裡是否有這個會員
$name=$row['user_name'];

if($email != null && $password != null && $row['user_email'] == $email && $row['user_password'] == md5($password) && $row['verification'] != NULL)

{

        //將帳號寫入session，方便驗證使用者身份
        $type=$row['user_type'];
        $_SESSION['user_name'] = $name;
        $_SESSION['user_password'] = $password;
        $_SESSION['type'] = $type;
        setcookie("email","$email", " time()+3600*24*365");
        setcookie("password","$password", " time()+3600*24*365");


        $userip = $_SERVER['REMOTE_ADDR'];
        date_default_timezone_set('Asia/Taipei');


        $datetime= date("Y/m/d H:i:s");
      setcookie("time","$datetime", " time()+3600*24*365");

        $insert="INSERT INTO `ccol` (`ip`,`name`,`time`) VALUES ('$userip','$name','$datetime')";
         $result = mysqli_query($db,$insert);

        echo '登入成功!';

        echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';

}

else

{

  setcookie("email","", " time()+3600*24*365");
  setcookie("password","", " time()+3600*24*365");
        echo '登入失敗,無通過驗證或無此信箱!';


      echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';

}

?>
