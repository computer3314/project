<?php
            @header("Content-Type:text/html;charset-utf-8");
            $db=@mysqli_connect('localhost','root','','project');
            mysqli_query($db,'set names utf8');

            if (mysqli_connect_errno()) {

            echo "資料庫連接失敗";

            exit;

            }

            else{

            echo "";

            }
            ?>
