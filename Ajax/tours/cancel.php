<?php
//добавить новую оплату/возврат по туру !!
$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';
header("Content-type: application/json");
$stack_error = array();  // общий массив ошибок
$status_ee='error';
$eshe=0;
$echo='';
$vid=0;
$debug='';
$count_all_all=0;
$basket='';
$token=$_POST['tk'];
$id=htmlspecialchars($_POST['id']);
$disco=0;
$ID_N='';
$temp='';
$radio_potential='';

$dom=0;
$status_echo='';
//проверка что есть такой город что это число
//проверка что пользователь зарегистрирован

$echo_r=1; //выводить или нет ошибку 0 -нет
$debug='';

//$secret=$_SESSION['rema'];
//echo(token_access_compile($_POST["id"],'bt_trips_buy_edit_21',$secret));
//**************************************************
//2 дня
if(!token_access_new($token,'bt_cancel_trips',$_POST["id"],"rema",2880))
{
    $debug=h4a(100,$echo_r,$debug);
    goto end_code;
}




/*
if ( count($_GET) != 4 )
{
$debug=h4a(1,$echo_r,$debug);
goto end_code;
}
*/
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
if(((!isset($_POST['tk1']))or(trim($_POST['tk1'])!='dsQ23RStsd2re')))
{
    $debug=h4a(77,$echo_r,$debug);
    goto end_code;
}



$mas_responsible=array();
$result_uu11 = mysql_time_query($link, 'select A.id,A.status,A.id_exchange,id_user  from trips as A where A.id="' . ht($_POST['id']) . '" and A.visible=1');
$num_results_uu11 = $result_uu11->num_rows;

if ($num_results_uu11 != 0) {
    $row_uu11 = mysqli_fetch_assoc($result_uu11);
    array_push($mas_responsible,$row_uu11["id_user"]);
} else
{
    $debug=h4a(95,$echo_r,$debug);
    goto end_code;
}


if($row_uu11["status"]!=1)
{
    $debug=h4a(935,$echo_r,$debug);
    goto end_code;
}

