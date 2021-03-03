<?
//туры вкладка "информация"

if((!isset($token_inlude))or($token_inlude!='taabbssd32.dfDS'))
{
    goto end_code;
    $debug=h4a(3,$echo_r,$debug);
}






$vipoll='';
$vipoll_flag=0;

$query_string.='<div class="jipp_fll_start">';

$query_string.='<div class="px_flex"><div class="px_left"><div class="strong_wh_2020">↓ Данные по туру</div>';



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
$query_string.='<div class="pass_wh"><label>Тур</label><span>'.$kuda_trips.'</span></div>';



$query_string.='<div class="pass_wh"><label>Дата начала тура</label><span>'.rooo(date_ex(0,$row_8['date_start']),'','—').'</span></div>';

$query_string.='<div class="pass_wh"><label>Дата окончания тура</label><span>'.rooo(date_ex(0,$row_8['date_end']),'','—').'</span></div>';

$query_string.='<div class="pass_wh"><label>Кол-во ночей</label><span>'.rooo($row_8['count_day'],'','—').'</span></div>';

$query_string.='<div class="pass_wh"><label>Кол-во человек</label><span>'.rooo($row_8['count_people'],'','—').'</span></div>';

$result_uu = mysql_time_query($link, 'select name from booking_operator where id="' . ht($row_8['id_operator']) . '"');
$num_results_uu = $result_uu->num_rows;

if ($num_results_uu != 0) {
    $row_uu = mysqli_fetch_assoc($result_uu);
}

$query_string.='<div class="pass_wh"><label>Туроператор</label><span>'.rooo($row_uu['name'],'','—').'</span></div>';




$query_string.='<div class="strong_wh_2020">↓ Все по отелю</div>';
$query_string.='<div class="pass_wh"><label>Отель</label><span>'.rooo($row_8['hotel'],'','—').'</span></div>';

$query_string.='<div class="pass_wh"><label>Дата заезда в отель</label><span>'.rooo(date_ex(0,$row_8['date_start_race']),'','—').'</span></div>';

$query_string.='<div class="pass_wh"><label>Дата выезда из отеля</label><span>'.rooo(date_ex(0,$row_8['date_end_race']),'','—').'</span></div>';

$query_string.='<div class="pass_wh"><label>Тип номера</label><span>'.rooo($row_8["room_type"],'','—').'</span></div>';
$query_string.='<div class="pass_wh"><label>Категория номера</label><span>'.rooo($row_8["room_category"],'','—').'</span></div>';
$query_string.='<div class="pass_wh"><label>Тип питания</label><span>'.rooo($row_8["food_type"],'','—').'</span></div>';

$query_string.='</div><div class="px_left"><div class="strong_wh_2020">↓ Туда</div>';


$query_string.='<div class="pass_wh"><label>Маршрут перелета туда</label><span>'.rooo($row_8["flight_there_route"],'','—').'</span></div>';
$query_string.='<div class="pass_wh"><label>Класс перелета туда</label><span>'.rooo($row_8["flight_there_class"],'','—').'</span></div>';
$query_string.='<div class="pass_wh"><label>Номер рейса туда</label><span>'.rooo($row_8["flight_there_number"],'','—').'</span></div>';

//получаем посление даты из истории по времени и дате вылетов и прилетов
$result_mi=mysql_time_query($link,'SELECT a.* FROM trips_fly_history AS a WHERE a.id_trips="'.$id.'" order by a.datetime DESC limit 0,1');

if($result_mi->num_rows!=0)
{
    $row_mi = mysqli_fetch_assoc($result_mi);
    $start_mi=$row_mi["start_fly"];
    $end_mi=$row_mi["end_fly"];
}


$query_string.='<div class="pass_wh"><label>Дата и время вылета</label><span class="mi_m js-mi-x1" data-tooltip="изменить время">'.rooo(trips_neo($row_mi["start_fly"]),'','—').'</span><div class="mi_history_trips" data-tooltip="Посмотреть историю вылетов"></div></div>';

//flight_there_id_transfer_type
$result_uus = mysql_time_query($link, 'select A.name from trips_transfer_type as A where A.id="'.ht($row_8["flight_there_id_transfer_type"]).'"');
$num_results_uus = $result_uus->num_rows;

if ($num_results_uus != 0) {
    $row_uus = mysqli_fetch_assoc($result_uus);
    $query_string .= '<div class="pass_wh"><label>Тип транспорта туда</label><span>' . rooo($row_uus["name"], '', '—') . '</span></div>';
}

