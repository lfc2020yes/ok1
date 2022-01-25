<?php
//обновление вывода задачи после каких либо действий
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

$id=htmlspecialchars($_GET['id']);
$dom=0;
$status_echo='';
//проверка что есть такой город что это число
//проверка что пользователь зарегистрирован

$echo_r=1; //выводить или нет ошибку 0 -нет
$debug='';

//**************************************************
if((!isset($_SESSION["user_id"]))or(!is_numeric(id_key_crypt_encrypt($_SESSION["user_id"]))))
{	
	goto end_code;
}

$id_user=id_key_crypt_encrypt($_SESSION["user_id"]);

//проверить есть ли переменная id и можно ли этому пользователю это делать
if ((count($_GET) != 3)or(!isset($_GET["id"])))
{
	goto end_code;	
}	
	
$idd=explode(",",$_GET["id"]);

foreach ($idd as $key => $value) 
{ 
	
if(!is_numeric($value))
{
	goto end_code;
}
	
$result_t=mysql_time_query($link,'Select b.* from preorders as b where b.id="'.htmlspecialchars(trim($value)).'" and b.visible=1 and b.id_company IN ('.$id_company.')');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{	
		$debug=h4a(5,$echo_r,$debug);
		goto end_code;
	
} else
{
	$row_8 = mysqli_fetch_assoc($result_t);
	$mas_responsible=explode(",",$row_8["id_user"]);
}


//может ли он смотреть это обращение
//он его создал
//он является командует тем кто есть в создателях

$mas_responsible=explode(",",$row_8["id_user"]);

foreach ($mas_responsible as $key => $value) 
{
   $mas_responsible = array_merge($mas_responsible, all_chief($value,$link));	   		
}
$mas_responsible = array_merge($mas_responsible, all_chief($row_8["id_user"],$link));

array_push($mas_responsible,$row_8["id_user"]); 

	$mas_responsible= array_unique($mas_responsible);
//print_r($mas_responsible);	
	
	if ((!in_array($id_user, $mas_responsible))and($sign_admin!=1)) 
    {
		$debug=h4a(789,$echo_r,$debug);
        goto end_code;	
	}		
}



if ((!$role->permission('Обращения','R'))and($sign_admin!=1))
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
$new_sa=1;


if(count($idd)==1)
{

	include $url_system.'preorders/code/block_preorders.php';
		 $echo=$block_preorders;
} else
{
	foreach ($idd as $key => $value) 
    { 
		$result_t=mysql_time_query($link,'Select b.* from preorders as b where b.id="'.htmlspecialchars(trim($value)).'" and b.visible=1');
$num_results_t = $result_t->num_rows;
		if($num_results_t!=0)
		{
			$row_8 = mysqli_fetch_assoc($result_t);
				include $url_system.'preorders/code/block_preorders.php';
		 $echo.=$block_preorders;
		}
	}
}




end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo"   => $status_echo,"count" => $dom,"echo"=>$echo,"echo_more"=>$echo_more);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>