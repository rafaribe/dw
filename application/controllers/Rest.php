<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Rest extends REST_Controller
{
	function __construct()
    {
        // Construct our parent class
        parent::__construct();

    }

	// get all recipes if no parameter supplied
	public function index_get()
	{
		$this->load->model('rest_model');
		if(! $this->get('id'))
		{
			// get all record
			$users = $this->rest_model->users_list_all();
		} else {
			// get a record based on ID
			$users = null;
		}

		if($users)
		{
			$this->response($users, 200); // 200 being the HTTP response code
		} else {
			$this->response([], 404);
		}
	}

public function user_get()
	{
        $id = $this->uri->segment(3);

		$this->load->model('rest_model');

		if(isset($id))
		{
			// get a record based on ID
			$user = $this->rest_model->users_list($id);
		} else {
			$user = null;
		}

		if($user)
		{
			$this->response($user, 200); // 200 being the HTTP response code
		} else {
			$this->response([], 404);
		}
	}
	public function view_all_users_get()
	  {
	    $this->load->model('rest_model');
	    $data['list'] = $this->rest_model->teste();

	    $this->load->view('list_users_view', $data);
	  }

	  public function users_get()
	  {
	      // Users from a data store e.g. database
	      $this->load->model('rest_model');
	      $users = $this->rest_model->users_list_all();
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

	  function logging_in_post()
	  {

	    //inicializar as variáveis username e password
	    $username = $this->post('username');
	    $password = $this->post('password');

	    // criar o array para as variaveis de sessao
	    $array = array(
	      'username' => $username,
	      'password' => $password );
	    // imprime o array
	    print_r(array_values($array));
	    $data = $this->rest_model->check_username($username);
	    //inicializa as variaiveis de sessao
	    $this->session->set_userdata($array);

	    if ($username == null){
	          $data['erro'] = 'Coloque um Username válido';
	          echo ($data['erro']);
	         }
	    else if ($password == null){
	          $data['erro'] = 'Coloque uma password válida';
	          echo ($data['erro']);
	        }
	    else {

	    }

	  }

}
