<?php
//изменение статуса заявки на перезвонить
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
	
if(!token_access_new($token,'call_bookings_xx',$id,"s_form"))
{
   $debug=h4a(100,$echo_r,$debug);
   goto end_code;
}
	
	
	
if ( count($_GET) != 5 ) 
{
   $debug=h4a(1,$echo_r,$debug);
   goto end_code;	
}
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
if ((!isset($_GET["id"]))) 
{
   $debug=h4a(4,$echo_r,$debug);
   goto end_code;	
}
//**************************************************
$result_t=mysql_time_query($link,'Select b.id_user,b.status,b.id_object from booking as b where b.id="'.htmlspecialchars(trim($_GET['id'])).'"');
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

//**************************************************
//**************************************************
//**************************************************
//**************************************************


$status_ee='ok';

mysql_time_query($link,'update booking set status="2" where id = "'.htmlspecialchars($_GET['id']).'"');


//изменение статуса добавление в историю

$date_phone='';
//htmlspecialchars($_GET['date']).' '.htmlspecialchars($_GET['time']).':00
if(htmlspecialchars($_GET['date'])!='')
{
$date_phone=htmlspecialchars($_GET['date']).' '.htmlspecialchars($_GET['time']).':00';
} 

//изменение статуса добавление в историю	       
mysql_time_query($link,'INSERT INTO booking_status_history (id_booking,id_user,datetime,status,date) VALUES ("'.htmlspecialchars($_GET['id']).'","'.$id_user.'","'.date("y.m.d").' '.date("H:i:s").'","2","'.$date_phone.'")');


//если предыдущий статус был перезвонить по заявке и был не выполнен то убираем из задач это
if($row_t["status"]==2)
{
	mysql_time_query($link,'update task set status="1" where action=3 and id_booking = "'.htmlspecialchars($_GET['id']).'" and status=0');
}


if(dateDiff_1(date("y-m-d").' '.date("H:i:s"),$date_phone)==0)
{
//если перезвонить сегодня добавляем задачу
$text_task="Перезвонить по заявке №".htmlspecialchars($_GET['id']);

$object_send_task= array();

array_push($object_send_task,$row_t["id_object"]);
/*
if($id_user!=$row_t["id_user"])
{
array_push($user_send_task,$row_t["id_user"]);
}
*/
$object_send_task= array_unique($object_send_task);	

TASK_SEND($text_task,$object_send_task,$_GET['id'],0,3,$link);
}


			      //добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде	
				  $user_send= array();	
				  $user_send_new= array();		

                  $user_send_new=array_merge($hie->boss['4']);

   //создателя договора	
		$text_not='<a href="booking/'.$_GET['id'].'/">Заявка №'.$_GET['id'].'</a> изменила свой статус на - необходимо перезвонить по заявке.';
        $user_send_new= array_unique($user_send_new);	
		notification_send($text_not,$user_send_new,$id_user,$link);
			 
    //добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде	


end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo"   => $status_echo,"count" => $dom,"echo"=>$echo);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>