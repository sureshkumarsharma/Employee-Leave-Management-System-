<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_mo extends CI_Model {

	function admin_login($email, $password){

        $_password = md5( $password );

        $this->db->where('email', $email);  
        $this->db->where('password', $_password);  
        $this->db->where('status', 'Active');  
        $query = $this->db->get('admin_users');  
           
        if($query->num_rows() > 0){  
            
            return true;  
        
        }else{  
            
            return false;       
        }  
    }

    public function check_mobile_no($mobile){
          $data = $this->db->select('*');
        $data = $this->db->from('user');
     $data = $this->db->where('mobile_no',$mobile);
    $data = $this->db->get();  
    return $data->result_array();
    }

    function row_delete($id)
{
   $this->db->where('id', $id);
   $this->db->delete('departments');
   return true; 
}
   function get_salary_detail($uid)
{
        $data = $this->db->select('*');
        $data = $this->db->from('user');
        $data = $this->db->where('id',$uid);
      $data = $this->db->get();  
      return $data->result_array();

}

function get_leave_requests($uid)
{
    $data = $this->db->select('*');
    $data = $this->db->from('leave');
    $data = $this->db->where('user_id',$uid);
    $data = $this->db->get();
    return $data->result_array();
}

function get_logged_user_info($email){ 
    $data = $this->db->select('*');  
    $data =$this->db->from('user');
    $data =$this->db->where('email_address',$email);
    $data = $this->db->get();

    $result = $data->row();
    $id = $result->id; 
    return $id;
}


  function update_leave($data){

    #print_r($data);exit();

    $this->db->set('leave_status',$data['action_id']);
    $this->db->where('id', $data['leave_id']);
    $this->db->update('leave');
    return true; 
}

 function row_userlistdelete($id)
{
   $this->db->where('id', $id);
   $this->db->delete('user');
   return true; 
}
 function row_leavelistdelete($id)
{
   $this->db->where('id', $id);
   $this->db->delete('leave');
   return true; 
}


    function update_user_details($post) {
 
        $this->db->where('id', $post['id']);
        $this->db->update('user', $post);
        return true;
    }

function row_deleteleave($id)
{
   $this->db->where('id', $id);
   $this->db->delete('leave_type');
   return true; 
}

function get_user_permission($user_id){

    $this->db->select('*');    
    $this->db->from('permissions');
    //$this->db->where('role_perm.user_id', $user_id);
    $this->db->join('role_perm', 'permissions.perm_id = role_perm.perm_id');
    $result = $this->db->get();
    return $result->result_array();
}

function add_departments($data){

    return $this->db->insert('departments',$data);

}

function add_permissions($data){

    return $this->db->insert('permissions',$data);

}

function checkdepartment($name){

    $data = $this->db->select('department');
    $data = $this->db->from('departments');
    $data = $this->db->where('department',strtolower($name));
    $data = $this->db->get();  
    return $data->result_array();
}

function do_login($data){

    $data = $this->db->select('*');
    $data = $this->db->from('user');
    $data = $this->db->where('email_eddress',$data['email']);
    $data = $this->db->where('password',$data['password']);
    $data = $this->db->get();
    return $data->result_array();
    
}

 function get_user_invoice_details($uid){

    $data = $this->db->select('*');
    $data = $this->db->from('user');
    $data = $this->db->where('id',$uid);
    $data = $this->db->get();
    return $data->result_array();
    
}


function checkusername($name){

    $data = $this->db->select('leave_type');
    $data = $this->db->from('leave_type');
    $data = $this->db->where('leave_type',strtolower($name));
    $data = $this->db->get();  
    return $data->result_array();
}


     function add_leave_type($data){

    return $this->db->insert('leave_type',$data);

  }
    function update_password( $data ){ 

        $this->db->set('password',md5( $data['password'] ));
        $this->db->where('email', $data['email']);
        $this->db->update('admin_users');
        return true;
    }

    public function insert_city( $data ){

        return $this->db->insert('cities',$data);
    }

    public function get_available_city(){

        $data = $this->db->select('*');
        $data = $this->db->from('cities');
        $data = $this->db->where('status','active');
        $data = $this->db->get();  
        return $data->result_array();
    }

    function get_accessories_icons(){

        $data = $this->db->select('*');
        $data = $this->db->from('icons');
        $data = $this->db->where('module','accessories');
        $data = $this->db->get();  
        return $data->result_array();
    }

    



    function get_airpod_icons(){

        $data = $this->db->select('*');
        $data = $this->db->from('icons');
        $data = $this->db->where('category_id','4');
        $data = $this->db->get();  
        return $data->result_array();
    }

    function user_register( $data ){ 

        return $this->db->insert('users',$data);
    }

    function get_time_slots(){

        $data = $this->db->select('*');
        $data = $this->db->from('pickup_times');
        $data = $this->db->get();  
        return $data->result_array();
    }

    function get_user_orders( $user_id ){

        $data = $this->db->select('*');
        $data = $this->db->from('orders');
        $data = $this->db->where('user_id',$user_id);
        $data = $this->db->get();  
        return $data->result_array();
    }

    function is_user_logged(){

        if ( !$this->session->has_userdata('email') ) {
            
            redirect( base_url('console/login') );
        }
    }

    function get_total_order(){

        $data = $this->db->select('*');
        $data = $this->db->from('orders');
        $data = $this->db->get();  
        return $data->result_array();   
    }

    function get_total_pending_order(){

        $data = $this->db->select('*');
        $data = $this->db->from('orders');
        $data = $this->db->where('status','PENDING');
        $data = $this->db->get();  
        return $data->result_array();   
    }

    function get_total_complete_order(){

        $data = $this->db->select('*');
        $data = $this->db->from('orders');
        $data = $this->db->where('status','COMPLETE');
        $data = $this->db->get();  
        return $data->result_array();   
    }

    function get_total_variants_order(){

        $data = $this->db->select('*');
        $data = $this->db->from('variants');
        $data = $this->db->get();  
        return $data->result_array();   
    }

    function get_user_info( $email ){

        $data = $this->db->select('*');
        $data = $this->db->from('admin_users'); 
        $data = $this->db->where('email',$email);
        $data = $this->db->get();  
        return $data->result_array();
    }

    function get_user_details( $user_id ){

        $data = $this->db->select('*');
        $data = $this->db->from('users'); 
        $data = $this->db->where('user_id',$user_id);
        $data = $this->db->get();  
        return $data->result_array();
    }

    function check_exist_user( $mobile ){

        $data = $this->db->select('*');
        $data = $this->db->from('users'); 
        $data = $this->db->where('mobile_no',$mobile);
        $data = $this->db->get();  
        return $data->result_array();
    }

    function update_terms_conditions( $data ){ 

        $this->db->set('content',$data['content']);
        $this->db->where('id', $data['id']);
        $this->db->update('terms_conditions');
        return true;
    }

    function get_terms_conditions(){

        $data = $this->db->select('*');
        $data = $this->db->from('terms_conditions');
        $data = $this->db->where('id','1');
        $data = $this->db->get();  
        return $data->result_array();
    }

    function get_sliders(){

       $data = $this->db->select('*');
        $data = $this->db->from('sliders');
        $data = $this->db->get();  
        return $data->result_array(); 
    }

    function add_address( $data ){ 

        return $this->db->insert('address',$data);
    }

    function update_register_users( $data ){

        $this->db->insert('users',$data);

        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }

    function register_users( $data ){

        $this->db->insert('users',$data);

        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }

    function get_order_number( $order_id ){

        $data = $this->db->select('*');
        $data = $this->db->from('orders');
        $data = $this->db->where('order_id',$order_id);
        $data = $this->db->get();  
        return $data->result_array();
    }

    function place_order( $data ){ 

        $this->db->insert('orders',$data);

        $insert_id = $this->db->insert_id();

        $data = $this->get_order_number( $insert_id );

        return $data[0]['order_number']; 
    }

    function GetWhyus(){

        $data = $this->db->select('*');
        $data = $this->db->from('whyus');
        $data = $this->db->get();  
        return $data->result_array();   
    }

    function get_Why_us( $id ){

        $data = $this->db->select('*');
        $data = $this->db->from('whyus');
        $data = $this->db->where('id',$id);
        $data = $this->db->get();  
        return $data->result_array();   
    }

    public function update_why_us( $data ){ 

        $this->db->set('title',$data['title']);
        $this->db->set('description',$data['description']);
        $this->db->set('icon',$data['icon']);
        $this->db->where('id', $data['id']);
        $this->db->update('whyus');
        return true;
    }

    public function update_home_work( $data ){ 

        $this->db->set('title',$data['title']);
        $this->db->set('description',$data['description']);
        $this->db->set('image',$data['image']);
        $this->db->where('id', $data['id']);
        $this->db->update('works');
        return true;
    }

    public function get_user_list(){

        $data = $this->db->select('*');
        $data = $this->db->from('admin_users');
        $data = $this->db->get();  
        return $data->result_array(); 
    }

    function get_admin_user_details( $user_id ){

        $data = $this->db->select('*');
        $data = $this->db->from('admin_users'); 
        $data = $this->db->where('id',$user_id);
        $data = $this->db->get();  
        return $data->result_array();
    }

    public function get_customers(){

        $data = $this->db->select('*');
        $data = $this->db->from('users');
        $data = $this->db->get();  
        return $data->result_array();
    }

    public function username_exists( $email ){

        $data = $this->db->select('*');
        $data = $this->db->from('admin_users');
        $this->db->where('email', $email);
        $data = $this->db->get();  
        return $data->result_array(); 
    }

    public function add_user( $data ){

        return $this->db->insert('admin_users',$data);
    }

    public function delete_user( $user_id ){

        $this->db->where('id', $user_id);
        $this->db->delete('admin_users');
    }

    public function delete_customers( $user_id ){

        $this->db->where('user_id', $user_id);
        $this->db->delete('users');
        return true;
    }

    public function edit_user( $user_id ){

        $data = $this->db->select('*');
        $data = $this->db->from('admin_users');
        $data = $this->db->where('id', $user_id);
        $data = $this->db->get();  
        return $data->result_array();
    }

    public function update_user( $data ){

        $this->db->set('username',$data['username']);
        $this->db->set('email',$data['email']);
        $this->db->set('role',$data['role']);
        $this->db->set('status',$data['status']);
        $this->db->where('id', $data['id']);
        $this->db->update('admin_users');
        return true;
    }

    public function selling_device_contact_info(){

        $data = $this->db->select('*');
        $data = $this->db->from('selling_device_info');
        $data = $this->db->get();  
        return $data->result_array();
    }

    public function copyright_info(){

        $data = $this->db->select('*');
        $data = $this->db->from('copyrights');
        $data = $this->db->get();  
        return $data->result_array(); 
    }

    public function update_selling_device_info( $data ){ 

        $this->db->set('email',$data['email']);
        $this->db->set('abount_us',$data['abount_us']);
        $this->db->set('mobile',$data['mobile']);
        $this->db->set('address',$data['address']);
        $this->db->set('social_links',$data['social_links']);
        $this->db->where('id', $data['id']);
        $this->db->update('selling_device_info');
        return true;
    }

    public function update_copyright_info( $data ){ 

        $this->db->set('title',$data['title']);
        $this->db->set('desctiption',$data['desctiption']);
        $this->db->where('id', $data['id']);
        $this->db->update('copyrights');
        return true;
    }

    public function add_work( $data ){

        return $this->db->insert('works',$data);
    }

    public function workList(){

        $data = $this->db->select('*');
        $data = $this->db->from('works');
        $data = $this->db->get();  
        return $data->result_array();
    }

    public function delete_work( $del_id ){

        $this->db->where('id', $del_id);
        $this->db->delete('works');
    }

    public function popularityList(){

        $data = $this->db->select('*');
        $data = $this->db->from('popularity');
        $data = $this->db->get();  
        return $data->result_array();
    }

    public function add_popularity( $data ){

        return $this->db->insert('popularity',$data);
    }

    public function delete_popularity( $del_id ){

        $this->db->where('id', $del_id);
        $this->db->delete('popularity');
    }

    public function get_popular( $popular_id ){

        $data = $this->db->select('*');
        $data = $this->db->from('popularity');
        $data = $this->db->where('id', $popular_id);
        $data = $this->db->get();  
        return $data->result_array();
    }

    public function get_order_detail( $order_id ){

        $data = $this->db->select('*');
        $data = $this->db->from('orders');
        $data = $this->db->where('order_id', $order_id);
        $data = $this->db->get();  
        return $data->result_array();
    }

    public function update_popularity( $data ){

        $this->db->set('description',$data['description']);
        $this->db->set('title',$data['title']);
        $this->db->set('rank',$data['rank']);
        $this->db->set('icon',$data['icon']);
        $this->db->where('id', $data['edit_id']);
        $this->db->update('popularity');
        return true;
    }

    public function add_faq( $data ){

        return $this->db->insert('faq',$data);
    }

    public function faqList(){

        $data = $this->db->select('*');
        $data = $this->db->from('faq');
        $data = $this->db->get();  
        return $data->result_array();
    }

    public function delete_faq( $del_id ){

        $this->db->where('id', $del_id);
        $this->db->delete('faq');
    }

    public function contact_us( $data ){

        return $this->db->insert('contact_us',$data);
    }

    public function enquiryList(){

        $data = $this->db->select('*');
        $data = $this->db->from('contact_us');
        $data = $this->db->get();  
        return $data->result_array();
    }

    public function get_whyus_icon( $id ){

        $data = $this->db->select('*');
        $data = $this->db->from('whyus');
        $data = $this->db->where('id',$id); 
        $data = $this->db->get();  
        $data = $data->result_array();
        return $data[0]['icon'];
    }

    public function update_whyus( $data ){ 

        $this->db->set('description',$data['description']);
        $this->db->set('title',$data['title']);
        $this->db->set('icon',$data['icon']);
        $this->db->where('id', $data['id']);
        $this->db->update('whyus');
        return true;
    }
	
}