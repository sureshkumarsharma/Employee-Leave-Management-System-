
  <!-- Content Wrapper. Contains page content -->
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
                <?php if($_SESSION['ROLE']==2){ ?>
               <h4 class="box_title_link"><a href="add_leave.php">Add Leave</a> </h4>
               <?php } ?>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th width="5%">S.No</th>
                                       <th width="5%">ID</th>
                     <th width="15%">Employee Name</th>
                                       <th width="14%">From</th>
                     <th width="14%">To</th>
                     <th width="15%">Description</th>
                     <th width="18%">Leave Status</th>
                     <th width="10%"></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
              
                  while($row=mysqli_fetch_assoc($res)){?>
                  <tr>
                                       <td><?php echo $i?></td>
                     <td><?php echo $row['id']?></td>
                     <td><?php echo $row['name'].' ('.$row['eid'].')'?></td>
                                       <td><?php echo $row['leave_from']?></td>
                     <td><?php echo $row['leave_to']?></td>
                     <td><?php echo $row['leave_description']?></td>
                     <td>
                       <?php
                      if($row['leave_status']==1){
                        echo "Applied";
                      }if($row['leave_status']==2){
                        echo "Approved";
                      }if($row['leave_status']==3){
                        echo "Rejected";
                      }
                       ?>
                       <?php if($_SESSION['ROLE']==1){ ?>
                       <select class="form-control" onchange="update_leave_status('<?php echo $row['id']?>',this.options[this.selectedIndex].value)">
                      <option value="">Update Status</option>
                      <option value="2">Approved</option>
                      <option value="3">Rejected</option>
                       </select>
                       <?php } ?>
                     </td>
                     <td>
                     <?php
                     if($row['leave_status']==1){ ?>
                     <a href="leave.php?id=<?php echo $row['id']?>&type=delete">Delete</a>
                     <?php } ?>
                     
                     
                     </td>
                     
                                    </tr>
                  <?php 
                  $i++;
                  } ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
      </div>
         <script>
     function update_leave_status(id,select_value){
      window.location.href='leave.php?id='+id+'&type=update&status='+select_value;
     }
     </script>
    </section>
    <!-- /.content -->
  </div>


<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

</body>
</html>
