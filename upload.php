<?php

//上傳到的地點(請已"/"結束)
$upload_path = 'upload/';
//可接受的最大檔案大小(單位: bytes)
//不設代表可以接受任意大小
$max_size = '';
/* 上傳程序開始 */
//檢查是否有錯誤
if(isset($_FILES['uploadedfile']) && sizeof($_FILES['uploadedfile']) > 0)
{
if($_FILES['uploadedfile']['error'] > 0)
{
//發生錯誤
//錯誤代碼資訊可以上php官網看:
//http://tw.php.net/manual/en/features.file-upload.errors.php
echo '上傳錯誤代碼: ' . $_FILES['uploadedfile']['error'] . '<br />';
exit;
}
//是否有限制檔案大小?
if(($max_size > 0) && ($_FILES['uploadedfile']['size'] > $max_size))
{
//檔案過大
echo '您上傳的檔案大小大於系統可接受的範圍';
exit;
}
//檢查檔案是否已存在
if(file_exists($upload_path . basename($_FILES['uploadedfile']['name'])))
{
echo '檔案已存在';
exit;
}
//檢查目錄是否存在, 不存在的話新增一個
if(!is_dir($upload_path) && !mkdir($upload_path))
{
//目錄不存在, 無法新增資料夾
echo '系統無法新增資料夾';
exit;
}
//移動已上傳的檔案
if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $upload_path . basename($_FILES['uploadedfile']['name'])))
{
echo '上傳成功!<br />';
echo '點<a href="' . $upload_path . basename($_FILES['uploadedfile']['name']) . '">這裡</a>下載您的檔案';
exit;
}
}
?>
