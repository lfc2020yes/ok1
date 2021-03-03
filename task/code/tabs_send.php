<?
$query_string='<div class="js-form-send-task">';



if($id_user!=$row_8["id_user_responsible"])
{
 $os_say = array('Лично я');
 $os_id_say = array($id_user);
} else
{
 $os_say = array();
 $os_id_say = array();
}
	
	
		  //найдем всех менеждеров и главных менеджеров компании
	  $mass_ei=all_manager($id_company,$link);
	  rm_from_array($id_user,$mass_ei);
	  $mass_ei= array_unique($mass_ei);	
	
	
		    foreach ($mass_ei as $keys => $value) 
	{	
	 $result_work_zz=mysql_time_query($link,'Select a.name_small,a.id from r_user as a where a.id="'.$value.'" and a.enabled=1');				 
        $num_results_work_zz = $result_work_zz->num_rows;
	    if($num_results_work_zz!=0)
	    {

		   for ($i=0; $i<$num_results_work_zz; $i++)
		   {			   			  			   
			   $row_work_zz = mysqli_fetch_assoc($result_work_zz);
			   array_push($os_say, $row_work_zz["name_small"]);
			   array_push($os_id_say, $row_work_zz["id"]);
		   }
		}
	 
			}
	
	
	
		$su_say='';
		
		   $query_string.='<div class="left_drop menu1_prime " style="margin-left:0px !important; margin-top: 30px; z-index:12;"><label class="active_label">Новый Ответственный</label><div class="select eddd zin_2019"><a class="slct" list_number="t33" data_src=""></a><ul class="drop">';
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
		   $query_string.='</ul><input type="hidden" class="gloab" name="task[komy]" id="taskkto" value="">
		   <div class="div_new_2018_"><hr class="one"></div>
		   
		   </div></div>'; 


//$query_string.='<div class="help_div da_book1"><span class="h5" style="text-align: center;"><span>Вы подтверждаете что выполнили данную задачу?</span></span></div>';


$query_string.='<div class="div_textarea_say_task" style="margin-top: 30px;">
	   <label>Причина передачи задачи</label>
			<div class="otziv_add">';
                 
                   
        $query_string.='<textarea style="height:20px" cols="10" rows="1" placeholder="" id="comment_yes_task" name="task[comment_end]" class="di text_area_otziv no_comment_bill yes_task_new_2020"></textarea>

 <script type="text/javascript"> 
	  $(function (){ 
$(\'#comment_yes_task\').autoResize({extraSpace : 10});
$(\'#comment_yes_task\').trigger(\'keyup\');

ToolTip();
});

	</script>';
				
$query_string.='</div></div>';	 
	
$action_client = array("6", "8", "5", "7", "9", "10", "11", "12","17");

if($row_8["action"]==17) {
	$yes_bb=0;
	$result_uuy = mysql_time_query($link, 'select A.id,A.shopper from trips as A where A.id="' . ht($row_8["id_object"]) . '"');
	$num_results_uuy = $result_uuy->num_rows;

	if ($num_results_uuy != 0) {
		$row_uuy = mysqli_fetch_assoc($result_uuy);
		$id_user_ring = $row_uuy["id_shopper"];


		if ($row_uuy["shopper"] == 1) {
			$yes_bb=1;
		}


	}
}

if ((in_array($row_8["action"], $action_client))and($yes_bb==1)) {

	
$query_string.='<div class="input-choice-click js-add_say_cbb js-add-say-task-yes">
<div class="choice-head">Добавить запись в общение с клиентом</div>
<div class="choice-radio"><div class="center_vert1"><i></i><input name="" id="task_plus_say" value="0" type="hidden"></div></div></div>';	
	
	
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
	<script type="text/javascript" src="Js/jquery-ui-1.9.2.custom.min.js"></script>
	<script type="text/javascript" src="Js/jquery.datepicker.extension.range.min.js"></script>		            
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


$query_string.='</div>  <div class="add_say_yes"><div class="center_vert right_task_ccb" style="width: 100%;">

<div class="task_cb js-add-task-butt">


<div class="task_cb_head">
задача
</div>
<div class="task_cb_radio"><div class="center_vert1"><i></i>
<input name="radio_task_select" value="0" type="hidden">
</div>
</div>





</div>


<div class="task_cb_exit js-exit-form-say-task">


<div class="task_cb_head">
отменить
</div>
</div>


</div></div>		
</div></div>';	


//форма добавления сообщения
//форма добавления сообщения
//echo $query_string;	
}

$query_string.='</div>';

	?>

	
	
	

