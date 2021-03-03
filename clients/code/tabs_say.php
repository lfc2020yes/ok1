<?
$query_string='<div class="say_clients">';


$query_string.='<div class="js-add_say_cbb"><div class="add_say_cbb"><div class="center_vert" style="width:100%"><span>Добавить сообщение</span></div></div></div>';


//форма добавления сообщения
//форма добавления сообщения

$su_say=2;
$query_string.='<div class="js-ssay"><div class="add_say_form js-add-form-plus-task">
<div class="form_left_say js-form_right_say form_say_'.$su_say.'"></div><div class="form_right_say "><div class="add_say_one">';
	

 $os_say = array();
 $os_id_say = array();	
		
	 $result_work_zz=mysql_time_query($link,'Select a.* from k_clients_type_commun as a where a.visible=1 order by a.displayOrder');				 
        $num_results_work_zz = $result_work_zz->num_rows;
	    if($num_results_work_zz!=0)
	    {

		   for ($i=0; $i<$num_results_work_zz; $i++)
		   {			   			  			   
			   $row_work_zz = mysqli_fetch_assoc($result_work_zz);
			   array_push($os_say, $row_work_zz["name"]);
			   array_push($os_id_say, $row_work_zz["var"]);
		   }
		}
	 
	 
		
		
		   $query_string.='<div class="left_drop menu1_prime book_menu_sel js--sayy gop_io " style="margin-left:0px !important;"><label>Тип общения</label><div class="select eddd"><a class="slct" list_number="t33" data_src="'.$os_id_say[array_search($su_say, $os_id_say)].'">'.$os_say[array_search($su_say, $os_id_say)].'</a><ul class="drop">';
			//$zindex--;

		   for ($i=0; $i<count($os_say); $i++)
             {   
			   if($su_say==$os_id_say[$i])
			   {
				   $query_string.='<li class="sel_active"><a href="javascript:void(0);"  rel="'.$os_id_say[$i].'">'.$os_say[$i].'</a></li>';
			   } else
			   {
				  $query_string.='<li><a href="javascript:void(0);"  rel="'.$os_id_say[$i].'">'.$os_say[$i].'</a></li>'; 
			   }
			 
			 }
		   $query_string.='</ul><input type="hidden" name="typesay" id="typesay" value="'.$su_say.'"></div></div>'; 



