<?php
//показать еще сообщения общения в клиенте
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
$token=htmlspecialchars($_GET['tk']);
$disco=0;
$id=htmlspecialchars($_GET['id']);
$query_string='';
$dom=0;
$status_echo='';
//проверка что есть такой город что это число
//проверка что пользователь зарегистрирован

$echo_r=1; //выводить или нет ошибку 0 -нет
$debug='';

//**************************************************
	//echo($_SESSION['s_form_two']);
if(!token_access_new($token,'bt_client_info',$id,"s_form_two"))
{
   $debug=h4a(100,$echo_r,$debug);
   goto end_code;
}	
//**************************************************
if ((!$role->permission('Клиенты','R'))and($sign_admin!=1))
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
	goto end_code;
}

$id_user=id_key_crypt_encrypt($_SESSION["user_id"]);

//проверить есть ли переменная id и можно ли этому пользователю это делать
if ((count($_GET) != 9))
{
	goto end_code;	
}	
	


$result_t=mysql_time_query($link,'Select b.id,b.id_client,id_user from k_clients_commun as b where b.id="'.htmlspecialchars(trim($_GET['id'])).'" and b.visible=1');
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
0 5
5 5
10 5
15 5	
*/
//**************************************************
//**************************************************
//**************************************************
//**************************************************

$status_ee='ok';


