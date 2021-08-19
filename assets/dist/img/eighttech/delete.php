<?php
include("connection.php");
error_reporting(0);

$user_id=$_GET['user_id'];
$query = " Delete from users where user_id ='$user_id' ";

$data=mysqli_query($conn, $query);

	if($data)
	{

      echo"<font color ='green'>RECORD DELETE FROM DETABASE";

	}
	else
	{
		echo"<font color ='red'>RECORD NOT DELETE FROM DETABASE";
	}

	header("Location:display.php");
	exit;
?>