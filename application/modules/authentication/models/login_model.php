<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

  function teste()
    {
        $this->db->select('USER_NAME,USER_PASSWORD,USER_PHONE');
        $result = $this->db->get('USERS');
        return $result->result();
    }

    function users_list_all()
      {
          $this->db->select('USER_ID,USER_NAME,USER_PASSWORD,USER_CREATIONDATE,USER_PHONE');
          $result = $this->db->get('USERS');
          return $result->result();
      }

      function users_list($id=NULL)
        {
            $this->db->select('USER_ID,USER_NAME,USER_PASSWORD,USER_CREATIONDATE' );
            $this->db->where('USER_ID',$id);
            $result = $this->db->get('USERS');

            return $result->result();
        }
      function user_insert($username,$password)
      {
        $data = array(
       'USER_NAME' => $this->$username,
       'USER_PASSWORD' => $this->$password );

        $this->db->insert('USERS',$data);

      }
}
