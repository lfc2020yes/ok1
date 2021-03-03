<?php
//форма редактирования подборки. Второе окно. поэтому forms.Js с этим окном не подгружаем

$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';


//создание секрет для формы
$secret=rand_string_string(4);
$_SESSION['s_form_two'] = $secret;   //секрет должен быть создан только для этой переменной название сессии другое что в первом окне

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
	

//может 
$result_t=mysql_time_query($link,'Select a.* from selection as a where a.id="'.htmlspecialchars(trim($_GET['id'])).'" and a.visible=1');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{	
		$debug=h4a(5,$echo_r,$debug);
		goto end_code;
	
} else
{
	$row_score = mysqli_fetch_assoc($result_t);
	
	if(($row_score["id_user"]!=$id_user)and($sign_admin!=1))
	{
		$debug=h4a(8,$echo_r,$debug);
		goto end_code;		
	}
}


if ((!$role->permission('Клиенты','R'))and($sign_admin!=1))
{
    goto end_code;	
}

	
//составление секретного ключа формы
//составление секретного ключа формы
//соль для данного действия
$token=token_access_compile($_GET['id'],'bt_client_info',$secret);
//составление секретного ключа формы
//составление секретного ключа формы
//составление секретного ключа формы

	   

$status=1;
	   
	   ?>
<div id="Modal-one" class="box-modal js-box-modal-two table-modal eddd1 history_window1 client_window"><div class="box-modal-pading">			    
<div class="top_modal">
	
	
	
  <div class="box-modal_close arcticmodal-close"></div>
  <? echo'<h1 class="h111 js-form2" mor="'.$token.'" for="'.htmlspecialchars(trim($_GET['id'])).'"><span>Изменение подборки №'.$_GET["id"].'</span></h1>'; ?>
  
  
  
</div>
<div class="center_modal">
<?
	$task=0;
	$comment='';
	$task_class='';
	$task_class1='';
	$time_task='';
	$date_task='';
	$result_status22task=mysql_time_query($link,'SELECT b.* FROM task_new AS b WHERE b.visible=1 and b.action=9 and b.status=0 and b.id_object="'.ht($_GET['id']).'" and b.id_user="'.ht($id_user).'"');	

                if($result_status22task->num_rows!=0)
                {  			
					$row_status22task = mysqli_fetch_assoc($result_status22task);
					$task=1;
					$task_class='class="active_task_cb"';
					$comment=$row_status22task["comment"];
					$task_class1='style="display:block;"';
					
					$date_elementst  = explode(" ",$row_status22task["ring_datetime"]);
$date_elements1t  = explode(":",$date_elementst[1]);
$date_elements2t  = explode("-",$date_elementst[0]);
		$time_task=$date_elements1t[0].':'.$date_elements1t[1];
					//2019-10-20
		$date_task=$date_elementst[0];			
				}

$query_string='<div class="js-ssel" style="display:block;"><div class="add_sel_form js-add-form-plus-task">
<div class="form_right_say ">';



$query_string.='<div class="add_say_two">';
       
	   
  $query_string.='<span class="js-form-gll_form2"><div style="margin-top: 30px; padding: 0px 20px;"><div class="input_2018"><label>Ссылка на подборку</label><input name="link_selection_form2" value="'.$row_score["link"].'" id="date_124" class="input_new_2018 required no_upperr gloab" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div></span>';	


$query_string.='<div class="form-task-02_form2" '.$task_class1.'>';

$query_string.='<div style="margin-top: 30px;">
<div class="input_2018"><label>Дата напоминания</label>

