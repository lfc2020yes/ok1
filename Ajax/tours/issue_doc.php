<?php
//получить нового договора

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
if ((count($_GET) != 3))
{
    goto end_code;
}




$result_t=mysql_time_query($link,'Select A.id from trips as A where A.visible=1 AND A.id="'.ht($id).'" and A.id_a_company IN ('.$id_company.')');
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



if((validateDate(htmlspecialchars(trim($_GET['date'])),'d.m.Y'))and(trim($_GET['date']!='00.00.0000')))
    {
    mysql_time_query($link, 'update trips set

doc="'.date_ex(1,$_GET['date']).'"

where id = "' . ht($id) . '"');
        //добавить в историю это действие
        AddHistoryTrips('24',$id_user,$id,'','','','','','','','руб.','',$link,'');
    } else
{
    mysql_time_query($link, 'update trips set

doc="0000-00-00"

where id = "' . ht($id) . '"');
    //добавить в историю это действие
    AddHistoryTrips('25',$id_user,$id,'','','','','','','','руб.','',$link,'');
}






end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo"   => $status_echo,"query" => $query_string,"download"=>$_GET["date"],"error" =>  $stack_error);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>