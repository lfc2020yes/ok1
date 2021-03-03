<?php
$name_form='003U';
$key_form='bt_task_info';

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

$echo_r=0; //выводить или нет ошибку 0 -нет
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
	goto end_code;
}

$id_user=id_key_crypt_encrypt($_SESSION["user_id"]);

//проверить есть ли переменная id и можно ли этому пользователю это делать
if ((count($_GET) != 4))
{
	goto end_code;	
}	
	



$result_t=mysql_time_query($link,'Select b.* from task_new as b where b.id="'.htmlspecialchars(trim($_GET['id'])).'" and b.visible=1');
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


//может ли он смотреть эту задачу
//он ее поставил
//он в исполнителях
//он является командует тем кто есть в создателях или исполнителях

$mas_responsible=explode(",",$row_8["id_user_responsible"]);

foreach ($mas_responsible as $key => $value) 
{
   $mas_responsible = array_merge($mas_responsible, all_chief($value,$link));	   		
}
$mas_responsible = array_merge($mas_responsible, all_chief($row_8["id_user"],$link));

array_push($mas_responsible,$row_8["id_user"]); 

	$mas_responsible= array_unique($mas_responsible);
//print_r($mas_responsible);	
	
	if ((!in_array($id_user, $mas_responsible))and($sign_admin!=1)) 
    {
		$debug=h4a(789,$echo_r,$debug);
        goto end_code;	
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


mysql_time_query($link,'INSERT INTO task_status_history_new (id_task,action_history,id_user,datetimes,edit,comment,comment_sys) VALUES ("'.ht($_GET['id']).'","1","'.ht($id_user).'","'.date("y.m.d").' '.date("H:i:s").'","1","'.ht($_GET['text']).'","")');


$ID_N=mysqli_insert_id($link);  



$result_8 = mysql_time_query($link,'SELECT A.*  FROM task_status_history_new AS A WHERE  A.id="'.$ID_N.'"');


$num_8 = $result_8->num_rows;	
if($num_8!=0)
{	

  			  $row_8 = mysqli_fetch_assoc($result_8);

				 					 

						 
					  $query_string_xx='<div rel_notib="'.$row_8["id"].'" class="comm-task-block new-say">';

	

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
				  	   

	  
			   
//только для своих комментариев

$query_string_xx.='<div class="edit-menu-2019 com-task-edit-block"><i class="em1 js-com-task-edit" data-tooltip="Изменить"></i><i class="em2 js-com-task-del" data-tooltip="Удалить"></i></div>';				  
	


$query_string_xx.='</div>';
//$query_string_xx.='</div>';
				  
		  
				  
								  
					 
				  
				  
				  
				  
			  
	

	
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