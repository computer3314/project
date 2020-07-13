<?php

require dirname(__FILE__) . '\silde.php';
?>

<div class="container">
   <form class="well form-horizontal" action="ftest1.php" method="post" Enctype="multipart/form-data">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">建立專案</h6>
         </div>
         <div class="card-body">
            <div class="row">
               <div class="col-4 mb-3">
                  <input id="fullName" name="fullName" class="form-control" placeholder="專案名稱/模組" required="true" value="" type="text">
               </div>
               <div class="col-8"></div>
               <div class="col-4">
                  <input id="principal" name="principal" placeholder="專案負責人" style="display:none" class="form-control" required="true" value="<?php echo $_SESSION['user_name'] ?>" type="text">
                  <input id="addressLine1" name="addressLine1" placeholder="起日" class="form-control" required="true" value="" type="date">
               </div>
               <div class="col-4">
               <input id="addressLine1" name="addressLine2" placeholder="止日" class="form-control" required="true" value="" type="date">
               </div>
               <button type="submit" name="add" class="btn btn-primary" onclick="return confirm('是否確認送出這筆資料');">送出</button>
            </div>
         </div>
      </div>
   </form>

</div>
</div>

</body>

</html>