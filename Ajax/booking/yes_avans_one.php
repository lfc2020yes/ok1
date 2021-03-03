<?php
//частичная оплата. первый аванс
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
	
if(!token_access_new($token,'bt_booking_avanss',$id,"s_form"))
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
if (((!isset($_POST["id"])))or((!isset($_POST['date_123'])))or((!isset($_POST['date_naryad']))))
{
   $debug=h4a(4,$echo_r,$debug);
   goto end_code;	
}

if (((!isset($_POST["avanss"])))or($_POST["avanss"]==0)or($_POST["avanss"]==''))
{
   $debug=h4a(466,$echo_r,$debug);
   goto end_code;	
}

if (((!isset($_POST["payment_method"])))or($_POST["payment_method"]==0)or($_POST["payment_method"]==''))
{
   $debug=h4a(566,$echo_r,$debug);
   goto end_code;	
}


//**************************************************
$result_t=mysql_time_query($link,'Select b.id_user,b.status,b.ready,b.id_object from booking as b where b.id="'.htmlspecialchars(trim($_POST['id'])).'"');
           $num_results_t = $result_t->num_rows;
	       if($num_results_t!=0)
	       {	
			 
			 $row_t = mysqli_fetch_assoc($result_t);
		   
		     //проверяем может ли видеть этот наряд
	if($row_t["status"]==3)
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


$status_ee='ok';


$flag_podpis=0;
$count_offers=0;

       $works=$_POST['offers'];	
       foreach ($works as $key => $value) 
	   {
		   
	   }
/*
		 $count_offers++;  
	    //смотрим вдруг было удалено это предложение	 
		 if($value['id']!='') 
		 {
            $result_t2=mysql_time_query($link,'Select b.cost,b.id from booking_offers as b where b.id_booking="'.htmlspecialchars(trim($_POST['id'])).'" and b.status="2" and b.id="'.htmlspecialchars(trim($value['id'])).'"');
            $num_results_t2 = $result_t2->num_rows;
            if($num_results_t2!=0)
            {
				   $cost_cl=trimc($value['client_cost']);	
				   if((!is_numeric($cost_cl))or($cost_cl<=0)) { $flag_podpis++;  }
				    
            } else
			{
				$flag_podpis++;
			}
				   
	     } else
		 {
			 $flag_podpis++;
		 }
	   }

/*
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

*/

$proc_poteri=0;	
				//проверка способа оплаты
				$result_tp=mysql_time_query($link,'Select b.id,b.proc from booking_payment_method as b where b.visible=1 and b.id="'.htmlspecialchars(trim($_POST['payment_method'])).'"');
                $num_results_tp = $result_tp->num_rows;
	            if($num_results_tp==0){ $flag_podpis++; } else { 
					
					$row_t1p = mysqli_fetch_assoc($result_tp);

				    if(($row_t1p["proc"]!=0)and($row_t1p["proc"]!=''))
					   {
						   $proc_poteri=round(($row_t1p["proc"]*(int)trimc($_POST['avanss']))/100);
					   }
				
				    }




mysql_time_query($link,'update booking set status="6",date_prepaid="'.htmlspecialchars($_POST['date_naryad']).'" where id = "'.htmlspecialchars($_POST['id']).'"');
//изменение статуса добавление в историю	       
mysql_time_query($link,'INSERT INTO booking_status_history (id_booking,id_user,datetime,status,prepaid,payment_method,proc_bank) VALUES ("'.htmlspecialchars($_POST['id']).'","'.$id_user.'","'.date("y.m.d").' '.date("H:i:s").'","6","'.htmlspecialchars(trimc($_POST['avanss'])).'","'.htmlspecialchars($_POST['payment_method']).'","'.$proc_poteri.'")');
//изменение статуса добавление в историю





//изменяем итоговую коммиссию с учетом этого аванса
 $result_t2x=mysql_time_query($link,'Select b.commission,b.id,b.start_fly,b.end_fly from booking_offers as b where b.id_booking="'.htmlspecialchars(trim($_POST['id'])).'" and b.status="2"');
 $num_results_t2x = $result_t2x->num_rows;
 if($num_results_t2x!=0)
 {
	$row_t2x = mysqli_fetch_assoc($result_t2x);
 }


//добавление в историю дат вылетов и отлетов туристов с отдыха
mysql_time_query($link,'INSERT INTO booking_offers_fly_history (id_offers,start_fly,end_fly,datetime,id_user) VALUES ("'.$row_t2x["id"].'","'.$row_t2x["start_fly"].'","'.$row_t2x["end_fly"].'","'.date("y.m.d").' '.date("H:i:s").'","'.$id_user.'")');


 $commission_new=$row_t2x["commission"]-$proc_poteri;

mysql_time_query($link,'update booking_offers set commission="'.htmlspecialchars($commission_new).'" where id = "'.$row_t2x['id'].'"');



//если предыдущий статус был перезвонить по заявке и был не выполнен то убираем из задач это
if($row_t["status"]==2)
{
	mysql_time_query($link,'update task set status="1" where action=3 and id_booking = "'.htmlspecialchars($_POST['id']).'" and status=0');
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




$result_io=mysql_time_query($link,'Select b.cost,b.id,b.cost_operator from booking_offers as b where b.id_booking="'.htmlspecialchars(trim($_POST['id'])).'" and b.status="2" and b.id="'.htmlspecialchars(trim($value['id'])).'"');
$num_results_io = $result_io->num_rows;
if($num_results_io!=0)
{			
	$row_io = mysqli_fetch_assoc($result_io);							
}
//$disco=$row_io["cost_operator"]-$row_io["cost"];
$disco=$row_io["cost"];
/*
       $works=$_POST['offers'];	
$disco=0;
       foreach ($works as $key => $value) 
	   {
			$cost_cl=(int)trimc($value['client_cost']);

		    $disco=$disco+$cost_cl;
		    mysql_time_query($link,'update booking_offers set cost="'.htmlspecialchars($cost_cl).'" where id = "'.htmlspecialchars($value['id']).'"');
		   
	   }
*/

$payment='';

$result_tp=mysql_time_query($link,'Select b.name as cc from booking_payment_method as b where b.id="'.htmlspecialchars(trim($_POST['payment_method'])).'"');
$num_results_tp = $result_tp->num_rows;
if($num_results_tp!=0)
{	
	$row_score12p = mysqli_fetch_assoc($result_tp);
	$payment=$row_score12p["cc"];
}




			      //добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде	
				  $user_send= array();	
				  $user_send_new= array();		

                  $user_send_new=array_merge($hie->boss['4']);

   //создателя договора	
		$text_not='<a href="booking/'.$_POST['id'].'/">Заявка №'.$_POST['id'].'</a> была отмечена как частично оплаченная. Первый платеж составил '.rtrim(rtrim(number_format(trimc($_POST['avanss']), 2, '.', ' '),'0'),'.').' рублей. Способ оплаты - '.$payment.'. Остаток составляет - '.rtrim(rtrim(number_format(($disco-trimc($_POST['avanss'])), 2, '.', ' '),'0'),'.').' рублей.';
        $user_send_new= array_unique($user_send_new);	
		notification_send($text_not,$user_send_new,$id_user,$link);
			 
    //добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде	


end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo"   => $status_echo,"count" => $dom,"echo"=>$echo,"options"=>0);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>