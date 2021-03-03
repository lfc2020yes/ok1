<?php
//отменить или наоборот убрать "Забрать задачу на себя"
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
//$token=htmlspecialchars($_GET['tk']);

$id=htmlspecialchars($_GET['id']);
$dom=0;
$status_echo='';
//проверка что есть такой город что это число
//проверка что пользователь зарегистрирован

$echo_r=0; //выводить или нет ошибку 0 -нет
$debug='';

//**************************************************
/*	
if(!token_access_new($token,'yes_task_xx',$id,"s_form"))
{
   $debug=h4a(100,$echo_r,$debug);
   goto end_code;
}
*/	
	
	
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
$result_t=mysql_time_query($link,'Select b.* from task_new as b where b.id="'.htmlspecialchars(trim($_GET['id'])).'"');
           $num_results_t = $result_t->num_rows;
	       if($num_results_t!=0)
	       {	
			 
			 $row_t = mysqli_fetch_assoc($result_t);
		   
if($row_t["status"]!=0)
	{
		$debug=h4a(8,$echo_r,$debug);
		goto end_code;		
	}


$mas_responsible=explode(",",$row_t["id_user_responsible"]);
if (!in_array($id_user, $mas_responsible)) 
{
	$debug=h4a(789,$echo_r,$debug);
    goto end_code;			
}

			   if($row_t["myself"]!=0)
			   {
				   
				   if($row_t["myself"]!=$id_user)
				   {
					   	$debug=h4a(790,$echo_r,$debug);
                        goto end_code;	
				   }
				   
			   }
			   
			   
			   
		   } else
		   {
			      $debug=h4a(6,$echo_r,$debug);
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

if ($_GET["choice"]==1)
{
mysql_time_query($link,'update task_new set myself="'.ht($id_user).'" where id = "'.ht($row_t["id"]).'"');
	

//добавляем уведомления 
//добавляем уведомления 
//добавляем уведомления 	
$user_send= array();	
$user_send_new= array();		

//$user_send_new=array_merge($hie->boss['4']);
//те кому была дана задача если она общая+ тот кто давал задачу - тот кто ее сейчас выполнил	
$user_send_new=explode(",",$row_t["id_user_responsible"]);	
array_push($user_send_new,$row_t["id_user"]); 	
	//$user_send_new
	rm_from_array(0,$user_send_new);
	rm_from_array($id_user,$user_send_new);
	$user_send_new= array_unique($user_send_new);
	
	$result_txs=mysql_time_query($link,'Select a.name_user,a.timelast,a.id from r_user as a where a.id="'.$id_user.'"');
	            if($result_txs->num_rows!=0)
	            {   
		          $rowxs = mysqli_fetch_assoc($result_txs);
				
				}

$text_not=$rowxs["name_user"].' решил(а) выполнить общую задача <span class="js-taa a-noti-link" id_task="'.$row_t["id"].'">№'.$row_t["id"].'</span>. Цель задачи - '.ht($row_t['comment']);
notification_send($text_not,$user_send_new,$id_user,$link);	 
//добавляем уведомления 
//добавляем уведомления 
//добавляем уведомления 	
	
	
}
if ($_GET["choice"]==0)
{
mysql_time_query($link,'update task_new set myself="0" where id = "'.ht($row_t["id"]).'"');
	

//добавляем уведомления 
//добавляем уведомления 
//добавляем уведомления 	
$user_send= array();	
$user_send_new= array();		

//$user_send_new=array_merge($hie->boss['4']);
//те кому была дана задача если она общая+ тот кто давал задачу - тот кто ее сейчас выполнил	
$user_send_new=explode(",",$row_t["id_user_responsible"]);	
array_push($user_send_new,$row_t["id_user"]); 	
	//$user_send_new
	rm_from_array(0,$user_send_new);
	rm_from_array($id_user,$user_send_new);
	$user_send_new= array_unique($user_send_new);
	
	$result_txs=mysql_time_query($link,'Select a.name_user,a.timelast,a.id from r_user as a where a.id="'.$id_user.'"');
	            if($result_txs->num_rows!=0)
	            {   
		          $rowxs = mysqli_fetch_assoc($result_txs);
				
				}

$text_not=$rowxs["name_user"].' отменил(а) решение по выполнению общей <span class="js-taa a-noti-link" id_task="'.$row_t["id"].'">задачи №'.$row_t["id"].'</span>. Цель задачи - '.ht($row_t['comment']);
notification_send($text_not,$user_send_new,$id_user,$link);	 
//добавляем уведомления 
//добавляем уведомления 
//добавляем уведомления 	

	
}

//обновить ключ задач у всех кто должен выполнить чтобы они увидели изменения
$mas_responsible=explode(",",$row_t["id_user_responsible"]);
rm_from_array($id_user,$mas_responsible);
foreach ( $mas_responsible as $value ) 
{
	UpdateTaskKey($value,$link);
}


end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo"   => $status_echo,"count" => $dom,"echo"=>$echo);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>