<?php

require dirname(__FILE__) . '\silde.php';

?>

<?php

$mid = $_GET['mid'];
$sql = "SELECT * FROM  project
            WHERE number =$mid
          ";
//連接資料庫
//從project資料表搜尋
@$result = mysqli_query($db, $sql);
@$sql5 = "SELECT * FROM project_time where number='$mid'";
$result5 = mysqli_query($db, $sql5);
$row5 = mysqli_fetch_array($result5);
@$row = mysqli_fetch_array($result);
$name = $row['name'];
$principal = $row['principal'];
$start = $row['start_time'];
$end = $row['end_time'];
$address = $row['address'];
$address1 = $row['address1'];
$f_number = $row['f_number'];
$ex1 = $row5['project_time_first'];
$ex2 = $row5['project_time_second'];
$ex3 = $row5['project_time_third'];
$ex4 = $row5['project_time_fourth'];
$ex5 = $row5['project_time_fifth'];
$t1 = $row5['completed_first'];
$t2 = $row5['completed_second'];
$t3 = $row5['completed_third'];
$t4 = $row5['completed_fourth'];
$t5 = $row5['completed_fifth'];
$f1 = $row['completed_first'];
$f2 = $row['completed_second'];
$f3 = $row['completed_third'];
$f4 = $row['completed_fourth'];
$f5 = $row['completed_fifth'];
$total = ($f1 + $f2 + $f3 + $f4 + $f5);
$day = ((strtotime($end) - strtotime($start)) / (60 * 60 * 24));
$part = round($day / 5);
$part1 = ($part) * 2;
$part2 = ($part) * 3;
$part3 = ($part) * 4;
$part4 = ($part) * 5;
?>
<div class="container">
  <form name="form" id="form" method="post" Enctype="multipart/form-data" action="">
    <div class="row">
      <!---專案名稱/模組--->
      <div class="col-6 mb-3">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">專案名稱/模組</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo "$name"; ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-calendar fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!---期程--->
      <div class="col-6 mb-3">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">期程</div>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">
                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo "$start"; ?>~<?php echo "$end"; ?></div>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!---完成率--->
      <div class="col-12 mb-3">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">完成率</div>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">
                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $total ?>%</div>
                  </div>
                  <div class="col">
                    <div class="progress progress-sm mr-2">
                      <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $total ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $total ?>%</div>
                      <?php if ($total == 100) {
                        $sql = "UPDATE `project` SET `status` = '完成' WHERE `project`.`number` = $mid";
                        $result = mysqli_query($db, $sql);
                      } ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!---圖--->
    <div id="photo"></div>
    <div class="row">
      <div class="col-6 mb-3">
        <a href="#" class="btn btn-secondary btn-icon-split" id="pic">
          <span class="icon text-white-50">
            <i class="fas fa-arrow-right"></i>
          </span>
          <span class="text">上傳前端圖片</span>
        </a>
      </div>
      <div class="col-6 mb-3">
        <a href="#" class="btn btn-secondary btn-icon-split" id="pic2">
          <span class="icon text-white-50">
            <i class="fas fa-arrow-right"></i>
          </span>
          <span class="text">上傳後端圖片</span>
        </a>
      </div>
    </div>
    <!---介面元素圖上傳--->
    <div id="pic1" style="display:none;" class="mb-3">
      <div class="row">
        <div class="col-12">
          <h6>上傳前端圖片</h6>
        </div>
        <div class="col-4">
          <input type="text " class="form-control" placeholder="編號" name="snumber" maxlength="25" /><br>
        </div>
        <div class="col-8">
          <input name="dd1" class="form-control" placeholder="照片內容描述" value="" type="text">
        </div>
        <div class="col-12">
          圖片：<input id="file" type="file" name="out">
          副檔：<input type="file" name="file11">
        </div>
        <div class="col-12 text-center">
          <img id="demo3" style="width: 30rem;"><br>
        </div>

        <div class="col-12 text-center">
          <button class="btn btn-primary" type="submit" id="picadd" name="picadd" onclick="form.action='picadd.php?mid=<?php echo "$mid"; ?>';form.submit();" />送出</button>
          <button class="btn btn-danger" id="pic1no">取消</button>
        </div>
      </div>
    </div>
    <!---施作元件圖上傳--->
    <div id="pic21" style="display:none;" class="mb-3">
      <div class="row">
        <div class="col-12">
          <h6>上傳後端圖片</h6>
        </div>
        <div class="col-4">
          <input type="text" class="form-control" placeholder="編號" name="snumber1" maxlength="25" /><br>
        </div>
        <div class="col-8">
          <input name="dd2" class="form-control" placeholder="照片內容描述" required="true" value="" type="text">
        </div>
        <div class="col-12">
          圖片：<input id="file1" type="file" name="back">
          副檔：<input type="file" name="file22">
        </div>
        <div class="col-12 text-center">
          <img id="demo1" style="width: 30rem;">
        </div>
        <div class="col-12 text-center">
          <button class="btn btn-primary" type="submit" id="picadd22" name="picadd12" onclick="form.action='picadd1.php?mid=<?php echo "$mid"; ?>';form.submit();" />送出</button>
          <button class="btn btn-danger" id="pic2no">取消
        </div>
      </div>
    </div>
    <script>
      $("#photo").load("photo.php?mid=<?php echo $mid ?>");
    </script>
    <!---完成成果-連結--->
    <div class="row">
      <div class="col-6 mb-1">
        <div class="card bg-success text-white shadow">
          <div class="card-body">
            前台&emsp;<a href="javascript:void(0)" class="btn" onclick="window.open('<?php echo "$address"; ?>', '', '');">連結</a>
            <div class="text-white-50 small"></div>
          </div>
        </div>
      </div>
      <div class="col-6">
        <div class="card bg-danger text-white shadow">
          <div class="card-body">
            後台&emsp;<a href="javascript:void(0)" class="btn" onclick="window.open('<?php echo "$address1"; ?>', '', '');">連結</a>
            <div class="text-white-50 small"></div>
          </div>
        </div>
      </div>
      <div class="col-12 mb-3">
        <a href="#" class="btn btn-secondary btn-icon-split" id="address">
          <span class="icon text-white-50">
            <i class="fas fa-arrow-right"></i>
          </span>
          <span class="text">上傳/編輯網址</span>
        </a>
      </div>
    </div>
    <!---完成成果-連結編輯--->
    <div id="address1" style="display:none;" class="mb-3">
      <div class="row">
        <div class="col-6 mb-3">
          <span class="input-group-addon"><input name="A1" placeholder="前台網址" class="form-control" required="true" value="<?php echo "$address"; ?>" type="text">
        </div>
        <div class="col-6">
          <input name="A2" placeholder="後台網址" class="form-control" required="true" value="<?php echo "$address1"; ?>" type="text">
        </div>
        <div class="col-12 text-center">
          <button type="submit" class="btn btn-primary" style="display:none;" id="address2" name="address2" onclick="form.action='addressadd.php?mid=<?php echo "$mid"; ?>';form.submit();" />送出</button>
          <button class="btn btn-danger" id="addressno">取消</button>
        </div>
      </div>
    </div>
    <!---預計完成日期--->
    <div class="card shadow mb-4">
      <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
        <div class="row">
          <div class="col-6">
            <h6 class="m-0 font-weight-bold text-primary">預計完成日期</h6>
          </div>
          <?php
          $sql20 = "Select principal from project_father where number=$f_number";
          $result20 = mysqli_query($db, $sql20);
          $row20 = mysqli_fetch_assoc($result20);
          $fp = $row20["principal"];
          ?>
        </div>
      </a>
      <div class="collapse" id="collapseCardExample" style="">
        <div class="card-body">
          <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
              <!---預計完成進度--->
              <div class="col-12" id="callshow" style="display:block">
                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                  <thead>
                    <tr role="row">
                      <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">預計事項</th>
                      <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">預計完成日期</th>
                      <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending">進度摘要</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr role="row" class="odd">
                      <td id="percent1" class="sorting_1"><?php echo "$ex1"; ?></td>
                      <td id="percent1"><?php echo date("Y-m-d", strtotime($start . "+$part day")); ?></td>
                      <td id="dpercent1"><?php echo "$t1"; ?></td>
                    </tr>
                    <tr role="row" class="even">
                      <td id="percent2" class="sorting_1"><?php echo "$ex2"; ?></td>
                      <td id="percent2"><?php echo date("Y-m-d", strtotime($start . "+$part1 day")); ?></td>
                      <td id="dpercent2"><?php echo "$t2"; ?></td>
                    </tr>
                    <tr role="row" class="odd">
                      <td id="percent3" class="sorting_1"><?php echo "$ex3"; ?></td>
                      <td id="percent3"><?php echo date("Y-m-d", strtotime($start . "+$part2 day")); ?></td>
                      <td id="dpercent3"><?php echo "$t3"; ?></td>
                    </tr>
                    <tr role="row" class="even">
                      <td id="percent4" class="sorting_1"><?php echo "$ex4"; ?></td>
                      <td id="percent4"><?php echo date("Y-m-d", strtotime($start . "+$part3 day")); ?></td>
                      <td id="dpercent4"><?php echo "$t4"; ?></td>
                    </tr>
                    <tr role="row" class="odd">
                      <td id="percent5" class="sorting_1"><?php echo "$ex5"; ?></td>
                      <td id="percent5"><?php echo "$end"; ?></td>
                      <td id="dpercent5"><?php echo "$t5"; ?></td>
                    </tr>
                  </tbody>
                </table>
                <?php if ($_SESSION['user_name'] == $principal or $_SESSION['type'] ===  '主管' or $_SESSION['type'] ===  '主任秘書' or $_SESSION['user_name'] == $fp or $_SESSION['type'] ===  '工會' or $_SESSION['user_name'] == '陳昇廷') {
                ?>
                  <div class="text-center">
                    <button class="btn btn-warning" id="icallback">進度調整</button>
                  </div>
                <?php }
                ?>
              </div>
              <!---進度調整--->
              <div class="col-12" id="callback" style="display:none;">
              <h3>*此區完成率相加=100%</h3>

                <textarea name="projectname" class="form-control" style="display:none;" required="true" value="" type="text"><?php echo "$name"; ?></textarea>
                <textarea name="projecttime1" class="form-control" style="display:none;" required="true" value="" type="text"><?php echo "$start"; ?></textarea>
                <textarea name="projecttime2" class="form-control" style="display:none;" required="true" value="" type="text"><?php echo "$end"; ?></textarea>
                <textarea name="principal" class="form-control" style="display:none;" required="true" value="" type="text"><?php echo "$principal"; ?></textarea>
                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                  <thead>
                    <tr role="row">
                      <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending">預計事項</th>
                      <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">預計完成日期</th>
                      <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">完成率%</th>
                      <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">進度摘要</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr role="row" class="odd">
                      <td class="sorting_1"> <input name="pe1" class="form-control" required="true" value="<?php echo "$ex1"; ?>" type="text">
                      </td>
                      <td><?php echo date("Y-m-d", strtotime($start . "+$part day")); ?></td>
                      <td> <input name="f1" placeholder="一" class="form-control" required="true" value="<?php echo "$f1"; ?>" type="text">/20
                      </td>
                      <td> <input id="dpercent1" placeholder="" class="form-control" name="d1" type="text"><?php echo "$t1"; ?>
                      </td>
                    </tr>
                    <tr role="row" class="even">
                      <td class="sorting_1"> <input name="pe2" class="form-control" required="true" value="<?php echo "$ex2"; ?>" type="text">
                      </td>
                      <td><?php echo date("Y-m-d", strtotime($start . "+$part1 day")); ?></td>
                      <td> <input name="f2" placeholder="二" class="form-control" required="true" value="<?php echo "$f2"; ?>" type="text">/20
                      </td>
                      <td> <input id="dpercent2" placeholder="" class="form-control" name="d2" type="text"><?php echo "$t2"; ?>
                      </td>
                    </tr>
                    <tr role="row" class="odd">
                      <td class="sorting_1"> <input name="pe3" class="form-control" required="true" value="<?php echo "$ex3"; ?>" type="text">
                      </td>
                      <td><?php echo date("Y-m-d", strtotime($start . "+$part2 day")); ?></td>
                      <td> <input name="f3" placeholder="三" class="form-control" required="true" value="<?php echo "$f3"; ?>" type="text">/20
                      </td>
                      <td> <input id="dpercent3" placeholder="" class="form-control" name="d3" type="text"><?php echo "$t3"; ?>
                      </td>
                    </tr>
                    <tr role="row" class="even">
                      <td class="sorting_1"> <input name="pe4" class="form-control" required="true" value="<?php echo "$ex4"; ?>" type="text">
                      </td>
                      <td><?php echo date("Y-m-d", strtotime($start . "+$part3 day")); ?></td>
                      <td> <input name="f4" placeholder="四" class="form-control" required="true" value="<?php echo "$f4"; ?>" type="text">/20
                      </td>
                      <td> <input id="dpercent4" placeholder="" class="form-control" name="d4" type="text"><?php echo "$t4"; ?>
                      </td>
                    </tr>
                    <tr role="row" class="odd">
                      <td class="sorting_1"> <input name="pe5" class="form-control" required="true" value="<?php echo "$ex5"; ?>" type="text">
                      </td>
                      <td><?php echo "$end"; ?></td>
                      <td> <input name="f5" placeholder="五" class="form-control" required="true" value="<?php echo "$f5"; ?>" type="text">/20
                      </td>
                      <td> <input id="dpercent5" placeholder="" class="form-control" name="d5" type="text"><?php echo "$t5"; ?>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary" style="display:none;" id="icallback1" name="people" onclick="form.action='cache/message1.php?mid=<?php echo "$mid"; ?>';form.submit();" />送出</button>
                  <button class="btn btn-danger" id="icallno" style="display:none">取消</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!---人員配置--->
    <div class="card shadow mb-4">
      <a href="#collapseCardExample2" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample2">
        <h6 class="m-0 font-weight-bold text-primary">人員配置</h6>
      </a>
      <div class="collapse" id="collapseCardExample2">
        <div class="card-body">
          <div class="row">
            <?php
            $sql4 = "SELECT * FROM project_work where  number='$mid' ";
            $result4 = mysqli_query($db, $sql4);
            while ($row2 = mysqli_fetch_assoc($result4)) {
              $username = $row2['user_name'];
              $type1 = $row2['work_matter'];
              $wid = $row2['work_id'];
              if (!$username == NULL) {
            ?>
                <div class="col-6 mb-3 show" id="collapseCardExample<?php echo "$wid"; ?>">
                  <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-info text-uppercase mb-1" name="pp1"><?php echo "$username"; ?></div>
                          <div class="row no-gutters align-items-center">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" name="jj1"><?php echo "$type1"; ?></div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php if ($_SESSION['user_name'] == $principal or $_SESSION['user_name'] == '陳昇廷') { ?>
                  <div class="col-6">
                    <button type="submit" class="btn btn-danger" name="picadd12" onclick="form.action='deletetype.php?<?php echo "id=$mid&wid=$wid" ?>';form.submit();" />刪除</button>
                  </div>
                <?php } ?>
            <?php }
            } ?>
            <div class="col-12 text-center">
              <button class="btn btn-primary " id="people1">新增人員</button>
            </div>

          </div>
          <div id="people2" style="display:none;" class="mb-3">
            <div class="row">
              <input name="p1" placeholder="一" class="form-control" style="display:none" required="true" value="<?php echo "$mid"; ?>" type="text">
              <div class="col-6">
                <select class="form-control" name="p2">
                  <?php $seclect = "SELECT user_name FROM user where user_type='工程師'";
                  $res = mysqli_query($db, $seclect);
                  while ($row = mysqli_fetch_assoc($res)) {
                    $name = $row["user_name"]
                  ?>
                    　<option value="<?php echo $name ?>"><?php echo $name ?></option>
                  <?php } ?>

                </select>
              </div>
              <div class="col-6 mb-1">
                <input name="p3" placeholder="工作事項" class="form-control" value="" type="text">
              </div>
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary" style="display:none;" id="people" name="people1" onclick="form.action='peopleadd.php?mid=<?php echo "$mid"; ?>';form.submit();" />送出</button>
                <button class="btn btn-danger" id="peopleno">取消</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!---問題/留言--->
    <div class="card shadow mb-4">
      <a href="#collapseCardExample3" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample3">
        <h6 class="m-0 font-weight-bold text-primary">問題/留言</h6>
      </a>
      <div class="collapse" id="collapseCardExample3" style="">
        <div class="card-body">
          <div class="col-12 text-center mb-3">
            <button class="btn btn-primary " id="iquestion1">我有問題</button>
          </div>
          <div class="col-12">
            <div id="question1" style="display:none;" class="mb-3">
              <div class="row">
                <div class="col-4 mb-1">
                  <input name="thing" placeholder="標題" class="form-control" required="true" value="" type="text">
                </div>
                <input name="people" placeholder="留言人" style="display:none" class="form-control" readonly="readonly" required value="<?php echo "{$_SESSION['user_name']}"; ?>" type="text">
                <div class="col-8">
                  <input type="file" name="file6">
                </div>
                <div class="col-12 mb-1">
                  <textarea class="form-control" name="message" placeholder="請輸入訊息..."></textarea>
                </div>
                <div class="col-12 text-center">
                  <button class="btn btn-primary" type="submit" style="display:none;" id="question2" name="imessage2" onclick="form.action='questionadd.php?mid=<?php echo "$mid"; ?>';form.submit();" />送出</button>
                  <button class="btn btn-danger" id="question2no">取消</button>
                </div>
              </div>
            </div>
          </div>
          <?php
          $sql2 = "SELECT * FROM project_question where number='$mid' ORDER BY `project_question_time` DESC ";
          $result2 = mysqli_query($db, $sql2);
          @$num = mysqli_num_rows($result2);
          $number = 8;
          $page = ceil($num / $number);
          @$p = $_GET['p'];
          if ($p == '') {
            $p = 1;
          }
          $start = ($p - 1) * $number;
          $sql21 = "SELECT * FROM project_question where number='$mid' ORDER BY `project_question_time` DESC limit $start, $number";
          $result21 = mysqli_query($db, $sql21);
          for ($iq = 0; $iq < $num; $iq++) {
            while ($row2 = mysqli_fetch_assoc($result21)) {
              $name1 = $row2['user_name'];
              $type1 = $row2['q_type'];
              $question1 = $row2['project_question'];
              $qtime = $row2['project_question_time'];
              $file = $row2['file'];
              $qid = $row2['question_id'];
              $iq = $iq + 1;
          ?>
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample<?php echo "$qid"; ?>" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample<?php echo "$qid"; ?>">
                  <div class="row">
                    <div class="col-2">
                      <h5 class="m-0 font-weight-bold text-info"><?php echo "$type1"; ?>,</h5>
                    </div>
                    <div class="col-6">
                      <h6 class="m-0 font-weight-bold text-primary"><?php echo "$name1"; ?>說：<?php echo "$question1"; ?></h6>
                    </div>
                    <div class="col-2">
                      <h6 class="m-0 font-weight-bold text-secondary"><?php $turntime = date("Y-m-d", strtotime($qtime));
                                                                      $totaltime = (strtotime($datetime) - strtotime($qtime));
                                                                      $htime = $totaltime / 60;
                                                                      $hhtime = (round($htime));
                                                                      $atime = $totaltime / 3600;
                                                                      $aatime = (round($atime));
                                                                      if ($totaltime > 0 & $totaltime < 60) {
                                                                        echo "1分前";
                                                                      } elseif ($totaltime > 60 & $totaltime < 3600) {
                                                                        echo "$hhtime 分前";
                                                                      } elseif ($totaltime > 3600 & $totaltime < 86400) {
                                                                        echo "$aatime 時前";
                                                                      } else {
                                                                        echo "$turntime";
                                                                      } ?></h6>
                    </div>
                    <div class="col-2">
                      <div id="mnum<?php echo "$iq"; ?>"></div>
                    </div>
                  </div>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse" id="collapseCardExample<?php echo "$qid"; ?>">
                  <div class="card-body">
                    <?php if (!$file == NULL) { ?>
                      <a href="javascript:void(0)" class="btn btn-info btn-icon-split" onclick="window.open('<?php echo "$file" ?>');">
                        <span class="icon text-white-50">
                          <i class="fas fa-check"></i>
                        </span>
                        <span name="job1" class="text">查看圖片</span>
                      </a>
                    <?php  } ?>
                    <?php
                    $sql3 = "SELECT * FROM project_message where question_id='$qid' ORDER BY `message_time` DESC ";
                    $result31 = mysqli_query($db, $sql3);
                    $num1 = mysqli_num_rows($result31);
                    for ($i = 0; $i < $num1; $i++) {
                      while ($row3 = mysqli_fetch_assoc($result31)) {
                        $i = $i + 1;
                    ?>
                        <script>
                          $(document).ready(function() {
                            $("#messageclose<?php echo "$iq"; ?>").click(function() {
                              $("#question5<?php echo "$iq"; ?><?php echo "$i"; ?>").toggle();
                            });
                          });
                          setInterval(function() {
                            $('#question5<?php echo "$iq"; ?><?php echo "$i"; ?>').load("mquestion.php?qid=<?php echo $qid ?>")
                            $('#mnum<?php echo "$iq"; ?>').load("selectnum.php?qid=<?php echo $qid ?>")
                          }, 100);
                        </script>
                        <div class="pre-scrollable" id="question5<?php echo "$iq"; ?><?php echo "$i"; ?>"></div>
                        <?php if ($_SESSION['type'] ==  '老師') {
                        ?>
                          <input id="name<?php echo "$iq"; ?>" placeholder="姓名" class="form-control" value="">
                        <?php        } else { ?>

                          <textarea id="name<?php echo "$iq"; ?>" placeholder="" class="form-control " style="display:none" value=""><?php echo $_SESSION['user_name'] ?></textarea>
                        <?php } ?>
                        <textarea id="formid<?php echo "$iq"; ?>" placeholder="" class="form-control " style="display:none" value=""><?php echo $qid ?></textarea>
                        <textarea id="qid<?php echo "$iq"; ?>" placeholder="" class="form-control " style="display:none" value=""><?php echo $mid ?></textarea>
                        <textarea id="answer1<?php echo "$iq"; ?>" placeholder="請輸入回覆的內容"" class=" form-control " style=" word-break:break-all;" value=""></textarea>

                        <?php if ($_SESSION['user_name'] == "$name1") { ?>
                          <div class="col-12 text-center">
                            <button type="submit" class="btn btn-danger" id="delete" name="delete" onclick="form.action='deletequestion.php?time=<?php echo "$qtime"; ?>&mid=<?php echo "$mid"; ?>';form.submit();" />刪除</button>
                          </div>
                        <?php  } ?>
                  </div>
                </div>
                <script>
                  $.fn.onEnterKey =
                    function(closure) {
                      $(this).keypress(
                        function(event) {
                          var code = event.keyCode ? event.keyCode : event.which;

                          if (code == 13) {
                            closure();
                            return false;
                          }
                        });
                    }

                  $("#answer1<?php echo "$iq"; ?>").onEnterKey(function(e) {

                    $.post("messageadd1.php", {
                        name: $("#name<?php echo "$iq"; ?>").val(),
                        formid: $("#formid<?php echo "$iq"; ?>").val(),
                        answer1: $("#answer1<?php echo "$iq"; ?>").val(),
                        qid: $("#qid<?php echo "$iq"; ?>").val()
                      },

                      function(data, status) {
                        if (data == "y") {
                          $("#answer1<?php echo "$iq"; ?>").val("");


                        } else {
                          alert("傳送失敗");
                        }
                      });
                  });
                </script>

              </div>

          <?php break;
                      }

                      break;
                    }

          ?>

      <?php   }
          }
      ?>

      <p align="center">
        <?php
        for ($i = 1; $i <= $page; $i++) {
          echo "<a class='btn btn-dark' id='btn$i' href=message.php?mid=$mid&p=$i>$i</a> ";
        }

        ?>
      </p>
        </div>
      </div>
    </div>
    <div class="col-12 text-center">
      <button type="button" class="btn btn-danger" id="delete" onclick="TheConfirm()" />刪除專案</button>
    </div>



    <br><span id="check" style="color:red;"></span><br>
    <script>
      function TheConfirm() {
        var x;
        /*當按下確定按鈕時，傳true，反之傳false*/
        if (confirm("確定要刪除專案嗎!") == true) {
          /*當收到的值是true，把字串"You pressed OK!"的值設給x*/

          location.href = 'deleteproject.php?mid=<?php echo "$mid"; ?>';
        } else {
          x = "刪除失敗!";
        }
        /*把x得到的字串交給HTML中id為check的位置*/
        document.getElementById("check").innerHTML = x;
      }
    </script>
