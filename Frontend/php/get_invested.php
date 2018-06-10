<?php
session_start();
echo get_mkt_val($_SESSION['user'],$_POST['curr']);


function get_mkt_val($userid, $type)
{
	$con=mysqli_connect("localhost","root","","crypto");
	$query='Select sum(buy*qty*c_price) from logs where  u_id="'.$userid.'" and c_type="'.$type.'"';
	$res=mysqli_query($con,$query);
	$buy = 0;
    if (FALSE != $res)
	{
		$row = mysqli_fetch_row($res);
		$buy = $row[0];
	}
	$query='Select count(sell*qty*c_price) from logs where  u_id="'.$userid.'" and c_type="'.$type.'"';
	$sell = 0;
    if (FALSE != $res)
	{
		$row = mysqli_fetch_row($res);
		$sell = $row[0];
	}

	return $buy-$sell;
}




?>