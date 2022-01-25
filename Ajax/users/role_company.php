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

$date_mass = explode(",", ht($id_company_sql));

$date_mass1 = explode(",", ht($_GET["id"]));

for ($ir = 0; $ir < count($date_mass1); $ir++) {
    if(array_search($date_mass1[$ir], $date_mass, true)===FALSE)
    {
        $debug=h4a(442,$echo_r,$debug);
        goto end_code;
    }

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

$LIKE='';

    for ($i = 0; $i < count($date_mass1); $i++) {

        if($LIKE=='')
        {
            $LIKE=' ( ((a.id_company LIKE "'.ht($date_mass1[$i]).',%")or(a.id_company LIKE "%,'.ht($date_mass1[$i]).',%")or(a.id_company LIKE "%,'.ht($date_mass1[$i]).'")or(a.id_company="'.ht($date_mass1[$i]).'")) ';
        } else
        {
            $LIKE.='or ((a.id_company LIKE "'.ht($date_mass1[$i]).',%")or(a.id_company LIKE "%,'.ht($date_mass1[$i]).',%")or(a.id_company LIKE "%,'.ht($date_mass1[$i]).'")or(a.id_company="'.ht($date_mass1[$i]).'")) ';
        }

    }
    if($LIKE!='')
    {
        $LIKE.=') ';
    }
$UU='';
if($_GET["id_u"]!=0)
{
    $UU=' and not(a.id="'.ht($_GET["id_u"]).'") ';

}


$result_66 = mysql_time_query( $link, 'SELECT a.id,a.name_user FROM r_user AS a WHERE a.enabled=1 AND '.$LIKE.' '.$UU.' ORDER BY a.name_user' );
   // $debug='SELECT a.id,a.name_user FROM r_user AS a WHERE a.enabled=1 AND '.$LIKE.' '.$UU.' ORDER BY a.name_user';
if ( $result_66 )
{
    $i = 0;
    $mass_ei=users_hierarchy_plus_disabled($id_user,$link);
    //array_push($mass_ei, $id_user);
    $mass_ei= array_unique($mass_ei);
    while ( $row_66 = mysqli_fetch_assoc( $result_66 ) ) {

        if (array_search($row_66["id"], $mass_ei, true) !== FALSE) {


            $echo .= '<div class="na-50" style="padding: 0px;">';

            $echo .= '<div class="input-choice-click-left js-checkbox-group " style="margin-top: 0px; background-color: transparent;">
<div class="choice-head">' . $row_66["name_user"] . '</div>
<div class="choice-radio"><div class="center_vert1">';

            $echo .= '<i></i><input name="kem[type][]" value="' . $row_66["id"] . '" type="hidden"><input name="kem[val][]" value="0" type="hidden">';

            $echo .= '</div></div></div></div>';
        }
    }
}




end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"echo" =>  $echo);
require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);


?>