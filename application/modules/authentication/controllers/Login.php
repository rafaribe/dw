<?php

class Login extends MY_Controller{

  function __construct(){
  parent::__construct();
  $data['header'] = 'common/sample_navbar_view';  //the view you want to include
  $this->load->view('sample_navbar_view',$data);    //load your main view
  }


function logging_in_get()
   {
     // the "TRUE" argument tells it to return the content, rather than display it immediately
     $data['menu'] = $this->load->view('common/sample_navbar_view.php', NULL, TRUE);
     $this->load->view ('login_popup.php');
   }


function view_all_users_get()
  {
    $this->load->model('login_model');
    $data['list'] = $this->login_model->teste();
    $this->load->view('list_users_view', $data);
  }

  public function users_get()
  {
      // Users from a data store e.g. database
      $this->load->model('Login_model');
      $users = $this->Login_model->users_list_all();
      $id = $this->get('id');

      // If the id parameter doesn't exist return all the users

      if ($id === NULL)
      {
          // Check if the users data store contains users (in case the database result returns NULL)
          if ($users)
          {
              // Set the response and exit
              $this->response($users, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
          }
          else
          {
              // Set the response and exit
              $this->response([
                  'status' => FALSE,
                  'message' => 'No users were found'
              ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
          }
      }

      // Find and return a single record for a particular user.

      $id = (int) $id;

      // Validate the id.
      if ($id <= 0)
      {
          // Invalid id, set the response and exit.
          $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
      }

      // Get the user from the array, using the id as key for retreival.
      // Usually a model is to be used for this.

      $user = NULL;

      if (!empty($users))
      {
          foreach ($users as $key => $value)
          {
              if (isset($value['id']) && $value['id'] === $id)
              {
                  $user = $value;
              }
          }
      }

      if (!empty($user))
      {
          $this->set_response($user, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
      }
      else
      {
          $this->set_response([
              'status' => FALSE,
              'message' => 'User could not be found'
          ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
      }
  }

 }
