<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Dish_Model extends CI_Model
{
    public function dish_id_name_image()
    {
        $this->db->select('DISH_ID,DISH_NAME, DISH_IMAGE');
        $result = $this->db->get('DISHES_XML_VIEW');

        return $result->result();
    }

      // Esta funcao não esta a ser usada no trabalho
      public function dish_add($data)
      {
          $result = $this->db->insert('DISHES', $data);

          return;
      }
    public function check_dish_name($dishname)
    {
        $this->db->trans_begin();
        $query = "SELECT DISH_NAME FROM DISHES_XML_VIEW WHERE DISH_NAME = '".$dishname."'";

        $result = $this->db->query($query);
        $rows = $result->num_rows();
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }

        return $rows;
    }
    public function dish_delete($id)
    {
        $query = "delete from dishes_xml where XMLCast(XMLQuery('\$p/xml/item/DISH_ID' PASSING OBJECT_VALUE AS \"p\" RETURNING CONTENT)AS INTEGER) = '".$id."'";
        echo $query;
       $result = $this->db->query($query);

        return true;
    }
    public function edit_dish()
    {
        $this->db->select('DISH_ID,DISH_NAME');
        $result = $this->db->get('DISHES_XML_VIEW');

        return $result->result();
    }

    public function dish_ajax()
    {
        $id = $this->input->post('dish_id');
        $this->db->select('DISH_NAME,DISH_TYPE');
        $this->db->where('DISH_ID', $id);
        $result = $this->db->get('DISHES_XML_VIEW');
        $array = array();
        $array = $result->result();
        echo json_encode($array);
    }
   // function to perform update operation on restaurants.
     public function dish_edit($data, $id)
     {
         $p = 'p';
         $query = "UPDATE DISHES_XML SET OBJECT_VALUE =
     updateXML(OBJECT_VALUE, '/xml/item/DISH_NAME/text()',
     '".$data['DISH_NAME']."')
     WHERE
      XMLCast(XMLQuery('\$p/xml/item/DISH_ID' PASSING OBJECT_VALUE
     AS \"p\" RETURNING CONTENT)AS INTEGER)
     = '".$id."'
     ";
         echo $query;
         $result = $this->db->query($query);

         return true;
     }

    public function dish_get_lastid()
    {
        $query = 'select MAX(DISH_ID) from xml_view';
        $max = 'MAX(DISH_ID)';
        $result = $this->db->query($query);
        $row = $result->row()->$max;

        return $row;
    }

    public function dish_add_xml($data)
    {
        $conn = oci_connect('trabalho', '1234', '192.168.1.166:1521/orcl');
        $query = " begin INSERT_XML_PROC('".$data['DISH_NAME']."','".$data['DISH_TYPE']."','".$data['DISH_IMAGE']."');END;";
        $exec = OCIPARSE($conn, $query);
        OCIEXECUTE($exec);
    }

    public function dish_add_xml_direct($xml)
    {
        $query = "INSERT INTO DISHES_XML VALUES ( XMLTYPE ('".$xml."'))";
//  echo "<textarea>";echo $query; echo "</textarea>";
  $result = $this->db->query($query);

        return true;
    }

    /*
    public function dish_delete_xml($id)
    {
        $query = "delete from dishes_xml where XMLCast(XMLQuery('\$p/xml/item/DISH_ID' PASSING OBJECT_VALUE AS \"p\" RETURNING CONTENT)AS INTEGER) = '".$id."'";
        $result = $this->db->query($query);

        return true;
    }*/
}
