<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

  function teste()
    {
        $this->db->select('USER_NAME,USER_PASSWORD');
        $result = $this->db->get('USERS');
        return $result->result();
    }

    function users_list_all()
      {
          $this->db->select('USER_ID,USER_NAME,USER_PASSWORD,USER_CREATIONDATE');
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

        function teste_varray($id=NULL)
          {
          $result =  $this->db->query('SELECT USER_PHONE FROM USERS');

              return $result->result();
          }
}
