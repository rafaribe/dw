<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Menu extends CI_Controller
{
	function __construct()
    {
        // Construct our parent class
        parent::__construct();
				$this->load->helper(array('form','url'));
				$this->load->model('Menu_Model');


    }
    function index()
      {

         if($this->session->userdata('logged_in'))
          {
            $this->load->model('menu_model');
            $data['list'] = $this->menu_model->menu_id_name();
            $this->load->view('sample_navbar_view');
            $this->load->view('menu_view', $data);

      }
        else
        {
                //If no session, redirect to login page
                redirect('login', 'refresh');
        }
      }
      function menu_add()
      {
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');

        $config = array(
                          array(
                           'field'   => 'RestaurantName',
                           'label'   => 'Restaurant Name',
                           'rules'   => 'required|callback_restaurant_check'
                          ),
                          array(
                           'field'   => 'RestaurantAddress',
                           'label'   => 'Address',
                           'rules'   => 'required'
                          ),
                          array(
                           'field'   => 'RestaurantReservations',
                           'label'   => 'Reservations',
                           'rules'   => 'max_length[1]|integer'
                          ),
                          array(
                           'field'   => 'RestaurantWifi',
                           'label'   => 'RestaurantWifi',
                           'rules'   => 'max_length[1]|integer'
                          ),
                          array(
                            'field'   => 'RestaurantDelivery',
                            'label'   => 'Restaurant Delivery',
                            'rules'   => 'max_length[1]|integer'
                           ),
                          array(
                            'field'   => 'RestaurantMultibanco',
                            'label'   => 'RestaurantMultibanco',
                            'rules'   => 'max_length[1]|integer'
                          ),
                          array(
                              'field'   => 'RestaurantImage',
                              'label'   => 'RestaurantImage',
                              'rules'   => ''
                               )
                          );

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE)
            {
              $this->load->view('sample_navbar_view');
              $this->load->view('restaurant_add');
              return FALSE;
            }
            else
            {

              $file_name = $this->do_upload();
      //			echo 'file_name';
            //	echo $file_name;
              $data = array(
         'RESTAURANT_NAME' => $this->input->post('RestaurantName'),
         'RESTAURANT_ADDRESS' => $this->input->  post('RestaurantAddress'),
         'RESTAURANT_RESERVATIONS'=> $this->input->  post('RestaurantReservations'),
         'RESTAURANT_WIFI'=> $this->input->  post('RestaurantWifi'),
         'RESTAURANT_DELIVERY'=> $this->input->  post('RestaurantDelivery'),
         'RESTAURANT_MULTIBANCO'=> $this->input->    post('RestaurantMultibanco'),
         'RESTAURANT_OUTDOOR_SEATING'=> $this->input->   post('RestaurantOutdoorSeating'),
         'RESTAURANT_IMAGE'=> $file_name
     );

          $this->load->model('restaurant_model');
          $this->restaurant_model->restaurant_add($data);

              return TRUE;
            }
    }
    function restaurant_check($restaurantname){
        $this->load->model('restaurant_model');
        $result = $this->restaurant_model->check_restaurant_name($restaurantname);

        if($result > 0)	{
          return FALSE;
    }
        else	{
            return TRUE;
          }
      }

  }
