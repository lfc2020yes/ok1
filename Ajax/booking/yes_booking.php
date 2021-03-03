<?php
//забронировали заявку
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

$echo_r=1; //выводить или нет ошибку 0 -нет
$debug='';

//**************************************************
	
if(!token_access_new($token,'bt_booking_end',$id,"s_form"))
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
if ((!isset($_POST["id"])))
{
   $debug=h4a(4,$echo_r,$debug);
   goto end_code;	
}
/*
if(($_POST['dollor']==0)or($_POST['dollor']==''))
{
	   $debug=h4a(224,$echo_r,$debug);
   goto end_code;	
}
*/
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
				   $cost_op_cl=trimc($value['operator_client_cost']);
				   $cost_cl=trimc($value['client_cost']);
				   $number_op=trimc($value['operator_number']);
				
				   //проверка 3 забитых цен
				   if((!is_numeric($cost_op))or($cost_op<=0)) { $flag_podpis++;  }
				   if((!is_numeric($cost_op_cl))or($cost_op_cl<=0)) { $flag_podpis++;  }	
				   if((!is_numeric($cost_cl))or($cost_cl<=0)) { $flag_podpis++;  }
				   

				
				
				  // if($cost_op>$cost_cl) {  $flag_podpis++; }
				
				   if($value['operator_number']=='') { $flag_podpis++;  }
				   if($value['doc_number']=='') { $flag_podpis++;  }
				
				   if($number_op=='') { $flag_podpis++;  }
				
				//проверка валюты
				$result_tp=mysql_time_query($link,'Select b.id from booking_exchange as b where b.id="'.htmlspecialchars(trim($value['exchange'])).'"');
                $num_results_tp = $result_tp->num_rows;
	            if($num_results_tp==0){ $flag_podpis++; }
				//проверка курса валюты
				if((!is_numeric(trimc($value['exchange_rates'])))or(trimc($value['exchange_rates'])<=0)) { $flag_podpis++;  }
				$proc_poteri=0;
				if($value['options']==0)
                {
				$proc_poteri=0;	
				//проверка способа оплаты
				$result_tp=mysql_time_query($link,'Select b.id,b.proc from booking_payment_method as b where b.visible=1 and b.id="'.htmlspecialchars(trim($value['client_payment_method'])).'"');
                $num_results_tp = $result_tp->num_rows;
	            if($num_results_tp==0){ $flag_podpis++; } else { 
					
					$row_t1p = mysqli_fetch_assoc($result_tp);
					if($row_t1p["comm"]==1)
					{
						$p_bank=trimc($value['proc_bank']);
						if((!is_numeric($p_bank))or($p_bank<0)) { $flag_podpis++;  } else {$proc_poteri=$p_bank;	}
					
					}
				    if(($row_t1p["proc"]!=0)and($row_t1p["proc"]!=''))
					   {
						   $proc_poteri=round(($row_t1p["proc"]*(int)trimc($value['client_cost']))/100);
					   }
				
				    }
					
					
					
				}
				//проверка даты время вылета и отлета
				
				
            } else
			{
				$flag_podpis++;
			}
				   
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


$status_ee='ok';


//изменения статуса самой заявки 3 - купили
if($value['options']==0)
{
//если полная оплата	
mysql_time_query($link,'update booking set status="3" where id = "'.htmlspecialchars($_POST['id']).'"');
}

//добавление номера договора umatravel
//27/06/2019 - 90 от 27 июня 2019
$date_doc_=explode("-",htmlspecialchars(trim($value['doc_number'])));
$date_r=explode(" ",htmlspecialchars(trim($date_doc_[1])));
$date_r1=explode("/",htmlspecialchars(trim($date_doc_[0])));
mysql_time_query($link,'INSERT INTO booking_contract (years,number,name,datetime,id_user) VALUES ("'.htmlspecialchars($date_r1[2]).'","'.htmlspecialchars($date_r[0]).'","'.htmlspecialchars(trim($value['doc_number'])).'","'.date("y.m.d").' '.date("H:i:s").'","'.$id_user.'")');
$IDOC=mysqli_insert_id($link); 	


//изменения данных по предложению
$date_start=explode(" ",htmlspecialchars(trim($value['start_flyy'])));
$date_start1=explode(".",htmlspecialchars(trim($date_start[0])));		
$startx=$date_start1[2].'-'.$date_start1[1].'-'.$date_start1[0].' '.$date_start[1].':00';		
						
$date_end=explode(" ",htmlspecialchars(trim($value['end_flyy'])));
$date_end1=explode(".",htmlspecialchars(trim($date_end[0])));		
$endx=$date_end1[2].'-'.$date_end1[1].'-'.$date_end1[0].' '.$date_end[1].':00';	

