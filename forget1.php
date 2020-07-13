<?php

require dirname(__FILE__) . '\head.php';

?>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block">
      <img src="img/SBL.png" alt="" style="width:550px;height:600px">
            </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4" style="font-size:30px;"><font color="purple">SBL Project Management System</font></h1>
                  </div>
                  <?php
                  @$check=$_GET["check"];
                  @$email=$_GET["email"];

                  ?>
          <form class="form" name="form1" method="post" action="" data-toggle="validator">

                    <?php
                    if(@!$check==null){

?>
<div class="form-group">
  <input type="password" class="form-control form-control-user" style="font-size:20px" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,30}$" data-error="請輸入至少一個大寫和一個小寫字母及數字，至少8個字元。"  required="required" id="inputPassword"  name="newpassword"  placeholder="password">
    <div class="help-block with-errors" style="color:red"></div>
</div>
<div class="form-group">
  <input type="password" class="form-control form-control-user"  required="required" style="font-size:20px" id="exampleInputEmail" data-match="#inputPassword"  data-error="密碼未吻合！" name="newpassword1"  placeholder="Enter your password again">
  <div class="help-block with-errors"></div>
</div>

<input type="submit" name="button" value="
change password" onclick="form.action='forget.php?email=<?php echo $email ?>';form.submit();" style="font-size:20px" class="btn btn-primary btn-user btn-block">
<?php
                  }
                  else{

                    ?>
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user"  style="ime-mode:active;font-size:20px" id="exampleInputEmail" name="user_email" aria-describedby="emailHelp" placeholder="e-mail...">
                    </div>
                  <input type="button" name="button" style="font-size:20px" onclick="form.action='PHPMailer-master/src/sendmail0.php';form.submit();" value="
      Send url to e-mail" class="btn btn-primary btn-user btn-block">
    <?php  }
                    ?>

                    <div class="form-group">

                    </div>





                    <hr>


                  <hr>




                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
          </form>
    </div>

  </div>


</body>

</html>
