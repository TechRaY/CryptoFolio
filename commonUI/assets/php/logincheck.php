<?php

require_once '../include/user.php';

$username = "";
$password = "";
$email = "";

if(isset($_POST['submit']))
{

if(isset($_POST['EmailId'])){
	$username = $_POST['EmailId'];
}
if(isset($_POST['Password'])){
    $password = $_POST['Password'];
}



$userObject = new User();


if(!empty($username) && !empty($password)){

  	$hashed_password = md5($password);
    $json_array = $userObject->loginUsers($username, $hashed_password);

    if($json_array['success']==1)
    {
        $_SESSION['user'] = $firstname;
        header("Location:../../../Frontend/index.html");
    }
    else
    {
        echo "<script>alert('Invalid Username Or Password');
        window.location = '../html/login.php';
        </script>";

    }

}

}
else{
  header("Location:../html/login.php");
}


?>
