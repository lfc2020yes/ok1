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
if($row_uu["id_operation"]==2)
{
$class_buy='red_buy';
}

$query_string.='<div class="buy_block_global '.$class_buy.'" id_buy="'.$row_uu["id"].'">';


if($row_uu["who"]==0)
{
$tt_opp='возврат оплаты туристу';
$tt_color='red-buy';
$whos='<div class="strela_buy">↑</div>';
if($row_uu["id_operation"]==1)
{
$tt_opp='оплата от туриста';
$whos='<div class="strela_buy">↓</div>';
$tt_color='green-buy';
}

} else
{
$tt_opp='Возврат оплаты от туроператора';
$whos='<div class="strela_buy">↓</div>';
$tt_color='red-buy';
if($row_uu["id_operation"]==1)
{
$tt_opp='Оплата туроператору';
$whos='<div class="strela_buy">↑</div>';
$tt_color='blue-buy';
}
}


$query_string.='<div class="buy-b-number">'.$row_uu["id"].$whos.'</div>


<div class="buy-b-date"><span class="label-task-gg ">Дата оплаты
</span><div class="help-jjx">'.date_ex(0,$row_uu["date_payment"]).'</div></div>';


$result_uu_rate=mysql_time_query($link,'select a.char,a.small_name,a.code from booking_exchange as a  where a.id="'.ht($row_8["id_exchange"]).'"');
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


$query_string.='<div class="buy-b-summ"><span class="label-task-gg ">Сумма
        </span>

    <span class="cost_circle '.$tt_color.'">'.number_format(((float)$row_uu["sum"]), 2, '.', ' ').'</span>';
    if($style_kurs==1) {
    $query_string .= '<span class="cost_circle rate_' . $row_uu_rate["code"] . ' buy_circle">' . number_format(((float)$row_uu["sum_rate"]), 2, '.', ' ') . ' <span class="buy-ratee">(Курс - ' . $row_uu["rate"] . ')</span></span>';
    }

    $query_string.='</div>';


$query_string.='<div class="buy-b-more"><span class="label-task-gg ">Подробности
</span><div>';






        $query_string.=$tt_opp.' ('.$row_uu["name"].')';

        if($row_uu["commission"]!=0) {
            $query_string .= '<span class="cost_circle  buy_circle" style="margin-left: 13px;">' . number_format(((float)$row_uu["commission"]), 2, '.', ' ') . ' <span class="buy-ratee" style="font-size: 10px;">← Комиссия</span></span>';
        }


$query_string.='</div></div>';



$query_string.='<div class="buy-b-comment"><span class="label-task-gg ">Комментарий
        </span><span class="spans ggh-e">'.$row_uu["comment"].'</span>
</div>';



$query_string.='<div class="buy-b-user"><span class="label-task-gg ">Кто принял
</span><div class="titi-kem">'.$query_string_xx.'</div><div class="titi">'.time_stamp($row_uu["date_create"]).'</div>';


if($edit_moo==1) {



    $query_string .= '<div class="vip-ds"><i class="em1 js-buy-edit" data-tooltip="Изменить"></i><i class="em2 js-buy-del" data-tooltip="Удалить"></i></div>';
}
    $query_string.='</div></div>';

    ?>