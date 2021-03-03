<?php
//отметить задачу как выполненная
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
	
if(!token_access_new($token,'yes_task_xx',$id,"s_form"))
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
 if ((!$role->permission('Задачи','U'))and($sign_admin!=1))
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
$result_t=mysql_time_query($link,'Select b.id,b.id_user,b.click,b.status,b.title,b.id_object from task as b where b.id="'.htmlspecialchars(trim($_GET['id'])).'"');
           $num_results_t = $result_t->num_rows;
	       if($num_results_t!=0)
	       {	
			 
			 $row_t = mysqli_fetch_assoc($result_t);
		   
if($row_t["status"]!=0)
	{
		$debug=h4a(8,$echo_r,$debug);
		goto end_code;		
	}
		if($row_t["click"]!=1)
	{
		$debug=h4a(8,$echo_r,$debug);
		goto end_code;		
	}
			   
		   } else
		   {
			      $debug=h4a(6,$echo_r,$debug);
   goto end_code;	
		   }
	if((array_search($row_t["id_object"],$hie_object) === false)and($sign_admin!=1)and($row_t["id_user"]!=$id_user))
	{
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


mysql_time_query($link,'update task set status="1" where id = "'.htmlspecialchars($row_t["id"]).'"');

mysql_time_query($link,'INSERT INTO task_status_history (id_task,id_user,datetime,status) VALUES ("'.htmlspecialchars($row_t["id"]).'","'.$id_user.'","'.date("y.m.d").' '.date("H:i:s").'","1")');

//отправляем руководителю что задача была выполнена

if($sign_admin!=1)
{
//добавляем уведомления 
//добавляем уведомления 
//добавляем уведомления 	
$user_send= array();	
$user_send_new= array();		

$user_send_new=array_merge($hie->boss['4']);


	$result_txs=mysql_time_query($link,'Select a.name_user,a.timelast,a.id from r_user as a where a.id="'.$id_user.'"');
	            if($result_txs->num_rows!=0)
	            {   
		          $rowxs = mysqli_fetch_assoc($result_txs);
				
				}

$text_not=$rowxs["name_user"].' выполнил следующую задачу - '.$row_t["title"];
$user_send_new= array_unique($user_send_new);	
notification_send($text_not,$user_send_new,$id_user,$link);	 
//добавляем уведомления 
//добавляем уведомления 
//добавляем уведомления 
	
}

end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo"   => $status_echo,"count" => $dom,"echo"=>$echo);
/*
require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);

?>