<?php

include('connection.php');


$user_id = $_POST['user_id'];
$user_username = $_POST['user_username'];
$user_role = $_POST['user_role'];
$user_email = $_POST['user_email'];
$user_status = $_POST['user_status'];
$user_phone = $_POST['user_phone'];
$user_created_date = $_POST['user_created_date'];


$update_query = "update users set user_username='".$user_username."', user_role='".$user_role."', user_email='".$user_email."',user_status='".$user_status."',user_phone='".$user_phone."' where user_id='".$user_id."'";

$update_data = mysqli_query($conn, $update_query);

header("Location:display.php");
exit;

?>