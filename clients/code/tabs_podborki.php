<?
$query_string='<div class="say_clients">';


$query_string.='<div class="js-add_sel_cbb"><div class="add_sel_cbb"><div class="center_vert" style="width:100%"><span>Добавить подборку</span></div></div></div>';


//форма добавления подборки
//форма добавления подборки


$query_string.='<div class="js-ssel"><div class="add_sel_form js-add-form-plus-task">
<div class="form_right_say ">';



$query_string.='<div class="add_say_two">';
       
	   
  $query_string.='<span class="js-form-gll"><div style="margin-top: 30px; padding: 0px 20px;"><div class="input_2018"><label>Ссылка на подборку</label><input name="link_selection" value="" id="date_124" class="input_new_2018 required no_upperr gloab" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div></span>';	

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

$query_string.='</div></div>  <div class="add_sel_yes"><div class="center_vert right_task_ccb" style="width: 100%;"><div class="add_cff js-add-sel">добавить подборку</div>

<div class="task_cb js-add-task-butt">


<div class="task_cb_head">
задача
</div>
<div class="task_cb_radio"><div class="center_vert1"><i></i>
<input name="radio_task_select" value="0" type="hidden">
</div>
</div>





</div>


<div class="task_cb_exit js-exit-form-sel">


<div class="task_cb_head">
отменить
</div>
</div>

</div></div>		
</div></div>';	


//форма добавления подборки
//форма добавления подборки


$echo_xx=1;
$count_say=10;
$redd__='';
$result_8 = mysql_time_query($link,'SELECT A.*  FROM selection AS A WHERE A.visible=1 and  A.id_k_clients="'.htmlspecialchars(trim($id)).'" order by A.date_create desc limit 0,'.$count_say);



$num_8 = $result_8->num_rows;	
if($result_8)
{	

  			  while($row_8 = mysqli_fetch_assoc($result_8)){

				 					 

						 
					  $query_string_xx='<div rel_notib="'.$row_8["id"].'" class="say_cb js-selection_cb selection_cb">';

	

$query_string_xx.='<div class="h_cb"><a target="blank" class="blank_no_cb" href="'.$row_8["link"].'"><span>'.$row_8["link"].'</span></a>';
			
$query_string_xx.='<div class="date_cb" >'.time_stamp($row_8["date_create"]).'</div>';
				  
				  
	$result_status22=mysql_time_query($link,'SELECT b.name_user,b.name_small FROM r_user AS b WHERE b.id="'.htmlspecialchars(trim($row_8["id_user"])).'"');	
					 //echo('SELECT a.* FROM r_status AS a WHERE a.numer_status="'.$row1ss["status"].'" and a.id_system=13');
                if($result_status22->num_rows!=0)
                {  
                   $row_status22 = mysqli_fetch_assoc($result_status22);			  
$query_string_xx.='<div class="user_cb">'.$row_status22['name_small'].'</div>';
				}
				  
				  
				  
						  				  
$query_string_xx.='</div>';
				  
				  
//смотрим есть ли нерешенная задача с этой подборкой.				  
	$result_status22task=mysql_time_query($link,'SELECT b.* FROM task_new AS b WHERE b.visible=1 and b.action=9 and b.status=0 and b.id_object="'.ht($row_8["id"]).'" and b.id_user="'.ht($row_8["id_user"]).'"');	

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
				  
				  	   
$query_string_xx.='<div class="link_cb"></div>';			   


				  
//только для своих подборок
			if(($row_8["id_user"]==$id_user)or($sign_admin==1))
			{
$query_string_xx.='<div class="edit-menu-2019"><i class="em1 js-selection-edit" data-tooltip="Изменить"></i><i class="em2 js-selection-del" data-tooltip="Удалить"></i></div>';				  }
				  

$query_string_xx.='</div>';
//$query_string_xx.='</div>';
				  
		  
				  

$query_string.=$query_string_xx;
								  
					 
				  
				  
				  
				  
			  }
	

	//выводить кнопку еще или нет
	  $sql_gog2='select count(A.id) as cc from selection as A where A.visible=1 and A.id_k_clients="'.htmlspecialchars(trim($id)).'"';  
      $result_gog2=mysql_time_query($link,$sql_gog2);
      $num_results_gog2 =$result_gog2->num_rows;
      if($num_results_gog2!=0)
      { 
             $row_gog2 = mysqli_fetch_assoc($result_gog2);
		     if(($row_gog2["cc"]!=0)and($row_gog2["cc"]>$count_say))
			 {	
	            $query_string.='<div class="cb_eshe_sel js-eshe-selection" pg="1" start="0" all="'.$count_say.'" ><span>показать еще</span></div>';
			 }
	  }		
	
	
}
if($num_8==0)
{
	$query_string.='<div class="message_search_b message_clients_cb js-message-selection"><span>Подборок для этого туриста пока не добавлено.</span></div>';
} else
{
	$query_string.='<div class="message_search_b message_clients_cb js-message-selection" style="display:none;"><span>Подборок для этого туриста пока не добавлено.</span></div>';	
}


$query_string.='</div>';