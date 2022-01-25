<?php
//изменить цены по туру от клиента и туроператора
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
$token=$_POST['tk'];
$id=htmlspecialchars($_POST['id']);
$disco=0;
$ID_N='';
$temp='';
$radio_potential='';

$dom=0;
$status_echo='';
//проверка что есть такой город что это число
//проверка что пользователь зарегистрирован

$echo_r=1; //выводить или нет ошибку 0 -нет
$debug='';

//$secret=$_SESSION['rema'];
//echo(token_access_compile($_POST["id"],'bt_trips_buy_edit_21',$secret));
//**************************************************
//2 дня
if(!token_access_new($token,'bt_edit_plane',$id_company,"rema",2880))
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
if ((!$role->permission('Финансы','U'))and($sign_admin!=1))
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
if(((!isset($_POST['tk1']))or(trim($_POST['tk1'])!='dsQ6dsf4adfd2hh')))
{
    $debug=h4a(77,$echo_r,$debug);
    goto end_code;
}



//**************************************************
//**************************************************
/*
id=51&
tk=51.eda3eb4f64e3999ca260107659cf40ee.62749b5207ea5e8f62749b5284cf5e8f6274f3452797eca24ec19b527f474ec1&
tk1=dsQ23RSasd2sa&
kto_komy=1&
operation=2&
summ=2+000&
curs=67.40&
com_proc=0&
com_rub=0&
method=2&
task%5Btask_date%5D=9+%D0%98%D1%8E%D0%BB%D1%8F+2020&
buy_date=2020-07-09&
comment=
*/

$stack_error = array();  // общий массив ошибок

if ((!isset($_POST['summ'])) or (trim($_POST['summ']) == '')or(!is_numeric(trimc($_POST['summ'])))) {
    array_push($stack_error, "sum");
}
if ((!isset($_POST['summ1'])) or (trim($_POST['summ1']) == '')or(!is_numeric(trimc($_POST['summ1'])))) {
    array_push($stack_error, "sum1");
}

//**************************************************
//**************************************************

//print_r ($stack_error);
if(count($stack_error)!=0)
{
    goto end_code;
}

$status_ee='ok';


$cost_1=trimc($_POST["summ"]);
$cost_2=trimc($_POST["summ1"]);
$date_new=date("Y-m-").'01';
mysql_time_query($link, 'update finance_plane set
    income="'.ht($cost_1).'",expense="'.ht($cost_2).'"
    where id_a_company IN (' . ht($id_company) . ') and date="'.$date_new.'"');


end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo" => $status_echo,"count" => $dom,"for_id"=>ht($_POST['id']),"error" =>  $stack_error,"download" => $download,"upload_mm" => 1);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);



?>