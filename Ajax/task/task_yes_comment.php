<?php
//отметить задачу как выполненная
$name_form='003U';
$key_form='bt_task_info';

$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';
header("Content-type: application/json");
$new=0;
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
	
if((!token_access_new($token,'yes_click_task',$id,"s_form"))and (!token_access_new($token,$key_form,$id,"form".$name_form)))
{
   $debug=h4a(100,$echo_r,$debug);
   goto end_code;
}
	
if ((!$role->permission('Задачи','U'))and($sign_admin!=1))
{
  $debug=h4a(2,$echo_r,$debug);
  goto end_code;	
}
 if(!isset($_SESSION["user_id"]))
{ 
  $status_ee='reg';	
  $debug=h4a(3,$echo_r,$debug);
  goto end_code;
}
//**************************************************
//проверить есть ли переменная id и можно ли этому пользователю это делать
if ((count($_POST) != 11)or(!isset($_POST["id"]))or((!is_numeric($_POST["id"]))))
{
	$debug=h4a(311,$echo_r,$debug);
	goto end_code;	
}		

//**************************************************
$result_t=mysql_time_query($link,'Select b.* from task_new as b where b.id="'.htmlspecialchars(trim($_POST['id'])).'"');
           $num_results_t = $result_t->num_rows;
	       if($num_results_t!=0)
	       {	
			 
			 $row_8 = mysqli_fetch_assoc($result_t);
		   
if($row_8["status"]!=0)
	{
		$debug=h4a(8,$echo_r,$debug);
		goto end_code;		
	}
if($row_8["click"]!=1)
	{
		$debug=h4a(811,$echo_r,$debug);
		goto end_code;		
	}

$mas_responsible=explode(",",$row_8["id_user_responsible"]);
if (!in_array($id_user, $mas_responsible)) 
{
	//может он управляющий кого то кто должен выполнить эту задачу тогда ему тоже можно ее выполнить
	 $subo_x = array();
	foreach ($mas_responsible as $key => $value) 
    {
	   $subo_x = array_merge($subo_x, all_chief($value,$link));	   
		
	}
	//rm_from_array($id_user,$subo_x);
	$subo_x= array_unique($subo_x);
	
	
	if ((!in_array($id_user, $subo_x))and($sign_admin!=1)) 
    {
		$debug=h4a(789,$echo_r,$debug);
        goto end_code;	
	}		
			
}
			   
			   
		   } else
		   {
			      $debug=h4a(6,$echo_r,$debug);
   goto end_code;	
		   }





//**************************************************
//**************************************************
//**************************************************
//**************************************************


$status_ee='ok';


$action_client = array("6", "8", "5", "7", "9", "10", "11", "12","17");

if($row_8["action"]==17) {
    $yes_bb=0;
    $result_uuy = mysql_time_query($link, 'select A.id,A.shopper from trips as A where A.id="' . ht($row_8["id_object"]) . '"');
    $num_results_uuy = $result_uuy->num_rows;

    if ($num_results_uuy != 0) {
        $row_uuy = mysqli_fetch_assoc($result_uuy);
        $id_user_ring = $row_uuy["id_shopper"];


        if ($row_uuy["shopper"] == 1) {
            $yes_bb=1;
        }


    }
}

