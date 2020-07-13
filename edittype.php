<?php
include('db.php');
$mid = $_GET['mid'];
$name = $_GET['name'];
$id = $_GET['id'];
$sql = "SELECT * FROM `project_work` where number='$id' AND user_name='$name'";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);
$matter = $row['work_matter'];
$wid = $row['work_id'];

?>
<?php session_start();
if ($_SESSION['user_name'] != null) {
} else {
  echo '您無權限觀看此頁面!';

  header('Location: index.php');
} ?>
<html>
<section class="bg-light" name="admin_news">
  <div class="container">
    <form action="" Enctype="multipart/form-data" method="post">
      <div class="card mt-2 animate-in-down ">
        <textarea name="p1" style="width:150px;height:50px;" placeholder="人員" class="form-control" required="true" value="" type="text"><?php echo "$name"; ?></textarea>
        <textarea class="form-control" name="t1" placeholder="事項"><?php echo "$matter"; ?></textarea>
        <button type="submit" id="message1" onclick="form.action='edittype1.php?id=<?php echo "$id"; ?>&wid=<?php echo "$wid"; ?>';form.submit();" />送出</button>

      </div>
    </form>
  </div>
</section>

</html>