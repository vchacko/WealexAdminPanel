<?php
/*
Copy Right (c) 2013 wealex.com.
Developed by: vctheguru@gmail.com

This file is part of Wealex Admin Panel.

Wealex Admin Panel is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

Wealex Admin Panel is distributed in the hope that it will be useful but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details. You should have received a copy of the GNU General Public License along with Wealex Admin Panel.  If not, see  
<http://www.gnu.org/licenses/>.


I include code thats is part of this package other than default CodeIgniter files and folders. This was developed and tested with CodeIgniter 2.1.3 and any reproduction of their code must be according to their licence and the concept and code of this project must be under GNU GPL.
*/

class Generic_model extends CI_Model {

    protected $tablename = '';
    
    public function __construct()
    {
        $this->load->database();
    }
    public function initialise($table)
    {
        $this->tablename = $table;
    }
    
    public function get_active(){
        $query = $this->db->get_where($this->tablename, array('active ' => 'Yes'));
        $rs = $query->result_array();
        $query->free_result();
        return $rs;
    }
    
    public function get_list( $page, $count,$data )
    {
        // Pagination
        if($page > 0 ){
            $start = ($page-1)*$count;
        }
        else{
            $page = 0;
            $start = 0;
        }
        foreach ($data as $key => $value){
            if(!$data[$key]){
                unset($data[$key]);
            }
        }

#        var_dump($data);
        // User table query
        $this->db->or_like($data); 
        $query = $this->db->get($this->tablename,$count,$start);
#        echo $this->db->last_query(); 
        if ( $query->num_rows() > 0 )
        {
            $row = $query->result_array();
            $query->free_result();
            return  $row;
        }
    
        return FALSE;
    }
    
    public function get_count($data=NULL){
        foreach ($data as $key => $value){
            if(!$data[$key]){
                unset($data[$key]);
            }
        }
        if($data){
            $this->db->or_like($data);
            return $this->db->count_all_results($this->tablename);
        }
        else{
            return $this->db->count_all($this->tablename);
        }
    }
    
    public function get($id){
    
        $query = $this->db->get_where($this->tablename,array('id'=>$id),1,0);
#        echo $this->db->last_query();
        if ( $query->num_rows() > 0 )
        {
            $row = $query->row_array();
            return  $row;
        }
        return FALSE;
    }
    
    public function update($id, $data){
        $this->db->where('id', $id);
        
        
        $this->db->update($this->tablename, $data);
#        echo $this->db->last_query();
        return 1;
         
    }
    public function insert($data){
        return $this->db->insert($this->tablename, $data);
    }    
    public function delete($id, $data){
        $this->db->where('id', $id);
        return $this->db->delete($this->tablename);
    }
}
/* End of adminroles_model.php */