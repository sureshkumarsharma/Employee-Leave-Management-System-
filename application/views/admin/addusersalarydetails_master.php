<script src="<?php echo site_url() ?>public/assets/js/jquery-1.11.1.min.js"></script>
<script type='text/javascript' src='<?php echo site_url() ?>public/assets/js/jquery.validate.min.js'></script>
<script type="text/javascript">

   </script>
<style>
.error {
  color:red;
  padding-top: 5px;
}
</style>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
           <h4 class="box-title">User Salary Details Form </h4>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


   
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-body card-block">
                          <?php 
                          if($this->session->flashdata('msg'))
                            { ?>
                            <div class="alert aleret-danger" role="alert">
                              <strong>alert</strong><?php echo $this->session->flashdata('msg');?>
                            </div>
                            <?php }
                            ?>
                          <form action="<?php echo base_url('admin/addusersalarydetails_master'); ?>" method="post" enctype="multipart/form-data" id="addusersalarydetails">

                            <div class="col-md-1">
                                  <div class="form-group designaction-error">
                                     <label for="employe_id">Employe id</label>
                                     <select class="form-control" name="employe_id">
                                      <option value="">Select user</option>
                                      <?php foreach ($masters as $key => $row) {   ?>
                                      <option  value="<?php echo $row['id'];?>">
                                           <?php echo $row['name'];?>
                                      </option>  

                                      <?php } ?>      
                           </div>
                              </div>


                    </select>
                           </div>
                              </div>
                            <div class="row">
                              <div class="col-md-4">
                                  <div class="form-group name-error">
                                    <label for="Basic_Salary" class=" form-control-label">Basic Salary</label>
                                    <input type="text" name="Basic_Salary" id="Basic_Salary" placeholder="Basic_Salary" class="form-control">
                                   </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group father-error">
                                    <label for="DA" class=" form-control-label">Total_salary</label>
                                    <input type="text" name="total_salary" id="total_salary" placeholder="total_salary" class="form-control">
                                   </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group dob-error">
                                    <label for="month" class=" form-control-label">Total_Allowance</label>
                                    <input type="text" name="Total_Allowance" id="Total_Allowance" placeholder="Enter Total_Allowance" class="form-control">
                                   </div>
                              </div>
                             
                              <div class="col-md-4">
                                  <div class="form-group password-error">
                                    <label for="Toal_Deduction" class=" form-control-label">Total Deduction</label>
                                    <input type="Total_Deduction" name="Total_Deduction" id="Total_Deduction" placeholder="Enter Toal_Deduction" class="form-control">
                                   </div>
                              </div>
                               

                              <button type="submit" class="btn btn-primary">Submit</button>
                              
                            </div>
                      
                       </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
                  
         
      
     

