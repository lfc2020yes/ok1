<?php
//изменение статуса обращения уже на оформлен договор или отказ/отмена
$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';
header("Content-type: application/json");
//include $url_system.'module/config_mail.php';




$status_ee='error';
$eshe=0;
$echo='';
$debug='';
$echo_r=1;
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
if(!token_access_new($token,'bt_status_preorders',$id,"rema",2880))
{
    $debug=h4a(100,$echo_r,$debug);
    goto end_code;
}
//****************************
if ((!$role->permission('Обращения','U'))and($sign_admin!=1))
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
if ((!isset($_POST["id"])))
{
    $debug=h4a(4,$echo_r,$debug);
    goto end_code;
}
//**************************************************
$result_url=mysql_time_query($link,'select A.id,A.status,A.id_user,B.name from preorders as A,preorders_status as B where B.number=A.status and B.id_company IN ('. $id_group_company_list.') and A.id="'.ht($id).'" and A.id_company IN ('.$id_company.') and A.id_user="'.$id_user.'"');
        $num_results_custom_url = $result_url->num_rows;
        if($num_results_custom_url==0)
        {
           	  $debug=h4a(77,$echo_r,$debug);
    goto end_code;	
		} 

else
		{
			$row_list = mysqli_fetch_assoc($result_url);
            $st_old=$row_list["name"];
		}

//**************************************************
if((!isset($_SESSION["user_id"]))or(!is_numeric(id_key_crypt_encrypt($_SESSION["user_id"]))))
{	
	goto end_code;
}
//**************************************************

if($_POST["id_status"]==5)
{

    //проверить заполнен ли такой тур и есть ли
    $result_url=mysql_time_query($link,'select A.id from trips as A where A.id_a_company IN ('.$id_company.') and A.id="'.ht($_POST["id_trips"]).'"');
    $num_results_custom_url = $result_url->num_rows;
    if($num_results_custom_url==0)
    {
        $debug=h4a(727,$echo_r,$debug);
        goto end_code;
    }

}
if($_POST["id_status"]==6)
{

    if((!isset($_POST['reason']))or(!is_numeric($_POST['reason'])))
    {
        $debug=h4a(737,$echo_r,$debug);
        goto end_code;
    }

}


//может ли быть статус таким
$result_uusa = mysql_time_query($link, 'select id,name from preorders_status where number="' . ht($_POST["id_status"]) . '" and id_company IN ('. $id_group_company_list.') and visible=1');
$num_results_uusa = $result_uusa->num_rows;

if ($num_results_uusa != 0) {
    $row_uusa = mysqli_fetch_assoc($result_uusa);
    $status_new=$row_uusa["name"];
} else{
    $debug=h4a(888,$echo_r,$debug);
    goto end_code;
}



    $status_ee='ok';

	$date_r=date("Y-m-d").' '.date("H:i:s");
//изменяем статус заявки
$reason=0;
if($_POST["id_status"]==6) {

    $reason=$_POST['reason'];
}

        mysql_time_query($link, 'update preorders set
    
    status="'.ht($_POST["id_status"]).'",
    id_reasons="'.ht($reason).'",
    doc_yes="0",
    datetime_yes="'.date("y.m.d").' '.date("H:i:s").'"
    
    where id = "' . ht($id) . '"');

        mysql_time_query($link, 'update trips set
      
      id_booking="0"
      
      where id_booking="'.ht($id).'" and id_a_company IN ('.$id_company.')');

if($_POST["id_status"]==5) {

    //оформлен договор
    //связать обращение с договором
    mysql_time_query($link, 'update trips set
      
      id_booking="'.ht($id).'"
      
      where id="'.ht($_POST["id_trips"]).'" and id_a_company IN ('.$id_company.')');

    mysql_time_query($link, 'update preorders set      
    doc_yes="1",
    datetime_yes="'.date("y.m.d").' '.date("H:i:s").'"
    
    where id = "' . ht($id) . '"');



}



//заносим историю по туру
        mysql_time_query($link,'INSERT INTO preorders_status_history_new (id_preorder,action_history,id_user,datetimes,edit,comment,comment_sys) VALUES ("'.ht($_POST['id']).'","7","'.ht($id_user).'","'.date("y.m.d").' '.date("H:i:s").'","0","Изменение статуса обращения → c \"'.$st_old.'\" на \"'.$status_new.'\"","")');

//заносим статус о связи с договором
if($_POST["id_status"]==5)
{
    $name_book=info_trips($_POST["id_trips"],$link);

    mysql_time_query($link,'INSERT INTO preorders_status_history_new (id_preorder,action_history,id_user,datetimes,edit,comment,comment_sys) VALUES ("'.ht($_POST['id']).'","8","'.ht($id_user).'","'.date("y.m.d").' '.date("H:i:s").'","0","Оформлен договор по туру <a class=\"preorders-a\" href=\"tours/.id-'.$_POST["id_trips"].'\"><strong>'.$name_book.'</strong></a>","")');

}


end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"next" =>  ht($_POST['id']),"echo" => $status_new,"status_admin"=> $color_status);
require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);


?>