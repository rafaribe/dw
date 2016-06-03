<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends MY_Controller
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

	public function insert_user()
	{
		if(! $this->post('user_name'))
		{
			$this->response(array('error' => 'Missing post data: user_name'), 400);
		}
		else if(! $this->post('user_password'))
		{
			$this->response(array('error' => 'Missing post data: user_password'), 400);
		}
		else {
			$data = array(
				'user_name' => $this->input->post('user_name'),
				'user_password' => $this->post('user_password'));
				$result = $this->login_model->user_insert($data);
				$this->response($message, 200); // 200 being the HTTP response code
	}
}


}
