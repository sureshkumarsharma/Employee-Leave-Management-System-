<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Google_login extends CI_Controller {

	public function __construct(){
        
        parent::__construct();
        
        $this->load->model('google_login_model'););

	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function login(){
  		
  		include_once APPPATH . "libraries/vendor/autoload.php";

	  	$google_client = new Google_Client();

	  	$google_client->setClientId('540549180738-3qvrd6m6iv7kqb97ngil2h30o4bd420l.apps.googleusercontent.com');

	  	//Define your ClientID

	  	$google_client->setClientSecret('EiIPxkqzSX4GDcV-SGfBm9Kg'); //Define your Client Secret Key

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

	   		$login_button = '<a href="'.$google_client->createAuthUrl().'"><img src="'.base_url().'asset/sign-in-with-google.png" /></a>';
	   		
	   		$data['login_button'] = $login_button;
	   
	   		$this->load->view('google_login', $data);
	  
	  	}else{
	   	
	   		$this->load->view('google_login', $data);
	  	}

 	}

 	function logout(){

  		$this->session->unset_userdata('access_token');

  		$this->session->unset_userdata('user_data');

  		redirect('google_login/login');
 	}

	

}
