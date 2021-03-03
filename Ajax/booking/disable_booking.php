<?php
//получение материалов из счета при выборе текущего счета
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
$token=htmlspecialchars($_GET['tk']);

$id=htmlspecialchars($_GET['id']);
$dom=0;
$status_echo='';
//проверка что есть такой город что это число
//проверка что пользователь зарегистрирован

$echo_r=0; //выводить или нет ошибку 0 -нет
$debug='';

//**************************************************
	
if(!token_access_new($token,'disable_booking_xx',$id,"s_form"))
{
   $debug=h4a(100,$echo_r,$debug);
   goto end_code;
}
	
	
	
if ( count($_GET) != 3 ) 
{
   $debug=h4a(1,$echo_r,$debug);
   goto end_code;	
}
//**************************************************

//**************************************************
 if(!isset($_SESSION["user_id"]))
{ 
  $status_ee='reg';	
  $debug=h4a(3,$echo_r,$debug);
  goto end_code;
}
//**************************************************
if ((!isset($_GET["id"]))) 
{
   $debug=h4a(4,$echo_r,$debug);
   goto end_code;	
}
//**************************************************
$result_t=mysql_time_query($link,'Select b.id,b.id_user,b.status from booking as b where b.id="'.htmlspecialchars(trim($_GET['id'])).'"');

$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{	
		$debug=h4a(5,$echo_r,$debug);
		goto end_code;
	
} else
{
	$row_score = mysqli_fetch_assoc($result_t);
	/*
	if($row_score["status"]!=3)
	{
		$debug=h4a(8,$echo_r,$debug);
		goto end_code;		
	}
	*/
}

if($sign_admin!=1)
{
	$debug=h4a(8,$echo_r,$debug);
	goto end_code;	
}
//**************************************************
//**************************************************
//**************************************************
//**************************************************


$status_ee='ok';

//mysql_time_query($link,'delete FROM booking_offers where id="'.htmlspecialchars(trim($_GET['id'])).'"');
//mysql_time_query($link,'delete FROM z_invoice_material where id_invoice="'.htmlspecialchars(trim($_GET['id'])).'"');
//mysql_time_query($link,'delete FROM z_invoice_attach where id_invoice="'.htmlspecialchars(trim($_GET['id'])).'"');


//смотрим какой статус был до это статуса
$result_status22=mysql_time_query($link,'SELECT a.status FROM booking_status_history AS a WHERE not(a.status=7) and not(a.status=3) and a.id_booking="'.htmlspecialchars(trim($_GET['id'])).'" order by A.datetime DESC limit 1,1');	
					 //echo('SELECT a.* FROM r_status AS a WHERE a.numer_status="'.$row1ss["status"].'" and a.id_system=13');
if($result_status22->num_rows!=0)
{  
    $row_status22 = mysqli_fetch_assoc($result_status22);
} 


mysql_time_query($link,'update booking set status="'.$row_status22["status"].'" where id = "'.htmlspecialchars($_GET['id']).'"');

mysql_time_query($link,'INSERT INTO booking_status_history (id_booking,id_user,datetime,status) VALUES ("'.htmlspecialchars($_GET['id']).'","'.$id_user.'","'.date("y.m.d").' '.date("H:i:s").'","7")');
//изменение статуса добавление в историю

//отправляем уведомление что отменена покупка
				  //добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде	
				  $user_send= array();	
				  $user_send_new= array();		

                 // $user_send_new=array_merge($hie->boss['4']);
array_push($user_send_new,$row_score["id_user"]);
   //создателя договора	
		$text_not='<a href="booking/'.$_GET['id'].'/">Заявка №'.$_GET['id'].'</a> была отменена.';
        $user_send_new= array_unique($user_send_new);	
		notification_send($text_not,$user_send_new,$id_user,$link);
			 
    //добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде	


end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo"   => $status_echo,"count" => $dom,"echo"=>$echo,"options" => 0);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>