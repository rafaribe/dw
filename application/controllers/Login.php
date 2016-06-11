<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->library('session');
  }

  function index()
  {
    $this->load->helper('form');
    $this->load->view('sample_navbar_view');
    $this->load->view('login_view');
  }

}

?>