$cost_op=(int)trimc($value['operator_cost']);
$proc_bank=(int)trimc($value['proc_bank']);
$cost_cl=(int)trimc($value['client_cost']);
$disco=0;
$commission=$cost_cl-$cost_op-$proc_poteri;
$disco=$commission;
mysql_time_query($link,'update booking_offers set 
start_fly="'.htmlspecialchars($startx).'",
end_fly="'.htmlspecialchars($endx).'",
id_contract="'.$IDOC.'",
number_op="'.htmlspecialchars($value['operator_number']).'",
cost="'.htmlspecialchars(trim(trimc($value['client_cost']))).'",
cost_operator="'.htmlspecialchars(trim(trimc($value['operator_cost']))).'",
cost_operator_client="'.htmlspecialchars(trim(trimc($value['operator_client_cost']))).'",
exchange_rates="'.htmlspecialchars(trim(trimc($value['exchange_rates']))).'",
id_exchange="'.htmlspecialchars($value['exchange']).'",
commission="'.$commission.'"
where id_booking="'.htmlspecialchars(trim($_POST['id'])).'" and status="2" and id="'.htmlspecialchars(trim($value['id'])).'"');



//изменение статуса добавление в историю	      
if($value['options']==0)
{
//если полная оплата
	

	
//добавление в историю дат вылетов и отлетов туристов с отдыха
mysql_time_query($link,'INSERT INTO booking_offers_fly_history (id_offers,start_fly,end_fly,datetime,id_user) VALUES ("'.htmlspecialchars(trim($value['id'])).'","'.htmlspecialchars($startx).'","'.htmlspecialchars($endx).'","'.date("y.m.d").' '.date("H:i:s").'","'.$id_user.'")');
	
	
mysql_time_query($link,'INSERT INTO booking_status_history (id_booking,id_user,datetime,status,payment_method,proc_bank) VALUES ("'.htmlspecialchars($_POST['id']).'","'.$id_user.'","'.date("y.m.d").' '.date("H:i:s").'","3","'.htmlspecialchars(trim($value['client_payment_method'])).'","'.$proc_poteri.'")');
//изменение статуса добавление в историю

//ПЕРЕСЧЕТ КОМИССИИ У ПОЛЬЗОВАТЕЛя ЗА ТЕКУЩИЙ МЕСЯЦ
$date_start=date("Y-m-").'01 00:00:00';
$date_end=date_step_sql('Y-m','+1m').'-01 00:00:00';

$month_s=$date_start=date("Y-m-").'01';

	  $commission=0;
	  
	  			  	   $result_status21=mysql_time_query($link,'SELECT sum(a.commission) as comm FROM booking_offers AS a,booking_status_history as b,booking as c WHERE c.id=a.id_booking and a.id_booking=b.id_booking and a.status=2 and c.visible=1 and b.status=3 and c.id_user="'.$id_user.'" and b.datetime>="'.$date_start.'" and b.datetime<"'.$date_end.'"');	
		
       if($result_status21->num_rows!=0)
       {  
           $row_status21 = mysqli_fetch_assoc($result_status21);		   
		   //есть ли запись с такой коммиссией по этому пользователю за данный месяц
		    $result_status22=mysql_time_query($link,'SELECT a.id from users_commission as a where a.id_users="'.$id_user.'" and a.date="'.$month_s.'"');	
		
           if($result_status22->num_rows!=0)
           { 
			   mysql_time_query($link,'update users_commission set sum="'.$row_status21["comm"].'" where id_users="'.$id_user.'" and date="'.$month_s.'"');

		   } else
		   {
			   mysql_time_query($link,'INSERT INTO users_commission (id_users,date,sum) VALUES ("'.$id_user.'","'.$month_s.'","'.$row_status21["comm"].'")');
		   }
		   
		   
	   } 

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


/*
       $works=$_POST['offers'];	
$disco=0;
       foreach ($works as $key => $value) 
	   {
			$cost_op=(int)trimc($value['operator_cost']);
			$cost_cl=(int)trimc($value['client_cost']);
		   $number_op=trimc($value['operator_number']);
		   
		   $commission=$cost_cl-$cost_op;
		   $disco=$disco+$commission;
		    mysql_time_query($link,'update booking_offers set cost="'.htmlspecialchars($cost_cl).'",cost_operator="'.htmlspecialchars($cost_op).'",commission="'.$commission.'",number_op="'.htmlspecialchars($number_op).'" where id = "'.htmlspecialchars($value['id']).'"');
		   
	   }
*/



			      //добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде	
				  $user_send= array();	
				  $user_send_new= array();		

                  $user_send_new=array_merge($hie->boss['4']);

   //создателя договора	
		$text_not='<a href="booking/'.$_POST['id'].'/">Заявка №'.$_POST['id'].'</a> была отмечена как забронированная. Прибыль составила '.rtrim(rtrim(number_format($disco, 2, '.', ' '),'0'),'.').' рублей';
        $user_send_new= array_unique($user_send_new);	
		notification_send($text_not,$user_send_new,$id_user,$link);
			 
    //добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде	
}

end_code:

$aRes = array("debug"=>$debug,"status" => $status_ee,"status_echo"   => $status_echo,"count" => $dom,"for_id"=>$id,"echo"=>$echo,"options"=>$value['options']);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>