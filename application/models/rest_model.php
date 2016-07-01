<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class rest_model extends CI_Model {



    function check_user()
    {

    }

    function users_list_all()
      {
        /*  $this->db->select('USER_ID,USER_NAME,USER_PASSWORD,USER_CREATIONDATE');
          $result = $this->db->get('USERS');
          return $result->result();*/
          $query = 'Select U.USER_ID, U.USER_NAME, U.USER_PASSWORD, U.USER_CREATIONDATE, U.USER_PHONE FROM USERS U';
          echo $query;
          $result =  $this->db->query();
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
      function  get_all_restaurants()
        {
            $this->db->select('RESTAURANT_ID,RESTAURANT_NAME,RESTAURANT_ADDRESS,
                              RESTAURANT_RESERVATIONS,RESTAURANT_WIFI,
                              RESTAURANT_DELIVERY,RESTAURANT_MULTIBANCO,
                              RESTAURANT_OUTDOOR_SEATING,RESTAURANT_POINTS, RESTAURANT_IMAGE');
            $result = $this->db->get('RESTAURANTS');
            return $result->result();
        }

        function get_menu_by_id($id)
        {
          $query= "Select D.DISH_NAME, P.PRICE_VALUE, D.DISH_TYPE
          FROM DISHES D JOIN DISHES_PRICES DP
          ON   D.DISH_ID = DP.DISH_ID JOIN PRICES P
          ON DP.PRICE_ID = P.PRICE_ID JOIN MENUS M
          ON P.MENU_ID = M.MENU_ID
         WHERE M.MENU_ID = '".$id."'
           ORDER BY D.DISH_NAME";
          $qr= $this->db->query($query);
          $result = $qr->result_array();
          return $result;
        }
}
