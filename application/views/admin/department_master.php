

<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h4 class="box-title">Department Master </h4>
         </div>
         <!-- /.col -->
         <div class="col-sm-5">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="#">Welcome </a></li>
               <br>
               <div class="top-right">
                  <div class="header-menu">
                     <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <!-- <?php //echo $_SESSION['NAME']?> -->
                              
                           </a>
                        <div class="user-menu dropdown-menu">
                           <a class="nav-link" href="logout.php"><i class="fa fa-power-off"></i>Logout</a>
                        </div>
                     </div>
                  </div>
               </div>
            </ol>
         </div>
         <!-- /.col -->
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="content pb-0">
   <div class="orders">
      <div class="row">
         <div class="col-xl-12">
            <div class="card">
               <div class="card-body">
                  <h4 class="box_title_link"><a href="<?php echo base_url('admin/add-department'); ?>">Add Department</a> </h4>
               </div>
               <div class="card-body--">
                  <div class="table-stats order-table ov-h">
                     <table class="table ">
                        <thead>
                           <tr>
                              <th width="10%">S.No</th>
                              <th width="10%">ID</th>
                              <th width="60%">Department Name</th>
                              <th colspan="2"align="center">Opraction's</th>
                           </tr>
                        </thead>
                        <?php  if(count($departments) > 0){ 

                         foreach ($departments as $key => $department) {

                           
                           

                                    #print_r($department);exit();

                                 ?>
                                    
                                    <tr>
                                       <td><?php echo $key+1; ?></td>
                                       <td><?php echo $department['id']; ?></td>
                                       <td><?php echo $department['department']; ?></td>
                                       <td>
                                          <a href="<?php echo base_url('admin/edit-department-master/'.$department['id']); ?>" onclick="return confirm('Are you sure to update Record?');"><i class="fas fa-edit"></i></a> 
                                          <a href="<?php echo base_url('admin/delete-department-master/'.$department['id']); ?>"onclick="return confirm ('Are you sure to delete Record?');"><i class="fas fa-trash"></i></a>
                                       </td>
                                    </tr>
                                 <?php } }else{ ?>

                                    <tr><td align="center" colspan="4">No record found !</td></tr>

                                 <?php } ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>