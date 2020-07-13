<?php

require dirname(__FILE__) . '\head.php';

?>
<?php session_start();
if ($_SESSION['user_name'] != null) {
  $datetime = date("Y-m-d H:i:s", mktime(date('H') + 6, date('i'), date('s'), date('m'), date('d'), date('Y')));
  include('db.php');
} else {
  echo '您無權限觀看此頁面!';

  header('Location: index.php');
}

?>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php
    require dirname(__FILE__) . '\slide100.php';
    ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>


          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>
            <marquee width=100% style="font-size:36px ;font-family:微軟正黑體; color:#FF44AA">
              系統開發準則：１、準：<small>明訂: 案名、科名 　起日、止日</small>
              ２、穩：<small>製作: 前端設計元素圖 　後端施作元件圖</small>
              ３、快：<small>節奏: 效率效果為強 　延宕為恥</small>
            </marquee>

            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <?php
                $sql6 = "SELECT * FROM `meshistory`";
                $result6 = mysqli_query($db, $sql6);
                $num7 = mysqli_num_rows($result6); ?>
                <span class="badge badge-danger badge-counter"><?php echo $num7 ?></span>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header text-center">
                  未讀訊息
                </h6>
                <?php

                $sql6 = "SELECT * FROM `meshistory` ORDER BY `meshistory`.`time` DESC ";
                $result6 = mysqli_query($db, $sql6);
                $num7 = mysqli_num_rows($result6);

                while ($row = mysqli_fetch_assoc($result6)) {
                  $name = $row["name"];
                  $formid = $row["formid"];
                  $qid = $row["qid"];
                  $thing = $row["thing"];
                  $selectproject = "SELECT * FROM `project` where number='$formid'";
                  $res = mysqli_query($db, $selectproject);
                  $row = mysqli_fetch_assoc($res);
                  $name1 = $row["name"];

                ?>
                  <a class="dropdown-item d-flex align-items-center" href="message.php?mid=<?php echo $formid ?>">
                    <div class="font-weight-bold">
                      <div class="small text-gray-500"><?php echo $name ?>-><?php echo $name1 ?>:</div>
                      <div class="text-truncate"><?php echo  $thing ?></div>
                    </div>
                  </a>
                <?php } ?>

                <!---<a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                    <div class="small text-gray-500">Chicken the Dog · 2w</div>
                  </div>
                </a>--->
                <a class="dropdown-item text-center small text-gray-500" href="#">閱讀更多訊息</a>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo "{$_SESSION['user_name']}{$_SESSION['type']},您好!"; ?></span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="logout.php">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  登出
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">專案管理系統</h1>
          </div>


          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-12 mb-4">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h2 class="m-0 font-weight-bold text-primary text-center">所有專案</h2>
                </div>
                <div class="card-body">
                  <div class="row">
                    <?php

                    $sql2 = "SELECT * FROM `project_father` where status='進行中'";
                    $result2 = mysqli_query($db, $sql2);
                    @$num = mysqli_num_rows($result2);
                    $number = 6;
                    $page = ceil($num / $number);
                    @$p = $_GET['p'];
                    if ($p == '') {
                      $p = 1;
                    }
                    $start = ($p - 1) * $number;
                    $sql21 = "SELECT * FROM `project_father` where status='進行中' limit $start, $number";
                    $result21 = mysqli_query($db, $sql21);

                    while ($row2 = mysqli_fetch_assoc($result21)) {
                      $name = $row2['name'];
                      $start_time = $row2['start_time'];
                      $end_time = $row2['end_time'];
                      $number = $row2['number'];
                      $principal = $row2['principal'];


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
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                  </div>
                                  <div class="col">
                                    <div class="progress progress-sm mr-2">
                                      <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-auto">
                                <a href="search1.php?key=<?php echo "$number"; ?>" class="btn btn-info mb-1">查看</a><br>
                            <a href="father.php?mid=<?php echo "$number"; ?>" class="btn btn-info">進度</a>

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
                        echo "<a class='btn btn-dark text-center' id='btn$i' href=index1.php?p=$i>$i</a>";
                      }

                      ?>
                    </p>
                  </div>
                </div>
              </div>


            </div>

          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>


  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>