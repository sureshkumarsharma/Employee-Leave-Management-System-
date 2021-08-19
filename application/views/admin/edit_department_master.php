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
    <!-- /.content-header -->
    <?php #print_r($departments[0]['department']);exit(); ?>
   <form action="<?php echo base_url('admin/edit-department-master/'.$departments[0]['id']); ?>" method ="POST">
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Department</strong><small> Form</small></div>
                        <div class="card-body card-block">
                        <div class="form-group">
                        <label for="deprt" class=" form-control-label">Department Name</label>
                        <input type="text" name="department" value="<?php echo $departments[0]['department']; ?>" class="form-control" required>
                        <input type="hidden" name="id" value="<?php echo $departments[0]['id']; ?>">
                     </div>
                      
                        <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                        </button>
                       </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>