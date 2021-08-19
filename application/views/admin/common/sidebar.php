<?php

$email = $this->session->userdata('username');

$this->db->select('*');    
$this->db->from('user');
$this->db->where('email_address', $email);
$query = $this->db->get();

$data = $query->row();

#print_r($data[0]);exit();


$modules= $this->User_mo->get_user_permission($data->id);

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?php echo base_url('assets/dist/img/Eight.jpeg'); ?>" alt="" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">EightTechProject's</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->

      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
         <img src="<?php echo base_url('assets/dist/img/avatar2.png'); ?>" class= "img-circle elevation-4">
         <!-- <img src="<?php //echo base_url(''); ?>" class="img-circle"> -->
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo ucwords( $data->name ); ?></a>
        </div>
      </div>

      <?php if($data->role_id==1){ ?>
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Department
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('admin/dashboard'); ?>" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Home</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/department-master'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Department Master</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/leave-type-master'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Leave Type Master</p>
                </a>
              </li>
            </ul>
          </li>
          
         
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Top Navigation</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Top Navigation + Sidebar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/boxed.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Boxed</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Sidebar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-topnav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Navbar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-footer.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Footer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/collapsed-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Collapsed Sidebar</p>
                </a>
              </li>
            </ul>
          </li>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/UI/general.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>General</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/icons.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Icons</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/buttons.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Buttons</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/sliders.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sliders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/modals.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Modals & Alerts</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/navbar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Navbar & Tabs</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/timeline.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Timeline</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/ribbons.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ribbons</p>
                </a>
              </li>
            </ul>
          </li>
         <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                User
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="<?php echo base_url('admin/alluser-master'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>list User</p>
                </a>
              </li>
              <li class="nav-item">
                 <a href="<?php echo base_url('admin/adduser-master'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add User</p>
                </a>
              </li>
              <li class="nav-item">
                 <a href="<?php echo base_url('admin/addusersalarydetails-master'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Add User Salary Details</p>
                </a>
              </li>
            </ul>
          </li>
    
         
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Employee corner
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
               <a href="<?php echo base_url('admin/userpayslip-master'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Payslip</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>
                LEAVE
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('admin/leave-details-master'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>leave</p>
                </a>
              </li>
      </nav>
      <!-- /.sidebar-menu -->

      <?php }else if($data->role_id==2){ ?>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          
            <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Employee corner
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('admin/userpayslip-master'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Payslip</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/profile-master'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>profile</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>
                LEAVE
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('admin/addleave-details-master'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>leave</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/leave-status-master'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>leave Status</p>
                </a>
              </li>

  
      <!-- /.sidebar-menu -->

    <?php } ?>
    </div>
    <!-- /.sidebar -->
  </aside>