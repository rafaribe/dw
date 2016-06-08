<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dish_Model extends CI_Model
{
  function teste()
    {
        $this->db->select('USER_NAME,USER_PASSWORD');
        $result = $this->db->get('USERS');
        return $result->result();
    }
    function  dish_id_name_image()
      {
          $this->db->select('DISH_ID,DISH_NAME, DISH_IMAGE');
          $result = $this->db->get('DISHES');
          return $result->result();
      }

}
