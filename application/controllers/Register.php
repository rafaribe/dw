<?php

class Register extends CI_Controller {
	function __construct()
		{
				// Construct our parent class
				parent::__construct();

		}
//Register a user
	public function index()
	{
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');
		//$username = $this->input->post('username');
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
											'rules'   => 'required|max_length[9]|integer'
											),
											array(
											'field'   => 'phone2',
											'label'   => 'Phone',
											'rules'   => 'required|max_length[9]|integer'
											),
											array(
											'field'   => 'phone3',
											'label'   => 'Phone',
											'rules'   => 'required|max_length[9]|integer'
											),
											array(
											'field'   => 'email',
											'label'   => 'Email',
											'rules'   => 'required|valid_email'
											),
											array(
											'field'   => 'email2',
											'label'   => 'Email',
											'rules'   => 'required|valid_email'
											),
											array(
											'field'   => 'email3',
											'label'   => 'Email',
											'rules'   => 'required|valid_email'
											)
									);

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('sample_navbar_view');
			$this->load->view('register_view');
			return;
		}
		else
		{
			$this->load->view('sample_navbar_view');
			$this->load->view('login_view');
			return;
		}
	}

	function check_database($username)
  {

		echo $username;
    //Field validation succeeded.  Validate against database
		$data = array(
			'USER_NAME' => $username,
			'USER_PASSWORD' => md5($this->input->post('password')),
			'USER_PHONE' => $this->input->	post('phone'),
			'USER_PHONE2' => $this->input->	post('phone2'),
			'USER_PHONE3' => $this->input->	post('phone3'),
			'USER_EMAIL' => $this->input->post('email'),
			'USER_EMAIL2' => $this->input->post('email2'),
			'USER_EMAIL3' => $this->input->post('email3')
		);

		$this->load->model('user');
		$result = $this->user->check_username($username);

		if($result > 0)
				{
			//if a user exists
					$this->form_validation->set_message('check_database', 'Username already exists');
		//	$erro = array('Error_Message' => 'O Utilizador Já existe na base de dados');
		//	echo $erro['Error_Message'];
					header("Location: base_url().Register");
					exit();
				}
		else
				{
					$this->user->register($data);
					$erro = 'Utilizador Registado com sucesso';
					header	("Location: Login");
					exit();
				}

  }

	// Register a RESTAURANT

	/*	function restaurant_add()
		{
			$this->load->helper(array('form', 'url'));

			$this->load->library('form_validation');

			$config = array(
		               array(
		                     'field'   => 'RESTAURANT_NAME',
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
				return;
			}
			else
			{
				$this->load->view('login_view');
				return;
			}
		}*/

}
?>
