<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dish extends CI_Controller
{
	function __construct()
    {
        // Construct our parent class
        parent::__construct();
				$this->load->helper(array('form','url'));
				$this->load->model('Dish_Model');

    }
	function index()
		{
			if($this->session->userdata('logged_in'))
			 {
				 $this->load->model('dish_model');
				 $data['list'] = $this->dish_model->dish_id_name_image();
				 $this->load->view('sample_navbar_view');
				 $this->load->view('dishes_view', $data);

	 }
		 else
		 {
						 //If no session, redirect to login page
						 redirect('login', 'refresh');
		 }
		 }


	function dish_register()
	{
		$this->load->view('sample_navbar_view');
		$this->load->view('dishes_add');
	}
}
?>
