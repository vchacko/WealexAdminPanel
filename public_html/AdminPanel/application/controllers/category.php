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
require(APPPATH.'libraries/widgetcontroller.php');
class Category extends Widgetcontroller {
    public function __construct()
    {
        
        $this->sg = 'Category'; /* Singular */
        $this->pl = 'Categories';  /* Plural */
        /*
            title => Title of the field
            ss    => Search screen size
            ft    => Form Type array(Input Type,default value, size)
        */
       parent::__construct(array(
            'categoryname'   => array(
                                    'title' => 'Category Name',
                                    'ss'    => 10,
                                    'ft'    => array('text',' ','25'),
                                    ),

            'active'     => array(
                                    'title' => 'Active',
                                    'ss'    => array('radio',array('Yes'=>'Yes','No'=>'No')),
                                    'ft'    => array('radio',array('Yes'=>'Yes','No'=>'No'),'Yes'),
                                    ),
            ));
                            
        $this->Generic_model->initialise('ads_category');  /*Database Table Name*/
    }

}

/* End of file controllers/login.php */