</div>

</form>
</div>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>
<script>
  $(document).ready(function() {
    $("#Q1_btn").click(function() {
      $("#A1_text").toggle();
    });
  });
</script>
<script>
  $(document).ready(function() {
    $("#R1_btn").click(function() {
      $("#R1_text").toggle();
    });
  });
</script>

<script>
  $(document).ready(function() {
    $("#address").click(function() {
      $("#address1").toggle();
    });
  });
</script>
<script>
  $(document).ready(function() {
    $("#address").click(function() {
      $("#address2").toggle();
    });
  });
</script>

<script>
  $(document).ready(function() {
    $("#icallback").click(function() {
      $("#callback").toggle();
    });
  });
</script>
<script>
  $(document).ready(function() {
    $("#icallback").click(function() {
      $("#icallback1").toggle();
    });
  });
</script>

<script>
  $(document).ready(function() {
    $("#cout").click(function() {
      $("#ques1").toggle();
    });
  });
</script>
<script>
  $(document).ready(function() {
    $("#people1").click(function() {
      $("#people2").toggle();
    });
  });
</script>
<script>
  $(document).ready(function() {
    $("#people1").click(function() {
      $("#people").toggle();
    });
  });
</script>
<script>
  $('#file').change(function() {
    var file = $('#file')[0].files[0];
    var reader = new FileReader;
    reader.onload = function(e) {
      $('#demo3').attr('src', e.target.result);
    };
    reader.readAsDataURL(file);
  });
