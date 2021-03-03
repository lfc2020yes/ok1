<?php
//сохранить редактирования в форме задачи
$name_form='006U';
$key_form='bt_task_dell_cocc';

$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';
header("Content-type: application/json");
$query_string_xx='';
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
$query_string='';
$dom=0;
$status_echo='';
//проверка что есть такой город что это число
//проверка что пользователь зарегистрирован

$echo_r=0; //выводить или нет ошибку 0 -нет
$debug='';

//**************************************************
	
if(!token_access_new($token,$key_form,$id,"form".$name_form))
{
   $debug=h4a(100,$echo_r,$debug);
   goto end_code;
}	
//**************************************************
if ((!$role->permission('Задачи','D'))and($sign_admin!=1))
{
	  $debug=h4a(12,$echo_r,$debug);
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


if((!isset($_SESSION["user_id"]))or(!is_numeric(id_key_crypt_encrypt($_SESSION["user_id"]))))
{	
	goto end_code;
}

$id_user=id_key_crypt_encrypt($_SESSION["user_id"]);

//проверить есть ли переменная id и можно ли этому пользователю это делать
if ((count($_GET) != 3))
{
	goto end_code;	
}	
	



$result_t=mysql_time_query($link,'Select b.* from task_new as b where b.id="'.htmlspecialchars(trim($_GET['id'])).'" and b.visible=1');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{	
		$debug=h4a(5,$echo_r,$debug);
		goto end_code;
	
} else
{
	$row_8 = mysqli_fetch_assoc($result_t);
}

//
if(($row_8["id_user"]==0)or($row_8["status"]==1))
{
		$debug=h4a(6,$echo_r,$debug);
		goto end_code;	
}


if ((($role->permission('Задачи','D'))and($row_8["id_user"]==$id_user))or($sign_admin==1))
{
	
} else
{
		$debug=h4a(7,$echo_r,$debug);
		goto end_code;	
}
	  
	  

//**************************************************
//**************************************************
//**************************************************
//**************************************************

$status_ee='ok';


mysql_time_query($link,'update task_new set visible="0" where id = "'.ht($_GET['id']).'"');

//задача изменилась изменить key с кем она связана
//заносим историю изменения задачи
AddHistoryTask('6',$id_user,$_GET['id'],'','','','','','','',$link,'удалена задача');
    
$mas_responsible=explode(",",$row_8["id_user_responsible"]);	   
	foreach ($mas_responsible as $key => $value) 
    { 
	  UpdateTaskKey($value,$link);
	}	

//уведомления всем кто должен был выполнить кроме того кто удалил
if($sign_admin!=1)
{
//добавляем уведомления 
//добавляем уведомления 
//добавляем уведомления 	
$user_send= array();	
$user_send_new= array();		

//$user_send_new=array_merge($hie->boss['4']);
//те кому была дана задача если она общая+ тот кто давал задачу - тот кто ее сейчас выполнил	
	
$user_send_new=explode(",",$row_8["id_user_responsible"]);
array_push($user_send_new,$row_8["id_user"]); 
	
	rm_from_array(0,$user_send_new);
	rm_from_array($id_user,$user_send_new);
	$user_send_new= array_unique($user_send_new);
	
	$result_txs=mysql_time_query($link,'Select a.name_user,a.timelast,a.id from r_user as a where a.id="'.$id_user.'"');
	            if($result_txs->num_rows!=0)
	            {   
		          $rowxs = mysqli_fetch_assoc($result_txs);
				
				}

$text_not=$rowxs["name_user"].' удалил(а) <span class="js-taa a-noti-link" id_task="'.$row_8["id"].'">задачу №'.$row_8["id"].'</span> - '.$row_8["comment"];
notification_send($text_not,$user_send_new,$id_user,$link);	 
//добавляем уведомления 
//добавляем уведомления 
//добавляем уведомления 
	
}


	
end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"echo"=>$query_string_xx);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>