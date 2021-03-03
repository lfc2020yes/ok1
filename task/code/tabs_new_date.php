<?
$date_elementst  = explode(" ",$row_8["ring_datetime"]);
$date_elements1t  = explode(":",$date_elementst[1]);
$date_elements2t  = explode("-",$date_elementst[0]);
		$time_task=$date_elements1t[0].':'.$date_elements1t[1];
					//2019-10-20
		$date_task=$date_elementst[0];		

$query_string='<div class="pad10" style="padding: 0; z-index:100;"><span class="bookingBox_gr22"></span></div>';
$query_string.='<div class="form_yes_33 js-form-task-date" style="position:relative; z-index:1;">';


//$query_string.='<div class="help_div da_book1"><span class="h5" style="text-align: center;"><span>Выберите дату на которую вы хотите перенести задачу?</span></span></div>';

$query_string.='<div style="margin-top: 30px;">
<div class="input_2018"><label>Отложить до</label>

<div class="help_selection js-vibor-date"><span class="date_help_sele" tabi="'.date("Y").'-'.
					date("m").'-'.
					date("d").'">Сегодня</span><span class="date_help_sele" tabi="'.date("Y", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")+1), date("Y"))).'-'.
					date("m", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")+1), date("Y"))).'-'.
					date("d", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")+1), date("Y"))).'">Завтра</span><span class="date_help_sele" tabi="'.date("Y", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")+2), date("Y"))).'-'.
					date("m", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")+2), date("Y"))).'-'.
					date("d", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")+2), date("Y"))).'">Послезавтра</span></div>

<input readonly="true" name="task[task_date]" value="" id="date_table_gr22" class="input_new_2018 required gloab" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"></div></div>
</div> 

<input id="date_hidden_table_gr3300"  name="task[date]" value="" type="hidden">';

		
		//$query_string.='<div class="pad10" style="padding: 0;"><span class="bookingBox_gr22"></span></div>';
	$query_string.='
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
<div class="input_2018"><label>Время</label><input name="task[time]" value="'.ipost_($time_task,"").'" id="date_124" class="input_new_2018 required time_input gloab"  autocomplete="off" maxlength="5" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"></div></div>
</div>';  




$query_string.='<div class="div_textarea_say_task" style="margin-top: 30px;">
	   <label>почему вы переносите дату выполнения</label>
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

$query_string.='</div>';

	

	 $query_string.='<script type="text/javascript">
 $(document).ready(function(){'; 


if($date_task!='')
{
	
	 $query_string.='var date_v11=\''.$date_task.'\';';
	 	$query_string.='$(\'#date_hidden_table_gr3300\').val(\''.$date_task.'\');';
	
	$query_string.='var dateParts = date_v11.match(/(\d+)/g), realDate = new Date(dateParts[0], dateParts[1] -1, dateParts[2]);'; 


$query_string.="$('#date_table_gr22').datepicker({ dateFormat: 'yy-mm-dd' });		
$('#date_table_gr22').datepicker('setDate', realDate);	"; 


}
	
	 
 $query_string.="input_2018(); });
	 </script>";

	
	?>

