<?php
//получение карточки клиента
$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';
header("Content-type: application/json");
$query_string='';
$query_string_xx='';
$query_string_xx1='';
$status_ee='error';
$eshe=0;
$echo='';
$vid=0;
$debug='';
$count_all_all=0;
$basket='';
$disco=0;
$id=htmlspecialchars($_GET['id']);
$dom=0;
$status_echo='';
//проверка что есть такой город что это число
//проверка что пользователь зарегистрирован

$echo_r=1; //выводить или нет ошибку 0 -нет
$debug='';

//**************************************************
/*
if(!token_access_new($token,'bt_booking_end_client',$id,"s_form"))
{
$debug=h4a(100,$echo_r,$debug);
goto end_code;
}
*/


if ( count($_GET) != 5 )
{
    $debug=h4a(1,$echo_r,$debug);
    goto end_code;
}

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

    if (is_numeric($_GET['id'])) {
        //нужна одна карточка по клиенту
        $result_t=mysql_time_query($link,'Select DISTINCT A.id,A.discount,A.doc,A.id_a_company, A.id_user,A.shopper,A.id_shopper,A.id_contract,A.comment,A.number_to,A.hotel,A.id_country,A.place_name,A.date_start,A.date_end,A.number_to,A.id_contract,A.cost_client,A.id_exchange,A.cost_operator_exchange,A.cost_operator,A.cost_client_exchange,A.buy_clients,A.buy_operator,A.paid_operator,A.paid_operator_rates,A.exchange_rates,A.paid_client,A.paid_client_rates,A.comment,A.date_prepaid,A.status_admin,A.commission_fix from trips as A where A.visible=1 AND A.id="'.ht($_GET['id']).'" and A.id_a_company IN ('.$id_company.')');

//echo('Select b.*,r.id_company from k_clients as b,r_user as r where b.id="'.ht($_GET['id']).'" and b.visible=1 and b.id_user=r.id');
        $num_results_t = $result_t->num_rows;
        if($num_results_t==0)
        {
            $debug=h4a(5,$echo_r,$debug);
            goto end_code;

        } else
        {
            $row_8 = mysqli_fetch_assoc($result_t);
        }
    }

//**************************************************
//**************************************************
//**************************************************
//**************************************************
//**************************************************


$status_ee='ok';



$task_cloud_block='';
$new_sayx='';
$no_click_vis ??= '';
if((isset($new_sa))and($new_sa==1))
{
    $new_sayx='new-say';
}
/*
10 -100
n  - x
*/
$const_day=10; //считаем что 10 дней это 100 процентов просрочка
$PROC=0;
$zad=dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_8["ring_datetime"]);
$pros=0;
if(($zad>0)and($row_8["status"]==0))
{
    $PROC=round($zad*100/$const_day);
    if($PROC>100)
    {
        $PROC=100;
    }
    $pros=1;
}



$rrdx=explode(' ',$row_8["ring_datetime"]);
$rrd1x=explode(':',$rrdx[1]);


$comment_b='';
$svyz='—';
$time_z='—';



$result_uuwe = mysql_time_query($link, 'select status from trips where id="' . ht($row_8["id"]) . '"');
$num_results_uuwe = $result_uuwe->num_rows;

if ($num_results_uuwe != 0) {
    $row_uuwe = mysqli_fetch_assoc($result_uuwe);


}


$cancel_class='';
if($row_uuwe["status"]==2) {
    $cancel_class='cancel_trips';
}





$task_cloud_block.='<div class="teps" rel_w="'.$PROC.'" style="width: 0%;"><div class="peg_div"><div></div></div></div>

	<div class="trips-b-number">'.$row_8["id"];

