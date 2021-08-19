<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

	public function __construct(){
        
        parent::__construct();
        $this->load->helper(array('url','path','form'));
        $this->load->library('form_validation');
        $this->load->model('Brand');
        $this->load->model('Category');
        $this->load->model('User_mo');
        //$this->load->model('Works');
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

	public function is_user_logged(){

    	if ( !$this->session->has_userdata('email') ) {
    		
    		$this->session->set_flashdata('message', '<div class="alert alert-danger">You are not authorized to access that location.</div>');
    		redirect( base_url('console/login') );
    	}
    }

	public function dashboard(){

		$this->is_user_logged();

		$data['title_for_layout'] = "Dashboard";

		$data['categorylists'] = $this->Category->getCategoryList();

		$data['brands'] = $this->Brand->getTotalBrands();

		$data['total_order'] = $this->User_mo->get_total_order();

		$data['total_pending_order'] = $this->User_mo->get_total_pending_order();

		$data['total_complete_order'] = $this->User_mo->get_total_complete_order();

		$data['total_variants_order'] = $this->User_mo->get_total_variants_order();

		$this->load->view('console/common/header',$data);
		$this->load->view('console/dashboard',$data);
		$this->load->view('console/common/footer');
	}

	public function user_detail( $user_id ){

		$data['user_details'] = $this->User_mo->get_user_details($user_id);

		$data['order_details'] = $this->User_mo->get_user_orders($user_id);

		$this->load->view('console/user_detail',$data);
	}

	public function time_manger(){

		$this->is_user_logged();

		$data['title_for_layout'] = "Selling Device | Time Manger";

		if (!empty($this->input->post('action')=="AddTimeslot")) {
			
			$_data['time_slot'] = $this->input->post('time_slot');

			if ($this->db->insert('pickup_times',$_data)) {
				
				redirect( base_url('console/time-manger') );
			}
		}

		$data['times'] = $this->User_mo->get_time_slots();

		$this->load->view('console/common/header',$data);
		$this->load->view('console/time_manger',$data);
		$this->load->view('console/common/footer');
	}

	public function loginShow(){

		$data['title_for_layout'] = "Selling Device | Console Login";

		if (!empty( $this->input->post('email') ) && !empty( $this->input->post('password') ) ) {
			
			$_data['email'] = $this->input->post('email');  
	        $_data['password'] = $this->input->post('password');

	        if( $this->User_mo->admin_login( $_data['email'], $_data['password'] ) == true ){  
	            
	            $info = $this->User_mo->get_user_info( $_data['email'] );

	            $session_data = array( 'role'=>$info[0]['role'],'email' => $_data['email'] );

	            $this->session->set_userdata($session_data);  
	            redirect( base_url('console/dashboard') );  
	            
	        }else{  
	             
	            $this->session->set_flashdata('message', '<div class="alert alert-danger">Invalid Username and Password !</div>');  
	            redirect( base_url('console/login') );  
	        }
		}

		$this->load->view('console/common/login_header',$data);
		$this->load->view('console/loginShow');
	}

	public function change_password(){

		$this->is_user_logged();

		$data['title_for_layout'] = "Update Password";

		if (!empty($this->input->post('email') && !empty('password') )){
			
			$data['email'] = $this->input->post('email');
			$data['password'] = $this->input->post('password');
			if( $this->User_mo->update_password( $data ) ){
				
				$this->session->set_flashdata('message', '<div class="alert alert-success">Password Update Successfully.</div>');

				redirect( base_url('console/change-password') );
			}
		}

		$this->load->view('console/common/header',$data);
		$this->load->view('console/change_password');
		$this->load->view('console/common/footer');
	}

	public function whyus(){

		$this->is_user_logged();

		$data['title_for_layout'] = "Update Whyus";

		if (!empty( $this->input->post('action')=="addNewWhyus" )) {

			$update['id'] = $this->input->post('id');
			$update['title'] = $this->input->post('title');
			$update['description'] = $this->input->post('description');

			$config = array(
							'upload_path' => "assets/images/",
							'allowed_types' => "gif|jpg|png|jpeg|pdf",
							'overwrite' => TRUE
						);

			$this->load->library('upload', $config);
			if( $this->upload->do_upload('icon') ){

				//$_data = array('upload_data' => $this->upload->data());

				$_data['logo'] = $this->upload->data();
				$update['icon'] = $_data['logo']['file_name'];

				$this->User_mo->update_why_us( $addBrand );
				redirect( 'console/why-us' );
			
			}else{

				$error = array('error' => $this->upload->display_errors());
			}
		
		}else if (!empty( $this->input->post('action')=="editWhyus" )) {

			#print_r( $this->input->post() );exit();

			$update['id'] = $this->input->post('id');
			$update['title'] = $this->input->post('title');
			$update['description'] = $this->input->post('description');

			$config = array(
							'upload_path' => "assets/images/",
							'allowed_types' => "gif|jpg|png|jpeg|pdf",
							'overwrite' => TRUE
						);

			$del_logo = $this->User_mo->get_whyus_icon( $update['id'] );

			$this->load->library('upload', $config);

			if( $this->upload->do_upload('icon') ){

				//$_data = array('upload_data' => $this->upload->data());

				unlink( $config['upload_path'].$del_logo );

				$_data['logo'] = $this->upload->data();
				$update['icon'] = $_data['logo']['file_name'];
				
				$this->User_mo->update_whyus( $update );
				redirect( base_url('console/why-us') );
			
			}else{

				$error = array('error' => $this->upload->display_errors());
			}

		}

		$data['whyus'] = $this->User_mo->GetWhyus();

		$this->load->view('console/common/header',$data);
		$this->load->view('console/whyus',$data);
		$this->load->view('console/common/footer');
	}

	public function edit_whyus( $edit_id ){

		$this->is_user_logged();

		$data['title_for_layout'] = "Edit Whyus";

		$data['edit_whyus'] = $this->User_mo->get_Why_us( $edit_id );

		$this->load->view('console/common/header',$data);
		$this->load->view('console/edit_whyus',$data);
		$this->load->view('console/common/footer');
	}

	public function roles(){

		$this->is_user_logged();

		$data['title_for_layout'] = "Selling Device | Manage Roles";

		$data['roles'] = $this->User_mo->get_user_list(); 


		$this->load->view('console/common/header',$data);
		$this->load->view('console/roles',$data);
		$this->load->view('console/common/footer');
	}

	public function edit_role( $user_id ){

		$this->is_user_logged();

		$data['title_for_layout'] = "Selling Device | Edit Roles";

		$data['roles'] = $this->User_mo->get_admin_user_details( $user_id );

		$this->load->view('console/common/header',$data);
		$this->load->view('console/edit_role',$data);
		$this->load->view('console/common/footer');
	}

	public function manage_permissions(){

		$this->is_user_logged();

		$data['title_for_layout'] = "Selling Device | Manage Permissions";

		//$data['roles'] = $this->User_mo->get_admin_user_details( $user_id );

		$this->load->view('console/common/header',$data);
		$this->load->view('console/manage_permissions',$data);
		$this->load->view('console/common/footer');
	}

	public function users(){

		$this->is_user_logged();

		$data['title_for_layout'] = "Users";

		$data['users'] = $this->User_mo->get_user_list();


		$this->load->view('console/common/header',$data);
		$this->load->view('console/users',$data);
		$this->load->view('console/common/footer');
	}

	public function customers(){

		$this->is_user_logged();

		$data['title_for_layout'] = "Customers";

		$data['customers'] = $this->User_mo->get_customers();


		$this->load->view('console/common/header',$data);
		$this->load->view('console/customers',$data);
		$this->load->view('console/common/footer');
	}

	public function deleteCustomer(){

		$cid = $this->uri->segment(3);

		if ($this->User_mo->delete_customers($cid)) {
			
			redirect( base_url('console/customers') );
		}
		

		redirect( base_url('console/customers') );
	}

	public function edit_user( $edit_id ){

		$this->is_user_logged();

		$data['users'] = $this->User_mo->edit_user( $edit_id );


		$this->load->view('console/common/header',$data);
		$this->load->view('console/edit_user',$data);
		$this->load->view('console/common/footer');
	}

	public function userManager(){

		if (!empty( $this->input->post('action') == "addNewUser" )) {

			$data['username'] = $this->input->post('username');
			$data['email'] = $this->input->post('email');
			$data['password'] = md5( $this->input->post('password') );
			$data['role'] = $this->input->post('role');
			
			if ( !empty( $data['email'] ) ) {

				$status = $this->User_mo->username_exists( $this->input->post('email') );

				if (!empty( $status )) {
					
					$response = json_encode( array('status'=>'warning','message'=>'user already exits !') );

				}else{

					if ( $this->User_mo->add_user( $data ) ) {
						
						$response = json_encode( array('status'=>'success','message'=>'user added success') );
					}
				}

			}

			echo $response;
		
		}else if (!empty( $this->input->post('action') == "deleteUser" )) {

			$data['del_id'] = $this->input->post('del_id');
			$this->User_mo->delete_user( $data['del_id'] );
		
		}else if (!empty( $this->input->post('action') == "updateUser" )) {

			$data['id'] = $this->input->post('edit_id');
			$data['username'] = $this->input->post('username');
			$data['email'] = $this->input->post('email');
			$data['role'] = $this->input->post('role');
			$data['status'] = $this->input->post('status');
			if($this->User_mo->update_user( $data )){

				redirect( base_url('console/users') );
			}
		}

		exit();
	}

	public function sliders(){

		$this->is_user_logged();

		$data['title_for_layout'] = "Sliders";

		$data['sliders'] = $this->User_mo->get_sliders();

		if (!empty( $this->input->post('action') == "addNewSlider" )) {
			
			$config = array(
							'upload_path' => "assets/sliders/",
							'allowed_types' => "gif|jpg|png|jpeg",
							'overwrite' => TRUE
						);

			$this->load->library('upload', $config);
			
			if( $this->upload->do_upload('image') ){

				//$_data = array('upload_data' => $this->upload->data());

				$_data['logo'] = $this->upload->data();
				$add_slider['image'] = $_data['logo']['file_name'];

				if( $this->db->insert('sliders',$add_slider) ){

					redirect( 'console/sliders' );
				}
			
			}else{

				$error = array('error' => $this->upload->display_errors());
			}
		
		}

		$this->load->view('console/common/header',$data);
		$this->load->view('console/sliders',$data);
		$this->load->view('console/common/footer');
	}

	public function delete_slider( $slider_id ){

		$this->db->where('id', $slider_id);
        if ($this->db->delete('sliders')) {
        	
        	redirect( 'console/sliders' );
        }
	}

	public function contactInfo(){

		$this->is_user_logged();

		$data['title_for_layout'] = "Footer Info";

		if (!empty( $this->input->post() )) {

			$social_links['facebook'] = $this->input->post('facebook');
			$social_links['instagram'] = $this->input->post('instagram');
			$social_links['twitter'] = $this->input->post('twitter');
			$social_links['pinterest'] = $this->input->post('pinterest');

			$contact_info['id'] = $this->input->post('id');
			$contact_info['abount_us'] = $this->input->post('abount_us');
			$contact_info['email'] = $this->input->post('email');
			$contact_info['mobile'] = $this->input->post('mobile');
			$contact_info['address'] = $this->input->post('address');
			$contact_info['social_links'] = json_encode($social_links);

			if($this->User_mo->update_selling_device_info( $contact_info )){

				redirect( base_url('console/contact-info') );
			}


		}

		$this->load->view('console/common/header',$data);
		$this->load->view('console/contactInfo',$data);
		$this->load->view('console/common/footer');
	}

	public function terms_conditions(){

		$this->is_user_logged();

		$data['title_for_layout'] = "Terms & Conditions";

		if (!empty($this->input->post('action')=="UpdateTerms")) {

			$_data['id'] = $this->input->post('term_id');
			$_data['content'] = $this->input->post('content');

			if ($this->User_mo->update_terms_conditions( $_data )) {
				
				redirect( base_url('console/terms-and-conditions') );
			}
		}

		$data['conditions'] = $this->User_mo->get_terms_conditions();


		$this->load->view('console/common/header',$data);
		$this->load->view('console/terms_conditions',$data);
		$this->load->view('console/common/footer');
	}

	public function copyright_content(){

		$this->is_user_logged();

		$data['title_for_layout'] = "Copy Right";

		if (!empty( $this->input->post() )) {

			$copy_info['id'] = $this->input->post('id');
			$copy_info['title'] = $this->input->post('title');
			$copy_info['desctiption'] = $this->input->post('desctiption');
			if($this->User_mo->update_copyright_info( $copy_info )){

				redirect( base_url('console/copyright-content') );
			}
		}

		$this->load->view('console/common/header',$data);
		$this->load->view('console/copyright_content',$data);
		$this->load->view('console/common/footer');
	}

	public function how_it_works(){

		$this->is_user_logged();

		$data['title_for_layout'] = "How it Works";

		$data['works'] = $this->User_mo->workList();

		if (!empty( $this->input->post('action') == "addNewWork" )) {
			
			$wdata['title'] = $this->input->post('title');
			$wdata['description'] = $this->input->post('description');

			$config = array(
							'upload_path' => "assets/images/",
							'allowed_types' => "gif|jpg|png|jpeg|pdf",
							'overwrite' => TRUE
						);

			$this->load->library('upload', $config);
			
			if( $this->upload->do_upload('icon') ){

				//$_data = array('upload_data' => $this->upload->data());

				$_data['logo'] = $this->upload->data();
				$wdata['image'] = $_data['logo']['file_name'];

				$this->User_mo->add_work( $wdata );
				redirect( 'console/how-it-works' );
			
			}else{

				$error = array('error' => $this->upload->display_errors());
			}

		}else if (!empty( $this->input->post('action') == "deleteWork" )) {

			$data['del_id'] = $this->input->post('del_id');
			$this->User_mo->delete_work( $data['del_id'] );
		
		}else if (!empty( $this->input->post('action') == "EditWork" )) {

			$update['id'] = $this->input->post('edit_id');
			$update['title'] = $this->input->post('title');
			$update['description'] = $this->input->post('description');

			$config = array(
							'upload_path' => "assets/images/",
							'allowed_types' => "gif|jpg|png|jpeg",
							'overwrite' => TRUE
						);

			$this->load->library('upload', $config);

			if( $this->upload->do_upload('image') ){

				$_data = array('upload_data'=>$this->upload->data());

				$_data['logo'] = $this->upload->data();
				$update['image'] = $_data['logo']['file_name'];
				
				$this->User_mo->update_home_work( $update );
				redirect( base_url('console/how-it-works') );
			
			}else{

				$error = array('error' => $this->upload->display_errors());
			}

		}

		$this->load->view('console/common/header',$data);
		$this->load->view('console/how_it_works',$data);
		$this->load->view('console/common/footer');
	}

	public function edit_works( $work_id ){

		$this->is_user_logged();

		$data['title_for_layout'] = "Edit Work";

		$data['edit_works'] = $this->User_mo->get_work_by_id( $work_id );

		$this->load->view('console/common/header',$data);
		$this->load->view('console/edit_works',$data);
		$this->load->view('console/common/footer');
	}

	public function popularity(){

		$this->is_user_logged();

		$data['title_for_layout'] = "Popularity";

		$data['populars'] = $this->User_mo->popularityList();

		if (!empty( $this->input->post('action') == "addNewPopularity" )) {
			
			$_data['title'] = $this->input->post('title');
			$_data['icon'] = $this->input->post('icon');
			$_data['rank'] = $this->input->post('rank');
			$_data['description'] = $this->input->post('description');

			if( $this->User_mo->add_popularity( $_data ) ){

				redirect( 'console/popularity' );
			}

		}else if (!empty( $this->input->post('action') == "deletePopularity" )) {

			$data['del_id'] = $this->input->post('del_id');
			$this->User_mo->delete_popularity( $data['del_id'] );
		
		}else if (!empty( $this->input->post('action') == "updatePopularity" )) {

			#print_r( $this->input->post() );exit();
			$update['edit_id'] = $this->input->post('edit_id');
			$update['title'] = $this->input->post('title');
			$update['rank'] = $this->input->post('rank');
			$update['icon'] = $this->input->post('icon');
			$update['description'] = $this->input->post('description');
			if( $this->User_mo->update_popularity( $update ) ){

				redirect( 'console/popularity' );
			}
		}

		$this->load->view('console/common/header',$data);
		$this->load->view('console/popularity',$data);
		$this->load->view('console/common/footer');
	}

	public function edit_popularity( $edit_id ){

		$this->is_user_logged();

		$data['title_for_layout'] = "Popularity";

		$data['edit_popular'] = $this->User_mo->get_popular( $edit_id );

		$this->load->view('console/common/header',$data);
		$this->load->view('console/edit_popularity',$data);
		$this->load->view('console/common/footer');
	}

	public function frequently_asked_questions(){

		$this->is_user_logged();

		$data['title_for_layout'] = "Frequently Asked Questions";

		$data['faqs'] = $this->User_mo->faqList();

		if (!empty( $this->input->post('action') == "addFAQ" )) {
			
			$_data['question'] = $this->input->post('question');
			$_data['answer'] = $this->input->post('answer');
			if( $this->User_mo->add_faq( $_data )){

				redirect( 'console/frequently-asked-questions' );
			}
		}else if (!empty( $this->input->post('action') == "deleteFAQ" )) {

			$data['del_id'] = $this->input->post('del_id');
			$this->User_mo->delete_faq( $data['del_id'] );
		}

		$this->load->view('console/common/header',$data);
		$this->load->view('console/frequently_asked_questions',$data);
		$this->load->view('console/common/footer');
	}

	public function enquiry(){

		$this->is_user_logged();

		$data['title_for_layout'] = "Enquiry";

		$data['contacts'] = $this->User_mo->enquiryList();

		$this->load->view('console/common/header',$data);
		$this->load->view('console/enquiry',$data);
		$this->load->view('console/common/footer');
	}

	// Logout from admin page
	public function logout(){

		// Removing session data
		$this->session->unset_userdata('email');
		$this->session->set_flashdata('message', '<div class="alert alert-success">You have Successfully Logout.</div>');
		redirect( base_url('console/login') );
	}

	public function icons(){

		$this->is_user_logged();

		$data['title_for_layout'] = "Icons";

		$data['mobile_icons'] = $this->User_mo->get_mobile_icons();

		$data['laptop_icons'] = $this->User_mo->get_laptop_icons();

		$data['watch_icons'] = $this->User_mo->get_watch_icons();

		$data['airpod_icons'] = $this->User_mo->get_airpod_icons();

		if (!empty( $this->input->post('action') == "addNewImage" )) {

			
			$add_icon['category_id'] = $this->input->post('category_id');
			$add_icon['module'] = $this->input->post('module');
			$add_icon['title'] = $this->input->post('title');

			$image = time().'-'.$_FILES["image"]['name'];

			$config = array(
							'upload_path' => "assets/uploads/icons",
							'allowed_types' => "*",
							'file_name' => $image
						);

			$this->load->library('upload', $config);

			if( $this->upload->do_upload('image') ){

				$_data = array('upload_data'=>$this->upload->data());

				$_data['logo'] = $this->upload->data();
				$add_icon['image'] = $_data['logo']['file_name'];

				#print('<pre>'.print_r($add_icon,true).'<pre>');exit();
				
				$this->User_mo->insert_icons( $add_icon );
				redirect( base_url('console/icons') );
			
			}else{

				$error = array('error' => $this->upload->display_errors());
			}
		}

		$this->load->view('console/common/header',$data);
		$this->load->view('console/icons',$data);
		$this->load->view('console/common/footer');

	}

	public function delete_icons( $icon_id ){


		$this->db->where('id', $icon_id);
        if ( $this->db->delete('icons') ) {
        	
        	redirect( base_url('console/icons') );
        }
	}

	public function city(){

		$this->is_user_logged();

		$data['title_for_layout'] = "City";

		$data['cities'] = $this->User_mo->get_available_city();

		if (!empty( $this->input->post('action')=="addCity")) {

			$insert['name'] = $this->input->post('city');
			$insert['status'] = 'active';

			if ( $this->User_mo->insert_city( $insert ) ) {
				
				redirect( base_url('console/city') );
			}

		}else if (!empty( $this->input->post('action')=="deleteCity")) {

			$del_id = $this->input->post('del_id');

			$this->db->where('id', $del_id);
	        if ( $this->db->delete('cities') ) {
	        	
	        	redirect( base_url('console/city') );
	        }

		}

		$this->load->view('console/common/header',$data);
		$this->load->view('console/city',$data);
		$this->load->view('console/common/footer');
	}

}
