<?php

require_once '../include/user.php';

$firstname="";
$lastname="";
$username = "";
$password = "";
$hashed_password="";

if(isset($_POST['Submit']))
{
 	$firstname = $_POST['Firstname'];
  $lastname = $_POST['Lastname'];
  $username = $_POST['EmailId'];
  $password = $_POST['Password'];
  
  $userObject = new User();
  $hashed_password = md5($password);
  $json_registration = $userObject->createNewRegisterUser($firstname." ".$lastname,$username, $hashed_password);


       if($json_registration['success']==1)
       {
           session_start();
           $_SESSION['user'] = $firstname;
           header("Location:../../../Frontend/index.php");
       }
       else
       {
           header("Location:../html/register.php");
       }




}
else {
  header("Location:../html/register.php");
}

?>
