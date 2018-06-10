<?php
session_start();
echo quantity($_SESSION['user'],$_POST['curr']);


function quantity($userid, $type)
{
	$con=mysqli_connect("localhost","root","","crypto");
	$query='Select sum(buy*qty) from logs where  u_id="'.$userid.'" and c_type="'.$type.'"';
	$res=mysqli_query($con,$query);
	$buy = 0;
    if (FALSE != $res)
	{
		$row = mysqli_fetch_row($res);
		$buy = $row[0];
	}
	$query='Select sum(sell*qty) from logs where  u_id="'.$userid.'" and c_type="'.$type.'"';
	$res=mysqli_query($con,$query);
	$sell = 0;
    if (FALSE != $res)
	{
		$row = mysqli_fetch_row($res);
		$sell = $row[0];
	}
    
	return $buy-$sell;
}




?>