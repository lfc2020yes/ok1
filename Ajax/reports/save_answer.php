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

$id=htmlspecialchars($_GET['id']);
$dom=0;
$status_echo='';
//проверка что есть такой город что это число
//проверка что пользователь зарегистрирован

$echo_r=0; //выводить или нет ошибку 0 -нет
$debug='';

//**************************************************
	
	
	
if ( count($_GET) != 3 ) 
{
   $debug=h4a(1,$echo_r,$debug);
   goto end_code;	
}
/*
if ((trim($_GET["text"])=='')) 
{
   $debug=h4a(5,$echo_r,$debug);
   goto end_code;	
}
*/
//**************************************************

 if ((!$role->permission('Отчеты','R'))and($sign_admin!=1))
{
  $debug=h4a(2,$echo_r,$debug);
  goto end_code;	
}

$result_t=mysql_time_query($link,'Select a.id,a.id_users,a.id_reports,b.id_user,a.text from reports_answers as a,reports as b where b.id=a.id_reports and a.id="'.htmlspecialchars(trim($_GET['id'])).'"');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{	
		$debug=h4a(5,$echo_r,$debug);
		goto end_code;
	
} else
{
	$row_score = mysqli_fetch_assoc($result_t);
	
	if(($row_score["id_user"]!=$id_user)and($sign_admin!=1))
	{
		$debug=h4a(8,$echo_r,$debug);
		goto end_code;		
	}
}

/*
 if ($sign_admin!=1)
{
  $debug=h4a(2,$echo_r,$debug);
  goto end_code;	
}
*/
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
//**************************************************
//**************************************************
//**************************************************
//**************************************************
//**************************************************
//echo(nl2br($_GET['text']));

$status_ee='ok';

	$result_txs1=mysql_time_query($link,'Select a.id from reports_answers as a where a.visible=1 and a.id_answers="'.htmlspecialchars($_GET['id']).'"');
	            if($result_txs1->num_rows!=0)
	            {  

mysql_time_query($link,'update reports_answers set text="'.htmlspecialchars($_GET['text']).'" where id_answers = "'.htmlspecialchars($_GET['id']).'"');

				} else
				{
 $today[0] = date("y.m.d"); //присвоено 03.12.01
             $today[1] = date("H:i:s"); //присвоит 1 элементу массива 17:16:17

	         $date_=$today[0].' '.$today[1];					
mysql_time_query($link,'INSERT INTO reports_answers (id_answers,id_users,id_reports,text,datetimes,visible) VALUES ("'.htmlspecialchars($_GET['id']).'","'.$id_user.'","'.$row_score["id_reports"].'","'.htmlspecialchars(trim($_GET['text'])).'","'.$date_.'","1")');
					
				}
				//добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде	
				  $user_send= array();	
				  $user_send_new= array();		
array_push($user_send_new,$row_score["id_users"]);
//$user_send_new=array_merge($hie->boss['4']);

   //создателя договора	
		$text_not='На вопрос «'.htmlspecialchars($row_score["text"]).'» был добавлен или изменен ответ в <a href="reports/'.$row_score["id_reports"].'/">Отчете №'.$row_score["id_reports"].'</a>.';
        $user_send_new= array_unique($user_send_new);	
		notification_send($text_not,$user_send_new,$id_user,$link);
			 
    //добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде	   


$echo=$_GET['answer'];

end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo"   => $status_echo,"count" => $dom,"echo"=>$echo);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>