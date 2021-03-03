<?
//вывод обращений в разделе все обращения
$task_cloud_block='';

	
	

$task_cloud_block.='<div class="preorders_block_history" id_pre="'.$row_88["id"].'"><span class="js-update-block-preorders-h">';


$task_cloud_block.='<div class="trips-b-number"><div style="width: 100%;">'.$row_88["id"].'</div>';

//$task_cloud_block.='<div class="yes-note zame_kk js-zame-tours" data-tooltip = "Написать заметку о туре" ></div >';

$task_cloud_block.='</div>
	<div class="trips-b-info"><span class="label-task-gg ">Обращение/Клиент
</span>';


$task_cloud_block.='<a class="preorders-a" href="preorders/.id-'.$row_88["id"].'"><strong>Обращение №'.$row_88["id"].'</strong></a>';


if($row_88["id_type_clients"]==1) {
    //частное лицо
    $result_uu = mysql_time_query($link, 'select fio from k_clients where id="'.ht($row_88["id_k_clients"]).'"');
} else
{
   //2 фирма
    $result_uu = mysql_time_query($link, 'select name as fio from k_organization where id="'.ht($row_88["id_k_clients"]) . '"');
}
$num_results_uu = $result_uu->num_rows;

if($num_results_uu!=0)
{
    $row_uu = mysqli_fetch_assoc($result_uu);
    if($row_88["id_type_clients"]==1) {
        //частное лицо
        $task_cloud_block.='<div class="pass_wh_trips" style="margin-bottom: 5px;"><a class="js-client my-history-pre" iod="'.$row_88["id_k_clients"].'"><span class="js-glu-f-'.$row_8["id_k_clients"].'">'.$row_uu["fio"].'</span></a></div>';
    } else
    {
//      фирма
        $task_cloud_block.='<div class="pass_wh_trips" style="margin-bottom: 5px;"><a class="js-org" iod="'.$row_88["id_k_clients"].'"><span class="js-glo-n-'.$row_8["id_k_clients"].'">'.$row_uu["fio"].'</span></a></div>';
    }
}













$task_cloud_block.='</div><div class="trips-b-user"><span class="label-task-gg ">Событие
</span>';

$dop_l='';
if($row_8["action_history"]==1)
{
    $dop_l='Добавлен комментарий → ';
}

$task_cloud_block.='<div class="pass_wcommen">'.$dop_l.''.$row_8["comment"].'</div><span class="time_notifi_h">'.time_stamp($row_8["datetimes"]).'</span>';




$task_cloud_block.='</div><div class="trips-b-comment"><span class="label-task-gg ">Менеджер
</span>';

$result_uu=mysql_time_query($link,'select name_user from r_user where id="'.ht($row_8['id_user']).'"');
$num_results_uu = $result_uu->num_rows;

if($num_results_uu!=0)
{
    $row_uu = mysqli_fetch_assoc($result_uu);
    $task_cloud_block.='<span class="my-history-pre">'.$row_uu['name_user'].'</span>';
}

$task_cloud_block.='</div>';
/*
	$task_cloud_block.='</div><div class="trips-b-user"><span class="label-task-gg ">Комментарий/последнее событие
</span>



</div>';
*/


//$task_cloud_block.='</div>';


    $task_cloud_block .= '</span>';

    $task_cloud_block .= '</div>';





?>