<?php
//добавление заметки к туру

$name_form='003U';
$key_form='bt_task_info';
$flag=0;
//показать еще сообщения общения в клиенте
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
//$token=htmlspecialchars($_GET['tk']);
$disco=0;
$id=htmlspecialchars($_POST['id']);
$query_string='';
$dom=0;
$status_echo='';
//проверка что есть такой город что это число
//проверка что пользователь зарегистрирован

$echo_r=0; //выводить или нет ошибку 0 -нет
$debug='';

//**************************************************

//**************************************************
if ((!$role->permission('Договора','R'))and($sign_admin!=1))
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


$mas_responsible=array();
$result_uu = mysql_time_query($link, 'select A.id,A.id_user  from trips as A where A.id_contract="' . ht($_POST['id']) . '" and A.id_a_company="'.$id_company.'"');
$num_results_uu = $result_uu->num_rows;

if ($num_results_uu != 0) {
    $row_uu = mysqli_fetch_assoc($result_uu);
    array_push($mas_responsible,$row_uu["id_user"]);
} else
{
    $debug=h4a(95,$echo_r,$debug);
    goto end_code;
}




/*
0 5
5 5
10 5
15 5
*/
//**************************************************
//**************************************************
//**************************************************
//**************************************************

$status_ee='ok';

if(trim($_POST['rate'])!='') {
    $result_uui = mysql_time_query($link, 'select comment,id from trips_contract_status_history_new where id_contract="' . ht($_POST['id']) . '" and action_history="1" and id_user="' . $id_user . '" order by datetimes desc limit 1');
    $num_results_uui = $result_uui->num_rows;

    if ($num_results_uui != 0) {

        $row_uu67 = mysqli_fetch_assoc($result_uui);
        mysql_time_query($link, 'update trips_contract_status_history_new set
    
    comment="' . $_POST['rate'] . '"
    
    where id = "' . ht($row_uu67['id']) . '"');

    } else {
        mysql_time_query($link, 'INSERT INTO trips_contract_status_history_new (id_contract,action_history,id_user,datetimes,edit,comment,comment_sys) VALUES ("' . ht($_POST['id']) . '","1","' . ht($id_user) . '","' . date("y.m.d") . ' ' . date("H:i:s") . '","1","' . ht($_POST['rate']) . '","")');
    }
} else
{
    mysql_time_query($link, 'delete FROM trips_contract_status_history_new where id_contract="' . ht($_POST['id']) . '" and action_history=1 and id_user="'.ht($id_user).'"');
    $flag=1;
}
$ID_N=mysqli_insert_id($link);


$task_cloud_block='';

$result_uu2 = mysql_time_query($link, 'Select DISTINCT A.id as ids,A.id_user,A.doc,hotel,A.place_name,A.id_country,B.* from trips as A,trips_contract as B where A.visible=1 AND B.id=A.id_contract and B.id="'.ht($_POST['id']).'"');
$num_results_uu2 = $result_uu2->num_rows;

if ($num_results_uu2 != 0) {
    $row_88 = mysqli_fetch_assoc($result_uu2);

    $new_sa=1;
    include $url_system . 'contracts/code/block_doc.php';

}




end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"echo"=>$task_cloud_block,"flag"=>$flag);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>