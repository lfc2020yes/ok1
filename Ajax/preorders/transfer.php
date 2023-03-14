<?php
//добавить новое обращение
$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';
header("Content-type: application/json");


//if(empty($_POST['preorders']['id_client'])) {  $_POST['preorders']['id_client']=0; }
//echo($_POST['task']['id_client']);
$temp='';
$status_ee='error';
$eshe=0;
$echo='';
$new=array();
$vid=0;
$debug='';
$count_all_all=0;
$basket='';
$token=htmlspecialchars($_POST['tk']);
$disco=0;

$id=htmlspecialchars($_POST['id']);
$dom=0;
$status_echo='';
//проверка что есть такой город что это число
//проверка что пользователь зарегистрирован

$echo_r=1; //выводить или нет ошибку 0 -нет
$debug='';

//**************************************************
if(!token_access_new($token,'bt_preorders_transfer',$id,"rema",2880))
{
   $debug=h4a(100,$echo_r,$debug);
   goto end_code;
}
	
	
	//echo(count($_POST));
/*
if ( count($_POST) != 3 ) 
{
   $debug=h4a(1,$echo_r,$debug);
   goto end_code;	
}
*/

//**************************************************
 if ((!$role->permission('Обращения','U'))and($sign_admin!=1))
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
if ((!isset($_POST["id"])))
{
   $debug=h4a(4,$echo_r,$debug);
   goto end_code;	
}

$class_js_script='';
$class_js_scrip1='';


$result_t=mysql_time_query($link,'Select A.* from preorders as A where A.visible=1 AND A.id="'.ht($id).'" and A.id_company IN ('.$id_company.')');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{
    $debug=h4a(5,$echo_r,$debug);
    goto end_code;

} else {
    $row_uu = mysqli_fetch_assoc($result_t);
}
if ((!$role->permission('Обращения','U'))and($sign_admin!=1))
{
    $debug=h4a(05,$echo_r,$debug);
    goto end_code;
}

if (((!$role->permission('Обращения','U'))or($sign_level<=1))or($row_uu["status"]!=1))
{
    $debug=h4a(655,$echo_r,$debug);
    goto end_code;
}

if((!isset($_POST["id_user_booking"]))or($_POST["id_user_booking"]==$row_uu["id_user"]))
{
    $debug=h4a(6155,$echo_r,$debug);
    goto end_code;
}

//**************************************************
//**************************************************
//**************************************************
//**************************************************


$status_ee='ok';





$who_kto=ht($id_user);
if((isset($_POST["id_user_booking"]))and($_POST["id_user_booking"]!=0))
{
    $who_kto=ht($_POST["id_user_booking"]);
}


$result_uu_x=mysql_time_query($link,'select name_user from r_user where id="'.ht($_POST["id_user_booking"]).'"');
$num_results_uu_x = $result_uu_x->num_rows;

if($num_results_uu_x!=0)
{
    $row_uu_x = mysqli_fetch_assoc($result_uu_x);

}

$result_uu_x1=mysql_time_query($link,'select name_user from r_user where id="'.ht($row_uu["id_user"]).'"');
$num_results_uu_x1 = $result_uu_x1->num_rows;

if($num_results_uu_x1!=0)
{
    $row_uu_x1 = mysqli_fetch_assoc($result_uu_x1);

}

    //что-то поменялось
    $text_history='Обращение передано от '.$row_uu_x1['name_user'].' → '.$row_uu_x['name_user'];


    mysql_time_query($link, 'update preorders set
    
id_user="'.$who_kto.'"
    
    where id = "' . ht($_POST["id"]) . '"');


    mysql_time_query($link,'INSERT INTO preorders_status_history_new (id_preorder,action_history,id_user,datetimes,edit,comment,comment_sys) VALUES ("'.ht($_POST["id"]).'","9",
		"'.ht($id_user).'",
		"'.date("Y-m-d").' '.date("H:i:s").'",
		"0",
		"'.$text_history.'",
		"")');

//кому принадлежало скрыть уведомления об этом
//кому принадлежала скрыть задачи если были связанные с этим уведомлением

mysql_time_query($link, 'update task_new set visible=0
where id_user_responsible="'.$row_uu["id_user"].'" and
action="20" and
id_object="'.ht($_POST["id"]).'"');


if($row_uu["id_user"]!=$id_user) {

    $text_not = 'Обращение <a href="/preorders/.id-' . ht($_POST["id"]) . '">Обращение №' . ht($_POST["id"]) . '</a> передали от вас к другому менеджеру';

    $user_send_new= array();
    $user_send_new=UserNotNumberUsers("13",$row_uu["id_user"],$link);

    rm_from_array(0,$user_send_new);
    $user_send_new=array_unique($user_send_new);

    notification_send($text_not,$user_send_new,$id_user,$link);

}

if($who_kto!=$id_user)
{
    $text_not = 'Вам поступило новое обращение <a href="/preorders/.id-' . ht($_POST["id"]) . '">Обращение №' . ht($_POST["id"]) . '</a>';

    $user_send_new= array();
    $user_send_new=UserNotNumberUsers("13",$who_kto,$link);

    rm_from_array(0,$user_send_new);
    $user_send_new=array_unique($user_send_new);

    notification_send($text_not,$user_send_new,$id_user,$link);
}






end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo"   => $status_echo,"new" => $new1,"for_id"=>$id,"id" => ht($id),"temp"=>$temp);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>