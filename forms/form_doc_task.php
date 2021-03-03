<?php
//форма информация о задаче
$name_form='003U';
$key_form='bt_task_info';

$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';


//создание секрет для формы
$secret=rand_string_string(4);
$_SESSION['form'.$name_form] = $secret;

$status=0;
$id=htmlspecialchars($_GET['id']);


   $class_bba='cost_bank1';

if((!isset($_SESSION["user_id"]))or(!is_numeric(id_key_crypt_encrypt($_SESSION["user_id"]))))
{	
	goto end_code;
}

$id_user=id_key_crypt_encrypt($_SESSION["user_id"]);

//проверить есть ли переменная id и можно ли этому пользователю это делать
if ((count($_GET) != 2)or(!isset($_GET["id"]))or((!is_numeric($_GET["id"])))) 
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
	$mas_responsible11=explode(",",$row_8["id_user_responsible"]);
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
			



if ((!$role->permission('Задачи','R'))and($sign_admin!=1))
{
    goto end_code;	
}

//составление секретного ключа формы
//составление секретного ключа формы
//соль для данного действия
$token=token_access_compile($_GET['id'],$key_form,$secret);
//составление секретного ключа формы
//составление секретного ключа формы
//составление секретного ключа формы



$status=1;
	   




echo'<div id="Modal-one" class="box-modal table-modal eddd1 history_window1 client_window form'.$name_form.'">';

?>
<div class="box-modal-pading">			    
<div class="top_modal">
	
	
	
  <div class="box-modal_close arcticmodal-close"></div>
  <? 
	$os_dd = array("в работе", "выполнена", "закрыта");
	
	if($row_8["reminder"]==0) {
        echo '<h1 class="h111" mor="' . $token . '" for="' . htmlspecialchars(trim($_GET['id'])) . '"><span>Задача №' . $_GET['id'] . '</span><span class="status-task-okko">' . $os_dd[$row_8["status"]] . '</span>';
    } else
    {
        echo '<h1 class="h111" mor="' . $token . '" for="' . htmlspecialchars(trim($_GET['id'])) . '"><span>Напоминание №' . $_GET['id'] . '</span>';
    }
	
	
	echo'</h1>'; ?>
  
  
  
</div>
<div class="center_modal">
<?
echo'<form id="vino_xd_cb" style=" padding:0; margin:0;" method="get" enctype="multipart/form-data">';
echo'<input type="hidden" value="'.htmlspecialchars(trim($_GET['id'])).'" name="id">';
echo'<input type="hidden" value="'.$token.'" name="tk">';		

	
$no_click_vis=1;
	
if(count($mas_responsible11)!=1)
{
   $row_8["flag"]=1;
} else
{
	$row_8["flag"]=0;
}
	
	
	$ring_o=0;
	echo'<div class="ring_block ring-block-line">';
include $url_system.'task/code/block_index.php';
	
	
	
echo($task_cloud_block);
	echo'</div>';

	$vipoll='';
$vipoll_flag=0;
	if($row_8["status"]==1)
	{
	   	$result_work_zz2=mysql_time_query($link,'SELECT A.action_history,A.id_user,A.datetimes FROM task_status_history_new AS A WHERE A.edit=0 AND A.id_task="'.$row_8["id"].'" ORDER BY datetimes DESC LIMIT 1');
	
        $num_results_work_zz2 = $result_work_zz2->num_rows;
	    if($num_results_work_zz2!=0)
	    {	
	$row_work_zz2 = mysqli_fetch_assoc($result_work_zz2);
			//echo($row_8["status"]);
			if($row_work_zz2["action_history"]==5)
			{
				$vipoll_flag=1;
				
		$result_work_zz1=mysql_time_query($link,'Select a.name_user from r_user as a where a.id="'.$row_work_zz2["id_user"].'"');
	 
        $num_results_work_zz1 = $result_work_zz1->num_rows;
	    if($num_results_work_zz1!=0)
	    {
			$row_work_zz1 = mysqli_fetch_assoc($result_work_zz1);
		}
//$D = explode(' ', $row_8["datetimes"]);

	$vipoll=$row_work_zz1["name_user"];	
	
	
		}
		}
	}
	
	//задача закрыта по причине неактуальности или невозможности ее решить
	if($row_8["status"]==2)
	{
	   	$result_work_zz2=mysql_time_query($link,'SELECT A.action_history,A.id_user,A.datetimes FROM task_status_history_new AS A WHERE A.edit=0 AND A.id_task="'.$row_8["id"].'" ORDER BY datetimes DESC LIMIT 1');
	
        $num_results_work_zz2 = $result_work_zz2->num_rows;
	    if($num_results_work_zz2!=0)
	    {	
	$row_work_zz2 = mysqli_fetch_assoc($result_work_zz2);
			//echo($row_8["status"]);
			if($row_work_zz2["action_history"]==8)
			{
				$vipoll_flag=2;
				
		$result_work_zz1=mysql_time_query($link,'Select a.name_user from r_user as a where a.id="'.$row_work_zz2["id_user"].'"');
	 
        $num_results_work_zz1 = $result_work_zz1->num_rows;
	    if($num_results_work_zz1!=0)
	    {
			$row_work_zz1 = mysqli_fetch_assoc($result_work_zz1);
		}
//$D = explode(' ', $row_8["datetimes"]);

	$vipoll=$row_work_zz1["name_user"];	
	
	
		}
		}			
	}
	
	
