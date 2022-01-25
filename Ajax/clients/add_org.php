<?php
//добавить нового клиента
$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';
header("Content-type: application/json");

$temp='';
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
	
if(!token_access_new($token,'bt_client_add',$id,"s_form"))
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
 if ((!$role->permission('Клиенты','A'))and($sign_admin!=1))
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


//**************************************************
//**************************************************
//**************************************************
//**************************************************


$status_ee='ok';

//новый клиент
$id_user=id_key_crypt_encrypt($_SESSION["user_id"]);

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


$phone_basex=explode(" ",htmlspecialchars(trim($_POST['offers'][0]["org_phone_contact"])));	
$phone_basex1=explode("-",$phone_basex[2]);	

$phone_endx=$phone_basex[1][1].$phone_basex[1][2].$phone_basex[1][3].$phone_basex1[0].$phone_basex1[1].$phone_basex1[2];


if(validateDate($_POST['offers'][0]["client_v_kogda"],'d.m.Y'))
{
    $date_end4=explode(".",htmlspecialchars(trim($_POST['offers'][0]["client_v_kogda"])));
    $date_cl3=$date_end4[2].'-'.$date_end4[1].'-'.$date_end4[0];
} else
{
    $date_cl3='0000-00-00';
}

/*
INSERT INTO k_clients_commun (id,id_user,id_client,comment,datetimes,id_type_commun,visible,id_booking) VALUES ("","'.$id_user.'","'.htmlspecialchars($_GET['id']).'","'.htmlspecialchars($_GET['text']).'","'.date("y.m.d").' '.date("H:i:s").'","'.htmlspecialchars($_GET['type']).'","1","0")');
*/
			 $today[0] = date("y.m.d"); //присвоено 03.12.01
             $today[1] = date("H:i:s"); //присвоит 1 элементу массива 17:16:17

	         $date_=$today[0].' '.$today[1];


$org=$id_company;
if(is_numeric($_POST['offers'][0]["id_company"]))
    {
        $org=ht($_POST['offers'][0]["id_company"]);
    }

mysql_time_query($link,'INSERT INTO k_organization (id_a_company,id_user,name,head,position,organ_face,adress_post,adress_ur,phone,email,comment,contact_face,head_contact_face,phone_contact,code_inn,code_kpp,code_ogrn,code_okpo,bank_bik,bank_name,bank_rs,bank_ks,face_address,face_seria,face_number,face_kem,face_kogda,datetimes,visible) VALUES( 

"'.ht($org).'",
"'.ht($id_user).'",
"'.ht($_POST['offers'][0]["org_name"]).'",
"'.ht($_POST['offers'][0]["org_head"]).'",
"'.ht($_POST['offers'][0]["org_position"]).'",
"'.ht($_POST['offers'][0]["org_organ_face"]).'",
"'.ht($_POST['offers'][0]["org_adress_post"]).'",
"'.ht($_POST['offers'][0]["org_adress_ur"]).'",
"'.$phone_end.'",
"'.ht($_POST['offers'][0]["org_email"]).'",
"'.ht($_POST['offers'][0]["org_comment"]).'",
"'.ht($_POST['offers'][0]["org_contact_face"]).'",
"'.ht($_POST['offers'][0]["org_head_contact_face"]).'",
"'.$phone_endx.'",
"'.ht($_POST['offers'][0]["org_code_inn"]).'",
"'.ht($_POST['offers'][0]["org_code_kpp"]).'",
"'.ht($_POST['offers'][0]["org_code_ogrn"]).'",
"'.ht($_POST['offers'][0]["org_code_okpo"]).'",
"'.ht($_POST['offers'][0]["org_bank_bik"]).'",
"'.ht($_POST['offers'][0]["org_bank_name"]).'",
"'.ht($_POST['offers'][0]["org_bank_rs"]).'",
"'.ht($_POST['offers'][0]["org_bank_ks"]).'",
"'.ht($_POST['offers'][0]["client_v_address"]).'",
"'.ht($_POST['offers'][0]["client_v_seria"]).'",
"'.ht($_POST['offers'][0]["client_v_number"]).'",
"'.ht($_POST['offers'][0]["client_v_kem"]).'",
"'.$date_cl3.'",
"'.$date_.'",
"1")');


//добавить особенности клиента	
//$_POST['options_b']

$ID_N=mysqli_insert_id($link);  

if($_POST["temp"]==1)
{
$temp='';	
//формируем шаблон нового вывода
$result_t=mysql_time_query($link,'Select b.* from k_organization as b where b.id="'.ht($ID_N).'" and b.visible=1');
$num_results_t = $result_t->num_rows;
if($num_results_t!=0)
{	

	$row_8 = mysqli_fetch_assoc($result_t);
	
	$new_class_block='new-block';  //каким классом пометить новый блок-шаблон
    include_once $url_system.'clients/temp/output_org.php';
}
//формируем шаблон нового вывода
}

end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo"   => $status_echo,"count" => $dom,"for_id"=>$id,"id" => htmlspecialchars($ID_N),"temp"=>$temp);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>