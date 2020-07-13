<?php
$email= $_POST["u"];


include('../db.php');

$sql = "SELECT * FROM user where user_email = '$email'";

$result = mysqli_query($db,$sql);
$row = @mysqli_fetch_assoc($result);

$name=$row['user_email'];


if($email==$name)

{

  echo "n";


}

else

{
      echo "y";
}


?>
