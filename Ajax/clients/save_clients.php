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
	
if(!token_access_new($token,'bt_client_info',$id,"s_form"))
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

$result_t=mysql_time_query($link,'Select b.id,b.date_birthday from k_clients as b where b.id="'.htmlspecialchars(trim($_POST['id'])).'" and b.visible=1');
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
	/*      
$date_end1=explode(".",htmlspecialchars(trim($_POST['offers'][0]["client_date"])));	
$date_cl=$date_end1[2].'-'.$date_end1[1].'-'.$date_end1[0];
*/
	if(validateDate($_POST['offers'][0]["client_date"],'d.m.Y'))    
	{
       $date_end1=explode(".",htmlspecialchars(trim($_POST['offers'][0]["client_date"])));	
       $date_cl=$date_end1[2].'-'.$date_end1[1].'-'.$date_end1[0];
	}	


//+7 (902) 129-68-34
$phone_end='';

if(trim($_POST['offers'][0]["client_phone"])!='') {
    $phone_base = explode(" ", htmlspecialchars(trim($_POST['offers'][0]["client_phone"])));
    $phone_base1 = explode("-", $phone_base[2]);

    $phone_end = $phone_base[1][1] . $phone_base[1][2] . $phone_base[1][3] . $phone_base1[0] . $phone_base1[1] . $phone_base1[2];
}
/*
$date_end2=explode(".",htmlspecialchars(trim($_POST['offers'][0]["client_z_kogda"])));	
$date_cl1=$date_end2[2].'-'.$date_end2[1].'-'.$date_end2[0];

$date_end3=explode(".",htmlspecialchars(trim($_POST['offers'][0]["client_z_srok"])));	
$date_cl2=$date_end3[2].'-'.$date_end3[1].'-'.$date_end3[0];

$date_end4=explode(".",htmlspecialchars(trim($_POST['offers'][0]["client_v_kogda"])));	
$date_cl3=$date_end4[2].'-'.$date_end4[1].'-'.$date_end4[0];
*/
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



if($_POST['radio_potential']==0)
{
	
	
//смотрим есть ли уведомление день рождение и если есть и дата днюхи меняется удаляем уведомление
if($date_cl!=$row_score["date_birthday"])
{
$date_end_plus3=date_step_sql('Y-m-d','+0d');	
$result_ss = mysql_time_query($link,'SELECT A.id,A.id_user_responsible FROM task_new as A WHERE A.id_object="'.ht($row_score["id"]).'" and A.visible=1 and A.action="7" and A.status=0 and A.ring_datetime>="'.$date_end_plus3.' 00:00:00"');
	
	
        $num_ss = $result_ss->num_rows;	
        if($num_ss!=0)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);	
		   mysql_time_query($link,'delete FROM task_new where id="'.ht($row_ss["id"]).'"');  
		   UpdateTaskKey($row_ss["id_user_responsible"],$link);
		}
}
	

mysql_time_query($link,'update k_clients set

potential="0",
latin="'.htmlspecialchars(trim($_POST['offers'][0]["client_latin"])).'",
adress="'.htmlspecialchars(trim($_POST['offers'][0]["client_adress"])).'",
fio="'.htmlspecialchars(trim($_POST['offers'][0]["client_fio"])).'",
email="'.htmlspecialchars(trim($_POST['offers'][0]["client_email"])).'",
comment="'.htmlspecialchars(trim($_POST['offers'][0]["client_comment"])).'",
phone="'.$phone_end.'",
date_birthday="'.$date_cl.'",
pol="'.htmlspecialchars(trim($_POST['offers'][0]["pol"])).'",

inter_seria="'.htmlspecialchars(trim($_POST['offers'][0]["client_z_seria"])).'",
inter_number="'.htmlspecialchars(trim($_POST['offers'][0]["client_z_number"])).'",
inter_kem="'.htmlspecialchars(trim($_POST['offers'][0]["client_z_kem"])).'",
inter_kogda="'.$date_cl1.'",
inter_srok="'.$date_cl2.'",

inner_seria="'.htmlspecialchars(trim($_POST['offers'][0]["client_v_seria"])).'",
inner_number="'.htmlspecialchars(trim($_POST['offers'][0]["client_v_number"])).'",
inner_kem="'.htmlspecialchars(trim($_POST['offers'][0]["client_v_kem"])).'",
inner_kogda="'.$date_cl3.'"

where id = "'.htmlspecialchars($_POST['id']).'"');


//добавить особенности клиента	
//$_POST['options_b']

mysql_time_query($link,'delete FROM k_clients_options where id_k_clients="'.htmlspecialchars(trim($_POST['id'])).'"');


if($_POST['options_b']!='')
{	
	$c_op=explode(',',$_POST['options_b']);
	 for ($op=0; $op<count($c_op); $op++)
     {
	 mysql_time_query($link,'INSERT INTO k_clients_options (id_k_clients,id_option) VALUES ("'.htmlspecialchars(trim($_POST['id'])).'","'.htmlspecialchars(trim($c_op[$op])).'")');
	 }
			
}
} else {
    if($_POST['radio_potential']==1)
    {
    //потенциальный клиент
    mysql_time_query($link, 'update k_clients set

potential="1",
latin="",
adress="",
fio="' . htmlspecialchars(trim($_POST['offers'][0]["client_fio"])) . '",
email="' . htmlspecialchars(trim($_POST['offers'][0]["client_email"])) . '",
comment="' . htmlspecialchars(trim($_POST['offers'][0]["client_comment"])) . '",
phone="' . $phone_end . '",

inter_seria="",
inter_number="",
inter_kem="",


inner_seria="",
inner_number="",
inner_kem=""

where id = "' . htmlspecialchars($_POST['id']) . '"');

    mysql_time_query($link, 'delete FROM k_clients_options where id_k_clients="' . htmlspecialchars(trim($_POST['id'])) . '"');
} else
{
    //туристик летит с покупателем

    mysql_time_query($link, 'update k_clients set

potential="2",
latin="'.htmlspecialchars(trim($_POST['offers'][0]["client_latin"])).'",
adress="",
fio="' . htmlspecialchars(trim($_POST['offers'][0]["client_fio"])) . '",
email="",
comment="' . htmlspecialchars(trim($_POST['offers'][0]["client_comment"])) . '",
phone="' . $phone_end . '",
date_birthday="'.$date_cl.'",
pol="'.htmlspecialchars(trim($_POST['offers'][0]["pol"])).'",

inter_seria="'.htmlspecialchars(trim($_POST['offers'][0]["client_z_seria"])).'",
inter_number="'.htmlspecialchars(trim($_POST['offers'][0]["client_z_number"])).'",
inter_kem="'.htmlspecialchars(trim($_POST['offers'][0]["client_z_kem"])).'",
inter_kogda="'.$date_cl1.'",
inter_srok="'.$date_cl2.'",

inner_seria="'.htmlspecialchars(trim($_POST['offers'][0]["client_v_seria"])).'",
inner_number="'.htmlspecialchars(trim($_POST['offers'][0]["client_v_number"])).'",
inner_kem="'.htmlspecialchars(trim($_POST['offers'][0]["client_v_kem"])).'",
inner_kogda="'.$date_cl3.'"

where id = "' . htmlspecialchars($_POST['id']) . '"');

    mysql_time_query($link, 'delete FROM k_clients_options where id_k_clients="' . htmlspecialchars(trim($_POST['id'])) . '"');

}

}


end_code:

$aRes = array("debug" => $debug,"status"   => $status_ee,"status_echo"   => $status_echo,"count" => $dom,"for_id"=>$id,"id" => htmlspecialchars($id));
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>