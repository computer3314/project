
<?php
include('db.php');
$sec="SELECT * FROM ccol";
$res=mysqli_query($db,$sec);
$row=mysqli_num_rows($res);

?>
<li class="nav-item active">
  <a class="nav-link" >

    <span style="color:white">目前在線人數:<?php echo $row?>人</span></a>
</li>