$tabs_menu_x_visible[4]=0;
if($row_uu11["id_user"]!=0)
{
    if(($sign_admin!=1))
    {

        if($row_uu11["id_user"]==$id_user)
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

if($tabs_menu_x_visible[4]!="1")
{
    $debug=h4a(6,$echo_r,$debug);
    goto end_code;
}



if((!isset($_POST['id_why']))or(trim($_POST['id_why'])=='')) { array_push($stack_error, "id_why"); }

$ddd='0000-00-00';
if(($_POST["buy_date"]!='')and(validateDate($_POST['buy_date'],'Y-m-d'))) {
    $ddd=ht($_POST['buy_date']);
}


//print_r ($stack_error);
if(count($stack_error)!=0)
{
    goto end_code;
}

$status_ee='ok';


mysql_time_query($link, 'INSERT INTO trips_cancel(
  `id_users`,
  `id_trips`,
  `id_why`,
  `id_refund`,
  `date_create`,
  `date_refund`,
  `fpo`,
  `cost`) VALUES( 
"'.ht($id_user).'",
"'.ht($_POST['id']).'",
"'.ht($_POST['id_why']).'",
"'.ht($_POST['id_refund']).'",
"'.date("Y-m-d").' '.date("H:i:s").'",
"'.$ddd.'",
"'.ht(trimc($_POST['com_proc'])).'",
"'.ht(trimc($_POST['com_rub'])).'")');

mysql_time_query($link, 'update trips set

status="2"

where id = "' . ht($_POST['id']) . '"');


//Удаляем задачи которые были поставлены по оплате туроператору и от клиенту по этому туру

mysql_time_query($link,'delete FROM task_new where id_object="' . ht($_POST['id']) . '" and status=0 and action in (19,18)');




$edit=0;
$comment='Тур аннулирован. ';


$result_uu = mysql_time_query($link, 'select a.why from trips_why_annulation as a where a.id="' . ht($_POST['id_why']) . '" and a.visible=1 and a.id_a_company IN ('.$id_group_company_list.')');
$num_results_uu = $result_uu->num_rows;

if ($num_results_uu != 0) {
    $row_uu = mysqli_fetch_assoc($result_uu);
    $comment.='Причина аннуляции - '.$row_uu["why"];
}

if(($_POST["com_proc"]!='')and($_POST["com_proc"]!=0))
{
    $comment .= ', ФПР туроператора - ';

    $result_uu_rate=mysql_time_query($link,'select a.char,a.small_name,a.code from booking_exchange as a  where a.id="'.ht($row_uu11["id_exchange"]).'"');
    $num_results_uu_rate = $result_uu_rate->num_rows;

    $style_kurs = 0;
    $class_change = 'tree';

    if($num_results_uu_rate!=0) {
        $row_uu_rate = mysqli_fetch_assoc($result_uu_rate);


        $comment .=$_POST["com_proc"].' '.$row_uu_rate["char"];

    }


}

if(($_POST["com_rub"]!='')and($_POST["com_rub"]!=0))
{
    $comment .= ', общая стоимость тура для туриста при аннуляции - ';

    $result_uu_rate=mysql_time_query($link,'select a.char,a.small_name,a.code from booking_exchange as a  where a.id="'.ht($row_uu11["id_exchange"]).'"');
    $num_results_uu_rate = $result_uu_rate->num_rows;

    $style_kurs = 0;
    $class_change = 'tree';

    if($num_results_uu_rate!=0) {
        $row_uu_rate = mysqli_fetch_assoc($result_uu_rate);


        $comment .=$_POST["com_rub"].' '.$row_uu_rate["char"];

    }


}


if(($_POST["id_refund"]!='')and($_POST["id_refund"]!=0))
{

    $result_uu = mysql_time_query($link, 'select a.name from trips_cancel_refund as a where a.id="' . ht($_POST['id_refund']) . '" and a.visible=1 and a.id_a_company IN ('.$id_group_company_list.')');
    $num_results_uu = $result_uu->num_rows;

    if ($num_results_uu != 0) {
        $row_uu = mysqli_fetch_assoc($result_uu);
        $comment.=', возврат - '.$row_uu["name"];
    }

}

if(($_POST["buy_date"]!='')and(validateDate($_POST['buy_date'],'Y-m-d'))) {

    $date_mass = explode("-", ht($_POST["buy_date"]));
    $date_start = $date_mass[2] . '.' . $date_mass[1] . '.' . $date_mass[0];
    $comment.=', Дата заявления на возврат/перенос - '.$date_start;

}

$comment_sys='';
mysql_time_query($link,'INSERT INTO trips_status_history_new (id_trips,action_history,id_user,datetimes,edit,comment,comment_sys) VALUES ("'.ht($row_uu11['id']).'","8",
		"'.ht($id_user).'",
		"'.date("Y-m-d").' '.date("H:i:s").'",
		"'.$edit.'",
		"'.ht($comment).'",
		"'.ht($comment_sys).'")');


//добавить уведомление


$text_not = '<a href="/tours/.id-' . ht($_POST["id"]) . '">Тур №' . ht($_POST["id"]) . '</a> был аннулирован. Данные по аннуляции в истории по туру';

$user_send_new= array();
$user_send_new=array_merge(UserNotNumber(14,$link));

rm_from_array(0,$user_send_new);
rm_from_array($id_user,$user_send_new);
$user_send_new= array_unique($user_send_new);

$mass_ei = all_chief($id_user, $link);
rm_from_array($id_user, $mass_ei);
$mass_ei = array_unique($mass_ei);

$end_mass=exception_role($user_send_new,$mass_ei);



notification_send( $text_not,$end_mass,$id_user,$link);





end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo" => $status_echo,"count" => $dom,"for_id"=>ht($row_uu11['id']),"error" =>  $stack_error,"download" => $download,"upload_mm" => 1);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);



?>