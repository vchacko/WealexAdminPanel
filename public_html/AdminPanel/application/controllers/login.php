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
class Login extends CI_Controller {
    public function index()
    {
        $this->load->view('login');
    }
    
    public function user_auth()
    {
    
#        $this->load->view('login');
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'User Authentication';

        $this->form_validation->set_rules('user_id', 'User ID', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        

        if ($this->form_validation->run() === FALSE)
        {
            $newdata = array(
                                'username'   => '',
                                'first_name' => '',
                                'last_name'  => '',
                                'logged_in'  => FALSE
                            );
            $this->session->set_userdata($newdata);

             $this->output->set_header('Location: /admin/login/');
        }
        else
        {   
            $this->load->model('Login_model');
            $data = $this->Login_model->get_auth_data($this->input->post("user_id"),$this->input->post("password"));
            if($data['username'] == $this->input->post("user_id") && $data['password'] == md5($this->input->post("password"))){
                $newdata = array(
                                    'username'   => $data['username'],
                                    'first_name' => $data['first_name'],
                                    'last_name'  => $data['last_name'],
                                    'logged_in'  => TRUE
                                );

                $this->session->set_userdata($newdata);
                $this->output->set_header('Location: /admin/manage/');

            }
            else{
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

    }
}

/* End of file controllers/login.php */