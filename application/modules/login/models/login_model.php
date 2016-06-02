<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_Model extends CI_Model{
    public function user_read(){
        if($id===NULL){
           $replace = "" ;
        }
        else{
            $replace = "=$id";
        }
        $query = $this->db->query("select * from books where id".$replace);
        return $query->result_array();
    }
    public function insert($data){
        $this->db->insert('books', $data);
        return TRUE;
    }
    public function delete($id){
        $query = $this->db->query("delete from books where id=$id");
        return TRUE;
        }
    public function update($data){
       $id= $data['id'];
       $this->db->where('id',$id);
       $this->db->update('books',$data);
    }
}
