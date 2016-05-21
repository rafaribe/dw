<?php
class Navbar extends REST_Controller{

  function __construct() {
      parent::__construct();
  }

  function sample_navbar_get($data = NULL){
    $this->load->view('sample_navbar_view');

  }
}
