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

     function restaurant_add($info)
    {
      $query =
    				"INSERT INTO RESTAURANTS
    				(RESTAURANT_NAME,RESTAURANT_ADDRESS,RESTAURANT_RESERVATIONS,
            RESTAURANT_WIFI,RESTAURANT_DELIVERY,RESTAURANT_MULTIBANCO,
            RESTAURANT_OUTDOOR_SEATING,RESTAURANT_IMAGE
            )
    				VALUES
    				(
            '".$info['RESTAURANT_NAME']."',
						'".$info['RESTAURANT_ADDRESS']."',
            '".$info['RESTAURANT_RESERVATIONS']."',
            '".$info['RESTAURANT_WIFI']."',
            '".$info['RESTAURANT_DELIVERY']."',
            '".$info['RESTAURANT_MULTIBANCO']."',
            '".$info['RESTAURANT_OUTDOOR_SEATING']."',
            '".$info['RESTAURANT_IMAGE']."'
    				)
    				";
            	$result =	$this->db->query($query);
              return TRUE;

    }

    function check_restaurant_name($restaurantname)    {
    	$this->db->trans_begin();
    	$query = "SELECT RESTAURANT_NAME FROM RESTAURANTS WHERE RESTAURANT_NAME = '".$restaurantname."'";

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
