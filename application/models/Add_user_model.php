<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_user_model extends CI_Model {

  /*function order_summary_insert($data){
    $this->db->insert('orders',$data);
	}*/

  function get_add_users(){

      $data = $this->db->select('*');
        $data = $this->db->from('user');
        $data = $this->db->get();  
        return $data->result_array();
  } 
   function get_add_use(){

      $data = $this->db->select('*');
        $data = $this->db->from('user');
        $data = $this->db->get();  
        return $data->result_array();
  } 

   function get_add_userss(){

      $data = $this->db->select('*');
        $data = $this->db->from('user');
        $data = $this->db->get();  
        return $data->result_array();
  } 
    function get_profile_user($id){

      $data = $this->db->select('*');
      $data = $this->db->from('user');
      $data = $this->db->where('id',$id);
      $data = $this->db->get();  
      return $data->result_array();
  }



  function get_edit_users($uid){

      $data = $this->db->select('*');
        $data = $this->db->from('user');
        $data = $this->db->where('id',$uid);
        $data = $this->db->get();  
        return $data->result_array();
  }
   function get_users($id){

  	 $data = $this->db->select('*');
        $data = $this->db->from('users');
        $data = $this->db->where('id',$id);
        $data = $this->db->get();  
        return $data->result_array();
  }

   
   
 function add_user_master($data){

    return $this->db->insert('user',$data);

} 
  
   function addusersalarydetails_master($data){

      #print_r($data);exit();
      $update = array(
          'id'=>$data['employe_id'],
          'total_salary'=>$data['total_salary'],
          'Basic_Salary'=>$data['Basic_Salary'],
          'Total_Allowance'=>$data['Total_Allowance'],
          'Total_Deduction'=>$data['Total_Deduction'],
      );
      $this->db->where('id',  $update['id']);
      $this->db->update('user', $update);
    } 

    function update_user_details($post) {
 
        $this->db->where('id', $post['id']);
        $this->db->update('user', $post);
    }
    function fetch_employe()
    {
      $this->db->order_by('departments');
      return $query->result();
    }
}          