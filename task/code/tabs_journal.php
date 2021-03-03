<?
$query_string ??='';

$query_string.='<div class="say_clients">';


//кто может добавлять комментарии

if($role->permission('Задачи','U'))
{
  $query_string.='<div class="js-add-comment-task"><div class="add_say_cbb_new"><div class="center_vert" style="width:100%"><span>Добавить комментарий</span></div></div></div>';
}

//форма добавления сообщения
//форма добавления сообщения

$su_say=2;
$query_string.='<div class="js-ssay"><div class="add_say_form js-add-form-plus-task">
<div class="form_right_say form_right_task_h">
<div class="add_say_two">
       <div class="div_textarea_say" >
	   <label>ваш комментарий</label>
			<div class="otziv_add">';
                 
                   
        $query_string.='<textarea style="height:20px" cols="10" rows="1" placeholder="" name="comment_b" class="di text_area_otziv no_comment_bill js-comment-add-'.$name_form.'"></textarea>

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




$query_string.='</div>  <div class="add_say_yes"><div class="center_vert right_task_ccb" style="width: 100%;"><div class="add_cff js-add-cff js-add-comment-yes">добавить комментарий</div>




<div class="task_cb_exit js-exit-form-comm-task">


<div class="task_cb_head">
отменить
</div>
</div>


</div></div>		
</div></div>';	


//форма добавления сообщения
//форма добавления сообщения


$echo_xx=1;
$count_say=7;
$redd__='';
$result_8 = mysql_time_query($link,'SELECT A.id,A.action_history,A.id_user, A.datetimes,A.edit,A.comment  FROM task_status_history_new AS A WHERE A.id_task="'.htmlspecialchars(trim($id)).'" order by A.id desc,A.datetimes desc limit 0,'.$count_say);



$num_8 = $result_8->num_rows;	
if($result_8)
{	

  			  while($row_8 = mysqli_fetch_assoc($result_8)){
					  $query_string_xx='<div rel_notib="'.$row_8["id"].'" class="comm-task-block">';
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
				  
				  				  
				  	   
			   
//только для своих общений
			if((($row_8["id_user"]==$id_user)or($sign_admin==1))and($row_8["edit"]==1))
			{
$query_string_xx.='<div class="edit-menu-2019 com-task-edit-block"><i class="em1 js-com-task-edit" data-tooltip="Изменить"></i><i class="em2 js-com-task-del" data-tooltip="Удалить"></i></div>';				  }

$query_string_xx.='</div>';
//$query_string_xx.='</div>';
				  
		  
				  

$query_string.=$query_string_xx;
								  
					 
				  
				  
				  
				  
			  }
	

	//выводить кнопку еще или нет
	  $sql_gog2='select count(A.id) as cc from task_status_history_new as A where A.id_task="'.htmlspecialchars(trim($id)).'"';  
	
	//echo($sql_gog2);
      $result_gog2=mysql_time_query($link,$sql_gog2);
      $num_results_gog2 =$result_gog2->num_rows;
      if($num_results_gog2!=0)
      { 
             $row_gog2 = mysqli_fetch_assoc($result_gog2);
		     if(($row_gog2["cc"]!=0)and($row_gog2["cc"]>$count_say))
			 {	
	            $query_string.='<div class="cb_eshe_comm_task js-cb_eshe_comm_task" pg="1" start="0" all="'.$count_say.'" ><span>показать еще</span></div>';
			 }
	  }		
	
	
}
if($num_8==0)
{
	$query_string.='<div class="message_search_b message_clients_cb js-message-com-t"><span>События с выбранной задачей отсутствуют.</span></div>';
} else
{
	$query_string.='<div class="message_search_b message_clients_cb js-message-com-t" style="display:none;"><span>События с выбранной задачей отсутствуют.</span></div>';	
}


$query_string.='</div>';