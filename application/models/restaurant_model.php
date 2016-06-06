<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Restaurant_Model extends CI_Model
{
  function teste()
    {
        $this->db->select('USER_NAME,USER_PASSWORD');
        $result = $this->db->get('USERS');
        return $result->result();
    }

    function  restaurant_id_name_image()
      {
          $this->db->select('RESTAURANT_ID,RESTAURANT_NAME, RESTAURANT_IMAGE');
          $result = $this->db->get('RESTAURANTS');
          return $result->result();
      }
}
