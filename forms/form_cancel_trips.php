<?php
//форма аннуляции тура

$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';


//создание секрет для формы
/*
$secret=rand_string_string(4);
if(!isset($_SESSION['rema']))
{
    $_SESSION['rema'] = $secret;
} else
{
    $secret=$_SESSION['rema'];
}
*/


$status=0;


   $class_bba='cost_bank1';

if((!isset($_SESSION["user_id"]))or(!is_numeric(id_key_crypt_encrypt($_SESSION["user_id"]))))
{	
	goto end_code;
}

$id_user=id_key_crypt_encrypt($_SESSION["user_id"]);

//проверить есть ли переменная id и можно ли этому пользователю это делать
if (count($_GET) != 1)
{
	goto end_code;	
}
$status_admin=0;




if ((!$role->permission('Туры','U'))and($sign_admin!=1))
{
    goto end_code;	
}

$result_t=mysql_time_query($link,'Select A.id,A.status,A.id_exchange from trips as A where A.visible=1 AND A.id="'.ht($_GET["id"]).'" and A.id_a_company="'.$id_company.'"');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{
    $debug=h4a(5,$echo_r,$debug);
    goto end_code;
} else
{
    $row_score = mysqli_fetch_assoc($result_t);
}

$result_uu_rate=mysql_time_query($link,'select a.char,a.small_name,a.code from booking_exchange as a  where a.id="'.ht($row_score["id_exchange"]).'"');
$num_results_uu_rate = $result_uu_rate->num_rows;

$style_kurs = 0;
$class_change = 'tree';

if($num_results_uu_rate!=0) {
    $row_uu_rate = mysqli_fetch_assoc($result_uu_rate);

    if ($row_uu_rate["char"] == "₽") {
        //рублевый тур

    } else {
        //значит выводим в валюте потому что остаток клиент отдает в валюте
        $style_kurs = 1;
        $class_change = $row_uu_rate["small_name"];
    }
}


//составление секретного ключа формы
//составление секретного ключа формы
//соль для данного действия
$token=token_access_compile($_GET["id"],'bt_cancel_trips',$secret);
//составление секретного ключа формы
//составление секретного ключа формы
//составление секретного ключа формы







$status=1;



?>
<div id="Modal-one" class="box-modal js-box-modal-two table-modal eddd1  client_window"><div class="box-modal-pading">
<div class="top_modal">
	
	
	
  <div class="box-modal_close arcticmodal-close"></div>
  <? 
  echo'<h1 class="h111" mor="'.$token.'" for="'.htmlspecialchars(trim($_GET['id'])).'"><span>Аннуляция тура №'.$_GET["id"].'</span></h1>';
  ?>
  
  
  
</div>
<div class="center_modal">
<?
echo'<form class="js-form-cancel-trips" id="vino_xd_preorders" style=" padding:0; margin:0;" method="post" enctype="multipart/form-data">';
echo'<input type="hidden" value="'.htmlspecialchars(trim($_GET['id'])).'" name="id">';
echo'<input type="hidden" value="'.$token.'" name="tk">';
echo'<input name="tk1" value="dsQ23RStsd2re" type="hidden">';
	//форма добавления задачи
//форма добавления задачи

$query_string='<div ><div class="add_sel_form add-new-olp" style="position:relative; margin-bottom: 0px; border:0px;">';


$query_string.='<div class="pad10" style="padding: 0; z-index:100;"><span class="bookingBox_gr22"></span></div>';







$query_string.='<div class="mobile-white" style="width:100%;"><div class="form_right_say_one " style="padding:0px; width:100%;">';





//$query_string.='<div class="add_say_two">';

if($row_score["status"]==2)
{
    //найдем по какой причине аннулировано
    $result_uut = mysql_time_query($link, 'select * from trips_cancel where id_trips="' . ht($_GET['id']) . '"');
    $num_results_uut = $result_uut->num_rows;

    if ($num_results_uut != 0) {
        $row_uut = mysqli_fetch_assoc($result_uut);
        $su_say=$row_uut["id_why"];
    } else
    {
        $su_say=1;
    }
} else
{
    $su_say=1;
}





$query_string.='    <!--input start	-->';



$os_say = array();
$os_id_say = array();

