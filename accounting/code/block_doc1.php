<?
$task_cloud_block='';
//вывод обращений в разделе все обращения

$cancel_class='';

if($row_88["date_buy_all"]=='0000-00-00 00:00:00') {
    $cancel_class='cancel_trips';
}

$new_sayx='';
//$task_cloud_block.='<div class="doc_block_contracts1 '.$new_sayx.' '.$cancel_class.'" id_pre="'.$row_88["id"].'" style="page-break-inside: avoid"><span class="js-update-block-doc-h">';


//$task_cloud_block.='<div class="trips-b-number"><div style="width: 100%;">'.$row_88["id"].'</div>';
array_push($data1, $row_88["id"]);


$kuda_trips='';


$result_uu = mysql_time_query($link, 'select name from trips_country where id="' . ht($row_88["id_country"]) . '"');
$num_results_uu = $result_uu->num_rows;

if ($num_results_uu != 0) {
    $row_uu = mysqli_fetch_assoc($result_uu);
    $kuda_trips.=$row_uu["name"];
}


if($row_88['place_name']!='')
{
    $kuda_trips.=', '.$row_88['place_name'];
}
if($row_88['hotel']!='')
{
    $kuda_trips.=' / '.$row_88['hotel'];
}

$date_mass=explode("-",ht($row_88['date_start']));
$date_start=$date_mass[2].'.'.$date_mass[1].'.'.$date_mass[0];

$date_mass = explode("-", ht($row_88['date_end']));
$date_end = $date_mass[2] . '.' . $date_mass[1] . '.' . $date_mass[0];

//$task_cloud_block.='<div class="pass_wh_trips"><span class="kuda-trips">'.$kuda_trips.'</span>



array_push($data1, $kuda_trips);
array_push($data1, $date_start.' / '.$date_end);


$result_uu = mysql_time_query($link, 'select count(id) as cc from trips_clients_fly where id_trips="' . ht($row_88['id']) . '"');
$num_results_uu = $result_uu->num_rows;

if ($num_results_uu != 0) {
    $row_uu = mysqli_fetch_assoc($result_uu);
}

array_push($data1, $row_uu["cc"]);


if($row_8["shopper"]==1) {
    //частное лицо
    $result_uu = mysql_time_query($link, 'select fio from k_clients where id="'.ht($row_88["id_shopper"]) . '"');
} else
{
    //2 фирма
    $result_uu = mysql_time_query($link, 'select name as fio from k_organization where id="'.ht($row_88["id_shopper"]) . '"');
}
$num_results_uu = $result_uu->num_rows;

if($num_results_uu!=0)
{
    $row_uu = mysqli_fetch_assoc($result_uu);

    array_push($data1, $row_uu["fio"]);
}

//array_push($data1, $row_uu["fio"]);








$result_uu = mysql_time_query($link, 'select name from booking_operator where id="' . ht($row_88['id_operator']) . '"');
$num_results_uu = $result_uu->num_rows;

if ($num_results_uu != 0) {
    $row_uu = mysqli_fetch_assoc($result_uu);
}

array_push($data1, $row_uu["name"]);

$number_to='—';
if($row_88["number_to"]!='')
{
    $number_to=$row_88["number_to"];
}
array_push($data1, $number_to);

/*$task_cloud_block.='<div class="pass_wh_trips pass_x"><label >Номер заявки у ТО</label><span class="obi">'.$number_to.'</span></div>';*/

$result_uu = mysql_time_query($link, 'select name,date_doc from trips_contract where id="' . ht($row_88["id_contract"]) . '"');
$num_results_uu = $result_uu->num_rows;

if ($num_results_uu != 0) {
    $row_uu = mysqli_fetch_assoc($result_uu);
    $date_doc_=explode("-",$row_uu["name"]);
    $date_r1=explode("/",htmlspecialchars(trimc($date_doc_[0])));

    $date_ddd=$date_r1[0].'.'.$date_r1[1].'.'.$date_r1[2];

}




//$task_cloud_block.='<div class="pass_wh_trips pass_x"><label >Договор</label><span class="obi">'.$row_uu["name"].' от '.date_ex(0,$row_uu["date_doc"]).'</span></div>';
array_push($data1,$row_uu["name"].' от '.date_ex(0,$row_uu["date_doc"]));



array_push($data1,number_format(((float)$row_88["paid_client"]), 2, ',', ''));
array_push($data1,number_format(((float)$row_88["paid_operator"]), 2, ',', ''));



$result_uu=mysql_time_query($link,'select name_user from r_user where id="'.ht($row_88['id_user']).'"');
$num_results_uu = $result_uu->num_rows;

if($num_results_uu!=0)
{
    $row_uu = mysqli_fetch_assoc($result_uu);
    array_push($data1, $row_uu['name_user']);
}

//$task_cloud_block.='</div>';
/*
	$task_cloud_block.='</div><div class="trips-b-user"><span class="label-task-gg ">Комментарий/последнее событие
</span>



</div>';
*/


//$task_cloud_block.='</div>';


    //$task_cloud_block .= '</span>';

    //$task_cloud_block .= '</div>';





?>