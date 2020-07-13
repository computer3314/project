<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <title>DHTMLX Gantt Chart Demo</title>

    <!--使用lodash-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.11/lodash.min.js"></script>

    <!--全版樣式-->
    <style>
        html, body {
            height: 100%;
            padding: 0px;
            margin: 0px;
        }
    </style>

    <!--使用dhtmlxgantt-->
    <link href="https://cdn.jsdelivr.net/npm/dhtmlx-gantt@5.2.0/codebase/skins/dhtmlxgantt_material.css?v=5.2.0" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/dhtmlx-gantt@5.2.0/codebase/dhtmlxgantt.js?v=5.2.0"></script>
       <script src="https://cdn.jsdelivr.net/npm/dhtmlx-gantt@5.2.0/codebase/ext/dhtmlxgantt_marker.js"></script>

    <!--週末欄位樣式-->
    <style type="text/css">
        .dhtmlxgantt_weekend {
            background: #bbb !important;
            color: #fff !important;
        }

    </style>

</head>

<body>

    <div id="gantt_here" style='width:100%; height:100%;'></div>

    <script type="text/javascript">

        let tasks = {

            data: [
              {
                   id: 1, level: 1 , text: "欣柏萊"
               },
              <?php
              $db=@mysqli_connect('localhost','root','1234','project');
              mysqli_query($db,'set names utf8');
              $seclect="SELECT * FROM `project_father`";
              $res=mysqli_query($db,$seclect);
              $num=mysqli_num_rows($res);
for($i=0;$i<=$num;$i++){
          while($row=mysqli_fetch_assoc($res)){

          $name=$row['name'];
          $fid=$row['number'];
$i=$i+1;

              ?>

                {
                    id:1<?php echo $i?> , level: 2 , text: "<?php echo $name?>",parent: 1
                },
                <?php

                $seclect1="SELECT * FROM `project` where f_number='$fid'";
                $res1=mysqli_query($db,$seclect1);
                $num1=mysqli_num_rows($res1);
  for($k=0;$k<=$num1;$k++){
            while($row1=mysqli_fetch_assoc($res1)){

            $name1=$row1['name'];
            $fid1=$row1['number'];
            $start=$row1['start_time'];
              $end=$row1['end_time'];
              $year=mb_substr( $start,0,4);
              $month=mb_substr( $start,5,2);
              $day=mb_substr( $start,8,2);
              $total=(strtotime($end) - strtotime($start))/ (60*60*24);
  $k=$k+1;

                ?>
                {
                   id: 1<?php echo $i?><?php echo $k?>, level: 3, text: "<?php echo $name1?>", parent: 1<?php echo $i?>, start_date: "<?php echo $day ?>-<?php echo $month ?>-<?php echo $year ?>", duration: <?php echo $total ?>
               },

                   <?php }} ?>
                <?php }} ?>



            ],
        };

        //給各項目顏色
        _.each(tasks.data, function (v, k) {
            if (v.level <= 3) {
                v.color = '#eee';
                v.textColor = '#000';
            }
            else {
                v.color = '#3DB9D3';
                v.textColor = '#fff';
            }
        });

        //項目區中文化
        gantt.config.columns = [
            { name: "text", label: '名稱', resize: true, tree: true, align: 'left' },
            { name: "start_date", label: '開始時間', resize: true, align: 'center' },
            { name: "duration", label: '長度(天)', resize: false, align: 'center' }
        ];

        //展開樹狀項目
        gantt.config.open_tree_initially = true;

        //禁止編輯
        gantt.config.readonly = true;

        //顯示欄位合併數量
        //gantt.config.step = 1;

        //上方欄位單位與高度
        gantt.config.scale_unit = 'day'; //"minute", "hour", "day", "week", "quarter", "month", "year"
        gantt.config.scale_height = 50;

        //上方欄位寬度
        //gantt.config.min_column_width = 50;

        //項目空間高度與高度
        gantt.config.row_height = 40;
        gantt.config.task_height = 18;

        //顯示時間格式, Date Format Specification
        gantt.config.date_grid = "%Y/%m/%d";

        //onTaskClick
        gantt.attachEvent('onTaskClick', function (id, e) {
            let target = e.target || e.srcElement;
            if (target.className === 'gantt_tree_content') {
                console.log('點擊task項目區', id);
            }
            else {
                console.log('點擊task進度條區', id);
            }
            return true;
        });

        //onTemplatesReady
        gantt.attachEvent('onTemplatesReady', function () {

            //依照年月日顯示欄位
            gantt.templates.date_scale = function (date) {
                let y = gantt.date.date_to_str("%Y");
                y = y(date);
                let d = gantt.date.date_to_str("%n/%j");
                let md = d(date);
                let cy = '<div style="opacity:0.6; font-size:0.9em; height:15px; line-height:15px;">' + y + '</div>';
                let cd = '<div style="font-size:1.1em; height:15px; line-height:15px;">' + md + '</div>';
                return '<div style="padding:10px 0px;">' + cy + cd + '</div>';
            };

            //針對週末標注為灰色
            gantt.templates.scale_cell_class = function (date) {
                if (date.getDay() === 0 || date.getDay() === 6) {
                    return 'dhtmlxgantt_weekend';
                }
            };

        });

        //init對象
        gantt.init("gantt_here");

        //載入資料
        gantt.parse(tasks);

    </script>

</body>

</html>
