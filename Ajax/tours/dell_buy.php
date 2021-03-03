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
if(!token_access_new($token,'dell_buy_trips',$_GET["id"],"rema",2880))
{
    $debug=h4a(100,$echo_r,$debug);
    goto end_code;
}


$mas_responsible=array();
$result_uu = mysql_time_query($link, 'select A.*  from trips_payment as A where A.id="' . ht($_GET['id']) . '"');
$num_results_uu = $result_uu->num_rows;

if ($num_results_uu != 0) {
    $row_uu = mysqli_fetch_assoc($result_uu);
    array_push($mas_responsible,$row_uu["id_user"]);
} else
{
    $debug=h4a(95,$echo_r,$debug);
    goto end_code;
}



$tabs_menu_x_visible[4]=0;
if($row_uu["id_user"]!=0)
{
    if(($sign_admin!=1))
    {

        if($row_uu["id_user"]==$id_user)
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

$status_admin=0;
$result_ss_new1 = mysql_time_query($link, 'select status_admin,id_user from trips where id="' . ht($row_uu["id_trips"]) . '"');
$num_results_ss_new1 = $result_ss_new1->num_rows;

if ($num_results_ss_new1 != 0) {

    $row_uuxx = mysqli_fetch_assoc($result_ss_new1);
    $status_admin=$row_uuxx['status_admin'];

}
if($status_admin!=0) {
    $debug=h4a(002,$echo_r,$debug);
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

$result_ss_new1 = mysql_time_query($link, 'select buy_clients,buy_operator,id from trips where id="' . ht($row_uu["id_trips"]) . '"');
$num_results_ss_new1 = $result_ss_new1->num_rows;

if ($num_results_ss_new1 != 0) {
    $row_ss_new1 = mysqli_fetch_assoc($result_ss_new1);
    $array_param_old_ss = array(($row_ss_new1["buy_clients"]), $row_ss_new1["buy_operator"]);
}


//удалить все об этой запись по оплате со всеми изменениями в базе - сама оплата не удаляется. только ее последствия
dell_buy_trips(ht($id),$link);


mysql_time_query($link, 'update trips_payment set visible="0" where id = "' . ht($id) . '"');

//добавить в историю это действие
AddHistoryTrips('13',$id_user,$row_uu["id_trips"],'','','','','','','','руб.',$id,$link,'');


//проставляем дату полной оплаты и по оператору и по туру. чтобы знать в каком месяце эту комиссию считать
//$array_param_old=array(($row_uu["buy_clients"]),$row_uu["buy_operator"]);
$result_ss_new = mysql_time_query($link, 'select buy_clients,buy_operator,id from trips where id="' . ht($row_uu["id_trips"]) . '"');
$num_results_ss_new = $result_ss_new->num_rows;

if ($num_results_ss_new != 0) {
    $row_ss_new = mysqli_fetch_assoc($result_ss_new);
    $array_param_new_ss = array(($row_ss_new["buy_clients"]), $row_ss_new["buy_operator"]);

    if(($array_param_new_ss[0] == 1) and ($array_param_new_ss[1] == 1)) {
        //если все оплачено но мы тут то возможно что-то изменилось в комиссии или просто это конченая оплата
        $comiss_vip = 0;
        $comiss_vip = comiss_end_call($row_uu["id_trips"], $link);

        mysql_time_query($link, 'update trips set
    
    commission="' . $comiss_vip . '"
    where id = "' . ht($row_uu["id_trips"]) . '"');

    }


    if (($array_param_new_ss != $array_param_old_ss) and ($array_param_new_ss[0] == 1) and ($array_param_new_ss[1] == 1)) {
        //из состояния не оплачено во все оплачено
        mysql_time_query($link, 'update trips set
    
    date_buy_all="' . date("y.m.d") . ' ' . date("H:i:s") . '"
    where id = "' . ht($row_ss_new['id']) . '"');

        //уведомление о поступлении нового тура на проверку
        //уведомление о поступлении нового тура на проверку
        $text_not='<a href="tours/.id-'.$row_ss_new['id'].'">Тур №'.$row_ss_new['id'].'</a> - был полностью оплачен и поступил на проверку.';

        notif_role_list($row_uuxx["id_user"],$id_user,$text_not,10);

    }
    if (($array_param_new_ss != $array_param_old_ss) and ($array_param_old_ss[0] == 1) and ($array_param_old_ss[1] == 1)) {
        //из состояния все оплачено в состояние что-то не оплачено до конца
        mysql_time_query($link, 'update trips set
    
    date_buy_all="0000-00-00 00:00:00",commission=0
    where id = "' . ht($row_ss_new['id']) . '"');
    }
}

//определяем если есть сроки оплаты какие части стали оплачены а какие наоборот перестали быть
//определяем если есть сроки оплаты какие части стали оплачены а какие наоборот перестали быть
//|
//V
//-> клиент -> оператор
$trips_call=$row_uu["id_trips"];
for ($i = 0; $i < 2; $i++) {

    $procr = proc_call($trips_call, $i,$link); //определяем какой процент оплачен

    $result_uuее = mysql_time_query($link, 'select A.id,A.proc from trips_payment_term as A where 
A.id_trips="' . ht($trips_call) . '" and A.type="'.$i.'" and A.visible=1 order by A.date');

    if ($result_uuее) {
        while ($row_uuее = mysqli_fetch_assoc($result_uuее)) {
            $yes = 1;
            if ($row_uuее["proc"] > $procr) {
                $yes = 0;
            }
            mysql_time_query($link, 'update trips_payment_term set yes="' . $yes . '" where id = "' . ht($row_uuее['id']) . '"');
        }
    }
}
//A
//|
//определяем если есть сроки оплаты какие части стали оплачены а какие наоборот перестали быть
//определяем если есть сроки оплаты какие части стали оплачены а какие наоборот перестали быть




end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo"   => $status_echo,"query" => $query_string,"download"=>$download,"error" =>  $stack_error);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>