if(($vipoll_flag==1)or($vipoll_flag==2))
{
//найдем предпоследний комментарий который отражает нынешний статус	
$result_comm=mysql_time_query($link,'SELECT B.comment FROM  task_status_history_new AS B WHERE B.edit=1 AND B.id<(
SELECT A.id FROM task_status_history_new AS A WHERE A.edit=0 AND A.id_task="'.$row_8["id"].'" ORDER BY datetimes DESC LIMIT 1)
AND B.id_task="'.$row_8["id"].'" ORDER BY datetimes DESC LIMIT 1');
	$num_comm = $result_comm->num_rows;
	    if($num_comm!=0)
	    {
			$row_comm = mysqli_fetch_assoc($result_comm);
	//выводим комментарий по выполненной работе или по про причине закрытия задачи
	echo'<div class="task-itog task-status-'.$vipoll_flag.'">
		<div class="t-i-1"><i></i></div>
	    <div class="t-i-2"><span>Комментарий по выполнению/закрытию задачи</span>
		<div class="t-co">'.$row_comm["comment"].'</div>
		</div>
	</div>';
		}
}
	
	
	
//меню с нужными вкладками
	?>
<div class="menu_client_w" style="margin-bottom: 5px;
margin-top: 20px;">
   <div class="mm_w">
	   <ul class="tabs_hedi js-tabs-menu">
		  <?
          //$tabs_menu_x = array( "о задаче", "Журнал событий","Выполнить","Передать","Отложить","Закрыть");
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
if(($row_8["status"]==0)and($row_8["click"]==1))
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
	//Нельзя передавать общие задачи	   
if(($row_8["status"]==0)and(count($mas_responsible)==1)and($row_8["click"]==1))
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

	   if(($row_8["status"]==0)and($row_8["id_user"]!=0)and($row_8["click"]==1))
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
		   
if(($row_8["status"]==0)and($row_8["click"]==1))
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
		   
       $tabs_menu_x = array( "о задаче", "Журнал событий","Выполнить","Передать","Отложить","Закрыть");
		   
	   $tabs_menu_x_id = array("0","1","3","4","5","6");
	   	   
	    for ($i=0; $i<count($tabs_menu_x); $i++)
             {   
			if($tabs_menu_x_visible[$i]==1)
			{
				 if($_GET['tabs']==$tabs_menu_x_id[$i])
			     {
				    echo'<li class="tabs_'.$name_form.' active" id="'.$tabs_menu_x_id[$i].'">'.$tabs_menu_x[$i].'</li>';
			     } else
			     {
				    echo'<li class="tabs_'.$name_form.'" id="'.$tabs_menu_x_id[$i].'">'.$tabs_menu_x[$i].'</li>';
			     }
			}
			 }
?>

	   </ul>
   </div>
</div>	
<div class="px_bg" style="position: relative;">
<?
	
	
	
	
	
	
	
	
	
// о туристе
if($_GET['tabs']==0)
{
include $url_system.'task/code/tabs_about.php'; 
echo($query_string);	
}
// заявки
if($_GET['tabs']==1)
{
include $url_system.'task/code/tabs_comment.php'; 
echo($query_string);		
}	
	
// выполнить
if(($_GET['tabs']==3)and($tabs_menu_x_visible[2]==1))
{
include $url_system.'task/code/tabs_yes.php'; 
echo($query_string);		
}	

// передать
if(($_GET['tabs']==4)and($tabs_menu_x_visible[3]==1))
{
include $url_system.'task/code/tabs_send.php'; 
echo($query_string);		
}	
		
	
// отложить
if(($_GET['tabs']==5)and($tabs_menu_x_visible[4]==1))
{
include $url_system.'task/code/tabs_new_date.php'; 
echo($query_string);		
}	
	
