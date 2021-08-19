<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
        
        parent::__construct();
        $this->load->helper(array('url','path','form'));
        $this->load->library('form_validation');
        /*$this->load->library('email');*/
        $this->load->model('Category');
        $this->load->model('User_mo');
        $this->load->model('Brand');

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

	public function error404(){

		echo "error404";exit();
	}

	public function index(){

		$data['title_for_layout'] = "Selling Device";

		$data['sliders'] = $this->User_mo->get_sliders();
		$data['category'] = $this->Category->categoryList();
		$data['works'] = $this->User_mo->workList();
		$data['populars'] = $this->User_mo->popularityList();
		$data['whyus'] = $this->User_mo->GetWhyus();

		$data['cities'] = $this->User_mo->get_available_city();

		#print('<pre>'.print_r($categorylists,true).'<pre>');

		$this->load->view('common/header',$data);
		$this->load->view('index',$data);
		$this->load->view('common/footer');
	}

	public function search_device(){

		if (!empty( $this->input->post('keyword') ) ) {

			$data['result'] = $this->Category->search_keyword( $this->input->post('keyword') );

			$this->load->view('search_device',$data);
		}
	}

	public function selected_city(){

		if (!empty( $this->input->post('inputVal') ) ) {

			$data['inputVal'] = $this->User_mo->find_city( $this->input->post('inputVal') );

			if (!empty( $data['inputVal'] )) {

				$session_data = array( 'selected_city'=>$data['inputVal'][0]['name'] );

	            $this->session->set_userdata( $session_data );

			}else{

				exit('not city found');
			}
		}
	}

	public function loginShow(){

		$data['title_for_layout'] = "Login";

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

		$this->load->view('common/login_header',$data);
		$this->load->view('loginShow');
	}

	public function choose_brand(){

		$data['title_for_layout'] = "Choose Brand";

		$slugs = $this->input->get('product');

		$cats = $this->Category->find_by_slugs( $slugs );

		$data['brands'] = $this->Brand->getActiveMobileBrandList( $cats );

		$this->load->view('common/header',$data);
		$this->load->view('choose_brand',$data);
		$this->load->view('common/footer');
	}

	public function choose_model(){

		$data['title_for_layout'] = "Choose Your Model";

		$product = $this->input->get('product');
		$brand = $this->input->get('brand');

		$cat_id = $this->Category->get_category_id($product);
		$b_id = $this->Category->get_brand_id($cat_id,$brand);

		$data['models'] = $this->Brand->get_brand_models($cat_id,$b_id);

		#print_r( $data['models'] );exit();

		$this->load->view('common/header',$data);
		$this->load->view('choose_model',$data);
		$this->load->view('common/footer');	
	}

	public function choose_variant(){

		$data['title_for_layout'] = "Choose Variant";

		$_product = $this->input->get('product');
		$_brand = $this->input->get('brand');
		$_model = $this->input->get('model');

		$_cat_id = $this->Category->get_category_id( $_product );
		$_brand_id = $this->Category->get_brand_id( $_cat_id,$_brand );
		$_model_id = $this->Category->get_model_id( $_model );

		$this->session->set_userdata( 
			
			array('cat_id'=>$_cat_id,'brand_id'=>$_brand_id,'model_id'=>$_model_id) 
		);


		$data['model_details'] = $this->Brand->get_model_details($_cat_id,$_brand_id,$_model);
		$data['variants'] = $this->Brand->get_model_variants($_cat_id,$_brand_id,$_model_id);

		$this->load->view('common/header',$data);
		$this->load->view('choose_variant',$data);
		$this->load->view('common/footer');	
	}

	public function is_product_laptop(){

		if (!empty( $this->input->post('product') ) && !empty( $this->input->post('brand') ) && !empty( $this->input->post('slug') ) ) {
			
			$product = $this->input->post('product');
			$brand = $this->input->post('brand');
			$slug = $this->input->post('slug');

			#print_r( $this->input->post() );exit();

			$featued_img = $this->Category->get_featured_img( $this->input->post('slug') );

			#print_r( $featued_img[0]['featured_img'] );exit();

			$this->session->set_userdata( 
				array(
					'product'=>$product,
					'featued_img'=>$featued_img[0]['featured_img'] 
				) 
			);

			$url = base_url().'sell/'.$brand.'/'.$slug;

			echo $response = json_encode( array('url'=>$url) );

			return $response;
		}
	}

	public function choose_option(){

		$data['title_for_layout'] = "Choose Option";

		$_product = $this->input->get('product');
		$_brand = $this->input->get('brand');
		$_model = $this->input->get('model');
		$_ram = $this->input->get('ram');
		$variant_id = $this->input->get('vid');
		$_internal_storage = $this->input->get('internal-storage');
		$_band_size = $this->input->get('band-size');

		$warranty_status = $this->Category->device_warranty_status( $variant_id );

		$_cat_id = $this->Category->get_category_id( $_product );
		$_brand_id = $this->Category->get_brand_id( $_cat_id,$_brand );
		$_model_id = $this->Category->get_model_id( $_model );

		$data['model_details'] = $this->Brand->get_model_details($_cat_id,$_brand_id,$_model);
		$data['get_upto_price'] = $this->Brand->get_act_price($_model_id,$_ram,$_internal_storage);
		$data['upto_price'] = $this->Brand->get_upto_price($_model_id,$_ram,$_internal_storage);
		$data['dead_price'] = $this->Brand->get_dead_price($_model_id,$_ram,$_internal_storage);

		$data['carts'] = array('product'=>$_product,'brand'=>$_brand,'model'=>$_model,'vid'=>$variant_id,'ram'=>$_ram,'rom'=>$_internal_storage,'cat_id'=>$_cat_id,'brand_id'=>$_brand_id,'model_id'=>$_model_id,'price'=>$data['get_upto_price'],'dead_price'=>$data['dead_price'],'warranty_status'=>$warranty_status,'band_size'=>$_band_size );

		$this->session->set_userdata( $data['carts'] );

		$this->load->view('common/header',$data);
		$this->load->view('choose_option',$data);
		$this->load->view('common/footer');
	}

	public function calculate_price(){

		if(!empty( $this->input->post('price') ) ){

			$price = $this->input->post('price');

			if ($price > 0) {

				$sell_price = $this->input->post('price');
				
				$this->session->set_userdata( array('value_of_device'=>$price) );
			
			}else{

				$sell_price = $this->session->userdata('dead_price');

				$this->session->set_userdata( array('value_of_device'=>$sell_price) );
			}
			
		}

		echo $response = json_encode( array('sell_price'=>$sell_price) );

		return $sell_price;
	}

	public function order_send_mail( $user,$order ) {
        
        $from_email = "order@sellingdevice.com";
        $to_email = $user['email'];

        //$this->input->post('email');

        /* Email smtp email */

		$config['protocol']  = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.gmail.com';
		$config['smtp_port'] = 465;
		$config['wordwrap']  = true;
		$config['smtp_user'] = 'order.sellingdevice@gmail.com';
		$config['smtp_pass'] = 'selling@34$';
		$config['mailtype'] = 'html';
		$config['charset']   = 'iso-8859-1';
		

		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");

		$full_name = $user['fname'].' '.$user['lname'];

		$address = json_decode($order['address']);

		$payment_details = json_decode($order['payment_details']);

		#print_r( $payment_details );exit();


		if ($payment_details->payment_mode=="banktransfer") {

			$payment = "<ul style='list-style-type: none;'>
			        		<li><b>Payment Mode</b> : ".$payment_details->payment_mode."</li><br>
			        		<li><b>Bank Name</b> : ".$payment_details->bank_name."</li><br>
			        		<li><b>Account Holder</b> : ".$payment_details->account_holder."</li><br>
			        		<li><b>Account Number</b> : ".$payment_details->account_number."</li><br>
			        		<li><b>IFSC Code</b> : ".$payment_details->ifsc_code."</li><br>
			        	</ul>";
			

		}else if($payment_details->payment_mode=="paytm" || $payment_details->payment_mode=="googlepay" || $payment_details->payment_mode=="phonepe" || $payment_details->payment_mode=="amazonpay"){

			$payment = "<ul style='list-style-type: none;'>
			        		<li><b>Payment Mode</b> : ".$payment_details->payment_mode."</li><br>
			        		<li><b>Number</b> : ".$payment_details->pay_number."</li><br>
			        	</ul>";

		}else if ($payment_details->payment_mode=="cashpayment") {
			
			$payment = "<ul style='list-style-type: none;'>
			        		<li><b>Payment Mode</b> : Cash</li><br>
			        	</ul>";
		}


		$category = $this->Category->getcategoryTitle( $order['cat_id'] );
		$brand = ucwords( $this->Brand->getBrandName( $order['brand_id'] ) );
		$model = ucwords( $this->Brand->getModelName( $order['model_id'] ) );
		$variant = $this->Brand->get_variant_name( $order['variant_id'] );


		// Set to, from, message, etc.

		$subject = "Order Place Successfully";
        $message =  "<!DOCTYPE html>
        				<html>
        					<head></head>
        					<body>
        						<table border='1' cellpadding='10px' align='center' width='600px'>
        							<tr>
        								<td colspan='2'>Order Detail</td>
        							</tr>
        							<tr>
        								<td>Order No.</td>
        								<td>#".$order['order_number']."</td>
        							</tr>
        							<tr>
        								<td>User Info</td>
        								<td>
        									<b>Name</b> : ".ucwords($full_name)."<br>
        									<b>Email</b> : ".$user['email']."<br>
        									<b>Mobile</b> : ".$user['mobile_no']."<br>
        								</td>
        							</tr>
        							<tr>
        								<td>Address Detail</td>
        								<td>
        									<b>Address Type</b> : ".ucfirst($address->address_type)."<br>
        									<b>Address</b> : ".$address->address."<br>
        									<b>Building</b> : ".$address->building."<br>
        									<b>Locality</b> : ".$address->locality."<br>
        									<b>Pincode</b> : ".$address->pincode."<br>
        									<b>Alternate Mobile</b> : ".$address->alternate_mobile."<br>
        								</td>
        							</tr>
        							<tr>
        								<td>Mobile</td>
        								<td>+91-".$user['mobile_no']."</td>
        							</tr>
        							<tr>
        								<td>Payment Detail</td>
										<td>".$payment."</td>
        							</tr>
        							<tr>
        								<td>Device Info</td>
        								<td>
        									<b>Category</b> : ".$category."<br>
        									<b>Brand</b> : ".$brand."<br>
        									<b>Model</b> : ".$model."<br>
        									<b>Variant</b> : ".$variant."<br>
        								</td>
        							</tr>
        							<tr>
        								<td>Device Detail</td>
        								<td>
        									<b>Accessories</b> : ".$order['accessories']."<br>
        									<b>Glass Defect</b> : ".$order['glass_defect']."<br>
        									<b>Display Defect</b> : ".$order['display_defects']."<br>
        									<b>Body Defect</b> : ".$order['body_defects']."<br>
        									<b>Faults</b> : ".$order['faults']."<br>
        									<b>Device Age</b> : ".$order['device_age']."<br>
        								</td>
        							</tr>
        							<tr>
        								<td>Pickup Request</td>
        								<td>
        									<b>Pickup Date</b> : ".$order['pickup_date']."<br>
        									<b>Pickup Time</b> : ".$order['pickup_time']."<br>
        								</td>
        							</tr>
        							<tr>
        								<td><b>Total Amount</b></td>
        								<td>".number_format($order['order_value'])."</td>
        							</tr>
        						<table>
        					</body>
        				</html>";

		//Load email library
        $this->load->library('email');
        $this->email->from($from_email, 'Selling Device');
        $this->email->to($to_email);
        $this->email->subject( $subject );
        $this->email->message( $message );

		//$result = $this->email->send();

		if (!$this->email->send()) {

		    show_error( $this->email->print_debugger() );

		}else {
		    
		    echo "Your e-mail has been sent!";
		}

		/* Email smtp email */        

        //exit('email sent.');
    }

	public function place_order(){

		if (!empty( $this->input->post() )) {

			#print('<pre>'.print_r($this->input->post(),true).'<pre>');exit();

			$payment['payment_mode'] = $this->input->post('payment_mode');
			$payment['payment_mode_number'] = $this->input->post('payment_mode_number');
			$payment['bank_name'] = $this->input->post('bank_name');
			$payment['account_holder'] = $this->input->post('account_holder');
			$payment['account_number'] = $this->input->post('account_number');
			$payment['ifsc_code'] = $this->input->post('ifsc_code');

			if ( $payment['payment_mode']=="banktransfer" || $payment['payment_mode']=="cashpayment" ) {
				
				
				$response = json_encode( array('payment_mode'=>$payment['payment_mode'],'bank_name'=>$payment['bank_name'],'account_holder'=>$payment['account_holder'],'account_number'=>$payment['account_number'],'ifsc_code'=>$payment['ifsc_code']) );

			}else if ( $payment['payment_mode']=="paytm" || $payment['payment_mode']=="googlepay" || $payment['payment_mode']=="phonepe" || $payment['payment_mode']=="amazonpay") {

				$response = json_encode( array('payment_mode'=>$payment['payment_mode'],'pay_number'=>$payment['payment_mode_number']) );
			}


			#print('<pre>'.print_r($this->input->post(),true).'<pre>');exit();
			#print_r( $response );exit();
			
			$user['fname'] = $this->input->post('fname');
			$user['lname'] = $this->input->post('lname');
			$user['email'] = $this->input->post('email');
			$user['mobile_no'] = $this->input->post('mobile');
			
			

			$order['secondary_contact'] = $this->input->post('mobile-number');
			$order['payment_details'] = $response;
			$order['pickup_date'] = $this->input->post('date');
			$order['pickup_time'] = $this->input->post('time');
			$order['cat_id'] = $this->input->post('cat_id');
			$order['brand_id'] = $this->input->post('brand_id');
			$order['model_id'] = $this->input->post('model_id');
			$order['variant_id'] = $this->input->post('variant_id');
			
			if (!empty( $this->input->post('band_size') )) {
				
				$order['smart_watch_band_size'] = $this->input->post('band_size');
			}
			
			$order['accessories'] = $this->input->post('accessories');
			$order['glass_defect'] = $this->input->post('glass_defect');
			$order['display_defects'] = $this->input->post('display_defects');
			$order['body_defects'] = $this->input->post('body_defects');
			$order['faults'] = $this->input->post('faults');
			$order['rating'] = $this->input->post('rating');
			
			if ($this->input->post('cat_id')=='2') {
				
				$order['cpu_model'] = $this->input->post('cpu_model');
				$order['ram_size'] = $this->input->post('ram_size');
				$order['storage_size'] = $this->input->post('storage_size');
			}

			if (!empty($this->input->post('airpod_cond'))) {
				
				$order['airpod_cond'] = $this->input->post('airpod_cond');
				$order['airpod_power_status'] = $this->input->post('airpod_power_status');
			}
			
			$order['device_age'] = $this->input->post('device_age');
			$order['order_value'] = $this->input->post('device_value');
			//$order['device_age'] = $this->input->post('device_age');
			$order['order_number'] = time();

			$_address['primary_address'] = $this->input->post('address');
			$_address['address_type'] = $this->input->post('address_type');
			$_address['building'] = $this->input->post('building');
			$_address['locality'] = $this->input->post('locality');
			$_address['pincode'] = $this->input->post('pincode');
			$_address['alternate_mobile'] = $this->input->post('alternate-mobile-number');

			#print_r($order);exit();

			$check_exist_user = $this->User_mo->check_exist_user( $user['mobile_no'] );

			#print_r($check_exist_user);exit();

			if (!empty( $check_exist_user )) {

				$order['address'] = json_encode( array('address_type'=>$_address['address_type'],'address'=>$_address['primary_address'],'building'=>$_address['building'],'locality'=>$_address['locality'],'pincode'=>$_address['pincode'],'alternate_mobile'=>$_address['alternate_mobile']) );
				
				//$address['user_id'] = $check_exist_user[0]['user_id'];
				//$address['primary_address'] = $addresss;

				//if( $this->User_mo->update_register_users( $address ) ){

					$order['user_id'] = $check_exist_user[0]['user_id'];

					if( $order_no = $this->User_mo->place_order( $order ) ){

						$this->order_send_mail( $user,$order );
						
						//$this->session->sess_destroy();
						$this->session->unset_userdata('product','brand','model','vid','ram','rom','cat_id','brand_id','model_id','price','dead_price','warranty_status','value_of_device','airpod_cond','airpod_power_status','cpu_model','ram_size','storage_size','band_size');

						redirect( base_url('thanku?order-number='.$order_no) );
					}
				//}	

			}else{

				$order['address'] = json_encode( array('address_type'=>$_address['address_type'],'address'=>$_address['primary_address'],'building'=>$_address['building'],'locality'=>$_address['locality'],'pincode'=>$_address['pincode'],'alternate_mobile'=>$_address['alternate_mobile']) );

				if( $user_id = $this->User_mo->register_users( $user ) ){

					$order['user_id'] = $user_id;

					if( $order_no = $this->User_mo->place_order( $order ) ){

						$this->order_send_mail( $user,$order );

						//$this->session->sess_destroy();

						$this->session->unset_userdata('product','brand','model','vid','ram','rom','cat_id','brand_id','model_id','price','dead_price','warranty_status','value_of_device','airpod_cond','airpod_power_status','cpu_model','ram_size','storage_size','band_size');

						redirect( base_url('thanku?order-number='.$order_no) );
					}
				}
			}
		}
	}

	public function create_report(){

		if (!empty( $this->input->post() )) {
			
			#print_r( $this->input->post() );exit();

			$data['brand'] = $this->input->post('brand');
			$data['slug'] = $this->input->post('slug');
			$redirect_url = base_url('process-order/'.$data['brand'].'/'.$data['slug']);

			$data['mobile'] = $this->input->post('mobile');
			$data['accessories'] = $this->input->post('accessories');
			$data['type'] = $this->input->post('type');
			$data['glass'] = $this->input->post('glass');
			$data['display'] = $this->input->post('display');
			$data['body'] = $this->input->post('body');
			$data['faults'] = $this->input->post('faults');
			$data['rating'] = $this->input->post('rating');
			$data['age'] = $this->input->post('age');
			$data['bill'] = $this->input->post('bill');
			$data['airpod_cond'] = $this->input->post('airpod_cond');
			$data['airpod_power_status'] = $this->input->post('airpod_power_status');

			$data['cpu_model'] = $this->input->post('cpu_model');
			$data['ram_size'] = $this->input->post('ram_size');
			$data['storage_size'] = $this->input->post('storage_size');


			$data['value_of_device'] = $this->session->userdata('value_of_device');
			$data['redirect'] = $redirect_url;

			$this->session->set_userdata( array('mobile'=>$data['mobile'],'accessories'=>$data['accessories'],'type'=>$data['type'],'glass'=>$data['glass'],'display'=>$data['display'],'body'=>$data['body'],'faults'=>$data['faults'],'rating'=>$data['rating'],'age'=>$data['age'],'bill'=>$data['bill'],'value_of_device'=>$data['value_of_device'],'airpod_cond'=>$data['airpod_cond'],'airpod_power_status'=>$data['airpod_power_status'],'cpu_model'=>$data['cpu_model'],'ram_size'=>$data['ram_size'],'storage_size'=>$data['storage_size']) );
		}

		echo $response =  json_encode( array( 'redirect'=>$data['redirect'] ) );

		return $response; 
	}

	public function process_order(){

		$data['title_for_layout'] = "Answer Few Questions";

		$data['slug'] = $this->uri->segment(3);

		$data['featued_img'] = $this->Category->get_featured_img( $data['slug'] );
		
		$data['payments'] = $this->Category->payment_method();

		$data['times'] = $this->User_mo->get_time_slots();

		$this->load->view('common/header',$data);
		$this->load->view('process_order',$data);
		$this->load->view('common/footer');
	}

	public function few_questions( $slugs ){

		$data['title_for_layout'] = "Answer Few Questions";


		//echo $this->session->userdata('warranty_status');

		$data['brand'] = $this->uri->segment(2);
		$data['slug'] = $this->uri->segment(3);

		$cat_id = $this->session->userdata('cat_id');
		$brand_id = $this->session->userdata('brand_id');
		$model_id = $this->session->userdata('model_id');
		$variant_id = $this->session->userdata('vid');

		if($cat_id==2){

			$data['accessories'] = $this->Category->get_laptop_accessories( $cat_id );
			$data['glass_defects'] = $this->Category->get_laptop_glass_defects($cat_id);
			$data['display_defects'] = $this->Category->get_laptop_display_defects($cat_id);
			$data['body_defects'] = $this->Category->get_laptop_body_defects($cat_id,$brand_id,$model_id,$variant_id);
			$data['faults'] = $this->Category->get_laptop_faults($cat_id);
			$data['featued_img'] = $this->Category->get_featured_img( $data['slug'] );
			$data['ages'] = $this->Category->get_laptop_device_ages($cat_id);

		}else{

			$data['accessories'] = $this->Category->get_accessories($cat_id,$brand_id,$model_id,$variant_id);
			$data['glass_defects'] = $this->Category->get_glass_defects($cat_id,$brand_id,$model_id,$variant_id);
			$data['display_defects'] = $this->Category->get_display_defects($cat_id,$brand_id,$model_id,$variant_id);
			$data['body_defects'] = $this->Category->get_body_defects($cat_id,$brand_id,$model_id,$variant_id);
			$data['faults'] = $this->Category->get_faults($cat_id,$brand_id,$model_id);
			$data['featued_img'] = $this->Category->get_featured_img( $data['slug'] );
			$data['ages'] = $this->Category->get_device_ages($cat_id,$brand_id,$model_id,$variant_id);

			$data['air_conditions'] = $this->Category->airpod_conditions();

			$data['watch_conditions'] = $this->Category->get_smart_watch_conditions();

		}
	

		$this->load->view('common/header',$data);
		$this->load->view('few_questions',$data);
		$this->load->view('common/footer');
	}

	public function thanku(){

		$data['title_for_layout'] = "thanks";

		$this->load->view('common/header',$data);
		$this->load->view('thanku');
		$this->load->view('common/footer');
	}

	public function sell( $slugs ){

		$this->load->view('common/header',$data);
		$this->load->view('sell',$data);
		$this->load->view('common/footer');
	}

	public function contact_us(){

		$data['title_for_layout'] = "Contact us";

		if (!empty( $this->input->post() )) {
			
			$_data['type'] = $this->input->post('type');
			$_data['email'] = $this->input->post('email');
			$_data['mobile'] = $this->input->post('mobile');
			$_data['message'] = $this->input->post('message');
			if( $this->User_mo->contact_us( $_data ) ){

				$this->session->set_flashdata('message', '<div class="alert alert-success">Enquiry Sent ! We will contact you soon.</div>');
				redirect( base_url('contact-us') );
			}
		}

		$this->load->view('common/header',$data);
		$this->load->view('contact_us');
		$this->load->view('common/footer');
	}

	public function frequently_asked_questions(){

		$data['title_for_layout'] = "Frequently Asked Questions";

		$data['faqs'] = $this->User_mo->faqList();

		$this->load->view('common/header',$data);
		$this->load->view('frequently_asked_questions',$data);
		$this->load->view('common/footer');
	}

	public function become_partner(){

		$data['title_for_layout'] = "Become Partner";

		$this->load->view('common/header',$data);
		$this->load->view('become_partner');
		$this->load->view('common/footer');
	}

	public function terms_conditions(){

		$data['title_for_layout'] = "Terms & Conditions";

		$data['conditions'] = $this->User_mo->get_terms_conditions();

		$this->load->view('common/header',$data);
		$this->load->view('terms_conditions');
		$this->load->view('common/footer');
	}

}
