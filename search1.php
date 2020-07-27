<?php

require dirname(__FILE__) . '\silde.php';
//silde bar
?>


<div class="container well">

  <div class="container-fluid">
    <form method="post" id="form">
      <div class="row">
        <?php
        include('db.php');
        @$s = $_GET['key'];

        $sql = "Select * from project where f_number=$s";
        $result = mysqli_query($db, $sql);
        @$num = mysqli_num_rows($result);

        for ($i = 0; $i < $num; $i++) {
          while ($row2 = mysqli_fetch_assoc($result)) {
            $name = $row2['name'];
            $start_time = $row2['start_time'];
            $end_time = $row2['end_time'];
            $principal = $row2['principal'];
            $number = $row2['number'];
            $completed_first = $row2['completed_first'];
            $completed_second = $row2['completed_second'];
            $completed_third = $row2['completed_third'];
            $completed_fourth = $row2['completed_fourth'];
            $completed_fifth = $row2['completed_fifth'];
            $total = $completed_first + $completed_second + $completed_third + $completed_fourth + $completed_fifth;

        ?>

            <div class="col-6 mb-3 order-1">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class=" font-weight-bold text-primary text-uppercase mb-1"><?php echo substr(strrchr($name, "-"), 1) ?><br><small><?php echo "$start_time"; ?>~<?php echo "$end_time"; ?></small>
                        <div class=" small">負責人：<?php echo "$principal"; ?></div>
                      </div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo "$total"; ?>%</div>
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-primary" role="progressbar" style="width:  <?php echo "$total"; ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <a href="message.php?mid=<?php echo "$number"; ?>" class="btn btn-primary">查看</a>

                    </div>
                  </div>

                </div>
              </div>

            </div>
        <?php   }
        }

        ?>
        <?php
        //get傳來的資料

        $sql = "SELECT * FROM project_father
            WHERE  number =$s ";

        //連接資料庫
        //從project資料表搜尋
        @$result = mysqli_query($db, $sql);

        @$row = mysqli_fetch_array($result);
        $name = $row['name'];
        $principal = $row['principal'];
        $start = $row['start_time'];
        $end = $row['end_time'];
        $address = $row['address'];
        $address1 = $row['address1'];
        ?>
        <div class="col-12 mb-3">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-lg font-weight-bold text-info text-uppercase mb-1"><?php echo "$name"; ?>  <small><?php echo "$start"; ?>~<?php echo "$end"; ?></small>
                    <?php
                    $sql = "SELECT * from project where f_number=$s";
                    $result = mysqli_query($db, $sql);
                    $num = mysqli_num_rows($result);
                    while ($row = mysqli_fetch_assoc($result)) {
                      $f1 = $row['completed_first'];
                      $f2 = $row['completed_second'];
                      $f3 = $row['completed_third'];
                      $f4 = $row['completed_fourth'];
                      $f5 = $row['completed_fifth'];
                      $total = $f1 + $f2 + $f3 + $f4 + $f5;
                      $total = $total / 100;
                      $min = 100 / ($num);
                      $all[] = $total * $min;
                    }

                    @$temp = array_sum($all);
                    @$total = round($temp, 2);
                    if ($total == 100) {
                      $sql = "UPDATE `project_father` SET `status` = '完成' WHERE `project_father`.`number` = $s";
                      $result = mysqli_query($db, $sql);
                    } else {
                      $sql = "UPDATE `project_father` SET `status` = '進行中' WHERE `project_father`.`number` = $s";
                      $result = mysqli_query($db, $sql);
                    }
                    ?>
                    <div class=" small text-info">總完成率</div>
                  </div>
                  <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"> <?php echo "$total"; ?>%</div>
                    </div>
                    <div class="col-12 mb-3">
                      <div class="progress progress-sm mr-2">
                        <div class="progress-bar bg-info" role="progressbar" style="width:  <?php echo "$total"; ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="row">
                        <div class="col-2">
                          <a class="btn btn-success mb-3" href="javascript:void(0)" onclick="window.open('<?php echo "$address"; ?>', '', '');">前台連結</a>
                          <br>
                          <a class="btn btn-warning mb-3" href="javascript:void(0)" onclick="window.open('<?php echo "$address1"; ?>', '', '');">後台連結</a>
                          <br>
                        </div>
                        <div class="col-8" id="upaddress">
                          <input name="A1" class="form-control mb-3" required="true" value="<?php echo "$address"; ?>" type="text">
                          <input name="A2" class="form-control mb-3" required="true" value="<?php echo "$address1"; ?>" type="text">
                        </div>

                      </div>
                    </div>
                    <div class="col-12 text-center" id="submitaddress">

                      <button class="btn btn-primary" type="button"><a class="" style="color:white" href="test.php?fid=<?php echo $id ?>&fname=<?php echo $jobname ?>">建立子專案</a></button>
                      <button class="btn btn-primary" type="submit" id="address2" name="address2" onclick="form.action='faddresss.php?mid=<?php echo "$s"; ?>';form.submit();" />送出</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </form>
    <?php if ($_SESSION['type'] !==  '老師') {
    ?>
      <div class="col-12 text-center">
        <a class="btn btn-info" href="test.php?fid=<?php echo $s ?>&fname=<?php echo $name ?>">建立子項目
        </a>
        <button type="button" class="btn btn-danger" id="delete" onclick="TheConfirm()" />刪除專案</button>

      </div>

    <?php }
    ?>
  </div>
</div>
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>
<script>
  function TheConfirm() {
    top.location.href = "deleteproject.php?mid=<?php echo $s ?>";
  }
  $(document).ready(function() {
    $("#upaddressbtn").click(function() {
      $("#upaddressbtn,#upaddress,#submitaddress,#upaddressbtndiv").toggle();
    });
  });
</script>
<script>
  $(document).ready(function() {
    $("#Q1").click(function() {
      $("#A1").toggle();
    });
  });
</script>
<script>
  $(document).ready(function() {
    $("#imessage").click(function() {
      $("#message").toggle();
    });
  });
</script>
<script>
  var tag = 0;
  $(function() {
    $("#add").click(function() {
      $('#card').after(
        '<div id="card" class="card" style="width: 30rem;"><div class="card-header text-center">目前進度：94%</div><div class="card-body"><h3 class="card-title text-center">中央五院智識庫</h3><h5 class="card-text text-center">起訖日期：2019/08/02~2019/09/02</h5><br><div class="text-center"><a href="message.php" class="btn btn-primary">查看</a></div></div></div>'
      );
      tag++;
    });
    $("#del").click(function() {
      $("#card").remove();
    });
  })
</script>
</body>

</html>