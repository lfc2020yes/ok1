<?php
//получать обновленные данные по кассе конкретный офис
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
$token=htmlspecialchars($_GET['tk']);
$disco=0;
$id=htmlspecialchars($_GET['id']);
$query_string='';
$dom=0;
$status_echo='';

//проверка что есть такой город что это число
//проверка что пользователь зарегистрирован

$echo_r=0; //выводить или нет ошибку 0 -нет
$debug='';

//**************************************************
	//echo($_SESSION['s_form_two']);
/*
if(!token_access_new($token,'bt_client_info',$id,"s_form"))
{
   $debug=h4a(100,$echo_r,$debug);
   goto end_code;
}
*/
//**************************************************
if ((!$role->permission('Касса','U'))and($sign_admin!=1))
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
if ((count($_GET) != 1))
{
	goto end_code;	
}

//Доходы и Расходы
//График продаж
//Структура доходов
//Структура расходов


//если что то надо получить то 1 иначе 0

//**************************************************
//**************************************************
//**************************************************
//**************************************************

$status_ee='ok';


$su_5=0;

if(( isset($_COOKIE["cc_office".$id_user]))and($_COOKIE["cc_office".$id_user]!='')and(is_numeric(trim($_COOKIE["cc_office".$id_user])))) {
    if (in_array($_COOKIE["cc_office" . $id_user], $mass_office)) {
        {
            $su_5 = $_COOKIE["cc_office" . $id_user];
        }
    }
}

$os5 = array();
$os_id5 = array();


$result_work_zz=mysql_time_query($link,'Select * from a_company_office as a where a.id IN ('.$id_office_sql.')');
$num_results_work_zz = $result_work_zz->num_rows;
if($num_results_work_zz!=0)
{

    for ($i=0; $i<$num_results_work_zz; $i++)
    {
        $row_work_zz = mysqli_fetch_assoc($result_work_zz);
        array_push($os5, $row_work_zz["object_name"]);
        array_push($os_id5, $row_work_zz["id"]);

        if($su_5==0)
        {
            $su_5=$row_work_zz["id"];
        }


    }
}
$result_uu = mysql_time_query($link, 'select cash_spot from a_company_office where id="'.ht($su_5).'"');
$num_results_uu = $result_uu->num_rows;
$cash=0.00;
if ($num_results_uu != 0) {
    $row_uu = mysqli_fetch_assoc($result_uu);
    $cash=$row_uu['cash_spot'];

}

$plus=0;
$result_plus = mysql_time_query($link, 'select sum(C.summ) as simm from cash_operation as C where C.id_office="'.ht($su_5).'" and C.id_where=1 and C.date LIKE "'.date('Y-m-d').' %"');
$num_results_plus = $result_plus->num_rows;

if ($num_results_plus != 0) {
    $row_plus = mysqli_fetch_assoc($result_plus);
    if($row_plus["simm"]!='') {
        $plus = $row_plus["simm"];
    }
}


$minus=0;
$result_plus = mysql_time_query($link, 'select sum(C.summ) as simm from cash_operation as C where C.id_office="'.ht($su_5).'" and C.id_from=1 and C.date LIKE "'.date('Y-m-d').' %"');
$num_results_plus = $result_plus->num_rows;

if ($num_results_plus != 0) {
    $row_plus = mysqli_fetch_assoc($result_plus);
    if($row_plus["simm"]!='') {
        $minus = $row_plus["simm"];
    }
}



$echo_tt='~';
$date_start='';
$name_start='';
$toolt_xx='';
$result_cl = mysql_time_query($link, 'select * from cash_close_shift where id_office="' . ht($su_5) . '" order by date_close desc limit 1');
$num_results_cl = $result_cl->num_rows;

if ($num_results_cl != 0) {
    $row_cl = mysqli_fetch_assoc($result_cl);

    $date_massx = explode(" ", ht($row_cl['date_close']));
    $date_mass = explode("-", ht($date_massx[0]));
    $date_start = $date_mass[2] . '.' . $date_mass[1] . '.' . $date_mass[0];

    $toolt_xx='подтвержденная сумма - '.$row_cl["summ"].' ₽';

    $result_uuy=mysql_time_query($link,'select name_user from r_user where id="'.ht($row_cl["id_user"]).'"');
    $num_results_uuy = $result_uuy->num_rows;

    if($num_results_uuy!=0) {
        $row_uuy = mysqli_fetch_assoc($result_uuy);
        $name_start=$row_uuy["name_user"];
    }


    $echo_tt = $date_start.' - '.$name_start;

}

$echo='<div class="sdat-cash">Последняя закрытая смена <span data-tooltip="'.$toolt_xx.'">('.$echo_tt.')</span> </div>';



	
end_code:
/*
$xy=array();
$raz_array=array();
$doxod_array=array();
*/
//chart
//chart1
//chart2

$aRes = array("debug"=>$debug,"status"   => $status_ee,"echo"=>$echo,"cash"=>$cash,"minus"=>$minus,"plus"=>$plus);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>