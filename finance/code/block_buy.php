<?php
//$query_string.=''.$row_uu["name"].' от '.$date_ddd.'';
$query_string_xx='';

$result_status22=mysql_time_query($link,'SELECT b.name_user,b.name_small FROM r_user AS b WHERE b.id="'.htmlspecialchars(trim($row_uu["id_user"])).'"');

//echo('SELECT a.* FROM r_status AS a WHERE a.numer_status="'.$row1ss["status"].'" and a.id_system=13');
if($result_status22->num_rows!=0)
{
$row_status22 = mysqli_fetch_assoc($result_status22);
$query_string_xx.=''.$row_status22['name_small'].'';
}

if($i==1)
{
$class_ver='green-trips ';
} else
{
$class_ver='red-trips ';
}

$class_buy='';
$tt_color='green-buy';
$whos='<div class="strela_buy">↓</div>';
if(($row_uu["income"]==0)or($row_uu["income"]==2))
{
//$class_buy='red_buy';
    $tt_color='red-buy';
$whos='<div class="strela_buy">↑</div>';
}
$class_say='';
if((isset($new_say))and($new_say==1))
{
    $class_say='new-say';
}


$query_string.='<div class="buy_block_global '.$class_buy.' '.$class_say.'" id_buy="'.$row_uu["id"].'">';



$tt_opp='Разовый платеж';
$style_rt='';
$style_val=0;
//$whos='<div class="strela_buy">↑</div>';
if($row_uu["constant"]==1)
{
$tt_opp='ежемесячный платеж';
//$whos='<div class="strela_buy">↓</div>';
    $style_rt='active_task_cb';
    $style_val=1;
}




$query_string.='<div class="buy-b-number">'.$row_uu["id"].$whos.'</div>


<div class="buy-b-date"><span class="label-task-gg ">Дата оплаты
</span><div class="help-jjx">'.date_ex(0,$row_uu["date"]).'</div>';

if($more_city==1)
{
    //выводить к какой организации относится тур

    $result_cop = mysql_time_query($link, 'select * from a_company where id="'.ht($row_uu["id_a_company"]).'"');
    $num_results_cop = $result_cop->num_rows;

    if ($num_results_cop != 0) {
        $row_cop = mysqli_fetch_assoc($result_cop);
        $query_string.=' <div class="com_type_fin">('.$row_cop["name_dop"].')</div>';
    }


}


$query_string.='</div>';


$result_uu_rate=mysql_time_query($link,'select a.char,a.small_name,a.code from booking_exchange as a  where a.id="'.ht($row_8["id_exchange"]).'"');
$num_results_uu_rate = $result_uu_rate->num_rows;

if($num_results_uu_rate!=0) {
$row_uu_rate = mysqli_fetch_assoc($result_uu_rate);
}

$style_kurs=0;



$query_string.='<div class="buy-b-summ"><span class="label-task-gg ">Сумма
        </span>

    <span class="cost_circle '.$tt_color.'">'.number_format(((float)$row_uu["sum"]), 2, '.', ' ').'</span>';
/*
    if($style_kurs==1) {
    $query_string .= '<span class="cost_circle rate_' . $row_uu_rate["code"] . ' buy_circle">' . number_format(((float)$row_uu["sum_rate"]), 2, '.', ' ') . ' <span class="buy-ratee">(Курс - ' . $row_uu["rate"] . ')</span></span>';
    }
*/


$type_my='';

$result_uutt = mysql_time_query($link, 'select C.name from finance_operation_type as C where C.id="' . ht($row_uu["id_type"]) . '"');
$num_results_uutt = $result_uutt->num_rows;

if ($num_results_uutt != 0) {
    $row_uutt = mysqli_fetch_assoc($result_uutt);
    $type_my=$row_uutt["name"];
}


if($type_my!='') {
    $query_string .= '<div class="com_type_fin">(' . $type_my . ')</div>';
}
    $query_string.='</div>';


$query_string.='<div class="buy-b-more"><span class="label-task-gg ">Подробности
</span><div>';



//active_task_cb
//смотрим в этом ли месяце этот платеж и выводить ли кнопку ежемесячный
//$row_uu["date"]


//echo(dateDiff_1($row_uu["date"], date('Y-m-01')));
if((dateDiff_1($row_uu["date"], date('Y-m-01'))>=0)and($row_uu["income"]!=2))
{
if($edit_moo==1) {


    $query_string .= '<div data-tooltip="платеж повторится и в следующем месяце" class="input-choice-click-task input-choice-buy-fin js-choice-buy-y " style="margin-top:0px;">
<div class="choice-head">Ежемесячный</div>
<div class="choice-radio"><div class="center_vert1"><i class="' . $style_rt . '"></i><input name="" id="" value="' . $style_val . '" type="hidden"></div></div></div>';
} else
{
    $query_string.=''.$tt_opp;
}
} else
{

    $query_string.=''.$tt_opp;

}


$query_string.='</div></div>';



$query_string.='<div class="buy-b-comment"><span class="label-task-gg ">Комментарий
        </span><span class="spans ggh-e">'.$row_uu["comment"].'</span>
</div>';



$query_string.='<div class="buy-b-user"><span class="label-task-gg ">Кто добавил
</span><div class="titi-kem">'.$query_string_xx.'</div><div class="titi">'.time_stamp($row_uu["date_create"]).'</div>';


if($edit_moo==1) {


    if (($role->permission('Финансы','U'))or($sign_admin==1)) {
        $query_string .= '<div class="vip-ds"><i class="em1 js-buy-edit-fin" data-tooltip="Изменить"></i><i class="em2 js-buy-del-fin" data-tooltip="Удалить"></i></div>';
    }

}
    $query_string.='</div></div>';

    ?>