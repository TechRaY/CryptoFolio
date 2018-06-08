<?php

require_once '../include/user.php';

$firstname="";
$lastname="";
$username = "";
$password = "";
$contact="";
$address="";
$hashed_password="";

if(isset($_POST['Submit']))
{
 	$firstname = $_POST['Firstname'];
  $lastname = $_POST['Lastname'];
  $username = $_POST['EmailId'];
  $password = $_POST['Password'];
  $contact=$_POST['phne'];
  $address=$_POST['Address'];

  $userObject = new User();
  $hashed_password = md5($password);
  $json_registration = $userObject->createNewRegisterUser($firstname,$lastname,$username, $hashed_password,$address,$contact);


       if($json_registration['success']==1)
       {
           header("Location:../html/topics.php");
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
