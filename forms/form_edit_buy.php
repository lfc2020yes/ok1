<?php
//форма добавления новой оплаты по туру

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
if (count($_GET) != 2)
{
	goto end_code;	
}

$status_admin=0;
$result_t=mysql_time_query($link,'Select A.id,A.id_exchange,A.status_admin from trips as A where A.visible=1 AND A.id="'.ht($_GET["id"]).'" and A.id_a_company IN ('.$id_company.')');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{
    $debug=h4a(5,$echo_r,$debug);
    goto end_code;

} else
{
    $row_score = mysqli_fetch_assoc($result_t);
    $status_admin=$row_score['status_admin'];
}






$mas_responsible=array();
$result_uu = mysql_time_query($link, 'select A.id_user  from trips_payment as A where A.id="' . ht($_GET['id_buy']) . '"');
$num_results_uu = $result_uu->num_rows;

if ($num_results_uu != 0) {
    $row_uu = mysqli_fetch_assoc($result_uu);
    array_push($mas_responsible,$row_uu["id_user"]);
} else
{
    $debug=h4a(95,$echo_r,$debug);
    goto end_code;
}



$tabs_menu_x_visible[4]=0;
if($row_uu["id_user"]!=0)
{
    if(($sign_admin!=1))
    {

        if($row_uu["id_user"]==$id_user)
        {
            $tabs_menu_x_visible[4]="1";
        }

        if (in_array($id_user, $mas_responsible))
        {
            $tabs_menu_x_visible[4]="1";
        } else
        {
            //может он управляющий кого то кто должен выполнить эту задачу тогда ему тоже можно ее выполнить
            $subo_x = array();
            foreach ($mas_responsible as $key => $value)
            {
                $subo_x = array_merge($subo_x, all_chief($value,$link));

            }
            $subo_x= array_unique($subo_x);


            if ((in_array($id_user, $subo_x)))
            {
                $tabs_menu_x_visible[4]="1";
            }

        }
    }  else
    {
        $tabs_menu_x_visible[4]="1";
    }

}

if($tabs_menu_x_visible[4]!="1")
{
    $debug=h4a(6,$echo_r,$debug);
    goto end_code;
}


if ((!$role->permission('Туры','U'))and($sign_admin!=1))
{
    goto end_code;
}
//составление секретного ключа формы
//составление секретного ключа формы
//соль для данного действия
$token=token_access_compile($_GET['id_buy'],'bt_edit_21',$secret);
//составление секретного ключа формы
//составление секретного ключа формы
//составление секретного ключа формы







$status=1;

$result_uu_rate=mysql_time_query($link,'select a.char,a.small_name,a.code from booking_exchange as a  where a.id="'.ht($row_score["id_exchange"]).'"');
$num_results_uu_rate = $result_uu_rate->num_rows;

if($num_results_uu_rate!=0) {
    $row_uu_rate = mysqli_fetch_assoc($result_uu_rate);
}

$style_kurs=0; //рублевый тур по умолчанию
if ($row_uu_rate["char"] != "₽") {
//значит выводим в валюте потому что остаток клиент отдает в валюте
    $style_kurs=1;

}

?>
<div id="Modal-one" class="box-modal table-modal eddd1 buy_trips_window1 client_window"><div class="box-modal-pading">
<div class="top_modal">
	
	
	
  <div class="box-modal_close arcticmodal-close"></div>
  <? 
  echo'<h1 class="h111" mor="'.$token.'" for="'.htmlspecialchars(trim($_GET['id_buy'])).'"><span>Изменение оплаты №'.$_GET["id_buy"].' по туру №'.$_GET["id"].'</span></h1>';

  //token_access_compile($_GET['id_buy'],'bt_edit_21',$secret);

  ?>
  
  
  
</div>
<div class="center_modal"><div class="mobile-white">
<?
echo'<form class="js-form-pay-trips" id="vino_xd_trips_pay_edit" style=" padding:0; margin:0;" method="post" enctype="multipart/form-data">';
echo'<input type="hidden" value="'.htmlspecialchars(trim($_GET['id_buy'])).'" name="id">';
echo'<input type="hidden" value="'.$token.'" name="tk">';
echo'<input name="tk1" value="dsQ679RSadfd2re" type="hidden">';
	//форма добавления задачи
//форма добавления задачи




//echo $query_string;




$query_string='<div >';


$query_string.='<div class="pad10" style="padding: 0; z-index:100;"><span class="bookingBox_gr22"></span></div>';



$result_uu = mysql_time_query($link, 'select A.*,B.name from trips_payment as A, booking_payment_method as B where A.id="'.ht($_GET["id_buy"]).'" and A.id_payment_method=B.id');

$num_results_uu = $result_uu->num_rows;

if ($result_uu) {
    $i = 0;
    $row_uu = mysqli_fetch_assoc($result_uu);

        include $url_system.'tours/code/block_buy.php';

}



$query_string.='<div class="form_right_say_one " style="width:100%;">';

