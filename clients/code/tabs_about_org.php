<?
 if (($role->permission('Клиенты','U'))or($sign_admin==1))
{
$query_string='<div class="jipp_fll"><div class="px_flex flex_edit_cb">';

//$query_string.='<div class="essa_b"><div class="strong_wh">Дополнительная информация</div></div>';

$query_string.='<div class="px_left">';

$query_string.='<div class="strong_wh">Основные данные</div>';
	 
$query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Наименование<span>*</span></label><input name="offers[0][org_name]" value="'.ipost_($row_score["name"],"").'" id="date_124" class="input_new_2018 required  gloab no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';	

  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>
ФИО Руководителя</label><input name="offers[0][org_head]" value="'.ipost_($row_score["head"],"").'" id="date_124" class="input_new_2018 required  no_upperr js-padej_woo woo1" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';	

  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Должность</label><input name="offers[0][org_position]" value="'.ipost_($row_score["position"],"").'" id="date_124" class="input_new_2018 required no_upperr js-padej_woo woo2" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';


$query_string.='<div style="margin-top: 30px;">';

      $query_string.='<div class="div_textarea_otziv1" ><label class="label_textarea">Организация в лице</label>
			<div class="otziv_add">';
                 
                   
        $query_string.='<textarea cols="10" rows="1" placeholder="" value="'.ipost_($row_score["organ_face"],"").'" id="otziv_area_adaxx244" name="offers[0][org_organ_face]" class="di text_area_otziv no_comment_bill22 js-padej_woo_end no_upperr">'.ipost_($row_score["organ_face"],"").'</textarea>';
				
            $query_string.='</div>      
</div>  

        <script type="text/javascript"> 
	  $(function (){ 
//$(\'#otziv_area_adaxx244\').autoResize({extraSpace : 10});
//$(\'.js-padej_woo_end\').trigger(\'keyup\');
padej_woo();
});

	</script>
	</div>';	
	 	 
	 
	 
  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Почтовый адрес</label><input name="offers[0][org_adress_post]" value="'.ipost_($row_score["adress_post"],"").'" id="date_124" class="input_new_2018 required no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';

$query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Юридический адрес</label><input name="offers[0][org_adress_ur]" value="'.ipost_($row_score["adress_ur"],"").'" id="date_124" class="input_new_2018 required no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';

	$query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>
Телефон</label><input name="offers[0][org_phone]" value="'.ipost_($row_score["phone"],"").'" id="date_124" class="input_new_2018 required no_upperr phone_us1" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';
	 
	 $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Email<span>*</span></label><input name="offers[0][org_email]" value="'.ipost_($row_score["email"],"").'" id="date_124" class="input_new_2018 required no_upperr gloab" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';

	
$query_string.='</div>
<div class="px_right">';


$query_string.='<div class="strong_wh">Контактная информация</div>';

  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Контактное лицо<span>*</span></label><input name="offers[0][org_contact_face]" value="'.ipost_($row_score["contact_face"],"").'" id="date_124" class="input_new_2018 required no_upperr gloab" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';

  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Должность конт. лица<span>*</span></label><input name="offers[0][org_head_contact_face]" value="'.ipost_($row_score["head_contact_face"],"").'" id="date_124" class="input_new_2018 required no_upperr gloab" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';

  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Телефон конт. лица<span>*</span></label><input name="offers[0][org_phone_contact]" value="'.ipost_($row_score["phone_contact"],"").'" id="date_124" class="input_new_2018 required no_upperr gloab phone_us1" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';

$query_string.='<div style="margin-top: 30px;">';

      $query_string.='<div class="div_textarea_otziv1" >
			<div class="otziv_add">';
                 
                   
        $query_string.='<textarea cols="10" rows="1" placeholder="Ваш комментарий" id="otziv_area_adaxx2" name="offers[0][org_comment]" class="di text_area_otziv no_comment_bill22 reda_org_comment">'.ipost_($row_score["comment"],"").'</textarea>';
				
            $query_string.='</div>      
</div>  

        <script type="text/javascript"> 
	  $(function (){ 
//$(\'#otziv_area_adaxx2\').autoResize({extraSpace : 10});
//$(\'#otziv_area_adaxx2\').trigger(\'keyup\');
});

	</script>
	</div>';




     $query_string.='<div style="margin-top: 30px;" class="strong_wh">Паспорт РФ Директора</div>';


     $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Адрес прописки</label><input name="offers[0][client_v_address]" value="'.ipost_($row_score["face_address"],"").'" id="date_124" class="input_new_2018 required  " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';


     $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Серия</label><input name="offers[0][client_v_seria]" value="'.ipost_($row_score["face_seria"],"").'" id="date_124" class="input_new_2018 required  " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';

     $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Номер</label><input name="offers[0][client_v_number]" value="'.ipost_($row_score["face_number"],"").'" id="date_124" class="input_new_2018 required  " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';

     $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Кем выдан</label><input name="offers[0][client_v_kem]" value="'.ipost_($row_score["face_kem"],"").'" id="date_124" class="input_new_2018 required  no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';

     $D_date_c = explode('-', $row_score["face_kogda"]);
     if($row_score["face_kogda"]!='0000-00-00')
     {
         $date_inn=$D_date_c[2].'.'.$D_date_c[1].'.'.$D_date_c[0];
     } else
     {
         $date_inn='';
     }

     $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Когда выдан</label><input name="offers[0][client_v_kogda]" value="'.ipost_($date_inn,"").'" id="date_124" class="input_new_2018 required   date_picker_x" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';




     $query_string.='</div>
</div>';



$query_string.='<div class="px_flex flex_edit_cb">';


$query_string.='<div class="px_left">';

$query_string.='<div class="strong_wh">Коды</div>';

$query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>ИНН</label><input name="offers[0][org_code_inn]" value="'.ipost_($row_score["code_inn"],"").'" id="date_124" class="input_new_2018 required  no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';	

  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>КПП</label><input name="offers[0][org_code_kpp]" value="'.ipost_($row_score["code_kpp"],"").'" id="date_124" class="input_new_2018 required no_upperr " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';	

  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>ОГРН</label><input name="offers[0][org_code_ogrn]" value="'.ipost_($row_score["code_ogrn"],"").'" id="date_124" class="input_new_2018 required no_upperr " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';

  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>ОКПО</label><input name="offers[0][org_code_okpo]" value="'.ipost_($row_score["code_okpo"],"").'" id="date_124" class="input_new_2018 required  no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';


	
$query_string.='</div>
<div class="px_right">';

$query_string.='<div class="strong_wh">Банковские реквизиты</div>';


  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>БИК</label><input name="offers[0][org_bank_bik]" value="'.ipost_($row_score["bank_bik"],"").'" id="date_124" class="input_new_2018 required  no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';	

  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>БАНК</label><input name="offers[0][org_bank_name]" value="'.ipost_($row_score["bank_name"],"").'" id="date_124" class="input_new_2018 required  no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';	

  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Р/С</label><input name="offers[0][org_bank_rs]" value="'.ipost_($row_score["bank_rs"],"").'" id="date_124" class="input_new_2018 required  no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';


  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Кор. счет</label><input name="offers[0][org_bank_ks]" value="'.ipost_($row_score["bank_ks"],"").'" id="date_124" class="input_new_2018 required no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';


	


$query_string.='</div>
</div>';



$query_string.='<div class="jkl_dd"><div class="center_vert" style="width: 100%;"><div class="add_cff12 js-save-info-org-cb">Сохранить изменения</div></div></div>';


$query_string.='</div>';

 }

