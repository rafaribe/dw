<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class menu_model extends CI_Model
{
  function teste()
    {
        $this->db->select('USER_NAME,USER_PASSWORD');
        $result = $this->db->get('USERS');
        return $result->result();
    }

    function  menu_id_name()
      {
          $result = $this->db->get('MENUS');
          $this->db->select('MENU_ID,MENU_NAME');
          return $result->result();
      }
    }
