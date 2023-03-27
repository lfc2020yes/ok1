<?php
//изменение статуса обращения
//если статус меняется который требует дополнительной информации то ничего в базах не изменяет просто выводим окно

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

    $status_ee='ok';

	$date_r=date("Y-m-d").' '.date("H:i:s");
//изменяем статус заявки


//определим какой следующий статус идет
$result_uust = mysql_time_query($link, 'select number,menu,name from preorders_status where id_company IN (' . ht( $id_group_company_list) . ') and number>"'.$row_list["status"].'" and visible=1 order by displayOrder limit 1');
$num_results_uust = $result_uust->num_rows;
$next=0;
$status_new='';
$status_new_id='';


if ($num_results_uust != 0) {
    $row_uust = mysqli_fetch_assoc($result_uust);
    if($row_uust["menu"]==1)
    {
        $next=1;
    }
    $status_new=$row_uust["name"];
    $status_new_id=$row_uust["number"];
} else {
    //сбрасываем статус на первоночальный и удаляем все связи с туром и reason
    $next=1;
    /*
    $result_uuppo = mysql_time_query($link, 'select number,menu,name from preorders_status where id_company="' . ht($id_company) . '" and visible=1 order by displayOrder limit 1');
    $num_results_uuppo = $result_uuppo->num_rows;

    if ($num_results_uuppo != 0) {
        $row_uuppo = mysqli_fetch_assoc($result_uuppo);
        $status_new = $row_uuppo["name"];
        $status_new_id = $row_uuppo["number"];
    }
    */
}

    if($next==0) {
        mysql_time_query($link, 'update preorders set
    
    status="'.$status_new_id.'",
    id_reasons="0",
    doc_yes="0",
    datetime_yes="0000-00-00 00:00:00"
    
    where id = "' . ht($id) . '"');

        mysql_time_query($link, 'update trips set
      
      id_booking="0"
      
      where id_booking="'.ht($id).'" and id_a_company IN ('.$id_company.')');


//заносим историю по туру
        mysql_time_query($link,'INSERT INTO preorders_status_history_new (id_preorder,action_history,id_user,datetimes,edit,comment,comment_sys) VALUES ("'.ht($_GET['id']).'","7","'.ht($id_user).'","'.date("y.m.d").' '.date("H:i:s").'","0","Изменение статуса обращения → c \"'.$st_old.'\" на \"'.$status_new.'\"","")');



    }

$color_status=1;
if(($status_new_id==2)or($status_new_id==3)or($status_new_id==4)) {$color_status=2;}
if($status_new_id==5) {$color_status=3;}
if($status_new_id==6) {$color_status=4;}




end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"next" =>  $next,"echo" => $status_new,"status_admin"=> $color_status);
require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);


?>