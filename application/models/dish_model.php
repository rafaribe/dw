<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dish_Model extends CI_Model
{

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
     function dish_delete($id){
       $this->db->where('DISH_ID',$id);
       $this->db->delete('DISHES');
     //  $result->this->db-
     }
     function  edit_dish(){
       $this->db->select('DISH_ID,DISH_NAME');
       $result = $this->db->get('DISHES');
       return $result->result();
     }

     function dish_ajax(){
       $this->db->select('DISH_NAME,DISH_TYPE');
       $id = $this->input->post('dish_id');
       $this->db->where('DISH_ID',$id);
       $result = $this->db->get('DISHES');
       $array = array();
       $array= $result->result();
       echo json_encode($array);
     }
   // function to perform update operation on restaurants.
     function dish_edit($data,$id){
       $this->db->where('DISH_ID',$id);
       $this->db->update('DISHES',$data);

     }

     function dish_get_lastid()
     {
       $query = "select MAX(DISH_ID) from xml_view";
       $max = "MAX(DISH_ID)";
       $result =  $this->db->query($query);
       $row = $result->row()->$max;
       return $row;
     }

     function dish_add_xml($data)
     {
       $query = "DECLARE
  DISH_NAME VARCHAR2(200);
  DISH_TYPE VARCHAR2(200);
  DISH_IMAGE VARCHAR2(200);
BEGIN
  DISH_NAME := '".$data['DISH_NAME']."';
  DISH_TYPE := '".$data['DISH_TYPE']."';
  DISH_IMAGE :='".$data['DISH_IMAGE']."'';

  INSERT_XML_PROC(
    DISH_NAME => DISH_NAME,
    DISH_TYPE => DISH_TYPE,
    DISH_IMAGE => DISH_IMAGE
  );
--rollback;
END;
";

$conn = oci_connect('trabalho', '1234', '192.168.242.175:1521/orcl');
$query2 = " begin INSERT_XML_PROC('".$data['DISH_NAME']."','".$data['DISH_TYPE']."','".$data['DISH_IMAGE']."');END;";
$exec = OCIPARSE($conn,$query2);
OCIEXECUTE($exec);
echo $query2;
    //   echo $query;
//      $result =  $this->db->query($query);
//       $row = $result->row();
  //     return $row;
     }





}
