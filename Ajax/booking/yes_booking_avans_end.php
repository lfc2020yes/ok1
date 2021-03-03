<?php
//старые файлы. сейчас не используется в системе
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
$disco=0;

$id=htmlspecialchars($_POST['id']);
$dom=0;
$status_echo='';
//проверка что есть такой город что это число
//проверка что пользователь зарегистрирован

$echo_r=0; //выводить или нет ошибку 0 -нет
$debug='';

//**************************************************
	
if(!token_access_new($token,'bt_booking_avans_end22',$id,"s_form"))
{
   $debug=h4a(100,$echo_r,$debug);
   goto end_code;
}
	
	
	/*
if ( count($_GET) != 4 ) 
{
   $debug=h4a(1,$echo_r,$debug);
   goto end_code;	
}
*/
//**************************************************
 if ((!$role->permission('Заявки','A'))and($sign_admin!=1))
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
if (((!isset($_POST["id"])))or((!isset($_POST['dollor']))))
{
   $debug=h4a(4,$echo_r,$debug);
   goto end_code;	
}
if(($_POST['dollor']==0)or($_POST['dollor']==''))
{
	   $debug=h4a(224,$echo_r,$debug);
   goto end_code;	
}

//**************************************************
$result_t=mysql_time_query($link,'Select b.id_user,b.status,b.ready,b.id_object from booking as b where b.id="'.htmlspecialchars(trim($_POST['id'])).'"');
           $num_results_t = $result_t->num_rows;
	       if($num_results_t!=0)
	       {	
			 
			 $row_t = mysqli_fetch_assoc($result_t);
		   
		     //проверяем может ли видеть этот наряд
	if($row_t["status"]!=6)
	{
				    $debug=h4a(5,$echo_r,$debug);
   goto end_code;	
			 }
			   
		   } else
		   {
			      $debug=h4a(6,$echo_r,$debug);
   goto end_code;	
		   }
	if((array_search($row_t["id_object"],$hie_object) === false)and($sign_admin!=1))
	{
		goto end_code;	
	}
	if(($row_t["ready"]!=1))
	{
		goto end_code;	
	}$result_t1=mysql_time_query($link,'Select count(b.id) as cc from booking_offers as b where b.id_booking="'.htmlspecialchars(trim($_POST['id'])).'" and b.status=2');
           $num_results_t1 = $result_t1->num_rows;
	       if($num_results_t1!=0)
	       {	
			 
			 $row_t1 = mysqli_fetch_assoc($result_t1);
			 if($row_t1["cc"]==0)
			 {
 $debug=h4a(6121,$echo_r,$debug);
   goto end_code; 
			 }
		   } else
		   {
			  			      $debug=h4a(611,$echo_r,$debug);
   goto end_code; 
		   }
//**************************************************
//**************************************************
//**************************************************
//**************************************************

	   $result_status21=mysql_time_query($link,'SELECT sum(a.cost) as cost FROM booking_offers AS a WHERE a.id_booking="'.htmlspecialchars(trim($_POST['id'])).'" and a.status=2');	
		
       if($result_status21->num_rows!=0)
       {  
           $row_status21 = mysqli_fetch_assoc($result_status21);
	   } 	
		
	   //всего отдал
	   $result_status22=mysql_time_query($link,'SELECT sum(a.prepaid) as prepaid FROM booking_status_history AS a WHERE a.id_booking="'.htmlspecialchars(trim($_POST['id'])).'" and a.status=6');	
		
       if($result_status22->num_rows!=0)
       {  
           $row_status22 = mysqli_fetch_assoc($result_status22);
	   } 		
		
		
	   //он вернул все деньги	
       if($row_status22["prepaid"]<$row_status21["cost"])
	   {
		     $debug=h4a(61122,$echo_r,$debug);
   goto end_code; 
	   }



$status_ee='ok';


$flag_podpis=0;
$count_offers=0;
       $works=$_POST['offers'];	
       foreach ($works as $key => $value) 
	   {
		 $count_offers++;  
	    //смотрим вдруг было удалено это предложение	 
		 if($value['id']!='') 
		 {
            $result_t2=mysql_time_query($link,'Select b.cost,b.id from booking_offers as b where b.id_booking="'.htmlspecialchars(trim($_POST['id'])).'" and b.status="2" and b.id="'.htmlspecialchars(trim($value['id'])).'"');
            $num_results_t2 = $result_t2->num_rows;
            if($num_results_t2!=0)
            {
				   $cost_op=trimc($value['operator_cost']);
				   //$cost_cl=trimc($value['client_cost']);
				
			   $number_op=trimc($value['operator_number']);
				
				   if((!is_numeric($cost_op))or($cost_op<=0)) { $flag_podpis++;  }		}
				    if($number_op=='') { $flag_podpis++;  }
            } else
			{
				$flag_podpis++;
			}
				   
	 
	   }


