<?php

class Authentication extends MY_Controller{

  function __construct(){
  parent::__construct();
  $data['header'] = 'common/sample_navbar_view';  //the view you want to include
  $this->load->view('sample_navbar_view',$data);    //load your main view
  }


function logging_in_get()
   {
     // the "TRUE" argument tells it to return the content, rather than display it immediately
     $data['menu'] = $this->load->view('common/views/sample_navbar_view', NULL, TRUE);
     $this->load->view ('login_view', $data);
   }
function view_all_users_get()
  {

    $this->load->model('login_model');
    $data['list'] = $this->login_model->teste();
    $this->load->view('login_view', $data);

  }
 }
