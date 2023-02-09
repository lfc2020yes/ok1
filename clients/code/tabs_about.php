<?
 if (($role->permission('Клиенты','U'))or($sign_admin==1))
{
$poten='';
$turis='';
if($row_score["potential"]==1)
{
	$poten=' display:none';
}
    if($row_score["potential"]==2)
    {
    //    $turis='display:none';
    }

	 
$query_string='<div class="jipp_fll"><div class="px_flex flex_edit_cb">';

$query_string.='<div class="essa_b"><div class="strong_wh">Дополнительная информация</div>';

if($row_score["potential"]==0)
{
/*	
$query_string.='<div class="input-choice-click js-potential-butt">
<div class="choice-head">Потенциальный клиент</div>
<div class="choice-radio"><div class="center_vert1"><i></i><input name="radio_potential" value="0" type="hidden"></div></div></div>';
*/
$query_string.='<input name="radio_potential" value="0" type="hidden">';
} else
{

    if($row_score["potential"]==1) {
        $query_string .= '<div class="password_turs">
<div id="1" class="input-choice-click-pass t js-potential-butt">
<div class="choice-head">Потенциальный клиент</div>
<div class="choice-radio"><div class="center_vert1"><i class="active_task_cb"></i></div></div>
</div>	

<div id="2" class="input-choice-click-pass  js-potential-butt">
<div class="choice-head">Турист (Летит с покупателем)</div>
<div class="choice-radio"><div class="center_vert1"><i class=""></i></div></div>
</div>
<input name="radio_potential" value="1" type="hidden">	
</div>';
    } else
    {
        $query_string .= '<div class="password_turs">
<div id="1" class="input-choice-click-pass t js-potential-butt">
<div class="choice-head">Потенциальный клиент</div>
<div class="choice-radio"><div class="center_vert1"><i></i></div></div>
</div>	

<div id="2" class="input-choice-click-pass  js-potential-butt">
<div class="choice-head">Турист (Летит с покупателем)</div>
<div class="choice-radio"><div class="center_vert1"><i class="active_task_cb"></i></div></div>
</div>
<input name="radio_potential" value="2" type="hidden">	
</div>';
    }

/*
    $query_string.='<div class="input-choice-click js-potential-butt">
<div class="choice-head">Потенциальный клиент</div>
<div class="choice-radio"><div class="center_vert1"><i class="active_task_cb"></i><input name="radio_potential" value="1" type="hidden"></div></div></div>';
*/


}

$query_string.='</div>';

$query_string.='<div class="px_left">';


$query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>ФИО<span>*</span></label><input name="offers[0][client_fio]" value="'.ipost_($row_score["fio"],"").'" id="date_124" class="input_new_2018 required  gloab gloab_potential gloab_turist no_upperr latin_start" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';	

  $query_string.='<div style="margin-top: 30px; '.$poten.'" class="js-potential-hide"><div class="input_2018"><label>ФИО Латинскими</label><input name="offers[0][client_latin]" value="'.ipost_($row_score["latin"],"").'" id="date_124" class="input_new_2018 required  latin_end" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';	
/*
  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Телефон<span>*</span></label><input name="offers[0][client_phone]" value="'.ipost_($row_score["phone"],"").'" id="date_124" class="input_new_2018 required  gloab gloab_potential phone_us1" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';
*/	 
	 /*
$phone_format='+7 ('.$row_score["phone"][0].$row_score["phone"][1].$row_score["phone"][2].') '.$row_score["phone"][3].$row_score["phone"][4].$row_score["phone"][5].'-'.$row_score["phone"][6].$row_score["phone"][7].'-'.$row_score["phone"][8].$row_score["phone"][9];
	 */
    $phone_format='';
    if($row_score["phone"]!='') {
        $phone_format = phone_format($row_score["phone"]);
    }
  $query_string.='<div style="margin-top: 30px; '.$turis.'"  class="js-turist-hidex "><div class="input_2018 input-phone-list"><i class="js-open-phone">уже есть в базе</i><label>Телефон<span class="hide-letit-nado">*</span></label><input name="offers[0][client_phone]" value="'.ipost_($row_score["phone"],"").'" old_value="'.$phone_format.'" id="date_124" class="input_new_2018 required  gloab gloab_potential js-mask-input-tel js-true-phone" autocomplete="off" type="tel">
  <input type="hidden" class="js-true-search-phone"  name="phone_true"  value="0">
  
  <div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';	 
	 
	 

$D_date_c = explode('-', $row_score["date_birthday"]);
if($row_score["date_birthday"]!='0000-00-00')
{
$date_inn=$D_date_c[2].'.'.$D_date_c[1].'.'.$D_date_c[0];
} else
{
	$date_inn='';
}
  $query_string.='<div style="margin-top: 30px; '.$poten.'" class="js-potential-hide"><div class="input_2018"><label>Дата рождения<span>*</span></label><input name="offers[0][client_date]" value="'.ipost_($date_inn,"").'" id="date_124" class="input_new_2018 required  gloab gloab_turist date_picker_x" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';

	
$query_string.='</div>
<div class="px_right">';



	 $os_say55 = array('мужской','женский');
 $os_id_say55 = array(1,2);	 
	 
	 
	$su_say55=ipost_($row_score["pol"],"1"); 	 
	 
$query_string.='<div style="margin-top: 30px; '.$poten.'" class="js-potential-hide">	';
	
$query_string.='<div class="left_drop menu1_prime"><label class="active_label">Пол<span>*</span></label><div class="select eddd zin_2019"><a class="slct" list_number="t1" data_src="'.$os_id_say55[array_search($su_say55, $os_id_say55)].'">'.$os_say55[array_search($su_say55, $os_id_say55)].'</a><ul class="drop">';


	 
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
	 
	 

		   $query_string.='</ul><input type="hidden" class="gloab1"  name="offers[0][pol]" id="pol_clients" value="'.ipost_($row_score["pol"],"").'"><div class="div_new_2018_"><hr class="one"></div></div></div></div>';	
	 
	 
	 

  $query_string.='<div style="margin-top: 30px; '.$turis.'" class="js-turist-hide"><div class="input_2018"><label>Email</label><input name="offers[0][client_email]" value="'.ipost_($row_score["email"],"").'" id="date_124" class="input_new_2018 required no_upperr " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';

  $query_string.='<div style="margin-top: 30px; '.$poten.' '.$turis.'" class="js-potential-hide js-turist-hide"><div class="input_2018"><label>Адрес</label><input name="offers[0][client_adress]" value="'.ipost_($row_score["adress"],"").'" id="date_124" class="input_new_2018 required no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';


$query_string.='<div style="margin-top: 30px;">';

      $query_string.='<div class="div_textarea_otziv1" >
			<div class="otziv_add">';
                 
                   
        $query_string.='<textarea cols="10" rows="1" placeholder="Ваш комментарий" id="otziv_area_adaxx2" name="offers[0][client_comment]" class="di text_area_otziv no_comment_bill22">'.ipost_($row_score["comment"],"").'</textarea>';
				
            $query_string.='</div>      
</div>  

        <script type="text/javascript"> 
	  $(function (){ 
$(\'#otziv_area_adaxx2\').autoResize({extraSpace : 10});
$(\'#otziv_area_adaxx2\').trigger(\'keyup\');


 const phoneEl = $(\'.js-mask-input-tel\')[0];
     let phoneMask = IMask(phoneEl, {
         mask: \'{+7} (#00) 000-00-00\',
         definitions: {
             \'#\': /[012345679]/
         }
     });

});

	</script>
	</div>';
	


$query_string.='</div>
</div>';



$query_string.='<div class="px_flex flex_edit_cb js-potential-hide" style="'.$poten.' ">';


$query_string.='<div class="px_left">';

$query_string.='<div class="strong_wh">Заграничный паспорт</div>';

$query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Серия</label><input name="offers[0][client_z_seria]" value="'.ipost_($row_score["inter_seria"],"").'" id="date_124" class="input_new_2018 required  " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';	

  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Номер</label><input name="offers[0][client_z_number]" value="'.ipost_($row_score["inter_number"],"").'" id="date_124" class="input_new_2018 required  " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';	

  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Кем выдан</label><input name="offers[0][client_z_kem]" value="'.ipost_($row_score["inter_kem"],"").'" id="date_124" class="input_new_2018 required no_upperr " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';


if(($row_score["inter_kogda"]!='0000-00-00')and($row_score["inter_kogda"]!=''))
{
$D_date_c = explode('-', $row_score["inter_kogda"]);	
$date_inn=$D_date_c[2].'.'.$D_date_c[1].'.'.$D_date_c[0];
} else
{
	$date_inn='';
}
  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Когда выдан</label><input name="offers[0][client_z_kogda]" value="'.ipost_($date_inn,"").'" id="date_124" class="input_new_2018 required   date_picker_x" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';


if(($row_score["inter_srok"]!='0000-00-00')and($row_score["inter_srok"]!=''))
{
$D_date_c = explode('-', $row_score["inter_srok"]);	
$date_inn=$D_date_c[2].'.'.$D_date_c[1].'.'.$D_date_c[0];
} else
{
	$date_inn='';
}
  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Срок действия</label><input name="offers[0][client_z_srok]" value="'.ipost_($date_inn,"").'" id="date_124" class="input_new_2018 required   date_picker_x" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';

	
$query_string.='</div>
<div class="px_right">';

$query_string.='<div class="strong_wh">Внутренний паспорт</div>';


  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Серия</label><input name="offers[0][client_v_seria]" value="'.ipost_($row_score["inner_seria"],"").'" id="date_124" class="input_new_2018 required  " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';	

  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Номер</label><input name="offers[0][client_v_number]" value="'.ipost_($row_score["inner_number"],"").'" id="date_124" class="input_new_2018 required  " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';	

  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Кем выдан</label><input name="offers[0][client_v_kem]" value="'.ipost_($row_score["inner_kem"],"").'" id="date_124" class="input_new_2018 required  no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';


if(($row_score["inner_kogda"]!='0000-00-00')and($row_score["inner_kogda"]!=''))
{
$D_date_c = explode('-', $row_score["inner_kogda"]);	
$date_inn=$D_date_c[2].'.'.$D_date_c[1].'.'.$D_date_c[0];
} else
{
	$date_inn='';
}
  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Когда выдан</label><input name="offers[0][client_v_kogda]" value="'.ipost_($date_inn,"").'" id="date_124" class="input_new_2018 required   date_picker_x" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';


	


$query_string.='</div>
</div>';


$query_string.='<div class="osob_cb js-potential-hide js-turist-hide" style="'.$poten.' '.$turis.'">';
	
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
				  
				  <input class="rt_wall yop_'.$row_work_zz["id"].'" name="options_r'.$row_work_zz["id"].'" value="'.(isset($_POST['options_r'.$row_work_zz["id"]]) ? ipost_($_POST['options_r'.$row_work_zz["id"]],$rtt_value) : '').'" type="hidden">
				  </div>';				
				
					
			      $query_string.='<div class="table-cell name_wall wall1">'.$row_work_zz["name"].'</div>
			      
			  </div>
			</div>';
						  
					
				
			   
			   
			   
		   }
		$query_string.='<input  type="hidden" value="'.ipost_($yuud,'').'" id="options_b" class="sourse_b" name="options_b">';
			
		}
				
			
			
			
	
			$query_string.='</div></span></div></div></div>';	


$query_string.='<div class="jkl_dd"><div class="center_vert" style="width: 100%;"><div class="add_cff12 js-save-info-client-cb">Сохранить изменения</div></div></div>';


$query_string.='</div>';

 }

$query_string.='<div class="jipp_fll_start">';

$query_string.='<div class="px_flex"><div class="px_left"><div class="strong_wh">Дополнительная информация</div>';
	



                                                              
                                                                                  		 			 		





			  if($row_score["potential"]==0)
			  {
$query_string.='<div class="pass_wh"><label>Адрес</label><span>'.rooo($row_score["adress"],'','—').'</span></div>';	
			  }
	
		$result_work_zz1=mysql_time_query($link,'Select a.name_user from r_user as a where a.id="'.$row_score["id_user"].'"');
	 
        $num_results_work_zz1 = $result_work_zz1->num_rows;
	    if($num_results_work_zz1!=0)
	    {
			$row_work_zz1 = mysqli_fetch_assoc($result_work_zz1);
		}
	$query_string.='<div class="pass_wh"><label>Менеджер</label><span>'.($row_work_zz1["name_user"] ?? 'незвестно').'</span></div>';
	
	$D = explode(' ', $row_score["datetime"]);
	$query_string.='<div class="pass_wh"><label>Добавлен</label><span>'.MaskDate_D_M_Y_ss($D[0]).'</span></div>';


if($more_city==1)
{
    //выводить к какой организации относится тур

    $result_cop = mysql_time_query($link, 'select * from a_company where id="'.ht($row_score["id_a_company"]).'"');
    $num_results_cop = $result_cop->num_rows;

    if ($num_results_cop != 0) {
        $row_cop = mysqli_fetch_assoc($result_cop);
        $task_cloud_block.=' <div class="issue-block oo_date">('.$row_cop["name_dop"].')</div>';

        $query_string.='<div class="pass_wh"><label>Организация</label><span>'.($row_cop["name"] ?? 'незвестно').'</span></div>';
    }


}




	$query_string.='</div><div class="px_right"><div class="strong_wh">Особенности туриста</div>';
	
			  if($row_score["potential"]==0)
			  {
$query_string.='<div class="pass_wh"><label>Особенности</label><span>';
			$result_work_zz=mysql_time_query($link,'Select a.* from options_client as a,k_clients_options as b where b.id_option=a.id and b.id_k_clients="'.$row_score["id"].'" and a.visible=1 order by a.name');

			 
        $num_results_work_zz = $result_work_zz->num_rows;
	    if($num_results_work_zz!=0)
	    {
		   for ($i=0; $i<$num_results_work_zz; $i++)
		   {			   			  			   
			   $row_work_zz = mysqli_fetch_assoc($result_work_zz);
			   if($i==0)
			   {
			   $query_string.=$row_work_zz["name"];
			   } else
			   {
				 $query_string.=', '.$row_work_zz["name"];  
			   }
		   } 
		} else {  $query_string.='—';} 
	
	
$query_string.='</span></div>';		
			  }


$promo='нет';

    if($row_score["id_affiliates"]!=0)
    {
        $promo='<span class="da-partner">Да</span>';
    }


$query_string.='<div class="pass_wh"><label>Клиент партнера</label><span>'.$promo.'</span></div>';

$query_string.='<div class="pass_wh"><label>Комментарий</label><span>'.rooo($row_score["comment"],'','—').'</span></div>';
	
$query_string.='</div></div>';

			  if(($row_score["potential"]==0)or($row_score["potential"]==2))
			  {
$query_string.='<div style="margin-top: 20px;" class="px_flex"><div class="px_left"><div class="strong_wh">Заграничный паспорт</div>';
	
$query_string.='<div class="pass_wh"><label>Серия</label><span>'.rooo($row_score["inter_seria"],'','—').'</span></div>';
$query_string.='<div class="pass_wh"><label>Номер</label><span>'.rooo($row_score["inter_number"],'','—').'</span></div>';
$query_string.='<div class="pass_wh"><label>Кем выдан</label><span>'.rooo($row_score["inter_kem"],'','—').'</span></div>';
$query_string.='<div class="pass_wh"><label>Когда выдан</label><span>'.rooo(MaskDate_D_M_Y_ss($row_score["inter_kogda"]),'00.00.0000','—').'</span></div>';
$query_string.='<div class="pass_wh"><label>Срок действия</label><span>'.rooo(MaskDate_D_M_Y_ss($row_score["inter_srok"]),'00.00.0000','—').'</span></div>';	
$query_string.='</div><div class="px_right"><div class="strong_wh">Внутренний паспорт</div>';	
$query_string.='<div class="pass_wh"><label>Серия</label><span>'.rooo($row_score["inner_seria"],'','—').'</span></div>';
$query_string.='<div class="pass_wh"><label>Номер</label><span>'.rooo($row_score["inner_number"],'','—').'</span></div>';
$query_string.='<div class="pass_wh"><label>Кем выдан</label><span>'.rooo($row_score["inner_kem"],'','—').'</span></div>';
$query_string.='<div class="pass_wh"><label>Когда выдан</label><span>'.rooo(MaskDate_D_M_Y_ss($row_score["inner_kogda"]),'00.00.0000','—').'</span></div>';		
$query_string.='</div></div>';
			  }
$query_string.='</div>';	
?>