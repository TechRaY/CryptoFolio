<?php




function quantity($userid, $type)
{
	$con=mysqli_connect("localhost","root","","crypto");
	$query='Select count(buy*qty) from logs where  u_id="'.$userid.'" and c_type="'.$type.'"';
	$buy=mysqli_query($con,$query);
	$query='Select count(sell*qty) from logs where  u_id="'.$userid.'" and c_type="'.$type.'"';
	$sell=mysqli_query($con,$query);

	return $buy-$sell;
}




?>