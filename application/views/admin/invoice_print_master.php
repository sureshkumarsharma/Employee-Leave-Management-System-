<?php $id = $this->uri->segment(3);



$masters = $this->User_mo->get_user_invoice_details($id); 


?>
<?php $id = $this->uri->segment(3);



$masters = $this->User_mo->get_user_invoice_details($id); 


?>


<!DOCTYPE html>
<html>
<head>
  <title>EIGHTTECH PROJECTS </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="                              sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      
</head>
<body>
  <div><h1>EIGHTTECH PROJECTS</h1><hr style="height:2px;border-width:1;color:blue;background-color:blue">
    </div><br>
  <table cellspacing="0" cellpadding="20" width="50%">
    <tr>
      <?php foreach ($masters as $key => $row) {   ?>
      <td>Employee Name  :<?php echo $row['name'];?></td>
    </tr>
  </table>
   <table  cellspacing="0" cellpadding="20" width="50%" align="right-top" >
    <tr>
      <td>Designation :<?php echo $row['designation'];?></td>
    </tr>
  </table>
    <table border="1px black" cellspacing="0" cellpadding="10" align="center" style="height 100px">
      <tr>
        <th>EARNINGS </th>
        <th>PER MONTH </th>
      </tr>
       <tr>
        <th>Basic_Salary</th>
        <th><?php echo $row['Basic_Salary'];?></th>
      </tr>
       <tr>
        <th>Total_Allowance</th>
        <th><?php echo $row['Total_Allowance'];?></th>
      </tr>
      <tr>
        <th>Total_Deduction</th>
        <th><?php echo $row['Total_Deduction'];?></th>
      </tr>
      <tr>
        <th>Net Payable Salary in Words</th>
        <th><?php echo $row['total_salary'];?></th>
      </tr>  
         <?php } ?>
    </table>
</body>
</html>