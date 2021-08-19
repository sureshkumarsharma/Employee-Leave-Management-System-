 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
           <h4 class="box-title">Add Leave </h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <a href="<?php echo base_url('admin/logout'); ?>" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-log-out"></span><i class="fas fa-sign-out-alt"></i></a>
            </ol>
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
                        <div class="card-header"><strong>Leave Type</strong><small> Form</small></div>
                        <div class="card-body card-block">
                           <form method="post">
               
                <div class="form-group">
                  <label class=" form-control-label">Leave Type</label>
                  <select name="leave_id" required class="form-control">
                    <option value="">Casual Leave (CL)</option>
                    <option value="">Sick Leave (SL)</option>
                    <option value="">Privilege Leave</option>
                   
                  </select>
                  <input type="hidden" name="email" value="<?php echo $this->session->userdata('username'); ?>">
                </div>
                 <div class="form-group">
                  <label class=" form-control-label">From Date</label>
                  <input type="date" name="leave_from"  class="form-control" required>
                </div>
                <div class="form-group">
                  <label class=" form-control-label">To Date</label>
                  <input type="date" name="leave_to" class="form-control" required>
                </div>
                <div class="form-group">
                  <label class=" form-control-label">Leave Description</label>
                  <input type="text" name="leave_description" class="form-control" >
                </div>
                
                 <button  type="submit" name="submit" class="btn btn-lg btn-info btn-block">
                 <span id="payment-button-amount">Submit</span>
                 </button>
                </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      