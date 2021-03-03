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

	if(validateDate($_POST['offers'][0]["client_date"],'d.m.Y'))    
	{
       $date_end1=explode(".",htmlspecialchars(trim($_POST['offers'][0]["client_date"])));	
       $date_cl=$date_end1[2].'-'.$date_end1[1].'-'.$date_end1[0];
	}

	
//+7 (902) 129-68-34
$phone_base=explode(" ",htmlspecialchars(trim($_POST['offers'][0]["client_phone"])));	
$phone_base1=explode("-",$phone_base[2]);	

$phone_end=	$phone_base[1][1].$phone_base[1][2].$phone_base[1][3].$phone_base1[0].$phone_base1[1].$phone_base1[2];



	if(validateDate($_POST['offers'][0]["client_z_kogda"],'d.m.Y'))    
	{
	  $date_end2=explode(".",htmlspecialchars(trim($_POST['offers'][0]["client_z_kogda"])));
      $date_cl1=$date_end2[2].'-'.$date_end2[1].'-'.$date_end2[0];
	} else
	{
		$date_cl1='0000-00-00';
	}
	if(validateDate($_POST['offers'][0]["client_z_srok"],'d.m.Y'))    
	{
$date_end3=explode(".",htmlspecialchars(trim($_POST['offers'][0]["client_z_srok"])));	
$date_cl2=$date_end3[2].'-'.$date_end3[1].'-'.$date_end3[0];
	} else
	{
		$date_cl2='0000-00-00';
	}
	if(validateDate($_POST['offers'][0]["client_v_kogda"],'d.m.Y'))    
	{
$date_end4=explode(".",htmlspecialchars(trim($_POST['offers'][0]["client_v_kogda"])));	
$date_cl3=$date_end4[2].'-'.$date_end4[1].'-'.$date_end4[0];
	} else
	{
		$date_cl3='0000-00-00';
	}
/*
$date_end2=explode(".",htmlspecialchars(trim($_POST['offers'][0]["client_z_kogda"])));	
$date_cl1=$date_end2[2].'-'.$date_end2[1].'-'.$date_end2[0];

$date_end3=explode(".",htmlspecialchars(trim($_POST['offers'][0]["client_z_srok"])));	
$date_cl2=$date_end3[2].'-'.$date_end3[1].'-'.$date_end3[0];

$date_end4=explode(".",htmlspecialchars(trim($_POST['offers'][0]["client_v_kogda"])));	
$date_cl3=$date_end4[2].'-'.$date_end4[1].'-'.$date_end4[0];
*/
/*
INSERT INTO k_clients_commun (id,id_user,id_client,comment,datetimes,id_type_commun,visible,id_booking) VALUES ("","'.$id_user.'","'.htmlspecialchars($_GET['id']).'","'.htmlspecialchars($_GET['text']).'","'.date("y.m.d").' '.date("H:i:s").'","'.htmlspecialchars($_GET['type']).'","1","0")');
*/
			 $today[0] = date("y.m.d"); //присвоено 03.12.01
             $today[1] = date("H:i:s"); //присвоит 1 элементу массива 17:16:17

	         $date_=$today[0].' '.$today[1];

$code=1;
	$result_tcc=mysql_time_query($link,'Select max(b.code) as cc from k_clients as b');
           $num_results_tcc = $result_tcc->num_rows;
	       if($num_results_tcc!=0)
	       {	
			 
			 $row_tcc = mysqli_fetch_assoc($result_tcc);
			  $code= (int)$row_tcc["cc"]+1;
		   }	

