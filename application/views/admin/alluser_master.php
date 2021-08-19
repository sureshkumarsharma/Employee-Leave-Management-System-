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
                    <th>fathers_ame</th>
                    <th>date_of_birth</th>
                    <th>moblie_no</th>
                    <th>email_address</th>
                    <th>designation</th>
                     <th>total_salary</th>
                      <th>user_photo</th>
                     <th>address</th>
                    <th colspan="3"align="center">OperationS</th>
                  </tr>
<?php foreach ($masters as $key => $row) {   ?>
        <tr>
          <td><?php echo $row['id'];?></td>
          <td><?php echo $row['name'];?></td>
          <td><?php echo $row['fathers_name'];?></td>
          <td><?php echo $row['date_of_birth'];?></td>
          <td><?php echo $row['moblie_no'];?></td>
          <td><?php echo $row['email_address'];?></td>
          <td><?php echo $row['designation'];?></td>
          <td><?php echo $row['total_salary'];?></td>
          <td><img src="<?php echo base_url('assets/uploads/'.$row['user_photo']); ?>" style="height:50px"></td>
          <td><?php echo $row['address'];?></td>
          <td><a href ="<?php echo base_url('admin/edit-user-master/'.$row['id']); ?>" onclick="return confirm('Are you sure to update Record?');"><i class="fas fa-edit"></i></td>
          <td><a href="<?php echo base_url('admin/delete-user-master/'.$row['id']); ?>" onclick="return confirm('Are you sure to delete Record?');"><i class="fas fa-trash"></i></td>
            <td><a class="btn btn-primary" href="<?php echo base_url('admin/view-master-profile/'.$row['id']); ?>"><i class="fas fa-user"></i></td>
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