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
	 
  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Телефон</label><input name="offers[0][org_phone]" value="" id="date_124" class="input_new_2018 required js-mask-input-tel" autocomplete="off" type="tel"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';


  $query_string.='<div style="margin-top: 30px;"><div class="input_2018"><label>Email<span>*</span></label><input name="offers[0][org_email]" value="" id="date_124" class="input_new_2018 required gloab no_upperr " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';


     if(($more_city==1)and($_COOKIE["cc_town".$id_user]==0)) {




         ?>

         <?

         $os_say55 = array();
         $os_id_say55 = array();
         $su_say55=-1;

         $query_string.='<div style="margin-top: 30px;" >	';

         $query_string.='<div class="left_drop menu1_prime"><label class="">Организация<span>*</span></label><div class="select eddd zin_2019"><a class="slct" list_number="t1" data_src=""></a><ul class="drop">';


         $result_8 = mysql_time_query($link,'Select a.name,a.id from a_company as a where a.id IN ('.$id_company_sql.')');

         $num_8 = $result_8->num_rows;
//$row_1 = mysqli_fetch_assoc($result2);
         if($result_8)
         {

             /*
                            $query_string.='<li class="sel_active"><a href="javascript:void(0);"  rel="'.$os_id_say55[array_search(1, $os_id_say55)].'">'.$os_say55[array_search(0, $os_id_say55)].'</a></li>';
             */

             while($row_8 = mysqli_fetch_assoc($result_8)){

                 if($su_say55==$row_8["id"])
                 {
                     $query_string.='<li class="sel_active"><a href="javascript:void(0);"  rel="'.$row_8["id"].'">'.$row_8["name"].'</a></li>';
                 } else
                 {
                     $query_string.='<li><a href="javascript:void(0);"  rel="'.$row_8["id"].'">'.$row_8["name"].'</a></li>';
                 }

             }
         }



         $query_string.='</ul><input type="hidden" class="gloab gloab_potential gloab_turist"  name="offers[0][id_company]" id="pol_clients4554" value=""><div class="div_new_2018"><hr class="one"></div></div></div></div>';
         //echo $query_string;


         ?>

         <?







     } else
     {

         $result_uuyyt = mysql_time_query($link, 'select name from a_company where id="' . ht($id_company) . '"');
         $num_results_uuyyt = $result_uuyyt->num_rows;

         if ($num_results_uuyyt != 0) {
             $row_uuyyt = mysqli_fetch_assoc($result_uuyyt);
         }


         $query_string.='<!--input start	-->	
        <div style="margin-top: 30px;" ><div class="input_2018"><label>Организация<span>*</span></label><input name="id_company_name" value="'.$row_uuyyt["name"].'" readonly id="date_124" class="input_new_2018 required    no_upperr" autocomplete="off" type="text"><input class="gloab gloab_potential gloab_turist" name="offers[0][id_company]" type="hidden" value="'.$id_company.'"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->	';

     }




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

 const phoneEl = $(\'.js-mask-input-tel\')[0];
     let phoneMask = IMask(phoneEl, {
         mask: \'{+7} (#00) 000-00-00\',
         definitions: {
             \'#\': /[012345679]/
         }
     });
 
if ($(\'.add-next-org\').length > 0) { $(\'[name=temp]\').val(1); }

});

	</script>';	 
	 
 }

?>