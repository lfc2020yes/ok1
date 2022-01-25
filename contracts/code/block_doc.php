<?
$task_cloud_block='';
//вывод обращений в разделе все обращения
$new_sayx='';
if((isset($new_sa))and($new_sa==1))
{
    $new_sayx='new-say';
}

	
	

$task_cloud_block.='<div class="doc_block_contracts '.$new_sayx.'" id_pre="'.$row_88["id"].'"><span class="js-update-block-doc-h">';


$task_cloud_block.='<div class="trips-b-number"><div style="width: 100%;">'.$row_88["id"].'</div>';


//ваш комментарий к туру
$message='';
if (($role->permission('Договора','R'))or($sign_admin==1)) {
//выводим последний комментарий если тур просматривает хозяин тура или хозяин этого комментария
    $result_uui = mysql_time_query($link, 'select comment from trips_contract_status_history_new where id_contract="' . ht($row_88["id"]) . '" and action_history="1" and id_user="' . $id_user . '" order by datetimes desc limit 1');
    $num_results_uui = $result_uui->num_rows;

    if ($num_results_uui != 0) {
        $row_uui = mysqli_fetch_assoc($result_uui);
        $message=$row_uui["comment"];

        $task_cloud_block .= '<div class="yes-note zame_kk js-zame-contracts" data-tooltip = "'.ht($row_uui["comment"]).'"></div >';
    } else {
        $task_cloud_block .= '<div class="zame_kk js-zame-contracts" data-tooltip = "Написать заметку" ></div >';
    }




    $task_cloud_block .= '<div class="form-rate-ok1 form-rate-ok-chat"><div class="rate-input"><div class="rates_visible">';

    $task_cloud_block .= '<label style="text-transform: uppercase; font-size:10px;">Заметка по договору</label><div class="div_textarea_otziv1 js-prs"  style="margin-top: 0px;">
			<div class="otziv_add">';


    $task_cloud_block .= '<textarea cols="10" rows="1" placeholder="" id="otziv_chat1_' . $row_88["id"] . '" name="chat_text" class="di text_area_otziv no_comment_bill22_2 tyyo1 
 gloab">'.$message.'</textarea>';

    $task_cloud_block .= '</div>      
</div>  

        <script type="text/javascript"> 
	  $(function (){ 
$(\'#otziv_chat1_' . $row_88["id"] . '\').autoResize({extraSpace : 10});
$(\'.tyyo1' . +$row_88["id"] . '\').trigger(\'keyup\');
});

	</script>
	';
    $task_cloud_block .= '</div></div><div class="rate-button1"><div class="js-ok-rate-chat-left-pr11">ОК</div></div></div>';

}


//$task_cloud_block.='<div class="yes-note zame_kk js-zame-tours" data-tooltip = "Написать заметку о туре" ></div >';

$task_cloud_block.='</div>
	<div class="trips-b-info"><span class="label-task-gg ">Номер договора
</span>';


$task_cloud_block.='<span class="obi"><div>'.$row_88["name"].' от '.date_ex(0,$row_88["date_doc"]).'</div>';

if(($row_88["doc"]=='0000-00-00')or($row_88["doc"]=='')) {
    $task_cloud_block.=' <span class="time_notifi_h"> не выдан </span >';
} else
{
    $task_cloud_block.=' <span class="time_notifi_h"> выдан '.date_ex(0,$row_88["doc"]).' </span >';
}

$task_cloud_block.='</div><div class="trips-b-user"><span class="label-task-gg ">Тур
</span>';


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

$task_cloud_block.='<a class="preorders-a" href="tours/.id-'.$row_88['ids'].'" class="kuda-trips">'.$kuda_trips.'</a>';


$task_cloud_block.='</div><div class="trips-b-comment"><span class="label-task-gg ">Менеджер
</span>';

$result_uu=mysql_time_query($link,'select name_user from r_user where id="'.ht($row_88['id_user']).'"');
$num_results_uu = $result_uu->num_rows;

if($num_results_uu!=0)
{
    $row_uu = mysqli_fetch_assoc($result_uu);
    $task_cloud_block.='<span class="my-history-pre">'.$row_uu['name_user'].'</span>';
}


if($more_city==1)
{
    //выводить к какой организации относится тур

    $result_cop = mysql_time_query($link, 'select * from a_company where id="'.ht($row_88["id_a_company"]).'"');
    $num_results_cop = $result_cop->num_rows;

    if ($num_results_cop != 0) {
        $row_cop = mysqli_fetch_assoc($result_cop);
        $task_cloud_block.=' <div class="issue-block oo_date" style="color: rgba(0, 0, 0, 0.6);
font-family:\'GEInspiraBold\'">('.$row_cop["name_dop"].')</div>';
    }


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