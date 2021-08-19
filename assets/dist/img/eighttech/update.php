
<?php
include("connection.php");
error_reporting(0);
$ui=$_GET['ui'];
$us=$_GET['us'];
$upp=$_GET['upp'];
$ur=$_GET['ur'];
$ue=$_GET['ue'];
$uss=$_GET['uss'];
$up=$_GET['up'];
$ucd=$_GET['ucd'];
?>

<html>
<head>
  <title>updation</title>
</head>
<body>

     <center>
     <table>
           <form action="" method="GET">
               <tr>
               <td>User_id:</td>
               <td><input type="text" value="<?php echo "$ui" ?>"name="user_id" required><br><br></td>       
          </tr>
          <tr>
               <td>User Name:</td>
               <td><input type="text" value="<?php echo "$us" ?>"name="user_username" required><br><br></td>       
          </tr>
           <tr>
               <td>User_password:</td>
               <td><input type="text" value="<?php echo "$upp" ?>"name="user_password" required><br><br></td>        
          </tr>
          <tr>
               <td>User Role:</td>
               <td><input type="text"   value="<?php echo "$ur"?>"name="user_role" required><br><br></td>       
          </tr>
          <tr>
               <td>user email:</td>
               <td><input type="text"  value="<?php echo "$ue"?>"name="user_email" required><br><br></td>
          </tr>
          <tr>
               <td>user status:</td>
               <td><input type="text" value="<?php echo "$uss"?>"name="user_status" required><br><br></td>          
          </tr>
          <tr>
               <td>user phone:</td>
               <td><input type="text" value="<?php echo "$up"?>"name="user_phone" required><br><br></td>     
          </tr>
          <tr>
               <td>user created date :</td>
               <td><input type="text" value="<?php echo "$ucd"?>"name="user_created_date" required><br><br></td></tr>    
                    <tr>
               <td><input type="submit" name="submit" id="button" value="edit/update"> <br><br></td>
          </tr>
          </tr>

     </table>


     </form>
     </center>

</body>
</html>
<?php
if($_GET['submit'])
{
$user_id=  $_GET['user_id'];
$user_username=$_GET['user_username'];
$user_password=$_GET['user_password'];
$user_role=$_GET['user_role'];
$user_email=$_GET['user_email'];
$user_status=$_GET['user_status'];
$user_phone=$_GET['user_phone'];
$user_created_date=$_GET['user_created_date'];


$query = "UPDATE USERS set user_is='$user_id', user_username='$user_username', user_password='$user_password',user_role='$user_role',user_email='$user_email',user_status='$user_status',user_phone='$user_phone',user_created_date='$user_created_date' where user_id='$user_id'";


$update_data = mysqli_query($conn, $query);
}

if($data)
{
echo "<script>alert('record Updated')</script>";

}
else
{
   echo "failed to update record";  
}




?>