$result_t12=mysql_time_query($link,'Select count(b.id) as cc from booking_offers as b where b.id_booking="'.htmlspecialchars(trim($_POST['id'])).'" and b.status="2"');
$num_results_t12 = $result_t12->num_rows;
if($num_results_t12!=0)
{	
	$row_score12 = mysqli_fetch_assoc($result_t12);
	if(($row_score12["cc"]!=$count_offers)or($row_score12["cc"]==0))
	{
		$flag_podpis++;
	}
} else
{
	$flag_podpis++;
}

if($flag_podpis!=0)
{
   $debug=h4a(6311,$echo_r,$debug);
   goto end_code; 
}


mysql_time_query($link,'update booking set status="3" where id = "'.htmlspecialchars($_POST['id']).'"');
//изменение статуса добавление в историю
	       
mysql_time_query($link,'INSERT INTO booking_status_history (id_booking,id_user,datetime,status,comment) VALUES ("'.htmlspecialchars($_POST['id']).'","'.$id_user.'","'.date("y.m.d").' '.date("H:i:s").'","3","'.htmlspecialchars(trim(trimc($_POST['dollor']))).'")');
//изменение статуса добавление в историю


//если предыдущий статус был перезвонить по заявке и был не выполнен то убираем из задач это
if($row_t["status"]==2)
{
	mysql_time_query($link,'update task set status="1" where action=3 and id_booking = "'.htmlspecialchars($_POST['id']).'" and status=0');
}
//если предыдущий статус был частичная оплата по заявке и был не выполнен то убираем из задач напомнить крайний срок даты отдачи денег
if($row_t["status"]==6)
{
	mysql_time_query($link,'update task set status="1" where action=4 and id_booking = "'.htmlspecialchars($_POST['id']).'" and status=0');
}


//добавляем задание для пользователя что необходимо выписать документы по заявке
$text_task="Выписать документы по заявке №".htmlspecialchars($_POST['id']);

$object_send_task= array();

array_push($object_send_task,$row_t["id_object"]);
/*
if($id_user!=$row_t["id_user"])
{
array_push($user_send_task,$row_t["id_user"]);
}
*/
$object_send_task= array_unique($object_send_task);	

TASK_SEND($text_task,$object_send_task,$_POST['id'],1,1,$link);



       $works=$_POST['offers'];	
$disco=0;
       foreach ($works as $key => $value) 
	   {
			$cost_op=(int)trimc($value['operator_cost']);
		   $number_op=trimc($value['operator_number']);
		   
	$result_t2=mysql_time_query($link,'Select b.cost,b.id from booking_offers as b where b.id_booking="'.htmlspecialchars(trim($_POST['id'])).'" and b.status="2" and b.id="'.htmlspecialchars(trim($value['id'])).'"');
            $num_results_t2 = $result_t2->num_rows;
            if($num_results_t2!=0)
            {
				$row_status222 = mysqli_fetch_assoc($result_t2);
				$cost_cl=$row_status222["cost"];
			}
		   
		   
			
		   $commission=$cost_cl-$cost_op;
		   $disco=$disco+$commission;
		    mysql_time_query($link,'update booking_offers set cost_operator="'.htmlspecialchars($cost_op).'",commission="'.$commission.'",number_op="'.htmlspecialchars($number_op).'" where id = "'.htmlspecialchars($value['id']).'"');
		   
	   }




			      //добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде	
				  $user_send= array();	
				  $user_send_new= array();		

                  $user_send_new=array_merge($hie->boss['4']);

   //создателя договора	
		$text_not='<a href="booking/'.$_POST['id'].'/">Заявка №'.$_POST['id'].'</a> была отмечена как купленная. Вся рассрочка по данной заявке была получена. Прибыль составила '.rtrim(rtrim(number_format($disco, 2, '.', ' '),'0'),'.').' рублей';
        $user_send_new= array_unique($user_send_new);	
		notification_send($text_not,$user_send_new,$id_user,$link);
			 
    //добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде	


end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo"   => $status_echo,"count" => $dom,"echo"=>$echo);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>