if ((in_array($row_8["action"], $action_client))and($yes_bb==1)) {
	//тогда смотрим есть say или нет
	if($_POST['say']==1)
	{
		
	//добавить в историю
	
	//изменить статус
	//обновить key
	//отправить уведомление
	
	mysql_time_query($link,'update task_new set status="1" where id = "'.$row_8['id'].'"');
	
	AddHistoryTask('1',$id_user,$row_8['id'],ht($_POST["comment_end"]),'','','','','','',$link,'комментарий к действию выполнена');
	AddHistoryTask('5',$id_user,$row_8['id'],'','','','','','','',$link,'Выполнена из панели уведомлений');
$id_user_ring=0;
			switch($row_8["action"])
              {
				case "5":{
			//улетают
			$name_book='-';
			$result_ss = mysql_time_query($link,'SELECT A.title,A.id_client,B.fio,A.id FROM booking as A,k_clients as B WHERE A.id_client=B.id and A.id="'.ht($row_8["id_object"]).'" and A.visible=1');
        $num_ss = $result_ss->num_rows;	
        if($result_ss)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);
		   $id_user_ring=$row_ss["id_client"];
		}
			

			 
			 break;
		 }			  
			case "6":{
			//прилетают
			
			$result_ss = mysql_time_query($link,'SELECT A.title,A.id_client,B.fio,A.id FROM booking as A,k_clients as B WHERE A.id_client=B.id and A.id="'.ht($row_8["id_object"]).'" and A.visible=1');
        $num_ss = $result_ss->num_rows;	
        if($result_ss)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);
		   $id_user_ring=$row_ss["id_client"];
		   $name_user_ring=$row_ss["fio"];
		}
			
				 
			 
			 
			 break;
		 }					  
						  
			case "7":{ 
   //день рождение
			 $result_ss = mysql_time_query($link,'SELECT A.fio,A.id FROM k_clients as A WHERE A.id="'.ht($row_8["id_object"]).'" and A.visible=1');
        $num_ss = $result_ss->num_rows;	
        if($result_ss)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);	
		   $id_user_ring=$row_ss["id"];
		   $name_user_ring=$row_ss["fio"];
		}
 
			 
			 
			 break;
		 }
				  
						  
		 case "9":{ 
			 //задача из подборок клиента
					$result_ss = mysql_time_query($link,'SELECT A.fio,A.id FROM k_clients as A,selection as B WHERE B.id="'.ht($row_8["id_object"]).'" and B.visible=1 and B.id_k_clients=A.id');
        $num_ss = $result_ss->num_rows;	
        if($result_ss)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);	
		   $id_user_ring=$row_ss["id"];
		   $name_user_ring=$row_ss["fio"];
		}
			 
			 
			 break; 
                  }
		 case "10":{ 
			 //задача из общения с клиентом
					$result_ss = mysql_time_query($link,'SELECT A.fio,A.id FROM k_clients as A,k_clients_commun as B WHERE B.id="'.ht($row_8["id_object"]).'" and B.visible=1 and B.id_client=A.id');
        $num_ss = $result_ss->num_rows;	
        if($result_ss)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);	
		   $id_user_ring=$row_ss["id"];
		   $name_user_ring=$row_ss["fio"];
		}
			 
			 
			 break; 
                  }	
		 case "11":{ 
			 //задача связанная просто с клиентом
					$result_ss = mysql_time_query($link,'SELECT A.fio,A.id FROM k_clients as A WHERE A.id="'.ht($row_8["id_object"]).'"');
        $num_ss = $result_ss->num_rows;	
        if($result_ss)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);	
		   $id_user_ring=$row_ss["id"];
		   $name_user_ring=$row_ss["fio"];
		}
			 
			 
			 break; 
                  }	
		 case "12":{ 
			 //задача связанная просто с клиентом
					$result_ss = mysql_time_query($link,'SELECT A.fio,A.id FROM k_clients as A WHERE A.id="'.ht($row_8["id_object"]).'"');
        $num_ss = $result_ss->num_rows;	
        if($result_ss)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);	
		   $id_user_ring=$row_ss["id"];
		   $name_user_ring=$row_ss["fio"];
		}
			 
			 
			 break; 
                  }

                case "17":{
                    //узнать впечатление по туру связь с клиентом
                    $result_ss = mysql_time_query($link,'SELECT A.fio,A.id FROM k_clients as A,trips as b WHERE b.id="'.ht($row_8["id_object"]).'" and b.id_shopper=a.id');
                    $num_ss = $result_ss->num_rows;
                    if($result_ss)
                    {
                        $row_ss = mysqli_fetch_assoc($result_ss);
                        $id_user_ring=$row_ss["id"];
                        $name_user_ring=$row_ss["fio"];
                    }


                    break;
                }

						  
			  }
		
	if($id_user_ring!=0)
	{
mysql_time_query($link,'INSERT INTO k_clients_commun (id_user,id_client,comment,datetimes,id_type_commun,visible,id_booking) VALUES ("'.$id_user.'","'.$id_user_ring.'","'.htmlspecialchars($_POST['text']).'","'.date("y.m.d").' '.date("H:i:s").'","'.htmlspecialchars($_POST['type']).'","1","0")');
$ID_N=mysqli_insert_id($link);  


//с подборкой сразу добавляется напоминание
if(ht($_POST['task'])==1)
{	
	
	mysql_time_query($link,'INSERT INTO task_new (id_a_group,id_user,id_user_responsible,ring_datetime,comment,date_create,visible,status,click,action,id_object) VALUES ("'.$id_group_u.'","'.$id_user.'","'.$id_user.'","'.ht($_POST['date']).' '.ht($_POST['time']).':00","'.ht($_POST['comment']).'","'.date("y.m.d").' '.date("H:i:s").'","1","0","1","10","'.$ID_N.'")');
	

$ID_N1=mysqli_insert_id($link);
	$new=$ID_N1;
	
//добавление истории по задаче
AddHistoryTask('7',$id_user,$ID_N1,'','','','','','','',$link,'');		
UpdateTaskKey($id_user,$link);		
	
}		
	}




	
    $mas_responsible=explode(",",$row_8["id_user_responsible"]);	   
	foreach ($mas_responsible as $key => $value) 
    { 
	  UpdateTaskKey($value,$link);
	}			
		
	} else
	{
		//общение с клиентом не добавляется
	//добавить в историю
	
	//изменить статус
	//обновить key
	//отправить уведомление
	
	mysql_time_query($link,'update task_new set status="1" where id = "'.$row_8['id'].'"');
	
	AddHistoryTask('1',$id_user,$row_8['id'],ht($_POST["comment_end"]),'','','','','','',$link,'комментарий к действию выполнена');
	AddHistoryTask('5',$id_user,$row_8['id'],'','','','','','','',$link,'Выполнена из панели уведомлений');
	
	
    $mas_responsible=explode(",",$row_8["id_user_responsible"]);	   
	foreach ($mas_responsible as $key => $value) 
    { 
	  UpdateTaskKey($value,$link);
	}			
	}
} else
{
	//к таким задачам не может идти запись в общение с клиентом
	
	//добавить в историю
	
	//изменить статус
	//обновить key
	//отправить уведомление
	
	mysql_time_query($link,'update task_new set status="1" where id = "'.$row_8['id'].'"');
	
	AddHistoryTask('1',$id_user,$row_8['id'],ht($_POST["comment_end"]),'','','','','','',$link,'комментарий к действию выполнена');
	AddHistoryTask('5',$id_user,$row_8['id'],'','','','','','','',$link,'Выполнена из панели уведомлений');
	
	
    $mas_responsible=explode(",",$row_8["id_user_responsible"]);	   
	foreach ($mas_responsible as $key => $value) 
    { 
	  UpdateTaskKey($value,$link);
	}	
}

