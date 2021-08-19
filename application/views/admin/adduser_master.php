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
           <h4 class="box-title">User Ragistration Form </h4>
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
                          <form action="<?php echo base_url('admin/adduser_master'); ?>" method="post" enctype="multipart/form-data" id="addusermaster">
                            
                            <div class="row">
                              <div class="col-md-4">
                                  <div class="form-group name-error">
                                    <label for="name" class=" form-control-label">Name</label>
                                    <input type="text" name="name" id="name" placeholder="Enter your Name" class="form-control">
                                   </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group father-error">
                                    <label for="fathers name" class=" form-control-label">Father's Name</label>
                                    <input type="text" name="fathers_name" id="fathers_name" placeholder="Father's Name" class="form-control">
                                   </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group dob-error">
                                    <label for="DOB" class=" form-control-label">Date of Birth</label>
                                    <input type="date" name="date_of_birth" id="date_of_birth" placeholder="Enter your Date_of_Birth" class="form-control">
                                   </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group email-error">
                                    <label for="Email Address" class=" form-control-label">Email_Address</label>
                                    <input type="text" name="email_address" id="email_address" placeholder="Enter your Email_Addreess" class="form-control">
                                   </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group password-error">
                                    <label for="Password" class=" form-control-label">Password</label>
                                    <input type="password" name="password" id="password" placeholder="Enter your password" class="form-control">
                                   </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group designaction-error">
                                     <label for="Designaction">Designaction</label>
                                     <select class="form-control" name="designation" required placeholder="Designation">
                                      <option value="hr">maneger</option>
                                       <option value="merketing">developer</option>
                                       <option value="sales">sales</option>
                                        </select>
                                   </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group total-salary-error">
                                    <label for="Total salary" class=" form-control-label">Total salary</label>
                                    <input type="text" name="total_salary" id="total_salary" placeholder="Enter your Total salary" class="form-control">
                                   </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group address-error">
                                    <label for="Address" class=" form-control-label">Address</label>
                                    <input type="text" name="address" id="address" placeholder="Enter Your Home address" class="form-control">
                                   </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group mobile-error">
                                    <label for="moblie no" class=" form-control-label">Moblie No</label>
                                    <input type="text" name="moblie_no" id="moblie_no" placeholder="Enter your Moblie_No" class="form-control">
                                   </div>
                              </div>
                               <div class="col-md-4">
                                  <div class="form-group mobile-error">
                                    <label for="user_photo" class="form-control-label">upload photo</label>
                                    <input type="file" name="user_photo" placeholder="Enter your photo" class="form-control">
                                   </div>
                                   <br>
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
                  
         
      
     

