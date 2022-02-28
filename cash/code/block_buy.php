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
$whos='<i class="kuda-i"></i>';

if(($row_uu["id_where"]==1))
{
//$class_buy='red_buy';
    $tt_color='red-buy';
$whos='<i class="kuda-i grennvodx"></i>';
}
$class_say='';
if((isset($new_say))and($new_say==1))
{
    $class_say='new-say';
}


$query_string.='<div class="buy_block_global '.$class_buy.' '.$class_say.' cash-buy-block" id_buy="'.$row_uu["id"].'">';



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




$query_string.='<div class="buy-b-number">'.$row_uu["id"].'</div>';

$query_string.='<div class="buy-b-stt">'.$whos.'</div>';



$query_string.='<div class="buy-b-summ"><span class="label-task-gg ">Сумма</span><span class="cost_circle">'.number_format(((float)$row_uu["summ"]), 2, '.', ' ').'</span>';

$query_string.='</div>';




$query_string.='<div class="buy-b-date"><span class="label-task-gg ">Дата оплаты
</span><div class="help-jjx">'.date_ex_plus_time(0,$row_uu["date"]).'</div>';

$query_string.='</div>';


$query_string.='<div class="buy-b-comment"><span class="label-task-gg ">Подробности операции
        </span>';

$ot='';
$result_uuf = mysql_time_query($link, 'select title from cash_from_where where id="' . ht($row_uu['id_from']) . '"');
$num_results_uuf = $result_uuf->num_rows;

if ($num_results_uuf != 0) {
    $row_uuf = mysqli_fetch_assoc($result_uuf);
    $ot=$row_uuf["title"];
}
$ky='';
$result_uuf = mysql_time_query($link, 'select title from cash_from_where where id="' . ht($row_uu['id_where']) . '"');
$num_results_uuf = $result_uuf->num_rows;

if ($num_results_uuf != 0) {
    $row_uuf = mysqli_fetch_assoc($result_uuf);
    $ky=$row_uuf["title"];
}
$do='';
if($row_uu["where_more"]!='')
{
    $do=' ('.$row_uu["where_more"].')';
}


$query_string.='<span class="spans ggh-e">'.$ot.' → '.$ky.''.$do.'</span>';

if($row_uu["title"]!='') {
    $query_string .= '<div class="com_type_fin">(' . $row_uu["title"] . ')</div>';
}


$query_string .= '</div>';
if($edit_moo==1) {
    $query_string .= '<div class="buy-b-user-check">';


//выбор тура галкой
    if (($role->permission('Касса', 'S')) or ($sign_admin == 1)) {

        $actv1 = '';
        $tyyy=0;
        $toolt = 'data-tooltip="Подтвердить операцию"';

        if ($row_uu["check"] == 1) {
            //определяем кто и когда проверил эту операцию

            $result_uuy = mysql_time_query($link, 'select name_user from r_user where id="' . ht($row_uu["check_id_user"]) . '"');
            $num_results_uuy = $result_uuy->num_rows;

            if ($num_results_uuy != 0) {
                $row_uuy = mysqli_fetch_assoc($result_uuy);
                $toolt = 'data-tooltip="' . $row_uuy["name_user"] . ' (' . time_stamp($row_uu["check_date"]) . ')"';
            }
            $actv1 = 'active_task_cb';
            $tyyy=1;

        }


        $query_string .= '<div class="choice-radio js-status-cash-more" ' . $toolt . '><div class="center_vert1"><i class="' . $actv1 . '"></i><input name="" id="" value="'.$tyyy.'" type="hidden"></div></div>';

    }


    $query_string .= '</div>';
}
if($edit_moo==1) {
    $query_string .= '<div class="buy-b-user"><span class="label-task-gg ">Кто добавил
</span><div class="titi-kem">' . $query_string_xx . '</div>';
}

if($edit_moo==1) {


    if (($role->permission('Касса','D'))or($sign_admin==1)) {


        $dateTime = new DateTime();
        date_modify($dateTime, "-1 hour"); // на 1 час назад
        $date_new = date_format($dateTime, "Y-m-d H:i:s");

        $result_tp=mysql_time_query($link,'Select b.* from cash_operation as b where b.id="'.htmlspecialchars(trim($row_uu["id"])).'" and b.id_user="'.ht($id_user).'" and b.date>"'.$date_new.'"');
        $num_results_tp = $result_tp->num_rows;
        if($num_results_tp!=0) {

            $query_string .= '<div class="vip-ds"><i class="em2 js-buy-del-cash" data-tooltip="Удалить"></i></div>';
        }


    }

}
    $query_string.='</div></div>';

    ?>