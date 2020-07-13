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

<style>
  ul {
    margin: 0;
  }
</style>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index1.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SBL Project <sup>*</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index1.php">
          <i class="fas fa-fw fa-home"></i>
          <span>首頁(專案總覽)</span></a>
      </li>
      <?php
      if ($_SESSION['type'] ==  '工程師'  or $_SESSION['type'] ==  '主管' or $_SESSION['type'] == '老師' or $_SESSION['type'] ==  '工會') {
      ?>
        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">
          功能
        </div>
        <!-- Nav Item - Charts -->
        <li class="nav-item">
          <a class="nav-link" href="ftest.php">
            <i class="fas fa-plus "></i>
            <span>建立專案</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="task.php">
            <i class="fas fa-user-tie "></i>
            <span>個人任務</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesa" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-clipboard-list"></i>
            <span>待辦事務申請</span>
          </a>
          <div id="collapsePagesa" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="getthing.php">申請表單</a>
              <a class="collapse-item" href="display.php">查看進度</a>
            </div>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="keyin.php">
            <i class="fas fa-shield-alt "></i>
            <?php $QQ = "SELECT * FROM `registered`";
            $AA = mysqli_query($db, $QQ);
            @$N = mysqli_num_rows($AA);
            if ($N > 0) { ?>
              <span style="color:red">待審核人員<sup><?php echo $N ?></sup></span></a><?php } else { ?>
          <span>待審核人員(<?php echo $N ?>)</span></a><?php  } ?>
        </li>
      <?php
      }

      ?>
      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
        進行中的專案
      </div>
      <?php
      $sql6 = "SELECT * FROM `project_father` where status='進行中'";
      $result6 = mysqli_query($db, $sql6);
      $num7 = mysqli_num_rows($result6);
      for ($z = 0; $z <= $num7; $z++) {
        while ($row = mysqli_fetch_assoc($result6)) {
          $jobname = $row["name"];
          $id = $row["number"];
          $start_time = $row['start_time'];
          $end_time = $row['end_time'];
          $principal = $row['principal'];
          $z = $z + 1;
      ?>
          <!-- Nav Item - Tables -->
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages<?php echo "$z" ?>" aria-expanded="true" aria-controls="collapsePages">
              <span><?php echo $jobname ?></span>
            </a>
            <div id="collapsePages<?php echo "$z" ?>" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="search1.php?key=<?php echo $id ?>"><?php echo $jobname ?></a>
                <ol>
                  <?php
                  $sql7 = "Select * from project where f_number =$id";
                  $result7 = mysqli_query($db, $sql7);

                  while ($row7 = mysqli_fetch_assoc($result7)) {
                    $name7 = $row7["name"];
                    $id7 = $row7["number"];
                  ?>
                    <li>
                      <a class="collapse-item" href="message.php?mid=<?php echo $id7 ?>"><?php echo substr(strrchr($name7, "-"), 1); ?></a>
                    </li>
                  <?php } ?>
                </ol>
                <a class="collapse-item" href="test.php?fid=<?php echo $id ?>&fname=<?php echo $jobname ?>">建立子專案</a>
              </div>
            </div>
          </li>

      <?php }
      } ?>
      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
        其他
      </div>
      <!-- Nav Item - Tables -->

      <li class="nav-item">
        <a class="nav-link" href="gantti.php">
          <i class="fas fa-fw fa-eye"></i>
          <span>甘特圖</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-check-circle "></i>
          <span>已完成</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">已完成專案</h6>
            <?php
            $sql7 = "Select * from project_father where status='完成'";
            $result7 = mysqli_query($db, $sql7);

            while ($row7 = mysqli_fetch_assoc($result7)) {
              $name7 = $row7["name"];
              $id7 = $row7["number"];
            ?>
              <a class="collapse-item" href="search1.php?key=<?php echo $id7 ?>">
                <?php echo $name7 ?></a>
            <?php } ?>

          </div>


        </div>
      </li>
      <hr class="sidebar-divider d-none d-md-block">

      <div id="people"></div>
      <script>
        setInterval(function() {

          $('#people').load("online.php")
        }, 100);
      </script>
    </ul>
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
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in " aria-labelledby="messagesDropdown">
                <div class="pre-scrollable">
                  <h6 class="dropdown-header text-center" style="position: -webkit-sticky;
position: sticky;
top: 0px;">
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
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo "{$_SESSION['user_name']}{$_SESSION['type']},您好!"; ?></span>
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

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
          <i class="fas fa-angle-up"></i>
        </a>