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
if(!token_access_new($token,'bt_edit_21',$_POST["id"],"rema",2880))
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
if(((!isset($_POST['tk1']))or(trim($_POST['tk1'])!='dsQ679RSadfd2re')))
{
    $debug=h4a(77,$echo_r,$debug);
    goto end_code;
}



$mas_responsible=array();
$result_uu11 = mysql_time_query($link, 'select A.*  from trips_payment as A where A.id="' . ht($_POST['id']) . '"');
$num_results_uu11 = $result_uu11->num_rows;

if ($num_results_uu11 != 0) {
    $row_uu11 = mysqli_fetch_assoc($result_uu11);
    array_push($mas_responsible,$row_uu11["id_user"]);
} else
{
    $debug=h4a(95,$echo_r,$debug);
    goto end_code;
}



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





$status_admin=0;
$result_t=mysql_time_query($link,'select DISTINCT A.id,A.discount, A.id_user,A.shopper,A.id_shopper,A.id_contract,A.comment,A.number_to,A.hotel,A.id_country,A.place_name,A.date_start,A.date_end,A.number_to,A.id_contract,A.cost_client,A.id_exchange,A.cost_operator_exchange,A.cost_operator,A.cost_client_exchange,A.buy_clients,A.buy_operator,A.paid_operator,A.paid_operator_rates,A.exchange_rates,A.paid_client,A.paid_client_rates,A.date_prepaid,A.status_admin from trips as A where A.id_a_company="'.$id_company.'" and A.id="'.ht($row_uu11['id_trips']).'" and A.visible=1');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{
    $debug=h4a(5,$echo_r,$debug);
    goto end_code;

} else
{
    $row_uu = mysqli_fetch_assoc($result_t);
    $array_param_old_ss=array(($row_uu["buy_clients"]),$row_uu["buy_operator"]);
    $status_admin=$row_uu['status_admin'];
}



