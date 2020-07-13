<?php
 if(!isset($_SESSION)){ session_start(); } //檢查SESSION是否啟動
 $_SESSION['check_word'] = ''; //設置存放檢查碼的SESSION
 //設置定義為圖片
 header("Content-type: image/PNG");
$nums=5; //生成驗證碼個數
$width=$nums*10;  //圖片寬
$high=20;  //圖片高
//去除了數字0和1 字母小寫O和L，為了避免辨識不清楚
$str = "123456789";
$code = '';
for ($i = 0; $i < $nums; $i++) {
$code .= $str[mt_rand(0, strlen($str)-1)];
}
//等待驗證用的驗證碼
$_SESSION['check_word'] = $code;
//建立圖示，設置寬度及高度
$image = imagecreate($width, $high);
//$image=imagecreatefrompng("images/bg.png"); //或是自行準備底圖
//設置圖像的顏色
$black = imagecolorallocate($image, 0, 0, 0);  //黑色底色
$white = imagecolorallocate($image, 255, 255, 255);  //白色文字
//建立矩形底框(可省略)
imagerectangle($image, 0, 0, $width-1, $high-1, $black);
//imagestring (圖像資源,指定字型(1，2，3，4 ，5)，x坐標點,y坐標點,寫入的字串,文字顏色)
imagestring($image, 5, 3, 3, $code, $white);
imagepng($image);
imagedestroy($image);  //少這行畫面會全黑
?>
