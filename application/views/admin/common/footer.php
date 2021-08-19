<!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2018-2019 <a href="https://EightTech">EightTechProject's</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b>New
    </div>
  </footer>
  <!-- jQuery -->
<script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js');?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('assets/plugins/jquery-ui/jquery-ui.min.js');?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<!-- ChartJS -->
<script src="<?php echo base_url('assets/plugins/chart.js/Chart.min.js');?>"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('assets/plugins/sparklines/sparkline.js');?>"></script>
<!-- JQVMap -->
<script src="<?php echo base_url('assets/plugins/jqvmap/jquery.vmap.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/jqvmap/maps/jquery.vmap.usa.js');?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url('assets/plugins/jquery-knob/jquery.knob.min.js');?>"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url('assets/plugins/moment/moment.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/daterangepicker/daterangepicker.js');?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js');?>"></script>
<!-- Summernote -->
<script src="<?php echo base_url('assets/plugins/summernote/summernote-bs4.min.js');?>"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js');?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/dist/js/adminlte.js');?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/dist/js/demo.js');?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url('assets/dist/js/pages/dashboard.js');?>"></script>

<script src="<?php echo site_url() ?>public/assets/js/jquery-1.11.1.min.js"></script>
<script type='text/javascript' src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script type="text/javascript">
    
    $( "#add-department" ).validate( {
				rules: {
					department: "required",
				},
				messages: {
					department: "Please Enter Department Name ",
				},
				success: function ( form ) {
					// Add the span element, if doesn't exists, and apply the icon classes to it.
					form.submit();
				}
			} );

    $("#department").on("blur", function() {
	    if ( $(this).val().match('^[a-zA-Z]{3,16}$') ) {
	        //alert( "Valid name" );
	    } else {
	        alert("That's not a name");
          return false;
	    }
	  });
</script>
<script type="text/javascript">
$(document).ready(function () {
  $("#addLeaveTypeForm").submit(function (event) {

    event.preventDefault();

    $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/add-leavetype'); ?>",
            data: $("#addLeaveTypeForm").serialize(),
            success: function(response){
              //if request if made successfully then the response represent the data
              var obj = JSON.parse(response);
              console.log(obj);
              //$(response).insertAfter('input[name="leave_type"]');
              //$("#username-response").html('');
              $("#username-response").html(obj.message);
              $( "#result" ).empty().append( obj.message );

              if(obj.status==true){

              	window.location.href = obj.url;
              	              }
               }
    });

    
  });
});
</script>
<script type="text/javascript">
  
     
      $(document).ready(function () {
         
          $("#addDepartmentForm").submit(function (e) {

            e.preventDefault();
       
            
            $.ajax({
                    type: "POST",
                    url: "<?php base_url('admin/add-department'); ?>",
                    data: $("#addDepartmentForm").serialize(),
                    success: function(resultData){

                      var obj = JSON.parse(resultData);
                        
                        //console.log(obj);
                        if(obj.status==true){

                          window.location.href = obj.url;

                        }

                    }
       
            });
       
         
          });
       
      });
   

</script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script> -->
<script type='text/javascript' src='<?php echo site_url() ?>public/assets/js/jquery.validate.min.js'></script>
<script type="text/javascript">
    /**
     * Basic jQuery Validation Form Demo Code
     * Copyright Sam Deering 2012
     * Licence: http://www.jquery4u.com/license/
     */
    (function($, W, D)
    {
        var JQUERY4U = {};

        JQUERY4U.UTIL =
                {
                    setupFormValidation: function()
                    {
                        //form validation rules
                        $("#addusermaster").validate({
                            rules: {
                                name: "required",
                                fathers_name: "required",
      total_salary: "required",
      address: "required",
      user_photo: "required",
      date_of_birth: "required",
      email_address: {
        required: true,
        // Specify that email should be validated
        // by the built-in "email" rule
        email_address: true
      },
      name: {
            required: true,
            minlength: 2,
            maxlength:15
      },
      fathers_name: {
            required: true,
            minlength: 2,
            maxlength:15
      },
      moblie_no: {
            required:true,
             number:true,
            minlength:10,
            maxlength:10
      }, 
    password: {
        required: true,
        minlength: 5
      }
    },
    // Specify validation error messages
    messages: {
      name: "Please enter your Name",
      fathers_name: "Please enter your Fathers Name",
      total_salary: "Please enter your Total Salary",
      address: "Please enter your Address",
      user_photo: "Please select your photo",
      date_of_birth: "Please select your Date of Birth",
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      email_address: "Please enter a valid email address"
    },
   
                            submitHandler: function(form) {
                                form.submit();
                            }
                        });
                    }
                }

        //when the dom has loaded setup form validation rules
        $(D).ready(function($) {
            JQUERY4U.UTIL.setupFormValidation();
        });

    })(jQuery, window, document);
</script>
