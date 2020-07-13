<?php

require dirname(__FILE__) . '\silde.php';
//silde bar
?>
</nav>

<?php
@$fid = $_GET['fid'];
@$fname = $_GET['fname'];
?>
<div class="container">
  <div class="card border-left-info shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col-12 mr-2">
          <div class="text-lg font-weight-bold text-info text-uppercase mb-1"><?php echo "$fname"; ?>  <small><?php echo "$start_time"; ?>~<?php echo "$end_time"; ?></small>
          </div>
        </div>
      </div>
      <form class="well form-horizontal" action="test1.php" method="post" Enctype="multipart/form-data">
      <div class="row">
        <?php if ($fid != null) { ?>
          <div class="form-group" style="display:none">
            <div class="col-md-8 inputGroupContainer">
              <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="fullName" name="fname" placeholder="專案名稱" class="form-control" required="true" value="<?php echo "$fname"; ?>" type="text"></div>
              <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="fullName" name="fid" placeholder="專案號碼" class="form-control" required="true" value="<?php echo "$fid"; ?>" type="text"></div>
            </div>
          </div>
        <?php } ?>
          <div class="col-8">
        子項目名稱/模組
        <input id="fullName" name="fullName" placeholder="專案名稱" class="form-control" required="true" value="<?php echo "$fname -"; ?>" type="text">
          </div>
          <div class="col-4">
        項目負責人
        <select class="form-control" name="principal">
          <?php $seclect = "SELECT user_name FROM user where user_type='工程師'";
          $res = mysqli_query($db, $seclect);
          while ($row = mysqli_fetch_assoc($res)) {
            $name = $row["user_name"]


          ?>
            　<option value="<?php echo $name ?>"><?php echo $name ?></option>
          <?php } ?>

        </select>
          </div>

        <div class="col-6">
        期程
        <input id="addressLine1" name="addressLine1" placeholder="起日" class="form-control" required="true" value="" type="date">
        </div>
        <div class="col-6">
          <br>
        <input id="addressLine1" name="addressLine2" placeholder="止日" class="form-control" required="true" value="" type="date">
        </div>
        <div class="col-12 text-center mt-3">
        <button type="submit" name="add" class="btn btn-primary" onclick="return confirm('是否確認送出這筆資料');">送出</button>
        </div>
      </div>
      </form>

    </div>


    <!-- js -->
    <script>
      $('#file').change(function() {
        var file = $('#file')[0].files[0];
        var reader = new FileReader;
        reader.onload = function(e) {
          $('#demo').attr('src', e.target.result);
        };
        reader.readAsDataURL(file);
      });
    </script>
    <script>
      $('#file1').change(function() {
        var file = $('#file1')[0].files[0];
        var reader = new FileReader;
        reader.onload = function(e) {
          $('#demo1').attr('src', e.target.result);
        };
        reader.readAsDataURL(file);
      });
    </script>

  </div>


  </form>

  </td>
  </tr>
  </tbody>
  </table>
</div>

</div>

</body>


</html>