if($_POST['radio_potential']==0)
{
//не потенциальный клиент
mysql_time_query($link,'INSERT INTO k_clients (id_a_company,code,potential,latin,adress,id_company,id_user,fio,phone,email,date_birthday,datetime,comment,inter_seria,inter_number,inter_kem,inter_kogda,inter_srok,inner_seria,inner_number,inner_kem,inner_kogda,visible,pol) VALUES( 
"'.ht($id_company).'","'.ht($code).'","0","'.ht($_POST['offers'][0]["client_latin"]).'",
"'.ht($_POST['offers'][0]["client_adress"]).'","0",
"'.ht($id_user).'",
"'.ht($_POST['offers'][0]["client_fio"]).'",
"'.$phone_end.'",
"'.ht($_POST['offers'][0]["client_email"]).'",
"'.$date_cl.'",
"'.$date_.'",
"'.ht($_POST['offers'][0]["client_comment"]).'",
"'.ht($_POST['offers'][0]["client_z_seria"]).'",
"'.ht($_POST['offers'][0]["client_z_number"]).'",
"'.ht($_POST['offers'][0]["client_z_kem"]).'",
"'.$date_cl1.'",
"'.$date_cl2.'",
"'.ht($_POST['offers'][0]["client_v_seria"]).'",
"'.ht($_POST['offers'][0]["client_v_number"]).'",
"'.ht($_POST['offers'][0]["client_v_kem"]).'",
"'.$date_cl3.'",
"1",
"'.ht($_POST['offers'][0]["pol"]).'")');


//добавить особенности клиента	
//$_POST['options_b']

$ID_N=mysqli_insert_id($link);  


if($_POST['options_b']!='')
{	
	$c_op=explode(',',$_POST['options_b']);
	 for ($op=0; $op<count($c_op); $op++)
     {
	 mysql_time_query($link,'INSERT INTO k_clients_options (id_k_clients,id_option) VALUES ("'.$ID_N.'","'.ht($c_op[$op]).'")');
	 }
			
}
}

if($_POST['radio_potential']==1)
{
	//потенциальный клиент
	mysql_time_query($link,'INSERT INTO k_clients (id_a_company,code,potential,latin,adress,id_company,id_user,fio,phone,email,date_birthday,datetime,comment,inter_seria,inter_number,inter_kem,inter_kogda,inter_srok,inner_seria,inner_number,inner_kem,inner_kogda,visible,pol) VALUES( 
"'.ht($id_company).'","'.ht($code).'","1","",
"","0",
"'.ht($id_user).'",
"'.ht($_POST['offers'][0]["client_fio"]).'",
"'.$phone_end.'",
"'.ht($_POST['offers'][0]["client_email"]).'",
"",
"'.$date_.'",
"'.ht($_POST['offers'][0]["client_comment"]).'",
"",
"",
"",
"",
"",
"",
"",
"",
"",
"1","1")');


//добавить особенности клиента	
//$_POST['options_b']

$ID_N=mysqli_insert_id($link); 
}

if($_POST['radio_potential']==2)
{
    //турист летит с покупателем
    mysql_time_query($link,'INSERT INTO k_clients (id_a_company,code,potential,latin,adress,id_company,id_user,fio,phone,email,date_birthday,datetime,comment,inter_seria,inter_number,inter_kem,inter_kogda,inter_srok,inner_seria,inner_number,inner_kem,inner_kogda,visible,pol) VALUES( 
"'.ht($id_company).'","'.ht($code).'","2","'.ht($_POST['offers'][0]["client_latin"]).'",
"","0",
"'.ht($id_user).'",
"'.ht($_POST['offers'][0]["client_fio"]).'",
"",
"",
"'.$date_cl.'",
"'.$date_.'",
"'.ht($_POST['offers'][0]["client_comment"]).'",
"'.ht($_POST['offers'][0]["client_z_seria"]).'",
"'.ht($_POST['offers'][0]["client_z_number"]).'",
"'.ht($_POST['offers'][0]["client_z_kem"]).'",
"'.$date_cl1.'",
"'.$date_cl2.'",
"'.ht($_POST['offers'][0]["client_v_seria"]).'",
"'.ht($_POST['offers'][0]["client_v_number"]).'",
"'.ht($_POST['offers'][0]["client_v_kem"]).'",
"'.$date_cl3.'",
"1","'.ht($_POST['offers'][0]["pol"]).'")');


//добавить особенности клиента
//$_POST['options_b']

    $ID_N=mysqli_insert_id($link);
}


if($_POST["temp"]==1)
{
$temp='';	
//формируем шаблон нового вывода
$result_t=mysql_time_query($link,'Select b.* from k_clients as b where b.id="'.ht($ID_N).'" and b.visible=1');
$num_results_t = $result_t->num_rows;
if($num_results_t!=0)
{	

	$row_8 = mysqli_fetch_assoc($result_t);
	
	$new_class_block='new-block';  //каким классом пометить новый блок-шаблон
	if($_POST['radio_potential']==0)
	{
    include_once $url_system.'clients/temp/output_user.php';
	}

    if(($_POST['radio_potential']==1)or($_POST['radio_potential']==2))
	{
	include_once $url_system.'clients/temp/output_poten.php';	
	}
}
//формируем шаблон нового вывода
}

end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo"   => $status_echo,"count" => $dom,"for_id"=>$id,"id" => htmlspecialchars($ID_N),"temp"=>$temp,"poten"=>$_POST['radio_potential']);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>