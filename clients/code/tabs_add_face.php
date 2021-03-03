<?
 if (($role->permission('Клиенты','A'))or($sign_admin==1))
{
$query_string ??='<div class="jipp_fll" style="display:block;"><div class="px_flex flex_edit_cb">';

$query_string.='<div class="essa_b"><div class="strong_wh">Дополнительная информация</div>';

/*
$query_string.='<div class="input-choice-click js-potential-butt">
<div class="choice-head">Потенциальный клиент</div>
<div class="choice-radio"><div class="center_vert1"><i></i><input name="radio_potential" value="0" type="hidden"></div></div></div>';
*/


    $query_string.='<div class="password_turs">
<div id="1" class="input-choice-click-pass t js-potential-butt">
<div class="choice-head">Потенциальный клиент</div>
<div class="choice-radio"><div class="center_vert1"><i class=""></i></div></div>
</div>	

<div id="2" class="input-choice-click-pass  js-potential-butt">
<div class="choice-head">Турист (Летит с покупателем)</div>
<div class="choice-radio"><div class="center_vert1"><i class=""></i></div></div>
</div>
<input name="radio_potential" value="0" type="hidden">	
</div>';



$query_string.='</div>';

$query_string.='<div class="px_left" style="padding-top:0px;">';

	 





	 
	 

$query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>ФИО<span>*</span></label><input name="offers[0][client_fio]" value="" id="date_124" class="input_new_2018 required  gloab gloab_potential gloab_turist no_upperr latin_start" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';	

  $query_string.='<div style="margin-top: 30px;" class="js-potential-hide"><div class="input_2018"><label>ФИО Латинскими</label><input name="offers[0][client_latin]" value="" id="date_124" class="input_new_2018 required  latin_end" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';	

  $query_string.='<div style="margin-top: 30px;" class="js-turist-hide"><div class="input_2018 input-phone-list"><i class="js-open-phone">уже есть в базе</i><label>Телефон<span>*</span></label><input name="offers[0][client_phone]" value="" id="date_124" class="input_new_2018 required  gloab gloab_potential phone_us1 js-true-phone" autocomplete="off" type="text">
  <input type="hidden" class="js-true-search-phone"  name="phone_true"  value="0">
  
  <div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';


  $query_string.='<div style="margin-top: 30px;" class="js-potential-hide"><div class="input_2018"><label>Дата рождения<span>*</span></label><input name="offers[0][client_date]" class="input_new_2018 required  gloab date_picker_x gloab_turist" value="" id="date_124" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';

	
$query_string.='</div>
<div class="px_right" style="padding-top:0px;">';


	 $os_say55 = array('мужской','женский');
 $os_id_say55 = array(1,2);	 
	$su_say55=1; 	 
	 
$query_string.='<div style="margin-top: 30px;" class="js-potential-hide">	';
	
$query_string.='<div class="left_drop menu1_prime"><label class="active_label">Пол<span>*</span></label><div class="select eddd zin_2019"><a class="slct" list_number="t1" data_src="'.$os_id_say55[array_search(1, $os_id_say55)].'">'.$os_say55[array_search(0, $os_id_say55)].'</a><ul class="drop">';


	 
	 for ($i=0; $i<count($os_say55); $i++)
             {   
			   if($su_say55==$os_id_say55[$i])
			   {
				   $query_string.='<li class="sel_active"><a href="javascript:void(0);"  rel="'.$os_id_say55[$i].'">'.$os_say55[$i].'</a></li>';
			   } else
			   {
				  $query_string.='<li><a href="javascript:void(0);"  rel="'.$os_id_say55[$i].'">'.$os_say55[$i].'</a></li>'; 
			   }
			 
			 }
	 
	 

		   $query_string.='</ul><input type="hidden" class="gloab1"  name="offers[0][pol]" id="pol_clients" value="1"><div class="div_new_2018_"><hr class="one"></div></div></div></div>';	


  $query_string.='<div style="margin-top: 30px;" class="js-turist-hide"><div class="input_2018"><label>Email</label><input name="offers[0][client_email]" value="" id="date_124" class="input_new_2018 required no_upperr " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';

  $query_string.='<div style="margin-top: 30px;" class="js-potential-hide js-turist-hide"><div class="input_2018"><label>Адрес</label><input name="offers[0][client_adress]" value="" id="date_124" class="input_new_2018 required no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';


$query_string.='<div style="margin-top: 30px;">';

      $query_string.='<div class="div_textarea_otziv1" >
			<div class="otziv_add">';
                 
                   
        $query_string.='<textarea cols="10" rows="1" placeholder="Ваш комментарий" id="otziv_area_adaxx2" name="offers[0][client_comment]" class="di text_area_otziv no_comment_bill22"></textarea>';
				
            $query_string.='</div>      
</div>  

        <script type="text/javascript"> 
	  $(function (){ 
$(\'#otziv_area_adaxx2\').autoResize({extraSpace : 10});
$(\'#otziv_area_adaxx2\').trigger(\'keyup\');
});

	</script>
	</div>';
	

$query_string.='</div>
</div>';



$query_string.='<div class="px_flex flex_edit_cb js-potential-hide">';


$query_string.='<div class="px_left">';

$query_string.='<div class="strong_wh">Заграничный паспорт</div>';

$query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Серия</label><input name="offers[0][client_z_seria]" value="" id="date_124" class="input_new_2018 required  " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';	

  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Номер</label><input name="offers[0][client_z_number]" value="" id="date_124" class="input_new_2018 required  " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';	

  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Кем выдан</label><input name="offers[0][client_z_kem]" value="" id="date_124" class="input_new_2018 required no_upperr " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';


  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Когда выдан</label><input name="offers[0][client_z_kogda]" value="" id="date_124" class="input_new_2018 required   date_picker_x" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';


  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Срок действия</label><input name="offers[0][client_z_srok]" value="" id="date_124" class="input_new_2018 required   date_picker_x" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';

	
$query_string.='</div>
<div class="px_right">';

$query_string.='<div class="strong_wh">Внутренний паспорт</div>';


  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Серия</label><input name="offers[0][client_v_seria]" value="" id="date_124" class="input_new_2018 required  " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';	

  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Номер</label><input name="offers[0][client_v_number]" value="" id="date_124" class="input_new_2018 required  " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';	

  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Кем выдан</label><input name="offers[0][client_v_kem]" value="" id="date_124" class="input_new_2018 required  no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';

  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Когда выдан</label><input name="offers[0][client_v_kogda]" value="" id="date_124" class="input_new_2018 required   date_picker_x" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';


	


$query_string.='</div>
</div>';

$query_string.='<div class="osob_cb js-potential-hide js-turist-hide">';
	
$query_string.='<div class="oka_block column_flex"> 

<div class="div_ook_grei1 add_client" style="margin-top: 0px !important;">

			<div class="ok-block-input">
			 <div class="ok-input-title">Особенности клиента<i></i></div>
		</div></div></div>';	
			
			
			
			 
		
	$query_string.='<div class="div_ook_grei add_client1"><div class="ok-block-input"><span class="ok-i"><div class="cha_1 active_option cha_77 ">';		
				
			
	$result_work_zz=mysql_time_query($link,'Select a.* from options_client as a where a.visible=1 order by a.displayOrder');

						 
			 
						 
						 
        $num_results_work_zz = $result_work_zz->num_rows;
	    if($num_results_work_zz!=0)
	    {

	
	
		   $id_work=0;
		   
			
			$yuud='';
			/*
		   $result_authority=mysql_time_query($link,'select C.id_option from k_clients_options as C where C.id_k_clients="'.$row_score["id"].'"');
   $num_results_authority = $result_authority->num_rows; 
   
   if($num_results_authority<>0)
   {
	
	   for ($idd=0; $idd<$num_results_authority; $idd++)
		   {
	  $row_82 = mysqli_fetch_assoc($result_authority);
	  
		 if($idd==0) 
		 {
		  $yuud=$row_82["id_option"];
		 } else
		 {
			 $yuud.=','.$row_82["id_option"];
		 }
		
	  }
   }
	*/		
		   $rr=explode(',',$yuud);
			
			
		   for ($i=0; $i<$num_results_work_zz; $i++)
		   {			   			  			   
			   $row_work_zz = mysqli_fetch_assoc($result_work_zz);

			   	 $rtt='';
			   $rtt_value="0";
				   
				   	$found = array_search($row_work_zz["id"],$rr);   
	                if($found !== false) 
	                {
						  	 $rtt='active_wall'; 
				             $rtt_value="1";
	                }
			   
			    
			   

				  $query_string.='<div class="wallet_material material_add_client_window wallet_client  '.$rtt.'" wall_id="'.$row_work_zz["id"].'">
			  <div class="table w_mat">
			      <div class="table-cell one_wall">
				  <div class="st_div_wall  wallet_checkbox"><i></i></div>
				  
				  <input class="rt_wall yop_'.$row_work_zz["id"].'" name="options_r'.$row_work_zz["id"].'" value="'.(isset($_POST['options_r'.$row_work_zz["id"]]) ?ipost_($_POST['options_r'.$row_work_zz["id"]],$rtt_value) : $rtt_value).'" type="hidden">
				  </div>';				
				
					
			      $query_string.='<div class="table-cell name_wall wall1">'.$row_work_zz["name"].'</div>
			      
			  </div>
			</div>';
						  
					
				
			   
			   
			   
		   }
		$query_string.='<input  type="hidden" value="" id="options_b" class="sourse_b" name="options_b">';
			
		}
				
			
			
			
	
			$query_string.='</div></span></div></div></div>';	


$query_string.='<div class="jkl_dd"><div class="center_vert" style="width: 100%;"><div class="add_cff12 js-add-client-cb">Добавить туриста</div></div></div>';


$query_string.='</div>';

$query_string.='<script type="text/javascript"> 
	  $(function (){ ';

	if((!isset($_GET["tabs"]))or($_GET["tabs"]==0))
	{
	 if((!isset($_COOKIE["su_1c".$id_user]))or(($_COOKIE["su_1c".$id_user]==0)or($_COOKIE["su_1c".$id_user]==1)) )
	{

$query_string.='if ($(\'.add-next-user\').length > 0) { $(\'[name=temp]\').val(1); }';
	}
		
	} else
	{
			if($_GET["tabs"]==2)
	{
				$query_string.='if ($(\'.add-next-poten\').length > 0) { $(\'[name=temp]\').val(1); }';
			}
	}
	 
	 
$query_string.='});

	</script>';	 	 
	 
 }

?>