mysql_time_query($link,'update k_clients_commun set comment="'.ht($_GET['text']).'",id_type_commun="'.ht($_GET['type']).'" where id = "'.ht($_GET['id']).'"');


  $bila=0;
	//смотрим может такая задача уже была и это просто ее изменение
		$result_8 = mysql_time_query($link,'SELECT A.id,A.ring_datetime,A.comment,id_user_responsible FROM task_new AS A WHERE A.id_user="'.ht($id_user).'" and 
	A.id_a_company="'.ht($id_company).'" and 
	A.reminder=0 and
	A.click="1" and
	A.action="10" and
	A.status="0" and
	A.id_object="'.ht($_GET['id']).'"');
	
$num_8 = $result_8->num_rows;	
	if($num_8!=0)
	{
		//это изменение задачи по данным она уже была
		$row_bila = mysqli_fetch_assoc($result_8);
		$bila=1;
	}

//echo($bila);

//с подборкой сразу добавляется напоминание
if((ht($_GET['task'])=='1')and($bila==1))
{
	//echo("1");
//AddHistoryTask($action,$id_user,$id_task,$comment,$text,$date,$komy,$text_new,$date_new,$komy_new,$link,$comment_sys)	
	
   //это измненение подборки
   	mysql_time_query($link,'update task_new set ring_datetime="'.ht($_GET['date']).' '.ht($_GET['time']).':00",comment="'.ht($_GET['comment']).'" where id="'.$row_bila["id"].'"');	
	$ring_new=ht($_GET['date']).' '.ht($_GET['time']).':00';
	if($ring_new!=$row_bila["ring_datetime"])
	{
	//добавление истории по задаче
AddHistoryTask('3',$id_user,$row_bila["id"],'','',$row_bila["ring_datetime"],'','',$ring_new,'',$link,'отложена из редактирования общения с клиентом');
UpdateTaskKey($row_bila["id_user_responsible"],$link);			
	}
	if(ht($_GET['comment'])!=$row_bila["comment"])
	{
	//добавление истории по задаче
AddHistoryTask('2',$id_user,$row_bila["id"],'',$row_bila["comment"],'','',ht($_GET['comment']),'','',$link,'редактирование текста из общения с клиентом');
UpdateTaskKey($row_bila["id_user_responsible"],$link);		
	}	
	
    //удаляем старую задачу
	/*
	mysql_time_query($link,'update task_new set visible="0" where visible=1 and action=10 and status=0 and id_object="'.ht($_GET['id']).'" and id_user="'.ht($id_user).'"');

	
	mysql_time_query($link,'INSERT INTO task_new (id,id_a_company,id_user,id_user_responsible,ring_datetime,comment,date_create,visible,status,click,action,id_object) VALUES ("","'.$id_company.'","'.$id_user.'","'.$id_user.'","'.ht($_GET['date']).' '.ht($_GET['time']).':00","'.ht($_GET['comment']).'","'.date("y.m.d").' '.date("H:i:s").'","1","0","1","10","'.ht($_GET['id']).'")');
	*/
}

if((ht($_GET['task'])=='1')and($bila==0))
{
//добавление новой задачи
	//echo("2");
	
	mysql_time_query($link,'INSERT INTO task_new (id_a_company,id_user,id_user_responsible,ring_datetime,comment,date_create,visible,status,click,action,id_object) VALUES ("'.$id_company.'","'.$id_user.'","'.$id_user.'","'.ht($_GET['date']).' '.ht($_GET['time']).':00","'.ht($_GET['comment']).'","'.date("y.m.d").' '.date("H:i:s").'","1","0","1","10","'.ht($_GET['id']).'")');
	
	$ID_N=mysqli_insert_id($link);	
	//добавление истории по задаче
    AddHistoryTask('7',$id_user,$ID_N,'','','','','','','',$link,'');	
	UpdateTaskKey($id_user,$link);
}
if((ht($_GET['task'])=='0')and($bila==1))
{
	//echo("3");
	//была а сейчас удалили
	AddHistoryTask('6',$id_user,$row_bila["id"],'','','','','','','',$link,'Удалена из редактирования общения в клиенте');
	
	mysql_time_query($link,'update task_new set visible="0" where  id="'.$row_bila["id"].'"');
	UpdateTaskKey($row_bila["id_user_responsible"],$link);
}



$result_8 = mysql_time_query($link,'SELECT A.id,A.comment,B.var as ids, B.name, A.id_user, A.datetimes  FROM k_clients_commun AS A,k_clients_type_commun as B WHERE A.visible=1 and A.id_type_commun=B.id and A.id="'.ht($_GET['id']).'"');


$num_8 = $result_8->num_rows;	
if($num_8!=0)
{	

  			  $row_8 = mysqli_fetch_assoc($result_8);

				 					 

						 
					  $query_string_xx='<div rel_notib="'.$row_8["id"].'" class="say_cb say_say_cb new-say">';

	

$query_string_xx.='<div data-tooltip="'.$row_8["name"].'" class="number_cb say__'.$row_8["ids"].'"><div class="ic_cb"></div></div>';
$query_string_xx.='<div class="h_cb"><a><span>'.$row_8["comment"].'</span></a>';
			
$query_string_xx.='<div class="date_cb" >'.time_stamp($row_8["datetimes"]).'</div>';
				  
				  
	$result_status22=mysql_time_query($link,'SELECT b.name_user,b.name_small FROM r_user AS b WHERE b.id="'.htmlspecialchars(trim($row_8["id_user"])).'"');	
					 //echo('SELECT a.* FROM r_status AS a WHERE a.numer_status="'.$row1ss["status"].'" and a.id_system=13');
                if($result_status22->num_rows!=0)
                {  
                   $row_status22 = mysqli_fetch_assoc($result_status22);			  
$query_string_xx.='<div class="user_cb">'.$row_status22['name_small'].'</div>';
				}
				  
						  				  
$query_string_xx.='</div>';
				  	   

	
//смотрим есть ли нерешенная задача с этой подборкой.				  
	$result_status22task=mysql_time_query($link,'SELECT b.* FROM task_new AS b WHERE b.visible=1 and b.action=10 and b.status=0 and b.id_object="'.ht($row_8["id"]).'" and b.id_user="'.ht($row_8["id_user"]).'"');	

                if($result_status22task->num_rows!=0)
                {  			
					$row_status22task = mysqli_fetch_assoc($result_status22task);
$query_string_xx.='<div class="task_clock_selection"><div class="task_clock_selection1">
					    <div class="clock_cbb"><i></i></div>
					    <div class="why_task_cbb">
					  <span>'.$row_status22task["comment"].'</span>';
				$clkk='';	
			   if(dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_status22task["ring_datetime"])>=0)
			   {
				  $clkk='class="red__task"';   
			   }
					
		  

					
					  $query_string_xx.='<i '.$clkk.'>'.time_task_umatravel($row_status22task["ring_datetime"]).'</i>
					  </div>
					  </div></div>';
				}
				  
	//смотрим есть ли нерешенная задача с этой подборкой.					  
				  	   
			   
//только для своих общений

$query_string_xx.='<div class="edit-menu-2019"><i class="em1 js-say-edit" data-tooltip="Изменить"></i><i class="em2 js-say-del" data-tooltip="Удалить"></i></div>';				  
	


$query_string_xx.='</div>';
//$query_string_xx.='</div>';
				  
		  
				  
								  
					 
				  
				  
				  
				  
			  
	

	
}


	
end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"echo"=>$query_string_xx,"id_cl"=>$row_score["id_client"]);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>