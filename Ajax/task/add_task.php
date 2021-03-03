<?php
//добавить новую задачу
$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';
header("Content-type: application/json");


if(empty($_POST['task']['id_client'])) {  $_POST['task']['id_client']=0; }
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
if(!token_access_new($token,'bt_task_add',$id,"s_form"))
{
   $debug=h4a(100,$echo_r,$debug);
   goto end_code;
}
	
	
	//echo(count($_POST));
if ( count($_POST) != 3 ) 
{
   $debug=h4a(1,$echo_r,$debug);
   goto end_code;	
}

//**************************************************
 if ((!$role->permission('Задачи','A'))and($sign_admin!=1))
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


if ((isset($_POST['task']["client_type"]))and(is_numeric($_POST['task']["id_client"]))and(($_POST['task']["client_type"]=='1')or($_POST['task']["client_type"]=='2')or($_POST['task']["client_type"]=='3')or($_POST['task']["client_type"]=='10'))and($sign_admin!=1))
{
  //проверяем мог ли он привязать эту задачу к данному клиенту
  //если относится к той же компани что и пользователь добавл. задачу

		switch($_POST['task']["client_type"])
              {
		 case "1":{ 
			 //частное лицо
			 $sql_tt='Select b.id from k_clients as b where b.id="'.ht($_POST['task']['id_client']).'" and b.potential=0 and b.visible=1 and b.id_a_company="'.ht($id_company).'"';
			 break; 
                  }	
		case "2":{ 
			 //организация
			 $sql_tt='Select b.id from k_organization as b where b.id="'.ht($_POST['task']['id_client']).'" and  b.visible=1 and b.id_a_company="'.ht($id_company).'"';
			 break; 
                  }		
		 case "3":{ 
			 //потенциальный
			 $sql_tt='Select b.id from k_clients as b where b.id="'.ht($_POST['task']['id_client']).'" and b.potential=1 and b.visible=1 and b.id_a_company="'.ht($id_company).'"';
			 break; 
                  }
            case "10":{
                //обращение
                $sql_tt='Select b.id from preorders as b where b.id="'.ht($_POST['task']['id_client']).'" and b.id_user="'.$id_user.'" and b.visible=1 and b.id_company="'.ht($id_company).'"';
                break;
            }
        }
	
  $result_t=mysql_time_query($link,$sql_tt);
	
	
	
           $num_results_t = $result_t->num_rows;
	       if($num_results_t==0)
	       {	
			      $debug=h4a(86,$echo_r,$debug);
                  goto end_code;
		   }
	
}

//проверить может ли эту задачу дать этому пользователю
if(($sign_admin!=1)and($_POST['task']['komy']!= $id_user))
{
	if($_POST['task']['komy']=="all_subor")
	{
		if(($sign_level!=2)and($sign_level!=3))
		{
			 $debug=h4a(88,$echo_r,$debug);
                  goto end_code;
		}
	}
	if(is_numeric($_POST['task']['komy']))
	{
		$mass_ei=users_hierarchy($id_user,$link);
	    if (!in_array($_POST['task']['komy'], $mass_ei)) { 
		
		      $debug=h4a(87,$echo_r,$debug);
              goto end_code;
		}
	}
} 
	if(($_POST['task']['komy']=="all")and($sign_admin!=1))
	{
		      $debug=h4a(89,$echo_r,$debug);
              goto end_code;
	}


	if(($_POST['task']['type_task']!=1)and($_POST['task']['type_task']!=2))
	{
		      $debug=h4a(91,$echo_r,$debug);
              goto end_code;
	}

//**************************************************
//**************************************************
//**************************************************
//**************************************************


$status_ee='ok';

//новая задача



			 $today[0] = date("y.m.d"); //присвоено 03.12.01
             $today[1] = date("H:i:s"); //присвоит 1 элементу массива 17:16:17

	         $date_=$today[0].' '.$today[1];

$action_mass= array("11", "12", "13", "14","20");
$action_mass_vall= array("1", "3", "2", "","10");
$action='14';
if(is_numeric($_POST['task']['client_type']))
{
$action=$action_mass[array_search($_POST['task']['client_type'], $action_mass_vall)];
}

