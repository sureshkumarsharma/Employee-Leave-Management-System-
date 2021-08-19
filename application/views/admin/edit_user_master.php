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
                          <form  action="<?php echo base_url('admin/edit-user-master/'.$user[0]['id']); ?>" method ="POST">
                            <div class="row">
                              <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="name" class=" form-control-label">Name</label>
                                    <input type="text" name="name" id="name" value="<?php echo $user[0]['name']; ?>" placeholder="Enter your Name" class="form-control">
                                   </div>
                                   <input type="hidden" name="id" value="<?php echo $user[0]['id']; ?>">
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="fathers name" class=" form-control-label">Father's Name</label>
                                    <input type="text" name="fathers_name" id="" value="<?php echo $user[0]['fathers_name']; ?>" placeholder="Father's Name" class="form-control">
                                   </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="DOB" class=" form-control-label">Date of Birth</label>
                                    <input type="date" name="date_of_birth" id="" value="<?php echo $user[0]['date_of_birth']; ?>" placeholder="Enter your Date_of_Birth" class="form-control">
                                   </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="Email Address" class=" form-control-label">Email_Address</label>
                                    <input type="text" name="email_address" id="" value="<?php echo $user[0]['email_address']; ?>" placeholder="Enter your Email_Addreess" class="form-control">
                                   </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="Password" class=" form-control-label">Password</label>
                                    <input type="password" name="password" id="" value="<?php echo $user[0]['password']; ?>" placeholder="Enter your password" class="form-control">
                                   </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                     <label for="Designaction">Designaction</label>
                                     <select class="form-control" name="designation" value="<?php echo $user[0]['designation']; ?>" required placeholder="Designation">
                                      <option value="hr">maneger</option>
                                       <option value="merketing">developer</option>
                                       <option value="sales">sales</option>
                                        </select>
                                   </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="Total salary" class=" form-control-label">Total salary</label>
                                    <input type="text" name="total_salary" value="<?php echo $user[0]['total_salary']; ?>" placeholder="Enter your Total salary" class="form-control">
                                   </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="Address" class=" form-control-label">Address</label>
                                    <input type="text" name="address" value="<?php echo $user[0]['address']; ?>" placeholder="Enter Your Home address" class="form-control">
                                   </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="moblie no" class=" form-control-label">Moblie No</label>
                                    <input type="text" name="moblie_no" value="<?php echo $user[0]['moblie_no']; ?>" placeholder="Enter your Moblie_No" class="form-control">
                                   </div>
                              </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                       </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>