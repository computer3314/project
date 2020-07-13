<?php

require dirname(__FILE__) . '\silde.php';
//silde bar
?>
</nav>

<!-- End of Topbar -->

<!------ Include the above in your HEAD tag ---------->

<div class="container">
  <h1 style="text-align:center;font-size:25px" class="col-lg-12">待辦事務申請表</h1>

  <form class="well form-horizontal" action="g1.php" method="post" Enctype="multipart/form-data">
    <div class="row">
      <div class="col-2">
        <b class="text-primary textbox px-1">申請人</b>
        <input type="text" name="people" class="form-control" value="<?php echo $_SESSION['user_name'] ?>"  readonly>
      </div>

      <div class="col-4">
        <b class="text-primary textbox px-1">選擇專案</b>
        <select class="form-control" id="project" name="project">
          <option selected disabled>請選擇欲交辦事務專案</option>
          <option style="color:blue" disabled>進行中</option>
          <?php $seclect = "SELECT * FROM project_father where status='進行中'";
          $res = mysqli_query($db, $seclect);
          while ($row = mysqli_fetch_assoc($res)) {
            $name = $row["name"]
          ?>
            　<option value="<?php echo $name ?>"><?php echo $name ?></option>
          <?php } ?>
          <option style="color:blue" disabled>已完成</option>
          <?php $seclect = "SELECT * FROM project_father where status='完成'";
          $res = mysqli_query($db, $seclect);
          while ($row = mysqli_fetch_assoc($res)) {
            $name = $row["name"]
          ?>
            　<option value="<?php echo $name ?>"><?php echo $name ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="col-2"><br>
        <input style="width:20px;height:20px;vertical-align:middle" type="checkbox" name="fast" id="fast" value="yes">插隊
      </div>
      <div class="col-4">
        <b class="text-primary textbox px-1">上傳文件</b>
        <input type="file" name="file6" id="file6">
      </div>
      <div class="col-12 mb-1">
        <b class="text-primary textbox px-1">交辦事項</b>
        <textarea class="form-control" id="content" name="contect" required name="Contect" rows="5" data-error="不能為空"></textarea>
      </div>
      <div class="col-12 text-center">
        <button class="btn btn-primary" name="register" id="register">送出</button>
      </div>

    </div>
</div>
</form>

</div>
</div>
</div>


</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="login.html">Logout</a>
      </div>
    </div>
  </div>
</div>


</body>

</html>
