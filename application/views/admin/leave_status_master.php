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
                            
                     <th>Sr.No</th>
                     <th>to</th>
                     <th>from</th>
                     <th>status</th>
                    </tr>
                    
                    <?php foreach ($leave as $key => $row) { ?>
                              
                    <tr>
                        <td><?php echo $row['id'];?></td>
                        <td><?php echo $row['leave_from'];?></td>
                        <td><?php echo $row['leave_to'];?></td>
                        <td>
                          <?php if($row['leave_status']==1){ echo "Pending"; } ?>
                          <?php if($row['leave_status']==2){ echo "Approved"; } ?>
                          <?php if($row['leave_status']==3){ echo "Rejected"; } ?>                  
                     </td>
                     <td>
                     <?php
                     if($row['leave_status']==1){ ?>
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
 