if($status_admin!=0) {
    $debug=h4a(002,$echo_r,$debug);
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

$result_uu_rate=mysql_time_query($link,'select a.char,a.small_name,a.code from booking_exchange as a  where a.id="'.ht($row_uu["id_exchange"]).'"');
$num_results_uu_rate = $result_uu_rate->num_rows;

if($num_results_uu_rate!=0) {
    $row_uu_rate = mysqli_fetch_assoc($result_uu_rate);
}

$style_kurs=0;
if ($row_uu_rate["char"] == "₽") {
    //рублевый тур

} else {
//значит выводим в валюте потому что остаток клиент отдает в валюте
    $style_kurs=1;

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

if ((!isset($_POST['method'])) or (trim($_POST['method']) == '')) {
    array_push($stack_error, "method");
}


$date_valid=0;
if(!validateDate($_POST['buy_date'],'Y-m-d'))
{
    array_push($stack_error, "buy_date");
    $date_valid=1;
}
//**************************************************
//**************************************************

//вдруг клиент уже все выплатил
//вдруг клиент не может использовать такой метод оплаты


//вдруг клиенту нечего возвращать



//вдруг туроператору уже все оплатили


//вдруг ему нечего возвращать



//print_r ($stack_error);
if(count($stack_error)!=0)
{
    goto end_code;
}

$status_ee='ok';


//удалить все об этой запись по оплате со всеми изменениями в базе - сама оплата не удаляется. только ее последствия
dell_buy_trips($id,$link);






$date_=date("y.m.d").' '.date("H:i:s");
$avans_rates=0;
if($style_kurs==1) {
    $avans_rates = number_format(((float)trimc($_POST["summ"]) / (float)trimc($_POST["curs"])), 2, '.', '');
}


if((isset($_POST["curs"]))and($_POST["curs"]!='')) {
    $kuu = ht(trimc($_POST["curs"]));
}
else
{
    $kuu = 0;
}


//добавить оплату в базу
mysql_time_query($link,'update trips_payment set 
                                                                                                                               
id_user="'.ht($id_user).'",                           
who="'.ht(((int)$_POST["kto_komy"]-1)).'",     
id_operation="'.ht($_POST["operation"]).'",            
id_payment_method="'.ht($_POST["method"]).'", 
sum="'.ht(trimc($_POST["summ"])).'",                                                           
sum_rate="'.$avans_rates.'",                                                                
rate="'.$kuu.'",                                                 
perc_commission="'.ht(trimc($_POST["com_proc"])).'",
commission="'.ht(trimc($_POST["com_rub"])).'",                                   
comment="'.ht($_POST["comment"]).'",                                        
date_payment="'.ht($_POST["buy_date"]).'"                                                                               
where id = "' . ht($_POST['id']) . '"');


$new_id_payment=ht($_POST['id']);


$result_t=mysql_time_query($link,'select DISTINCT A.id,A.discount, A.id_user,A.shopper,A.id_shopper,A.id_contract,A.comment,A.number_to,A.hotel,A.id_country,A.place_name,A.date_start,A.date_end,A.number_to,A.id_contract,A.cost_client,A.id_exchange,A.cost_operator_exchange,A.cost_operator,A.cost_client_exchange,A.buy_clients,A.buy_operator,A.paid_operator,A.paid_operator_rates,A.exchange_rates,A.paid_client,A.paid_client_rates,A.date_prepaid from trips as A where A.id_a_company="'.$id_company.'" and A.id="'.ht($row_uu11['id_trips']).'" and A.visible=1');

$row_uu = mysqli_fetch_assoc($result_t);




//посмотреть изменять ли buy_clients или buy_operator
if(($_POST["kto_komy"]==1)and($_POST["operation"]==1)) {
   //вдруг это последняя оплата тогда считаем что этот тур полностью оплачен туристом
    if($style_kurs==1) {
        //валютный тур
        $all_paid=(float)$row_uu["paid_client_rates"]+(float)$avans_rates;
        $all_paid_rub=(float)$row_uu["paid_client"]+(float)trimc($_POST["summ"]);
        if($all_paid>=$row_uu["cost_client_exchange"])
        {
            //теперь с этим платежом он все отдал
            mysql_time_query($link, 'update trips set
    buy_clients="1"
    where id = "' . ht($row_uu11['id_trips']) . '"');
        }

        mysql_time_query($link, 'update trips set
    paid_client_rates="'.$all_paid.'",
    paid_client="'.$all_paid_rub.'"
    
    where id = "' . ht($row_uu11['id_trips']) . '"');



    } else
    {
        //рублевый счет
        $all_paid=0;
        $all_paid_rub=(float)$row_uu["paid_client"]+(float)trimc($_POST["summ"]);
        if($all_paid_rub>=$row_uu["cost_client"])
        {
            //теперь с этим платежом он все отдал
            mysql_time_query($link, 'update trips set
    buy_clients="1"
    where id = "' . ht($row_uu11['id_trips']) . '"');
        }

        mysql_time_query($link, 'update trips set
    paid_client_rates="'.$all_paid.'",
    paid_client="'.$all_paid_rub.'"
    
    where id = "' . ht($row_uu11['id_trips']) . '"');
    }




}

if(($_POST["kto_komy"]==1)and($_POST["operation"]==2)) {
    //вдруг было все оплачено и теперь при возврате часть он стал нам должен
    if($style_kurs==1) {
        //валютный тур
        $all_paid=(float)$row_uu["paid_client_rates"]-(float)$avans_rates;
        $all_paid_rub=(float)$row_uu["paid_client"]-(float)trimc($_POST["summ"]);
        if($all_paid<$row_uu["cost_client_exchange"])
        {
            //теперь с этим платежом он все отдал
            mysql_time_query($link, 'update trips set
    buy_clients="0"
    where id = "' . ht($row_uu11['id_trips']) . '"');
        }

        mysql_time_query($link, 'update trips set
    paid_client_rates="'.$all_paid.'",
    paid_client="'.$all_paid_rub.'"
    
    where id = "' . ht($row_uu11['id_trips']) . '"');
    } else
    {
        //рублевый счет
        $all_paid=0;
        $all_paid_rub=(float)$row_uu["paid_client"]-(float)trimc($_POST["summ"]);
        if($all_paid_rub<$row_uu["cost_client"])
        {
            //теперь с этим платежом он все отдал
            mysql_time_query($link, 'update trips set
    buy_clients="0"
    where id = "' . ht($row_uu11['id_trips']) . '"');
        }

        mysql_time_query($link, 'update trips set
    paid_client_rates="'.$all_paid.'",
    paid_client="'.$all_paid_rub.'"
    
    where id = "' . ht($row_uu11['id_trips']) . '"');
    }



}
if(($_POST["kto_komy"]==2)and($_POST["operation"]==1)) {
    //вдруг это последняя оплата туроператору, тогда считаем что этот тур полностью оплачен нами
    if($style_kurs==1) {
        //валютный тур
        $all_paid=(float)$row_uu["paid_operator_rates"]+(float)$avans_rates;
        $all_paid_rub=(float)$row_uu["paid_operator"]+(float)trimc($_POST["summ"]);
        $debug=$all_paid.'>='.$row_uu["cost_operator_exchange"];
        if($all_paid>=$row_uu["cost_operator_exchange"])
        {
            //теперь с этим платежом мы все отдали
            mysql_time_query($link, 'update trips set
    buy_operator="1"
    where id = "' . ht($row_uu11['id_trips']) . '"');
        }

        mysql_time_query($link, 'update trips set
    paid_operator_rates="'.$all_paid.'",
    paid_operator="'.$all_paid_rub.'"
    
    where id = "' . ht($row_uu11['id_trips']) . '"');


    } else
    {
        //рублевый счет
        $all_paid=0;
        $all_paid_rub=(float)$row_uu["paid_operator"]+(float)trimc($_POST["summ"]);
        if($all_paid_rub>=$row_uu["cost_operator"])
        {
            //теперь с этим платежом он все отдал
            mysql_time_query($link, 'update trips set
    buy_operator="1"
    where id = "' . ht($row_uu11['id_trips']) . '"');
        }

        mysql_time_query($link, 'update trips set
    paid_operator_rates="'.$all_paid.'",
    paid_operator="'.$all_paid_rub.'"
    
    where id = "' . ht($row_uu11['id_trips']) . '"');
    }



}
if(($_POST["kto_komy"]==2)and($_POST["operation"]==2)) {
    //вдруг было все оплачено и теперь при возврате часть мы снова стали должны оператору
    if($style_kurs==1) {
        //валютный тур
        $all_paid=(float)$row_uu["paid_operator_rates"]-(float)$avans_rates;
        $all_paid_rub=(float)$row_uu["paid_operator"]-(float)trimc($_POST["summ"]);
        if($all_paid<$row_uu["cost_operator_exchange"])
        {
            //теперь с этим платежом он не все отдал
            mysql_time_query($link, 'update trips set
    buy_operator="0"
    where id = "' . ht($row_uu11['id_trips']) . '"');
        }

        mysql_time_query($link, 'update trips set
    paid_operator_rates="'.$all_paid.'",
    paid_operator="'.$all_paid_rub.'"
    
    where id = "' . ht($row_uu11['id_trips']) . '"');
    } else
    {
        //рублевый счет
        $all_paid=0;
        $all_paid_rub=(float)$row_uu["paid_operator"]-(float)trimc($_POST["summ"]);
        if($all_paid_rub<$row_uu["cost_operator"])
        {
            //теперь с этим платежом он не все отдал
            mysql_time_query($link, 'update trips set
    buy_operator="0"
    where id = "' . ht($row_uu11['id_trips']) . '"');
        }

        mysql_time_query($link, 'update trips set
    paid_operator_rates="'.$all_paid.'",
    paid_operator="'.$all_paid_rub.'"
    
    where id = "' . ht($row_uu11['id_trips']) . '"');
    }


}

$array_param_old=array(((int)$row_uu11["who"]+1),$row_uu11["id_operation"],$row_uu11["sum"],$row_uu11["sum_rate"],$row_uu11["commission"],$row_uu11["id_payment_method"],$row_uu11["date_payment"],$row_uu11["comment"]);

$array_param_new=array();

$result_uu11 = mysql_time_query($link, 'select A.*  from trips_payment as A where A.id="' . ht($_POST['id']) . '"');
$num_results_uu11 = $result_uu11->num_rows;

if ($num_results_uu11 != 0) {

    $row_uu11 = mysqli_fetch_assoc($result_uu11);

    $array_param_new=array(((int)$row_uu11["who"]+1),$row_uu11["id_operation"],$row_uu11["sum"],$row_uu11["sum_rate"],$row_uu11["commission"],$row_uu11["id_payment_method"],$row_uu11["date_payment"],$row_uu11["comment"]);

}



//добавить в историю это действие
AddHistoryTripsPay('14',
    $id_user,
    $row_uu11['id_trips'],
    $new_id_payment,
    $array_param_old,
    $array_param_new,
    $link,
    '');



//проставляем дату полной оплаты и по оператору и по туру. чтобы знать в каком месяце эту комиссию считать
//$array_param_old=array(($row_uu["buy_clients"]),$row_uu["buy_operator"]);
$result_ss_new = mysql_time_query($link, 'select buy_clients,buy_operator,id from trips where id="' . ht($row_uu11['id_trips']) . '"');
$num_results_ss_new = $result_ss_new->num_rows;

if ($num_results_ss_new != 0) {
    $row_ss_new = mysqli_fetch_assoc($result_ss_new);
    $array_param_new_ss = array(($row_ss_new["buy_clients"]), $row_ss_new["buy_operator"]);

    if(($array_param_new_ss[0] == 1) and ($array_param_new_ss[1] == 1)) {
        //если все оплачено но мы тут то возможно что-то изменилось в комиссии или просто это конченая оплата
        $comiss_vip = 0;
        $comiss_vip = comiss_end_call($row_uu11['id_trips'], $link);

        mysql_time_query($link, 'update trips set
    
    commission="' . $comiss_vip . '"
    where id = "' . ht($row_uu11['id_trips']) . '"');

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

        notif_role_list($row_uu["id_user"],$id_user,$text_not,10);

    }
    if (($array_param_new_ss != $array_param_old_ss) and ($array_param_old_ss[0] == 1) and ($array_param_old_ss[1] == 1)) {
        //из состояния все оплачено в состояние что-то не оплачено до конца
        mysql_time_query($link, 'update trips set
    
    date_buy_all="0000-00-00 00:00:00",commission=0
    where id = "' . ht($row_ss_new['id']) . '"');
    }
}


//определяем если есть сроки оплаты какие части стали оплачены а какие наоборот перестали быть
//определяем если есть сроки оплаты какие части стали оплачены а какие наоборот перестали быть
//|
//V
//-> клиент -> оператор
$trips_call=$row_uu11['id_trips'];
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

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo" => $status_echo,"count" => $dom,"for_id"=>ht($row_uu11['id_trips']),"error" =>  $stack_error,"download" => $download,"upload_mm" => 1);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);



?>