<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mydb_model extends CI_Model {
    public function __construct(){
        parent::__construct();

        // load database
        $this->load->database();  
    }
    public function fetch($table='',$where=array(),$join=array(),$join_type='',$count=false,$select='*',$group_by=''){
        $this->db->select($select);
        $this->db->from($table);
        if($where){
            foreach($where as $key => $value){
                $this->db->where($key, $value);
            }
        }
        if($join){
            foreach($join as $key => $value){
                $this->db->join($key, $value, $join_type);
            }
        }
        if($group_by) {
            $this->db->group_by($group_by);
        }
        if($count){
            return $this->db->count_all_results();
        }
        $query = $this->db->get();
        return $query->result();
    }
    public function insert($table, $data){
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    public function update($table, $data, $where){
        $this->db->where($where);
        return $this->db->update($table, $data);
    }
    public function delete($table, $where){
        $this->db->where($where);
        return $this->db->delete($table);
    }
    public function get_datatable($table='',$limit,$start,$order,$dir,$where=[],$join=[],$join_type='',$select='*',$search='',$search_columns=[],$count=false,$group_by=''){
        $this->db->select($select);
        $this->db->from($table);
        if($where){
            foreach($where as $key => $value){
                $this->db->where($key, $value);
            }
        }
        if($join){
            foreach($join as $key => $value){
                $this->db->join($key, $value, $join_type);
            }
        }
        if($search){
            $this->db->group_start();
            $num = 0;
            foreach($search_columns as $search_column){
                if($num == 0){
                    $this->db->like($search_column, $search);
                } else {
                    $this->db->or_like($search_column, $search);
                }
                $num++;
            } 
            $this->db->group_end();
        }
        if($group_by) {
            $this->db->group_by($group_by);
        }
        $this->db->limit($limit,$start);
        $this->db->order_by($order,$dir);
        if($count){
            return $this->db->count_all_results();
        }
        $query = $this->db->get();
        return $query->result();
    }
    public function fetch_coord($rental_id){
        $this->db->select("lat,lng");
        $this->db->from("location");
        $this->db->where("rental_id", $rental_id);
        $this->db->order_by("date_time","ASC");

        $query = $this->db->get();
        return $query->result();
    }
}
