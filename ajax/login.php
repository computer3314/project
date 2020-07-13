<?php
$email= $_POST["a"];


include('../db.php');

$sql = "SELECT * FROM user where user_name = '$email'";

$result = mysqli_query($db,$sql);
$row = @mysqli_fetch_assoc($result);

$name=$row['user_name'];


if($email==$name)

{

  echo "n";


}

else

{
      echo "y";
}


?>