// закрыть
if(($_GET['tabs']==6)and($tabs_menu_x_visible[5]==1))
{
include $url_system.'task/code/tabs_close.php'; 
echo($query_string);		
}		
	
?>	
</div>
<?

	
		  
?>
</form>
</div>		
<div class="bottom_modal">			
 <span class="clock_table"></span>
	<div class="js-tabs_docc js-tabs_0 tabs_11_2">
<?	
	
//изменить и удалить может только создатель этой задачи и если она создана не системой а работником
		
if(($row_8["id_user"]!=0)and($row_8["status"]!=1)and($row_8["status"]!=2))
{
  if ((($role->permission('Задачи','U'))and($row_8["id_user"]==$id_user))or($sign_admin==1))
  {
	
     echo'<div id="no_rdx_task" class="save_button edit_client_cb" id_rel="'.$_GET["id"].'"><i>Редактировать</i></div>';
	
  }

  if ((($role->permission('Задачи','D'))and($row_8["id_user"]==$id_user))or($sign_admin==1))
  {
	
   echo'<div id="" class="no_button del_client_cb js-dell-task" id_rel="'.$_GET["id"].'"><i>Удалить</i></div>';
	
  }
}
	
//}		
		
?>


		</div>
<?	
if($tabs_menu_x_visible[2]=="1")
{
	echo'<div class="js-tabs_docc js-tabs_3">
	
	<div id="no_rd66" class="js-exit-win no_button"><i>Отменить</i></div>   	
	
<div id="button_yes_task" class="save_button task_vsevse_cb"><i>Подтвердить</i></div>   
	
	</div>';
}
if($tabs_menu_x_visible[3]=="1")
{
	echo'<div class="js-tabs_docc js-tabs_4">
	
	<div id="no_rd66" class="js-exit-win no_button"><i>Отменить</i></div>   	
	
<div id="button_yes_task_send" class="save_button task_vsevse_cb"><i>Подтвердить</i></div>   
	
	</div>';
}	
if($tabs_menu_x_visible[4]=="1")
{
	echo'<div class="js-tabs_docc js-tabs_5">
	
	<div id="no_rd66" class="js-exit-win no_button"><i>Отменить</i></div>   	
	
<div id="button_yes_task_date" class="save_button task_vsevse_cb"><i>Подтвердить</i></div>   
	
	</div>';
}	
	
if($tabs_menu_x_visible[5]=="1")
{
	echo'<div class="js-tabs_docc js-tabs_6">
	
	<div id="no_rd66" class="js-exit-win no_button"><i>Отменить</i></div>   	
	
<div id="button_yes_task_close" class="save_button task_vsevse_cb_close"><i>Закрыть</i></div>   
	
	</div>';
}	
	
?>	
</div>              
</div></div>
		
<?



 

end_code:		   
		   
if($status==0)
{
	//что то не так. Почему то бронировать нельзя
	header("HTTP/1.1 404 Not Found");
	header("Status: 404 Not Found");    
	die ();	
}
/*

						 $datetime1 = date_create('Y-m-d');
                         $datetime2 = date_create('2017-01-17');
						 
                         $interval = date_create(date('Y-m-d'))->diff( $datetime2	);				 
                         $date_plus=$interval->days;
						 */
						 //echo(dateDiff_(date('Y-m-d'),'2017-01-17'));
						 


?>
<script type="text/javascript">initializeTimer();</script>
<?
include_once $url_system.'template/form_js.php';
?>

 <script type="text/javascript">
 $(document).ready(function(){ 
$('.money_mask1').inputmask("numeric", {
    radixPoint: ".",
    groupSeparator: " ",
    digits: 2,
    autoGroup: true,
    prefix: '', //No Space, this will truncate the first character
    rightAlign: false,
    oncleared: function () { self.Value(''); }
});
	 

var id_tt=$('.js-tabs-menu').find('.active').attr('id');
	 //alert(id_tt);
		$('.js-tabs_docc').hide();
		$('.js-tabs_'+id_tt).show();	 
	 ToolTip();
	
	 		$(".slct").unbind('click.sys');
		$(".slct").bind('click.sys', slctclick);
		$(".drop").find("li").unbind('click');
		$(".drop").find("li").bind('click', dropli);
	 $('#typesay').unbind('change', changesay);
	 $('#typesay').bind('change', changesay);
	 input_2018();
	 
	 		$('.date_picker_x').inputmask("datetime",{
    mask: "1.2.y", 
    placeholder: "dd.mm.yyyy",  
    separator: ".", 
    alias: "dd.mm.yyyy"
  });
		
	 
 });
	 </script>