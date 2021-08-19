<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	public function index()
	{
		$this->load->view('home');
	}

	public function about_us(){

		$this->load->view('admin/about_us');
			
	}

	function new_blank_order_summary() 
    {
      $insert['OrderLines'] = $this->input->post('order_lines');
      $insert['CustomerName'] = $this->input->post('customer');
         
     $this->Main_model->order_summary_insert($insert);

    $this->load->view('sales/new_blank_order_summary');
   }
}
