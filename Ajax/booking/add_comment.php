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
//$token=htmlspecialchars($_GET['tk']);
$token=htmlspecialchars($_GET['tk']);

$id=htmlspecialchars($_GET['id']);
$dom=0;
$status_echo='';
//проверка что есть такой город что это число
//проверка что пользователь зарегистрирован

$echo_r=0; //выводить или нет ошибку 0 -нет
$debug='';

//**************************************************
if(!token_access_new($token,'bt_add_edit_comment',$id,"s_form"))
{
   $debug=h4a(102,$echo_r,$debug);
   goto end_code;
}
	

if ( count($_GET) != 4 ) 
{
   $debug=h4a(1,$echo_r,$debug);
   goto end_code;	
}
//**************************************************
if((!$role->permission('Заявки','U'))and($sign_admin!=1))
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
if ((!isset($_GET["id"]))) 
{
   $debug=h4a(4,$echo_r,$debug);
   goto end_code;	
}


if((!isset($_SESSION["user_id"]))or(!is_numeric(id_key_crypt_encrypt($_SESSION["user_id"]))))
{	
	goto end_code;
}

$id_user=id_key_crypt_encrypt($_SESSION["user_id"]);

if ((trim($_GET["answer"])=='')) 
{
   $debug=h4a(5,$echo_r,$debug);
   goto end_code;	
}
//**************************************************
$result_t=mysql_time_query($link,'Select b.id_booking,b.status,b.end_fly,a.status as st,a.id_user,b.comment_client from booking_offers as b,booking as a where a.id=b.id_booking and b.id="'.htmlspecialchars(trim($_GET['id'])).'"');
           $num_results_t = $result_t->num_rows;
	       if($num_results_t!=0)
	       {	
			 $row_t = mysqli_fetch_assoc($result_t);		   
		     //проверяем может ли видеть этот наряд		   
		   } else
		   {
			 $debug=h4a(6,$echo_r,$debug);
             goto end_code;	
		   }
if(($row_t["status"]!=2))
	{
		$debug=h4a(8,$echo_r,$debug);
		goto end_code;		
	}

		if(($row_t["st"]!=3)and($row_t["st"]!=6)and($row_t["status"]!=2))		
        {	
					$debug=h4a(8554,$echo_r,$debug);
		            goto end_code;					
		}

		if(($row_t["id_user"]!=$id_user)and($sign_admin!=1))
		{ 
					$debug=h4a(8553,$echo_r,$debug);
		            goto end_code;			
		}



//**************************************************
//**************************************************
//**************************************************
//**************************************************


$status_ee='ok';

$today[0] = date("y.m.d"); //присвоено 03.12.01
$today[1] = date("H:i:s"); //присвоит 1 элементу массива 17:16:17

$date_=$today[0].' '.$today[1];

mysql_time_query($link,'update booking_offers set comment_client="'.htmlspecialchars($_GET['answer']).'" where id = "'.htmlspecialchars($_GET['id']).'"');

//если у пользователя стояла задача узнать впечатления ставим ее как выполненную
$result_task_my=mysql_time_query($link,'Select a.* from task as a where a.action="8" and a.status=0 and a.id_booking="'.$row_t["id_booking"].'" and a.id_user="'.$row_t["id_user"].'"');
if($result_task_my->num_rows!=0)
{   

  $row_task_my = mysqli_fetch_assoc($result_task_my);
  mysql_time_query($link,'update task set status="1" where id = "'.htmlspecialchars($row_task_my["id"]).'"');

  mysql_time_query($link,'INSERT INTO task_status_history(id_task,id_user,datetime,status) VALUES ("'.htmlspecialchars($row_task_my["id"]).'","'.$id_user.'","'.date("y.m.d").' '.date("H:i:s").'","1")');
}

$user_send= array();	
$user_send_new= array();	

if($sign_admin!=1)
{
//добавляем уведомления 
//добавляем уведомления 
//добавляем уведомления 		

$user_send_new=array_merge($hie->boss['4']);
} else
{
array_push($user_send_new,$row_t["id_user"]);	
}
	
$result_txs=mysql_time_query($link,'Select a.name_user,a.timelast,a.id from r_user as a where a.id="'.$id_user.'"');
if($result_txs->num_rows!=0)
{   
	$rowxs = mysqli_fetch_assoc($result_txs);
} 	




				//добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде	
//$user_send_new=array_merge($hie->boss['4']);

   //создателя договора	
		$text_not=$rowxs["name_user"].' изменил(а) впечатление туриста по <a href="booking/'.$row_t["id_booking"].'/">Заявке №'.$row_t["id_booking"].'</a>.';
        $user_send_new= array_unique($user_send_new);	
		notification_send($text_not,$user_send_new,$id_user,$link);
			 
    //добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде	   
	

//mysql_time_query($link,'delete FROM z_invoice_material where id_invoice="'.htmlspecialchars(trim($_GET['id'])).'"');
//mysql_time_query($link,'delete FROM z_invoice_attach where id_invoice="'.htmlspecialchars(trim($_GET['id'])).'"');


end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo"   => $status_echo,"id" => ($ID_N ?? ''),"commm"=>htmlspecialchars($_GET['answer']));
/*
require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);

?>