$query_string.='<div class="jipp_fll_start">';

$query_string.='<div class="px_flex"><div class="px_left"><div class="strong_wh">Контактные данные</div>';
	



                                                              
                                                                                  		 			 		






$query_string.='<div class="pass_wh"><label>'.rooo($row_score["position"],'','Руководитель').'</label><span>'.rooo($row_score["head"],'','—').'</span></div>';	
	
	$query_string.='<div class="pass_wh"><label>Контактное лицо</label><span>'.rooo($row_score["contact_face"],'','—').'</span></div>';		
	
	$query_string.='<div class="pass_wh"><label>Должность контактного лица</label><span>'.rooo($row_score["head_contact_face"],'','—').'</span></div>';	

	$query_string.='<div class="pass_wh"><label>Почтовый адрес</label><span>'.rooo($row_score["adress_post"],'','—').'</span></div>';

	$query_string.='<div class="pass_wh"><label>Юридический адрес</label><span>'.rooo($row_score["adress_ur"],'','—').'</span></div>';


	$query_string.='</div><div class="px_right"><div class="strong_wh">Дополнительные данные</div>';
	
	$result_work_zz1=mysql_time_query($link,'Select a.name_user from r_user as a where a.id="'.$row_score["id_user"].'"');
	 
        $num_results_work_zz1 = $result_work_zz1->num_rows;
	    if($num_results_work_zz1!=0)
	    {
			$row_work_zz1 = mysqli_fetch_assoc($result_work_zz1);
		}
	$query_string.='<div class="pass_wh"><label>Менеджер</label><span>'.$row_work_zz1["name_user"].'</span></div>';
	
	$D = explode(' ', $row_score["datetimes"]);
	$query_string.='<div class="pass_wh"><label>Добавлен</label><span>'.MaskDate_D_M_Y_ss($D[0]).'</span></div>';
	