$class_pass_1='';
$class_pass_2='';
$cdla1='';
$cdla2='';
$komy=0;
if($row_uu["who"]==0)
{
    $class_pass_1='active_pass';
    $cdla1='active_task_cb';

    $komy=1;
}
if($row_uu["who"]==1)
{
    $class_pass_2='active_pass';
    $komy=2;
    $cdla2='active_task_cb';
}
$query_string.='<!--input start	-->		
<div class="password_turs">
<div id="1" class="input-choice-click-pass js-password-butt js-click-mmmt '.$class_pass_1.'">
<div class="choice-head">От туриста</div>
<div class="choice-radio"><div class="center_vert1"><i class="'.$cdla1.'"></i></div></div>
</div>	

<div id="2" class="input-choice-click-pass js-password-butt js-click-mmmt '.$class_pass_2.'">
<div class="choice-head">Туроператору</div>
<div class="choice-radio"><div class="center_vert1"><i class="'.$cdla2.'"></i></div></div>
</div>
<input name="kto_komy" class="komy_trips" value="'.$komy.'" type="hidden">	
</div>		
<!--input end -->';

//<!--input start	-->

       $os4 = array('оплата','возврат');
	   $os_id4 = array('1','2');




		$su_4=$row_uu["id_operation"];  //id значения (не порядковый номер в массиве $os_id4)
		/*
		if (( isset($_COOKIE["su_4c".$id_user]))and(is_numeric($_COOKIE["su_4c".$id_user]))and(array_search($_COOKIE["su_4c".$id_user],$os_id4)!==false))
		{
			$su_4=$_COOKIE["su_4c".$id_user];
		}
	 */
$query_string.='<div style="margin-top: 30px; ">	';

$query_string.='<div class="left_drop menu1_prime"><label class="active_label">Тип операции<span>*</span></label><div class="select eddd zin_2019"><a class="slct" list_number="t2" data_src="'.$os_id4[array_search($su_4, $os_id4)].'">'.$os4[array_search($su_4, $os_id4)].'</a><ul class="drop">';


   for ($i=0; $i<count($os4); $i++)
             {
			   if($su_4==$os_id4[$i])
			   {
				   $query_string.='<li class="sel_active"><a href="javascript:void(0);" rel="'.$os_id4[$i].'">'.$os4[$i].'</a></li>';
			   } else
			   {
				   $query_string.='<li><a href="javascript:void(0);" rel="'.$os_id4[$i].'">'.$os4[$i].'</a></li>';
			   }

			 }



		   $query_string.='</ul><input type="hidden" class="gloab"  name="operation" id="exchange_rates" value="'.$os_id4[array_search($su_4, $os_id4)].'"><div class="div_new_2018_"><hr class="one"></div></div></div></div>';



//		<!--input end	-->

$query_string.='<!--input start	-->		
	<div style="margin-top: 30px;" class="jj-l2"><div class="input_2018"><label>Сумма оплаты (рубли)<span>*</span></label><input name="summ" value="'.$row_uu["sum"].'" id="date_124" class="input_new_2018 required gloab money_mask1 js-upload-kurs js-upload-kurs1" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="tree"><div class="oper_name" joi=""></div></div></div>
</div>
<!--input end	-->';

if($style_kurs==1) {

    $query_string .= '<!--input start	-->		
<div style="margin-top: 30px;" ><div class="input_2018"><label>Курс '.$row_uu_rate["small_name"].'<span>*</span></label><input name="curs" value="'.$row_uu["rate"].'" id="date_124" char="'.$row_uu_rate["char"].'" class="input_new_2018 required gloab money_mask1 js-upload-kurs js-upload-kurs2" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="tree"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->';

}

$query_string.='<div class="flexx">
<div class="tolko_50">';

$query_string.='<!--input start	-->		
<div style="margin-top: 30px;" class="rates_visible"><div class="input_2018"><label>Комиссия за операцию</label><input name="com_proc" value="0" id="date_124" class="input_new_2018 required   money_mask1 js-active-label js-comm-proc" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="four"><hr class="strelka"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->';

$query_string.='</div>
<div class="tolko_50">';
$query_string.='<!--input start	-->		
<div style="margin-top: 30px;" class="rates_visible"><div class="input_2018 active-commi-buy1"><label>Итого комиссия</label><input name="com_rub" value="'.$row_uu["commission"].'" id="date_124" class="input_new_2018 required   money_mask1 js-active-label js-comm-rub" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="tree"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->';
$query_string.='</div>
</div>';

$query_string.='<div class="add_say_two">';



$query_string.='    <!--input start	-->';


 $os_say55 = array();
 $os_id_say55 = array();
	$su_say55=$row_uu["id_payment_method"];

$query_string.='<div style="margin-top: 30px; z-index: 12;
    position: relative;" class="js-zindex">	';

$query_string.='<div class="left_drop list_2018 menu1_prime"><label class="active_label">Способ оплаты<span>*</span></label><div class="select eddd zin_2019"><a class="slct" list_number="t1" data_src="'.$su_say55.'">'.$row_uu["name"].'</a><ul class="drop js-visible-mt">';

