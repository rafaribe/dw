<?php

class Register extends CI_Controller {

	function __construct()
		{
				// Construct our parent class
				parent::__construct();

		}

	public function index()
	{
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		$config = array(
	               array(
	                     'field'   => 'username',
	                     'label'   => 'Username',
	                     'rules'   => 'required|callback_check_database'
	                  ),
	               array(
	                     'field'   => 'password',
	                     'label'   => 'Password',
	                     'rules'   => 'required'
	                  ),
	               array(
	                     'field'   => 'phone',
	                     'label'   => 'Phone',
	                     'rules'   => 'required'
	                  ),
	               array(
	                     'field'   => 'email',
	                     'label'   => 'Email',
	                     'rules'   => 'required|valid_email'
	                  )
	            );

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('register_view');
		}
		else
		{
	//		$this->load->view('login_view');
		}
	}

	function check_database($username)
  {
    //Field validation succeeded.  Validate against database
		$data = array(
			'USER_NAME' => $username,
			'USER_PASSWORD' => md5($this->input->post('password')),
			'USER_PHONE' => $this->input->	post('phone'),
			'USER_EMAIL' => $this->input->post('email')
		);

		$this->load->model('user');
		$result = $this->user->check_username($username);

		if($result > 0)
		{
			$this->form_validation->set_message('check_database', 'User already exists');
			//if a user exists
		}
		else
		{
			$this->user->register($data);
		}





  }

}
?>
