<?php
include('connection.php');
 $user_username =$_POST['user_username'];
 $user_password =$_POST['user_password'];
 $user_role =$_POST['user_role'];
 $user_email =$_POST['user_email'];
 $user_status =$_POST['user_status'];
 $user_phone =$_POST['user_phone'];
 $user_created_date =$_POST['user_created_date'];



 $sql =mysqli_query($conn,"insert into users(user_username,user_password,user_role,user_email,user_status,user_phone,user_created_date) values('$user_username','$user_password','$user_role','$user_email','$user_status','$user_phone','$user_created_date')");
 if($sql){
 	echo "deta inserted successfull";
 }
else{
	echo "failed to  insert";
}
header("Location:display.php");

exit;
?>
