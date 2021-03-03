<?
 if (($role->permission('Клиенты','A'))or($sign_admin==1))
{
$query_string='<div class="jipp_fll" style="display:block;"><div class="px_flex flex_edit_cb">';

//$query_string.='<div class="essa_b"><div class="strong_wh">Основные данные</div></div>';

$query_string.='<div class="px_left">';

$query_string.='<div class="strong_wh">Основные данные</div>';
	 
$query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Наименование<span>*</span></label><input name="offers[0][org_name]" value="" id="date_124" class="input_new_2018 required  gloab no_upperr " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';	

  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>ФИО Руководителя</label><input name="offers[0][org_head]" value="" id="date_124" class="input_new_2018 required no_upperr js-padej_woo woo1" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';	

  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Должность</label><input name="offers[0][org_position]" value="директор" id="date_124" class="input_new_2018 no_upperr required js-padej_woo woo2" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';	
	/* 
  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Организация в лице</label><input name="offers[0][org_organ_face]" value="" id="date_124" class="input_new_2018 required js-padej_woo_end" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';
	 */
	 
$query_string.='<div style="margin-top: 30px;">';

      $query_string.='<div class="div_textarea_otziv1" ><label class="label_textarea">Организация в лице</label>
			<div class="otziv_add">';
                 
                   
        $query_string.='<textarea cols="10" rows="1" placeholder="" id="otziv_area_adaxx24" name="offers[0][org_organ_face]" class="di text_area_otziv no_comment_bill22 js-padej_woo_end no_upperr"></textarea>';
				
            $query_string.='</div>      
</div>  

        <script type="text/javascript"> 
	  $(function (){ 
$(\'#otziv_area_adaxx24\').autoResize({extraSpace : 10});
$(\'.js-padej_woo_end\').trigger(\'keyup\');
padej_woo();
});

	</script>
	</div>';	
	 
	 
	 
  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Почтовый адрес</label><input name="offers[0][org_adress_post]" value="" id="date_124" class="input_new_2018 required no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';	
	 
  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Юридический адрес</label><input name="offers[0][org_adress_ur]" value="" id="date_124" class="input_new_2018 required no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';	 
	 
  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Телефон</label><input name="offers[0][org_phone]" value="" id="date_124" class="input_new_2018 required phone_us1" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';


  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Email<span>*</span></label><input name="offers[0][org_email]" value="" id="date_124" class="input_new_2018 required gloab no_upperr " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';

	
$query_string.='</div>
<div class="px_right">';


$query_string.='<div class="strong_wh">
Контактная информация</div>';

  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Контактное лицо<span>*</span></label><input name="offers[0][org_contact_face]" value="" id="date_124" class="input_new_2018 required gloab no_upperr " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';

  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Должность конт. лица<span>*</span></label><input name="offers[0][org_head_contact_face]" value="" id="date_124" class="input_new_2018 required gloab no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';

  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Телефон конт. лица<span>*</span></label><input name="offers[0][org_phone_contact]" value="" id="date_124" class="input_new_2018 required  gloab phone_us1" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';
	 

$query_string.='<div style="margin-top: 30px;">';

      $query_string.='<div class="div_textarea_otziv1" >
			<div class="otziv_add">';
                 
                   
        $query_string.='<textarea cols="10" rows="1" placeholder="Ваш комментарий" id="otziv_area_adaxx200" name="offers[0][org_comment]" class="di text_area_otziv no_comment_bill22 no_upperr js-padej_woo_end12"></textarea>';
				
            $query_string.='</div>      
</div>  

        <script type="text/javascript"> 
	  $(function (){ 
$(\'#otziv_area_adaxx200\').autoResize({extraSpace : 10});
$(\'.js-padej_woo_end12\').trigger(\'keyup\');
});

	</script>
	</div>';





     $query_string.='<div style="margin-top: 30px;" class="strong_wh">Паспорт РФ Директора</div>';


     $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Адрес прописки</label><input name="offers[0][client_v_address]" value="" id="date_124" class="input_new_2018 required  " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';


     $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Серия</label><input name="offers[0][client_v_seria]" value="" id="date_124" class="input_new_2018 required  " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';

     $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Номер</label><input name="offers[0][client_v_number]" value="" id="date_124" class="input_new_2018 required  " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';

     $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Кем выдан</label><input name="offers[0][client_v_kem]" value="" id="date_124" class="input_new_2018 required  no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';

     $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Когда выдан</label><input name="offers[0][client_v_kogda]" value="" id="date_124" class="input_new_2018 required  date_picker_x" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';





$query_string.='</div>
</div>';



$query_string.='<div class="px_flex flex_edit_cb">';


$query_string.='<div class="px_left">';

$query_string.='<div class="strong_wh">Коды</div>';

$query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>ИНН</label><input name="offers[0][org_code_inn]" value="" id="date_124" class="input_new_2018 required  " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';	

  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>КПП</label><input name="offers[0][org_code_kpp]" value="" id="date_124" class="input_new_2018 required  " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';	

  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>ОГРН</label><input name="offers[0][org_code_ogrn]" value="" id="date_124" class="input_new_2018 required no_upperr " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';

  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>ОКПО</label><input name="offers[0][org_code_okpo]" value="" id="date_124" class="input_new_2018 required no_upperr " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';


	
$query_string.='</div>
<div class="px_right">';

$query_string.='<div class="strong_wh">Банковские реквизиты</div>';


  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>БИК</label><input name="offers[0][org_bank_bik]" value="" id="date_124" class="input_new_2018 required  " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';	

  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Банк</label><input name="offers[0][org_bank_name]" value="" id="date_124" class="input_new_2018 required  " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';	

  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Р/с</label><input name="offers[0][org_bank_rs]" value="" id="date_124" class="input_new_2018 required  no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';
	 
  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Кор. счет</label><input name="offers[0][org_bank_ks]" value="" id="date_124" class="input_new_2018 required  no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';
	 




	


$query_string.='</div>
</div>';




$query_string.='<div class="jkl_dd"><div class="center_vert" style="width: 100%;"><div class="add_cff12 js-add-org-cb">Добавить организацию</div></div></div>';


$query_string.='</div>';

	 
$query_string.='<script type="text/javascript"> 
	  $(function (){ 


if ($(\'.add-next-org\').length > 0) { $(\'[name=temp]\').val(1); }

});

	</script>';	 
	 
 }

?>