$query_string.='<div class="pass_wh"><label>Комментарий</label><span>'.rooo($row_score["comment"],'','—').'</span></div>';


$query_string.='<div class="strong_wh" style="margin-top: 30px;">Паспорт РФ Директора</div>';

$query_string.='<div class="pass_wh"><label>Адрес прописки</label><span>'.rooo($row_score["face_address"],'','—').'</span></div>';
$query_string.='<div class="pass_wh"><label>Серия</label><span>'.rooo($row_score["face_seria"],'','—').'</span></div>';
$query_string.='<div class="pass_wh"><label>Номер</label><span>'.rooo($row_score["face_number"],'','—').'</span></div>';
$query_string.='<div class="pass_wh"><label>Кем выдан</label><span>'.rooo($row_score["face_kem"],'','—').'</span></div>';
$query_string.='<div class="pass_wh"><label>Когда выдан</label><span>'.rooo(date_ex(0,$row_score["face_kogda"]),'','—').'</span></div>';

	
$query_string.='</div></div>';	
$query_string.='<div style="margin-top: 20px;" class="px_flex"><div class="px_left"><div class="strong_wh">Коды</div>';
	
$query_string.='<div class="pass_wh"><label>ИНН</label><span>'.rooo($row_score["code_inn"],'','—').'</span></div>';
$query_string.='<div class="pass_wh"><label>КПП</label><span>'.rooo($row_score["code_kpp"],'','—').'</span></div>';
$query_string.='<div class="pass_wh"><label>ОГРН</label><span>'.rooo($row_score["code_ogrn"],'','—').'</span></div>';
$query_string.='<div class="pass_wh"><label>ОКПО</label><span>'.rooo($row_score["code_okpo"],'','—').'</span></div>';
	
$query_string.='</div><div class="px_right"><div class="strong_wh">Банковские реквизиты</div>';	
$query_string.='<div class="pass_wh"><label>РАСЧЕТНЫЙ СЧЕТ</label><span>'.rooo($row_score["bank_rs"],'','—').'</span></div>';
$query_string.='<div class="pass_wh"><label>БИК</label><span>'.rooo($row_score["bank_bik"],'','—').'</span></div>';
$query_string.='<div class="pass_wh"><label>БАНК</label><span>'.rooo($row_score["bank_name"],'','—').'</span></div>';
$query_string.='<div class="pass_wh"><label>Кор. счет</label><span>'.rooo($row_score["bank_ks"],'','—').'</span></div>';		
$query_string.='</div></div>	
</div>';	
?>