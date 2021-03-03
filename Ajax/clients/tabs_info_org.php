<?php
//получить данные по вкладке клиента
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
$disco=0;
$id=htmlspecialchars($_GET['id']);
$id_tabs=htmlspecialchars($_GET['id_tabs']);
$dom=0;
$status_echo='';
//проверка что есть такой город что это число
//проверка что пользователь зарегистрирован

$echo_r=0; //выводить или нет ошибку 0 -нет
$debug='';

//**************************************************
	
if(!token_access_new($token,'bt_org_info',$id,"s_form"))
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
	


$result_t=mysql_time_query($link,'Select b.* from k_organization as b where b.id="'.htmlspecialchars(trim($_GET['id'])).'" and b.visible=1');
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
/*
0 - о туристе
1 - заявки
2 - туры
3 - общение	
*/

$status_ee='ok';

// о туристе
if($id_tabs==0)
{
include $url_system.'clients/code/tabs_about_org.php'; 
}
// туры
if($id_tabs==1)
{
include $url_system.'clients/code/tabs_offers_org.php'; 
}	
//Файлы
if($id_tabs==2)
{
include $url_system.'clients/code/tabs_file_org.php';
}	

end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo"   => $status_echo,"query" => $query_string,"echo"=>$echo);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>