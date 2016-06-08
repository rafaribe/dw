<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class rest_model extends CI_Model {



    function check_user()
    {

    }

    function users_list_all()
      {
          $this->db->select('USER_ID,USER_NAME,USER_PASSWORD,USER_CREATIONDATE,USER_EMAIL,USER_PHONE');
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
}
