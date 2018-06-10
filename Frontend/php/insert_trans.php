<?php
	session_start();
	$con = mysqli_connect("localhost","root","","crypto");

	    $curr = $_POST['curr'];
	    $exc = $_POST['exc'];
    	$quant = $_POST['quant'];
        $buy =  $_POST['buy'];
        $dt = $_POST['dt'];
        $amt = $_POST['amt'];
        $uid = $_SESSION['user'];
        $sell = 1-$buy;

        $sql = "INSERT INTO logs(u_id,c_type,qty,c_price,tym,buy,sell) VALUES ('$uid','$curr','$quant','$amt','$dt','$buy','$sell')";
    	$res = mysqli_query($con,$sql);
    	if(!$res)
        {
            echo "Error Occurred";
        }
        else
            echo "Insert Successfully";



?>