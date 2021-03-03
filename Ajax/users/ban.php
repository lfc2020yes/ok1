<?php
//открыть закрыть доступ пользователя

$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';
header("Content-type: application/json");
//include $url_system.'module/config_mail.php';




$status_ee='error';
$eshe=0;
$echo='';
$debug='';
$echo_r=0;
$count_all_all=0;

$id=ht($_GET["id"]);
//**************************************************

if ((!$role->permission('Сотрудники','U'))and($sign_admin!=1))
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
$result_url=mysql_time_query($link,'select A.id,A.enabled from r_user as A where A.id="'.ht($id).'"');
        $num_results_custom_url = $result_url->num_rows;
        if($num_results_custom_url==0)
        {
           	  $debug=h4a(77,$echo_r,$debug);
    goto end_code;	
		} 

else
		{
			$row_list = mysqli_fetch_assoc($result_url);
		}

//**************************************************


if((!isset($_SESSION["user_id"]))or(!is_numeric(id_key_crypt_encrypt($_SESSION["user_id"]))))
{	
	goto end_code;
}


$mass_ei=users_hierarchy_plus_disabled($id_user,$link);
rm_from_array($id_user,$mass_ei);
$mass_ei= array_unique($mass_ei);

if(array_search($id,$mass_ei)===false)
{
    goto end_code;
}






    $status_ee='ok';			
	$date_r=date("Y-m-d").' '.date("H:i:s");			

$st='';
$status_party=0;
if($row_list["enabled"]==1)
{
	$st='Заблокирован';
	mysql_time_query($link,'update r_user set enabled="0" where id = "'.ht($id).'"');
	$status_party=0;
} else
{
	mysql_time_query($link,'update r_user set enabled="1" where id = "'.ht($id).'"');
	$status_party=1;
	$st='Допущен к работе';
}



end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"st" =>  $st,"party" => $status_party);
require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);


?>