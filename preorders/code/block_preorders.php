<?
//вывод обращений в разделе все обращения
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
	
	
	
	
	
	
if(isset($new_pre))
{
	
$task_cloud_block.='<div class="preorders_block_global '.$new_sayx.'" id_pre="'.$row_8["id"].'"><span class="js-update-block-preorders">';
}

$task_cloud_block.='<div class="trips-b-number"><div style="width: 100%;">'.$row_8["id"].'</div>';


//ваш комментарий к туру
if (($role->permission('Обращения','R'))or($sign_admin==1)) {
//выводим последний комментарий если тур просматривает хозяин тура или хозяин этого комментария
    $result_uui = mysql_time_query($link, 'select comment from preorders_status_history_new where id_preorder="' . ht($row_8["id"]) . '" and action_history="1" and id_user="' . $id_user . '" order by datetimes desc limit 1');
    $num_results_uui = $result_uui->num_rows;

    if ($num_results_uui != 0) {
        $row_uui = mysqli_fetch_assoc($result_uui);


        $task_cloud_block .= '<div class="yes-note zame_kk js-zame-preorders" data-tooltip = "'.ht($row_uui["comment"]).'"></div >';
    } else {
        $task_cloud_block .= '<div class="zame_kk js-zame-preorders" data-tooltip = "Написать заметку" ></div >';
    }




    $task_cloud_block .= '<div class="form-rate-ok1 form-rate-ok-chat"><div class="rate-input"><div class="rates_visible">';

    $task_cloud_block .= '<label style="text-transform: uppercase; font-size:10px;">Заметка по обращению</label><div class="div_textarea_otziv1 js-prs"  style="margin-top: 0px;">
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
    $task_cloud_block .= '</div></div><div class="rate-button1"><div class="js-ok-rate-chat-left-pr">ОК</div></div></div>';

}

if($id_user==$row_8["id_user"]) {

    $result_89 = mysql_time_query($link, 'SELECT * FROM((select A.id from  task_new as A WHERE  A.id_user_responsible="' . ht($id_user) . '" and A.visible=1 and A.id_a_group IN (' . ht($id_group_u) . ') and A.status=0 and A.action=20 and A.id_object="' . ht($row_8["id"]) . '"  
  )) LL limit 1');
    $num_89 = $result_89->num_rows;
//$pros=1;

    if ($num_89 > 0) {
        $task_cloud_block .= '<div class="yes-task-p js-task-preo" data-tooltip = "Есть задача, добавить еще" ></div >';
    } else {
        $task_cloud_block .= '<div class="yes-task-no js-task-preo" data-tooltip = "Добавить задачу" ></div >';
    }
}
//$task_cloud_block.='<div class="yes-note zame_kk js-zame-tours" data-tooltip = "Написать заметку о туре" ></div >';

$task_cloud_block.='</div>
	<div class="trips-b-info"><span class="label-task-gg ">Турист/Статус
</span>';

if($row_8["id_type_clients"]==1) {
    //частное лицо
    $result_uu = mysql_time_query($link, 'select fio from k_clients where id="'.ht($row_8["id_k_clients"]) . '"');
} else
{
   //2 фирма
    $result_uu = mysql_time_query($link, 'select name as fio from k_organization where id="'.ht($row_8["id_k_clients"]) . '"');
}
$num_results_uu = $result_uu->num_rows;

if($num_results_uu!=0)
{
    $row_uu = mysqli_fetch_assoc($result_uu);
    if($row_8["id_type_clients"]==1) {
        //частное лицо
        $task_cloud_block.='<div class="pass_wh_trips" style="margin-bottom: 5px;"><a class="js-client" iod="'.$row_8["id_k_clients"].'"><span class="js-glu-f-'.$row_8["id_k_clients"].'">'.$row_uu["fio"].'</span></a></div>';
    } else
    {
//      фирма
        $task_cloud_block.='<div class="pass_wh_trips" style="margin-bottom: 5px;"><a class="js-org" iod="'.$row_8["id_k_clients"].'"><span class="js-glo-n-'.$row_8["id_k_clients"].'">'.$row_uu["fio"].'</span></a></div>';
    }
}



/*
    //выводим последний комментарий если тур просматривает хозяин тура или хозяин этого комментария
    $result_uui = mysql_time_query($link, 'select comment from preorders_status_history_new where id_preorder="' . ht($row_8["id"]) . '" and action_history="1" and id_user="'.$id_user.'" order by datetimes desc limit 1');
    $num_results_uui = $result_uui->num_rows;

    if ($num_results_uui != 0) {
        $row_uui = mysqli_fetch_assoc($result_uui);
        $task_cloud_block.='<div class="commun">'.$row_uui["comment"].'</div>';
    }
*/
//статус обращения
$js_mod='';
if(($role->permission('Обращения','S'))or($sign_admin==1)) {

    $js_mod='js-status-preorders';
}
//статус обращения

