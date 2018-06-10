<?php

echo get_mkt_val($_SESSION['user'],$_POST['curr']);


function get_mkt_val($userid, $type)
{
	$con=mysqli_connect("localhost","root","","crypto");
	$query='Select sum(buy*qty*c_price) from logs where  u_id="'.$userid.'" and c_type="'.$type.'"';
	$buy=mysqli_query($con,$query);
	$query='Select count(sell*qty*c_price) from logs where  u_id="'.$userid.'" and c_type="'.$type.'"';
	$sell=mysqli_query($con,$query);

	return $buy-$sell;
}




?>