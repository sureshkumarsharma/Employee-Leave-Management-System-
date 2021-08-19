<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Leavetype_model extends CI_Model {

  /*function order_summary_insert($data){
    $this->db->insert('orders',$data);
	}*/

  function get_leave_types(){

      $data = $this->db->select('*');
        $data = $this->db->from('leave_type');
        $data = $this->db->get();  
        return $data->result_array();
  }
   function get_leavetype($id){

  	 $data = $this->db->select('*');
        $data = $this->db->from('leave_type');
        $data = $this->db->where('id',$id);
        $data = $this->db->get();  
        return $data->result_array();
  }
   
    function update_leavetype( $data ){

    	#print_r($data);exit(); 

        $this->db->set('leave_type',$data['leave_type']);
        $this->db->where('id', $data['id']);
        $this->db->update('leave_type');
        return true;
    }

      
 

}