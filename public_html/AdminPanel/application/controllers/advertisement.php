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
class Advertisement extends Widgetcontroller {
    public function __construct()
    {
        
        $this->sg = 'Business'; /* Singular */
        $this->pl = 'Businesses';  /* Plural */
        /*
            title => Title of the field
            ss    => Search screen size
            ft    => Form Type array(Input Type,default value, size)
            dbt   => Database table and field to display. assumes id is the primary key
            pr    => Resence required (NOT NULL)
            dir   => File Upload directory (Directory, Thumbnail Directrory)
            type  => File type (File type, allowed content type)
            
        */
       parent::__construct(array(
                             'client'       => array(
                                                     'title' => 'Client',
                                                     'dbt'   =>  array('registered_users','username'),
                                                     'ss'    =>  NULL,
                                                     'ft'    =>  NULL,
                                                     'pr'    =>  1,
                                                     ),
                            'title'         => array(
                                                    'title' => 'Title',
                                                    'ss'    => 10,
                                                    'ft'    => array('text',' ','25'),
                                                     'pr'    =>  1,
                                                    ),

                            'size'          => array(
                                                    'title' => 'Ad Size',
                                                    'ss'    => array('select',array('468x60'=>'468x60','160x600'=>'160x600','190x728'=>'190x728','728x90'=>'728x90','300x250'=>'300x250')),
                                                    'ft'    => array('select',array('468x60'=>'468x60','160x600'=>'160x600','190x728'=>'190x728','728x90'=>'728x90','300x250'=>'300x250'),'468x60'),
                                                    'pr'    =>  1,
                                                    ),
                            'categoryname'   => array(
                                                    'title' => 'Category',
                                                    'dbt'   =>  array('ads_category','categoryname'),
                                                    'ss'    =>  NULL,
                                                    'ft'    =>  NULL,
                                                    'pr'    =>  1,
                                                    ),
                            'totalimpressions' => array(
                                                    'title' => 'Tot Imp',
                                                    'ss'    => 10,
                                                    'ft'    =>array('text',' ','25'),
                                                    ),
                            'impressionleft'    => array(
                                                    'title' => 'Imp Left',
                                                    'ss'    => 8,
                                                    'ft'    =>  array('text',' ','15'),
                                                    ),

                            'image'       => array(
                                                    'title' => 'Image',
                                                    'ss'    => 10,
                                                    'ft'    => array('file',' ','25'),
                                                    'pr'    =>  0,
                                                    'dir'   => array('images'),
                                                    'type'  => array('image',"jpg|png|jpeg|gif"),
                                                    ),
                            'url'         => array(
                                                    'title' => 'URL',
                                                    'ss'    => 8,
                                                    'ft'    => array('text',' ','25'),
                                                     'pr'    =>  1,
                                                    ),
                            'target_country'   => array(
                                                    'title' => 'Country',
                                                    'ss'    => 0,
                                                    'ft'    => array('text',' ','25'),
                                                    'pr'    =>  NULL,
                                                    ),
                            'startdate'   => array(
                                                    'title' => 'Start',
                                                    'ss'    => 5,
                                                    'ft'    => array('text',' ','25'),
                                                    'pr'    =>  1,
                                                    ),
                            'enddate'       => array(
                                                    'title' => 'End',
                                                    'ss'    => 5,
                                                    'ft'    => array('text',' ','25'),
                                                    'pr'    =>  1,
                                                    ),
                            'active'     => array(
                                                    'title' => 'Active',
                                                    'ss'    => array('radio',array('Yes'=>'Yes','No'=>'No')),
                                                    'ft'    => array('radio',array('Yes'=>'Yes','No'=>'No'),'Yes'),
                                                    'pr'    =>  1,
                                                    ),
                            ));
                            
        $this->Generic_model->initialise('advertisements');  /*Database Table Name*/
    }

}

/* End of file controllers/login.php */