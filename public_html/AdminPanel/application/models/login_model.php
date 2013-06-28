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

class Login_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    
    
    public function get_auth_data( $user_string,$pass_string )
    {
        // Selected user table data
        $selected_columns = array(
            'username',
            'password',
            'first_name',
            'last_name',
            'active'
        );

        // User table query
        $query = $this->db->select( $selected_columns )
                       ->from('administrators')
                       ->where( 'username', $user_string )
                       ->where( 'password', md5($pass_string) )
                       ->limit(1)
                       ->get();

        
        if ( $query->num_rows() == 1 )
        {
            $row = $query->row_array();
            return  $row;
        }
    
        return FALSE;
    }
    
    
}
/* End of login_model.php */