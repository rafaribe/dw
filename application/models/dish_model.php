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
      function dish_add($data)
     {

     			$result=$this->db->insert('DISHES',$data);

          return ;

     }
     function check_dish_name($dishname)    {
      $this->db->trans_begin();
      $query = "SELECT DISH_NAME FROM DISHES WHERE DISH_NAME = '".$dishname."'";

      $result = $this->db->query($query);
      $rows = $result->num_rows();
      if ($this->db->trans_status() === FALSE)
      {
          $this->db->trans_rollback();
      }
      else
      {
          $this->db->trans_commit();
      }
     return $rows;
     }

}
