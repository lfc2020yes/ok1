<?php
//удаления платежа в турах

$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';
header("Content-type: application/json");

$status_ee='error';
$eshe=0;
$echo='';
$vid=0;
$debug='';
$count_all_all=0;
$basket='';
$disco=0;
$id=htmlspecialchars($_GET['id']);
$token=htmlspecialchars($_GET['tk']);
$dom=0;
$status_echo='';
//проверка что есть такой город что это число
//проверка что пользователь зарегистрирован

$echo_r=1; //выводить или нет ошибку 0 -нет
$debug='';
$stack_error = array();  // общий массив ошибок


//**************************************************

//**************************************************
if ((!$role->permission('Туры','U'))and($sign_admin!=1))
{
    $debug=h4a(12,$echo_r,$debug);
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


if((!isset($_SESSION["user_id"]))or(!is_numeric(id_key_crypt_encrypt($_SESSION["user_id"]))))
{
    goto end_code;
}

$id_user=id_key_crypt_encrypt($_SESSION["user_id"]);

//проверить есть ли переменная id и можно ли этому пользователю это делать
if ((count($_GET) != 3))
{
    goto end_code;
}


//2 дня
if(!token_access_new($token,'bt_del_cancel_trips',$_GET["id"],"rema",2880))
{
    $debug=h4a(100,$echo_r,$debug);
    goto end_code;
}
$mas_responsible = array();
$result_t=mysql_time_query($link,'Select A.id,A.status,A.id_exchange,A.id_user from trips as A where A.visible=1 AND A.id="'.ht($_GET["id"]).'" and A.id_a_company="'.$id_company.'"');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{
    $debug=h4a(5,$echo_r,$debug);
    goto end_code;
} else
{
    $row_score = mysqli_fetch_assoc($result_t);
    array_push($mas_responsible,$row_score["id_user"]);
}

if($row_score["status"]!=2)
{
    $debug=h4a(59,$echo_r,$debug);
    goto end_code;
}



$tabs_menu_x_visible[4]=0;
if($row_score["id_user"]!=0)
{
    if(($sign_admin!=1))
    {

        if($row_score["id_user"]==$id_user)
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



//**************************************************
//**************************************************
//**************************************************
//**************************************************


$status_ee='ok';


//Изменить суммы paid_
//Изменить флагов buy_ по полной оплате или нет
//добавить в историю об этой операции


mysql_time_query($link, 'update trips set status="1" where id = "' . ht($_GET['id']) . '"');
mysql_time_query($link, 'delete FROM trips_cancel where id_trips="' . ht($_GET['id']) . '"');

$edit=0;
$comment='Отмена аннуляции по туру. ';

$comment_sys='';
mysql_time_query($link,'INSERT INTO trips_status_history_new (id_trips,action_history,id_user,datetimes,edit,comment,comment_sys) VALUES ("'.ht($row_score['id']).'","8",
		"'.ht($id_user).'",
		"'.date("Y-m-d").' '.date("H:i:s").'",
		"'.$edit.'",
		"'.ht($comment).'",
		"'.ht($comment_sys).'")');

//добавить уведомление


$text_not = 'По <a href="/tours/.id-' . ht($_GET["id"]) . '">Туру №' . ht($_GET["id"]) . '</a> была отменена аннуляция.';

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

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo"   => $status_echo,"query" => $query_string,"download"=>$download,"error" =>  $stack_error,"for_id"=>ht($_GET["id"]));
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>