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
	
if(!token_access_new($token,'bt_booking_end_client',$id,"s_form"))
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
 if ((!$role->permission('Заявки','A'))and($sign_admin!=1))
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
if (((!isset($_POST["id"])))or((!isset($_POST['client_new_search']))))
{
   $debug=h4a(4,$echo_r,$debug);
   goto end_code;	
}

//**************************************************
$result_t=mysql_time_query($link,'Select b.id_user,b.status,b.ready,b.id_object from booking as b where b.id="'.htmlspecialchars(trim($_POST['id'])).'"');
           $num_results_t = $result_t->num_rows;
	       if($num_results_t!=0)
	       {	
			 
			 $row_t = mysqli_fetch_assoc($result_t);
		   
		     //проверяем может ли видеть этот наряд
	if($row_t["status"]==3)
	{
				    $debug=h4a(5,$echo_r,$debug);
   goto end_code;	
			 }
			   
		   } else
		   {
			      $debug=h4a(6,$echo_r,$debug);
   goto end_code;	
		   }
	if((array_search($row_t["id_object"],$hie_object) === false)and($sign_admin!=1))
	{
		goto end_code;	
	}
	if(($row_t["ready"]!=1))
	{
		goto end_code;	
	}$result_t1=mysql_time_query($link,'Select count(b.id) as cc from booking_offers as b where b.id_booking="'.htmlspecialchars(trim($_POST['id'])).'" and b.status=2');
           $num_results_t1 = $result_t1->num_rows;
	       if($num_results_t1!=0)
	       {	
			 
			 $row_t1 = mysqli_fetch_assoc($result_t1);
			 if($row_t1["cc"]==0)
			 {
 $debug=h4a(6121,$echo_r,$debug);
   goto end_code; 
			 }
		   } else
		   {
			  			      $debug=h4a(611,$echo_r,$debug);
   goto end_code; 
		   }
//**************************************************
//**************************************************
//**************************************************
//**************************************************


$status_ee='ok';

if($_POST['client_new_search']==0)
{
	//новый клиент
	

	
	
$flag_podpis=0;
$count_offers=0;

$result_t12=mysql_time_query($link,'Select count(b.id) as cc from booking_offers as b where b.id_booking="'.htmlspecialchars(trim($_POST['id'])).'" and b.status="2"');
$num_results_t12 = $result_t12->num_rows;
if($num_results_t12!=0)
{	
	$row_score12 = mysqli_fetch_assoc($result_t12);
	if($row_score12["cc"]==0)
	{
		$flag_podpis++;
	}
} else
{
	$flag_podpis++;
}

if($flag_podpis!=0)
{
   $debug=h4a(6314,$echo_r,$debug);
   goto end_code; 
}


//mysql_time_query($link,'update booking set status="3" where id = "'.htmlspecialchars($_POST['id']).'"');
//изменение статуса добавление в историю
	      
$date_end1=explode(".",htmlspecialchars(trim($_POST['offers'][0]["client_date"])));	
$date_cl=$date_end1[2].'-'.$date_end1[1].'-'.$date_end1[0];
	
//+7 (902) 129-68-34
$phone_base=explode(" ",htmlspecialchars(trim($_POST['offers'][0]["client_phone"])));	
$phone_base1=explode("-",$phone_base[2]);	

$phone_end=	$phone_base[1][1].$phone_base[1][2].$phone_base[1][3].$phone_base1[0].$phone_base1[1].$phone_base1[2];


	$result_tcc=mysql_time_query($link,'Select max(b.code) as cc from k_clients as b');
           $num_results_tcc = $result_tcc->num_rows;
	       if($num_results_tcc!=0)
	       {	
			 
			 $row_tcc = mysqli_fetch_assoc($result_tcc);
			  $code= (int)$row_tcc["cc"]+1;
		   }
	
	
mysql_time_query($link,'INSERT INTO k_clients (code,id_company,id_user,company,fio,phone,email,date_birthday,datetime,comment,visible) VALUES ("'.$code.'",0,"'.$id_user.'","'.htmlspecialchars($_POST['offers'][0]["client_company"]).'","'.ucwords(mb_strtolower(htmlspecialchars($_POST['offers'][0]["client_fio"]),"utf-8")).'","'.htmlspecialchars($phone_end).'","'.htmlspecialchars($_POST['offers'][0]["client_email"]).'","'.htmlspecialchars($date_cl).'","'.date("y.m.d").' '.date("H:i:s").'","'.htmlspecialchars($_POST['offers'][0]["client_comment"]).'","1")');
//изменение статуса добавление в историю
$ID_N=mysqli_insert_id($link); 
mysql_time_query($link,'update booking set id_client="'.$ID_N.'" where id = "'.htmlspecialchars($_POST['id']).'"');


//добавить особенности клиента	
//$_POST['options_b']
if($_POST['options_b']!='')
{	
	$c_op=explode(',',$_POST['options_b']);
	 for ($op=0; $op<count($c_op); $op++)
     {
	 mysql_time_query($link,'INSERT INTO k_clients_options (id_k_clients,id_option) VALUES ("'.$ID_N.'","'.htmlspecialchars(trim($c_op[$op])).'")');
	 }
			
}

} 
else
{
	//связать с клиентом
	
if (((!isset($_POST["id_search_client"])))or(($_POST['id_search_client']==0)))
{
   $debug=h4a(4333,$echo_r,$debug);
   goto end_code;	
}	
	
	mysql_time_query($link,'update booking set id_client="'.htmlspecialchars($_POST['id_search_client']).'" where id = "'.htmlspecialchars($_POST['id']).'"');
	
}

end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo"   => $status_echo,"count" => $dom,"for_id"=>$id,"options" => htmlspecialchars($_POST['offers'][0]["options"]));
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>