//СМОТРИМ ЕСЛИ ЭТО УЗНАТЬ ВПЕЧАТЛЕНИЕ ПО ТУРУ ТО КОММЕНТАРИЙ ДОБАВЛЯЕМ В ТУР СРАЗУ
if($row_8["action"]==17)
{
    mysql_time_query($link, 'update trips set
    
    comment="'.ht($_POST["comment_end"]).'"
    
    where id = "' . ht($row_8['id_object']) . '"');

    $text_history='Добавлено впечатление по туру → '.$_POST["comment_end"];
    mysql_time_query($link,'INSERT INTO trips_status_history_new (id_trips,action_history,id_user,datetimes,edit,comment,comment_sys) VALUES ("'.ht($row_8['id_object']).'","25","'.ht($id_user).'","'.date("y.m.d").' '.date("H:i:s").'","0","'.ht($text_history).'","")');


//уведомление
//уведомление
//уведомление


    $result_uuoo = mysql_time_query($link, 'select id_user from trips where id="' . ht($row_8['id_object']) . '"');
    $num_results_uuoo = $result_uuoo->num_rows;

    if ($num_results_uuoo != 0) {
        $row_uuoo = mysqli_fetch_assoc($result_uuoo);
    }

    $text_not = 'Добавлено новое впечатление по <a href="/tours/.id-' . ht($row_8['id_object']) . '">Туру №' . ht($row_8['id_object']) . '</a>: «'.ht($_POST["comment_end"]).'»';

    $user_send_new= array();
    $user_send_new=array_merge(UserNotNumber(12,$link));

    rm_from_array(0,$user_send_new);
    rm_from_array($id_user,$user_send_new);
    $user_send_new= array_unique($user_send_new);


    $mass_ei = all_chief($row_uuoo["id_user"], $link);
    rm_from_array($id_user, $mass_ei);
    $mass_ei = array_unique($mass_ei);

    $end_mass=exception_role($user_send_new,$mass_ei);



    notification_send( $text_not,$end_mass,$id_user,$link);


}

$user_send= array();	
$user_send_new= array();	


if($sign_admin!=1)
{
//добавляем уведомления 
//добавляем уведомления 
//добавляем уведомления 	
$user_send= array();	
$user_send_new= array();		

//$user_send_new=array_merge($hie->boss['4']);
//те кому была дана задача если она общая+ тот кто давал задачу - тот кто ее сейчас выполнил	
	
$user_send_new=explode(",",$row_8["id_user_responsible"]);
array_push($user_send_new,$row_8["id_user"]); 
	
	rm_from_array(0,$user_send_new);
	rm_from_array($id_user,$user_send_new);
	$user_send_new= array_unique($user_send_new);
	
	$result_txs=mysql_time_query($link,'Select a.name_user,a.timelast,a.id from r_user as a where a.id="'.$id_user.'"');
	            if($result_txs->num_rows!=0)
	            {   
		          $rowxs = mysqli_fetch_assoc($result_txs);
				
				}

$text_not=$rowxs["name_user"].' выполнил(a) <span class="js-taa a-noti-link" id_task="'.$row_8["id"].'">задачу №'.$row_8["id"].'</span> - '.$row_8["comment"];
notification_send($text_not,$user_send_new,$id_user,$link);	 
//добавляем уведомления 
//добавляем уведомления 
//добавляем уведомления 
	
}

end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo"   => $status_echo,"new" => $new,"echo"=>$echo);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>