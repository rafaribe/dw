<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Restaurant extends CI_Controller
{
    public function __construct()
    {
        // Construct our parent class
                parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('Restaurant_Model');
    }
    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('restaurant_model');
            $data['list'] = $this->restaurant_model->restaurant_id_name_image();
            $this->load->view('sample_navbar_view');
            $this->load->view('restaurant_view', $data);
        } else {
            //If no session, redirect to login page
                                                        redirect('login', 'refresh');
        }
    }

    public function restaurant_add()
    {
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');

        $config = array(
          array(
           'field' => 'RestaurantName',
           'label' => 'Restaurant Name',
           'rules' => 'required|callback_restaurant_check',
          ),
          array(
           'field' => 'RestaurantAddress',
           'label' => 'Address',
           'rules' => 'required',
          ),
          array(
           'field' => 'RestaurantReservations',
           'label' => 'Reservations',
           'rules' => 'max_length[1]|integer',
          ),
          array(
           'field' => 'RestaurantWifi',
           'label' => 'RestaurantWifi',
           'rules' => 'max_length[1]|integer',
          ),
          array(
          'field' => 'RestaurantDelivery',
          'label' => 'Restaurant Delivery',
          'rules' => 'max_length[1]|integer',
           ),
          array(
          'field' => 'RestaurantMultibanco',
          'label' => 'RestaurantMultibanco',
          'rules' => 'max_length[1]|integer',
          ),
          array(
          'field' => 'RestaurantImage',
          'label' => 'RestaurantImage',
          'rules' => '',
          ),
          array(
           'field' => 'Latitude',
           'label' => 'LATITUDE',
           'rules' => 'max_length[15]|required',
          ),
          array(
          'field' => 'Longitude',
          'label' => 'LONGITUDE',
          'rules' => 'max_length[15]|required',
                ),
          );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == false) {
            $this->load->view('sample_navbar_view');
            $this->load->view('restaurant_add');

            return false;
        } else {
            $file_name = $this->do_upload();
        //			echo 'file_name';
                                //	echo $file_name;
  $data = array(
                 'RESTAURANT_NAME' => $this->input->post('RestaurantName'),
                 'RESTAURANT_ADDRESS' => $this->input->post('RestaurantAddress'),
                 'RESTAURANT_RESERVATIONS' => $this->input->post('RestaurantReservations'),
                 'RESTAURANT_WIFI' => $this->input->post('RestaurantWifi'),
                 'RESTAURANT_DELIVERY' => $this->input->post('RestaurantDelivery'),
                 'RESTAURANT_MULTIBANCO' => $this->input->post('RestaurantMultibanco'),
                 'RESTAURANT_OUTDOOR_SEATING' => $this->input->post('RestaurantOutdoorSeating'),
                 'RESTAURANT_LATITUDE' => $this->input->post('Latitude'),
                 'RESTAURANT_LONGITUDE' => $this->input->post('Longitude'),
                 'RESTAURANT_IMAGE' => $file_name,
                );

            $this->load->model('restaurant_model');
            $this->restaurant_model->restaurant_add($data);

            return true;
        }
    }
    public function restaurant_check($restaurantname)
    {
        $this->load->model('restaurant_model');
        $result = $this->restaurant_model->check_restaurant_name($restaurantname);

        if ($result > 0) {
            return false;
        } else {
            return true;
        }
    }
    public function do_upload()
    {
        $config['upload_path'] = './assets/images/restaurantes';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 20000;
        $config['max_width'] = 750;
        $config['max_height'] = 450;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('RestaurantImage')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('sample_navbar_view');
            $this->load->view('error_restaurant_edit', $error);
        } else {
            $data = array('upload_data' => $this->upload->data());
            $this->load->view('sample_navbar_view');

            $this->load->view('success_view', $data);
        }
        $file_name = $this->upload->file_name;

        return $file_name;
    }

    public function restaurant_edit()
    {
        $this->load->view('sample_navbar_view');
        $this->load->model('restaurant_model');
        $data['list'] = $this->restaurant_model->edit_restaurant();
        $this->load->view('restaurant_edit', $data);
    }

    public function restaurant_ajax()
    {
        $this->load->model('restaurant_model');
        $this->restaurant_model->restaurant_ajax();
    }

// RESTAURANT EDIT (AINDA NAO FUNCIONA)

public function restaurant_edit_data()
{
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $config = array(
    array(
     'field' => 'RestaurantName',
     'label' => 'RestaurantName',
     'rules' => 'required',
    ),
    array(
     'field' => 'RestaurantAddress',
     'label' => 'Address',
     'rules' => 'required',
    ),
    array(
     'field' => 'RestaurantReservations',
     'label' => 'Reservations',
     'rules' => 'max_length[1]|integer',
    ),
    array(
     'field' => 'RestaurantWifi',
     'label' => 'RestaurantWifi',
     'rules' => 'max_length[1]|integer',
    ),
    array(
            'field' => 'RestaurantDelivery',
            'label' => 'Restaurant Delivery',
            'rules' => 'max_length[1]|integer',
     ),
    array(
            'field' => 'RestaurantMultibanco',
            'label' => 'RestaurantMultibanco',
            'rules' => 'max_length[1]|integer',
    ),
    array(
            'field' => 'RestaurantOutdoorSeating',
            'label' => 'RestaurantOutdoorSeating',
            'rules' => 'max_length[1]|integer',
     ),
    );

    $this->form_validation->set_rules($config);

    if ($this->form_validation->run() == false) {
        $this->load->view('sample_navbar_view');
        $this->load->view('error_restaurant_edit');

        return false;
    } else {
        $id = $this->input->post('SelectResaurant');
        $data = array(
             'RESTAURANT_NAME' => $this->input->post('RestaurantName'),
             'RESTAURANT_ADDRESS' => $this->input->post('RestaurantAddress'),
             'RESTAURANT_RESERVATIONS' => $this->input->post('RestaurantReservations'),
             'RESTAURANT_WIFI' => $this->input->post('RestaurantWifi'),
             'RESTAURANT_DELIVERY' => $this->input->post('RestaurantDelivery'),
             'RESTAURANT_MULTIBANCO' => $this->input->post('RestaurantMultibanco'),
             'RESTAURANT_OUTDOOR_SEATING' => $this->input->post('RestaurantOutdoorSeating'),

              );
        $this->load->model('restaurant_model');
        $this->restaurant_model->restaurant_edit($data, $id);
//        $this->index();

        return true;
    }
}

    public function restaurant_delete()
    {
        $this->load->view('sample_navbar_view');
        $this->load->model('restaurant_model');
                //Get ID and Name to populate combobox
                $data['list'] = $this->restaurant_model->edit_restaurant();
        $this->load->view('restaurant_delete', $data);
    }

    public function restaurant_delete_data()
    {
        $id = $this->input->post('SelectRestaurant');
        $this->load->model('restaurant_model');
        $this->restaurant_model->restaurant_delete($id);
        $this->index();
    }

    public function restaurant_template()
    {
        $id = $this->input->get('id');
        $this->load->model('restaurant_model');
        $data['row'] = $this->restaurant_model->restaurant_template($id);
        $data['comment'] = $this->restaurant_model->comments_restaurant($id);
        $this->load->view('sample_navbar_view');
        $this->load->view('restaurant_template_view', $data);
    }
    public function sucess()
    {
        $this->load->view('sample_navbar_view');
        $this->load->view('error_restaurant_edit');
    }
}
