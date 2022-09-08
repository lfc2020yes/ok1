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
if(!token_access_new($token,'bt_edit_price',$_POST["id"],"rema",2880))
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
if ((!$role->permission('Туры','U'))and($sign_admin!=1))
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
if(((!isset($_POST['tk1']))or(trim($_POST['tk1'])!='dsQ642dSadfd2re')))
{
    $debug=h4a(77,$echo_r,$debug);
    goto end_code;
}


$status_admin=0;
$mas_responsible=array();
$result_uu11 = mysql_time_query($link, 'select A.id,A.id_exchange,A.id_user,A.cost_client,A.cost_client_exchange,A.exchange_rates,A.cost_operator,A.cost_operator_exchange,A.discount,A.exchange_rates_operator,A.paid_client,A.paid_client_rates,A.paid_operator,A.paid_operator_rates,A.buy_clients,A.buy_operator,A.status_admin  from trips as A where A.id="' . ht($_POST['id']) . '" and A.visible=1 and A.id_a_company IN ('.$id_company.')');
$num_results_uu11 = $result_uu11->num_rows;

if ($num_results_uu11 != 0) {
    $row_uu11 = mysqli_fetch_assoc($result_uu11);
    array_push($mas_responsible,$row_uu11["id_user"]);

    $array_param_old_ss=array(($row_uu11["buy_clients"]),$row_uu11["buy_operator"]);
    $status_admin=$row_uu11['status_admin'];
} else
{
    $debug=h4a(95,$echo_r,$debug);
    goto end_code;
}


if($status_admin!=0) {
    $debug=h4a(002,$echo_r,$debug);
    goto end_code;
}


//доступна форма только для тех чью это туры и если кто-то управляет этим человек чей это тур и + админы
$tabs_menu_x_visible[4]=0;
if($row_uu11["id_user"]!=0)
{
    if(($sign_admin!=1))
    {

        if($row_uu11["id_user"]==$id_user)
        {
            $tabs_menu_x_visible[4]="1";
        }

        if (in_array($id_user, $mas_responsible))
        {
            $tabs_menu_x_visible[4]="1";
        } else
        {
            //может он управляющий кого то кто должен выполнить эту задачу тогда ему тоже можно ее выполнить
            $subo_x = array();
            foreach ($mas_responsible as $key => $value)
            {
                $subo_x = array_merge($subo_x, all_chief($value,$link));

            }
            $subo_x= array_unique($subo_x);


            if ((in_array($id_user, $subo_x)))
            {
                $tabs_menu_x_visible[4]="1";
            }

        }
    }  else
    {
        $tabs_menu_x_visible[4]="1";
    }

}

