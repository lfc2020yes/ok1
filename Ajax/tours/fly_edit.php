<?php
//получение материалов из счета при выборе текущего счета
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
$token=htmlspecialchars($_POST['tk']);

$id=htmlspecialchars($_POST['id']);
$dom=0;
$status_echo='';
//проверка что есть такой город что это число
//проверка что пользователь зарегистрирован

$echo_r=1; //выводить или нет ошибку 0 -нет
$debug='';

//**************************************************
	
if(!token_access_new($token,'bt_fly_edit',$id,"s_form"))
{
   $debug=h4a(100,$echo_r,$debug);
   goto end_code;
}
	
	
	
if ( count($_POST) != 4 ) 
{
   $debug=h4a(1,$echo_r,$debug);
   goto end_code;	
}
//**************************************************
 if ((!$role->permission('Туры','U'))and($sign_admin!=1))
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
//**************************************************
$result_t=mysql_time_query($link,'Select A.id,A.id_affiliates,buy_clients,buy_operator from trips as A where A.visible=1 AND A.id="'.ht($_POST["id"]).'" and A.id_a_company IN ('.$id_company.')');

           $num_results_t = $result_t->num_rows;
	       if($num_results_t!=0)
	       {	
			 
			 $row_t = mysqli_fetch_assoc($result_t);
               $array_param_new = array(($row_t["buy_clients"]), $row_t["buy_operator"]);
		   } else
		   {
			      $debug=h4a(6,$echo_r,$debug);
   goto end_code;	
		   }

/*
	if((array_search($row_t["id_object"],$hie_object) === false)and($sign_admin!=1))
	{
		goto end_code;	
	}
*/
//**************************************************
//**************************************************
//**************************************************
//**************************************************
$start_mi='';
$end_mi='';
$result_mi=mysql_time_query($link,'SELECT a.* FROM trips_fly_history AS a WHERE a.id_trips="'.$id.'" order by a.datetime DESC limit 0,1');

if($result_mi->num_rows!=0)
{
    $row_mi = mysqli_fetch_assoc($result_mi);
    $start_mi=$row_mi["start_fly"];
    $end_mi=$row_mi["end_fly"];
}


$status_ee='ok';


//добавление в историю дат вылетов и отлетов туристов с отдыха

$date_start=explode(" ",htmlspecialchars(trim($_POST['start'])));
$date_start1=explode(".",htmlspecialchars(trim($date_start[0])));		
$startx=$date_start1[2].'-'.$date_start1[1].'-'.$date_start1[0].' '.$date_start[1].':00';		
						
$date_end=explode(" ",htmlspecialchars(trim($_POST['end'])));
$date_end1=explode(".",htmlspecialchars(trim($date_end[0])));		
$endx=$date_end1[2].'-'.$date_end1[1].'-'.$date_end1[0].' '.$date_end[1].':00';	


mysql_time_query($link,'INSERT INTO trips_fly_history (id_trips,start_fly,end_fly,datetime,id_user) VALUES ("'.htmlspecialchars(trim($_POST['id'])).'","'.htmlspecialchars(trim($startx)).'","'.htmlspecialchars(trim($endx)).'","'.date("y.m.d").' '.date("H:i:s").'","'.$id_user.'")');

//помечаем этот тур к проверки по партнерки если изменяются вылеты. вдруг изменилось на такое что было
//что он уже прилетел на то что он еще не летал.
if(($array_param_new[0] == 1) and ($array_param_new[1] == 1)) {
    if ($row_t["id_affiliates"] != 0) {
        mysql_time_query($link, 'INSERT INTO affiliates_trips_check(id_trips) VALUES( 
    "' . ht($_POST['id']) . '")');
    }
}



//удаляем задачу по вылетам туда и обратно если она есть по этой заявке она сама сформируется в течениее часа по новым данным
$date_end_plus3=date_step_sql('Y-m-d','+0d');	
$result_ss = mysql_time_query($link,'SELECT A.id,A.id_user_responsible FROM task_new as A WHERE A.id_object="'.ht($row_t["id"]).'" and A.visible=1 and A.action="15" and A.status=0 and A.ring_datetime>="'.$date_end_plus3.' 00:00:00"');
        $num_ss = $result_ss->num_rows;	
        if($num_ss!=0)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);	
		   mysql_time_query($link,'delete FROM task_new where id="'.ht($row_ss["id"]).'"');
			UpdateTaskKey($row_ss["id_user_responsible"],$link);
		}

$result_ss = mysql_time_query($link,'SELECT A.id,A.id_user_responsible FROM task_new as A WHERE A.id_object="'.ht($row_t["id"]).'" and A.visible=1 and A.action="16" and A.status=0 and A.ring_datetime>="'.$date_end_plus3.' 00:00:00"');
	
	
        $num_ss = $result_ss->num_rows;	
        if($num_ss!=0)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);	
		   mysql_time_query($link,'delete FROM task_new where id="'.ht($row_ss["id"]).'"'); 
			UpdateTaskKey($row_ss["id_user_responsible"],$link);
		}

//Удаляем и задачу по впечатлениям. Она сформируется сама автоматически по новым датам в течении часа
$result_ss = mysql_time_query($link,'SELECT A.id,A.id_user_responsible FROM task_new as A WHERE A.id_object="'.ht($row_t["id"]).'" and A.visible=1 and A.action="17" and A.status=0');


$num_ss = $result_ss->num_rows;
if($num_ss!=0)
{
    $row_ss = mysqli_fetch_assoc($result_ss);
    mysql_time_query($link,'delete FROM task_new where id="'.ht($row_ss["id"]).'"');
    UpdateTaskKey($row_ss["id_user_responsible"],$link);
}




/*
mysql_time_query($link,'update task set status="1" where id_booking="'.$row_t["id_booking"].'" and status=0 and action=6');
mysql_time_query($link,'update task set status="1" where id_booking="'.$row_t["id_booking"].'" and status=0 and action=5');
*/




$array_param_old=array($start_mi,$end_mi);

$array_param_new=array();

$result_uu11 = mysql_time_query($link, 'select A.cost_client,A.exchange_rates,A.cost_operator,A.exchange_rates_operator,A.discount  from trips as A where A.id="' . ht($_POST['id']) . '"');
$num_results_uu11 = $result_uu11->num_rows;

if ($num_results_uu11 != 0) {

    $row_uu11 = mysqli_fetch_assoc($result_uu11);

    $array_param_new=array($startx,$endx);

}




//добавить в историю это действие
AddHistoryTripsFly('17',
    $id_user,
    $_POST["id"],
    $array_param_old,
    $array_param_new,
    $link,
    '');



end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo"   => $status_echo,"id" => $_POST['id'],"echo"=>$echo,"start"=>rooo(trips_neo(htmlspecialchars(trim($_POST['start'])),1),'','—'),"end"=>rooo(trips_neo(htmlspecialchars(trim($_POST['end'])),1),'','—'));
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>