<div class="help_selection js-vibor-date1"><span class="date_help_sele" tabi="'.date("Y").'-'.
					date("m").'-'.
					date("d").'">Сегодня</span><span class="date_help_sele" tabi="'.date("Y", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")+1), date("Y"))).'-'.
					date("m", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")+1), date("Y"))).'-'.
					date("d", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")+1), date("Y"))).'">Завтра</span><span class="date_help_sele" tabi="'.date("Y", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")+2), date("Y"))).'-'.
					date("m", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")+2), date("Y"))).'-'.
					date("d", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")+2), date("Y"))).'">Послезавтра</span></div>

<input readonly="true" name="task_date" value="" id="date_table_gr221" class="input_new_2018 required gloab" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"></div></div>
</div> 

<input id="date_hidden_table_gr3301"  name="date_sele_task_form2" value="" type="hidden">';

		
		$query_string.='<div class="pad10" style="padding: 0;"><span class="bookingBox_gr221"></span></div>
	<script type="text/javascript" src="Js/jquery-ui-1.9.2.custom.min.js"></script>
	<script type="text/javascript" src="Js/jquery.datepicker.extension.range.min.js"></script>		            
 <script type="text/javascript">var disabledDays = [];
 $(document).ready(function(){        
 $(\'.time_input\').inputmask("hh:mm", {placeholder: "HH:MM", insertMode: false, showMaskOnHover: false});
 
            $("#date_table_gr221").datepicker({ 
altField:\'#date_hidden_table_gr3301\',
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
$("#date_table_gr221").parents(\'.input_2018\').addClass(\'active_in_2018\');
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
		$(\'.bookingBox_gr221\').append(html);
        }, 10);
	
 
} });
 });
	 
function resizeDatepicker() {
    setTimeout(function() { $(\'.bookingBox_gr221 > .ui-datepicker\').width(\'100%\'); }, 10);
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
<div class="input_2018"><label>Время</label><input name="task_time_form2" value="'.ipost_($time_task,"").'" id="date_124" class="input_new_2018 required time_input gloab"  autocomplete="off" maxlength="5" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"></div></div>
</div>';  


$query_string.='<div style="margin-top: 30px;">';

      $query_string.='<div class="div_textarea_otziv1 js-prs" >
			<div class="otziv_add">';
                 
                   
        $query_string.='<textarea cols="10" rows="1" placeholder="Текст напоминания" id="otziv_area_adaxx2991" name="task_comment" class="di text_area_otziv no_comment_bill22 tyyo1 gloab">'.ipost_($comment,"").'</textarea>';
				
            $query_string.='</div>      
</div>  

        <script type="text/javascript"> 
	  $(function (){ 
$(\'#otziv_area_adaxx2991\').autoResize({extraSpace : 10});
$(\'.tyyo1\').trigger(\'keyup\');
});

	</script>
	</div>';


$query_string.='</div>';
	   
$query_string.='</div></div>  <div class="add_sel_yes"><div class="center_vert right_task_ccb" style="width: 100%;"><div class="add_cff js-add-sel1">изменить подборку</div>

<div class="task_cb js-add-task-butt1">


<div class="task_cb_head">
задача
</div>
<div class="task_cb_radio"><div class="center_vert1"><i '.$task_class.'></i>
<input name="radio_task_select_form2" value="'.$task.'" type="hidden">
</div>
</div>





</div>


<div class="task_cb_exit js-exit-form-sel1">


<div class="task_cb_head">
отменить
</div>
</div>

</div></div>		
</div></div>';	

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
  $('.js-box-modal-two').on("change keyup input click",'.task_cb',task_cb_head1);	 
  $('.js-box-modal-two').on("change keyup input click",'.js-vibor-date1 span',js_vibor_date1);	 
  $('.js-box-modal-two').on("change keyup input click",'.js-exit-form-sel1',js_exit_form_sel1);
	 
 $('.js-box-modal-two').on("change keyup input click",'.js-add-sel1',add_sel_yes1);
	 
	<? 
	 //echo($date_task);
	 
if($date_task!='')
{
	?>
	 var date_v11='<? echo($date_task); ?>';
	 	$('#date_hidden_table_gr3301').val('<? echo($date_task); ?>');
	
	var dateParts = date_v11.match(/(\d+)/g), realDate = new Date(dateParts[0], dateParts[1] -1, dateParts[2]); 

$('#date_table_gr221').datepicker({ dateFormat: 'yy-mm-dd' });		
$('#date_table_gr221').datepicker('setDate', realDate);	 
	 input_2018();
	 <?
}
	 ?>
	 
 });
	 </script>


<?
//include_once $url_system.'template/form_js.php';
?>