$result_work_zz=mysql_time_query($link,'Select A.* from trips_why_annulation
 as A where A.visible=1 and A.id_a_company="'.$id_company.'" order by A.displayOrder');
$num_results_work_zz = $result_work_zz->num_rows;
if($num_results_work_zz!=0)
{
    for ($i=0; $i<$num_results_work_zz; $i++)
    {
        $row_work_zz = mysqli_fetch_assoc($result_work_zz);
        array_push($os_say, $row_work_zz["why"]);
        array_push($os_id_say, $row_work_zz["id"]);
    }
}



$query_string.='<div style="margin-top: 30px;
    position: relative;" class="js-zindex js-vid-oper">	';

$query_string.='<div class="left_drop list_2018 menu1_prime"><label class="active_label">Причина аннуляции<span>*</span></label><div class="select eddd zin_2019"><a class="slct" list_number="t3"  data_src="'.$os_id_say[array_search($su_say, $os_id_say)].'">'.$os_say[array_search($su_say, $os_id_say)].'</a><ul class="drop">';

//если оплачивает клиент
//если начальный аванс был наличкой - то остальные платежи только наличкой
//если начальный аванс был не наличкой - то все методы оплаты

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
$query_string.='</ul><input type="hidden" class="gloab js-status-why-cancel" name="id_why"  value="'.$su_say.'"><div class="div_new_2018"><hr class="one"></div></div></div></div>';





		$query_string.='<!--input end	-->';





$query_string.='<!--input start	-->		
<div style="margin-top: 30px;" class="rates_visible"><div class="input_2018"><label>ФПР туроператора</label><input name="com_proc" value="0" id="date_124" class="input_new_2018 required   money_mask1 " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="'.$class_change.'"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->';


$query_string.='<!--input start	-->		
<div style="margin-top: 30px;" class="rates_visible"><div class="input_2018"><label>Общая стоимость тура для туриста при аннуляции</label><input name="com_rub" value="0" id="date_124" class="input_new_2018 required   money_mask1 " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="'.$class_change.'"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->';





$query_string.='    <!--input start	-->';


$su_say=0;
$os_say = array('—');
$os_id_say = array('0');

$result_work_zz=mysql_time_query($link,'Select A.* from trips_cancel_refund
 as A where A.visible=1 and A.id_a_company="'.$id_company.'" order by A.displayOrder');
$num_results_work_zz = $result_work_zz->num_rows;
if($num_results_work_zz!=0)
{
    for ($i=0; $i<$num_results_work_zz; $i++)
    {
        $row_work_zz = mysqli_fetch_assoc($result_work_zz);
        array_push($os_say, $row_work_zz["name"]);
        array_push($os_id_say, $row_work_zz["id"]);
    }
}



$query_string.='<div style="margin-top: 30px;
    position: relative;" class="js-zindex js-vid-oper">	';

$query_string.='<div class="left_drop list_2018 menu1_prime"><label class="active_label">Возврат</label><div class="select eddd zin_2019"><a class="slct" list_number="t3"  data_src="'.$os_id_say[array_search($su_say, $os_id_say)].'">'.$os_say[array_search($su_say, $os_id_say)].'</a><ul class="drop">';

//если оплачивает клиент
//если начальный аванс был наличкой - то остальные платежи только наличкой
//если начальный аванс был не наличкой - то все методы оплаты

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
$query_string.='</ul><input type="hidden" class="js-status-refund" name="id_refund"  value="'.$su_say.'"><div class="div_new_2018"><hr class="one"></div></div></div></div>';





$query_string.='<!--input end	-->';




$query_string.='<div style="margin-top: 30px;">
<div class="input_2018"><label>Дата заявления на возврат/перенос</label>

<div class="help_selection js-vibor-date"><span class="date_help_sele" tabi="'.date("Y").'-'.
    date("m").'-'.
    date("d").'">Сегодня</span><span class="date_help_sele" tabi="'.date("Y", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-1), date("Y"))).'-'.
    date("m", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-1), date("Y"))).'-'.
    date("d", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-1), date("Y"))).'">Вчера</span><span class="date_help_sele" tabi="'.date("Y", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-2), date("Y"))).'-'.
    date("m", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-2), date("Y"))).'-'.
    date("d", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-2), date("Y"))).'">Позавчера</span></div>

<input readonly="true" name="task[task_date]" value="" id="date_table_gr22" class="input_new_2018 required" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"></div></div>
</div> 

<input id="date_hidden_table_gr3300"  name="buy_date" value="" type="hidden">';


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
minDate: "-2m", maxDate: "0d",
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
                position: \'fixed\',
				top: 0,
                left: 0,
                right:0,
                margin:\'auto\',
                width: \'60%\',
                \'box-shadow\': \'0 10px 100px #c6c6c6\',
                \'z-index\': 10001
       
                
            });
		
/*
		var html = $(\'.ui-datepicker:last\'); 
		//$(\'.ui-datepicker\').remove();
		$(\'.bookingBox_gr22\').append(html);
		*/
 
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
	 
</script>';




$query_string.='</div>';
	 
//форма задачи
if($status_admin==0)
{
    $query_string.='<div class="center_vert right_task_ccb" style="width: 100%; margin-top:20px;"><div class="add_cff_fin js-cancel-trips-x">Сохранить</div>';
}


$query_string.='<div class="task_cb_exit js-exit-window-add-task"  style="background-color: #eeefee;">


<div class="task_cb_head">
отменить
</div>
</div>';
//$query_string.='</div> ';




$query_string.='</div></div></div>';


//форма добавления подборки
//форма добавления подборки
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

echo $query_string;	
		  
?>
</form>
    <?

    echo'<form id="js-form-add-fin" action="" method="POST" enctype="multipart/form-data"><input name="status" value="doc" type="hidden"></form>';

    ?>
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
     Zindex();
	 
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
     $('.js-box-modal-two').on("change keyup input click",'.js-vibor-date1 span',js_vibor_date1);	//быстрые даты
	 		$(".slct").unbind('click.sys');
		$(".slct").bind('click.sys', slctclick);
		$(".drop").find("li").unbind('click');
		$(".drop").find("li").bind('click', dropli);
	 $('#typesay').unbind('change', changesay);
	 $('#typesay').bind('change', changesay);
	 input_2018();
     AutoResizeTF();

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