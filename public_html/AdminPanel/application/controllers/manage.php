<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
Copy Right (c) 2013 wealex.com.
Developed by: vctheguru@gmail.com

This file is part of Wealex Admin Panel.

Wealex Admin Panel is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

Wealex Admin Panel is distributed in the hope that it will be useful but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details. You should have received a copy of the GNU General Public License along with Wealex Admin Panel.  If not, see  
<http://www.gnu.org/licenses/>.


I include code thats is part of this package other than default CodeIgniter files and folders. This was developed and tested with CodeIgniter 2.1.3 and any reproduction of their code must be according to their licence and the concept and code of this project must be under GNU GPL.
*/
class Manage extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('logged_in') ){
            $newdata = array(
                'username'   => '',
                'first_name' => '',
                'last_name'  => '',
                'logged_in'  => FALSE
            );
            $this->session->set_userdata($newdata);
            $this->output->set_header('Location: /admin/login/');            
        }
    }
    
    public function index()
    {
        if( $this->session->userdata('logged_in') == FALSE ){
            $this->output->set_header('Location: /admin/logout/');
        }
        else{        
            $data['first_name'] = $this->session->userdata('first_name');
            $data['last_name'] = $this->session->userdata('last_name');
            $this->load->view('manage',$data);
        }
    }
    

}

/* End of file controllers/login.php */