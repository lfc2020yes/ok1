<?php
//передать задачу кому то
$name_form='003U';
$key_form='bt_task_info';

$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';
header("Content-type: application/json");
$query_string_xx='';
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
$query_string='';
$dom=0;
$status_echo='';
//проверка что есть такой город что это число
//проверка что пользователь зарегистрирован

$echo_r=1; //выводить или нет ошибку 0 -нет
$debug='';

//**************************************************
	
if(!token_access_new($token,$key_form,$id,"form".$name_form))
{
   $debug=h4a(100,$echo_r,$debug);
   goto end_code;
}	
//**************************************************
if ((!$role->permission('Задачи','U'))and($sign_admin!=1))
{
	  $debug=h4a(12,$echo_r,$debug);
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


if((!isset($_SESSION["user_id"]))or(!is_numeric(id_key_crypt_encrypt($_SESSION["user_id"]))))
{	
	$debug=h4a(63,$echo_r,$debug);
	goto end_code;
}

$id_user=id_key_crypt_encrypt($_SESSION["user_id"]);

//проверить есть ли переменная id и можно ли этому пользователю это делать
if ((count($_POST) != 3))
{
	$debug=h4a(61,$echo_r,$debug);
	goto end_code;	
}	
	



$result_t=mysql_time_query($link,'Select b.* from task_new as b where b.id="'.ht($_POST['id']).'" and b.visible=1');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{	
		$debug=h4a(5,$echo_r,$debug);
		goto end_code;
	
} else
{
	$row_8 = mysqli_fetch_assoc($result_t);
	$mas_responsible=explode(",",$row_8["id_user_responsible"]);
}


if($_POST['task']['komy']==$row_8["id_user_responsible"])
{
		$debug=h4a(58,$echo_r,$debug);
		goto end_code;
}
if(!is_numeric($_POST['task']['komy']))
{
		$debug=h4a(58,$echo_r,$debug);
		goto end_code;	
}


$mass_ei4=all_manager($id_company,$link);
	    if (!in_array($_POST['task']['komy'], $mass_ei4)) { 
		
		      $debug=h4a(887,$echo_r,$debug);
              goto end_code;
		}


$tabs_menu_x_visible[3]=0;
    //определяем может ли он передать эту задачу
    //определяем может ли он передать эту задачу
    //определяем может ли он передать эту задачу	
		   
	//задача не выполнена и не закрыта
	//ты создатель этой задачи или исполнитель или выше по рангу и управляешь кем то из них
	//админ может все
	//Нельзя передавать общие задачи	   
if(($row_8["status"]==0)and(count($mas_responsible)==1))
{
	if(($sign_admin!=1))
{
		
if($row_8["id_user"]==$id_user)
{
	$tabs_menu_x_visible[3]="1";
}
		
if (in_array($id_user, $mas_responsible)) 
{
	$tabs_menu_x_visible[3]="1";
} else
{
	//может он управляющий кого то кто должен выполнить эту задачу тогда ему тоже можно ее выполнить
	 $subo_x = array();
	foreach ($mas_responsible as $key => $value) 
    {
	   $subo_x = array_merge($subo_x, all_chief($value,$link));	   
		
	}
	$subo_x= array_unique($subo_x);
	
	
	if ((in_array($id_user, $subo_x))) 
    {
		$tabs_menu_x_visible[3]="1";
	}		
			
}	
	} else
	{
	$tabs_menu_x_visible[3]="1";
}	
}
	
    //определяем может ли он передать эту задачу
    //определяем может ли он передать эту задачу
    //определяем может ли он передать эту задачу	
if($tabs_menu_x_visible[3]!="1")
{
		$debug=h4a(6,$echo_r,$debug);
		goto end_code;	
}
  
	  

//**************************************************
//**************************************************
//**************************************************
//**************************************************

$status_ee='ok';


mysql_time_query($link,'update task_new set id_user_responsible="'.ht($_POST['task']['komy']).'" where id = "'.ht($_POST['id']).'"');

//задача изменилась изменить key с кем она связана
//заносим историю изменения задачи
	AddHistoryTask('1',$id_user,$row_8['id'],ht($_POST['task']["comment_end"]),'','','','','','',$link,'комментарий к действию передать задачу');

AddHistoryTask('4',$id_user,$_POST['id'],'','','',ht($row_8["id_user_responsible"]),'','',ht($_POST['task']['komy']),$link,'');
    
$mas_responsible=explode(",",$row_8["id_user_responsible"]);	   
	foreach ($mas_responsible as $key => $value) 
    { 
	  UpdateTaskKey($value,$link);
	}	
//обновить кому теперь нужно выполнить задачу
UpdateTaskKey(ht($_POST['task']['komy']),$link);


//уведомления всем кто должен был выполнить кроме того кто удалил
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
	$new_ispol='';
if($_POST['task']['komy']==$id_user)
{
	$new_ispol='Вы';
} else
{
	$result_txs1=mysql_time_query($link,'Select a.name_user,a.timelast,a.id from r_user as a where a.id="'.ht($_POST['task']['komy']).'"');
	            if($result_txs1->num_rows!=0)
	            {   
		          $rowxs1 = mysqli_fetch_assoc($result_txs1);
				  $new_ispol=$rowxs1["name_user"];
				}	
}
	
	

$text_not=$rowxs["name_user"].' передал(а) <span class="js-taa a-noti-link" id_task="'.$row_8["id"].'">задачу №'.$row_8["id"].'</span> - '.$row_8["comment"].'. Причина передачи - '.ht($_POST['task']["comment_end"]).'. Новый исполнитель - '.$new_ispol;
notification_send($text_not,$user_send_new,$id_user,$link);	 
//добавляем уведомления 
//добавляем уведомления 
//добавляем уведомления 
	
	
	
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
	

$text_not=$rowxs["name_user"].' передал(а) вам задачу №'.$row_8["id"].' - '.$row_8["comment"];
notification_send($text_not,$user_send_new,$id_user,$link);	 
//добавляем уведомления 
//добавляем уведомления 
//добавляем уведомления 
		
	
	
}


	
end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"echo"=>$query_string_xx);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>