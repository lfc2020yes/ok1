<?php
//добавление впечатления по туру

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
$id=htmlspecialchars($_POST['id']);
$dom=0;
$status_echo='';
//проверка что есть такой город что это число
//проверка что пользователь зарегистрирован

$echo_r=0; //выводить или нет ошибку 0 -нет
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
if ((count($_POST) != 3))
{
    goto end_code;
}




$result_t=mysql_time_query($link,'Select A.id,A.id_user from trips as A where A.visible=1 AND A.id="'.ht($id).'" and A.id_a_company="'.$id_company.'"');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{
    $debug=h4a(5,$echo_r,$debug);
    goto end_code;

} else
{
    $row_8 = mysqli_fetch_assoc($result_t);
    //$mas_responsible=explode(",",$row_8["id_user_responsible"]);
}


//**************************************************
//**************************************************
//**************************************************
//**************************************************


$status_ee='ok';




    mysql_time_query($link, 'update trips set

comment="'.ht($_POST['chat']).'"

where id = "' . ht($id) . '"');


$text_history='Добавлено впечатление по туру → '.$_POST["chat"];
mysql_time_query($link,'INSERT INTO trips_status_history_new (id_trips,action_history,id_user,datetimes,edit,comment,comment_sys) VALUES ("'.ht($_POST['id']).'","25","'.ht($id_user).'","'.date("y.m.d").' '.date("H:i:s").'","0","'.ht($text_history).'","")');

  //выполнить задачу автоматически если она была такая
TASK_MAKE(ht($_POST['id']),17,$link,$id_company,$id_user);

//уведомление
//уведомление
//уведомление

$text_not = 'Добавлено новое впечатление по <a href="/tours/.id-' . ht($_POST['id']) . '">Туру №' . ht($_POST['id']) . '</a>: «'.ht($_POST['chat']).'»';

$user_send_new= array();
$user_send_new=array_merge(UserNotNumber(12,$link));

rm_from_array(0,$user_send_new);
rm_from_array($id_user,$user_send_new);
$user_send_new= array_unique($user_send_new);


$mass_ei = all_chief($row_8["id_user"], $link);
rm_from_array($id_user, $mass_ei);
$mass_ei = array_unique($mass_ei);

$end_mass=exception_role($user_send_new,$mass_ei);



notification_send( $text_not,$end_mass,$id_user,$link);



end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo"   => $status_echo,"query" => $query_string,"download"=>'',"error" =>  $stack_error);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>