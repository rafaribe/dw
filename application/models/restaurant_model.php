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
//function to populate select option in restaurant_edit;

  function  edit_restaurant(){
    $this->db->select('RESTAURANT_ID,RESTAURANT_NAME');
    $result = $this->db->get('RESTAURANTS');
    return $result->result();
  }
  function restaurant_ajax(){
    $this->db->select('RESTAURANT_NAME,RESTAURANT_ADDRESS,RESTAURANT_RESERVATIONS,
    RESTAURANT_WIFI,RESTAURANT_DELIVERY,RESTAURANT_MULTIBANCO,
    RESTAURANT_OUTDOOR_SEATING');
    $id = $this->input->post('restaurant_id');
    $this->db->where('RESTAURANT_ID',$id);
    $result = $this->db->get('RESTAURANTS');
    $array = array();
    $array= $result->result();
    echo json_encode($array);
  }
// function to perform update operation on restaurants.
  function restaurant_edit($data,$id){
    $this->db->where('RESTAURANT_ID',$id);
    $this->db->update('RESTAURANTS',$data);

  }

  function restaurant_delete($id){
    $this->db->where('RESTAURANT_ID',$id);
    $this->db->delete('RESTAURANTS');
  //  $result->this->db-
  }
  function restaurant_template($id)
  {
    $this->db->select(
   'RESTAURANT_ID,
    RESTAURANT_NAME,
    RESTAURANT_ADDRESS,
    RESTAURANT_RESERVATIONS,
    RESTAURANT_WIFI,
    RESTAURANT_DELIVERY,
    RESTAURANT_MULTIBANCO,
    RESTAURANT_OUTDOOR_SEATING,
    RESTAURANT_POINTS,
    RESTAURANT_IMAGE');
     $this->db->where('RESTAURANT_ID',$id);
     $this->db->from('RESETAURANTS');
     $this->db->join('COORDS','RESTAURANTS.RESTAURANT_ID = COORDS.RESTAURANT_ID');
    $result = $this->db->get('RESTAURANTS');
    return $result->result();
  }
}
