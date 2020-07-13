<?php
  @$mid=$_GET['mid'];
  $conn=new PDO('mysql:host=localhost;dbname=project','root','1234');
  $statement = $conn->query("SELECT * FROM project WHERE number = '$mid'");
  foreach($statement as $row){
      ?>
      <script language="javascript">
document.write('<img src=data:image/png;base64,<?php echo $row['img6'];?>>');
</script>
<?php
  }
?>
