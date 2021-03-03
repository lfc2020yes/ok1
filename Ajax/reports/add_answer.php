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
if(!token_access_new($token,'add_answer_xx',$id,"s_form"))
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
 if ((!$role->permission('Отчеты','R'))and($sign_admin!=1))
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

if ((trim($_GET["answer"])=='')) 
{
   $debug=h4a(5,$echo_r,$debug);
   goto end_code;	
}
//**************************************************
$result_t=mysql_time_query($link,'Select b.id_user,b.id from reports as b where b.id="'.htmlspecialchars(trim($_GET['id'])).'"');
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
	if($row_t["id_user"] == $id_user)
	{
      $debug=h4a(68,$echo_r,$debug);
	}

//**************************************************
//**************************************************
//**************************************************
//**************************************************


$status_ee='ok';

	 $today[0] = date("y.m.d"); //присвоено 03.12.01
             $today[1] = date("H:i:s"); //присвоит 1 элементу массива 17:16:17

	         $date_=$today[0].' '.$today[1];
 mysql_time_query($link,'INSERT INTO reports_answers (id_answers,id_users,id_reports,text,datetimes,visible) VALUES ("0","'.$id_user.'","'.$id.'","'.htmlspecialchars(trim($_GET['answer'])).'","'.$date_.'","1")');
$ID_N=mysqli_insert_id($link); 

$result_txs=mysql_time_query($link,'Select a.name_user,a.timelast,a.id from r_user as a where a.id="'.$id_user.'"');
if($result_txs->num_rows!=0)
{   
	$rowxs = mysqli_fetch_assoc($result_txs);
} 	

$echo='<div class="answer_block" op_rel="'.$ID_N.'"><div class="open_operator"></div><span class="h57"><span>'.$_GET['answer'].'</span><div class="ktoo2">'.$rowxs["name_user"].'</div></span><div class="font-ranks edit_answer_" data-tooltip="Изменить" id_rel="'.$ID_N.'"><span class="font-ranks-inner">}</span></div><div class="font-ranks del_answer_" data-tooltip="Удалить" id_rel="'.$ID_N.'"><span class="font-ranks-inner">x</span></div></div>';



				//добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде	
				  $user_send= array();	
				  $user_send_new= array();		
array_push($user_send_new,$row_t["id_user"]);
//$user_send_new=array_merge($hie->boss['4']);

   //создателя договора	
		$text_not='Поступил новый вопрос по <a href="reports/'.$id.'/">Отчету №'.$id.'</a>';
        $user_send_new= array_unique($user_send_new);	
		notification_send($text_not,$user_send_new,$id_user,$link);
			 
    //добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде	   
	

//mysql_time_query($link,'delete FROM z_invoice_material where id_invoice="'.htmlspecialchars(trim($_GET['id'])).'"');
//mysql_time_query($link,'delete FROM z_invoice_attach where id_invoice="'.htmlspecialchars(trim($_GET['id'])).'"');


end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo"   => $status_echo,"id" => $ID_N,"echo"=>$echo);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>