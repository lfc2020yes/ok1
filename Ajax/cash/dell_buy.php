<?php
//удаления платежа в турах

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
$disco=0;
$id=htmlspecialchars($_GET['id']);
$token=htmlspecialchars($_GET['tk']);
$dom=0;
$status_echo='';
//проверка что есть такой город что это число
//проверка что пользователь зарегистрирован

$echo_r=1; //выводить или нет ошибку 0 -нет
$debug='';
$stack_error = array();  // общий массив ошибок


//**************************************************

//**************************************************
if ((!$role->permission('Касса','D'))and($sign_admin!=1))
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
if ((count($_GET) != 3))
{
    goto end_code;
}


//2 дня
if(!token_access_new($token,'dell_buy_cash',$_GET["id"],"rema",2880))
{
    $debug=h4a(100,$echo_r,$debug);
    goto end_code;
}


$mas_responsible=array();
$dateTime = new DateTime();
date_modify($dateTime, "-1 hour"); // на 1 час назад
$date_new = date_format($dateTime, "Y-m-d H:i:s");

$result_uu=mysql_time_query($link,'Select b.* from cash_operation as b where b.id="'.htmlspecialchars(trim($_GET['id'])).'" and b.id_user="'.ht($id_user).'" and b.date>"'.$date_new.'" and b.id_office IN ('.ht($id_office_sql).')');
$num_results_uu = $result_uu->num_rows;

if ($num_results_uu != 0) {
    $row_uu = mysqli_fetch_assoc($result_uu);
} else
{
    $debug=h4a(95,$echo_r,$debug);
    goto end_code;
}



//**************************************************
//**************************************************
//**************************************************
//**************************************************


$status_ee='ok';


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




mysql_time_query($link, 'delete FROM cash_operation where id="'.ht($id).'"');

$result_uutt = mysql_time_query($link, 'select cash_spot from a_company_office where id="'.ht($office).'"');
$num_results_uutt = $result_uutt->num_rows;
$cash=0;
if ($num_results_uutt != 0) {
    $row_uutt = mysqli_fetch_assoc($result_uutt);
    $cash=$row_uutt['cash_spot'];

}


$cash_spot=0;
if(($row_uu['id_from']==1)or($row_uu['id_where']==1))
{

    if($row_uu['id_from']==1)
    {
        $cash_spot=$cash+trimc($row_uu["summ"]);
    } else
    {
        $cash_spot=$cash-trimc($row_uu["summ"]);
    }


}


mysql_time_query($link, 'update a_company_office set
cash_spot="'.ht($cash_spot).'"
where id = "' . ht($office) . '"');





end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo"   => $status_echo,"query" => $query_string,"download"=>$download,"error" =>  $stack_error);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>