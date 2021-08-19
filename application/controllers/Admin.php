<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

  public function __construct(){
        
        parent::__construct();
        $this->load->helper(array('url','path','form'));
        $this->load->library('form_validation');
        $this->load->model('Department_model');
         $this->load->model('Leavetype_model');
         $this->load->model('Add_user_model');
         $this->load->model('User_mo');
         $this->load->library('session');
         $this->load->library('form_validation');
         //$this->load->library('email');
        //$this->load->library('upload', $config);
          //$this->load->library('google');
          $this->load->model('google_login_model');

 
  }

  /**
   * Index Page for this controller.
   *
   * Maps to the following URL
   *    http://example.com/index.php/welcome
   *  - or -
   *    http://example.com/index.php/welcome/index
   *  - or -
   * Since this controller is set as the default controller in
   * config/routes.php, it's displayed at http://example.com/
   *
   * So any other public methods not prefixed with an underscore will
   * map to /index.php/welcome/<method_name>
   * @see https://codeigniter.com/user_guide/general/urls.html
   */
  public function login()
  {
    $this->load->view('login');
  }
    
   function index()
  {
    $this->load->helper(array('form', 'url'));

    $this->load->library('form_validation');
         $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|max_length[12]|is_unique[users.username]');
         $this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]');
         $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
         $this->form_validation->set_rules('email_address', 'Email', 'required|valid_email|is_unique[users.email]');

    if ($this->form_validation->run() == FALSE)
    {
      $this->load->view('adduser_master');
    }
    else
    {
      $this->load->view('alluser_master');
    }
  }

  public function dashboard()
  {

    $_data['title_for_layout']  = "Dashboard";

    //$data['cities']  = $this->db->get('employee_master');
    //$this->User_mo->get_available_city();
    
    $this->load->view('admin/common/header',$_data);
    $this->load->view('admin/common/sidebar');
    $this->load->view('admin/dashboard');
    $this->load->view('admin/common/footer');

  }

  public function leave_dashboard()
  {
    
    $this->load->view('admin/common/header');
    $this->load->view('admin/common/sidebar');
    $this->load->view('admin/leave_dashboard');
    $this->load->view('admin/common/footer');

  }

  public function check_mobile(){

    if (!empty($this->input->post('mobile_no'))) {

      //print_r($this->input->post());exit();
            
            $mobile_no = $this->User_mo->check_mobile_no($this->input->post('mobile_no'));
            
            if (count($mobile_no) > 0) {

        $message = "Mobile already exits !";
        $status = false;


      } else {

              $message = "mobile number available !";
        $status = true;
        
      }
             
             echo json_encode(array('status'=>$status,'message'=>$message));exit();
        }

  }

  public function add_department(){

    $_data['title_for_layout']  = "Add Department";

    if (!empty($this->input->post())) {

      //print_r($this->input->post());exit();
            
            $content = preg_replace("/&#?[a-z0-9]{2,8};/i","",$this->input->post('department'));

            $department = $this->User_mo->checkdepartment($this->input->post('department'));
            
            if (count($department) > 0) {

        $message = "Uername not available !";
        $status = false;
        $url = '';



            } else {

              $data['department'] = $this->input->post('department');

        if($this->User_mo->add_departments($data)){

          $message = "deparment added success.";
            $status = true;
            $url = base_url('admin/department-master');
        }
      }
             
             echo json_encode(array('status'=>$status,'message'=>$message,'url'=>$url));exit();
        }

    $this->load->view('admin/common/header',$_data);
    $this->load->view('admin/common/sidebar');
    $this->load->view('admin/add_department');
    $this->load->view('admin/common/footer');
  }
  

  public function add_leavetype(){

    $_data['title_for_layout']  = "Add Leavetype";

    if (!empty($this->input->post())) {

      $content = preg_replace("/&#?[a-z0-9]{2,8};/i","",$this->input->post('leave_type'));

      $username = $this->User_mo->checkusername($this->input->post('leave_type'));

      if (count($username) > 0) {

        $message = "Uername not available !";
        $status = false;
        $url = '';

        
      } else {
        
        if($this->User_mo->add_leave_type($this->input->post())){

          $message = "leave type added success.";
          $status = true;
          $url = base_url('admin/leave-type-master');

        }
      }


      //echo $response;exit();
      echo json_encode(array('status'=>$status,'message'=>$message,'url'=>$url));exit();
      

      
    }

    $this->load->view('admin/common/header',$_data);
    $this->load->view('admin/common/sidebar');
    $this->load->view('admin/add_leavetype');
    $this->load->view('admin/common/footer');
  }
    

  public function delete_department_master($id){

    //echo $id;exit();

    if($this->User_mo->row_delete($id)){

      redirect( base_url('admin/department-master') );
    }

  }
  public function delete_leavetype_master($id){

    //echo $id;exit();

    if($this->User_mo->row_deleteleave($id)){

      redirect( base_url('admin/leave-type-master') );
    }

  }

  public function department_master(){

    //echo "test";
    $_data['title_for_layout']  = "Dashboard";

    $data['departments']  = $this->Department_model->get_departments();


    //print_r($data['departments']);exit();

    $this->load->view('admin/common/header',$_data);
    $this->load->view('admin/common/sidebar');
    $this->load->view('admin/department_master',$data);
    $this->load->view('admin/common/footer');
  }

  public function leave_details_master(){

    //echo "test";
    $_data['title_for_layout']  = "Dashboard";

    $data['leave']  = $this->Department_model->get_leaves_details();


    #print_r($data['leave']);exit();

    $this->load->view('admin/common/header',$_data);
    $this->load->view('admin/common/sidebar');
    $this->load->view('admin/leave_details_master',$data);
    $this->load->view('admin/common/footer');
  }

      public function send_mail($email) {
    
        $this->load->library('email');
    
    $config = array();
    $config['protocol'] = 'smtp';
    $config['smtp_host'] = 'smtp.gmail.com';
    $config['smtp_user'] = 'sureshkumarsharma1990@gmail.com';
    $config['smtp_pass'] = 'divyasuresh';
    $config['smtp_port'] = 465;
    $config['smtp_crypto'] = 'ssl';
    $config['mailtype'] = 'text';
    $config['charset'] = 'iso-8859-1';
    $config['wordwrap'] = TRUE;
    
    $this->email->initialize($config);
    $this->email->set_newline("\r\n");


    $from_email = $email;
        $to_email = "sureshkumarsharma1990@gmail.com";
        $this->load->library('email');
        $this->email->from($from_email);
        $this->email->to($to_email);
        $this->email->subject('Send Email Codeigniter');
        $this->email->message('Your registration successfully.');
        
        $this->email->send();

        return true;
     
       }

     

     public function addleave_details_master(){

    	
    	$_data['title_for_layout']  = "Dashboard";

    	$data['leave']  = $this->Department_model->get_addleaves_details();
         
    	if(!empty($this->input->post())){ 
     		 


           	$email = $this->input->post('email');
              
            $uid = $this->User_mo->get_logged_user_info($email);
             
    	   	$insert['user_id'] = $uid;

          	$insert['leave_id'] = $this->input->post('leave_id');
          	$insert['leave_from'] = $this->input->post('leave_from');
          	$insert['leave_to'] = $this->input->post('leave_to');
          	$insert['leave_description'] = $this->input->post('leave_description');

          	$this->Department_model->addleave_details_master($insert);
        }
        

            
               

    //print_r($data['departments']);exit();

    $this->load->view('admin/common/header',$_data);
    $this->load->view('admin/common/sidebar');
    $this->load->view('admin/addleave_details_master',$data);
    $this->load->view('admin/common/footer');
  }

  public function edit_department_master($id){

    #echo $id;exit();

    $data['departments']  = $this->Department_model->get_edit_departments($id);

    #print_r($data['departments']);exit();
    if (!empty($this->input->post())) {
      #print_r($this->input->post());exit();

      $update['id'] = $this->input->post('id');
      $update['department'] = $this->input->post('department');

      if($this->Department_model->update_department($update)){
        redirect( base_url('admin/department-master'));
      }
    }

    $_data['title_for_layout']  = "Dashboard";

      $this->load->view('admin/common/header',$_data);
    $this->load->view('admin/common/sidebar');
    $this->load->view('admin/edit_department_master',$data);
    $this->load->view('admin/common/footer');
  }

  public function leavetype_master(){

    //echo "test";
    $_data['title_for_layout']  = "Dashboard";

    $data['leave_type']  = $this->Leavetype_model->get_leave_types();


    #print_r($data['leave_type']);exit();

    $this->load->view('admin/common/header',$_data);
    $this->load->view('admin/common/sidebar');
    $this->load->view('admin/leavetype_master',$data);
    $this->load->view('admin/common/footer');
  }

  public function edit_leavetype_master($id){

    #echo $id;exit();

    $data['leavetype']  = $this->Leavetype_model->get_leavetype($id);

    #print_r($data['departments']);exit();
    if (!empty($this->input->post())) {
      #print_r($this->input->post());exit();

      $update['id'] = $this->input->post('id');
      $update['leave_type'] = $this->input->post('leave_type');

      if($this->Leavetype_model->update_leavetype($update)){
        redirect( base_url('admin/leave-type-master'));
      }
    }
        
        $_data['title_for_layout']  = "Dashboard";

    
    $this->load->view('admin/common/header',$_data);
    $this->load->view('admin/common/sidebar');
    $this->load->view('admin/edit_leavetype_master',$data);
    $this->load->view('admin/common/footer');
  }
     
     public function adduser_master(){

    //echo "test";
    $_data['title_for_layout']  = "Dashboard";

    //$data['add_user']  = $this->Add_user_model->();

    if(!empty( $this->input->post() )){

      #print_r($this->input->post());exit();

    $config['upload_path']   = './assets/uploads/'; 
        $config['allowed_types'] = '*'; 
        $config['max_size']      = 100; 
        $config['max_width']     = 1024; 
        $config['max_height']    = 768;  
        $this->load->library('upload', $config);
      
        if ( ! $this->upload->do_upload('user_photo')) {
            
            $error = array('error' => $this->upload->display_errors()); 
            
            #print_r($error);exit(); 
        
        }else { 
            
            $data = array('upload_data' => $this->upload->data()); 
            #print_r($data['upload_data']['file_name']);exit();

            $insert['user_photo'] = $data['upload_data']['file_name'];

          

          $insert['name'] = $this->input->post('name');
          $insert['fathers_name'] = $this->input->post('fathers_name');
          $insert['date_of_birth'] = $this->input->post('date_of_birth');
          $insert['email_address'] = $this->input->post('email_address');
          $insert['password'] = $this->input->post('password');
          $insert['designation'] = $this->input->post('designation');
          $insert['total_salary'] = $this->input->post('total_salary');
          $insert['address'] = $this->input->post('address');
          $insert['moblie_no'] = $this->input->post('moblie_no');

          if($this->Add_user_model->add_user_master($insert)){

            $da = $this->send_mail($insert['email_address']); 


            redirect( base_url('admin/alluser-master') );
            }

            
        }       

      if( $this->upload->do_upload('user_photo') ){

        $data = $this->upload->data();
                // echo "pre";
        print_r($data);exit();

         
                 

        //  print_r($add_model);exit();

        
        
      
      }else{

        $error = array('error' => $this->upload->display_errors());
      }


    

      //$this->User_mo->add_user_master($this->input->post());
    }

    $this->load->view('admin/common/header',$_data);
    $this->load->view('admin/common/sidebar');
    $this->load->view('admin/adduser_master');
    $this->load->view('admin/common/footer');
  }

       
  public function alluser_master(){

    $_data['title_for_layout']  = "Dashboard";

    $data['masters'] = $this->Add_user_model->get_add_users();
    #print_r($data['masters']);exit();

    $this->load->view('admin/common/header',$_data);
    $this->load->view('admin/common/sidebar');
    $this->load->view('admin/alluser_master',$data);
    $this->load->view('admin/common/footer');
  }

    public function addusersalarydetails_master(){

    //echo "test";
    $_data['title_for_layout']  = "Dashboard";

    $data['masters'] = $this->Add_user_model->get_add_use();

    if(!empty( $this->input->post() )){

    #print_r($this->input->post());exit();
       
            //print_r($error);exit(); 

          $insert['employe_id'] = $this->input->post('employe_id');
          $insert['Basic_Salary'] = $this->input->post('Basic_Salary');
          $insert['Total_Deduction'] = $this->input->post('Total_Deduction');
          $insert['Total_Allowance'] = $this->input->post('Total_Allowance');
          $insert['total_salary'] = $this->input->post('total_salary');
          if($this->Add_user_model->addusersalarydetails_master($insert)){

            }

            
        }       

    $this->load->view('admin/common/header',$_data);
    $this->load->view('admin/common/sidebar');
    $this->load->view('admin/addusersalarydetails_master',$data);
    $this->load->view('admin/common/footer');
  }


  public function userpayslip_master(){

    $_data['title_for_layout']  = "Dashboard";

    $data['masters'] = $this->Add_user_model->get_add_userss();
    //print_r($data['masters']);exit();

    $this->load->view('admin/common/header',$_data);
    $this->load->view('admin/common/sidebar');
    $this->load->view('admin/userpayslip_master',$data);
    $this->load->view('admin/common/footer');
  }

       public function view_master_profile($id){

    $_data['title_for_layout']  = "Dashboard";

    $data['masters'] = $this->Add_user_model->get_profile_user($id);
    
    //print_r($data['masters']);exit();

    $this->load->view('admin/common/header',$_data);
    $this->load->view('admin/common/sidebar');
    $this->load->view('admin/view_master_profile',$data);
    $this->load->view('admin/common/footer');
  }

  public function delete_user_master($id){

    //echo $id;exit();

    if($this->User_mo->row_userlistdelete($id)){

      redirect( base_url('admin/alluser-master') );
    }

  }
   public function delete_leave_status_master($id){

    //echo $id;exit();

    if($this->User_mo->row_leavelistdelete($id)){

      redirect( base_url('admin/leave-details-master') );
    }

  }
  public function edit_user_master($id){

    #echo $id;exit();

    $data['user']  = $this->Add_user_model->get_edit_users($id);

    #print_r($data['departments']);exit();
    if (!empty($this->input->post())) {
      #print_r($this->input->post());exit();

      $update['id'] = $this->input->post('id');
      $update['name'] = $this->input->post('name');
      $update['fathers_name'] = $this->input->post('fathers_name');
      $update['date_of_birth'] = $this->input->post('date_of_birth');
      $update['email_address'] = $this->input->post('email_address');
      $update['password'] = $this->input->post('password');
      $update['designation'] = $this->input->post('designation');
      $update['total_salary'] = $this->input->post('total_salary');
      $update['address'] = $this->input->post('address');
      $update['moblie_no'] = $this->input->post('moblie_no');

      #print_r($update);exit();

      if($this->User_mo->update_user_details($update)){
        
        
        redirect( base_url('admin/alluser-master'));
      }
    }

    $_data['title_for_layout']  = "Dashboard";

      $this->load->view('admin/common/header',$_data);
    $this->load->view('admin/common/sidebar');
    $this->load->view('admin/edit_user_master',$data);
    $this->load->view('admin/common/footer');
  
  
  }

  public function login_master(){

    $_data['title_for_layout']  = "Dashboard";


    if (!empty($this->input->post())) {
      
      #print_r($this->input->post());exit();

      $data['email'] = $this->input->post('email_address');
      $data['password'] = $this->input->post('password');

      $que=$this->db->query("select * from user where email_address='".$data['email']."' and password='".$data['password']."'");
      $row = $que->num_rows();

      //print_r($que);exit();
      
      if(count($row) > 0){

        $session_data = array(  
                          'username'  =>$data['email']  
                     );  
                
                $this->session->set_userdata($session_data);

        redirect( base_url('admin/dashboard') );

      }else{
        
        $data['error']="<h3 style='color:red'>Invalid login details</h3>";
      } 

    }

     if($this->session->userdata('loggedIn') == true){ 
        redirect( base_url('admin/dashboard') );  
           
        }

        include_once APPPATH . "libraries/vendor/autoload.php";

      $google_client = new Google_Client();

      $google_client->setClientId('540549180738-i7omg77bpvmkkqm1cn099u1ku4iak1li.apps.googleusercontent.com');

      //Define your ClientID

      $google_client->setClientSecret('F4TsDTpWpg2y0xTEHJfpxZYq'); //Define your Client Secret Key

      $google_client->setRedirectUri( base_url('admin/dashboard') ); //Define your Redirect Uri

      $google_client->addScope('email');

      $google_client->addScope('profile');

      if(isset($_GET["code"])){
   
        $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

        if(!isset($token["error"])){

          $google_client->setAccessToken($token['access_token']);

          $this->session->set_userdata('access_token', $token['access_token']);

          $google_service = new Google_Service_Oauth2($google_client);

          $data = $google_service->userinfo->get();

          $current_datetime = date('Y-m-d H:i:s');

          if($this->google_login_model->Is_already_register($data['id'])){

           //update data
           $user_data = array(
            'first_name' => $data['given_name'],
            'last_name'  => $data['family_name'],
            'email_address' => $data['email'],
            'profile_picture'=> $data['picture'],
            'updated_at' => $current_datetime
           );

           $this->google_login_model->Update_user_data($user_data, $data['id']);
          
          }else{

             //insert data
            $user_data = array(
              'login_oauth_uid' => $data['id'],
              'first_name'  => $data['given_name'],
              'last_name'   => $data['family_name'],
              'email_address'  => $data['email'],
              'profile_picture' => $data['picture'],
              'created_at'  => $current_datetime
            );

            $this->google_login_model->Insert_user_data($user_data);
          }

          $this->session->set_userdata('user_data', $user_data);
        }
      }
  
      $login_button = '';
    
      if(!$this->session->userdata('access_token')){

        $login_button = $google_client->createAuthUrl();
        
        $data['login_button'] = $login_button;
     
        //$this->load->view('Admin/login_master', $data);
    
      }else{
      
        //$this->load->view('Admin/login_master', $data);
      } 


        $this->load->view('admin/login_master',$data);
         
      
    }
    function logout(){

      $this->session->unset_userdata('access_token');

      $this->session->unset_userdata('user_data');

      redirect('Admin/login_master');
  }

     function google_login(){
      
      include_once APPPATH . "libraries/vendor/autoload.php";

      $google_client = new Google_Client();

      $google_client->setClientId('540549180738-i7omg77bpvmkkqm1cn099u1ku4iak1li.apps.googleusercontent.com');

      //Define your ClientID

      $google_client->setClientSecret('F4TsDTpWpg2y0xTEHJfpxZYq'); //Define your Client Secret Key

      $google_client->setRedirectUri( base_url('admin/dashboard') ); //Define your Redirect Uri

      $google_client->addScope('email');

      $google_client->addScope('profile');

      if(isset($_GET["code"])){
   
        $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

        if(!isset($token["error"])){

          $google_client->setAccessToken($token['access_token']);

          $this->session->set_userdata('access_token', $token['access_token']);

          $google_service = new Google_Service_Oauth2($google_client);

          $data = $google_service->userinfo->get();

          $current_datetime = date('Y-m-d H:i:s');

          if($this->google_login_model->Is_already_register($data['id'])){

           //update data
           $user_data = array(
            'first_name' => $data['given_name'],
            'last_name'  => $data['family_name'],
            'email_address' => $data['email'],
            'profile_picture'=> $data['picture'],
            'updated_at' => $current_datetime
           );

           $this->google_login_model->Update_user_data($user_data, $data['id']);
          
          }else{

             //insert data
            $user_data = array(
              'login_oauth_uid' => $data['id'],
              'first_name'  => $data['given_name'],
              'last_name'   => $data['family_name'],
              'email_address'  => $data['email'],
              'profile_picture' => $data['picture'],
              'created_at'  => $current_datetime
            );

            $this->google_login_model->Insert_user_data($user_data);
          }

          $this->session->set_userdata('user_data', $user_data);
        }
      }
  
      $login_button = '';
    
      if(!$this->session->userdata('access_token')){

        $login_button = $google_client->createAuthUrl();
        
        $data['login_button'] = $login_button;
     
        $this->load->view('Admin/login_master', $data);
    
      }else{
      
        $this->load->view('Admin/login_master', $data);
      }

  }

  function google_logout(){

      $this->session->unset_userdata('access_token');

      $this->session->unset_userdata('user_data');

      redirect('Admin/google_login');
  }
  

  public function invoice_print_master($id)  
    {  

         $this->load->library('pdf');
        $html = $this->load->view('admin/invoice_print_master', [], true);
        $this->pdf->createPDF($html, 'mypdf', false); 
    }

    public function leave_request_action(){

    	if(!empty($this->input->post('id'))){



    		$data['action_id'] = $this->input->post('action');
    		$data['leave_id'] = $this->input->post('id');

			$this->User_mo->update_leave( $data );

    		echo json_encode(array("status"=>"success","message"=>"request updated successfully."));exit();
    	}
    }

    public function leave_status_master(){

    	$email = $this->session->userdata('username');
        

    	$uid = $this->User_mo->get_logged_user_info($email);

    	$data['leave']=$this->User_mo->get_leave_requests($uid);

        $this->load->view('admin/common/header');
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/leave_status_master',$data);
        $this->load->view('admin/common/footer');
  
  
  }

    function update_bonus(){
         $id=$this->input->post('id');
         $total_salary=$this->input->post('total_salary');
         $bonus=$this->input->post('Basic_Salary');
         $update=$total_salary+$Basic_Salary;
         $data['Basic_Salary']=$this->input->post('update');

         if ($this->pay->update_overtime($id,$data)==TRUE){
         $this->load->view('admin/invoice_print_master');


         }
         else
                {
                $this->load->view('unsuccess');

                }
         }

  public function upload_file(){

    $this->load->library('upload', $config);

      if( $this->upload->do_upload('user_photo') ){

        //$_data = array('upload_data' => $this->upload->data());

        //unlink( $config['upload_path'].$del_logo );

        $_data['logo'] = $this->upload->data();
        $update['user_photo'] = $_data['logo']['file_name'];
        
        $this->User_mo->update_whyus( $update );
        redirect( base_url('console/why-us') );
      
      }else{

        $error = array('error' => $this->upload->display_errors());
      }
  }
}
