  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Department 1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Leave </h4>
               
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                            
                     <th> #SR</th>
                     <th>user_id</th>
                     <th>Name</th>
                     <th>Designation</th>
                     <th>from</th>
                     <th>to</th>
                     <th>description</th>
                     
                     <th>Action</th>
                     <th>Delete</th>
                                    </tr>

                      <?php foreach ($leave as $key => $row) {    ?>
        <tr> 

              <td><?php echo $key+1;?></td>
          <td><?php echo  $row['user_id'];?></td> 
          <td><?php echo  $row['name'];?></td>
          <td><?php echo  $row['designation'];?></td>
          <td><?php echo  $row['leave_from'];?></td>
          <td><?php echo  $row['leave_to'];?></td>
          <td><?php echo  $row['leave_description'];?></td>
        <td>
                       
                       
                       <select class="form-control" id="action-<?php echo $row['id'];?>" name="action-id" onchange="update_leave_status('<?php echo $row['id']?>');">
                      <option value="1" <?php if($row['leave_status']==1){ echo "selected"; } ?>>Pending</option>
                      <option value="2" <?php if($row['leave_status']==2){ echo "selected"; } ?>>Approved</option>
                      <option value="3" <?php if($row['leave_status']==3){ echo "selected"; } ?>>Rejected</option>
                       </select>
                  
                     </td>
                     <td>
                     <?php
                     if($row['leave_status']==1){ ?>
                     <a href="<?php echo base_url('admin/delete-leave-status-master/'.$row['id']); ?>" class="btn btn-danger">Delete</a>
                     <?php } ?>
                     
                     
                     </td>
                     
                                    </tr>
                  <?php 
                  } ?>


                                 </thead>
                                 <tbody>
                              </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
      </div>
     
    </section>
    <!-- /.content -->
  </div>
  <script type="text/javascript">
    
    function update_leave_status(leave_id){

        var action = $("#action-"+leave_id).val();
        
        $.ajax({
                url : "<?php echo base_url('admin/leave-request-action'); ?>",
                type: "POST",
                data : {id:leave_id,action:action},
                success: function(response)
                {
                    ///data - response from server
                }
        });
    }

  </script>