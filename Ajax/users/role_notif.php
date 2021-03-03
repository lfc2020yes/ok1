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
$result_uu = mysql_time_query($link, 'select sign_level from r_role where id="' . ht($id) . '"');
$num_results_uu = $result_uu->num_rows;

if ($num_results_uu != 0) {
    $row_uu = mysqli_fetch_assoc($result_uu);
    $su_t = $row_uu["id_role"];
    if ($row_uu["sign_level"] > $sign_level) {
        $debug=h4a(38,$echo_r,$debug);
        goto end_code;
    }
} else
{
    $debug=h4a(67,$echo_r,$debug);
    goto end_code;
}



//**************************************************


if((!isset($_SESSION["user_id"]))or(!is_numeric(id_key_crypt_encrypt($_SESSION["user_id"]))))
{	
	goto end_code;
}




    $status_ee='ok';



$su_t=array();
$result_66 = mysql_time_query( $link, 'Select b.number_type from a_notification_user_option as b where b.val=1 and b.id_user="' . ht($_GET["id_u"]) . '"' );
if ( $result_66 ) {
    while ( $row_66 = mysqli_fetch_assoc( $result_66 ) ) {

        array_push( $su_t, $row_66[ "number_type" ] );

    }
}


$result_66 = mysql_time_query( $link, 'SELECT a.id_number,a.name FROM a_notification_type AS a,a_notification_type_role AS b WHERE a.id_number=b.number_type AND b.id_role="'.ht($_GET["id"]).'" ORDER BY a.id' );
if ( $result_66 )
{
    $i = 0;
    while ( $row_66 = mysqli_fetch_assoc( $result_66 ) ) {

        $echo.='<div class="na-50" style="padding: 0px;">';

        $echo.='<div class="input-choice-click-left js-checkbox-group" style="margin-top: 0px; background-color: transparent;">
<div class="choice-head">'.$row_66["name"].'</div>
<div class="choice-radio"><div class="center_vert1">';
        if(in_array($row_66["id_number"], $su_t))
        {
            $echo.='<i class="active_task_cb"></i><input name="notis[type][]" value="'.$row_66["id_number"].'" type="hidden"><input name="notis[val][]" value="1" type="hidden">';
        } else
        {
            $echo.='<i></i><input name="notis[type][]" value="'.$row_66["id_number"].'" type="hidden"><input name="notis[val][]" value="0" type="hidden">';
        }
        $echo.='</div></div></div></div>';
    }
}




end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"echo" =>  $echo);
require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);


?>