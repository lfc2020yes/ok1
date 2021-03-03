<?php
//получить данные по вкладке клиента
$name_form='003U';
$key_form='bt_task_info';

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
$id_tabs=htmlspecialchars($_GET['id_tabs']);
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
if ((!$role->permission('Задачи','R'))and($sign_admin!=1))
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
			



	
	//определяем кто может видеть и какие вкладки	   
	$tabs_menu_x_visible = array("1","1","0","0","0","0","0");
		   
    //определяем может ли он выполнить эту задачу
    //определяем может ли он выполнить эту задачу
    //определяем может ли он выполнить эту задачу
		   
	//он в исполнителях
	//он руководитель какого то исполнителя этой задачи
	//задача еще не выполнена и не закрыта
	//администратор может все
$mas_responsible=explode(",",$row_8["id_user_responsible"]);
		   if($row_8["status"]==0)
		   {
if(($sign_admin!=1))
{
if (in_array($id_user, $mas_responsible)) 
{
	$tabs_menu_x_visible[2]="1";
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
		$tabs_menu_x_visible[2]="1";
	}		
			
}		   
}  else
{
	$tabs_menu_x_visible[2]="1";
}
			   
}

    //определяем может ли он выполнить эту задачу
    //определяем может ли он выполнить эту задачу
    //определяем может ли он выполнить эту задачу
		   
		   
    //определяем может ли он передать эту задачу
    //определяем может ли он передать эту задачу
    //определяем может ли он передать эту задачу	
		   
	//задача не выполнена и не закрыта
	//ты создатель этой задачи или исполнитель или выше по рангу и управляешь кем то из них
	//админ может все
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
		   
	
	//определяем может ли он отложить эту задачу	   
	//определяем может ли он отложить эту задачу
	//определяем может ли он отложить эту задачу

	   if(($row_8["status"]==0)and($row_8["id_user"]!=0))
		   {
if(($sign_admin!=1))
{
	
if($row_8["id_user"]==$id_user)
{
	$tabs_menu_x_visible[4]="1";
}	
	
if (in_array($id_user, $mas_responsible)) 
{
	$tabs_menu_x_visible[4]="1";
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
		$tabs_menu_x_visible[4]="1";
	}		
			
}		   
}  else
{
	$tabs_menu_x_visible[4]="1";
}
			   
}		   

	//определяем может ли он отложить эту задачу	   
	//определяем может ли он отложить эту задачу
	//определяем может ли он отложить эту задачу		   

	//определяем может ли он Закрыть эту задачу	   
	//определяем может ли он Закрыть эту задачу
	//определяем может ли он Закрыть эту задачу	   
    //все кто ее должен выполнить и вышестоящие
		   
if($row_8["status"]==0)
{
	if(($sign_admin!=1))
{
		
if($row_8["id_user"]==$id_user)
{
	$tabs_menu_x_visible[5]="1";
}
		
if (in_array($id_user, $mas_responsible)) 
{
	$tabs_menu_x_visible[5]="1";
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
		$tabs_menu_x_visible[5]="1";
	}		
			
}	
	} else
	{
	$tabs_menu_x_visible[5]="1";
}	
}		   
		   
	//определяем может ли он Закрыть эту задачу	   
	//определяем может ли он Закрыть эту задачу
	//определяем может ли он Закрыть эту задачу		




//**************************************************
//**************************************************
//**************************************************
//**************************************************
/*
0 - о задаче
1 - Журнал событий
*/

$status_ee='ok';

// о туристе
if($id_tabs==0)
{
include $url_system.'task/code/tabs_about.php'; 
}
// заявки
if($id_tabs==1)
{
include $url_system.'task/code/tabs_journal.php'; 
}	

// выполнить
if(($id_tabs==3)and($tabs_menu_x_visible[2]==1))
{
include $url_system.'task/code/tabs_yes.php'; 
}
// передать
if(($id_tabs==4)and($tabs_menu_x_visible[3]==1))
{
include $url_system.'task/code/tabs_send.php'; 	
}
// отложить
if(($id_tabs==5)and($tabs_menu_x_visible[4]==1))
{
include $url_system.'task/code/tabs_new_date.php'; 	
}

// закрыть
if(($id_tabs==6)and($tabs_menu_x_visible[5]==1))
{
include $url_system.'task/code/tabs_close.php'; 	
}

end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo"   => $status_echo,"query" => $query_string,"echo"=>$echo);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>