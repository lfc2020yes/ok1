<?php
//форма добавления новой задачи

$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';


//создание секрет для формы
$secret=rand_string_string(4);
$_SESSION['s_form'] = $secret;

$status=0;


   $class_bba='cost_bank1';

if((!isset($_SESSION["user_id"]))or(!is_numeric(id_key_crypt_encrypt($_SESSION["user_id"]))))
{	
	goto end_code;
}

$id_user=id_key_crypt_encrypt($_SESSION["user_id"]);

//проверить есть ли переменная id и можно ли этому пользователю это делать
if ((count($_GET) != 0)and(count($_GET) != 1)and(count($_GET) != 2))
{
	goto end_code;	
}	
	


if ((!$role->permission('Задачи','A'))and($sign_admin!=1))
{
    goto end_code;	
}

if((isset($_GET["id"]))and(!isset($_GET["pre"]))) {
//смотрим может ли для этого клиента добавлять задачу
    $sql_tt = 'Select b.id,b.potential,b.fio from k_clients as b where b.id="' . ht($_GET['id']) . '" and b.visible=1 and b.id_a_company="' . ht($id_company) . '"';
    $result_t = mysql_time_query($link, $sql_tt);


    $num_results_t = $result_t->num_rows;
    if ($num_results_t == 0) {
        goto end_code;
    } else
    {
        $row_work_zz55 = mysqli_fetch_assoc($result_t);
    }
}


if((isset($_GET["id"]))and(isset($_GET["pre"]))) {
//смотрим может ли для этого клиента добавлять задачу
    $sql_tt = 'Select b.id from preorders as b where b.id="' . ht($_GET['id']) . '" and b.visible=1 and b.id_company="' . ht($id_company) . '" and b.id_user="'.$id_user.'"';
    $result_t = mysql_time_query($link, $sql_tt);


    $num_results_t = $result_t->num_rows;
    if ($num_results_t == 0) {
        goto end_code;
    } else
    {
        $row_work_zz55 = mysqli_fetch_assoc($result_t);
    }
}



$_GET['ids']=$id_user;
//составление секретного ключа формы
//составление секретного ключа формы
//соль для данного действия
$token=token_access_compile($_GET['ids'],'bt_task_add',$secret);
//составление секретного ключа формы
//составление секретного ключа формы
//составление секретного ключа формы



$status=1;
	   



?>
<div id="Modal-one" class="box-modal table-modal eddd1 history_window1 client_window"><div class="box-modal-pading">			    
<div class="top_modal">
	
	
	
  <div class="box-modal_close arcticmodal-close"></div>
  <? 
  echo'<h1 class="h111" mor="'.$token.'" for="'.htmlspecialchars(trim($_GET['ids'])).'"><span>Добавление Новой задачи</span></h1>';
  ?>
  
  
  
</div>
<div class="center_modal">
<?
echo'<form class="js-form-task" id="vino_xd_task" style=" padding:0; margin:0;" method="post" enctype="multipart/form-data">';
echo'<input type="hidden" value="'.htmlspecialchars(trim($_GET['ids'])).'" name="id">';
echo'<input type="hidden" value="'.$token.'" name="tk">';		

if(isset($_GET["id"]))
{

    $sha=1;
    if($row_work_zz55['potential']==1)
    {
        $sha=3;
    }
if(isset($_GET["pre"]))
{
    $sha=10;
}

            echo '<input type="hidden" value="'.ht($_GET["id"]).'" class="js-id-client-task" name="task[id_client]">';
    echo '<input type="hidden" value="'.$sha.'" class="js-client-type-task" name="task[client_type]">';
} else {
    echo '<input type="hidden" value="" class="js-id-client-task" name="task[id_client]">';
    echo '<input type="hidden" value="" class="js-client-type-task" name="task[client_type]">';
}
	//форма добавления задачи
//форма добавления задачи


$query_string='<div class="px_bg_task"><div ><div class="add_sel_form" style="position:relative;">';

$query_string.='<div class="pad10" style="padding: 0; z-index:100;"><span class="bookingBox_gr22"></span></div>';

$query_string.='<div class="form_right_say ">';



$query_string.='<div class="add_say_two">';
       

	
 $os_say = array( "Лично я");
 $os_id_say = array($id_user);
	
	
	
	$mass_ei=users_hierarchy($id_user,$link);
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
	
	
	//если это директор или главный админ до ему доступен опция все менеджеры
	if($sign_admin==1)
	{
	array_push($os_say, 'Все менеджеры');
	array_push($os_id_say, 'all');
	} else
	{
		if(($sign_level==2)or($sign_level==3))
		{
		   array_push($os_say, 'Все подчиненные менеджеры');
	       array_push($os_id_say, 'all_subor');		
		}
	}
	
	
		$su_say=$id_user;
		
		   $query_string.='<div class="left_drop menu1_prime " style="margin-left:0px !important; margin-top: 30px; z-index:12;"><label class="active_label">Ответственный</label><div class="select eddd zin_2019"><a class="slct" list_number="t33" data_src="'.$os_id_say[array_search($su_say, $os_id_say)].'">'.$os_say[array_search($su_say, $os_id_say)].'</a><ul class="drop">';
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
		   $query_string.='</ul><input type="hidden" class="gloab" name="task[komy]" id="taskkto" value="'.$su_say.'">
		   <div class="div_new_2018_"><hr class="one"></div>
		   
		   </div></div>'; 
	   
  $query_string.='';	

$query_string.='
<div class=" task-option-blue js-task-option-blue">	
<div class="password_turs">
<div id="1" class="input-choice-click-pass js-password-butt active_pass">
<div class="choice-head">Общая задача</div>
<div class="choice-radio"><div class="center_vert1"><i class="active_task_cb"></i></div></div>
</div>	

