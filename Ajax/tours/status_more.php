<?php
//открыть закрыть доступ пользователя

$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';
header("Content-type: application/json");
//include $url_system.'module/config_mail.php';




$status_ee='error';
$eshe=0;
$echo='';
$debug='';
$echo_r=1;
$count_all_all=0;

$id=ht($_GET["id"]);
//**************************************************

if ((!$role->permission('Туры','S'))and($sign_admin!=1))
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
if ((!isset($_SESSION["user_id"])) or (!is_numeric(id_key_crypt_encrypt($_SESSION["user_id"])))) {
    goto end_code;
}

$id_mass = explode(".", ht($_GET['id']));

foreach ($id_mass as $value) {


//**************************************************
    $result_url = mysql_time_query($link, 'select A.id,A.status_admin,A.id_user,A.buy_clients,A.buy_operator from trips as A where A.id="' . ht($value) . '"');
    $num_results_custom_url = $result_url->num_rows;
    if ($num_results_custom_url == 0) {
        $debug = h4a(77, $echo_r, $debug);
        goto end_code;
    } else {
        $row_list = mysqli_fetch_assoc($result_url);
    }

//**************************************************
    if (($row_list["buy_clients"] != 1) or ($row_list["buy_operator"] != 1)) {
        $debug = h4a(98, $echo_r, $debug);
        goto end_code;
    }





    $mas_responsible = array();
    $result_uu = mysql_time_query($link, 'select A.id,A.id_user  from trips as A where A.id="' . ht($value) . '"');
    $num_results_uu = $result_uu->num_rows;

    if ($num_results_uu != 0) {
        $row_uu = mysqli_fetch_assoc($result_uu);
        array_push($mas_responsible, $row_uu["id_user"]);
    } else {
        $debug = h4a(95, $echo_r, $debug);
        goto end_code;
    }


    $tabs_menu_x_visible[4] = 0;
    if ($row_uu["id_user"] != 0) {
        if (($sign_admin != 1)) {

            if ($row_uu["id_user"] == $id_user) {
                $tabs_menu_x_visible[4] = "1";
            }

            if (in_array($id_user, $mas_responsible)) {
                $tabs_menu_x_visible[4] = "1";
            } else {
                //может он управляющий кого то кто должен выполнить эту задачу тогда ему тоже можно ее выполнить
                $subo_x = array();
                foreach ($mas_responsible as $key => $value) {
                    $subo_x = array_merge($subo_x, all_chief($value, $link));

                }
                $subo_x = array_unique($subo_x);


                if ((in_array($id_user, $subo_x))) {
                    $tabs_menu_x_visible[4] = "1";
                }

            }
        } else {
            $tabs_menu_x_visible[4] = "1";
        }

    }

    if ($tabs_menu_x_visible[4] != "1") {
        $debug = h4a(6, $echo_r, $debug);
        goto end_code;
    }

}




$status_ee='ok';


foreach ($id_mass as $value) {
    $result_uu = mysql_time_query($link, 'select A.id,A.id_user  from trips as A where A.id="' . ht($value) . '"');
    $num_results_uu = $result_uu->num_rows;

    if ($num_results_uu != 0) {
        $row_uu = mysqli_fetch_assoc($result_uu);

    }
    $date_r = date("Y-m-d") . ' ' . date("H:i:s");
//изменяем статус заявки
    $st = '';
    $status_party = 0;
    if ($_GET["rel"] == 5) {
        $st_old = 'к оплате';
        $st = 'оплачено';
        mysql_time_query($link, 'update trips set status_admin="2" where id = "' . ht($value) . '"');
        $status_party = 2;
    }

    if ($_GET["rel"] == 4) {
        mysql_time_query($link, 'update trips set status_admin="1" where id = "' . ht($value) . '"');
        $status_party = 1;
        $st_old = 'на проверке';
        $st = 'к оплате';
    }
    if ($_GET["rel"] == 3) {
        mysql_time_query($link, 'update trips set status_admin="0" where id = "' . ht($value) . '"');
        $status_party = 0;
        $st = 'на проверке';
        $st_old = 'оплачено';
    }

//заносим историю по туру
    mysql_time_query($link, 'INSERT INTO trips_status_history_new (id_trips,action_history,id_user,datetimes,edit,comment,comment_sys) VALUES ("' . ht($value) . '","26","' . ht($id_user) . '","' . date("y.m.d") . ' ' . date("H:i:s") . '","0","Изменение статуса по туру №' . ht($value) . ' → c \"' . $st_old . '\" на \"' . $st . '\"","")');


//отправляем уведомление владельцу тура если у него включено это уведомление
    $text_not = '"Изменение статуса по <a href="/tours/.id-' . ht($value) . '">туру №' . ht($value) . '</a> → c ' . $st_old . ' на ' . $st . '.';

    $user_send_new = array();
    $user_send_new = array_merge(UserNotNumberUsers(8, $row_uu["id_user"], $link));

    rm_from_array(0, $user_send_new);
    rm_from_array($id_user, $user_send_new);


    $user_send_new = array_unique($user_send_new);

    notification_send($text_not, $user_send_new, 0, $link);

}



end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"rel" =>  ht($_GET["rel"]),"echo" => $st);
require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);


?>