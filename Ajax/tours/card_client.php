<?php
//получение карточки клиента
$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';
header("Content-type: application/json");
$query_string='';
$query_string_xx='';
$query_string_xx1='';
$status_ee='error';
$eshe=0;
$echo='';
$vid=0;
$debug='';
$count_all_all=0;
$basket='';
$token=htmlspecialchars($_GET['tk']);
$disco=0;
$id=htmlspecialchars($_GET['id']);
$dom=0;
$status_echo='';
//проверка что есть такой город что это число
//проверка что пользователь зарегистрирован

$echo_r=0; //выводить или нет ошибку 0 -нет
$debug='';

//**************************************************
	/*
if(!token_access_new($token,'bt_booking_end_client',$id,"s_form"))
{
   $debug=h4a(100,$echo_r,$debug);
   goto end_code;
}
*/	
	
	
if ( count($_GET) != 6 ) 
{
   $debug=h4a(1,$echo_r,$debug);
   goto end_code;	
}

//**************************************************
 if ((!$role->permission('Туры','A'))and($sign_admin!=1))
{
  $debug=h4a(2,$echo_r,$debug);
  goto end_code;	
}
//**************************************************
 if(!isset($_SESSION["user_id"]))
{ 
  $status_ee='reg';	
  $debug=h4a(3,$echo_r,$debug);
  goto end_code;
}
//**************************************************
if ((!isset($_GET['type'])))
{
   $debug=h4a(4,$echo_r,$debug);
   goto end_code;	
}

if((isset($_GET["tabs"]))and($_GET["tabs"]==1))
{
	 if (is_numeric($_GET['id_tabs'])) {
		 //нужна одна карточка по клиенту
$result_t=mysql_time_query($link,'Select a.fio,a.id,a.code,a.latin,a.date_birthday,a.inter_seria,a.inter_number,a.inter_kem,a.inter_kogda,a.inter_srok,a.inner_seria,a.inner_number,a.inner_kem,a.inner_kogda,a.pol from k_clients as a where a.visible=1 and ((a.potential=0)or(a.potential=2)) and a.id="'.ht($_GET['id_tabs']).'" and a.id_a_company IN ('.ht($id_company).')');

//echo('Select b.*,r.id_company from k_clients as b,r_user as r where b.id="'.ht($_GET['id']).'" and b.visible=1 and b.id_user=r.id');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{	
		$debug=h4a(5,$echo_r,$debug);
		goto end_code;
	
} else
{
	$row_t = mysqli_fetch_assoc($result_t);
}
} else
	 {
		 //нужно несколько карточек по клиентам сразу
		 
		 
		 
	 }
}
if((isset($_GET["tabs"]))and($_GET["tabs"]==2))
{
$result_t=mysql_time_query($link,'Select a.* from k_organization as a where a.visible=1 and a.id="'.ht($_GET['id_tabs']).'" and a.id_a_company IN ('.ht($id_company).')');

//echo('Select b.*,r.id_company from k_clients as b,r_user as r where b.id="'.ht($_GET['id']).'" and b.visible=1 and b.id_user=r.id');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{	
		$debug=h4a(5,$echo_r,$debug);
		goto end_code;
	
} else
{
	$row_t = mysqli_fetch_assoc($result_t);
}
}

$status_ee='ok';



