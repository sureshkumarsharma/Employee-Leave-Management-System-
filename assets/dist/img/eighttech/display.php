<html>
	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		</head>
	<body>
		<table class="table">
			<tr>
				<td><a href="form.html" class="btn btn-info">Add User</a></th>
			</tr>
			<tr>
				<th>User_id</th>
				<th>User_username</th>
				<th>User_password</th>
				<th>User_Role</th>
				<th>User_email</th>
				<th>User_status</th>
				<th>User_phone</th>
				<th>User_created_date</th>
				<th>Operation</th></a>
			
			</tr>

<?php
include("connection.php");
error_reporting(0);
$query = "SELECT * FROM USERS" ;

$data = mysqli_query($conn,$query);
$total = mysqli_num_rows($data);
  if($total!=0)
  {

             while($result =mysqli_fetch_assoc($data))
			{
				echo "
				<tr>
				   <td>".$result['user_id']."</td>
					<td>".$result['user_username']."</td>
					<td>". $result['user_password']."</td>
					<td>".$result['user_role']."</td>
					<td>".$result['user_email']."</td>
					<td>". $result['user_status']."</td>
					<td>". $result['user_phone']." </td>
					<td>". $result['user_created_date']."</td>
					<td><a href ='update.php?ui=$result[user_id]&us=$result[user_username]& upp=$result[user_password]& ur=$result[user_role] & ue=$result[user_email]& uss=$result[user_status]& up=$result[user_phone]& ucd=$result[user_created_date]'>Edit/update</td>
					<td><a href ='delete.php?ui=$result[user_id]' onclick='return confirm('Are you sure to delete Record?');'>'Delete</td>
				</tr>";
		    }
  }
 else 
 {

      echo "Table has records";

}
?>
</table>
</body>
</htnl>