//если оплачивает клиент
//если начальный аванс был наличкой - то остальные платежи только наличкой
//если начальный аванс был не наличкой - то все методы оплаты


//определяем что начальная оплата наличкой
$nall=0;
$result_uu3 = mysql_time_query($link, 'select C.nall,A.id from trips_payment as A,booking_payment_method as C where C.id=A.id_payment_method and A.who=0 and A.id_trips="'.ht($_GET['id']).'" and A.id_operation=1 and A.visible=1 order by A.date_payment limit 1');
$num_results_uu3 = $result_uu3->num_rows;

if ($num_results_uu3 != 0) {
    $row_uu3 = mysqli_fetch_assoc($result_uu3);
    if(($row_uu3["nall"]==0)and($row_uu3["id"]!=$_GET["id_buy"]))
    {
        $nall=1;
    }
}


$result_8 = mysql_time_query($link,'select A.* from  booking_payment_method as A where A.visible=1 order by A.displayOrder');

$num_8 = $result_8->num_rows;
//$row_1 = mysqli_fetch_assoc($result2);
if($result_8)
{

	/*
				   $query_string.='<li class="sel_active"><a href="javascript:void(0);"  rel="'.$os_id_say55[array_search(1, $os_id_say55)].'">'.$os_say55[array_search(0, $os_id_say55)].'</a></li>';
	*/

  			  while($row_8 = mysqli_fetch_assoc($result_8)){


  			      if($su_say55==$row_8["id"])
			   {
				   $query_string.='<li class="sel_active"><a href="javascript:void(0);" nall="'.$row_8["nall"].'"  rel="'.$row_8["id"].'">'.$row_8["name"].'</a></li>';
			   } else
			   {
				   $query_string.='<li><a href="javascript:void(0);" nall="'.$row_8["nall"].'" rel="'.$row_8["id"].'">'.$row_8["name"].'</a></li>';
			   }

			 }
}



		   $query_string.='</ul><input type="hidden" class="gloab js_trips_payment_method" nall="'.$nall.'"  name="method" id="pol_clients" value="'.$su_say55.'"><div class="div_new_2018"><hr class="one"></div></div></div></div>';




		$query_string.='<!--input end	-->';



$query_string.='<div style="margin-top: 30px;">
<div class="input_2018"><label>Дата оплаты<span>*</span></label>

<div class="help_selection js-vibor-date"><span class="date_help_sele" tabi="'.date("Y").'-'.
					date("m").'-'.
					date("d").'">Сегодня</span><span class="date_help_sele" tabi="'.date("Y", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-1), date("Y"))).'-'.
					date("m", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-1), date("Y"))).'-'.
					date("d", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-1), date("Y"))).'">Вчера</span><span class="date_help_sele" tabi="'.date("Y", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-2), date("Y"))).'-'.
					date("m", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-2), date("Y"))).'-'.
					date("d", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-2), date("Y"))).'">Позавчера</span></div>

<input readonly="true" name="task[task_date]" value="" id="date_table_gr22" class="input_new_2018 required gloab" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"></div></div>
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



$query_string.='<div style="margin-top: 30px;">';

      $query_string.='<div class="div_textarea_otziv1 js-prs" >
			<div class="otziv_add">';
                 
                   
        $query_string.='<textarea cols="10" rows="1" placeholder="Комментарий" id="otziv_area_adaxx299" name="comment" class="di text_area_otziv no_comment_bill22 tyyo">'.$row_uu["comment"].'</textarea>';
				
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
if($status_admin==0)
{
$query_string.='<div class="center_vert right_task_ccb" style="width: 100%; margin-top:20px;"><div class="add_cff_buy js-edit-buy-trips-but-x">Изменить</div>';
}



$query_string.='<div class="task_cb_exit js-exit-window-add-task"  style="background-color: #fff;">


<div class="task_cb_head">
отменить
</div>
</div></div></div>';



$query_string.=' 		
</div></div>';


//форма добавления подборки
//форма добавления подборки










$query_string.='<script type="text/javascript">
 $(document).ready(function(){';


if($row_uu["date_payment"]!='')
{

    $query_string.='var date_v11=\''.$row_uu["date_payment"].'\';';
    $query_string.='$(\'#date_hidden_table_gr3300\').val(\''.$row_uu["date_payment"].'\');';

    $query_string.='var dateParts = date_v11.match(/(\d+)/g), realDate = new Date(dateParts[0], dateParts[1] -1, dateParts[2]);';


    $query_string.="$('#date_table_gr22').datepicker({ dateFormat: 'yy-mm-dd' });		
$('#date_table_gr22').datepicker('setDate', realDate);	";


}


$query_string.="input_2018(); });
	 </script>";







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
	 
nall_buy_tips(1);

$('.js-form-pay-trips').find('.js-upload-kurs2,.js-comm-rub').trigger('click');

	 
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