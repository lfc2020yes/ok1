<?php
//добавить новую оплату/возврат по туру !!
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
$token=htmlspecialchars($_POST['tk']);
$disco=0;
$ID_N='';
$temp='';
$radio_potential='';
$dom='';

$id=2022;
$token=ht($_POST["tk"]);

$dom=0;
$status_echo='';
//проверка что есть такой город что это число
//проверка что пользователь зарегистрирован

$echo_r=1; //выводить или нет ошибку 0 -нет
$debug='';


$su_5=0;

if(( isset($_COOKIE["cc_office".$id_user]))and($_COOKIE["cc_office".$id_user]!='')and(is_numeric(trim($_COOKIE["cc_office".$id_user])))) {
    if (in_array($_COOKIE["cc_office" . $id_user], $mass_office)) {
        {
            $su_5 = $_COOKIE["cc_office" . $id_user];
        }
    }
}
if($su_5==0) {
    $result_work_zz = mysql_time_query($link, 'Select * from a_company_office as a where a.id IN (' . $id_office_sql . ') limit 1');
} else
{
    $result_work_zz = mysql_time_query($link, 'Select * from a_company_office as a where a.id IN (' . $id_office_sql . ') AND a.id="'.$su_5.'"');
}

$num_results_work_zz = $result_work_zz->num_rows;
if($num_results_work_zz!=0)
{

    $row_work_zz = mysqli_fetch_assoc($result_work_zz);
    $id=$row_work_zz["id"];
}

//**************************************************
//2 дня
if(!token_access_new($token,'bt_cash_yes_time',$id,"rema",2880))
{
    $debug=h4a(100,$echo_r,$debug);
    goto end_code;
}




/*
if ( count($_GET) != 4 )
{
$debug=h4a(1,$echo_r,$debug);
goto end_code;
}
*/
//**************************************************
if ((!$role->permission('Касса','S'))and($sign_admin!=1))
{
    $debug=h4a(2,$echo_r,$debug);
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
if(((!isset($_POST['tk1']))or(trim($_POST['tk1'])!='dsQ23RStsd255')))
{
    $debug=h4a(77,$echo_r,$debug);
    goto end_code;
}

//**************************************************
//**************************************************
/*
id=&
tk=2021.4e0044a738d1c0d5b2be7fd066e6330f.Sm9pTmt6TThYNlByd3drVW1BNUhqUT09&tk1=dsQ23RStsd2re&
kto_komy=1&
type_fin=1&
summ=3+422&
vid_fin=8&
task%5Btask_date%5D=16+%D0%A1%D0%B5%D0%BD%D1%82%D1%8F%D0%B1%D1%80%D1%8F+2020&
buy_date=2020-09-16&
comment=
*/


$stack_error = array();  // общий массив ошибок

if ((!isset($_POST['summ'])) or (trim($_POST['summ']) == '')or(!is_numeric(trimc($_POST['summ'])))) {
    array_push($stack_error, "sum");
}

if($row_work_zz["cash_spot"]!=$_POST['summ'])
{
    array_push($stack_error, "sum");
}



//**************************************************
//**************************************************



//print_r ($stack_error);
if(count($stack_error)!=0)
{
    goto end_code;
}

$status_ee='ok';



$date_=date("Y-m-d").' '.date("H:i:s");

$su_5=0;
$office=0;

if(( isset($_COOKIE["cc_office".$id_user]))and($_COOKIE["cc_office".$id_user]!='')and(is_numeric(trim($_COOKIE["cc_office".$id_user])))) {
    if (in_array($_COOKIE["cc_office" . $id_user], $mass_office)) {
        {
            $su_5 = $_COOKIE["cc_office" . $id_user];
        }
    }
}
if($su_5==0) {
    $result_work_zz = mysql_time_query($link, 'Select * from a_company_office as a where a.id IN (' . $id_office_sql . ') limit 1');
} else
{
    $result_work_zz = mysql_time_query($link, 'Select * from a_company_office as a where a.id IN (' . $id_office_sql . ') AND a.id="'.$su_5.'"');
}

$num_results_work_zz = $result_work_zz->num_rows;
if($num_results_work_zz!=0)
{

    $row_work_zz = mysqli_fetch_assoc($result_work_zz);
    $office=$row_work_zz["id"];
}




//добавить оплату в базу
mysql_time_query($link,'INSERT INTO cash_spot_history (                                                                                     
id_office,                                           
summ,                           
date,     
check_user,
check_global                                                                           
) VALUES( 
"'.ht($office).'",
"'.ht($_POST["summ"]).'",
"'.$date_.'",
"'.ht($id_user).'",
"1"
)');



//уведомление для директоров и гланый директоров

$text_not = 'Проверка по кассе подтверждена. Сумма совпадает. Сотрудник - '.$name_user.'. Сумма в кассе - '.number_format(((float)$_POST["summ"]), 2, '.', ' ').'₽.';

$user_send_new= array();
$user_send_new=array_merge(UserNotNumber(16,$link));

rm_from_array(0,$user_send_new);
rm_from_array($id_user,$user_send_new);
$user_send_new= array_unique($user_send_new);


$mass_ei = all_chief($id_user, $link);
rm_from_array($id_user, $mass_ei);
$mass_ei = array_unique($mass_ei);

$end_mass=exception_role($user_send_new,$mass_ei);



notification_send( $text_not,$end_mass,$id_user,$link);



end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo" => $status_echo,"blocks" => $dom,"for_id"=>ht($_POST["id"]),"id" => htmlspecialchars($ID_N),"error" =>  $stack_error);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);



?>