<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
Copy Right (c) 2013 wealex.com.
Developed by: vctheguru@gmail.com

This file is part of Wealex Admin Panel.

CORE OF THIS PROJECT

Wealex Admin Panel is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

Wealex Admin Panel is distributed in the hope that it will be useful but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details. You should have received a copy of the GNU General Public License along with Wealex Admin Panel.  If not, see  
<http://www.gnu.org/licenses/>.


I include code thats is part of this package other than default CodeIgniter files and folders. This was developed and tested with CodeIgniter 2.1.3 and any reproduction of their code must be according to their licence and the concept and code of this project must be under GNU GPL.


*/
class Widgetcontroller extends CI_Controller{

    public function __construct($fn)
    {
        parent::__construct();

        $this->load->model('Generic_model');
        foreach($fn as $key => $value){
            if(isset($value['dbt'])&&is_array($value['dbt'])){
                $this->Generic_model->initialise($value['dbt'][0]);
                $rs = $this->Generic_model->get_active();
                foreach($rs as $row){
                    $cats[$row['id']] = $row[$value['dbt'][1]];
                }
                $fn[$key]['ss'] = array('select',$cats);
                $fn[$key]['ft'] = array('select',$cats);
                unset($rs);
                unset($cats);
            }
        }
        $this->back = $this->agent->referrer();
        if( preg_match("/\/admin\/manage\//",$this->back)){
            $this->back = "/admin/welcome";
        }
        $this->field_names = $fn;
        
    }

    public function index(){
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
        else{
            $this->listall(1);
        }
    }
    
    public function listall($page){
        
        
        if($page < 1){
            $page = 1;
        }
        
        $count = 20;
        foreach($this->field_names as $key => $value ){
            $data['field_names'][$key] = $value;
            $data['search_fields'][$key] = ($this->input->post("k_".$key)?$this->input->post("k_".$key):NULL);
        }
        $totalcount = $this->Generic_model->get_count($data['search_fields']);
        $data['page_count'] = intval(ceil($totalcount/$count));
        
        if($data['page_count'] < $page ){
            $page = $data['page_count'];
        }

        $start = (($page -1)*21)+1;
        
        $data['record_list'] = $this->Generic_model->get_list($page,$count,$data['search_fields']);

        $rc = count($data['record_list']);
        
        $totalcount = $this->Generic_model->get_count($data['search_fields']);
      
        $data['title']      = 'Manage '.$this->pl;
        $data['page_count'] = intval(ceil($totalcount/$count));
        $data['page']       = $page;
        $data['start']      = $start;
        $data['end']        = $start+$rc-1;
        $data['tc']         = $totalcount;
        $data['context']    = 'manage';
        $data['sg']         = $this->sg;
        $data['defcolspan'] = count($this->field_names);
        $this->load->view('generic_view',$data);
    }
    
    public function edit($id){
        $data['field_names'] = $this->field_names;
        $data['record']     = $this->Generic_model->get($id);
        $data['button']      = 'Save';
        $data['action']      = 'update';
        $data['title']       = 'Edit '.$this->sg;
        $data['error_message']   = ' ';
        $data['back']        = $this->back;
        $data['context']     = 'form';
        $data['sg']         = $this->sg;

        $this->load->view('generic_view',$data);
    }
    
    public function add(){
        $data['field_names'] = $this->field_names;
        foreach($this->field_names as $key => $value ){
            $data['record'][$key] = NULL;
        }
        $data['button']     = 'Save';
        $data['action']     = 'insert';
        $data['title']      = 'Add '.$this->sg;
        $data['error_message']  = ' ';
        $data['back']       = $this->back;
        $data['context']    = 'form';
        $data['sg']         = $this->sg;

        $this->load->view('generic_view',$data);
    }






