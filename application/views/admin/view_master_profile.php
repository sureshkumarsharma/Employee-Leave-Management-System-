<?php #print_r($masters);exit(); ?>
<div class="content-wrapper">
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <?php foreach ($masters as $key => $detail) { ?>
          <div class="col-md-8">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  
                       <img src="<?php echo base_url('assets/uploads/'.$detail['user_photo']); ?>" class="profile-user-img img-fluid img-circle">
                </div>
                 <tr>
                <h3 class="profile-username text-center"><?php echo $detail['name'];?></h3></tr>

                <p class="text-muted text-center"><?php echo $detail['designation'];?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Employee ID</b> <a class="float-right"><?php echo $detail['id'];?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Email.address</b> <a class="float-right"><?php echo $detail['email_address'];?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Address</b> <a class="float-right"><?php echo $detail['address'];?></a>
                  </li>
                </ul>
                <li class="list-group-item">
                    <b></b>Mobile NO<a class="float-right"><?php echo $detail['moblie_no'];?></a>
                  </li>
                </ul>
                <li class="list-group-item">
                    <b></b>Basic Salary<a class="float-right"><?php echo $detail['Basic_Salary'];?></a>
                  </li>
                </ul>
                 <li class="list-group-item">
                    <b></b>Total Salary<a class="float-right"><?php echo $detail['total_salary'];?></a>
                  </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>More Details </b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

      
            <!-- /.card -->
          </div>
        </div>
      </div>
        <?php } ?>
    </section>
  </div>