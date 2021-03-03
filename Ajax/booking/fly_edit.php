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
 if ((!$role->permission('Заявки','U'))and($sign_admin!=1))
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
$result_t=mysql_time_query($link,'Select b.id as dib,b.id_user,b.status,b.id_object,a.id,a.cost,a.id_booking,a.status as st from booking_offers as a,booking as b where a.id_booking=b.id and a.id="'.htmlspecialchars(trim($_POST['id'])).'"');
           $num_results_t = $result_t->num_rows;
	       if($num_results_t!=0)
	       {	
			 
			 $row_t = mysqli_fetch_assoc($result_t);
		   
		     //проверяем может ли видеть этот наряд
	if(($row_t["status"]!=3)and($row_t["status"]!=6))
	{
				    $debug=h4a(5,$echo_r,$debug);
   goto end_code;	
			 }
			   
		   } else
		   {
			      $debug=h4a(6,$echo_r,$debug);
   goto end_code;	
		   }

	if($row_t["st"]!=2)
	{
				    $debug=h4a(7,$echo_r,$debug);
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


$status_ee='ok';


//добавление в историю дат вылетов и отлетов туристов с отдыха

$date_start=explode(" ",htmlspecialchars(trim($_POST['start'])));
$date_start1=explode(".",htmlspecialchars(trim($date_start[0])));		
$startx=$date_start1[2].'-'.$date_start1[1].'-'.$date_start1[0].' '.$date_start[1].':00';		
						
$date_end=explode(" ",htmlspecialchars(trim($_POST['end'])));
$date_end1=explode(".",htmlspecialchars(trim($date_end[0])));		
$endx=$date_end1[2].'-'.$date_end1[1].'-'.$date_end1[0].' '.$date_end[1].':00';	


mysql_time_query($link,'INSERT INTO booking_offers_fly_history (id_offers,start_fly,end_fly,datetime,id_user) VALUES ("'.htmlspecialchars(trim($_POST['id'])).'","'.htmlspecialchars(trim($startx)).'","'.htmlspecialchars(trim($endx)).'","'.date("y.m.d").' '.date("H:i:s").'","'.$id_user.'")');

//удаляем задачу по вылетам туда и обратно если она есть по этой заявке она сама сформируется в течениее часа по новым данным
$date_end_plus3=date_step_sql('Y-m-d','+0d');	
$result_ss = mysql_time_query($link,'SELECT A.id,A.id_user_responsible FROM task_new as A WHERE A.id_object="'.ht($row_t["dib"]).'" and A.visible=1 and A.action="5" and A.status=0 and A.ring_datetime>="'.$date_end_plus3.' 00:00:00"');
	
	
        $num_ss = $result_ss->num_rows;	
        if($num_ss!=0)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);	
		   mysql_time_query($link,'delete FROM task_new where id="'.ht($row_ss["id"]).'"');
			UpdateTaskKey($row_ss["id_user_responsible"],$link);
		}

$result_ss = mysql_time_query($link,'SELECT A.id,A.id_user_responsible FROM task_new as A WHERE A.id_object="'.ht($row_t["dib"]).'" and A.visible=1 and A.action="6" and A.status=0 and A.ring_datetime>="'.$date_end_plus3.' 00:00:00"');
	
	
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



end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo"   => $status_echo,"id" => $_POST['id'],"echo"=>$echo,"start"=>htmlspecialchars(trim($_POST['start'])),"end"=>htmlspecialchars(trim($_POST['end'])));
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>