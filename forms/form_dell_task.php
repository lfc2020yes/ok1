<?php
//

$name_form='006U';
$key_form='bt_task_dell_cocc';

$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';


//создание секрет для формы
$secret=rand_string_string(4);
$_SESSION['form'.$name_form] = $secret;

$status=0;


if((!isset($_SESSION["user_id"]))or(!is_numeric(id_key_crypt_encrypt($_SESSION["user_id"]))))
{	
	goto end_code;
}

$id_user=id_key_crypt_encrypt($_SESSION["user_id"]);

//проверить есть ли переменная id и можно ли этому пользователю это делать
if ((count($_GET) != 1)or(!isset($_GET["id"]))or((!is_numeric($_GET["id"])))) 
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
}

//
if(($row_8["id_user"]==0)or($row_8["status"]==1))
{
		$debug=h4a(6,$echo_r,$debug);
		goto end_code;	
}


if ((($role->permission('Задачи','D'))and($row_8["id_user"]==$id_user))or($sign_admin==1))
{
	
} else
{
		$debug=h4a(7,$echo_r,$debug);
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
	   
	  
echo'<div id="Modal-one" class="box-modal table-modal eddd1 form'.$name_form.'"><div class="box-modal-pading">';			  ?>  
<div class="top_modal">
	
	
	
  <div class="box-modal_close arcticmodal-close"></div>
  <? echo'<h1 class="h111" mor="'.$token.'" for="'.htmlspecialchars(trim($_GET['id'])).'"><span>Удаление задачи </span></h1>'; ?>
  
  
  
</div>
<div class="center_modal">


<?
			
echo'<div class="comme">Вы точно хотите удалить задачу  №'.$row_8["id"].'?</div>';		
	
	
$no_click_vis=1;
	$mas_responsible ??= '';
if($mas_responsible!=1)
{
   $row_8["flag"]=1;
}
	
	
	$ring_o=0;
	echo'<div class="ring_block ring-block-line">';
include $url_system.'task/code/block_index.php';
	
	
	
echo($task_cloud_block);
	echo'</div>';
	
?>	
	
	


</div>		
<div class="bottom_modal">			
 <span class="clock_table"></span>
 		
<div class="no_button js-exit-form-active"><i>Отменить</i></div>   	
<div class="save_button js-dell-task-no"><i>Удалить</i></div>
         

            
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
<script type="text/javascript">
 $(document).ready(function(){ 

	
  //события прописываем здесь а не в forms.js а функции можно и там писать
  //только если это 2 окно поверх первого	 

  <?
  echo 'var name_form=\''.$name_form.'\';';
?> 
	 
  $('.form'+name_form).on("change keyup input click",'.js-dell-task-no',{key: "006U"},js_dell_form_no);  //кнопка удалить
	 
 $('.form'+name_form).on("change keyup input click",'.js-exit-form-active',{key: "006U"},exit_form_active); //кнопка отмена
	 
	 
	 
	<? 
	 //echo($date_task);
	 
	 ?>
	 
 });
	 </script>

