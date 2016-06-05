<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rest_Model extends CI_Model {
  function teste()
    {
        $this->db->select('USER_NAME,USER_PASSWORD');
        $result = $this->db->get('USERS');
        return $result->result();
    }

    function check_user()
    {

    }

    function users_list_all()
      {
          $this->db->trans_begin();

          $this->db->select('USER_ID,USER_NAME,USER_PASSWORD,USER_CREATIONDATE');
          $result = $this->db->get('USERS');
          if ($this->db->trans_status() === FALSE)
        	{
        			$this->db->trans_rollback();
        	}
        	else
        	{
        			$this->db->trans_commit();
        	}
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

      function check_username($username=null)
      {
        $this->db->select('USER_NAME');
        $this->db->from('USERS');
        $this->db->where('USER_NAME',$username);
        if($query -> num_rows() == 1)
          {
            return $data['Error'] = 'Este username já existe na base de dados';
          }
        else
          {
            return false;
          }

      }
}