    public function update(){
        $data['field_names'] = $this->field_names;
        $ddata['field_names'] = $this->field_names;
        $id  = $this->input->post("id");
		

        foreach($this->field_names as $key => $value ){
			if(isset($this->field_names[$key]['dir'][0])){$config['upload_path'] = $this->field_names[$key]['dir'][0];}else{$config['upload_path'] = './uploads/';}
			if(isset($this->field_names[$key]['type'][1])){$config['allowed_types'] = $this->field_names[$key]['type'][1];}
			$this->load->library('upload', $config);            
			if($this->input->post($key) && is_array($this->field_names[$key]['ft']) ){
                if((isset($this->field_names[$key]['dbf']))&&$this->field_names[$key]['dbf']=='MD5'){
                    $rq = $this->Generic_model->get($id);
                    $enc = $this->input->post($key);
                    if(isset($enc)&&preg_match("/\S/",$enc)&& $rq[$key] != md5($enc)){
                        $data['record'][$key] = md5($this->input->post($key));
                    }
                    else{
                        unset($data['record'][$key]);
                    }
                }

                else{
                    $data['record'][$key] = $this->input->post($key);
                }
                if(is_array( $this->field_names[$key]['ft'][1] ) && isset($this->field_names[$key]['ft'][1][$data['record'][$key]])){
                    $ddata['record'][$key] = $this->field_names[$key]['ft'][1][$data['record'][$key]];
                }
                else{
                    if(isset($data['record'][$key])){$ddata['record'][$key] = $data['record'][$key];}
                }
                
            }
            elseif(isset($this->field_names[$key]['ft'][0]) && $this->field_names[$key]['ft'][0] == 'file' && $this->upload->do_upload($key)){
                 
                if ( ! $this->upload->do_upload($key))
                {
                    if(isset($data['error_message'])){
                        $ddata['error_message'] .= $this->upload->display_errors().'<br>';
                    }
                    else{
                        $ddata['error_message'] = $this->upload->display_errors().'<br>';
                    }
                }
                else{
                    $ud = $this->upload->data();
                    $fname = md5($ud['file_name'].rand(99999,999999)).$ud['file_ext'];
                    rename($ud['full_path'], $ud['file_path'].$fname);
                    
                    
                    if(isset($this->field_names[$key]['type'][0]) && $this->field_names[$key]['type'][0] == 'image'){
                        
                        if( is_dir($this->field_names[$key]['dir'][0]."/tn/") ){
                            $this->do_resize_image($ud['file_path'].$fname, '100', '100', true,$ud['file_path'].'tn/'.$fname);
                            $ddata['record'][$key] = '<img src="'.$this->config->{'config'}['base_url'].$this->field_names[$key]['dir'][0].'/tn/'.$fname.'">';
                        }
                        else{
                            $ddata['record'][$key] = '<img src="'.$this->config->{'config'}['base_url'].preg_replace("/^\.+/","",$config['upload_path']).'/'.$fname.'">';
                        
                        }
                    }
                    else{
                        $ddata['record'][$key] = $fname;
                    }

                    $data['record'][$key] = $fname;
                }
            }			
            elseif((isset($this->field_names[$key]['dbf'])) && $this->field_names[$key]['dbf']=='REMOTE_IP'){
                $data['record'][$key] =$this->input->ip_address();
                $ddata['record'][$key] = $data['record'][$key];

            }
            else{
                unset($data['record'][$key]);
                $ddata['record'][$key] = NULL;

            }
        }
        $result = $this->Generic_model->update($id, $data['record']);
        if($result){
            $ddata['title']     = 'Successfully edited '.$this->sg;
            $ddata['back']      = $this->input->post("back");
            $ddata['delete']    = NULL;
            $ddata['context']   = 'view';
            $this->load->view('generic_view',$ddata);
        }
        else{
            echo 'Error';
            
        }
    }
    
    
    
    
    
    
    
    
    public function insert(){
        $data['field_names'] = $this->field_names;
        $ddata['field_names'] = $this->field_names;

        foreach($this->field_names as $key => $value ){
            if($this->input->post($key)){
                if((isset($this->field_names[$key]['dbf']))&&$this->field_names[$key]['dbf']=='MD5'){
                    $data['record'][$key] = md5($this->input->post($key));
                }
                elseif(isset($this->field_names[$key]['dbf'])&&$this->field_names[$key]['dbf']=='REMOTE_IP'){
                    $data['record'][$key] = $this->input->ip_address();                    
                }
                else{
                    $data['record'][$key] = $this->input->post($key);
                }
                
                if(is_array( $this->field_names[$key]['ft'][1] ) && isset($this->field_names[$key]['ft'][1][$data['record'][$key]])){
                    $ddata['record'][$key] = $this->field_names[$key]['ft'][1][$data['record'][$key]];
                }
                else{
                    $ddata['record'][$key] = $data['record'][$key];
                }

            }
            elseif(isset($this->field_names[$key]['ft'][0]) && $this->field_names[$key]['ft'][0] == 'file' ){
                    
                if(isset($this->field_names[$key]['dir'][0])){$config['upload_path'] = $this->field_names[$key]['dir'][0];}else{$config['upload_path'] = './uploads/';}
                if(isset($this->field_names[$key]['type'][1])){$config['allowed_types'] = $this->field_names[$key]['type'][1];}
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload($key))
                {
                    if(isset($data['error_message'])){
                        $ddata['error_message'] .= $this->upload->display_errors().'<br>';
                    }
                    else{
                        $ddata['error_message'] = $this->upload->display_errors().'<br>';
                    }
                }
                else{
                    $ud = $this->upload->data();
                    $fname = md5($ud['file_name'].rand(99999,999999)).$ud['file_ext'];
                    rename($ud['full_path'], $ud['file_path'].$fname);
                    
                    
                    if(isset($this->field_names[$key]['type'][0]) && $this->field_names[$key]['type'][0] == 'image'){
                        
                        if( is_dir($this->field_names[$key]['dir'][0]."/tn/") ){
                            $this->do_resize_image($ud['file_path'].$fname, '100', '100', true,$ud['file_path'].'tn/'.$fname);
                            $ddata['record'][$key] = '<img src="'.$this->config->{'config'}['base_url'].$this->field_names[$key]['dir'][0].'/tn/'.$fname.'">';
                        }
                        else{
                            $ddata['record'][$key] = '<img src="'.$this->config->{'config'}['base_url'].preg_replace("/^\.+/","",$config['upload_path']).'/'.$fname.'">';
                        
                        }
                    }
                    else{
                        $ddata['record'][$key] = $fname;
                    }

                    $data['record'][$key] = $fname;
                }
            }
            elseif(isset($this->field_names[$key]['dbf'])&&$this->field_names[$key]['dbf']=='REMOTE_IP'){
                $data['record'][$key] = $_SERVER['REMOTE_ADDR'];
                $ddata['record'][$key] = $data['record'][$key];

            }
            elseif(isset($this->field_names[$key]['pr'])){
                if(isset($ddata['error_message'])){
                    $ddata['error_message'] .= $this->field_names[$key]['title'].' is mandatory!<br>';
                }
                else{
                    $ddata['error_message'] = $this->field_names[$key]['title'].' is mandatory!<br>';
                }

            }
            else{
                unset($data['record'][$key]);
                $ddata['record'][$key] = NULL;
            }
        }
        
