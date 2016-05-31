<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Recipes extends REST_Controller
{
	function __construct()
    {
        // Construct our parent class
        parent::__construct();

    }

	// get all recipes if no parameter supplied
	public function index_get()
	{
		$this->load->model('recipe_model');
		if(! $this->get('id'))
		{
			// get all record
			$recipes = $this->recipe_model->get_all();
		} else {
			// get a record based on ID
			$recipes = null;
		}

		if($recipes)
		{
			$this->response($recipes, 200); // 200 being the HTTP response code
		} else {
			$this->response([], 404);
		}
	}

	public function recipe_get()
	{
        $id = $this->uri->segment(4);

		$this->load->model('recipe_model');

		if(isset($id))
		{
			// get a record based on ID
			$recipe = $this->recipe_model->get_recipe($id);
		} else {
			$recipe = null;
		}

		if($recipe)
		{
			$this->response($recipe, 200); // 200 being the HTTP response code
		} else {
			$this->response([], 404);
		}
	}

	public function recipe_post()
	{
		if(! $this->post('name'))
		{
			$this->response(array('error' => 'Missing post data: name'), 400);
		}
		else{
			$data = array(
				'name' => $this->post('name')
			);
		}
		$this->db->insert('recipe',$data);
		if($this->db->insert_id() > 0)
		{
			$message = array('id' => $this->db->insert_id(), 'name' => $this->post('name'));
			$this->response($message, 200); // 200 being the HTTP response code
		}
	}

	public function index_delete($id=NULL)
	{
		if($id == NULL)
		{
			$message = array('error' => 'Missing delete data: id');
			$this->response($message, 400);
		} else {
			$this->recipe_model->delete_recipe($id);
			$message = array('id' => $id, 'message' => 'DELETED!');
			$this->response($message, 200); // 200 being the HTTP response code
		}
	}

	public function recipe_put()
	{
		$data = array(
			'name'		=> $this->put('name'),
			'type'	=> $this->put('recipeType')
		);
		$this->recipe_model->update_recipe($this->put('id'), $data);
		$message = array('success' => $this->put('name').' Updated!');
		$this->response($message, 200);
	}

}
