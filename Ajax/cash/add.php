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


//**************************************************
//2 дня
if(!token_access_new($token,'bt_cash_buy',$id,"rema",2880))
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
if ((!$role->permission('Касса','A'))and($sign_admin!=1))
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

if ((!isset($_POST['cash_from'])) or (trim($_POST['cash_from']) == '')or(trim($_POST['cash_from']) == 0)) {
    array_push($stack_error, "from");
}
if ((!isset($_POST['cash_where'])) or (trim($_POST['cash_where']) == '')or(trim($_POST['cash_where']) == 0)) {
    array_push($stack_error, "where");
}



if($_POST['cash_from']==$_POST['cash_where'])
{
    array_push($stack_error, "from_where");
}

$where_more='';
if((isset($_POST['cash_where']))and($_POST['cash_where']==4))
{
    if ((!isset($_POST['where_more'])) or (trim($_POST['where_more']) == '')) {
        array_push($stack_error, "where_more");
    } else
    {
        $where_more=$_POST["where_more"];
    }
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
mysql_time_query($link,'INSERT INTO cash_operation (
                                                                                       
id_office,                                           
id_user,                           
id_from,     
id_where,                                                   
where_more,                                       
summ,
date,
title                                                                              
) VALUES( 
"'.ht($office).'",
"'.ht($id_user).'",
"'.ht($_POST["cash_from"]).'",
"'.ht($_POST["cash_where"]).'",
"'.ht($where_more).'",
"'.ht(trimc($_POST["summ"])).'",
"'.$date_.'",
"'.ht($_POST["comment"]).'"
)');

$new_id_payment=mysqli_insert_id($link);


$result_uu = mysql_time_query($link, 'select cash_spot from a_company_office where id="'.ht($office).'"');
$num_results_uu = $result_uu->num_rows;
$cash=0;
if ($num_results_uu != 0) {
    $row_uu = mysqli_fetch_assoc($result_uu);
    $cash=$row_uu['cash_spot'];

}

if(($_POST['cash_from']==1)or($_POST['cash_where']==1))
{

    if($_POST['cash_from']==1)
    {
        $cash_spot=$cash-trimc($_POST["summ"]);
    } else
    {
        $cash_spot=$cash+trimc($_POST["summ"]);
    }


}


mysql_time_query($link, 'update a_company_office set
cash_spot="'.ht($cash_spot).'"
where id = "' . ht($office) . '"');



$result_uu = mysql_time_query($link, 'select A.*  from cash_operation as A where A.id="'.ht($new_id_payment).'"');

$num_results_uu = $result_uu->num_rows;

if ($result_uu) {
    $query_string='';
    while ($row_uu = mysqli_fetch_assoc($result_uu)) {
        //echo("!");
        $edit_moo=1;
        $new_say=1;
        include $url_system.'cash/code/block_buy.php';

$dom=$query_string;
    }

}




end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo" => $status_echo,"blocks" => $dom,"for_id"=>ht($_POST["id"]),"id" => htmlspecialchars($ID_N),"error" =>  $stack_error);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);



?>