<?php
//узнаем есть новые уведомления или нет

$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';


$token_new='';
$token_new1='';


$status_ee='';


$token=htmlspecialchars($_GET['tk']);    //ключ для оповещений
$token1=htmlspecialchars($_GET['tk1']);  //ключ для задач
//проверка что есть такой город что это число
//проверка что пользователь зарегистрирован


if(isset($_SESSION["user_id"]))
{ 
$result_t=mysql_time_query($link,'Select a.id from r_user as a where a.noti_key="'.htmlspecialchars(trim($token)).'" and a.id="'.htmlspecialchars(trim($id_user)).'"');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{				 
  $status_ee='update';
  $secret=rand_string_string(4);
  $_SESSION['s_not'] = $secret;	
  $token_new=token_access_compile($id_user,'update_notification',$secret);
}
if($_GET['tcloud']=='1')
{
//смотрим может задачи изменились	
$result_t=mysql_time_query($link,'Select a.id from r_user as a where a.task_key="'.htmlspecialchars(trim($token1)).'" and a.id="'.htmlspecialchars(trim($id_user)).'"');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{				 
  $status_ee='update_task';
  $secret=rand_string_string(4);
  $_SESSION['s_task'] = $secret;	
  $token_new1=token_access_compile($id_user,'update_task_cloud',$secret);
}	
}

//обновляем время последнего действия на сайте пользователя (онлайн)	
mysqli_query($link,'update r_user set timelast="'.time().'" where id = "'.htmlspecialchars(trim($id_user)).'"');  //для бати зачем то)		
	
	
}

header("Content-type: application/json");
$aRes = array("status"   => $status_ee,"token"=> $token_new,"token1"=> $token_new1);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>