$id_company_flag=0; //по умолчанию задача не для компании
if((($_POST['task']['komy']=="all")or($_POST['task']['komy']=="all_subor")))
{

	$mass_ei = array();
	if(($_POST['task']['komy']=="all_subor"))
	{
	  //найдем всех менеждеров в подчинении
	  $mass_ei=users_hierarchy($id_user,$link);
	  rm_from_array($id_user,$mass_ei);
	  $mass_ei= array_unique($mass_ei);
	}
	if(($_POST['task']['komy']=="all"))
	{
	  //найдем всех менеждеров и главных менеджеров компании
	  $mass_ei=all_manager($id_company,$link);
	  rm_from_array($id_user,$mass_ei);
	  $mass_ei= array_unique($mass_ei);
	}	
	
	
	if($_POST['task']['type_task']=='1')
	{
		//общая задача для нескольких
		$id_user_responsible=implode(',', $mass_ei);

mysql_time_query($link,'INSERT INTO task_new (id_a_company,id_user,id_user_responsible,ring_datetime,comment,date_create,visible,status,click,action,id_object) VALUES ("'.$id_company.'","'.$id_user.'","'.ht($id_user_responsible).'","'.ht($_POST['task']['date']).' '.ht($_POST['task']['time']).':00","'.ht($_POST['task']['comment']).'","'.date("y.m.d").' '.date("H:i:s").'","1","0","1","'.$action.'","'.ht($_POST['task']['id_client']).'")');
		
	$ID_N=mysqli_insert_id($link);
		array_push($new,$ID_N); 
	//добавление истории по задаче
AddHistoryTask('7',$id_user,$ID_N,'','','','','','','',$link,'');

		   
	foreach ($mass_ei as $key => $value) 
    { 
	  UpdateTaskKey($value,$link);
	}	
		
		
 
			if($sign_admin!=1)
{
//добавляем уведомления 
//добавляем уведомления 
//добавляем уведомления 	
$user_send= array();	
$user_send_new= array();		

//$user_send_new=array_merge($hie->boss['4']);
//те кому была дана задача если она общая+ тот кто давал задачу - тот кто ее сейчас выполнил	
$user_send_new=explode(",",$id_user_responsible);	
	
	rm_from_array(0,$user_send_new);
	rm_from_array($id_user,$user_send_new);
	$user_send_new= array_unique($user_send_new);
	
	$result_txs=mysql_time_query($link,'Select a.name_user,a.timelast,a.id from r_user as a where a.id="'.$id_user.'"');
	            if($result_txs->num_rows!=0)
	            {   
		          $rowxs = mysqli_fetch_assoc($result_txs);
				
				}

$text_not='Вам поступила новая общая <span class="js-taa a-noti-link" id_task="'.$ID_N.'">задача №'.$ID_N.'</span> от '.$rowxs["name_user"].'. Цель задачи - '.ht($_POST['task']['comment']);
notification_send($text_not,$user_send_new,$id_user,$link);	 
//добавляем уведомления 
//добавляем уведомления 
//добавляем уведомления 
	
}			
		
		
		
	} else
	{
		//всем по задаче
		
		foreach ( $mass_ei as $value ) {
 
	mysql_time_query($link,'INSERT INTO task_new (id_a_company,id_user,id_user_responsible,ring_datetime,comment,date_create,visible,status,click,action,id_object) VALUES ("'.$id_company.'","'.$id_user.'","'.ht($value).'","'.ht($_POST['task']['date']).' '.ht($_POST['task']['time']).':00","'.ht($_POST['task']['comment']).'","'.date("y.m.d").' '.date("H:i:s").'","1","0","1","'.$action.'","'.ht($_POST['task']['id_client']).'")');
	$ID_N=mysqli_insert_id($link);	
	array_push($new,$ID_N);
	//добавление истории по задаче
AddHistoryTask('7',$id_user,$ID_N,'','','','','','','',$link,'');		
UpdateTaskKey($value,$link);		
	
		if($sign_admin!=1)
{
//добавляем уведомления 
//добавляем уведомления 
//добавляем уведомления 	
$user_send= array();	
$user_send_new= array();		

//$user_send_new=array_merge($hie->boss['4']);
//те кому была дана задача если она общая+ тот кто давал задачу - тот кто ее сейчас выполнил	
	
array_push($user_send_new,ht($value)); 
	
	rm_from_array(0,$user_send_new);
	rm_from_array($id_user,$user_send_new);
	$user_send_new= array_unique($user_send_new);
	
	$result_txs=mysql_time_query($link,'Select a.name_user,a.timelast,a.id from r_user as a where a.id="'.$id_user.'"');
	            if($result_txs->num_rows!=0)
	            {   
		          $rowxs = mysqli_fetch_assoc($result_txs);
				
				}

$text_not='Вам поступила новая <span class="js-taa a-noti-link" id_task="'.$ID_N.'">задача №'.$ID_N.'</span> от '.$rowxs["name_user"].'. Цель задачи - '.ht($_POST['task']['comment']);
notification_send($text_not,$user_send_new,$id_user,$link);	 
//добавляем уведомления 
//добавляем уведомления 
//добавляем уведомления 
	
}		
			
			
        }
		
		
	}
	
} else
{
//задача конкретно кому то

mysql_time_query($link,'INSERT INTO task_new (id_a_company,id_user,id_user_responsible,ring_datetime,comment,date_create,visible,status,click,action,id_object) VALUES ("'.$id_company.'","'.$id_user.'","'.ht($_POST['task']['komy']).'","'.ht($_POST['task']['date']).' '.ht($_POST['task']['time']).':00","'.ht($_POST['task']['comment']).'","'.date("y.m.d").' '.date("H:i:s").'","1","0","1","'.$action.'","'.ht($_POST['task']['id_client']).'")');
$ID_N=mysqli_insert_id($link);
	array_push($new,$ID_N); 
//добавление истории по задаче
AddHistoryTask('7',$id_user,$ID_N,'','','','','','','',$link,'');	
UpdateTaskKey($_POST['task']['komy'],$link);	
	
if($sign_admin!=1)
{
//добавляем уведомления 
//добавляем уведомления 
//добавляем уведомления 	
$user_send= array();	
$user_send_new= array();		

//$user_send_new=array_merge($hie->boss['4']);
//те кому была дана задача если она общая+ тот кто давал задачу - тот кто ее сейчас выполнил	
	
array_push($user_send_new,$_POST['task']['komy']); 
	
	rm_from_array(0,$user_send_new);
	rm_from_array($id_user,$user_send_new);
	$user_send_new= array_unique($user_send_new);
	
	$result_txs=mysql_time_query($link,'Select a.name_user,a.timelast,a.id from r_user as a where a.id="'.$id_user.'"');
	            if($result_txs->num_rows!=0)
	            {   
		          $rowxs = mysqli_fetch_assoc($result_txs);
				
				}

$text_not='Вам поступила новая <span class="js-taa a-noti-link" id_task="'.$ID_N.'">задача №'.$ID_N.'</span> от '.$rowxs["name_user"].'. Цель задачи - '.ht($_POST['task']['comment']);
notification_send($text_not,$user_send_new,$id_user,$link);	 
//добавляем уведомления 
//добавляем уведомления 
//добавляем уведомления 
	
}	
	
	
}

$new1=implode(',', $new); // ?????? ??????: 1|2|3





$pre=0;
if($_POST['task']["client_type"]=='10')
{
    $pre=$_POST['task']["id_client"];

    //добавляем в историю по обращению это действие
    $comment='создана задача → '.ht($_POST['task']['comment']);
    $comment_sys='';
    mysql_time_query($link,'INSERT INTO preorders_status_history_new (id_preorder,action_history,id_user,datetimes,edit,comment,comment_sys) VALUES ("'.ht($_POST['task']["id_client"]).'","6",
		"'.ht($id_user).'",
		"'.date("Y-m-d").' '.date("H:i:s").'",
		"0",
		"'.ht($comment).'",
		"'.ht($comment_sys).'")');


}
end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo"   => $status_echo,"new" => $new1,"for_id"=>$id,"id" => htmlspecialchars($ID_N),"temp"=>$temp,"poten"=>($_POST['radio_potential'] ?? ''),"pre"=>$pre);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>