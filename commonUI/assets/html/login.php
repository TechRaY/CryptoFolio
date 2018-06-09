<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title>CryptoFolio</title>


<link href="../css/style.css" rel="stylesheet">
<link href="../css/main.css" rel="stylesheet">
<link href="../css/font-awesome.min.css" rel="stylesheet">
<link href="../css/animate-custom.css" rel="stylesheet">
<link href="../css/login.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>
<script src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/modernizr.custom.js"></script>

<link rel="stylesheet" href="../css/loader2.css"  type="text/css"  />

<script type="text/javascript">

$(document).ready(function() {	
	
	$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");;
	});
	
})

</script>

</head>

<div class="se-pre-con"></div>
<body data-spy="scroll" data-offset="0" data-target="#navbar-main">
<div id="navbar-main">
  <!-- Fixed navbar -->
  <div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <a class="navbar-brand" href="../../index.php"><i class="fa fa-location-arrow"></i> CryptoFolio</a> </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="../../index.php" >Home</a></li>
          <li><a href="cryptocurrencies.php" >coins</a></li>
          <li> <a href=""> Register/Login</a></li>
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
  </div>
</div>


<div class="cover">
             <div class="error"> </div>            <!--To display error messages-->
                 <div class="jumbotron container-fluid maincontent">
          <ul class="nav nav-tabs nav-justified navy">
            <li role="presentation" id="signupitem"  ><a href="register.php">Register</a></li>
            <li role="presentation" id="loginitem" class="active"><a href="#">Login</a></li>
      </ul>

      <div class="content-white">

      <form id="loginform" method="POST" action="../php/logincheck.php">


     <div class="form-group">
               <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
              <input type="email" class="form-control input-lg" name="EmailId" id="Email-Id" placeholder="user_id">
              </div>
          </div>

           <div class="form-group">
               <div class="input-group password">
               <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
              <input type="password" class="form-control input-lg" name="Password" placeholder="Password">
                  </div>
          </div>




          <div class="password-forgot">
          <a href="#"><b>Forgot your password</b></a>
          </div>


          <div class="text-center">
              <button type="submit" class="text-center btn btn-primary btn-lg" name="submit">Login</button>
        </form>

        </div>


</div>
</div>
</div>






          <link href='https://fonts.googleapis.com/css?family=Sirin+Stencil' rel='stylesheet' type='text/css'>
          <link href='https://fonts.googleapis.com/css?family=Fjalla+One' rel='stylesheet' type='text/css'>
          <link href='https://fonts.googleapis.com/css?family=IM+Fell+English+SC' rel='stylesheet' type='text/css'>
          <link href='https://fonts.googleapis.com/css?family=Mada' rel='stylesheet' type='text/css'>
          <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">

<?php
require_once("footer.php");
?>
