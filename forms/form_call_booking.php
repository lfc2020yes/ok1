<?php
//форма отказались от предложений

$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';


//создание секрет для формы
$secret=rand_string_string(4);
$_SESSION['s_form'] = $secret;

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
	


$result_t=mysql_time_query($link,'Select b.id_user,b.status,b.id_object from booking as b where b.id="'.htmlspecialchars(trim($_GET['id'])).'"');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{	
		$debug=h4a(5,$echo_r,$debug);
		goto end_code;
	
} else
{
	$row_score = mysqli_fetch_assoc($result_t);
	
	if($row_score["status"]==3)
	{
		$debug=h4a(8,$echo_r,$debug);
		goto end_code;		
	}
}


if ((!$role->permission('Заявки','A'))and($sign_admin!=1))
{
    goto end_code;	
}

	if((array_search($row_score["id_object"],$hie_object) === false)and($sign_admin!=1))
	{
		goto end_code;	
	}
//составление секретного ключа формы
//составление секретного ключа формы
//соль для данного действия
$token=token_access_compile($_GET['id'],'call_bookings_xx',$secret);
//составление секретного ключа формы
//составление секретного ключа формы
//составление секретного ключа формы

	   

$status=1;
	   
	   ?>
<div id="Modal-one" class="box-modal table-modal eddd1"><div class="box-modal-pading">			    
<div class="top_modal">
	
	
	
  <div class="box-modal_close arcticmodal-close"></div>
  <? echo'<h1 class="h111" mor="'.$token.'" for="'.htmlspecialchars(trim($_GET['id'])).'"><span>Перезвонить по заявке</span></h1>'; ?>
  
  
  
</div>
<div class="center_modal">


<?

echo'<div class="comme">Надеюсь вы уточнили у клиента, когда и в какое время вы созвонитесь с вашим клиентом.</div>';

?>	
<div style="margin-top: 30px;">
<div class="input_2018"><label>Дата когда позвонить</label><input readonly="true" name="date_123" value="" id="date_table_gr22" class="input_new_2018 required " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"></div></div>
</div> 

 <?     
 echo'<input id="date_hidden_table_gr33" name="date_naryad" value="" type="hidden">';

		
		echo'<div class="pad10" style="padding: 0;"><span class="bookingBox_gr22"></span></div>';
	
?>
	<script type="text/javascript" src="Js/jquery-ui-1.9.2.custom.min.js"></script>
	<script type="text/javascript" src="Js/jquery.datepicker.extension.range.min.js"></script>		            
 <script type="text/javascript">var disabledDays = [];
 $(document).ready(function(){           
            $("#date_table_gr22").datepicker({ 
altField:'#date_hidden_table_gr33',
onClose : function(dateText, inst){
	    //date_graf();
        //alert(dateText); // Âûáðàííàÿ äàòà 
		
    },
altFormat:'yy-mm-dd',
defaultDate:null,
beforeShowDay: disableAllTheseDays,
dateFormat: "d MM yy", 
firstDay: 1,
minDate: "0d", maxDate: "+2Y",
onSelect: function(dateText) {
    	// extensionRange - объект расширения
	//alert(dateText);
				//	var theDate = $(inst).datepicker.formatDate('DD, MM d, yy', $(inst).datepicker.('getDate'));
$("#date_table_gr22").parents('.input_2018').addClass('active_in_2018');
	},
beforeShow:function(textbox, instance){
	//alert('before');
	
	setTimeout(function () {
            instance.dpDiv.css({
                position: 'absolute',
				top: 0,
                left: 0
            });
		

		var html = $('.ui-datepicker:last'); 
		//$('.ui-datepicker').remove();
		$('.bookingBox_gr22').append(html);
        }, 10);
	
 
} });
 });
	 
function resizeDatepicker() {
    setTimeout(function() { $('.bookingBox_gr22 > .ui-datepicker').width('100%'); }, 10);
}	 

function jopacalendar(queryDate,queryDate1,date_all) 
	{
	
if(date_all!='')
	{
var dateParts = queryDate.match(/(\d+)/g), realDate = new Date(dateParts[0], dateParts[1] -1, dateParts[2]); 
var dateParts1 = queryDate1.match(/(\d+)/g), realDate1 = new Date(dateParts1[0], dateParts1[1] -1, dateParts1[2]); 	 	 
	}
	}	 
	 
</script>	 
                       

<div style="margin-top: 30px;">
<div class="input_2018"><label>Время</label><input name="date_124" value="" id="date_124" class="input_new_2018 required time_input" autocomplete="off" maxlength="5" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"></div></div>
</div>  

</div>		
<div class="bottom_modal">			
 <span class="clock_table"></span>
 		
<div id="no_rd" class="no_button"><i>Отменить</i></div>   	
<div id="button_call_booking" class="save_button"><i>Перезвонить</i></div>
         

            
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
	$(document).ready(function() {
		

		//$('.date_time_picker').datetimepicker();
		/*$('.date_time_picker').inputmask("datetime",{
    mask: "1.2.y h:s", 
    placeholder: "dd.mm.yyyy hh:mm",  
    separator: ".", 
    alias: "dd.mm.yyyy"
  });*/
	$('.time_input').inputmask("hh:mm", {placeholder: "HH:MM", insertMode: false, showMaskOnHover: false});	
});
</script>
<?
include_once $url_system.'template/form_js.php';
?>

