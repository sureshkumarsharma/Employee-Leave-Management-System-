<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
           <h4 class="box-title">Department Master </h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v2</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <form name="name" method="post" action="<?php echo base_url('admin/edit-leavetype-master/'.$leavetype[0]['id']); ?>">
<div>
</div>
            
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>leave_type</strong><small> Form</small></div>
                        <div class="card-body card-block">
    
                        <div class="form-group">
                           <input type="hidden" name="id" class="txtField" value="<?php echo $leavetype[0]['id']; ?>">
                        <label for="leave_type" class=" form-control-label">leave_type</label>
                        <input type="text" name="leave_type" value="<?php echo $leavetype[0]['leave_type']?>"placeholder="Enter your leave_type" class="form-control" required></div>
                        
                        <button  type="submit" class="btn btn-lg btn-info btn-block">
                        <span id="payment-button-amount">Submit</span>
                        </button>
                       </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>