//ваш комментарий к туру
if (($role->permission('Туры','R'))or($sign_admin==1)) {
//выводим последний комментарий если тур просматривает хозяин тура или хозяин этого комментария
    $result_uui = mysql_time_query($link, 'select comment from trips_status_history_new where id_trips="' . ht($row_8["id"]) . '" and action_history="15" and id_user="' . $id_user . '" order by datetimes desc limit 1');
    $num_results_uui = $result_uui->num_rows;

    if ($num_results_uui != 0) {
        $row_uui = mysqli_fetch_assoc($result_uui);


        $task_cloud_block .= '<div class="yes-note zame_kk js-zame-tours" data-tooltip = "' . ht($row_uui["comment"]) . '" ></div >';
    } else {
        $task_cloud_block .= '<div class="zame_kk js-zame-tours" data-tooltip = "Написать заметку о туре" ></div >';
    }


    $task_cloud_block .= '<div class="form-rate-ok1 form-rate-ok-chat"><div class="rate-input"><div class="rates_visible">';

    $task_cloud_block .= '<label style="text-transform: uppercase; font-size:10px;">Заметка по туру</label><div class="div_textarea_otziv1 js-prs"  style="margin-top: 0px;">
			<div class="otziv_add">';


    $task_cloud_block .= '<textarea cols="10" rows="1" placeholder="" id="otziv_chat1_' . $row_8["id"] . '" name="chat_text" class="di text_area_otziv no_comment_bill22_2 tyyo1 
 gloab"></textarea>';

    $task_cloud_block .= '</div>      
</div>  

        <script type="text/javascript"> 
	  $(function (){ 
$(\'#otziv_chat1_' . $row_8["id"] . '\').autoResize({extraSpace : 10});
$(\'.tyyo1' . +$row_8["id"] . '\').trigger(\'keyup\');
});

	</script>
	';
    $task_cloud_block .= '</div></div><div class="rate-button1"><div class="js-ok-rate-chat-left">ОК</div></div></div>';

}


if($row_8["comment"]!='') {
    $task_cloud_block.='<div class="chat_kk js-chat-tours" data-tooltip = "Доступно впечатление по туру" ></div >';
} else
{
    $result_mi=mysql_time_query($link,'SELECT a.* FROM trips_fly_history AS a WHERE a.id_trips="'.$row_8["id"].'" order by a.datetime DESC limit 0,1');

    if($result_mi->num_rows!=0) {
        $row_mi = mysqli_fetch_assoc($result_mi);

        if($row_mi["end_fly"]!='0000-00-00 00:00:00') {
            $d_day = dateDiff_1(date("y-m-d") . ' ' . date("H:i:s"), $row_mi["end_fly"]);
            if($d_day>0)
            {
                $task_cloud_block.='<div class="chat_kk red-chat js-chat-tours-add" data-tooltip = "Добавить впечатление о туре" ></div >';






                $task_cloud_block.='<div class="form-rate-ok form-rate-ok-chat"><div class="rate-input"><div class="rates_visible">';

                $task_cloud_block.='<label style="text-transform: uppercase; font-size:10px;">Впечатление по туру</label><div class="div_textarea_otziv1 js-prs"  style="margin-top: 0px;">
			<div class="otziv_add">';


                $task_cloud_block.='<textarea cols="10" rows="1" placeholder="" id="otziv_chat'.$row_8["id"].'" name="chat_text" class="di text_area_otziv no_comment_bill22_2 tyyo</div>  
 gloab"></textarea>';

                $task_cloud_block.='</div>      
</div>  

        <script type="text/javascript"> 
	  $(function (){ 
$(\'#otziv_chat'.$row_8["id"].'\').autoResize({extraSpace : 10});
$(\'.tyyo'.+$row_8["id"].'\').trigger(\'keyup\');
});

	</script>
	';
                $task_cloud_block.='</div></div><div class="rate-button1"><div class="js-ok-rate-chat">ОК</div></div></div>';


            }
        }
    }
}


$task_cloud_block.='</div>
	<div class="trips-b-info"><span class="label-task-gg ">Информация о туре
</span>';

if($row_8["shopper"]==1) {
    //частное лицо
    $result_uu = mysql_time_query($link, 'select fio from k_clients where id="'.ht($row_8["id_shopper"]) . '"');
} else
{
    //2 фирма
    $result_uu = mysql_time_query($link, 'select name as fio from k_organization where id="'.ht($row_8["id_shopper"]) . '"');
}
$num_results_uu = $result_uu->num_rows;

if($num_results_uu!=0)
{
    $row_uu = mysqli_fetch_assoc($result_uu);
    if($row_8["shopper"]==1) {
        //частное лицо
        $task_cloud_block.='<div class="pass_wh_trips"><a class="js-client" iod="'.$row_8["id_shopper"].'"><span class="js-glu-f-'.$row_8["id_shopper"].'">'.$row_uu["fio"].'</span></a></div>';
    } else
    {
        //фирма
        $task_cloud_block.='<div class="pass_wh_trips"><a class="js-org" iod="'.$row_8["id_shopper"].'"><span class="js-glo-n-'.$row_8["id_shopper"].'">'.$row_uu["fio"].'</span></a></div>';
    }
}


//статус тура
$js_mod='';
if(($role->permission('Туры','S'))or($sign_admin==1)) {

    $js_mod='js-status-trips';
}


if($row_uuwe["status"]==2) {
    $task_cloud_block.='<div class="status_admin s_a_1 js-update-cancel-trips" style="background-color: #fd8080 !important; margin-right:5px;">аннулирован</div>';
}

if(($row_8["buy_clients"]==1)and($row_8["buy_operator"]==1))
{
    //значит все оплачено и выводить текущий статус заявки
    $status_admin='на проверке';
    if($row_8["status_admin"]==1) {  $status_admin='к оплате'; }
    if($row_8["status_admin"]==2) {  $status_admin='оплачено'; }

    $task_cloud_block.='<div class="status_admin s_a_'.$row_8["status_admin"].' '.$js_mod.'">'.$status_admin.'</div>';

}else
{
    //выводим последний комментарий если тур просматривает хозяин тура или хозяин этого комментария
    $result_uui = mysql_time_query($link, 'select comment from trips_status_history_new where id_trips="' . ht($row_8["id"]) . '" and action_history="15" and id_user="'.$id_user.'" order by datetimes desc limit 1');
    $num_results_uui = $result_uui->num_rows;

    if ($num_results_uui != 0) {
        $row_uui = mysqli_fetch_assoc($result_uui);
        $task_cloud_block.='<div class="commun">'.$row_uui["comment"].'</div>';
    }
}



$kuda_trips='';


$result_uu = mysql_time_query($link, 'select name from trips_country where id="' . ht($row_8["id_country"]) . '"');
$num_results_uu = $result_uu->num_rows;

if ($num_results_uu != 0) {
    $row_uu = mysqli_fetch_assoc($result_uu);
    $kuda_trips.=$row_uu["name"];
}


if($row_8['place_name']!='')
{
    $kuda_trips.=', '.$row_8['place_name'];
}
if($row_8['hotel']!='')
{
    $kuda_trips.=' / '.$row_8['hotel'];
}

$date_mass=explode("-",ht($row_8['date_start']));
$date_start=$date_mass[2].'.'.$date_mass[1].'.'.$date_mass[0];

$date_mass = explode("-", ht($row_8['date_end']));
$date_end = $date_mass[2] . '.' . $date_mass[1] . '.' . $date_mass[0];

$task_cloud_block.='<div class="pass_wh_trips"><span class="kuda-trips">'.$kuda_trips.'</span>
<span class="date-trips">'.$date_start.' / '.$date_end.'</span></div>';


$result_uu=mysql_time_query($link,'select name_user from r_user where id="'.ht($row_8['id_user']).'"');
$num_results_uu = $result_uu->num_rows;

if($num_results_uu!=0)
{
    $row_uu = mysqli_fetch_assoc($result_uu);
    $task_cloud_block.='<div class="pass_wh_trips"><label>Менеджер</label><span class="obi">'.$row_uu['name_user'].'</span></div>';


}

$number_to='—';
if($row_8["number_to"]!='')
{
    $number_to=$row_8["number_to"];
}

$task_cloud_block.='<div class="pass_wh_trips"><label>Номер заявки у ТО</label><span class="obi">'.$number_to.'</span></div>';

$result_uu = mysql_time_query($link, 'select name,date_doc from trips_contract where id="' . ht($row_8["id_contract"]) . '"');
$num_results_uu = $result_uu->num_rows;

if ($num_results_uu != 0) {
    $row_uu = mysqli_fetch_assoc($result_uu);
    $date_doc_=explode("-",$row_uu["name"]);
    $date_r1=explode("/",htmlspecialchars(trimc($date_doc_[0])));

    $date_ddd=$date_r1[0].'.'.$date_r1[1].'.'.$date_r1[2];

}




$task_cloud_block.='<div class="pass_wh_trips"><label>Договор</label><span class="obi">'.$row_uu["name"].' от '.date_ex(0,$row_uu["date_doc"]);
if(($row_8["doc"]=='0000-00-00')or($row_8["doc"]=='')) {
    $task_cloud_block.=' <span doc="" class="oo_date  issue-block" style="font-size: 12px;" > (<div class="help-jj red-jj js-issue-doc" > не выдан </div >)';
} else
{
    $task_cloud_block.=' <span  doc="'.date_ex(0,$row_8["doc"]).'" class="oo_date  issue-block" style="font-size: 12px;" > (<div class="help-jj js-issue-doc green-jj" > выдан '.date_ex(0,$row_8["doc"]).' </div >)';
}


$task_cloud_block.='<div class="form-rate-ok form-rate-ok-doc"><div class="rate-input"><div class="rates_visible"><div class="input_2018"><label>Когда выдан</label><input name="doc_date" value="" id="date_12466" class="input_new_2018 required date_picker_xe js-docc" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div></div><div class="rate-button js-ok-rate-doc">ok</div></div>';


$task_cloud_block.='</span ></span></div>';









$task_cloud_block.='<div class="pass_wh_trips"><label>Время вылетов
</label><span class="obi">';
//вылетает

$result_mi=mysql_time_query($link,'SELECT a.* FROM trips_fly_history AS a WHERE a.id_trips="'.$row_8["id"].'" order by a.datetime DESC limit 0,1');

if($result_mi->num_rows!=0)
{
    $row_mi = mysqli_fetch_assoc($result_mi);
    $startx=$row_mi["start_fly"];
    $endx=$row_mi["end_fly"];
}

$d_day=dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_mi["start_fly"]);
//echo($d_day);
$echo_j='';

$class_none='';
if($d_day>0) {
    $class_none = 'style="display:none;"';

}


if($startx=='0000-00-00 00:00:00') {
    $task_cloud_block .= '<div ' . $class_none . ' class="top_mi_n_m ' . $class_start . '" data-tooltip="Вылетает на отдых"><div class="center_vert"><div class="c_start"><i></i><span class="js-mi-x1 mi_m">Не указано <span class="oo_date">(<div class="help-jj red-jj">не забудь</div>)</span></span></div></div></div>';
} else
{
    $task_cloud_block .= '<div ' . $class_none . ' class="top_mi_n_m ' . $class_start . '" data-tooltip="Вылетает на отдых"><div class="center_vert"><div class="c_start"><i></i><span class="js-mi-x1 mi_m">' . trips_neo($startx) . '</span></div></div></div>';
}






//прилетает

$d_day='';
$d_day=dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_mi["end_fly"]);
//echo($d_day);
//echo($row_8["end_fly"]);
$echo_j='';

if($endx=='0000-00-00 00:00:00') {
    $task_cloud_block .= '<div class="' . $class_end . '" data-tooltip="Вылетает с отдыха"><div class="center_vert"><div class="c_end"><i></i><span class="js-mi-x2 mi_m">Не указано <span class="oo_date">(<div class="help-jj red-jj">не забудь</div>)</span></span></div></div></div>';

} else {

    $task_cloud_block .= '<div class="' . $class_end . '" data-tooltip="Вылетает с отдыха"><div class="center_vert"><div class="c_end"><i></i><span class="js-mi-x2 mi_m">' . trips_neo($endx) . '</span></div></div></div>';

}









$task_cloud_block.='</span></div></div><div class="trips-b-user js-trips-comm"><span class="label-task-gg ">Расчеты с туристом
</span>';

//узнаем код по рублю
$result_uu_rub = mysql_time_query($link, 'select A.code,A.small_name from booking_exchange A where A.id_a_company IN (' . ht($id_group_company_list) . ') and A.char="₽"');
$num_results_uu_rub = $result_uu_rub->num_rows;

if ($num_results_uu_rub != 0) {
    $row_uu_rub = mysqli_fetch_assoc($result_uu_rub);
}



$result_uu_rate=mysql_time_query($link,'select a.char,a.small_name,a.code from booking_exchange as a  where a.id="'.ht($row_8["id_exchange"]).'"');
$num_results_uu_rate = $result_uu_rate->num_rows;

if($num_results_uu_rate!=0) {
    $row_uu_rate = mysqli_fetch_assoc($result_uu_rate);
}

//определим сколько выплатил клиент
if ($row_uu_rate["char"] == "₽") {

    $sum_rub=(float)$row_8["paid_client"];
    //$procr=floor(($sum_rub/$row_8["cost_client"])*100);
    $procr = round((($sum_rub *100) /$row_8["cost_client"]),4);

} else
{
    //значит выводим в валюте потому что остаток клиент отдает в валюте

    $sum_rub=(float)$row_8["paid_client_rates"];
    //$procr=floor(($sum_rub/$row_8["cost_client_exchange"])*100);
    $procr = round((($sum_rub *100) /$row_8["cost_client_exchange"]),4);
}

if(($row_uu_rate["char"] == "₽")and($row_8["buy_clients"]!=1)) {
    $sum_balance=(float)$row_8["cost_client"]-$sum_rub;

}
if(($row_uu_rate["char"] != "₽")and($row_8["buy_clients"]!=1)) {
    $sum_valuta_balance = (float)$row_8["cost_client_exchange"] - $sum_rub;
}

$yes_s='';
$proc_text=round($procr).'%';
if(($procr>100)or($procr==100))
{
    $procr=100;
    $yes_s='<div class="yes-cost-trips"></div>';
    $proc_text='';
}
$task_cloud_block.='<div class="gr-50" proccs="'.$procr.'">
    <div class="circle-container-trips" >';

if($procr<100) {

    $task_cloud_block .= '<div class="circlestat" data-dimension="80" data-text="' . $proc_text . '" data-width="2" data-fontsize="16" data-percent="' . $procr . '" data-fgcolor="#25ae88" data-bgcolor="#e8eaed" data-fill="rgba(0,0,0,0)">' . $yes_s . '</div>';
} else
{
    $task_cloud_block .= '<div class="circlestat_yes_vse"></div>';
}
/*
        <div class="circlestat" data-dimension="80" data-text="'.$proc_text.'" data-width="2" data-fontsize="16" data-percent="'.$procr.'" data-fgcolor="#24c32d" data-bgcolor="#e8eaed" data-fill="rgba(0,0,0,0)">'.$yes_s.'</div>
*/


$task_cloud_block.='</div>';





$task_cloud_block.='<span data-tooltip="клиент отдал" class="js-all-cost cost_circle rate_'.$row_uu_rate["code"].'">'.number_format(((float)$sum_rub), 2, '.', ' ').'</span>';

if(($row_uu_rate["char"] == "₽")and($row_8["buy_clients"]!=1)) {
    //остаток клиента если только рублевый тур и не оплачен полностью
    $task_cloud_block .= '<span data-tooltip="остаток клиента" class="js-all-cost  hide-cost cost_circle rate_xxx">' . number_format(((float)$sum_balance), 2, '.', ' ') . '</span>';
}

if(($row_uu_rate["char"] != "₽")and($row_8["buy_clients"]==1))
{
    $task_cloud_block.='<span data-tooltip="клиент отдал" class="js-all-cost cost_circle hide-cost rate_'.$row_uu_rub["code"].'">'.number_format(((float)$row_8["paid_client"]), 2, '.', ' ').'</span>';
}
if(($row_uu_rate["char"] != "₽")and($row_8["buy_clients"]!=1))
{
    //если тур не рублевый и не полностью выплачен
    //формируем для остатка рассчетную запись
    $task_cloud_block .= '<span data-tooltip="остаток клиента" class="js-all-cost calc-balance hide-cost cost_circle rate_yyy"></span>';


}



if ($row_uu_rate["char"] == "₽") {
    //если тур только рублевый
    $sum_all_tooltip=$row_8["cost_client"];
    $task_cloud_block.='<div data-tooltip="общая сумма" class="cost_all_trips">из <span class="cost_circle js-all-price-trips rate_'.$row_uu_rate["code"].'">'.number_format(((float)$row_8["cost_client"]), 2, '.', ' ').'</span></div>';

    //вывод остатка
    $task_cloud_block.='<div class="cost_all_trips hide-cost">остаток<span style="display:none;" class="cost_circle rate_xxx">&nbsp;</span></div>';

} else
{
    //если тур не рублевый то выводим в валюте общую стоимость

    $sum_all_tooltip=$row_8["cost_client_exchange"];

    $task_cloud_block.='<div data-tooltip="общая сумма" class="cost_all_trips">из <span class="cost_circle js-all-price-trips rate_'.$row_uu_rate["code"].'">'.number_format(((float)$row_8["cost_client_exchange"]), 2, '.', ' ').'</span></div>';

    //если есть в валюте и он полностью оплатил выведим и в рублях мы же уже знаем сколько он оплатил всего
    if($row_8["buy_clients"]==1)
    {

        $task_cloud_block.='<div data-tooltip="общая сумма" class="cost_all_trips hide-cost">из <span class="cost_circle js-all-price-trips rate_'.$row_uu_rub["code"].'">'.number_format(((float)$row_8["paid_client"]), 2, '.', ' ').'</span></div>';

    } else
    {
        $task_cloud_block.='<div class="cost_all_trips hide-cost">остаток по курсу<span style="display:none;" class="cost_circle rate_yyy cacl-rrate js-rrate">&nbsp;</span></div>';
    }



}


$task_cloud_block.='</div>';


if ($row_uu_rate["char"] == "₽") {
//если валюта в рублях значит это поездка по россии и ничего больше не надо переводить в валюту
//просто выводить рассчитать остаток если еще не оплачено полностью

    if($row_8["buy_clients"]!=1) {
        $task_cloud_block .= '<div rate="" class="visible_rate js-exc-cost"><div code="xxx" class="eye-wall-trips  eye-my">показать остаток</div><div code="' . $row_uu_rate["code"] . '" class="eye-wall-trips">Общие цифры</div></div>';
    }


} else
{
    if($row_8["buy_clients"]==1)
    {


        $task_cloud_block.='<div class="visible_rate js-exc-cost"><div code="'.$row_uu_rub["code"].'" class="eye-wall-trips eye-my">показать в '.$row_uu_rub["small_name"].'</div><div code="'.$row_uu_rate["code"].'" class="eye-wall-trips">показать в '.$row_uu_rate["small_name"].'</div></div>';
    } else
    {
        $task_cloud_block.='<div rate="" class="visible_rate js-form-cost"><div code="yyy" class="eye-wall-trips calculate-balance eye-my" >рассчитать остаток в '.$row_uu_rub["small_name"].'</div><div code="'.$row_uu_rate["code"].'" class="eye-wall-trips">общие цифры в '.$row_uu_rate["small_name"].'</div>



<div class="form-rate-ok" balance="'.$sum_valuta_balance.'"><div class="rate-input"><div class="rates_visible"><div class="input_2018"><label>Курс ТО</label><input name="exchange_rates" value="" id="date_124" class="input_new_2018 required   money_mask xexchange_rates" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="tree"><div class="oper_name"></div></div></div>
</div></div><div class="rate-button js-ok-rate">ok</div></div>


</div>';
    }
}

//если все выплатил не показывать сроки оплат
//если не все и сроки не заданы просто горит сроки оплат кнопка
//если не все и сроки заданы высчитываем через сколько это и выводим с цветом

//не выводим сроки если все выплатили
if(($row_8["buy_clients"]!=1)and($procr!=100)) {

    $task_cloud_block .= '<div><div my="0" class="eye-srok-trips js-srok-my">срок оплаты</div></div>';

    $result_uuее = mysql_time_query($link, 'select A.* from trips_payment_term as A where 
A.id_trips="' . ht($row_8["id"]) . '" and A.type=0 and A.visible=1 order by A.date');

    if ($result_uuее) {
        $i = 0;
        while ($row_uuее = mysqli_fetch_assoc($result_uuее)) {

            if($row_uuее["proc"]>$procr)
            {
                //смотрим может уже такой процент выплатили тогда не выводим эту запись
                if (validateDate($row_uuее["date"], 'Y-m-d')) {

                    //подсказка 50 30 100% это сколько в деньгах
                    $tool_sum=round((($row_uuее["proc"]*$sum_all_tooltip)/100),2).' '.$row_uu_rate["char"];


                    $style_red='';

                    $d_day=dateDiff_1(date("Y-m-d").' '.date("H:i:s"),$row_uuее["date"].' 00:00:00');

                    if(($d_day>0))
                    {
                        $style_red='red_proc_sroki';
                    } else
                    {
                        if((abs($d_day)==0)or(abs($d_day)==1)or(abs($d_day)==2))
                        {

                            $style_red='yellow_proc_sroki';

                        }
                    }

                    $task_cloud_block .='<div class="sroki-2020-xto"><span data-tooltip="'.$tool_sum.'"  class="'.$style_red.'">'.(int)$row_uuее["proc"].'%</span> → '.task_neo_plus($row_uuее["date"].' 00:00:00').'</div>';

                }

            }

        }
    }
}

$act_='';

if(cookie_work('eye_t_'.$id_user.'_1','1','.',60,'0')) {
    $act_='display:none;';
}


$task_cloud_block.='</div><div class="trips-b-operator js-trips-comm" style="'.$act_.'"><span class="label-task-gg ">Расчеты с туроператором
</span>';

/*расчеты с туроператором
//расчеты с туроператором
//расчеты с туроператором
 |
 |
 V
*/


//определим сколько выплатили туроператору
if ($row_uu_rate["char"] == "₽") {

    $sum_rub=(float)$row_8["paid_operator"];
    if($row_8["cost_operator"]>0) {
       // $procr = floor(($sum_rub /$row_8["cost_operator"]) *100);
        $procr = round((($sum_rub *100) /$row_8["cost_operator"]),4);
    } else
    {
        $procr =0;
    }

} else
{
    //значит выводим в валюте потому что остаток клиент отдает в валюте

    $sum_rub=(float)$row_8["paid_operator_rates"];
    if($row_8["cost_operator_exchange"]>0) {

        //$procr = floor(($sum_rub / $row_8["cost_operator_exchange"]) *100);
        $procr = round((($sum_rub *100) /$row_8["cost_operator_exchange"]),4);
    } else
    {
        $procr =0;
    }
}

if(($row_uu_rate["char"] == "₽")and($row_8["buy_operator"]!=1)) {
    $sum_balance=(float)$row_8["cost_operator"]-$sum_rub;

}
if(($row_uu_rate["char"] != "₽")and($row_8["buy_operator"]!=1)) {
    $sum_valuta_balance = (float)$row_8["cost_operator_exchange"] - $sum_rub;
}

$yes_s='';
$proc_text=round($procr).'%';
if(($procr>100)or($procr==100))
{
    $procr=100;
    $yes_s='<div class="yes-cost-trips"></div>';
    $proc_text='';
}
$task_cloud_block.='<div class="gr-50" proccs="'.$procr.'">
    <div class="circle-container-trips" >';

if($procr<100) {

    $task_cloud_block .= '<div class="circlestat" data-dimension="80" data-text="' . $proc_text . '" data-width="2" data-fontsize="16" data-percent="' . $procr . '" data-fgcolor="#25ae88" data-bgcolor="#e8eaed" data-fill="rgba(0,0,0,0)">' . $yes_s . '</div>';
} else
{
    $task_cloud_block .= '<div class="circlestat_yes_vse"></div>';
}

        /*<div class="circlestat" data-dimension="80" data-text="'.$proc_text.'" data-width="2" data-fontsize="16" data-percent="'.$procr.'" data-fgcolor="#24c32d" data-bgcolor="#e8eaed" data-fill="rgba(0,0,0,0)">'.$yes_s.'</div>*/
$task_cloud_block .= '</div>';





$task_cloud_block.='<span data-tooltip="отдали туроператору" class="js-all-cost cost_circle rate_'.$row_uu_rate["code"].'">'.number_format(((float)$sum_rub), 2, '.', ' ').'</span>';

if(($row_uu_rate["char"] == "₽")and($row_8["buy_operator"]!=1)) {
    //остаток клиента если только рублевый тур и не оплачен полностью
    $task_cloud_block .= '<span data-tooltip="наш остаток" class="js-all-cost  hide-cost cost_circle rate_xxx">' . number_format(((float)$sum_balance), 2, '.', ' ') . '</span>';


    $sum_all_tooltip=$row_8["cost_operator"];
}



if(($row_uu_rate["char"] != "₽")and($row_8["buy_operator"]==1))
{
    $task_cloud_block.='<span data-tooltip="отдали туроператору" class="js-all-cost cost_circle hide-cost rate_'.$row_uu_rub["code"].'">'.number_format(((float)$row_8["paid_operator"]), 2, '.', ' ').'</span>';
}
if(($row_uu_rate["char"] != "₽")and($row_8["buy_operator"]!=1))
{
    //если тур не рублевый и не полностью выплачен
    //формируем для остатка рассчетную запись
    $task_cloud_block .= '<span data-tooltip="наш остаток" class="js-all-cost calc-balance hide-cost cost_circle rate_yyy"></span>';

    $sum_all_tooltip=$row_8["cost_operator_exchange"];

}

$class_no_cost='';

if ($row_uu_rate["char"] == "₽") {
    //если тур только рублевый
    if((float)$row_8["cost_operator"]==0)
    {
        $class_no_cost='style="color:#fd8080"';
    }

    $task_cloud_block.='<div data-tooltip="общая сумма" class="cost_all_trips">из <span class="cost_circle js-all-price-trips rate_'.$row_uu_rate["code"].'" '.$class_no_cost.'>'.number_format(((float)$row_8["cost_operator"]), 2, '.', ' ').'</span></div>';

    //вывод остатка
    $task_cloud_block.='<div class="cost_all_trips hide-cost">остаток<span style="display:none;" class="cost_circle rate_xxx">&nbsp;</span></div>';

} else
{
    //если тур не рублевый то выводим в валюте общую стоимость
    if((float)$row_8["cost_operator_exchange"]==0)
    {
        $class_no_cost='style="color:#fd8080"';
    }

    $task_cloud_block.='<div data-tooltip="общая сумма" class="cost_all_trips">из <span class="cost_circle js-all-price-trips rate_'.$row_uu_rate["code"].'" '.$class_no_cost.'>'.number_format(((float)$row_8["cost_operator_exchange"]), 2, '.', ' ').'</span></div>';

    //если есть в валюте и он полностью оплатил выведим и в рублях мы же уже знаем сколько он оплатил всего
    if($row_8["buy_operator"]==1)
    {

        $task_cloud_block.='<div data-tooltip="общая сумма" class="cost_all_trips hide-cost">из <span class="cost_circle js-all-price-trips rate_'.$row_uu_rub["code"].'">'.number_format(((float)$row_8["paid_operator"]), 2, '.', ' ').'</span></div>';

    } else
    {
        $task_cloud_block.='<div class="cost_all_trips hide-cost">остаток по курсу<span style="display:none;" class="cost_circle rate_yyy cacl-rrate js-rrate">&nbsp;</span></div>';
    }



}


$task_cloud_block.='</div>';


if ($row_uu_rate["char"] == "₽") {
//если валюта в рублях значит это поездка по россии и ничего больше не надо переводить в валюту
//просто выводить рассчитать остаток если еще не оплачено полностью

    if($row_8["buy_operator"]!=1) {
        $task_cloud_block .= '<div rate="" class="visible_rate js-exc-cost"><div code="xxx" class="eye-wall-trips  eye-my">показать остаток</div><div code="' . $row_uu_rate["code"] . '" class="eye-wall-trips">Общие цифры</div></div>';
    }


} else
{
    if($row_8["buy_operator"]==1)
    {


        $task_cloud_block.='<div class="visible_rate js-exc-cost"><div code="'.$row_uu_rub["code"].'" class="eye-wall-trips eye-my">показать в '.$row_uu_rub["small_name"].'</div><div code="'.$row_uu_rate["code"].'" class="eye-wall-trips">показать в '.$row_uu_rate["small_name"].'</div></div>';
    } else
    {
        $task_cloud_block.='<div rate="" class="visible_rate js-form-cost"><div code="yyy" class="eye-wall-trips calculate-balance eye-my" >рассчитать остаток в '.$row_uu_rub["small_name"].'</div><div code="'.$row_uu_rate["code"].'" class="eye-wall-trips">общие цифры в '.$row_uu_rate["small_name"].'</div>



<div class="form-rate-ok" balance="'.$sum_valuta_balance.'"><div class="rate-input"><div class="rates_visible"><div class="input_2018"><label>Курс ТО</label><input name="exchange_rates" value="" id="date_124" class="input_new_2018 required   money_mask xexchange_rates" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="tree"><div class="oper_name"></div></div></div>
</div></div><div class="rate-button js-ok-rate">ok</div></div>


</div>';
    }
}

//если все выплатил не показывать сроки оплат
//если не все и сроки не заданы просто горит сроки оплат кнопка
//если не все и сроки заданы высчитываем через сколько это и выводим с цветом

//не выводим сроки если все выплатили
if(($row_8["buy_operator"]!=1)and($procr!=100)) {

    $task_cloud_block .= '<div><div my="1" class="eye-srok-trips js-srok-my">срок оплаты</div></div>';

    $result_uuее = mysql_time_query($link, 'select A.* from trips_payment_term as A where 
A.id_trips="' . ht($row_8["id"]) . '" and A.type=1 and A.visible=1 order by A.proc');

    if ($result_uuее) {
        $i = 0;
        while ($row_uuее = mysqli_fetch_assoc($result_uuее)) {

            if($row_uuее["proc"]>$procr)
            {
                //смотрим может уже такой процент выплатили тогда не выводим эту запись
                if (validateDate($row_uuее["date"], 'Y-m-d')) {

                    //подсказка 50 30 100% это сколько в деньгах
                    $tool_sum=round((($row_uuее["proc"]*$sum_all_tooltip)/100),2).' '.$row_uu_rate["char"];

                    $style_red='';

                    $d_day=dateDiff_1(date("Y-m-d").' '.date("H:i:s"),$row_uuее["date"].' 00:00:00');

                    if(($d_day>0))
                    {
                        $style_red='red_proc_sroki';
                    } else
                    {
                        if((abs($d_day)==0)or(abs($d_day)==1)or(abs($d_day)==2))
                        {

                            $style_red='yellow_proc_sroki';

                        }
                    }

                    $task_cloud_block .='<div class="sroki-2020-xto"><span data-tooltip="'.$tool_sum.'" class="'.$style_red.'">'.(int)$row_uuее["proc"].'%</span> → '.task_neo_plus($row_uuее["date"].' 00:00:00').'</div>';

                }

            }

        }
    }
}



//рассчитываем комиссию
$comm_rub=0;
$proc_ii=0;


$act_='';

if(cookie_work('eye_t_'.$id_user.'_2','1','.',60,'0')) {
    $act_='display:none;';
}

$task_cloud_block.='</div><div class="trips-b-comission" style="'.$act_.'">';


$task_cloud_block.='<div class="commi-tips">';

if ($row_uu_rate["char"] == "₽") {
    //только рублевый тур
    if(($row_8["buy_clients"]==1)and($row_8["buy_operator"]==1))
    {
        //все оплатили
        $task_cloud_block.='<span class="name-trips-opi">Комиссия</span>';
        $comm_rub=$row_8["paid_client"]-$row_8["paid_operator"];
    } else
    {
        //что то еще не оплачено или клиентом или оператором
        $task_cloud_block.='<span class="name-trips-opi">Предполагаемая Комиссия</span>';
        if($row_8["cost_operator"]!=0) {
            $comm_rub = $row_8["cost_client"] - $row_8["cost_operator"];
        }
    }


} else
{
    //валютный тур
    if(($row_8["buy_clients"]==1)and($row_8["buy_operator"]==1))
    {
        //все оплатили
        $task_cloud_block.='<span class="name-trips-opi">Комиссия</span>';
        $comm_rub=$row_8["paid_client"]-$row_8["paid_operator"];
    } else
    {
        //что то еще не оплачено или клиентом или оператором
        $task_cloud_block.='<span class="name-trips-opi">Предполагаемая Комиссия</span>';
        if($row_8["cost_operator_exchange"]!=0) {
            $comm_rub = round(($row_8["cost_client_exchange"] - $row_8["cost_operator_exchange"]) * $row_8["exchange_rates"]);
        }
    }
}


//партнерская комиссия если есть
$ppro=0;
$proc_ship=partners_trips($row_8["id"],$id_company,$link);
//echo($proc_ship);



$result_poteri = mysql_time_query($link, 'select sum(A.commission) as vse from trips_payment as A where A.id_trips="' . ht($row_8["id"]) . '" and A.visible=1');
$num_results_poteri = $result_poteri->num_rows;

if ($num_results_poteri != 0) {
    $row_poteri = mysqli_fetch_assoc($result_poteri);
    $comm_rub=$comm_rub-$row_poteri["vse"];
    /*
    if($row_8["paid_client"]!=0) {
        $proc_ii = round((($comm_rub - $ppro) * 100) / $row_8["paid_client"], 1);
    }
    */
}
if($proc_ship!=0)
{
    //потери которые еще состоялись
    $ppro=round((($comm_rub*$proc_ship)/100),2);
    //$comm_rub=$comm_rub-$ppro;


}
if($row_8["cost_client"]!=0) {
    $proc_ii = round((($comm_rub - $ppro) * 100) / $row_8["cost_client"], 1);
}



$style_procc='green-trips';
if($proc_ii<5)
{
    $style_procc='red-trips';
}
if(($proc_ii>=5)and($proc_ii<10))
{
    $style_procc='yellow-trips';
}


$task_cloud_block.='<div><span class="cost_circle cost_circle_proc '.$style_procc.'">'.$proc_ii.'</span></div>

<div class="cost_all_trips"><span class="cost_circle">'.number_format(((int)$comm_rub), 0, '.', ' ').'</span>';

if($ppro!=0)
{
    $task_cloud_block.='<span data-tooltip="Из них партнеру '.number_format(((int)$ppro), 0, '.', ' ').' ₽ = '.$proc_ship.'%" class="cost_circle skoko_ship">→ '.number_format(((int)$ppro), 0, '.', ' ').'</span>';
}

$task_cloud_block.='</div>';

if(($row_8["commission_fix"]!='')and($row_8["commission_fix"]!=0)) {
    $task_cloud_block .= '<div class="cost_all_trips" ><div class="name-trips-opi">Фиксированная выплата</div>';
    $task_cloud_block .= '<span data-tooltip="Определяется руководителем" class="fix-cost-price"><span class="cost_circle">'.number_format(((int)$row_8["commission_fix"]), 0, '.', ' ').'</span></span></div>';
}



$task_cloud_block.='</div>
<div class="commi-tips skidka-tips">
<span class="name-trips-opi">Скидка</span>';


//скидку в процентах считаем только исходя из задданной суммы в рублях
//процент скидки не хранится в базе
$char_skidka='';
if ($row_uu_rate["char"] == "₽") {
    //только рублевый тур
    $proc_rassi = ($row_8["discount"] * 100) / $row_8["cost_client"];
} else {
    if ($row_8["buy_clients"] == 1) {
        if(($row_8["paid_client"]!=0)and($row_8["paid_client"]!='')) {
            $proc_rassi = ($row_8["discount"] * 100) / $row_8["paid_client"];
        } else
        {
            $proc_rassi=0;
        }
    } else
    {
        $proc_rassi = ($row_8["discount"] * 100) /($row_8["cost_client_exchange"]*$row_8["exchange_rates"]);
        if($proc_rassi!=0) {
            $char_skidka = '~';
        }
    }
}


$style_discound='green-trips';
if($proc_rassi>4)
{
    $style_discound='yellow-trips';
}
if($proc_rassi>8)
{
    $style_discound='red-trips';
}

$end_discound=round((float)$proc_rassi,1);

$task_cloud_block.='<div><span class="cost_circle cost_circle_proc '.$style_discound.'">'.$char_skidka.$end_discound.'</span></div>

<div class="cost_all_trips"><span class="cost_circle">'.number_format(((float)$row_8["discount"]), 2, '.', ' ').'</span>';


$result_uu_promo1 = mysql_time_query($link, 'select id_promo from trips where id="' . ht($row_8['id']) . '"');
$num_results_uu_promo1 = $result_uu_promo1->num_rows;

if ($num_results_uu_promo1 != 0) {
    $row_uu_promo1 = mysqli_fetch_assoc($result_uu_promo1);


    if ($row_uu_promo1["id_promo"] != 0) {

        $result_uu_promo = mysql_time_query($link, 'select a.name as nnn,a.bonus from affiliates_promo_code as a where a.id="'.ht($row_uu_promo1["id_promo"]).'"');

        $num_results_uu_promo = $result_uu_promo->num_rows;
        if ($num_results_uu_promo != 0) {

            $row_uu_promo = mysqli_fetch_assoc($result_uu_promo);

            // echo($row_uu_promo["nnn"]);

            $task_cloud_block .= '<div class="promo-trips"><span data-tooltip="ПРОМОКОД - ' . $row_uu_promo["bonus"] . '">'.$row_uu_promo["nnn"].'</span></div>';

        }


    }
}



$task_cloud_block.='</div>
</div>';
//определяем может ли он выполнить эту задачу
//определяем может ли он выполнить эту задачу
//определяем может ли он выполнить эту задачу
if($tabs_menu_x_visible[2]=="1")
{
    $task_cloud_block.='<div class="vip-ds"><div rel_taskk="'.$row_8["id"].'" data-tooltip="Отметить как выполнена" class="task__click1"></div></div>';
}


$task_cloud_block.='</div>';


$task_cloud_block1='';
//ВЫВОД ВПЕЧАТЛЕНИЯ ПО ТУРУ
if($row_8["comment"]!='') {
    $task_cloud_block .= '<div class="comment-chat chat-tours">'.nl2br($row_8["comment"]).'</div>';
}




    $tabs_menu_x = array( "Внести оплату/возврат", "Информация","Документы","Платежи","Журнал операций");
    $tabs_menu_x_js = array("js-menu-buybuy","","","","","");
    $tabs_menu_x_id = array("0","1","3","5","6");

    for ($i=0; $i<count($tabs_menu_x); $i++) {
        $pay_string='';
        if($tabs_menu_x_id[$i]=="5")
        {
            //платежи. Проверяем сколько было исходящих и входящих платежей
            //
            $result_uu22 = mysql_time_query($link, 'select count(A.id) as pp from trips_payment as A where A.id_trips="' . ht($_GET['id']) . '" and A.who=0 and A.visible=1');
            $num_results_uu22 = $result_uu22->num_rows;
            if ($num_results_uu22 != 0) {
                $row_uu22 = mysqli_fetch_assoc($result_uu22);
                if($row_uu22["pp"]!=0)
                {
                    $pay_string.='↓'.$row_uu22["pp"];
                }
            }

            //платежи. Проверяем сколько было исходящих

            //
            $result_uu223 = mysql_time_query($link, 'select count(A.id) as pp from trips_payment as A where A.id_trips="' . ht($_GET['id']) . '" and A.who=1 and A.visible=1');
            $num_results_uu223 = $result_uu223->num_rows;
            if ($num_results_uu223 != 0) {
                $row_uu223 = mysqli_fetch_assoc($result_uu223);
                if($row_uu223["pp"]!=0)
                {
                    if($pay_string!='') {$pay_string.=' + ';}
                    $pay_string.='↑'.$row_uu223["pp"];
                }
            }

            if($pay_string!='') { $pay_string=' ('.$pay_string.')'; }

        }



        if ($_GET['menu_id'] == $tabs_menu_x_id[$i]) {
            $task_cloud_block1 .= '<li class="tabs_004U active ' . $tabs_menu_x_js[$i] . '" id="' . $tabs_menu_x_id[$i] . '">' . $tabs_menu_x[$i] .$pay_string. '</li>';
        } else {
            $task_cloud_block1 .= '<li class="tabs_004U ' . $tabs_menu_x_js[$i] . '" id="' . $tabs_menu_x_id[$i] . '">' . $tabs_menu_x[$i] .$pay_string. ' </li>';
        }

}
if($row_8["status_admin"]==0) {
    $task_cloud_block1 .= '<li class="tabs_004U edit-li-tr"><a href="tours/' . $row_8["id"] . '/" class="edit-trips-all" data-tooltip="Изменить" ></a></li>';
}



//может только сам создатель или его управляющий или админ
$mas_responsible=array();
array_push($mas_responsible,$row_8["id_user"]);

$tabs_menu_x_visible[4]=0;
if($row_8["id_user"]!=0)
{
    if(($sign_admin!=1))
    {

        if($row_8["id_user"]==$id_user)
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

if($tabs_menu_x_visible[4]=="1") {

    if ($row_uuwe["status"] == 1) {
        $task_cloud_block1 .= '<li class="tabs_004U annul-li-tr" id="0"><a  class="edit-trips-all1" data-tooltip="Аннулировать" ></a></li>';
    } else {
        $task_cloud_block1 .= '<li class="tabs_004U annul-li-tr" id="0"><a  class="edit-trips-all2" data-tooltip="Отменить Аннуляцию" ></a></li>';
    }

}


if(($_GET["menu_id"]!=0)and($_GET["mm"]==1)) {
    //открыта какая то вкладка в туре и необходимо обновление информации по этой вкладке
    $id_tabs=$_GET["menu_id"];
    $token_inlude='taabbssd32.dfDS';

// информация
    if($id_tabs==1)
    {
        include $url_system.'tours/code/tabs_about.php';
    }
// документы
    if($id_tabs==3)
    {
        include $url_system.'tours/code/tabs_doc.php';
    }

// платежи
    if(($id_tabs==5))
    {

        include $url_system.'tours/code/tabs_buy.php';
    }
// журнал операций
    if(($id_tabs==6))
    {
        include $url_system.'tours/code/tabs_operation.php';
    }

    $echo_more=$query_string;
}





//echo($task_cloud_block);


end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo"   => $status_echo,"query" => $task_cloud_block,"echo"=>$task_cloud_block1,"echo1"=>$task_cloud_block2,"id_tabs"=>$_GET["id_tabs"],"tabs"=>$_GET["tabs"],"echo_more"=>$echo_more,"upload_mm"=> ht($_GET["mm"]) );


//print_r($aRes);
/*
require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);

?>