$query_string.='</div>	
<div class="add_say_two">
       <div class="div_textarea_say" >
	   <label>ваш комментарий</label>
			<div class="otziv_add">';
                 
                   
        $query_string.='<textarea style="height:20px" cols="10" rows="1" placeholder="" id="otziv_area_say" name="comment_b" class="di text_area_otziv no_comment_bill"></textarea>

 <script type="text/javascript"> 
	  $(function (){ 
$(\'#otziv_area_say\').autoResize({extraSpace : 10});
$(\'#otziv_area_say\').trigger(\'keyup\');

ToolTip();
});

	</script>';
				
            $query_string.='</div>      
</div>	
</div>';


//форма задачи
$query_string.='<div class="form-task-02">';

$query_string.='<div style="margin-top: 30px;">
<div class="input_2018"><label>Дата напоминания</label>

<div class="help_selection js-vibor-date"><span class="date_help_sele" tabi="'.date("Y").'-'.
					date("m").'-'.
					date("d").'">Сегодня</span><span class="date_help_sele" tabi="'.date("Y", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")+1), date("Y"))).'-'.
					date("m", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")+1), date("Y"))).'-'.
					date("d", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")+1), date("Y"))).'">Завтра</span><span class="date_help_sele" tabi="'.date("Y", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")+2), date("Y"))).'-'.
					date("m", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")+2), date("Y"))).'-'.
					date("d", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")+2), date("Y"))).'">Послезавтра</span></div>

<input readonly="true" name="task_date" value="" id="date_table_gr22" class="input_new_2018 required gloab" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"></div></div>
</div> 

<input id="date_hidden_table_gr3300"  name="date_sele_task" value="" type="hidden">';

		
		$query_string.='<div class="pad10" style="padding: 0;"><span class="bookingBox_gr22"></span></div>
	<!--<script type="text/javascript" src="Js/jquery-ui-1.9.2.custom.min.js"></script>
	<script type="text/javascript" src="Js/jquery.datepicker.extension.range.min.js"></script>-->		            
 <script type="text/javascript">var disabledDays = [];
 $(document).ready(function(){        
 $(\'.time_input\').inputmask("hh:mm", {placeholder: "HH:MM", insertMode: false, showMaskOnHover: false});
 
            $("#date_table_gr22").datepicker({ 
altField:\'#date_hidden_table_gr3300\',
onClose : function(dateText, inst){
	    //date_graf();
        //alert(dateText); // Âûáðàííàÿ äàòà 
		
    },
altFormat:\'yy-mm-dd\',
defaultDate:null,
beforeShowDay: disableAllTheseDays,
dateFormat: "d MM yy", 
firstDay: 1,
minDate: "0d", maxDate: "+2Y",
onSelect: function(dateText) {
    	// extensionRange - объект расширения
	//alert(dateText);
				//	var theDate = $(inst).datepicker.formatDate(\'DD, MM d, yy\', $(inst).datepicker.(\'getDate\'));
$("#date_table_gr22").parents(\'.input_2018\').addClass(\'active_in_2018\');
	},
beforeShow:function(textbox, instance){
	//alert(\'before\');
	
	setTimeout(function () {
            instance.dpDiv.css({
                position: \'absolute\',
				top: 0,
                left: 0
            });
		

		var html = $(\'.ui-datepicker:last\'); 
		//$(\'.ui-datepicker\').remove();
		$(\'.bookingBox_gr22\').append(html);
        }, 10);
	
 
} });
 });
	 
function resizeDatepicker() {
    setTimeout(function() { $(\'.bookingBox_gr22 > .ui-datepicker\').width(\'100%\'); }, 10);
}	 

function jopacalendar(queryDate,queryDate1,date_all) 
	{
	
if(date_all!=\'\')
	{
var dateParts = queryDate.match(/(\d+)/g), realDate = new Date(dateParts[0], dateParts[1] -1, dateParts[2]); 
var dateParts1 = queryDate1.match(/(\d+)/g), realDate1 = new Date(dateParts1[0], dateParts1[1] -1, dateParts1[2]); 	 	 
	}
	}	 
	 
</script>	 
                       

<div style="margin-top: 30px;">
<div class="input_2018"><label>Время</label><input name="task_time" value="" id="date_124" class="input_new_2018 required time_input gloab"  autocomplete="off" maxlength="5" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"></div></div>
</div>';  


$query_string.='<div style="margin-top: 30px;">';

      $query_string.='<div class="div_textarea_otziv1 js-prs" >
			<div class="otziv_add">';
                 
                   
        $query_string.='<textarea cols="10" rows="1" placeholder="Текст напоминания" id="otziv_area_adaxx299" name="task_comment" class="di text_area_otziv no_comment_bill22 tyyo gloab"></textarea>';
				
            $query_string.='</div>      
</div>  

        <script type="text/javascript"> 
	  $(function (){ 
$(\'#otziv_area_adaxx299\').autoResize({extraSpace : 10});
$(\'.tyyo\').trigger(\'keyup\');
});

	</script>
	</div>';


$query_string.='</div>';
	 
//форма задачи


$query_string.='</div>  <div class="add_say_yes"><div class="center_vert right_task_ccb" style="width: 100%;"><div class="add_cff js-add-cff js-add-say-yes">добавить сообщение</div>

<div class="task_cb js-add-task-butt">


<div class="task_cb_head">
задача
</div>
<div class="task_cb_radio"><div class="center_vert1"><i></i>
<input name="radio_task_select" value="0" type="hidden">
</div>
</div>





</div>


<div class="task_cb_exit js-exit-form-say">


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
$result_8 = mysql_time_query($link,'SELECT A.id,A.comment,B.var as ids, B.name, A.id_user, A.datetimes  FROM k_clients_commun AS A,k_clients_type_commun as B WHERE A.visible=1 and A.id_type_commun=B.id and A.id_client="'.htmlspecialchars(trim($id)).'" order by A.datetimes desc limit 0,'.$count_say);



$num_8 = $result_8->num_rows;	
if($result_8)
{	

  			  while($row_8 = mysqli_fetch_assoc($result_8)){

				 					 

						 
					  $query_string_xx='<div rel_notib="'.$row_8["id"].'" class="say_cb say_say_cb">';

	

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
			if(($row_8["id_user"]==$id_user)or($sign_admin==1))
			{
$query_string_xx.='<div class="edit-menu-2019"><i class="em1 js-say-edit" data-tooltip="Изменить"></i><i class="em2 js-say-del" data-tooltip="Удалить"></i></div>';				  }

$query_string_xx.='</div>';
//$query_string_xx.='</div>';
				  
		  
				  

$query_string.=$query_string_xx;
								  
					 
				  
				  
				  
				  
			  }
	

	//выводить кнопку еще или нет
	  $sql_gog2='select count(A.id) as cc from k_clients_commun as A where A.visible=1 and A.id_client="'.htmlspecialchars(trim($id)).'"';  
	
	//echo($sql_gog2);
      $result_gog2=mysql_time_query($link,$sql_gog2);
      $num_results_gog2 =$result_gog2->num_rows;
      if($num_results_gog2!=0)
      { 
             $row_gog2 = mysqli_fetch_assoc($result_gog2);
		     if(($row_gog2["cc"]!=0)and($row_gog2["cc"]>$count_say))
			 {	
	            $query_string.='<div class="cb_eshe" pg="1" start="0" all="'.$count_say.'" ><span>показать еще</span></div>';
			 }
	  }		
	
	
}
if($num_8==0)
{
	$query_string.='<div class="message_search_b message_clients_cb js-message-say"><span>Сообщения с выбранным туристом отсутствуют.</span></div>';
} else
{
	$query_string.='<div class="message_search_b message_clients_cb js-message-say" style="display:none;"><span>Сообщения с выбранным туристом отсутствуют.</span></div>';	
}


$query_string.='</div>';