</script>
<script>
  $('#file1').change(function() {
    var file = $('#file1')[0].files[0];
    var reader = new FileReader;
    reader.onload = function(e) {
      $('#demo1').attr('src', e.target.result);
    };
    reader.readAsDataURL(file);
  });
</script>

<script>
  $(document).ready(function() {
    $("#iquestion1").click(function() {
      $("#question1").toggle();
    });
  });
  $(document).ready(function() {
    $("#question2no").click(function() {
      $("#question1,#iquestion1,#question2").toggle();
    });
  });
</script>
<script>
  $(document).ready(function() {
    $("#iquestion1").click(function() {
      $("#question2").toggle();
    });
  });
</script>

<script>
  $(document).ready(function() {
    $("#iquestion1").click(function() {
      $("#iquestion1,#imessage1,#delete").toggle();
    });
  });
</script>
<script>
  $(document).ready(function() {
    $("#icallback").click(function() {
      $("#icallno,#callshow,#icallback").toggle();
    });
  });
  $(document).ready(function() {
    $("#icallno").click(function() {
      $("#icallno,#callshow,#callback,#icallback").toggle();
    });
  });
</script>
<script>
  $(document).ready(function() {
    $("#people1").click(function() {
      $("#people1,#imessage1,#iquestion1,#delete,#people").toggle();
    });
  });
  $(document).ready(function() {
    $("#peopleno").click(function() {
      $("#people1,#people2,#people").toggle();
    });
  });
</script>
<script>
  $(document).ready(function() {
    $("#addressno").click(function() {
      $("#address1,#address,#address2").toggle();
    });
  });
</script>
<script>
  $(document).ready(function() {
    $("#pic").click(function() {
      $("#pic1").toggle();
      $("#pic21").hide();
    });
  });
  $(document).ready(function() {
    $("#pic1no").click(function() {
      $("#pic1").toggle();
    });
  });
</script>
<script>
  $(document).ready(function() {
    $("#pic2").click(function() {
      $("#pic21").toggle();
      $("#pic1").hide();
    });
  });
  $(document).ready(function() {
    $("#pic2no").click(function() {
      $("#pic21").toggle();
    });
  });
</script>

</html>