if($_GET['type']==1)
{
	//карточка для покупателя+туриста если покупатель частное лицо
	if($_GET['tabs']==1)
    {
		//частное лицо
$query_string_xx='<div class="info-client-ruler active-turist-turs" type_co="1" id_rules="'.$row_t["id"].'">
	
	<div class="font-ranks js-dell-buy-tours" data-tooltip="Удалить" id_rel="'.$row_t["id"].'"><span class="font-ranks-inner">_</span><div></div></div>';

	
	$query_string_xx.='<div class="sourse_1"><span class="span-44">1</span></div><div class="flex_sourse">';
	
	$pol="<span class='pol-card js-glu-pol-".$row_t["id"]."' data-tooltip='мистер'>(MR)</span>";	
		if($row_t["pol"]==2)
		{
			$pol="<span class='pol-card js-glu-pol-".$row_t["id"]."' data-tooltip='миссис'>(MRS)</span>";	
		}
		
	$query_string_xx.='<div class="name_docu"><span class="js-client js-glu-f-'.$row_t["id"].'" iod="'.$row_t["id"].'">'.$row_t["fio"].'</span>'.$pol.'</div>
	<div class="global_docu">
<div class="left_gl"><div class="icc_gl_1 js-glu-latin-'.$row_t["id"].'">'.rooo($row_t["latin"],'','—').'</div></div>';
		
	$date_bb='—';
	if($row_t["date_birthday"]!='0000-00-00')
	{
 $razn_d=dateDiff_F(date("y-m-d").' '.date("H:i:s"),$row_t["date_birthday"]." 00:00:00");	
		
		$date_start1=explode("-",htmlspecialchars(trim($row_t["date_birthday"])));
				  
				   $startxr=$date_start1[2].'.'.$date_start1[1].'.'.$date_start1[0];
		$date_bb=$startxr.' ('.$razn_d.' '.PadejNumber($razn_d,'год,года,лет').')';
	}	
		
$query_string_xx.='<div class="right_gl"><div class="icc_gl_2 js-glu-d-'.$row_t["id"].'">'.$date_bb.'</div></div>		
</div>	
	
	<div class="px_bg">	
		
	<div class="px_flex"><div class="px_left"><div class="strong_wh">Заграничный паспорт</div><div class="pass_wh">';
	
	if(($row_t["inter_seria"].$row_t["inter_number"].$row_t["inter_kem"]=='')and($row_t["inter_kogda"]=='0000-00-00')and($row_t["inter_srok"]=='0000-00-00'))
	{
		
	$query_string_xx.='<span class="label-filled-int-'.$row_t["id"].'" style="display:none;"><label><span class="js-glu-ints-'.$row_t["id"].'">—</span> <span class="js-glu-intn-'.$row_t["id"].'">—</span></label>
	<label>Выдан <span class="js-glu-intk-'.$row_t["id"].'">—</span></label>
	<label><span class="js-glu-intko-'.$row_t["id"].'">—</span> / <span class="js-glu-intd-'.$row_t["id"].'">—</span></label></span>';		
		
		$query_string_xx.='<span class="label-empty-int-'.$row_t["id"].'"><label>—</label></span>';
	} else
	{
	
	$query_string_xx.='<span class="label-filled-int-'.$row_t["id"].'"><label><span class="js-glu-ints-'.$row_t["id"].'">'.rooo($row_t["inter_seria"],'','—').'</span> <span class="js-glu-intn-'.$row_t["id"].'">'.rooo($row_t["inter_number"],'','—').'</span></label>
	<label>Выдан <span class="js-glu-intk-'.$row_t["id"].'">'.rooo($row_t["inter_kem"],'','—').'</span></label>
	<label><span class="js-glu-intko-'.$row_t["id"].'">'.rooo(MaskDate_D_M_Y_ss($row_t["inter_kogda"]),'00.00.0000','—').'</span> / <span class="js-glu-intd-'.$row_t["id"].'">'.rooo(MaskDate_D_M_Y_ss($row_t["inter_srok"]),'00.00.0000','—').'</span></label></span>';
		$query_string_xx.='<span class="label-empty-int-'.$row_t["id"].'" style="display:none;"><label>—</label></span>';
	}
	
	$query_string_xx.='</div></div><div class="px_right"><div class="strong_wh">Внутренний паспорт</div><div class="pass_wh">';
	if(($row_t["inner_seria"].$row_t["inner_number"].$row_t["inner_kem"]=='')and($row_t["inner_kogda"]=='0000-00-00'))
	{
		
	$query_string_xx.='<span class="label-filled-inn-'.$row_t["id"].'" style="display:none;"><label><span class="js-glu-ines-'.$row_t["id"].'">—</span> <span class="js-glu-inen-'.$row_t["id"].'">—</span></label>
	<label>Выдан <span class="js-glu-inek-'.$row_t["id"].'">—</span></label>
	<label><span class="js-glu-ineko-'.$row_t["id"].'">—</span></label></span>';		
		
		$query_string_xx.='<span class="label-empty-inn-'.$row_t["id"].'"><label>—</label></span>';
	} else
	{	
	
	$query_string_xx.='<span class="label-filled-inn-'.$row_t["id"].'"><label><span class="js-glu-ines-'.$row_t["id"].'">'.rooo($row_t["inner_seria"],'','—').'</span> <span class="js-glu-inen-'.$row_t["id"].'">'.rooo($row_t["inner_number"],'','—').'</span></label>
	<label>Выдан <span class="js-glu-inek-'.$row_t["id"].'">'.rooo($row_t["inner_kem"],'','—').'</span></label>
	<label><span class="js-glu-ineko-'.$row_t["id"].'">'.rooo(MaskDate_D_M_Y_ss($row_t["inner_kogda"]),'00.00.0000','—').'</span></label></span>';
		
	$query_string_xx.='<span class="label-empty-inn-'.$row_t["id"].'" style="display:none;"><label>—</label></span>';	
		
	}
	
	$query_string_xx.='</div></div></div>	
		
	</div>	
		</div>
	
		
<div class="loli_turs1">	
<div class="loli_turs">
<div class="input-choice-click-pass js-loli-butt ">
<div class="choice-radio"><div class="center_vert1"><i class=""></i></div></div>
<div class="choice-head">Не летит, только покупает тур</div>

</div>	
<input name="radio_password" value="0" type="hidden">	
</div>
</div>		
</div>';
		

		
		
	}
	if($_GET['tabs']==2)
    {
		//организация
		$query_string_xx.='<div class="info-client-ruler " type_co="2" id_rules="'.$row_t["id"].'">
	
	<div class="font-ranks js-dell-buy-tours" data-tooltip="Удалить" id_rel="'.$row_t["id"].'"><span class="font-ranks-inner">_</span><div></div></div>';

	
	$query_string_xx.='<div class="flex_sourse mappi_sourse">';
	
	$query_string_xx.='<div class="name_docu"><span class="js-org js-glo-n-'.$row_t["id"].'" iod="'.$row_t["id"].'">'.$row_t["name"].'</span><div class="code_clients"></div></div>
	<div class="global_docu">
<div class="left_gl">';
		
		 $phone_format='+7 ('.$row_t["phone_contact"][0].$row_t["phone_contact"][1].$row_t["phone_contact"][2].') '.$row_t["phone_contact"][3].$row_t["phone_contact"][4].$row_t["phone_contact"][5].'-'.$row_t["phone_contact"][6].$row_t["phone_contact"][7].'-'.$row_t["phone_contact"][8].$row_t["phone_contact"][9];	
		
		$query_string_xx.='<div class="icc_gl_3 js-glo-t-'.$row_t["id"].'" data-tooltip="Телефон контактного лица">'.$phone_format.'</div></div>';
		
	
		
$query_string_xx.='<div class="right_gl"><div class="icc_gl_4 js-glo-e-'.$row_t["id"].'">'.rooo($row_score["email"],'','—').'</div></div>		
</div>	
	
	<div class="px_bg">	
		
	<div class="px_flex"><div class="px_left"><div class="strong_wh">Коды</div><div class="pass_wh">';
	
	if(($row_t["code_inn"].$row_t["code_kpp"].$row_t["code_ogrn"].$row_t["code_okpo"]==''))
	{
		$query_string_xx.='<span class="label-filled-code-'.$row_t["id"].'" style="display:none;"><label data-tooltip="ИНН"><span class="js-glo-in-'.$row_t["id"].'">—</span></label>
	<label data-tooltip="КПП"><span class="js-glo-kp-'.$row_t["id"].'">—</span></label>
	<label data-tooltip="ОГРН"><span class="js-glo-og-'.$row_t["id"].'">—</span></label>
	<label data-tooltip="ОКПО"><span class="js-glo-ok-'.$row_t["id"].'">—</span></label></span>';	
		$query_string_xx.='<span class="label-empty-code-'.$row_t["id"].'"><label>—</label></span>';
	} else
	{
	
	$query_string_xx.='<span class="label-filled-code-'.$row_t["id"].'"><label data-tooltip="ИНН"><span class="js-glo-in-'.$row_t["id"].'">'.rooo($row_t["code_inn"],'','—').'</span></label>
	<label data-tooltip="КПП"><span class="js-glo-kp-'.$row_t["id"].'">'.rooo($row_t["code_kpp"],'','—').'</span></label>
	<label data-tooltip="ОГРН"><span class="js-glo-og-'.$row_t["id"].'">'.rooo($row_t["code_ogrn"],'','—').'</span></label>
	<label data-tooltip="ОКПО"><span class="js-glo-ok-'.$row_t["id"].'">'.rooo($row_t["code_okpo"],'','—').'</span></label></span>';
		
	$query_string_xx.='<span class="label-empty-code-'.$row_t["id"].'" style="display:none;"><label>—</label></span>';	
		
	}
	
	$query_string_xx.='</div></div><div class="px_right"><div class="strong_wh">Банковские реквизиты</div><div class="pass_wh">';
	if($row_t["bank_rs"].$row_t["bank_bik"].$row_t["bank_name"].$row_t["bank_ks"]=='')
	{
		$query_string_xx.='<span class="label-filled-rek-'.$row_t["id"].'" style="display:none;"><label data-tooltip="РАСЧЕТНЫЙ СЧЕТ"><span class="js-glo-rs-'.$row_t["id"].'">—</span></label>
	<label data-tooltip="БИК"><span class="js-glo-bi-'.$row_t["id"].'">—</span></label>
	<label data-tooltip="БАНК"><span class="js-glo-ba-'.$row_t["id"].'">—</span></label>
	<label data-tooltip="Кор. счет"><span class="js-glo-ko-'.$row_t["id"].'">—</span></label></span>';
		
		$query_string_xx.='<span class="label-empty-rek-'.$row_t["id"].'"><label>—</label></span>';
	} else
	{	
	
	$query_string_xx.='<span class="label-filled-rek-'.$row_t["id"].'"><label data-tooltip="РАСЧЕТНЫЙ СЧЕТ"><span class="js-glo-rs-'.$row_t["id"].'">'.rooo($row_t["bank_rs"],'','—').'</span></label>
	<label data-tooltip="БИК"><span class="js-glo-bi-'.$row_t["id"].'">'.rooo($row_t["bank_bik"],'','—').'</span></label>
	<label data-tooltip="БАНК"><span class="js-glo-ba-'.$row_t["id"].'">'.rooo($row_t["bank_name"],'','—').'</span></label>
	<label data-tooltip="Кор. счет"><span class="js-glo-ko-'.$row_t["id"].'">'.rooo($row_t["bank_ks"],'','—').'</span></label></span>';

	$query_string_xx.='<span class="label-empty-rek-'.$row_t["id"].'" style="display:none;"><label>—</label></span>';			
	}
	
	$query_string_xx.='</div></div></div>	
		
	</div>	
		</div>
			
</div>';
		
	}	
	
	
	
} else
{
	
 if (is_numeric($_GET['id_tabs'])) {
	 
 
	
	//карточка для туриста
$query_string_xx1.='<div class="info-client-ruler active-turist-turs" type_co="1" id_rules="'.$row_t["id"].'">
	
	<div class="font-ranks js-dell-fly-tours" data-tooltip="Удалить" id_rel="'.$row_t["id"].'"><span class="font-ranks-inner">_</span><div></div></div>';
	
	$query_string_xx1.='<div class="sourse_1"><span class="span-44"></span></div><div class="flex_sourse">';
	
	 	$pol="<span class='pol-card js-glu-pol-".$row_t["id"]."' data-tooltip='мистер'>(MR)</span>";	
		if($row_t["pol"]==2)
		{
			$pol="<span class='pol-card js-glu-pol-".$row_t["id"]."' data-tooltip='миссис'>(MRS)</span>";	
		}
	
	$query_string_xx1.='<div class="name_docu"><span class="js-client js-glu-f-'.$row_t["id"].'" iod="'.$row_t["id"].'">'.$row_t["fio"].'</span>'.$pol.'</div>
	<div class="global_docu">
<div class="left_gl"><div class="icc_gl_1 js-glu-latin-'.$row_t["id"].'">'.rooo($row_t["latin"],'','—').'</div></div>';
		
	$date_bb='—';
	if($row_t["date_birthday"]!='0000-00-00')
	{
 $razn_d=dateDiff_F(date("y-m-d").' '.date("H:i:s"),$row_t["date_birthday"]." 00:00:00");	
		
		$date_start1=explode("-",htmlspecialchars(trim($row_t["date_birthday"])));
				  
				   $startxr=$date_start1[2].'.'.$date_start1[1].'.'.$date_start1[0];
		$date_bb=$startxr.' ('.$razn_d.' '.PadejNumber($razn_d,'год,года,лет').')';
	}	
		
$query_string_xx1.='<div class="right_gl"><div class="icc_gl_2 js-glu-d-'.$row_t["id"].'">'.$date_bb.'</div></div>		
</div>	
	
	<div class="px_bg">	
		
	<div class="px_flex"><div class="px_left"><div class="strong_wh">Заграничный паспорт</div><div class="pass_wh">';
	
	if(($row_t["inter_seria"].$row_t["inter_number"].$row_t["inter_kem"]=='')and($row_t["inter_kogda"]=='0000-00-00')and($row_t["inter_srok"]=='0000-00-00'))
	{
		
	$query_string_xx1.='<span class="label-filled-int-'.$row_t["id"].'" style="display:none;"><label><span class="js-glu-ints-'.$row_t["id"].'">—</span> <span class="js-glu-intn-'.$row_t["id"].'">—</span></label>
	<label>Выдан <span class="js-glu-intk-'.$row_t["id"].'">—</span></label>
	<label><span class="js-glu-intko-'.$row_t["id"].'">—</span> / <span class="js-glu-intd-'.$row_t["id"].'">—</span></label></span>';		
		
		$query_string_xx1.='<span class="label-empty-int-'.$row_t["id"].'"><label>—</label></span>';
	} else
	{
	
	$query_string_xx1.='<span class="label-filled-int-'.$row_t["id"].'"><label><span class="js-glu-ints-'.$row_t["id"].'">'.rooo($row_t["inter_seria"],'','—').'</span> <span class="js-glu-intn-'.$row_t["id"].'">'.rooo($row_t["inter_number"],'','—').'</span></label>
	<label>Выдан <span class="js-glu-intk-'.$row_t["id"].'">'.rooo($row_t["inter_kem"],'','—').'</span></label>
	<label><span class="js-glu-intko-'.$row_t["id"].'">'.rooo(MaskDate_D_M_Y_ss($row_t["inter_kogda"]),'00.00.0000','—').'</span> / <span class="js-glu-intd-'.$row_t["id"].'">'.rooo(MaskDate_D_M_Y_ss($row_t["inter_srok"]),'00.00.0000','—').'</span></label></span>';
		$query_string_xx1.='<span class="label-empty-int-'.$row_t["id"].'" style="display:none;"><label>—</label></span>';
	}
	
	$query_string_xx1.='</div></div><div class="px_right"><div class="strong_wh">Внутренний паспорт</div><div class="pass_wh">';
	if(($row_t["inner_seria"].$row_t["inner_number"].$row_t["inner_kem"]=='')and($row_t["inner_kogda"]=='0000-00-00'))
	{
		
	$query_string_xx1.='<span class="label-filled-inn-'.$row_t["id"].'" style="display:none;"><label><span class="js-glu-ines-'.$row_t["id"].'">—</span> <span class="js-glu-inen-'.$row_t["id"].'">—</span></label>
	<label>Выдан <span class="js-glu-inek-'.$row_t["id"].'">—</span></label>
	<label><span class="js-glu-ineko-'.$row_t["id"].'">—</span></label></span>';		
		
		$query_string_xx1.='<span class="label-empty-inn-'.$row_t["id"].'"><label>—</label></span>';
	} else
	{	
	
	$query_string_xx1.='<span class="label-filled-inn-'.$row_t["id"].'"><label><span class="js-glu-ines-'.$row_t["id"].'">'.rooo($row_t["inner_seria"],'','—').'</span> <span class="js-glu-inen-'.$row_t["id"].'">'.rooo($row_t["inner_number"],'','—').'</span></label>
	<label>Выдан <span class="js-glu-inek-'.$row_t["id"].'">'.rooo($row_t["inner_kem"],'','—').'</span></label>
	<label><span class="js-glu-ineko-'.$row_t["id"].'">'.rooo(MaskDate_D_M_Y_ss($row_t["inner_kogda"]),'00.00.0000','—').'</span></label></span>';
		
	$query_string_xx1.='<span class="label-empty-inn-'.$row_t["id"].'" style="display:none;"><label>—</label></span>';	
		
	}
	
	$query_string_xx1.='</div></div></div>	
		
	</div>	
		</div>
		
</div>';			
	
	
} else
 {
	//сразу несколько карточек
	 
	 
	 $c_op=explode(',',$_GET['id_tabs']);
	 for ($op=0; $op<count($c_op); $op++)
     {
	  if (is_numeric($c_op[$op])) {
		  $result_t=mysql_time_query($link,'Select a.fio,a.id,a.code,a.latin,a.date_birthday,inter_seria,inter_number,inter_kem,inter_kogda,inter_srok,inner_seria,inner_number,inner_kem,inner_kogda from k_clients as a where a.visible=1 and ((a.potential=0)or(a.potential=2)) and a.id="'.ht($c_op[$op]).'" and a.id_a_company IN ('.ht($id_company).')');
		  $num_results_t = $result_t->num_rows;
if($num_results_t==0)
{	
		$debug=h4a(5,$echo_r,$debug);
		goto end_code;
	
} else
{
	$row_t = mysqli_fetch_assoc($result_t);
}
		  
	if($op!=0)
	{
		$query_string_xx1.='/2/';
	}
	
	//карточка для туриста
$query_string_xx1.='<div class="info-client-ruler active-turist-turs" type_co="1" id_rules="'.$row_t["id"].'">
	
	<div class="font-ranks js-dell-fly-tours" data-tooltip="Удалить" id_rel="'.$row_t["id"].'"><span class="font-ranks-inner">_</span><div></div></div>';
	
	$query_string_xx1.='<div class="sourse_1"><span class="span-44"></span></div><div class="flex_sourse">';
		 	
		  $pol="<span class='pol-card js-glu-pol-".$row_t["id"]."' data-tooltip='мистер'>(MR)</span>";	
		if((isset($row_t["pol"]))and($row_t["pol"]==2))
		{
			$pol="<span class='pol-card js-glu-pol-".$row_t["id"]."' data-tooltip='миссис'>(MRS)</span>";	
		}
	
	
	$query_string_xx1.='<div class="name_docu"><span class="js-client js-glu-f-'.$row_t["id"].'" iod="'.$row_t["id"].'">'.$row_t["fio"].'</span>'.$pol.'</div>
	<div class="global_docu">
<div class="left_gl"><div class="icc_gl_1 js-glu-latin-'.$row_t["id"].'">'.rooo($row_t["latin"],'','—').'</div></div>';
		
	$date_bb='—';
	if($row_t["date_birthday"]!='0000-00-00')
	{
 $razn_d=dateDiff_F(date("y-m-d").' '.date("H:i:s"),$row_t["date_birthday"]." 00:00:00");	
		
		$date_start1=explode("-",htmlspecialchars(trim($row_t["date_birthday"])));
				  
				   $startxr=$date_start1[2].'.'.$date_start1[1].'.'.$date_start1[0];
		$date_bb=$startxr.' ('.$razn_d.' '.PadejNumber($razn_d,'год,года,лет').')';
	}	
		
$query_string_xx1.='<div class="right_gl"><div class="icc_gl_2 js-glu-d-'.$row_t["id"].'">'.$date_bb.'</div></div>		
</div>	
	
	<div class="px_bg">	
		
	<div class="px_flex"><div class="px_left"><div class="strong_wh">Заграничный паспорт</div><div class="pass_wh">';
	
	if(($row_t["inter_seria"].$row_t["inter_number"].$row_t["inter_kem"]=='')and($row_t["inter_kogda"]=='0000-00-00')and($row_t["inter_srok"]=='0000-00-00'))
	{
		
	$query_string_xx1.='<span class="label-filled-int-'.$row_t["id"].'" style="display:none;"><label><span class="js-glu-ints-'.$row_t["id"].'">—</span> <span class="js-glu-intn-'.$row_t["id"].'">—</span></label>
	<label>Выдан <span class="js-glu-intk-'.$row_t["id"].'">—</span></label>
	<label><span class="js-glu-intko-'.$row_t["id"].'">—</span> / <span class="js-glu-intd-'.$row_t["id"].'">—</span></label></span>';		
		
		$query_string_xx1.='<span class="label-empty-int-'.$row_t["id"].'"><label>—</label></span>';
	} else
	{
	
	$query_string_xx1.='<span class="label-filled-int-'.$row_t["id"].'"><label><span class="js-glu-ints-'.$row_t["id"].'">'.rooo($row_t["inter_seria"],'','—').'</span> <span class="js-glu-intn-'.$row_t["id"].'">'.rooo($row_t["inter_number"],'','—').'</span></label>
	<label>Выдан <span class="js-glu-intk-'.$row_t["id"].'">'.rooo($row_t["inter_kem"],'','—').'</span></label>
	<label><span class="js-glu-intko-'.$row_t["id"].'">'.rooo(MaskDate_D_M_Y_ss($row_t["inter_kogda"]),'00.00.0000','—').'</span> / <span class="js-glu-intd-'.$row_t["id"].'">'.rooo(MaskDate_D_M_Y_ss($row_t["inter_srok"]),'00.00.0000','—').'</span></label></span>';
		$query_string_xx1.='<span class="label-empty-int-'.$row_t["id"].'" style="display:none;"><label>—</label></span>';
	}
	
	$query_string_xx1.='</div></div><div class="px_right"><div class="strong_wh">Внутренний паспорт</div><div class="pass_wh">';
	if(($row_t["inner_seria"].$row_t["inner_number"].$row_t["inner_kem"]=='')and($row_t["inner_kogda"]=='0000-00-00'))
	{
		
	$query_string_xx1.='<span class="label-filled-inn-'.$row_t["id"].'" style="display:none;"><label><span class="js-glu-ines-'.$row_t["id"].'">—</span> <span class="js-glu-inen-'.$row_t["id"].'">—</span></label>
	<label>Выдан <span class="js-glu-inek-'.$row_t["id"].'">—</span></label>
	<label><span class="js-glu-ineko-'.$row_t["id"].'">—</span></label></span>';		
		
		$query_string_xx1.='<span class="label-empty-inn-'.$row_t["id"].'"><label>—</label></span>';
	} else
	{	
	
	$query_string_xx1.='<span class="label-filled-inn-'.$row_t["id"].'"><label><span class="js-glu-ines-'.$row_t["id"].'">'.rooo($row_t["inner_seria"],'','—').'</span> <span class="js-glu-inen-'.$row_t["id"].'">'.rooo($row_t["inner_number"],'','—').'</span></label>
	<label>Выдан <span class="js-glu-inek-'.$row_t["id"].'">'.rooo($row_t["inner_kem"],'','—').'</span></label>
	<label><span class="js-glu-ineko-'.$row_t["id"].'">'.rooo(MaskDate_D_M_Y_ss($row_t["inner_kogda"]),'00.00.0000','—').'</span></label></span>';
		
	$query_string_xx1.='<span class="label-empty-inn-'.$row_t["id"].'" style="display:none;"><label>—</label></span>';	
		
	}
	
	$query_string_xx1.='</div></div></div>	
		
	</div>	
		</div>
		
</div>';			
		  
		  
	  }
	 }
	
	 
	 
 }
	
}













end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo"   => $status_echo,"query" => $query_string,"echo"=>$query_string_xx,"echo1"=>$query_string_xx1,"id_tabs"=>$_GET["id_tabs"],"tabs"=>$_GET["tabs"]);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>