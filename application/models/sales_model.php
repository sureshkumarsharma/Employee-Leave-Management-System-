<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_model extends CI_Model {

  function order_summary_insert($data){
    $this->db->insert('orders',$data);
	}

function getUsers(){
 
    $response = array();
 
    // Select record
    $this->db->select('*');
    $q = $this->db->get('users');
    $response = $q->result_array();

    return $response;
  }

}