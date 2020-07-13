<?php session_start();
include('db.php');
$mid = $_GET["mid"];
?>
<div class="row mb-3 mt-3">
  <div class="col-6">
    <div class="card bg-info text-white shadow">
      <div class="card-body">
        介面元素圖
        <button class="btn" id="big">查看</button>
        <button class="btn" style="display:none;" id="close">關閉</button>
      </div>
    </div>
  </div>
  <div class="col-6">
    <div class="card bg-warning text-white shadow">
      <div class="card-body">
      施作元件圖
      <button class="btn" id="big1">查看</button>
        <button class="btn" style="display:none;" id="big2">關閉</button>
      </div>
    </div>
  </div>
</div>

<section name="news" id="c1" class="bg-light py-3" style=" background-size: 100%; display:none;">
  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <?php
    $sql10 = "SELECT * FROM front where number='$mid'";
    $result10 = mysqli_query($db, $sql10);
    while ($row10 = mysqli_fetch_assoc($result10)) { ?>
    <?php } ?>
    <div class="carousel-inner">
      <div class="carousel-item active" id="ativa">
        <?php
        $sql10 = "SELECT * FROM front where number='$mid'";
        $result10 = mysqli_query($db, $sql10);
        @$num10 = mysqli_num_rows($result10);
        while ($row10 = mysqli_fetch_assoc($result10)) {
          $img = $row10['img'];
          $description = $row10['description'];
          $src = $row10['upload'];
          $id = $row10['id'];
          $sid = $row10['sid'];
        ?>
          <font color=orange><?php echo $sid ?></font>
          <A class=p1 title="thumbnail image"><img class="d-block w-100" id="img1" src="<?php echo $img; ?> "><IMG class=large title="Beauty" style=" height: 100vh;width: 100%;" src="<?php echo $img; ?> "></A>
          <input type="text" class="form-control" readonly="readonly" value="<?php echo "$description"; ?>">
          <div align="center"><button type="button" class="btn btn-danger" id="delete8" name="delete8" onclick="form.action='deletefront.php?id=<?php echo "$id"; ?>&mid=<?php echo "$mid"; ?>';form.submit();" />刪除</button><?php if (!$src == NULL) { ?>
              <a href="javascript:void(0)" onclick="window.open('<?php echo "$src" ?>', '', 'width=800,height=800');">查看</a>
            <?php } ?></div>
        <?php break;
        } ?>
      </div>
      <?php
      $sql10 = "SELECT * FROM front where number='$mid' limit 1,10 ";
      $result10 = mysqli_query($db, $sql10);
      @$num10 = mysqli_num_rows($result10);
      while ($row10 = mysqli_fetch_assoc($result10)) {
        $img = $row10['img'];
        $description = $row10['description'];
        $sid = $row10['sid'];
        $src = $row10['upload'];
        $id = $row10['id'];
      ?>
        <div class="carousel-item" id="ativa">
          <font color=orange><?php echo $sid ?></font>
          <A class=p1 title="thumbnail image"><img class="d-block w-100" id="img2" src="<?php echo $img; ?>"><IMG class=large title="Beauty" style=" height: 100vh;width: 100%;" src="<?php echo $img; ?> "></A>
          <input type="text" class="form-control" readonly="readonly" value="<?php echo "$description"; ?>">
          <div align="center"><button type="button" class="btn btn-danger" id="delete8" name="delete8" onclick="form.action='deletefront.php?id=<?php echo "$id"; ?>&mid=<?php echo "$mid"; ?>';form.submit();" />刪除</button><?php if (!$src == NULL) { ?>
              <a href="javascript:void(0)" onclick="window.open('<?php echo "$src" ?>', '', 'width=800,height=800');">查看</a>
            <?php } ?></div>
        </div>

      <?php   } ?>

    </div>
  </div>
