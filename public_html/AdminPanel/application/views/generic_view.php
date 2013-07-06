<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="/css/style_inner.css" type="text/css" media="all" />
<script type="text/javascript" src="/js/jquery-1.9.1.min.js"></script>
<script type='text/javascript' src="/js/jquery.sortElements.js"></script>
<script type="text/javascript" src="/js/jqsorttable.js"></script>
<?if( isset($context) && $context!= 'manage'){?>
<script src="/js/livevalidation_standalone.compressed.js" type="text/javascript"></script>
<style>
.fleft {text-align:right;height:25px;}
.fright {padding-left:15px;text-align:left;height:25px;}
.formtable {cell-spacing:5px;}
</style>
<?}?>
</head>
<body>
<? $cn =$this->uri->rsegment(1)?>
<?if( isset($context) && $context == 'manage'){?>
    <div class="box" id='boxdiv'>
        <div class="box-head" style='width:100%;' id='headdiv'><h2><?=$title?></h2></div>   
        <div class="table">
            <form method='post' name='sf'>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" id='datatable'>                                                                     
                <tr id='ath'>
                <?foreach($field_names as $value){ 
                    if(isset($value['ss']) && $value['ss'] > 0 ){
                ?>
                    <th><strong><?=$value['title']?></strong></th>
                <?}}?>    
                    <td colspan='3' align='left'><a href='/admin/<?=$cn?>/add' title='Add new <?=$sg?>' style='text-decoration:none;margin:1px;padding:1px;'><img style='border:0px;height:20px;width:20px;' src='/css/images/add-button.gif'></a></td>
               </tr>
                <tr>
                <?foreach($search_fields as $key => $value){ 
                        if(isset($field_names[$key]['ss']) && $field_names[$key]['ss'] > 0 &&  !is_array($field_names[$key]['ss'])){
                ?>
                    <th><input type='text' size='<?=$field_names[$key]['ss']?>' name='k_<?=$key?>' value='<?=$value?>'></th>
                <?}
                else if (isset($field_names[$key]['ss'])&&is_array($field_names[$key]['ss'])){
                    if($field_names[$key]['ss'][0] == 'select'||$field_names[$key]['ss'][0] == 'radio'){
                ?>
                <th><select name='k_<?=$key?>' style='width:<?echo $key=='active'?'40':'80';?>px;'>
                <option value=''></option>
                <?foreach($field_names[$key]['ss'][1] as $key1 => $value1){?>
                    <option value='<?=$key1?>'><?=$value1?></option>
                <?}?>
                </select></th>
                <?}}}?>    
                    <td colspan='3' align='left'><input type='submit' class='button' value='Search'></td>
               </tr>
               <?php if($record_list){
               foreach ($record_list as $record){ ?>
               <tr>       
                    <?foreach($field_names as $key => $value){ 
                        if($field_names[$key]['ss'] > 0 ){
                            if((isset($field_names[$key]['ss'][0]))&&($field_names[$key]['ss'][0]=='select' || $field_names[$key]['ss'][0]=='radio') ){
                    ?>
                    <td height="23">&nbsp;<?echo (isset($field_names[$key]['ss'][1][$record[$key]])?$field_names[$key]['ss'][1][$record[$key]]:'');?></td>
                    <?
                            }
                            elseif(isset($field_names[$key]['type'][0]) && $field_names[$key]['type'][0]=='image' && is_file($this->field_names[$key]['dir'][0].'/tn/'.$record[$key])){
                    ?>
                    <td>&nbsp;<img src="<?echo $this->config->{'config'}['base_url'].$this->field_names[$key]['dir'][0].'/tn/'.$record[$key]?>"></td>
                    <?
                            }
                            else{
                    ?>
                    <td height="23">&nbsp;<?echo (strlen($record[$key]) > $field_names[$key]['ss']) ?substr($record[$key],0,$field_names[$key]['ss']).'...':$record[$key];?></td>
                    <?}}}?>
                    <td style='width:50px;'><a href="/admin/<?=$cn?>/view/<?=$record['id']?>" class='ico edit'>View</a></td>
                    <td style='width:50px;'><a href="/admin/<?=$cn?>/edit/<?=$record['id']?>" class='ico edit'>Edit</a></td>
                    <td style='width:50px;'><a href="/admin/<?=$cn?>/delete/<?=$record['id']?>" class='ico del'>Delete</a></td>
               </tr>
               <?}
               }else{?>
                <td style='color:red;font-weight:bold;' colspan='<?=($defcolspan+3)?>'><center>No records found</center></td>
               <?}?>

            </table>
            </form>
             <?php if($record_list){?>
            <div class="pagging" id='pagingdiv'>   
                <div class="left">Showing <?=$start?> - <?=$end?> of <?=$tc?></div>
                    <div class="right"><? if($page > 1){?>
                        <a href="/admin/<?=$cn?>/listall/1"><<</a>
                        <a href="/admin/<?=$cn?>/listall/<?=($page-1)?>">Previous</a><?}
						$skip = 0;
						$sskip = 0;
						$eskip = 0;
						$msskip = 0;
						$meskip = 0;
						
						if($page_count > 15 ){
							if($page < 7 || $page > ($page_count - 7)){
								$skip = true;
								$sskip = 8;
								$eskip = $page_count - $sskip;
							}
							else{
								$skip = true;
								$sskip = 3;
								$eskip = $page_count - $sskip;
								
								$msskip = $page - 3;
								$meskip = $page + 3;
							}
						}
						
						$printd = 0;
						
                        for ($i = 1; $i <= $page_count; $i++) {
						
							if( $skip && $eskip && $i > $sskip && $i < $eskip ){
								
								if($printd == 0 ){
									echo "<a> . . . </a>";
									$printd = 1;
								}

								if($msskip && $meskip && $i > $msskip && $i < $meskip ){

								}
								else{
									
									if( $i == $meskip){
										$printd = 0;
									}
									continue;
								}
								

							}
							
                            if($page == $i){
                        ?>
                        <a href="/admin/<?=$cn?>/listall/<?=$i?>" style='font-size:1.2em;color:#ba4c32;'><strong><?=$i?></strong></a>
                        <?
                            }
                            else{
                        ?>
                        <a href="/admin/<?=$cn?>/listall/<?=$i?>"><?=$i?></a>
                        <?
                            }
                        }
                        if($page < $page_count){?><a href="/admin/<?=$cn?>/listall/<?=($page+1)?>">Next</a>
                        <a href="/admin/<?=$cn?>/listall/<?=$page_count?>">>></a><?}?>
                    </div>
                </div>
            </div>
            <?}?>
    </div>
    
    <script type='text/javascript'>
        document.getElementById('headdiv').setAttribute("style","display:block;width:"+(document.getElementById('datatable').offsetWidth-20)+"px");
        document.getElementById('headdiv').style.width=(document.getElementById('datatable').offsetWidth-20)+'px';
        document.getElementById('pagingdiv').setAttribute("style","display:block;width:"+(document.getElementById('datatable').offsetWidth-20)+"px");
        document.getElementById('pagingdiv').style.width=(document.getElementById('datatable').offsetWidth-20)+'px';
        document.getElementById('boxdiv').setAttribute("style","display:block;width:"+(document.getElementById('datatable').offsetWidth)+"px");
        document.getElementById('boxdiv').style.width=(document.getElementById('datatable').offsetWidth0)+'px';
    </script>
<?}
else if ( isset($context) && $context == 'form'){
?>
<center>
<div class="box" style='min-width:400px;max-width:700px;margin-top:10px;'>
    <div class="box-head">
        <h2><?=$title?></h2>
    </div>
    <div class='box-content'><span style='color:red;'><? echo(isset($error_message)?$error_message:''); ?></span></div>
    <div class="box-content">
        <form name="<?=$sg?>_form" id="<?=$sg?>_form" action="/admin/<?=$cn?>/<?=$action?>" method="post" enctype="multipart/form-data" >      
            <table border="0" class="formtable">
                <?
                $presence = array();
                foreach($field_names as $key => $value){
                if(isset($field_names[$key]['ft'][0]) && isset($field_names[$key]['pr'])){
                    $presence[] = $key;
                }
                if($field_names[$key]['ft'][0] == 'text'){ 
                 ?>
                 <tr><td class='fleft'><?=$field_names[$key]['title']?> : </td><td class='fright'><input name="<?=$key?>" type="text" id="<?=$key?>" size="<?=$field_names[$key]['ft'][2]?>" value='<?=($field_names[$key]['ft'][1]==NULL?'':$record[$key])?>'/></td></tr>
                <?}
                  else if($field_names[$key]['ft'][0] == 'textarea'){ ?>
                 <tr><td class='fleft'><?=$field_names[$key]['title']?> : </td><td class='fright'><textarea name="<?=$key?>" id="<?=$key?>" cols="<?=$field_names[$key]['ft'][2]?>" rows="<?=$field_names[$key]['ft'][3]?>"><?=($field_names[$key]['ft'][1]==NULL?'':$record[$key])?></textarea></td></tr>
                <?}
                else if($field_names[$key]['ft'][0] == 'hidden'){ ?>
                 <tr><td colspan='2'><input type='hidden' name="<?=$key?>" id="<?=$key?>" value="<?=($field_names[$key]['ft'][1]==NULL?'':$record[$key])?>"></td></tr>
                <?}
                  else if($field_names[$key]['ft'][0] == 'radio'){ ?>
                 <tr><td class='fleft'><?=$field_names[$key]['title']?> : </td><td class='fright'>
                    <?foreach($field_names[$key]['ft'][1] as $optk => $optv){?>
                    <input name="<?=$key?>" type="radio" id="<?=$key?>" value='<?=$optk?>' <?echo ($record[$key]==$optk||($record[$key]== NULL && $field_names[$key]['ft'][2] == $optk))?'checked="checked"':'';?>/> <?=$optv?>&nbsp;&nbsp;&nbsp;
                    <?}?>
                    </td></tr>
                <?}
                else if($field_names[$key]['ft'][0] == 'file'){ ?>
                 <tr><td class='fleft'><?=$field_names[$key]['title']?> : </td><td class='fright'><input type='file' name="<?=$key?>" id="<?=$key?>"><?if(isset($record[$key]) && $field_names[$key]['type'][0]=='image'  && is_file($this->field_names[$key]['dir'][0].'/tn/'.$record[$key])){?><br><input type="hidden" id="d<?=$key?>" name="d<?=$key?>" value='<?=$record[$key]?>'><img src="<?echo $this->config->{'config'}['base_url'].$this->field_names[$key]['dir'][0].'/tn/'.$record[$key]?>"><?}?></td></tr>
                <?}
                else if($field_names[$key]['ft'][0] == 'select'){ 
                ?>
                <tr><td class='fleft'><?=$field_names[$key]['title']?> : </td><td class='fright'>
                    <select  name="<?=$key?>" id="<?=$key?>"><option value='0'></option>
                    <?foreach($field_names[$key]['ft'][1] as $optk => $optv){?>
                    <option value='<?=$optk?>' <?echo ($record[$key]==$optk)?'SELECTED':'';?>><?=$optv?></option>
                    <?}?>
                    </select>
                </td></tr>
                <?}}?>
                <tr><td colspan="2" align="right"><input type="hidden" name="back" value='<?=$back?>'/><?if(isset($record['id'])){?><input type="hidden" name="id" id="id" value='<?=$record['id']?>'/><?}?><input type="button" class="button" value='Cancel' onclick="location.href='<?=$back?>'"/>&nbsp;&nbsp;<input type="submit" name="action" class="button" value='<?=$button?>'/></td></tr>
            </table>
            <script type="text/javascript">
            <?
            if(isset($presence)){
                foreach ($presence as $key){
                if(isset($field_names[$key]['type'][0]) && $field_names[$key]['type'][0]=='image'){
                ?>new LiveValidation('<?=$key?>', {onlyOnSubmit: true, validMessage: ' ',onInvalid:function(){new LiveValidation('d<?=$key?>', {onlyOnSubmit: true, validMessage: ' '  }).add(Validate.Presence);}}).add(Validate.Presence);
                <?                
                }
                else{
            ?>new LiveValidation('<?=$key?>', {onlyOnSubmit: true, validMessage: ' '  }).add(Validate.Presence);
            <?}}}?>
            </script> 
        </form>
     </div> 
</div>
</center>

<?}
else if ( isset($context) && $context == 'view'){
?>
<center>
<div class="box" style='min-width:400px;max-width:700px;margin-top:10px;'>
    <div class="box-head">
        <h2><?=$title?></h2>
    </div><div class='right'></div>
    <div class="box-content">
    <table border="0" class="formtable">
        <?foreach($field_names as $key => $value){
            if($value['ss'] > 0 ){
        ?>
        <tr><td class='fleft'><?=$field_names[$key]['title']?> : </td><td class='fright'><?=$record[$key]?></td></tr>
        <?}}?>   
        <tr><td colspan="2" align="right">
        <?if($delete){?>
            <form method='post' action='/admin/<?=$cn?>/delconfirm/<?=$id?>'>
            <input type="hidden" name="back" value='<?=$back?>'/>
            <input type="button" class="button" value='Cancel' onclick="location.href='<?=$back?>'"/>
            <input type="submit" class="button" value='Confirm'/>
            </form>
        <?}else{?>
            <input type="button" class="button" value='Back' onclick="location.href='<?=$back?>'"/>
        <?}?>
        </td></tr>
    </table>
     </div> 
</div>
</center>
<?}?>
</body>
</html>