$result_uus = mysql_time_query($link, 'select A.name from trips_flight_type as A where A.id="'.ht($row_8["flight_there_id_flight_type"]).'"');
$num_results_uus = $result_uus->num_rows;

if ($num_results_uus != 0) {
    $row_uus = mysqli_fetch_assoc($result_uus);
    $query_string .= '<div class="pass_wh"><label>Тип рейса туда</label><span>' . rooo($row_uus["name"], '', '—') . '</span></div>';
}


$query_string.='<div class="strong_wh_2020">↓ Обратно</div>';


$query_string.='<div class="pass_wh"><label>Маршрут перелета туда</label><span>'.rooo($row_8["flight_back_route"],'','—').'</span></div>';
$query_string.='<div class="pass_wh"><label>Класс перелета туда</label><span>'.rooo($row_8["flight_back_class"],'','—').'</span></div>';
$query_string.='<div class="pass_wh"><label>Номер рейса туда</label><span>'.rooo($row_8["flight_back_number"],'','—').'</span></div>';

$query_string.='<div class="pass_wh"><label>Дата и время отлета</label><span class="mi_m js-mi-x2" data-tooltip="изменить время">'.rooo(trips_neo($row_mi["end_fly"]),'','—').'</span><div class="mi_history_trips" data-tooltip="Посмотреть историю вылетов"></div></div>';



$result_uus = mysql_time_query($link, 'select A.name from trips_transfer_type as A where A.id="'.ht($row_8["flight_class_id_transfer_type"]).'"');
$num_results_uus = $result_uus->num_rows;

if ($num_results_uus != 0) {
    $row_uus = mysqli_fetch_assoc($result_uus);
    $query_string .= '<div class="pass_wh"><label>Тип транспорта обратно</label><span>' . rooo($row_uus["name"], '', '—') . '</span></div>';
}

$result_uus = mysql_time_query($link, 'select A.name from trips_flight_type as A where A.id="'.ht($row_8["flight_class_id_flight_type"]).'"');
$num_results_uus = $result_uus->num_rows;

if ($num_results_uus != 0) {
    $row_uus = mysqli_fetch_assoc($result_uus);
    $query_string .= '<div class="pass_wh"><label>Тип рейса обратно</label><span>' . rooo($row_uus["name"], '', '—') . '</span></div>';
}


$query_string.='<div class="strong_wh_2020">↓ Трансфер</div>';


$query_string.='<div class="pass_wh"><label>Маршрут трансфера</label><span>'.rooo($row_8["transfer_route"],'','—').'</span></div>';

$query_string.='<div class="pass_wh"><label>Тип трансфера</label><span>'.rooo($row_8["transfer_type"],'','—').'</span></div>';

$query_string.='<div class="pass_wh"><label>Вид трансфера</label><span>'.rooo($row_8["transfer_view"],'','—').'</span></div>';

$query_string.='</div><div class="px_left">';
$query_string.='<div class="strong_wh_2020">↓ Туристы</div>';

$task_cloud_block='';
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
        $task_cloud_block.='<div class="pass_wh_trips2"><a class="js-client" iod="'.$row_8["id_shopper"].'"><span class="js-glu-f-'.$row_8["id_shopper"].'">'.$row_uu["fio"].'</span></a></div>';
    } else
    {
//      фирма
        $task_cloud_block.='<div class="pass_wh_trips2"><a class="js-org" iod="'.$row_8["id_shopper"].'"><span class="js-glo-n-'.$row_8["id_shopper"].'">'.$row_uu["fio"].'</span></a></div>';
    }
}


$query_string.='<div class="pass_wh"><label>Покупатель тура</label><span>'.rooo($task_cloud_block,'','—').'</span></div>';


$result_uu = mysql_time_query($link, 'select A.fio,B.id_k_clients from k_clients as A,trips_clients_fly as B where B.id_trips="'.ht($row_8["id"]) .'" and B.id_k_clients=A.id');

$query_string.='<div class="pass_wh"><label>Туристы по туру</label><span>';

if ($result_uu) {
    $i = 0;
    while ($row_uu = mysqli_fetch_assoc($result_uu)) {
        $task_cloud_block='';
if($i!=0)
{
    $task_cloud_block.=', ';
}
        $task_cloud_block.='<div class="pass_wh_trips3"><a class="js-client" iod="'.$row_uu["id_k_clients"].'"><span class="js-glu-f-'.$row_uu["id_k_clients"].'">'.$row_uu["fio"].'</span></a></div>';

        $query_string.=$task_cloud_block;

        $i++;
    }
} else
{
    $query_string.='—';
}
$query_string.='</span></div>';


