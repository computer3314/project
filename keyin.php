<?php

require dirname(__FILE__) . '\silde.php';
//silde bar
?>

<div class="container well">
  <div class="container-fluid">


    <br>
    <div class="row">

      <form name="form" method="post" action="">

          <label class="col-md-4 control-label">待審核人員</label>
            <br>
            <?php
            include('db.php');
            $sql = "SELECT * FROM registered where state=0";
            $result = mysqli_query($db, $sql);


            while ($row = mysqli_fetch_assoc($result)) {
              $name = $row['user_name'];
              $type = $row['user_type'];
              $email = $row['user_email'];
              $password = $row['user_password'];



            ?>

                <input  name="name" class="form-control mb-1" placeholder="姓名" class="form-control" readonly="readonly" required="true" value="<?php echo "$email"; ?>" type="text">
                <input  name="name" class="form-control mb-1" placeholder="姓名" class="form-control" readonly="readonly" required="true" value="<?php echo "$name"; ?>" type="text">
                <input  name="type" class="form-control mb-1" placeholder="類型" class="form-control" readonly="readonly" required="true" value="<?php echo "$type"; ?>" type="text">
                <button type="submit" id="message1" onclick="form.action='PHPMailer-master/src/sendmail.php?user_email=<?php echo "$email"; ?>&user_name=<?php echo "$name"; ?>&user_type=<?php echo "$type"; ?>&user_password=<?php echo "$password"; ?>';form.submit();" />核准</button>
                <button type="submit" id="message1" onclick="form.action='deletere.php?user_email=<?php echo "$email"; ?>';form.submit();" />刪除</button>
            <?php  } ?>
         

      </form>

    </div>
    <br>

  </div>
</div>
<!-- End of Content Wrapper -->
</div>

</html>