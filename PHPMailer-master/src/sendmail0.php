<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';
require 'POP3.php';
require 'OAuth.php';
include('../../db.php');
$email=$_POST["user_email"];
$sql1 = "SELECT * FROM user where user_email = '$email'";
$result1 = mysqli_query($db,$sql1);

$row = @mysqli_fetch_assoc($result1);


$name=$row["user_name"];
$email1=$row["user_email"];
$type=$row["user_type"];
$url="http://210.242.156.181:8046/Project/forget1.php?check=5&email=$email1";

if($email==$email1){
  $mail= new PHPMailer();
  $mail->SMTPDebug = 2;                        //建立新物件
  $mail->IsSMTP();                                    //設定使用SMTP方式寄信
  $mail->SMTPAuth = true;                        //設定SMTP需要驗證
  $mail->SMTPSecure = "ssl";                    // Gmail的SMTP主機需要使用SSL連線
  $mail->Host = "smtp.gmail.com";             //Gamil的SMTP主機
  $mail->Port = 465;
  $mail->SMTPOptions = array(
  'ssl' => array(
      'verify_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true
  )
  );                             //Gamil的SMTP主機的埠號(Gmail為465)。
  $mail->CharSet = "utf-8";                       //郵件編碼
  $mail->Username = "sblteamproject@gmail.com"; //Gamil帳號
  $mail->Password = "Sbl83380358";                 //Gmail密碼
  $mail->From = "sblteamproject@gmail.com";        //寄件者信箱
  $mail->FromName = "欣柏萊股份有限公司";                  //寄件者姓名
  $mail->Subject ="來自欣柏萊股份有限公司的留言"; //郵件標題
  echo "<script type='text/javascript'>";
  $mail->Body = "姓名:".$name."<br />信箱:".$email."<br />類別:".$type."<br />網址:"."<a href=" . $url . ">更改密碼</a>"; //郵件內容
  echo "</script>";
  $mail->IsHTML(true);                             //郵件內容為html
  $mail->AddAddress("$email");            //收件者郵件及名稱
  if(!$mail->Send()){
      echo "Error: " . $mail->ErrorInfo;
  }else{
  echo exit('<script>top.location.href="turn1.php"</script>');
  }


}
else{
  echo "資料庫內無此帳號";
    echo '<meta http-equiv=REFRESH CONTENT=2;url=../../forget1.php>';
}




?>
