<?php

require dirname(__FILE__) . '\head.php';

?><?php if(@$_COOKIE["email"]!="")
{
    echo exit('<script>top.location.href="autologin.php"</script>');
} ?>
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
                  <div class="text-center"
                    <h1 class="h4 text-gray-900 mb-4" style="font-size:30px;"><font color="purple">SBL 專案管理系統</font></h1>
                  </div>

                  <form class="form" method="post" action="" data-toggle="validator">
                    <div class="form-group">
                      <input id="Email" name="user_email" class="form-control form-control-user" type="text"  style="ime-mode:active" placeholder="電子郵件地址" data-error="郵件格式錯誤" required="required">
                      <div class="help-block with-errors" style="color:red"></div><span id="ts"></span>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user"  data-error="請輸入至少一個大寫和一個小寫字母及數字，至少8個字元。" required id="Password"  name="user_password"  placeholder="password">
                        <div class="help-block with-errors" style="color:red"></div>
                    </div>
                    <script>
                        function refresh_code(){
                            document.getElementById("imgcode").src="captcha.php";
                        }
                    </script>
                    <p>請輸入驗證碼:</p><p><img id="imgcode" width="50%" src="captcha.php" onclick="refresh_code()" /><br />
                    </p>
                    <input type="number" id="checkword"  required size="10" maxlength="10" />
                    <div class="form-group">
                    <br/>  <input type="button" id="button" value="登入" class="btn btn-primary btn-user btn-block">
                    </div>
               <span id="td"></span>
                  <div class="custom-control custom-checkbox small">
                    <input type="checkbox" class="custom-control-input" id="customCheck">
                    <label class="custom-control-label" for="customCheck">記住帳號</label>
                  </div>
                  <a class="nav-link" href="registered.html">
                    <span>建立帳號</span></a>
                    <a class="nav-link" href="forget1.php">
                      <span>忘記密碼</span></a>


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

  <!-- Bootstrap core JavaScript-->



  <!-- Core plugin JavaScript-->


  <!-- Custom scripts for all pages-->

  <script>

  //當滑鼠失去焦點時顯示
  $("#Email").blur(function(){
    var formData = new FormData();

        formData.append("u", $("#Email").val());
        $.ajax({
        url: 'ajax/loginemail.php',
          type: 'post',
          data: formData,
          processData: false,
          contentType: false,
          success: function(data) {
            if(data=="y")
    {
      $("#ts").html("資料庫中無此信箱,請重新填寫！");
      $("#ts").css("color","blue");

    }
    else
    {
      $("#ts").html("");
      $("#ts").css("color","red");

    }
          },

        });
  })

  $("#button").click(function() {
  $.post("login.php", {
      Email: $("#Email").val(),
      checkword: $("#checkword").val(),
    Password: $("#Password").val()
    },
    function(data, status) {
    newData=data.replace(/\s/g,'');
if(newData=="n"){   $("#td").html("密碼錯誤,請重新輸入");
  $("#td").css("color","red");}
else if(newData=="c"){
  window.location.href='index1.php';
}
else{
  $("#td").html("驗證碼錯誤,請重新輸入");
    $("#td").css("color","red");
}
    });
});
</script>
</body>

</html>