$query_string.='<div class="strong_wh_2020">↓ Страховка/экскурсии</div>';




$result_uu = mysql_time_query($link, 'select A.name from trips_insurance as A where A.id_trips="'.ht($row_8["id"]) .'"');

$query_string.='<div class="pass_wh"><label>Страховки</label><span>';

if ($result_uu) {
    $i = 0;
    while ($row_uu = mysqli_fetch_assoc($result_uu)) {
        $task_cloud_block='';
        if($i!=0)
        {
            $task_cloud_block.=', ';
        }
        $task_cloud_block.=$row_uu["name"];

        $query_string.=$task_cloud_block;

        $i++;
    }

    if($i == 0)
    {
        $query_string.='—';
    }
} else
{
    $query_string.='—';
}
$query_string.='</span></div>';


$result_uu = mysql_time_query($link, 'select A.name from trips_excursion as A where A.id_trips="'.ht($row_8["id"]) .'"');

$query_string.='<div class="pass_wh"><label>Экскурсии</label><span>';

if ($result_uu) {
    $i = 0;
    while ($row_uu = mysqli_fetch_assoc($result_uu)) {
        $task_cloud_block='';
        if($i!=0)
        {
            $task_cloud_block.=', ';
        }
        $task_cloud_block.=$row_uu["name"];

        $query_string.=$task_cloud_block;

        $i++;
    }

    if($i == 0)
    {
        $query_string.='—';
    }
} else
{
    $query_string.='—';
}
$query_string.='</span></div>';

$result_uu = mysql_time_query($link, 'select A.name from trips_service as A where A.id_trips="'.ht($row_8["id"]) .'"');

$query_string.='<div class="pass_wh"><label>Дополнительные услуги</label><span>';

if ($result_uu) {
    $i = 0;
    while ($row_uu = mysqli_fetch_assoc($result_uu)) {
        $task_cloud_block='';
        if($i!=0)
        {
            $task_cloud_block.=', ';
        }
        $task_cloud_block.=$row_uu["name"];

        $query_string.=$task_cloud_block;

        $i++;
    }

    if($i == 0)
    {
        $query_string.='—';
    }
} else
{
    $query_string.='—';
}
$query_string.='</span></div>';


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
$query_string.='<div class="strong_wh_2020">↓ Стоимость</div>';

$query_string.='<div class="pass_wh"><label>Стоимость тура</label>';
if($style_kurs==1)
{
    //Валютный тур
    $query_string.='<div class="cost_all_trips" style="width:100%; margin-top: 4px;"><span class="cost_circle cost-buy-form  rate_'.$row_uu_rate["code"].' info-cost-circle">'.number_format(((float)$row_8["cost_client_exchange"]), 2, '.', ' ').'</span></div></div>';


} else
{
    //Рублевый
    $query_string.='<div class="cost_all_trips" style="width:100%; margin-top: 4px;"><span class="cost_circle cost-buy-form  rate_'.$row_uu_rate["code"].' info-cost-circle">'.number_format(((float)$row_8["cost_client"]), 2, '.', ' ').'</span></div></div>';

}

//определяем что начальная оплата наличкой
$nall=0;
$result_uu3 = mysql_time_query($link, 'select A.sum from trips_payment as A,booking_payment_method as C where C.id=A.id_payment_method and A.who=0 and A.id_trips="'.ht($id).'" and A.id_operation=1 and A.visible=1 order by A.date_payment limit 1');
$num_results_uu3 = $result_uu3->num_rows;

if ($num_results_uu3 != 0) {
    $row_uu3 = mysqli_fetch_assoc($result_uu3);
}




$query_string.='<div class="pass_wh"><label>Аванс</label><span>'.rooo(number_format(((float)$row_uu3['sum']), 2, '.', ' ').' руб.','','—').'</span></div>';


$query_string.='<div class="strong_wh_2020">↓ Доп. Информация</div>';

$query_string.='<div class="pass_wh"><label>Дата оформления</label><span>'.rooo(date_ex_plus_time(0,$row_8['datecreate']),'','—').'</span></div>';

$query_string.='<div class="pass_wh"><label>Дата передачи документов</label><span>'.rooo(date_ex(0,$row_8['doc']),'','—').'</span></div>';


$query_string.='</div>';

$query_string.='</div></div>';


$query_string.='</div>';

end_code:

?>