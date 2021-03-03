<?php
//удлаить комментарий из тура
$key_form='bt_task_info';

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
//$token=htmlspecialchars($_GET['tk']);
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
	

//**************************************************
if ((!$role->permission('Туры','U'))and($sign_admin!=1))
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
	


$result_t=mysql_time_query($link,'Select b.* from trips_status_history_new as b where b.id="'.htmlspecialchars(trim($_GET['sel'])).'" and b.edit=1');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{
		$debug=h4a(5,$echo_r,$debug);
		goto end_code;

} else
{
	$row_8 = mysqli_fetch_assoc($result_t);
	$mas_responsible=explode(",",$row_8["id"]);
}


//может ли он смотреть эту задачу
//он ее поставил
//он в исполнителях
//он является командует тем кто есть в создателях или исполнителях

$mas_responsible=explode(",",$row_8["id_user"]);

$mas_responsible = array_merge($mas_responsible, all_chief($row_8["id_user"],$link));

array_push($mas_responsible,$row_8["id_user"]);

	$mas_responsible= array_unique($mas_responsible);
//print_r($mas_responsible);

if ((!in_array($id_user, $mas_responsible))and($sign_admin!=1))
{
	$debug=h4a(789,$echo_r,$debug);
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


 mysql_time_query($link,'delete FROM trips_status_history_new where id="'.ht($_GET['sel']).'"');
	

//mysql_time_query($link,'update task_new set visible="0" where id_object = "'.htmlspecialchars($_GET['sel']).'" and action=10');
	
end_code:

//$aRes = array("debug"=>$debug,"status"   => $status_ee,"echo"=>$query_string_xx,"id_cl"=>$row_score["id_client"]);
$aRes = array("debug"=>$debug,"status"   => $status_ee,"echo"=>$query_string_xx);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>