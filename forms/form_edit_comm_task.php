<?php
//форма редактирования комментариев в задаче

$name_form='004U';
$key_form='bt_task_edit_cocc';

$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';


//создание секрет для формы
$secret=rand_string_string(4);
$_SESSION['form'.$name_form] = $secret;   //секрет должен быть создан только для этой переменной название сессии другое что в первом окне

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
	

$result_t=mysql_time_query($link,'Select b.* from task_status_history_new as b where b.id="'.htmlspecialchars(trim($_GET['id'])).'" and b.edit=1');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{	
	$debug=h4a(5,$echo_r,$debug);
	goto end_code;
	
} else
{
	$row_8 = mysqli_fetch_assoc($result_t);
	$mas_responsible=explode(",",$row_8["id"]);
}


//может ли он смотреть эту задачу
//он ее поставил
//он в исполнителях
//он является командует тем кто есть в создателях или исполнителях

$mas_responsible=explode(",",$row_8["id_user"]);

$mas_responsible = array_merge($mas_responsible, all_chief($row_8["id_user"],$link));

array_push($mas_responsible,$row_8["id_user"]); 

$mas_responsible= array_unique($mas_responsible);
//print_r($mas_responsible);	
	
if ((!in_array($id_user, $mas_responsible))and($sign_admin!=1)) 
{
	$debug=h4a(789,$echo_r,$debug);
    goto end_code;	
}		






if ((!$role->permission('Задачи','U'))and($sign_admin!=1))
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
	   
	   
echo'<div id="Modal-one" class="box-modal js-box-modal-two table-modal eddd1 history_window1 client_window form'.$name_form.'"><div class="box-modal-pading">';
	
	?>
<div class="top_modal">
	
	
	
  <div class="box-modal_close arcticmodal-close"></div>
  <? echo'<h1 class="h111" mor="'.$token.'" for="'.htmlspecialchars(trim($_GET['id'])).'"><span>Изменение комментария  к задаче №'.$row_8['id_task'].'</span></h1>'; ?>
  
  
  
</div>
<div class="center_modal">
<?
//форма добавления сообщения
//форма добавления сообщения

$su_say=2;
$query_string='<div class="js-ssay" style="display:block;"><div class="add_say_form js-add-form-plus-task">
<div class="form_right_say form_right_task_h">
<div class="add_say_two">
       <div class="div_textarea_say" >
	   <label>ваш комментарий</label>
			<div class="otziv_add">';
                 
                   
        $query_string.='<textarea style="height:20px" cols="10" rows="1" placeholder="" name="comment_b" class="di text_area_otziv no_comment_bill js-comment-add-'.$name_form.'">'.$row_8["comment"].'</textarea>

 <script type="text/javascript"> 
	  $(function (){ 
$(\'.js-comment-add-'.$name_form.'\').autoResize({extraSpace : 10});
$(\'.js-comment-add-'.$name_form.'\').trigger(\'keyup\');

ToolTip();
});

	</script>';
				
            $query_string.='</div>      
</div>	
</div>';




$query_string.='</div>  <div class="add_say_yes"><div class="center_vert right_task_ccb" style="width: 100%;"><div class="add_cff js-add-cff js-edit-comm-task-yes">изменить комментарий</div>




<div class="task_cb_exit js-exit-form-edit-comm-task">


<div class="task_cb_head">
отменить
</div>
</div>


</div></div>		
</div></div>';	


//форма добавления сообщения
//форма добавления сообщения	
	
	
	
	
	
	
	
	
	
echo $query_string;
	
	
?>
</div>		
<div class="bottom_modal">			
 <span class="clock_table"></span>
            
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

	 input_2018();
	 
	 		$('.date_picker_x').inputmask("datetime",{
    mask: "1.2.y", 
    placeholder: "dd.mm.yyyy",  
    separator: ".", 
    alias: "dd.mm.yyyy"
  });
	
  //события прописываем здесь а не в forms.js а функции можно и там писать
  //только если это 2 окно поверх первого	 

  <?
  echo 'var name_form=\''.$name_form.'\';';
?> 
	 
  $('.form'+name_form).on("change keyup input click",'.js-exit-form-edit-comm-task',js_exit_form_sel1);  //кнопка отмена
	 
 $('.form'+name_form).on("change keyup input click",'.js-edit-comm-task-yes',{key: "004U"},edit_comm_task_yes); //кнопка изменить
	 
	 
	 
	<? 
	 //echo($date_task);
	 
	 ?>
	 
 });
	 </script>


<?
//include_once $url_system.'template/form_js.php';
?>

