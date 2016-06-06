<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Restaurant extends CI_Controller
{
	function __construct()
    {
        // Construct our parent class
        parent::__construct();
				$this->load->helper('url');
				$this->load->model('Restaurant_Model');

    }
	function index()
		{
			$this->load->view('restaurant_view');
		}
}
?>
