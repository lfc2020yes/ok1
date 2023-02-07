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


if($row_88["shopper"]==1) {
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



$result_uuwe = mysql_time_query($link, 'select status from trips where id="' . ht($row_88["ids"]) . '"');
$num_results_uuwe = $result_uuwe->num_rows;

if ($num_results_uuwe != 0) {
    $row_uuwe = mysqli_fetch_assoc($result_uuwe);
}
$status_dfd='—';
if($row_uuwe["status"]==2) {
    $status_dfd='аннулирован';
}
array_push($data1, $status_dfd);


$result_uu=mysql_time_query($link,'select name_user from r_user where id="'.ht($row_88['id_user']).'"');
$num_results_uu = $result_uu->num_rows;

if($num_results_uu!=0)
{
    $row_uu = mysqli_fetch_assoc($result_uu);
    array_push($data1, $row_uu['name_user']);
}
/*
$result_cop = mysql_time_query($link, 'select * from a_company where id="'.ht($row_88["id_a_company"]).'"');
$num_results_cop = $result_cop->num_rows;

if ($num_results_cop != 0) {
    $row_cop = mysqli_fetch_assoc($result_cop);

    array_push($data1, $row_cop["name"]);
}
*/


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