$result_uupr = mysql_time_query($link, 'select number,name from preorders_status where id_company IN (' . ht( $id_group_company_list) . ') and number="'.ht($row_8["status"]).'"');
$num_results_uupr = $result_uupr->num_rows;

if ($num_results_uupr != 0) {
    $row_uupr = mysqli_fetch_assoc($result_uupr);

    $color_status=1;
    if(($row_uupr["number"]==2)or($row_uupr["number"]==3)or($row_uupr["number"]==4)) {$color_status=2;}
    if($row_uupr["number"]==5) {$color_status=3;}
    if($row_uupr["number"]==6) {$color_status=4;}


    $task_cloud_block.='<div data-tooltip = "Нажмите, чтобы изменить статус" id_status="'.$row_uupr["number"].'" class="status_admin js-status-preorders s_pr_'.$color_status.' '.$js_mod.'">'.$row_uupr["name"].'</div>';
    /*
    if($row_uupr["number"]==5) {
//выводим с каким договором связан
        $result_uu = mysql_time_query($link, 'select email,namess from users where id="' . ht($_SESSION['user_id']) . '"');
        $num_results_uu = $result_uu->num_rows;

        if ($num_results_uu != 0) {
            $row_uu = mysqli_fetch_assoc($result_uu);
            $task_cloud_block.='<a href="/preorders/.id-' . ht($ID_N) . '">Обращение №' . ht($ID_N) . '</a>';
        }


    }
*/
    if(($row_uupr["number"]==6)and($row_8["id_reasons"]!=0)) {

        $result_uu221 = mysql_time_query($link, 'select name from preorders_reasons where id="' . ht($row_8["id_reasons"]) . '" and id_company IN ('. $id_group_company_list.') and visible=1');
        $num_results_uu221 = $result_uu221->num_rows;

        if ($num_results_uu221 != 0) {
            $row_uu221 = mysqli_fetch_assoc($result_uu221);

            $task_cloud_block.='<div></div><div class="reason red-jj">'.$row_uu221["name"].'</div>';

        }

    }

}



$result_uu=mysql_time_query($link,'select name_user from r_user where id="'.ht($row_8['id_user']).'"');
$num_results_uu = $result_uu->num_rows;

if($num_results_uu!=0)
{
    $row_uu = mysqli_fetch_assoc($result_uu);
    $task_cloud_block.='<div class="pass_wh_trips" style="margin-top: 10px;"><label>Менеджер</label><div class="obi">'.$row_uu['name_user'].'</div></div>';
}






$task_cloud_block.='</div><div class="trips-b-user"><span class="label-task-gg ">Страна/Источник
</span>';

$kuda_trips='—';

$result_uu = mysql_time_query($link, 'select name from trips_country where id="' . ht($row_8["id_country"]) . '"');
$num_results_uu = $result_uu->num_rows;

if ($num_results_uu != 0) {
    $row_uu = mysqli_fetch_assoc($result_uu);
    $kuda_trips=$row_uu["name"];
}

$task_cloud_block.='<div class="pass_wh_trips"><span class="kuda-trips">'.$kuda_trips.'</span></div>';


$kuda_trips='';

$result_uu = mysql_time_query($link, 'select name from booking_sourse where id="' . ht($row_8["id_booking_sourse"]) . '"');
$num_results_uu = $result_uu->num_rows;

if ($num_results_uu != 0) {
    $row_uu = mysqli_fetch_assoc($result_uu);
    $kuda_trips=$row_uu["name"];
}

$task_cloud_block.='<div class="pass_wh_trips"><span class="kuda-trips">'.$kuda_trips.'</span></div>';


if(!empty($row_8["date_create"]))
{
    $rrd=explode(' ',$row_8["date_create"]);
    $rrd0=explode('-',$rrd[0]);
    $rrd1=explode(':',$rrd[1]);
    $task_cloud_block.='<div class="titi">'.$rrd0[2].'.'.$rrd0[1].'.'.$rrd0[0].' '.$rrd1[0].':'.$rrd1[1].'</div>';
} else
{
    $task_cloud_block.='<div class="titi">Неизвестно</div>';
}


$task_cloud_block.='</div><div class="trips-b-comment"><span class="label-task-gg ">Комментарий/последнее событие
</span><div><span class="spans ggh-e">'.$row_8["text"].'</span></div>';


