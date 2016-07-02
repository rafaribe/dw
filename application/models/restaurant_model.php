<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Restaurant_Model extends CI_Model
{
    public function teste()
    {
        $this->db->select('USER_NAME,USER_PASSWORD');
        $result = $this->db->get('USERS');

        return $result->result();
    }

    public function restaurant_id_name_image()
    {
        $this->db->select('RESTAURANT_ID,RESTAURANT_NAME, RESTAURANT_IMAGE');
        $result = $this->db->get('RESTAURANTS');

        return $result->result();
    }

    public function restaurant_add($info)
    {
        $query =
                    "INSERT INTO RESTAURANTS
    				(RESTAURANT_NAME,RESTAURANT_ADDRESS,RESTAURANT_OPEN_HOURS,RESTAURANT_RESERVATIONS,
            RESTAURANT_WIFI,RESTAURANT_DELIVERY,RESTAURANT_MULTIBANCO,
            RESTAURANT_OUTDOOR_SEATING,RESTAURANT_IMAGE,RESTAURANT_LATITUDE,RESTAURANT_LONGITUDE
            )
    				VALUES
    				(
            '".$info['RESTAURANT_NAME']."',
						'".$info['RESTAURANT_ADDRESS']."',
          	OPEN_HOURS_TYPE('".$info['RESTAURANT_OPEN_HOURS']."','".$info['RESTAURANT_OPEN_HOURS2']."','".$info['RESTAURANT_OPEN_HOURS3']."',
            '".$info['RESTAURANT_OPEN_HOURS4']."','".$info['RESTAURANT_OPEN_HOURS5']."','".$info['RESTAURANT_OPEN_HOURS6']."'),
            '".$info['RESTAURANT_RESERVATIONS']."',
            '".$info['RESTAURANT_WIFI']."',
            '".$info['RESTAURANT_DELIVERY']."',
            '".$info['RESTAURANT_MULTIBANCO']."',
            '".$info['RESTAURANT_OUTDOOR_SEATING']."',
            '".$info['RESTAURANT_IMAGE']."',
            '".$info['RESTAURANT_LATITUDE']."',
            '".$info['RESTAURANT_LONGITUDE']."'
    				)
    				";

        $result = $this->db->query($query);



        return true;
    }

    public function check_restaurant_name($restaurantname)
    {
        $this->db->trans_begin();
        $query = "SELECT RESTAURANT_NAME FROM RESTAURANTS WHERE RESTAURANT_NAME = '".$restaurantname."'";

        $result = $this->db->query($query);
        $rows = $result->num_rows();
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }

        return $rows;
    }
//function to populate select option in restaurant_edit;

  public function edit_restaurant()
  {
      $this->db->select('RESTAURANT_ID,RESTAURANT_NAME');
      $result = $this->db->get('RESTAURANTS');

      return $result->result();
  }
    public function restaurant_ajax()
    {
        $this->db->select('RESTAURANT_NAME,RESTAURANT_ADDRESS,RESTAURANT_RESERVATIONS,
    RESTAURANT_WIFI,RESTAURANT_DELIVERY,RESTAURANT_MULTIBANCO,
    RESTAURANT_OUTDOOR_SEATING,RESTAURANT_LATITUDE,RESTAURANT_LONGITUDE');
        $id = $this->input->post('restaurant_id');
        $this->db->where('RESTAURANT_ID', $id);
        $result = $this->db->get('RESTAURANTS');
        $array = array();
        $array = $result->result();
        echo json_encode($array);
    }
// function to perform update operation on restaurants.
  public function restaurant_edit($info, $id)
  {
    $query = "UPDATE RESTAURANTS SET
    RESTAURANT_NAME =   '".$info['RESTAURANT_NAME']."',
    RESTAURANT_ADDRESS = '".$info['RESTAURANT_ADDRESS']."',
    RESTAURANT_OPEN_HOURS = 	OPEN_HOURS_TYPE('".$info['RESTAURANT_OPEN_HOURS']."','".$info['RESTAURANT_OPEN_HOURS2']."','".$info['RESTAURANT_OPEN_HOURS3']."',
      '".$info['RESTAURANT_OPEN_HOURS4']."','".$info['RESTAURANT_OPEN_HOURS5']."','".$info['RESTAURANT_OPEN_HOURS6']."'),
    RESTAURANT_RESERVATIONS ='".$info['RESTAURANT_RESERVATIONS']."',
    RESTAURANT_WIFI ='".$info['RESTAURANT_WIFI']."',
    RESTAURANT_DELIVERY ='".$info['RESTAURANT_DELIVERY']."',
    RESTAURANT_MULTIBANCO = '".$info['RESTAURANT_MULTIBANCO']."',
    RESTAURANT_OUTDOOR_SEATING ='".$info['RESTAURANT_OUTDOOR_SEATING']."',
    RESTAURANT_LATITUDE ='".$info['RESTAURANT_LATITUDE']."',
    RESTAURANT_LONGITUDE =  '".$info['RESTAURANT_LONGITUDE']."'
    WHERE RESTAURANT_ID = '".$id."'
        ";

    $result = $this->db->query($query);
    return true;
  }

    public function restaurant_delete($id)
    {
     //   echo $id;
        $this->db->where('RESTAURANT_ID', $id);
        $this->db->delete('RESTAURANTS');
  //  $result->this->db-
    }
    public function restaurant_template($id)
    {
        $query = "SELECT r.RESTAURANT_ID,
     r.RESTAURANT_NAME,
     r.RESTAURANT_ADDRESS,
     r.RESTAURANT_RESERVATIONS,
     r.RESTAURANT_WIFI,
     r.RESTAURANT_DELIVERY,
     r.RESTAURANT_MULTIBANCO,
     r.RESTAURANT_OUTDOOR_SEATING,
     r.RESTAURANT_POINTS,
     r.RESTAURANT_IMAGE,
     r.RESTAURANT_LATITUDE,
     r.RESTAURANT_LONGITUDE
     FROM RESTAURANTS r
     WHERE r.RESTAURANT_ID = '".$id."'";

        $result = $this->db->query($query);
        $rows = $result->row();

        return $rows;
    }

    public function comments_restaurant($id)
    {
        $query = "SELECT CR.COMMENT_ID, CR.USER_ID, CR.COMMENT_TEXT, USER_NAME
        FROM COMMENTS_RESTAURANT CR JOIN USERS U
        ON CR.USER_ID = U.USER_ID WHERE CR.RESTAURANT_ID = '".$id."'";

        $result = $this->db->query($query);
        $comment = $result->result();

        return $comment;
    }

    function restaurant_get_openhours($id)
    {
    $query ="   SELECT t1.RESTAURANT_ID, t2.column_value AS RESTAURANT_OPEN_HOURS
FROM RESTAURANTS t1, TABLE(t1.RESTAURANT_OPEN_HOURS) t2
where RESTAURANT_ID = '".$id."'
";
$result = $this->db->query($query);
$openhours = $result->result();

return $openhours;
    }

    public function comment_add($info)
    {
        $query =
                    "INSERT INTO COMMENTS_RESTAURANT
            VALUES
            (comments_restaurant_seq.nextval,
            '".$info['USER_ID']."',
               sysdate,
            '".$info['COMMENT_TEXT']."',
            '".$info['RESTAURANT_ID']."',
            '".$info['RESTAURANT_RATING']."'
            )
            ";
//echo($query);
        $result = $this->db->query($query);

        return true;
    }

}
