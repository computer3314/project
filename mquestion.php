<?php
session_start();
$datetime = date("Y-m-d H:i:s", mktime(date('H') + 6, date('i'), date('s'), date('m'), date('d'), date('Y')));
include('db.php');
$qid = $_GET["qid"];
$sql3 = "SELECT * FROM project_message where question_id='$qid' ORDER BY `message_time` DESC ";
$result3 = mysqli_query($db, $sql3);
$num1 = mysqli_num_rows($result3);

?>

<?php
$i = 0;
  while ($row3 = mysqli_fetch_assoc($result3)) {
    $name2 = $row3['user_name'];
    $question2 = $row3['message'];
    $qtime1 = $row3['message_time'];
  
?>
    <?php if (!$name2 == null) {
    ?>
      <form name="form" id="form" method="post" action="" style="overflow-x:hidden;">
        <div class="row">
          <div class="col-10 mb-3" style="background:lightgray">
            <div class="row">
              <div class="col-10">
                <h5 class="text-primary"><?php echo "$name2"; ?>：<?php echo "$question2"; ?></h5>
                <input id="zone<?php echo $i ?>" style="display:none" value="<?php echo "$qtime1"; ?>" type="text">
              </div>
              <div class="col-2">
                <?php $turntime = date("Y-m-d", strtotime($qtime1));
                $totaltime = (strtotime($datetime) - strtotime($qtime1));
                $htime = $totaltime / 60;
                $hhtime = (round($htime));
                $atime = $totaltime / 3600;
                $aatime = (round($atime));
                if ($totaltime >= 0 & $totaltime < 60) {
                  echo "1分前";
                } elseif ($totaltime > 60 & $totaltime < 3600) {
                  echo "$hhtime 分前";
                } elseif ($totaltime > 3600 & $totaltime < 86400) {
                  echo "$aatime 時前";
                } else {
                  echo "$turntime";
                } ?>
              </div>
            </div>
          </div>
          <?php if ($_SESSION['user_name'] == "$name2") { ?>
            <div class="col-2">
              <button id="delete<?php echo $i ?>" class="btn btn-danger">刪除</button>
            </div>
          <?php  } ?>
        </div>
      <?php } ?>
      </form>
  <?php
  $i = $i + 1;
  }


mysqli_close($db);
  ?>

  <script>
    $("#delete<?php echo $i ?>").click(function() {

      $.post("deletemessage.php", {
          time: $("#zone<?php echo $i ?>").val()
        },
        function(data, status) {
          alert("成功刪除留言")
        });
    });
  </script>