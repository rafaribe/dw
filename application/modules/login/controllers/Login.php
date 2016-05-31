<?php

class Login extends REST_Controller{

  function __construct(){
  parent::__construct();
  }


function logging_in_get()
   {

     // the "TRUE" argument tells it to return the content, rather than display it immediately
     $data['menu'] = $this->load->view('common/views/sample_navbar_view', NULL, TRUE);
     $this->load->view ('login_view', $data);


   }
 }
