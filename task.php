<?php

require dirname(__FILE__) . '\silde.php';
//silde bar

?>

<div class="container well">
  <div class="container-fluid">
    <br>
    <div class="row">
      <!---進行中專案--->
      <div class="col-12">
        <div class="card shadow mb-4">
          <!-- Card Header - Accordion -->
          <a href="#collapseCardExample1" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample1">
            <h6 class="m-0 font-weight-bold text-primary">進行中專案</h6>
          </a>
          <!-- Card Content - Collapse -->
          <div class="collapse show" id="collapseCardExample1">
            <div class="card-body">
              <div class="row">
                <div class="col-7">
                  <h3 class="text-primary">專案名稱</h3>
                </div>
                <div class="col-4">
                  <h5 class="text-primary">起迄日</h5>
                </div>
                <div class="col-1">
                </div>
              </div>
              <?php
              include('db.php');
              $sql = "SELECT * FROM project where principal='$_SESSION[user_name]' and status='進行中'";
              $result = mysqli_query($db, $sql);
              while ($row = mysqli_fetch_assoc($result)) {
                $name = $row['name'];
                $principal = $row['principal'];
                $number = $row['number'];
                $start_time = $row['start_time'];
                $end_time = $row['end_time'];
              ?>
                <div class="row">
                  <div class="col-7">
                    <h3><?php echo "$name"; ?></h3>
                  </div>
                  <div class="col-4">
                    <h5><?php echo "$start_time"; ?>~<?php echo "$end_time"; ?></h5>
                  </div>
                  <div class="col-1">
                    <a href="message.php?mid=<?php echo "$number"; ?>" class="btn btn-primary">進度</a>
                  </div>
                </div>
              <?php  } ?>
            </div>
          </div>
        </div>
      </div>
      <!---工作事項--->
      <div class="col-12">
        <div class="card shadow mb-4">
          <a href="#collapseCardExample2" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample2">
            <h6 class="m-0 font-weight-bold text-primary">工作事項</h6>
          </a>
          <div class="collapse show" id="collapseCardExample2">
            <div class="card-body">
              <div class="row">
                <div class="col-7">
                  <h3 class="text-primary">專案名稱</h3>
                </div>
                <div class="col-4">
                  <h5 class="text-primary">種類</h5>
                </div>
                <div class="col-1">
                </div>
              </div>
              <?php
              $sql1 = "SELECT * FROM project_work where user_name='$_SESSION[user_name]'";
              $result1 = mysqli_query($db, $sql1);
              while ($row1 = mysqli_fetch_assoc($result1)) {
                $name = $row1['user_name'];
                $work_matter = $row1['work_matter'];
                $number = $row1['number'];

                $a1 = "SELECT * FROM project where status='進行中' and number='$number'  ";
                $a = mysqli_query($db, $a1);
                while($row2 = mysqli_fetch_assoc($a)){
                $q = $row2['name'];
              ?>
                <div class="row">
                  <div class="col-7">
                    <h3><?php echo "$q"; ?></h3>
                  </div>
                  <div class="col-4">
                    <h5><?php echo "$work_matter"; ?></h5>
                  </div>
                  <div class="col-1">
                    <button type="button" class="btn btn-primary" id="message1" onclick="javascript:location.href='message.php?mid=<?php echo $number ?>'" />查看</button>
                  </div>
                </div>
              <?php  }} ?>
            </div>
          </div>
        </div>
      </div>
      <!---待辦事項--->
      <div class="col-12">
        <div class="card shadow mb-4">
          <!-- Card Header - Accordion -->
          <a href="#collapseCardExample3" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample3">
            <h6 class="m-0 font-weight-bold text-primary">待辦事項</h6>
          </a>
          <!-- Card Content - Collapse -->
          <div class="collapse show" id="collapseCardExample3">
            <div class="card-body">
              <div class="row">
                <div class="col-1 text-primary">
                  單號
                </div>
                <div class="col-2 text-primary">
                  專案名稱
                </div>
                <div class="col-1 text-primary">
                  申請人
                </div>
                <div class="col-3 text-primary">
                  時間
                </div>
                <div class="col-2 text-primary">
                  預計時間
                </div>
              </div>
              <?php
              $sql1 = "SELECT * FROM project_father where principal='$_SESSION[user_name]'";
              $result1 = mysqli_query($db, $sql1);
              while ($row1 = mysqli_fetch_assoc($result1)) {
                $name = $row1['name'];
                $sql11 = "SELECT * FROM process where project='$name' and state='已核可'";

                $res11 = mysqli_query($db, $sql11);
                $num11 = mysqli_num_rows($res11);
                for ($i = 0; $i <= $num11; $i++) {
                  while ($row11 = mysqli_fetch_assoc($res11)) {
                    $state = $row11["state"];
                    $file = $row11["file"];
                    $i = $i + 1
              ?>
                    <div class="row">
                      <div class="col-1">
                      <?php echo "$row11[id]"; ?>
                      </div>
                      <div class="col-2">
                      <?php echo "$row11[project]"; ?>
                      </div>
                      <div class="col-1">
                      <?php echo "$row11[name]"; ?>
                      </div>
                      <div class="col-3">
                      <?php echo "$row11[time]"; ?>
                      </div>
                      <div class="col-3">
                      <?php echo "$row11[strat]"; ?>~<?php echo "$row11[end]"; ?>
                      </div>
                      <div class="col-2">
                      <?php if ($state != "") {
                        echo '<h6  style="color:red">需要插隊</h6>';
                      } ?>
                      </div>
                      <div class="col-8">
                        <font class="text-primary">敘述：</font><?php echo "$row11[thing]"; ?>
                      </div>
                      <div class="col-2">
                      <?php if (!$file == NULL) { ?><a href="javascript:void(0)" class="btn btn-primary" onclick="window.open('<?php echo "$file" ?>', '', 'width=800,height=800');">查看檔案</a> <?php  } ?>
                    </div>
                    <div class="col-2">
                    <button class="btn btn-primary" id="f1<?php echo $i ?>">完成</button>
                    </div>
                    </div>
                      <script>
                        $("#f1<?php echo $i ?>").click(function() {
                          $.post("upfinish.php", {
                              id: <?php echo "$row11[id]"; ?>,
                            },
                            function(data, status) {

                              location.reload();

                            });
                        });
                      </script>
                <?php  }
                }
              } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



</body>

</html>