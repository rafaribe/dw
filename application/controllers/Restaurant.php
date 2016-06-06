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

			// if($this->session->userdata('logged_in'))
		//	  {
			    $this->load->model('restaurant_model');
			    $data['list'] = $this->restaurant_model->restaurant_id_name_image();
					$this->load->view('sample_navbar_view');
			    $this->load->view('restaurant_view', $data);

		//	  }
		//		else
		//			{
							//If no session, redirect to login page
							//	redirect('login', 'refresh');
			//		}
			}
		}
?>
