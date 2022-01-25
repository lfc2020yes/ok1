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
if ((!$role->permission('Обращения','D'))and($sign_admin!=1))
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
if(!token_access_new($token,'dell_buy_preorders',$_GET["id"],"rema",2880))
{
    $debug=h4a(100,$echo_r,$debug);
    goto end_code;
}


$mas_responsible=array();
$result_uu=mysql_time_query($link,'Select b.id,b.id_user from preorders as b where b.id="'.htmlspecialchars(trim($_GET['id'])).'" and b.visible=1 and b.id_company IN ('.ht($id_company).')');
$num_results_uu = $result_uu->num_rows;

if ($num_results_uu != 0) {
    $row_uu = mysqli_fetch_assoc($result_uu);
} else
{
    $debug=h4a(95,$echo_r,$debug);
    goto end_code;
}
if(($row_uu['id_user']!=$id_user)and($sign_admin!=1))
{
    goto end_code;
}


//**************************************************
//**************************************************
//**************************************************
//**************************************************


$status_ee='ok';



mysql_time_query($link, 'update preorders set visible="0" where id = "' . ht($id) . '"');

mysql_time_query($link,'INSERT INTO preorders_status_history_new (id_preorder,action_history,id_user,datetimes,edit,comment,comment_sys) VALUES ("'.ht($id).'","5","'.ht($id_user).'","'.date("y.m.d").' '.date("H:i:s").'","0","Обращение удалено","")');

//удаляем связи с туром
mysql_time_query($link, 'update trips set
      
      id_booking="0"
      
      where id_booking="'.ht($id).'" and id_a_company IN ('.$id_company.')');

//удаление задач по обращению
mysql_time_query($link, 'update task_new set
      
      visible="0"
      
      where action="20" and id_object="'.ht($id).'" and id_a_company IN ('.$id_company.')');

end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo"   => $status_echo,"query" => $query_string,"download"=>$download,"error" =>  $stack_error);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>