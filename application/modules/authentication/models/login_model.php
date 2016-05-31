<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

  function teste()
    {
        $this->db->select('USER_NAME,USER_PASSWORD');
        $result = $this->db->get('USERS');
        return $result->result();
    }

    function users_list()
      {
          $this->db->select('USER_NAME,USER_PASSWORD');
          $result = $this->db->get('USERS');
          return $result->result();
      }
}
