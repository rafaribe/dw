<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dishes extends CI_Controller
{
	function __construct()
    {
        // Construct our parent class
        parent::__construct();
				$this->load->model('Dishes_Model');

    }
	function index()
		{
			$this->load->view('dishes_view');
		}
}
?>
