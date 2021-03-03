<?php
//связываем клиента с заявкой
$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';
header("Content-type: application/json");

$status_ee='error';
$eshe=0;
$echo='';
$vid=0;
$debug='';
$count_all_all=0;
$basket='';
$token=htmlspecialchars($_POST['tk']);
$disco=0;

$id=htmlspecialchars($_POST['id']);
$dom=0;
$status_echo='';
//проверка что есть такой город что это число
//проверка что пользователь зарегистрирован

$echo_r=1; //выводить или нет ошибку 0 -нет
$debug='';

//**************************************************
	
if(!token_access_new($token,'bt_org_info',$id,"s_form"))
{
   $debug=h4a(100,$echo_r,$debug);
   goto end_code;
}
	
	
	/*
if ( count($_GET) != 4 ) 
{
   $debug=h4a(1,$echo_r,$debug);
   goto end_code;	
}
*/
//**************************************************
 if ((!$role->permission('Клиенты','U'))and($sign_admin!=1))
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
if ((!isset($_POST["id"])))
{
   $debug=h4a(4,$echo_r,$debug);
   goto end_code;	
}

$result_t=mysql_time_query($link,'Select b.id from k_organization as b where b.id="'.htmlspecialchars(trim($_POST['id'])).'" and b.visible=1');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{	
		$debug=h4a(5,$echo_r,$debug);
		goto end_code;
	
} else
{
	$row_score = mysqli_fetch_assoc($result_t);
}



//**************************************************
//**************************************************
//**************************************************
//**************************************************


$status_ee='ok';

//новый клиент


//mysql_time_query($link,'update booking set status="3" where id = "'.htmlspecialchars($_POST['id']).'"');
//изменение статуса добавление в историю
	      
	
//+7 (902) 129-68-34

if((isset($_POST['offers'][0]["org_phone"]))and($_POST['offers'][0]["org_phone"]!=''))
{
  $phone_base=explode(" ",htmlspecialchars(trim($_POST['offers'][0]["org_phone"])));	
  $phone_base1=explode("-",$phone_base[2]);	
  $phone_end=	$phone_base[1][1].$phone_base[1][2].$phone_base[1][3].$phone_base1[0].$phone_base1[1].$phone_base1[2];
} else
{
	$phone_end='';
}
/*
$phone_base=explode(" ",htmlspecialchars(trim($_POST['offers'][0]["org_phone"])));	
$phone_base1=explode("-",$phone_base[2]);	



$phone_end=	$phone_base[1][1].$phone_base[1][2].$phone_base[1][3].$phone_base1[0].$phone_base1[1].$phone_base1[2];
*/

$phone_baseh=explode(" ",htmlspecialchars(trim($_POST['offers'][0]["org_phone_contact"])));	
$phone_base1h=explode("-",$phone_baseh[2]);	

$phone_endh=	$phone_baseh[1][1].$phone_baseh[1][2].$phone_baseh[1][3].$phone_base1h[0].$phone_base1h[1].$phone_base1h[2];


if(validateDate($_POST['offers'][0]["client_v_kogda"],'d.m.Y'))
{
    $date_end4=explode(".",htmlspecialchars(trim($_POST['offers'][0]["client_v_kogda"])));
    $date_cl3=$date_end4[2].'-'.$date_end4[1].'-'.$date_end4[0];
} else
{
    $date_cl3='0000-00-00';
}

mysql_time_query($link,'update k_organization set 

name="'.ht($_POST['offers'][0]["org_name"]).'",
head="'.ht($_POST['offers'][0]["org_head"]).'",
position="'.ht($_POST['offers'][0]["org_position"]).'",
organ_face="'.ht($_POST['offers'][0]["org_organ_face"]).'",
adress_post="'.ht($_POST['offers'][0]["org_adress_post"]).'",
adress_ur="'.ht($_POST['offers'][0]["org_adress_ur"]).'",
comment="'.ht($_POST['offers'][0]["org_comment"]).'",
contact_face="'.ht($_POST['offers'][0]["org_contact_face"]).'",
head_contact_face="'.ht($_POST['offers'][0]["org_head_contact_face"]).'",
email="'.ht($_POST['offers'][0]["org_email"]).'",

phone="'.$phone_end.'",
phone_contact="'.$phone_endh.'",

code_inn="'.ht($_POST['offers'][0]["org_code_inn"]).'",
code_kpp="'.ht($_POST['offers'][0]["org_code_kpp"]).'",
code_ogrn="'.ht($_POST['offers'][0]["org_code_ogrn"]).'",
code_okpo="'.ht($_POST['offers'][0]["org_code_okpo"]).'",

bank_bik="'.ht($_POST['offers'][0]["org_bank_bik"]).'",
bank_name="'.ht($_POST['offers'][0]["org_bank_name"]).'",
bank_rs="'.ht($_POST['offers'][0]["org_bank_rs"]).'",
bank_ks="'.ht($_POST['offers'][0]["org_bank_ks"]).'",
face_address="'.ht($_POST['offers'][0]["client_v_address"]).'",
face_seria="'.ht($_POST['offers'][0]["client_v_seria"]).'",
face_number="'.ht($_POST['offers'][0]["client_v_number"]).'",
face_kem="'.ht($_POST['offers'][0]["client_v_kem"]).'",
face_kogda="'.$date_cl3.'"
where id = "'.ht($_POST['id']).'"');


//добавить особенности клиента	
//$_POST['options_b']





end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo"   => $status_echo,"count" => $dom,"for_id"=>$id,"id" => htmlspecialchars($id));
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>