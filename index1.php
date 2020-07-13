<?php

require dirname(__FILE__) . '\silde.php';

?>

<!-- Begin Page Content -->
<form method="post" action="index1.php">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 mb-4">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h2 class="m-0 font-weight-bold text-primary text-center">所有專案</h2>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <div class="row">
                  <div class="col-3">
                  </div>
                  <div class="col-1">
                    <select name="Type" class="form-control ">
                      　<option value="all">專案</option>
                    </select>
                  </div>
                  <div class="col-4 mb-3">
                    <input type="text" class="form-control " placeholder="搜尋專案" name="keyword" id="keyword" aria-label="Search" aria-describedby="basic-addon2">
                  </div>
                  <div class="col-2">
                    <button class="btn btn-primary" type="submit">
                      <i class="fas fa-search fa-sm"></i>
                    </button>
                    <button class="btn btn-primary" type="submit">
                      瀏覽所有專案
                    </button>
                  </div>
                </div>
              </div>
              <?php

              @$s = $_POST['keyword'];

              $sql2 = "SELECT * FROM `project_father` where status='進行中' and name like '%$s%'";
              $result2 = mysqli_query($db, $sql2);
              @$num = mysqli_num_rows($result2);
              $number = 6;
              $page = ceil($num / $number);
              @$p = $_GET['p'];
              if ($p == '') {
                $p = 1;
              }
              $start = ($p - 1) * $number;
              $sql21 = "SELECT * FROM `project_father` where  status='進行中' and name like '%$s%' limit $start, $number";
              $result21 = mysqli_query($db, $sql21);

              while ($row2 = mysqli_fetch_assoc($result21)) {
                $name = $row2['name'];
                $start_time = $row2['start_time'];
                $end_time = $row2['end_time'];
                $number = $row2['number'];
                $principal = $row2['principal'];
                $total1 = 0;

              ?>
                <?php
                $sql = "SELECT * from project where f_number='$row2[number]'";
                $result = mysqli_query($db, $sql);
                $num = mysqli_num_rows($result);

                while ($row = mysqli_fetch_assoc($result)) {
                  $f1 = $row['completed_first'];
                  $f2 = $row['completed_second'];
                  $f3 = $row['completed_third'];
                  $f4 = $row['completed_fourth'];
                  $f5 = $row['completed_fifth'];
                  $total = $f1 + $f2 + $f3 + $f4 + $f5;
                  $total1 += $total;
                }
                @$total1 = $total1 /$num;
                $total1 = round($total1, 2);


                ?>
                <div class="col-lg-4 mb-4">
                  <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class=" font-weight-bold text-info text-uppercase mb-1"><?php echo "$name"; ?>&emsp; <small><?php echo "$start_time"; ?>~<?php echo "$end_time"; ?></small>
                            <div class=" small">負責人：<?php echo "$principal"; ?></div>
                          </div>
                          <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"> <?php echo "$total1"; ?>%</div>
                            </div>
                            <div class="col">
                              <div class="progress progress-sm mr-2">
                                <div class="progress-bar bg-info" role="progressbar" style="width:  <?php echo "$total1"; ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <a href="search1.php?key=<?php echo "$number"; ?>" class="btn btn-info mb-1">查看</a><br>

                        </div>
                      </div>

                    </div>
                  </div>

                </div>
              <?php   } ?>

            </div>
            <div class="col-lg-12 text-center">
              <p>
                <?php
                for ($i = 1; $i <= $page; $i++) {
                  echo "<a class='btn btn-dark text-center' id='btn$i' href=index1.php?p=$i>$i</a> ";
                }

                ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>




</body>

</html>
