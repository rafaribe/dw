<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Restaurant extends CI_Controller
{
	function __construct()
    {
        // Construct our parent class
        parent::__construct();

    }
public function view_all_restaurant_get()
    {
	$thid->load->model('restaurant_model');
	$data['list'] = $this->restaurant_model->teste();
	$this->load->view('list_restaurant_view');
    }
}
?>