<div id="2" class="input-choice-click-pass js-password-butt">
<div class="choice-head">Всем по задаче</div>
<div class="choice-radio"><div class="center_vert1"><i></i></div></div>
</div>
<input name="task[type_task]" value="1" type="hidden">	
</div></div>';
	
//форма задачи
$query_string.='<div class="form-task-03">';

$query_string.='<div style="margin-top: 30px;">
<div class="input_2018"><label>Дата напоминания</label>

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
	<!--<script type="text/javascript" src="Js/jquery-ui-1.9.2.custom.min.js"></script>
	<script type="text/javascript" src="Js/jquery.datepicker.extension.range.min.js"></script>	-->	            
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
	    /*
            instance.dpDiv.css({
                position: \'absolute\',
				top: 0,
                left: 0
            });
		

		var html = $(\'.ui-datepicker:last\'); 
		//$(\'.ui-datepicker\').remove();
		$(\'.bookingBox_gr22\').append(html);
		
	     */
	     
	    instance.dpDiv.css({
                position: \'fixed\',
				top: 0,
                left: 0,
                right:0,
                margin:\'auto\',
                width: \'60%\',
                \'box-shadow\': \'0 10px 100px #c6c6c6\',
                \'z-index\': 10001
       
                
            }); 
	     
	     
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
<div class="input_2018"><label>Время</label><input name="task[time]" value="" id="date_124" class="input_new_2018 required time_input gloab"  autocomplete="off" maxlength="5" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"></div></div>
</div>';  


$query_string.='<div style="margin-top: 30px;">';

      $query_string.='<div class="div_textarea_otziv1 js-prs" >
			<div class="otziv_add">';
                 
                   
        $query_string.='<textarea cols="10" rows="1" placeholder="Текст задачи" id="otziv_area_adaxx299" name="task[comment]" class="di text_area_otziv no_comment_bill22 tyyo gloab"></textarea>';
				
            $query_string.='</div>      
</div>  

        <script type="text/javascript"> 
	  $(function (){ 
$(\'#otziv_area_adaxx299\').autoResize({extraSpace : 10});
$(\'.tyyo\').trigger(\'keyup\');
});

	</script>
	</div>';

	if(!isset($_GET["id"])) {

        $query_string .= '<div class="input-choice-click js-option-task-user js-task-user-sv">
<div class="choice-head">Связать с клиентом<span class="sv-user-taskx js-sv-user-task"><i>→</i><span></span></span></div>
<div class="choice-radio"><div class="center_vert1"><i></i><input name="" id="taskusersv" value="0" type="hidden"></div></div></div>';
    } else
    {

        if(!isset($_GET["pre"])) {
            $query_string .= '<div class="input-choice-click js-option-task-user js-task-user-sv">
<div class="choice-head">Связать с клиентом<span class="sv-user-taskx js-sv-user-task" style="display: inline;"><i>→</i><span>' . $row_work_zz55["fio"] . '</span></span></div>
<div class="choice-radio"><div class="center_vert1"><i class="active_task_cb"></i><input name="" id="taskusersv" value="1" type="hidden"></div></div></div>';
        } else
        {
            $query_string .= '<div class="input-choice-click  js-task-user-sv">
<div class="choice-head">Связать с <span class="sv-user-taskx js-sv-user-task" style="display: inline;"><i>→</i><span>Обращение №' . $row_work_zz55["id"] . '</span></span></div>
<div class="choice-radio"><div class="center_vert1"><i class="active_task_cb"></i><input name="" id="taskusersv" value="1" type="hidden"></div></div></div>';
        }



    }

	
	

$query_string.='</div>';
	 
//форма задачи

$query_string.='</div></div>  <div class="add_sel_yes"><div class="center_vert right_task_ccb" style="width: 100%;"><div class="add_cff js-add-task-but-x">добавить задачу</div>



<div class="task_cb_exit js-exit-window-add-task">


<div class="task_cb_head">
отменить
</div>
</div>

</div></div>		
</div></div></div>';	


//форма добавления подборки
//форма добавления подборки
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

echo $query_string;	
		  
?>
</form>
</div>		


	
 <?	
	
//echo'<div id="no_rd" class="save_button add_say_cb" id_rel="'.$_GET["id"].'"><i>Добавить запись</i></div>';
         

 ?> 		
		
		<!--</div>-->
             
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
	 

	 
$('.money_mask1').inputmask("numeric", {
    radixPoint: ".",
    groupSeparator: " ",
    digits: 2,
    autoGroup: true,
    prefix: '', //No Space, this will truncate the first character
    rightAlign: false,
    oncleared: function () { self.Value(''); }
});
	 

var id_tt=$('.js-tabs-menu').find('.active').attr('id');
	 //alert(id_tt);
		$('.js-tabs_docc').hide();
		$('.js-tabs_'+id_tt).show();	 
	 ToolTip();
	
	 		$(".slct").unbind('click.sys');
		$(".slct").bind('click.sys', slctclick);
		$(".drop").find("li").unbind('click');
		$(".drop").find("li").bind('click', dropli);
	 $('#typesay').unbind('change', changesay);
	 $('#typesay').bind('change', changesay);
	 input_2018();
	 
	 		$('.date_picker_x').inputmask("datetime",{
    mask: "1.2.y", 
    placeholder: "dd.mm.yyyy",  
    separator: ".", 
    alias: "dd.mm.yyyy"
  });
	 
	 		$(".slct").unbind('click.sys');
    $(".slct").bind('click.sys', slctclick);
	$(".drop").find("li").unbind('click');
	$(".drop").find("li").bind('click', dropli);
 
 });