  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create_payslip</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Create_payslip</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>id</th>
                    <th>name</th>
                     <th>designation</th>
                    <th>Basic_Salary</th>
                    <th>Total_Allowance</th>
                    <th>Total_Deduction</th>
                    <th>total_Salary</th>
                    <th>Opraction's</th>
                  </tr>
<?php foreach ($masters as $key => $row) {   ?>
        <td>
          <?php echo $row['id'];?></td>
          <td><?php echo $row['name'];?></td>
           <td><?php echo $row['designation'];?></td>
          <td><?php echo $row['Basic_Salary'];?></td>
          <td><?php echo $row['Total_Allowance'];?></td>
           <td><?php echo $row['Total_Deduction'];?></td>
          <td><?php echo $row['total_salary'];?></td>
          <td><a href ="<?php echo base_url('admin/invoice-print-master/'.$row['id']); ?>" onclick="return confirm('Are you sure you want payslip-print?');">Ganrate payslip</td>
        </tr>
        <?php } ?>

                  </thead>
                  
                  </tfoot>
                </table>
              </div>
            
            </div>
    

           
      <!-- /.container-fluid --> 
    </section>
    <!-- /.content -->
  </div>