if($tabs_menu_x_visible[4]!="1")
{
    $debug=h4a(6,$echo_r,$debug);
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

$result_uu_rate=mysql_time_query($link,'select a.char,a.small_name,a.code from booking_exchange as a  where a.id="'.ht($row_uu11["id_exchange"]).'"');
$num_results_uu_rate = $result_uu_rate->num_rows;
$rate_i='';
if($num_results_uu_rate!=0) {
    $row_uu_rate = mysqli_fetch_assoc($result_uu_rate);
}

$style_kurs=0;
if ($row_uu_rate["char"] == "₽") {
    //рублевый тур

} else {
//значит выводим в валюте потому что остаток клиент отдает в валюте
    $style_kurs=1;
    $rate_i=$row_uu_rate["small_name"];
}

$stack_error = array();  // общий массив ошибок
if($style_kurs==1) {
    if ((!isset($_POST['curs'])) or (trim($_POST['curs']) == '')or(!is_numeric(trimc($_POST['curs'])))) {
        array_push($stack_error, "curs");
    }
}
if ((!isset($_POST['summ'])) or (trim($_POST['summ']) == '')or(!is_numeric(trimc($_POST['summ'])))) {
    array_push($stack_error, "sum");
}

if($style_kurs==1) {
    if ((isset($_POST['summ1'])) and (trim($_POST['summ1']) != '') and (is_numeric(trimc($_POST['summ1']))) and ((float)$_POST['summ1'] > 0)) {

        if ((!isset($_POST['curs'])) or (trim($_POST['curs']) == '') or (!is_numeric(trimc($_POST['curs'])))) {
            array_push($stack_error, "curs1");
        }

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


    $cost_client=trimc($_POST["summ"]);
    $exchange_rates=0;
    $cost_client_exchange=0;

    if($style_kurs==1) {

        //рассчитаем сколько для клиента это в валюте
        $exchange_rates=$_POST["curs"];

        //$cost_client_exchange=number_format(((float)$cost_client/(float)$exchange_rates), 2, '.', '');

        $cost_client_exchange=round(((float)$cost_client/(float)$exchange_rates), 2);

     //   $debug=$cost_client_exchange;  //817.47

    }


    $cost_operator=trimc($_POST["summ1"]);
    $exchange_rates_operator=0;
    $cost_operator_exchange=0;

    if($style_kurs==1) {

        //рассчитаем сколько для клиента это в валюте
        $exchange_rates_operator=$_POST["curs1"];
       // $cost_operator_exchange=number_format(((float)$cost_operator/(float)$exchange_rates_operator), 2, '.', '');

        if($exchange_rates_operator!=0) {

            $cost_operator_exchange = round(((float)$cost_operator / (float)$exchange_rates_operator), 2);
        }

    }


  //проверить вдруг после этих изменений флаг оплачено полностью надо снять или поставить окончательно

    if($style_kurs==1) {
        //валютный тур

        //клиент
       // $debug.=' '.$row_uu11["paid_client_rates"];
        $all_paid=round(((float)$row_uu11["paid_client_rates"]),2);

       // $debug.=' '.$all_paid;

        if($all_paid>=round(((float)$cost_client_exchange),2))
        {
            //теперь с этим платежом он все отдал
            mysql_time_query($link, 'update trips set
    buy_clients="1"
    where id = "' . ht($_POST['id']) . '"');
        } else
        {
            mysql_time_query($link, 'update trips set
    buy_clients="0"
    where id = "' . ht($_POST['id']) . '"');
        }

        //оператор
        $all_paid=round(((float)$row_uu11["paid_operator_rates"]),2);
        if(($all_paid>=round(((float)$cost_operator_exchange),2))and($row_uu11["paid_operator_rates"]>0))
        {
            //теперь с этим платежом он все отдал
            mysql_time_query($link, 'update trips set
    buy_operator="1"
    where id = "' . ht($_POST['id']) . '"');
        } else
        {
            mysql_time_query($link, 'update trips set
    buy_operator="0"
    where id = "' . ht($_POST['id']) . '"');
        }


    } else
    {
        //рублевый тур

        //клиент
        $all_paid=round(((float)$row_uu11["paid_client"]),2);
        if($all_paid>=round(((float)$cost_client),2))
        {
            //теперь с этим платежом он все отдал
            mysql_time_query($link, 'update trips set
    buy_clients="1"
    where id = "' . ht($_POST['id']) . '"');
        } else
        {
            mysql_time_query($link, 'update trips set
    buy_clients="0"
    where id = "' . ht($_POST['id']) . '"');
        }

        //оператор
        $all_paid=round(((float)$row_uu11["paid_operator"]),2);
        if(($all_paid>=round(((float)$cost_operator),2))and($row_uu11["paid_operator"]>0))
        {
            //теперь с этим платежом он все отдал
            mysql_time_query($link, 'update trips set
    buy_operator="1"
    where id = "' . ht($_POST['id']) . '"');
        } else
        {
            mysql_time_query($link, 'update trips set
    buy_operator="0"
    where id = "' . ht($_POST['id']) . '"');
        }
    }


//изменить стоимости в туре
mysql_time_query($link,'update trips set 
                                                                                                                               
cost_client="'.ht($cost_client).'",                           
cost_client_exchange="'.ht($cost_client_exchange).'",     
exchange_rates="'.ht($exchange_rates).'",            
cost_operator="'.ht($cost_operator).'", 
cost_operator_exchange="'.ht($cost_operator_exchange).'",                                                           
exchange_rates_operator="'.ht($exchange_rates_operator).'",
discount="'.ht(trimc($_POST["com_rub"])).'"                                                                               
where id = "' . ht($_POST['id']) . '"');




$array_param_old=array(((int)$row_uu11["cost_client"]),$row_uu11["exchange_rates"],$row_uu11["cost_operator"],$row_uu11["exchange_rates_operator"],$row_uu11["discount"]);

$array_param_new=array();

$result_uu11 = mysql_time_query($link, 'select A.cost_client,A.exchange_rates,A.cost_operator,A.exchange_rates_operator,A.discount,A.id_user  from trips as A where A.id="' . ht($_POST['id']) . '"');
$num_results_uu11 = $result_uu11->num_rows;

if ($num_results_uu11 != 0) {

    $row_uu11 = mysqli_fetch_assoc($result_uu11);

    $array_param_new=array(((int)$row_uu11["cost_client"]),$row_uu11["exchange_rates"],$row_uu11["cost_operator"],$row_uu11["exchange_rates_operator"],$row_uu11["discount"]);

}




//добавить в историю это действие
AddHistoryTripsPrice('16',
    $id_user,
    $_POST["id"],
    $rate_i,
    $array_param_old,
    $array_param_new,
    $link,
    '');



//проставляем дату полной оплаты и по оператору и по туру. чтобы знать в каком месяце эту комиссию считать
//$array_param_old_ss=array(($row_uu["buy_clients"]),$row_uu["buy_operator"]);
$result_ss_new = mysql_time_query($link, 'select buy_clients,buy_operator,id from trips where id="' . ht($_POST["id"]) . '"');
$num_results_ss_new = $result_ss_new->num_rows;

if ($num_results_ss_new != 0) {
    $row_ss_new = mysqli_fetch_assoc($result_ss_new);
    $array_param_new_ss = array(($row_ss_new["buy_clients"]), $row_ss_new["buy_operator"]);

    if(($array_param_new_ss[0] == 1) and ($array_param_new_ss[1] == 1)) {
        //если все оплачено но мы тут то возможно что-то изменилось в комиссии или просто это конченая оплата
        $comiss_vip = 0;
        $comiss_ship=0;
        $comiss_vip = comiss_end_call($_POST["id"], $link);
        $comiss_ship = comiss_end_ship($_POST["id"], $link);
        mysql_time_query($link, 'update trips set
    
    commission="' . $comiss_vip . '",
    comission_partnership="'.$comiss_ship.'"
    where id = "' . ht($_POST["id"]) . '"');

        commission_add_ship($_POST["id"],$comiss_ship, $link);

    }


    if (($array_param_new_ss != $array_param_old_ss) and ($array_param_new_ss[0] == 1) and ($array_param_new_ss[1] == 1)) {
        //из состояния не оплачено во все оплачено
        mysql_time_query($link, 'update trips set
    
    date_buy_all="' . date("y.m.d") . ' ' . date("H:i:s") . '"
    where id = "' . ht($row_ss_new['id']) . '"');

        //уведомление о поступлении нового тура на проверку
        //уведомление о поступлении нового тура на проверку


        //уведомление о поступлении нового тура на проверку
        //уведомление о поступлении нового тура на проверку
        $text_not='<a href="tours/.id-'.$row_ss_new['id'].'">Тур №'.$row_ss_new['id'].'</a> - был полностью оплачен и поступил на проверку.';

        notif_role_list($row_uu11["id_user"],$id_user,$text_not,10);



    }
    if (($array_param_new_ss != $array_param_old_ss) and ($array_param_old_ss[0] == 1) and ($array_param_old_ss[1] == 1)) {
        //из состояния все оплачено в состояние что-то не оплачено до конца
        mysql_time_query($link, 'update trips set
    
    date_buy_all="0000-00-00 00:00:00",commission=0,comission_partnership=0
    where id = "' . ht($row_ss_new['id']) . '"');

        mysql_time_query($link, 'delete FROM affiliates_history_trips where id_trips="' . ht($row_ss_new['id']) . '"');
    }
}

//определяем если есть сроки оплаты какие части стали оплачены а какие наоборот перестали быть
//определяем если есть сроки оплаты какие части стали оплачены а какие наоборот перестали быть
//|
//V
//-> клиент -> оператор
$trips_call=$_POST["id"];
for ($i = 0; $i < 2; $i++) {

    $procr = proc_call($trips_call, $i,$link); //определяем какой процент оплачен

    $result_uuее = mysql_time_query($link, 'select A.id,A.proc from trips_payment_term as A where 
A.id_trips="' . ht($trips_call) . '" and A.type="'.$i.'" and A.visible=1 order by A.date');

    if ($result_uuее) {
        while ($row_uuее = mysqli_fetch_assoc($result_uuее)) {
            $yes = 1;
            if ($row_uuее["proc"] > $procr) {
                $yes = 0;
            }
            mysql_time_query($link, 'update trips_payment_term set yes="' . $yes . '" where id = "' . ht($row_uuее['id']) . '"');
        }
    }
}
//A
//|
//определяем если есть сроки оплаты какие части стали оплачены а какие наоборот перестали быть
//определяем если есть сроки оплаты какие части стали оплачены а какие наоборот перестали быть



end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo" => $status_echo,"count" => $dom,"for_id"=>ht($_POST['id']),"error" =>  $stack_error,"download" => $download,"upload_mm" => 1);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);



?>