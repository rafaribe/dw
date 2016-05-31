<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login_model extends CI_Model {

  function teste()
    {
        $this->db->select('USER_NAME,USER_PASSWORD');
        $result = $this->db->get('USERS');
        return $result->result();
    }
}
