<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends REST_Controller
{
	function __construct()
    {
        // Construct our parent class
        parent::__construct();

    }

	// get all recipes if no parameter supplied
	public function index_get()
	{
		$this->load->model('login_model');
		if(! $this->get('id'))
		{
			// get all record
			$users = $this->login_model->users_list_all();
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

	public function teste_varray_get($id=NULL)
	{
		$this->load->model('login_model');
		if(! $this->get('id'))
		{
			// get all record
			$users = $this->login_model->teste_varray();
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
        $id = $this->uri->segment(4);

		$this->load->model('login_model');

		if(isset($id))
		{
			// get a record based on ID
			$user = $this->login_model->users_list($id);
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

}
