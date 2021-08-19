<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Department_model extends CI_Model {

  /*function order_summary_insert($data){
    $this->db->insert('orders',$data);
	}*/

  function get_departments(){

      $data = $this->db->select('*');
        $data = $this->db->from('departments');
        $data = $this->db->get();  
        return $data->result_array();
  }


    function addleave_details_master($data){

    return $this->db->insert('leave',$data);

   }

  function get_edit_departments($id){

  	 $data = $this->db->select('*');
        $data = $this->db->from('departments');
        $data = $this->db->where('id',$id);
        $data = $this->db->get();  
        return $data->result_array();
  }
   
    function update_department( $data ){

    	#print_r($data);exit(); 

        $this->db->set('department',$data['department']);
        $this->db->where('id', $data['id']);
        $this->db->update('departments');
        return true;
    }
     function update_Basic_Salary($id,$data){
        $this->db->where('id', $id);
        $this->db->update('user', $data);
        if ($this->db->affected_rows() == '1')
        {
            return TRUE;
        }
        return FALSE;


    }

     function get_leaves_details(){

      $data = $this->db->select('leave.*,user.name,user.designation');
        $data = $this->db->from('leave');
        $this->db->join('user', 'user.id = leave.user_id');
        $data = $this->db->get();  
        return $data->result_array();
  }
   function get_addleaves_details(){

      $data = $this->db->select('*');
        $data = $this->db->from('leave');
        $data = $this->db->get();  
        return $data->result_array();
  }
  function get_compose_mail(){

     
  }
   function get_mailbox(){

     
  }
  function get_read_mail(){

     
  }
}