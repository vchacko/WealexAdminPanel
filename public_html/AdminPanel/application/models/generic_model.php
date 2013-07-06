<?php
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
    
    public function get_active($order=NULL){
	
		if($order){
			$this->db->order_by($order, "asc"); 
		}
	
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