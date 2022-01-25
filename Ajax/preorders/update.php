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
if(!token_access_new($token,'bt_preorders_edit',$id,"rema",2880))
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
if ((isset($_POST['preorders']["client_type"]))and(is_numeric($_POST['preorders']["id_client"]))and(($_POST['preorders']["client_type"]=='1')or($_POST['preorders']["client_type"]=='2')or($_POST['preorders']["client_type"]=='3'))and($sign_admin!=1))
{
  //проверяем мог ли он привязать эту задачу к данному клиенту
  //если относится к той же компани что и пользователь добавл. задачу

		switch($_POST['preorders']["client_type"])
              {
		 case "1":{ 
			 //частное лицо
			 $sql_tt='Select b.id,b.fio from k_clients as b where b.id="'.ht($_POST['preorders']['id_client']).'" and b.potential=0 and b.visible=1 and b.id_a_company IN ('.ht($id_company).')';
			 $class_js_script='js-client';
             $class_js_scrip1='js-glu-f-';
			 break; 
                  }	
		case "2":{ 
			 //организация
			 $sql_tt='Select b.id,b.name as fio from k_organization as b where b.id="'.ht($_POST['preorders']['id_client']).'" and  b.visible=1 and b.id_a_company IN ('.ht($id_company).')';
            $class_js_script='js-org';
            $class_js_scrip1='js-glo-n-';
			 break; 
                  }		
		 case "3":{ 
			 //потенциальный
			 $sql_tt='Select b.id,b.fio from k_clients as b where b.id="'.ht($_POST['preorders']['id_client']).'" and b.potential=1 and b.visible=1 and b.id_a_company IN ('.ht($id_company).')';
             $class_js_script='js-client';
             $class_js_scrip1='js-glu-f-';
			 break; 
                  }		
		}
	
  $result_t=mysql_time_query($link,$sql_tt);
	
	
	
           $num_results_t = $result_t->num_rows;
	       if($num_results_t==0)
	       {	
			      $debug=h4a(86,$echo_r,$debug);
                  goto end_code;
		   } else
           {
               $row_uu_op = mysqli_fetch_assoc($result_t);
           }
	
} else
{
    $debug=h4a(8699,$echo_r,$debug);
    goto end_code;
}


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

if(($row_uu['id_user']!=$id_user)and($sign_admin!=1))
{
    $debug=h4a(655,$echo_r,$debug);
    goto end_code;
}

if(($row_8["status"]==5)or($row_8["status"]==6)) {

    $debug=h4a(5112,$echo_r,$debug);
    goto end_code;
}

//**************************************************
//**************************************************
//**************************************************
//**************************************************


$status_ee='ok';

$type_c=2;
if(($_POST['preorders']["client_type"]==1)or($_POST['preorders']["client_type"]==3))
{
    $type_c=1;
}

$booking_new='-';
$result_uu226 = mysql_time_query($link, 'select name from booking_sourse where visible=1 and id="' . ht($_POST["type_booking"]) . '"');
$num_results_uu226 = $result_uu226->num_rows;

if ($num_results_uu226 != 0) {
    $row_uu226 = mysqli_fetch_assoc($result_uu226);
    $booking_new=$row_uu226["name"];
}

$country_new='не указано';
$result_uu226 = mysql_time_query($link, 'select name from trips_country where visible=1 and id="' . ht($_POST["id_country"]) . '"');
$num_results_uu226 = $result_uu226->num_rows;

if ($num_results_uu226 != 0) {
    $row_uu226 = mysqli_fetch_assoc($result_uu226);
    $country_new=$row_uu226["name"];
}


$array_param_new=array(
    '<a class=\"preorders-a '.$class_js_script.'\" iod=\"'.$row_uu_op["id"].'\"><strong class=\"'.$class_js_script1.''.$row_uu_op["id"].'\">'.$row_uu_op["fio"].'</strong></a>',
    $_POST["question"],
    $booking_new,
    $country_new
    );

//старые значения находим. то что было до этого





$booking_new='-';
$result_uu226 = mysql_time_query($link, 'select name from booking_sourse where visible=1 and id="' . ht($row_uu["id_booking_sourse"]) . '"');
$num_results_uu226 = $result_uu226->num_rows;

if ($num_results_uu226 != 0) {
    $row_uu226 = mysqli_fetch_assoc($result_uu226);
    $booking_new=$row_uu226["name"];
}

$country_new='не указано';
$result_uu226 = mysql_time_query($link, 'select name from trips_country where visible=1 and id="' . ht($row_uu["id_country"]) . '"');
$num_results_uu226 = $result_uu226->num_rows;

if ($num_results_uu226 != 0) {
    $row_uu226 = mysqli_fetch_assoc($result_uu226);
    $country_new=$row_uu226["name"];
}

$class_js_script='';
$class_js_scrip1='';
switch($row_uu["id_type_clients"])
{
    case "1":{
        //частное лицо
        $sql_tt='Select b.id,b.fio from k_clients as b where b.id="'.ht($row_uu["id_k_clients"]).'" and b.potential=0 and b.visible=1 and b.id_a_company IN ('.ht($id_company).')';
        $class_js_script='js-client';
        $class_js_scrip1='js-glu-f-';
        break;
    }
    case "2":{
        //организация
        $sql_tt='Select b.id,b.name as fio from k_organization as b where b.id="'.ht($row_uu["id_k_clients"]).'" and  b.visible=1 and b.id_a_company IN ('.ht($id_company).')';
        $class_js_script='js-org';
        $class_js_scrip1='js-glo-n-';
        break;
    }
}

$result_t=mysql_time_query($link,$sql_tt);



$num_results_t = $result_t->num_rows;
if($num_results_t!=0)
{
    $row_uu_op = mysqli_fetch_assoc($result_t);



}



$array_param_old=array(
    '<a class=\"preorders-a '.$class_js_script.'\" iod=\"'.$row_uu_op["id"].'\"><strong class=\"'.$class_js_script1.''.$row_uu_op["id"].'\">'.$row_uu_op["fio"].'</strong></a>',
    $row_uu["text"],
    $booking_new,
    $country_new

);



$array_param_comment=array(
    'Клиент',
    'Комментарий',
    'Рекламный источник',
    'Страна');
$history_edit=AddHistoryPreordersAll($_POST["id"],
    $array_param_old,
    $array_param_new,
    $array_param_comment,
    $link);
if($history_edit!='0')
{
    //что-то поменялось
    $text_history='Изменение данных по обращению → '.$history_edit;


    mysql_time_query($link, 'update preorders set
    
id_type_clients="'.$type_c.'",                                                         
id_k_clients="'.ht($_POST['preorders']["id_client"]).'",
id_booking_sourse="'.ht($_POST["type_booking"]).'",                                         
id_country="'.ht($_POST["id_country"]).'",             
text="'.ht($_POST["question"]).'"
    
    where id = "' . ht($_POST["id"]) . '"');

    mysql_time_query($link,'INSERT INTO preorders_status_history_new (id_preorder,action_history,id_user,datetimes,edit,comment,comment_sys) VALUES ("'.ht($_POST["id"]).'","2",
		"'.ht($id_user).'",
		"'.date("Y-m-d").' '.date("H:i:s").'",
		"0",
		"'.$text_history.'",
		"")');


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