//определим последнее действие по обращению
$result_85 = mysql_time_query($link,'SELECT A.id,A.action_history,A.id_user, A.datetimes,A.edit,A.comment  FROM preorders_status_history_new AS A WHERE A.id_preorder="'.ht($row_8["id"]).'" and not(A.action_history=4) order by A.id desc,A.datetimes desc limit 1');



$num_85 = $result_85->num_rows;
if($num_85>0) {

    $row_85 = mysqli_fetch_assoc($result_85);
    $kem='';
    $result_work_zz1=mysql_time_query($link,'Select a.name_user from r_user as a where a.id="'.$row_85["id_user"].'"');
    $kem='неизвестно';
    $num_results_work_zz1 = $result_work_zz1->num_rows;
    if($num_results_work_zz1!=0)
    {
        $row_work_zz1 = mysqli_fetch_assoc($result_work_zz1);
        $kem=$row_work_zz1["name_user"];
    }
    $task_cloud_block .= '<div class="strong_wh_2020 st-202020">↓ Последнее событие</div>';
    $task_cloud_block .= '<div class="oto-z-pr">'.$kem.' ('.time_stamp($row_85["datetimes"]).')</div><div class="oto-z-pr1">'.$row_85["comment"].'</div>';

}

$task_cloud_block.='</div>';
/*
	$task_cloud_block.='</div><div class="trips-b-user"><span class="label-task-gg ">Комментарий/последнее событие
</span>



</div>';
*/


//$task_cloud_block.='</div>';

if(isset($new_pre)) {

    $task_cloud_block .= '</span>';
}

$tabs_menu_x = array( "Задачи","Файлы","Журнал операций");
$tabs_menu_x_js = array("","","");
$tabs_menu_x_id = array("1","2","3");
$class_menu_pr='';
if ((isset($_GET['menu_id']))and(array_search($_GET['menu_id'], $tabs_menu_x_id) !== false)) {
    $class_menu_pr='active-trips-menu';
}
$task_cloud_block.='<div class="mm_w-preorders form005U '.$class_menu_pr.'">
	   <ul class="tabs_hedi js-tabs-menu">';




    for ($i=0; $i<count($tabs_menu_x); $i++) {
        $pay_string='';

        if ((isset($_GET['menu_id']))and($_GET['menu_id'] == $tabs_menu_x_id[$i])) {
            $task_cloud_block .= '<li class="tabs_005U active ' . $tabs_menu_x_js[$i] . '" id="' . $tabs_menu_x_id[$i] . '">' . $tabs_menu_x[$i] .$pay_string. '</li>';
        } else {
            $task_cloud_block .= '<li class="tabs_005U ' . $tabs_menu_x_js[$i] . '" id="' . $tabs_menu_x_id[$i] . '">' . $tabs_menu_x[$i] .$pay_string. ' </li>';
        }

    }

if (($role->permission('Обращения','U'))or($sign_admin==1)) {

    if(($row_8["id_user"]==$id_user)or($sign_admin==1)) {
if(($row_8["status"]!=5)and($row_8["status"]!=6)) {
    $task_cloud_block .= '<li class="tabs_005U edit-li-tr" id="0"><a class="js-buy-edit-preorders edit-trips-all" data-tooltip="Изменить" ></a></li>';
}

    }
   }



if (($role->permission('Обращения','D'))or($sign_admin==1)) {

    if(($row_8["id_user"]==$id_user)or($sign_admin==1)) {

        $min=dateDiff_min(date('Y-m-d H:i:s'), $row_8['date_create']);

        if(($min<60)and(($row_8['id_user']==$id_user)or($sign_admin==1))) {

            $task_cloud_block .= '<li class="tabs_005U annul-li-tr" id="0"><a  class="edit-preorders-all1 js-buy-del-pre" data-tooltip="Удалить" ></a></li>';

        }
    }


}





	  $task_cloud_block.='</ul>
   </div>';

$task_cloud_block.='<div class="px_bg_trips">
</div>';

if(isset($new_pre)) {

    $task_cloud_block .= '</div>';
}

$block_preorders=$task_cloud_block;

if((isset($_GET["menu_id"]))and($_GET["menu_id"]!=0)) {
    //открыта какая то вкладка в туре и необходимо обновление информации по этой вкладке
    $id_tabs=$_GET["menu_id"];
    $token_inlude='taabbssd32.dfDD';
    $task_cloud_block='';
// информация
    if($id_tabs==1)
    {
        include $url_system.'preorders/code/tabs_task.php';
    }
// документы
    if($id_tabs==2)
    {
        include $url_system.'preorders/code/tabs_file.php';
    }
// журнал операций
    if(($id_tabs==3))
    {
        include $url_system.'preorders/code/tabs_operation.php';
    }

    $echo_more=$query_string;
}


?>