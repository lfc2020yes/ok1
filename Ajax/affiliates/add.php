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

$id=ht($_POST["id"]);
$token=ht($_POST["tk"]);

$dom=0;
$status_echo='';
//проверка что есть такой город что это число
//проверка что пользователь зарегистрирован

$echo_r=1; //выводить или нет ошибку 0 -нет
$debug='';


//**************************************************
//2 дня
if(!token_access_new($token,'bt_affiliates_buy',$id,"rema",2880))
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
if ((!$role->permission('Партнеры','A'))and($sign_admin!=1))
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
if(((!isset($_POST['tk1']))or(trim($_POST['tk1'])!='dsQ23RStsd2re')))
{
    $debug=h4a(77,$echo_r,$debug);
    goto end_code;
}


$result_uu = mysql_time_query($link, 'select a.all_comission,a.paid_comission,b.name_user from affiliates as a,r_user as b where b.id=a.id_users and a.id_users="'.ht($_POST["id"]).'" ');
$num_results_uu = $result_uu->num_rows;

if ($num_results_uu != 0) {
    $row_uu = mysqli_fetch_assoc($result_uu);
    //проверяем должны ли ему что то
    $dolg = round(((float)trimc($row_uu['all_comission']) - (float)trimc($row_uu['paid_comission'])),2);

}
if($dolg<round(((float)trimc($_POST['summ']))))
{
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


$date_valid=0;
if(!validateDate($_POST['buy_date'],'Y-m-d'))
{
    array_push($stack_error, "buy_date");
    $date_valid=1;
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

//добавить оплату в базу
mysql_time_query($link,'INSERT INTO affiliates_history_paid (
                                                                                       
id_users,                                           
id_affiliates,                           
sum,                                                        
date,                                       
date_create,
comment,                                                                 
visible                                                                               
) VALUES( 
"'.ht($id_user).'",
"'.ht($_POST["id"]).'",
"'.ht(trimc($_POST["summ"])).'",
"'.ht($_POST["buy_date"]).'",
"'.$date_.'",
"'.ht($_POST["comment"]).'",
"1")');

$new_id_payment=mysqli_insert_id($link);


//добавить в выплачено общую сумму
$paid= round(((float)trimc($row_uu['paid_comission'])+(float)trimc($_POST['summ'])),2);
mysql_time_query($link, 'update affiliates set
paid_comission="'.$paid.'"
where id_users = "' . ht($_POST['id']) . '"');

//осталось оплатить
$dolg = round(((float)trimc($row_uu['all_comission']) - (float)$paid),2);






end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo" => $status_echo,"blocks" => $dom,"for_id"=>ht($_POST["id"]),"id" => htmlspecialchars($_POST["id"]),"error" =>  $stack_error,"dolg" => $dolg);

/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);



?>