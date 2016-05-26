<?php
class teste extends MY_Controller
{
  function __construct()
  {
    parent::__construct();
  }
  function ola_get()
  {
    $this->load->view('ola');
  }
  function conta_get()
  {
    echo (1+1);

  }
}