        if(isset($ddata['error_message'])){
        var_dump("ERROR MESSAGE");
            $ddata['sg']         = $this->sg;
            $ddata['button']     = 'Save';
            $ddata['action']     = 'insert';
            $ddata['title']      = 'Add '.$this->sg;
            $ddata['error_message']  = ' ';
            $ddata['back']       = $this->back;
            $ddata['sg']         = $this->sg;
            $dddata['context']   = 'form';
            $this->load->view('generic_view',$ddata);
        }
        else{
            $result = $this->Generic_model->insert($data['record']);
            if($result){
                $ddata['title']  = 'Successfully added '.$this->sg;
                $ddata['back']   = $this->input->post("back");
                $ddata['delete']     = NULL;
                $ddata['context']    = 'view';
                $this->load->view('generic_view',$ddata);

            }
            else{
        var_dump("DB Error");
                echo 'Error';
            }
      }

    }    
    
    
    
    
    
    
    
    
    
    
    
    public function view($id){
        $data['field_names'] = $this->field_names;
        $data['record'] = $this->Generic_model->get($id);
        foreach($this->field_names as $key => $value ){
            if(is_array( $this->field_names[$key]['ft'][1] ) && isset($this->field_names[$key]['ft'][1][$data['record'][$key]]) ){
                $data['record'][$key] = $this->field_names[$key]['ft'][1][$data['record'][$key]];
            }
            elseif(isset($data['record'][$key]) && isset($this->field_names[$key]['type'][0]) && $this->field_names[$key]['type'][0] == 'image'){
                if( is_dir($this->field_names[$key]['dir'][0]."/tn/") && is_file($this->field_names[$key]['dir'][0].'/tn/'.$data['record'][$key]) ){
                    $data['record'][$key] = '<img src="'.$this->config->{'config'}['base_url'].$this->field_names[$key]['dir'][0].'/tn/'.$data['record'][$key].'">';
                }
                elseif(is_file($this->field_names[$key]['dir'][0].'/'.$data['record'][$key])){
                    $data['record'][$key] = '<img src="'.$this->config->{'config'}['base_url'].$this->field_names[$key]['dir'][0].'/'.$data['record'][$key].'">';

                }
            }
        }
        
        $data['title']      = 'View '.$this->sg;
        $data['error_message']  = NULL;
        $data['back']       = $this->back;
        $data['delete']     = NULL;
        $data['context']    = 'view';
        $this->load->view('generic_view',$data);
    }
    
    public function delete($id){
        $data['field_names'] = $this->field_names;
        $data['record'] = $this->Generic_model->get($id);
        $data['title']      = 'Are you sure to delete '.$this->sg.' ?';
        $data['error_message']  = NULL;
        $data['id']         = $id;
        $data['delete']     = $id;
        $data['back']       = $this->back;
        $data['context']    = 'view';

        $this->load->view('generic_view',$data);
    }
    public function delconfirm($id){
    
        $data['field_names'] = $this->field_names;
        $data['record'] = $this->Generic_model->get($id);
        $data['error_message']  = NULL;
        $data['id']         = $id;
        $data['back']       = $this->input->post("back");
        $data['delete']     = NULL;

        $result = $this->Generic_model->delete($id, $data);
        if($result){
            $data['title']  = 'Successfully deleted '.$this->sg;
        }
        else{
            $data['title']  = 'Unable to delete deleted '.$this->sg;
        }

        $data['context']    = 'view';

        $this->load->view('generic_view',$data);
    }

    public function is_logged_in()
    {
        $user = $this->session->userdata('user_data');
        return isset($user);
    }


    private function do_resize_image($file, $width = 0, $height = 0, $proportional = false, $output = 'file')
    {
        if($height <= 0 && $width <= 0)
        {
          return false;
        }

        $info = getimagesize($file);
        $image = '';

        $final_width = 0;
        $final_height = 0;
        list($width_old, $height_old) = $info;

        if($proportional) 
        {
          if ($width == 0) $factor = $height/$height_old;
          elseif ($height == 0) $factor = $width/$width_old;
          else $factor = min ( $width / $width_old, $height / $height_old);   

          $final_width = round ($width_old * $factor);
          $final_height = round ($height_old * $factor);

          if($final_width > $width_old && $final_height > $height_old)
          {
              $final_width = $width_old;
              $final_height = $height_old;

          }
        }
        else 
        {
          $final_width = ( $width <= 0 ) ? $width_old : $width;
          $final_height = ( $height <= 0 ) ? $height_old : $height;
        }

        switch($info[2]) 
        {
          case IMAGETYPE_GIF:
            $image = imagecreatefromgif($file);
          break;
          case IMAGETYPE_JPEG:
            $image = imagecreatefromjpeg($file);
          break;
          case IMAGETYPE_PNG:
            $image = imagecreatefrompng($file);
          break;
          default:
            return false;
        }

        $image_resized = imagecreatetruecolor( $final_width, $final_height );

        if(($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG))
        {
          $trnprt_indx = imagecolortransparent($image);

          if($trnprt_indx >= 0)
          {
            $trnprt_color    = imagecolorsforindex($image, $trnprt_indx);
            $trnprt_indx    = imagecolorallocate($image_resized, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
            imagefill($image_resized, 0, 0, $trnprt_indx);
            imagecolortransparent($image_resized, $trnprt_indx);    
          } 
          elseif($info[2] == IMAGETYPE_PNG) 
          {
            imagealphablending($image_resized, false);
            $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
            imagefill($image_resized, 0, 0, $color);
            imagesavealpha($image_resized, true);
          }
        }
        imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $final_width, $final_height, $width_old, $height_old);

        switch( strtolower($output))
        {
          case 'browser':
            $mime = image_type_to_mime_type($info[2]);
            header("Content-type: $mime");
            $output = NULL;
          break;
          case 'file':
            $output = $file;
          break;
          case 'return':
            return $image_resized;
          break;
          default:
          break;
        }

        if(file_exists($output))
        {
            @unlink($output);
        }

        switch($info[2])
        {
          case IMAGETYPE_GIF:
            imagegif($image_resized, $output);
          break;
          case IMAGETYPE_JPEG:
            imagejpeg($image_resized, $output, 100);
          break;
          case IMAGETYPE_PNG:
            imagepng($image_resized, $output);
          break;
          default:
            return false;
        }
        return true;
    }






}








/* End of file Someclass.php */