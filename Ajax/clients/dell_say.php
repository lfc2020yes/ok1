<?php
//показать еще сообщения общения в клиенте
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

$echo_r=1; //выводить или нет ошибку 0 -нет
$debug='';

//**************************************************
	
if(!token_access_new($token,'bt_client_info',$id,"s_form"))
{
   $debug=h4a(100,$echo_r,$debug);
   goto end_code;
}	
//**************************************************
if ((!$role->permission('Клиенты','R'))and($sign_admin!=1))
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
if ((count($_GET) != 4))
{
	goto end_code;	
}	
	


$result_t=mysql_time_query($link,'Select b.datetimes,b.id_user,b.id_client from k_clients_commun as b where b.id="'.htmlspecialchars(trim($_GET['sel'])).'" and b.visible=1');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{	
		$debug=h4a(5,$echo_r,$debug);
		goto end_code;
	
} else
{
	$row_score = mysqli_fetch_assoc($result_t);
}


if(($row_score["id_user"]!=$id_user)and($sign_admin!=1))
{
		$debug=h4a(90,$echo_r,$debug);
		goto end_code;
}


/*	
0 5
5 5
10 5
15 5	
*/
//**************************************************
//**************************************************
//**************************************************
//**************************************************

$status_ee='ok';

mysql_time_query($link,'update k_clients_commun set visible="0" where id = "'.htmlspecialchars($_GET['sel']).'"');

		$result_8 = mysql_time_query($link,'SELECT A.id,A.ring_datetime,A.comment FROM task_new AS A WHERE A.id_user="'.ht($id_user).'" and 
	A.id_a_group IN ('.ht($id_group_u).') and 
	A.reminder=0 and
	A.click="1" and
	A.action="10" and
	A.status="0" and
	A.id_object="'.ht($_GET['sel']).'"');
	
$num_8 = $result_8->num_rows;	
	if($num_8!=0)
	{
$row_bila = mysqli_fetch_assoc($result_8);

//если была задача с этим сообщением тоже скрываем
AddHistoryTask('6',$id_user,$row_bila["id"],'','','','','','','',$link,'Удалена так как удалили общение к которому она была привязана');
	
mysql_time_query($link,'update task_new set visible="0" where  id="'.$row_bila["id"].'"');

	}


//mysql_time_query($link,'update task_new set visible="0" where id_object = "'.htmlspecialchars($_GET['sel']).'" and action=10');
	
end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"echo"=>$query_string_xx,"id_cl"=>$row_score["id_client"]);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>