<?php
//форма добавления нового счета 

$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';


//создание секрет для формы
$secret=rand_string_string(4);
$_SESSION['s_form'] = $secret;

$status=0;


if ( count($_GET) != 1 ) 
{
   $debug=h4a(1,$echo_r,$debug);
   goto end_code;	
}
 if ((!$role->permission('Задачи','U'))and($sign_admin!=1))
{
  $debug=h4a(2,$echo_r,$debug);
  goto end_code;	
}
 if(!isset($_SESSION["user_id"]))
{ 
  $status_ee='reg';	
  $debug=h4a(3,$echo_r,$debug);
  goto end_code;
}
//**************************************************
//проверить есть ли переменная id и можно ли этому пользователю это делать
if ((count($_GET) != 1)or(!isset($_GET["id"]))or((!is_numeric($_GET["id"])))) 
{
	$debug=h4a(311,$echo_r,$debug);
	goto end_code;	
}	
	






//**************************************************
$result_t=mysql_time_query($link,'Select b.* from task_new as b where b.id="'.htmlspecialchars(trim($_GET['id'])).'"');
           $num_results_t = $result_t->num_rows;
	       if($num_results_t!=0)
	       {	
			 
			 $row_8 = mysqli_fetch_assoc($result_t);
		   
if($row_8["status"]!=0)
	{
		$debug=h4a(8,$echo_r,$debug);
		goto end_code;		
	}
if($row_8["click"]!=1)
	{
		$debug=h4a(811,$echo_r,$debug);
		goto end_code;		
	}

$mas_responsible=explode(",",$row_8["id_user_responsible"]);
if (!in_array($id_user, $mas_responsible)) 
{
	//может он управляющий кого то кто должен выполнить эту задачу тогда ему тоже можно ее выполнить
	 $subo_x = array();
	foreach ($mas_responsible as $key => $value) 
    {
	   $subo_x = array_merge($subo_x, all_chief($value,$link));	   
		
	}
	//rm_from_array($id_user,$subo_x);
	$subo_x= array_unique($subo_x);
	
	
	if ((!in_array($id_user, $subo_x))and($sign_admin!=1)) 
    {
		$debug=h4a(789,$echo_r,$debug);
        goto end_code;	
	}		
			
}
			   
			   
		   } else
		   {
			      $debug=h4a(6,$echo_r,$debug);
   goto end_code;	
		   }



//составление секретного ключа формы
//составление секретного ключа формы
//соль для данного действия
$token=token_access_compile($_GET['id'],'yes_click_task',$secret);
//составление секретного ключа формы
//составление секретного ключа формы
//составление секретного ключа формы

	   

$status=1;
	   
	   ?>
<div id="Modal-one" class="box-modal table-modal eddd1 history_window1"><div class="box-modal-pading">			    
<div class="top_modal">
	
	
	
  <div class="box-modal_close arcticmodal-close"></div>
  <? echo'<h1 class="h111" mor="'.$token.'" for="'.htmlspecialchars(trim($_GET['id'])).'"><span>Вы подтверждаете что выполнили данную задачу?</span></h1>'; 
	

	
	?>
  
  
	
	
  
</div>
<div class="center_modal">


<?				
//echo'<div class="comme">Вы подтверждаете что выполнили данную задачу?</div>';		

$no_click_vis=1;
	
	if($mas_responsible!=1)
	{
	$row_8["flag"]=1;
	}
	
	echo'<div class="ring_block ring-block-line">';
include $url_system.'task/code/block_index.php';
	
	
	
		 echo($task_cloud_block);
	echo'</div>';
		
	echo'<div class="form_yes_3">';
echo'<div class="div_textarea_say_task" >';

if($row_8["action"]==17)
    {
        echo'<label>Впечатление туриста по данному туру</label>';
	   } else
	       {
	        echo'<label>ваш комментарий по выполнению</label>';
	       }
echo'<div class="otziv_add">';
                 
                   
        echo'<textarea style="height:20px" cols="10" rows="1" placeholder="" id="comment_yes_task" name="comment_b" class="di text_area_otziv no_comment_bill yes_task_new_2020"></textarea>

 <script type="text/javascript"> 
	  $(function (){ 
$(\'#comment_yes_task\').autoResize({extraSpace : 10});
$(\'#comment_yes_task\').trigger(\'keyup\');

ToolTip();
});

	</script>';
				
echo'</div></div>';	 
	
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

	
echo'<div class="input-choice-click js-add_say_cbb js-add-say-task-yes">
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
			$zindex--;

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
echo $query_string;	
}
	?>

	
	
	
</div>

</div>		
<div class="bottom_modal">			
 <span class="clock_table"></span>
 		
<div id="no_rd" class="no_button"><i>Отменить</i></div>   	
	
<?
$row_score["action"] ??='';	
	
if($row_score["action"]==8)
{
echo'<div id="button_yes_task_comment" class="save_button task_vsevse_cb"><i>Да</i></div>';		
} else
{
echo'<div id="button_yes_task" class="save_button task_vsevse_cb"><i>Да</i></div>';	
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
 
	 ToolTip();
	
	 		$(".slct").unbind('click.sys');
		$(".slct").bind('click.sys', slctclick);
		$(".drop").find("li").unbind('click');
		$(".drop").find("li").bind('click', dropli);
	 $('#typesay').unbind('change', changesay);
	 $('#typesay').bind('change', changesay);
	
 });