</section>
<section name="news" id="c2" class="bg-light py-3" style=" background-position: center; background-size: 60%; background-repeat: repeat; display:none;">
  <div id="carouselIndicators1" class="carousel slide" data-interval="10000">
    <ol class="carousel-indicators">
      <?php
      $sql9 = "SELECT * FROM back where number='$mid'";
      $result9 = mysqli_query($db, $sql9);
      while ($row9 = mysqli_fetch_assoc($result9)) {
      ?>
        <li data-target="#carouselIndicators1" data-slide-to="0" class="active"></li>
      <?php  } ?>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active" id="ativa">
        <?php
        $sql9 = "SELECT * FROM back where number='$mid'";
        $result9 = mysqli_query($db, $sql9);
        @$num9 = mysqli_num_rows($result9);
        while ($row9 = mysqli_fetch_assoc($result9)) {
          $img = $row9['img'];
          $description = $row9['description'];
          $src1 = $row9['upload'];
          $id1 = $row9['id'];
          $sid1 = $row9['sid'];
        ?>
          <font color=orange><?php echo $sid1 ?></font>
          <A class=p1 title="thumbnail image"> <img class="d-block w-100" id="img1" src="<?php echo $img; ?>"><IMG class=large title="Beauty" style=" height: 100vh;width: 100%;" src="<?php echo $img; ?> "></A>
          <input type="text" class="form-control" readonly="readonly" value="<?php echo "$description"; ?>">
          <div align="center"><button type="button" class="btn btn-danger" id="delete9" name="delete9" onclick="form.action='deleteback.php?id=<?php echo "$id1"; ?>&mid=<?php echo "$mid"; ?>';form.submit();" />刪除</button> <?php if (!$src1 == NULL) { ?>
              <a href="javascript:void(0)" onclick="window.open('<?php echo "$src1" ?>', '', 'width=800,height=800');">查看</a>
            <?php } ?>
          </div>
        <?php break;
        } ?>
      </div>
      <?php
      $sql9 = "SELECT * FROM back where number='$mid' limit 1,10";
      $result9 = mysqli_query($db, $sql9);
      @$num9 = mysqli_num_rows($result9);
      while ($row9 = mysqli_fetch_assoc($result9)) {
        $img = $row9['img'];
        $description = $row9['description'];
        $src1 = $row9['upload'];
        $id1 = $row9['id'];
        $sid1 = $row9['sid'];
      ?>
        <div class="carousel-item" id="ativa">
          <font color=orange><?php echo $sid1 ?></font>
          <A class=p1 title="thumbnail image"><img class="d-block w-100" id="img2" src="<?php echo $img; ?>"><IMG class=large title="Beauty" style=" height: 100vh;width: 100%;" src="<?php echo $img; ?> "></A>
          <input type="text" class="form-control" readonly="readonly" value="<?php echo "$description"; ?>">
          <div align="center"><button type="button" class="btn btn-danger" id="delete9" name="delete9" onclick="form.action='deleteback.php?id=<?php echo "$id1"; ?>&mid=<?php echo "$mid"; ?>';form.submit();" />刪除</button> <?php if (!$src1 == NULL) { ?>
              <a href="javascript:void(0)" onclick="window.open('<?php echo "$src1" ?>', '', 'width=800,height=800');">查看</a>
            <?php } ?></div>
        </div>
      <?php   } ?>
    </div>
  </div>
</section>

<script>
  $(document).ready(function() {
    $("#close").click(function() {
      $("#c1,#close,#big").toggle();
    });
  });
</script>
<script>
  $(document).ready(function() {
    $("#big").click(function() {
      $("#c1,#close,#big").toggle();
    });
  });
</script>

<script>
          $(document).ready(function() {
            $("#big2").click(function() {
              $("#c2,#big1,#big2").toggle();
            });
          });
        </script>
        <script>
          $(document).ready(function() {
            $("#big1").click(function() {
              $("#c2,#big1").toggle();
            });
          });
        </script>
        <script>
          $(document).ready(function() {
            $("#big1").click(function() {
              $("#big2").toggle();
            });
          });
        </script>