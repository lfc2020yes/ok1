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
$echo_r='';
$count_all_all=0;
$token=ht($_POST["tk"]);
$id=ht($_POST["id"]);
//**************************************************

if ((!$role->permission('Промокоды','S'))and($sign_admin!=1))
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
$result_url = mysql_time_query($link, 'select a.*,b.name_user from affiliates_promo_code as a,r_user as b where a.id_users=b.id and a.id="'.ht($_POST["id"]).'" and a.visible=1 and a.status=1 ');
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


if(!token_access_new($token,'bt_promo_sogl',$id,"rema",2880))
{
    $debug=h4a(100,$echo_r,$debug);
    goto end_code;
}





    $status_ee='ok';			
	$date_r=date("Y-m-d").' '.date("H:i:s");			

$st='';
$status_party=0;
if($_POST["hwohwo"]==1)
{
	$st='согласован';
	mysql_time_query($link,'update affiliates_promo_code set status="2",bonus="'.ht($_POST["bonus"]).'",name="'.ht($_POST["summ"]).'",name_search="'.ht($_POST["summ1"]).'" where id = "'.ht($id).'"');
	$status_party=1;
} else
{
	mysql_time_query($link,'update affiliates_promo_code set status="3" where id = "'.ht($id).'"');
	$status_party=2;
	$st='отклонен';
}


$text_not = 'Промокод - ' . ht($_POST["summ"]) . ' был '.$st.'.';
$user_send_new= array();
array_push($user_send_new, $row_list["id_users"]);
notification_send( $text_not,$user_send_new,$id_user,$link);




end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"st" =>  $status_party,"id" => $id);
require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);


?>