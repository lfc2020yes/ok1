<?php
//форма добавления новой оплаты в финансах

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
if ((count($_GET) != 0)and(count($_GET) != 1))
{
	goto end_code;
}
$status_admin=0;




if ((!$role->permission('Обращения','A'))and($sign_admin!=1))
{
    goto end_code;
}
//составление секретного ключа формы
//составление секретного ключа формы
//соль для данного действия
$token=token_access_compile('2021','bt_add_preorders',$secret);
//составление секретного ключа формы
//составление секретного ключа формы
//составление секретного ключа формы


if((isset($_GET["id"]))) {
//смотрим может ли для этого клиента добавлять задачу
    $sql_tt = 'Select b.id,b.potential,b.fio from k_clients as b where b.id="' . ht($_GET['id']) . '" and b.visible=1 and b.id_a_company IN (' . ht($id_company) . ')';
    $result_t = mysql_time_query($link, $sql_tt);


    $num_results_t = $result_t->num_rows;
    if ($num_results_t == 0) {
        goto end_code;
    } else
    {
        $row_work_zz55 = mysqli_fetch_assoc($result_t);
    }
}




$status=1;



?>
<div id="Modal-one" class="box-modal js-box-modal-two table-modal eddd1 history_window1  client_window"><div class="box-modal-pading">
<div class="top_modal">



  <div class="box-modal_close arcticmodal-close"></div>
  <?
  echo'<h1 class="h111" mor="'.$token.'" for="'.htmlspecialchars(trim($_GET['id'])).'"><span>Новое обращение</span></h1>';
  ?>



</div>
<div class="center_modal">
<?
echo'<form class="js-form-preorders" id="vino_xd_preorders" style=" padding:0; margin:0;" method="post" enctype="multipart/form-data">';
echo'<input type="hidden" value="'.htmlspecialchars(trim($_GET['id'])).'" name="id">';
echo'<input type="hidden" value="'.$token.'" name="tk">';
echo'<input name="tk1" value="dsQ23RStsd2re" type="hidden">';
	//форма добавления задачи
//форма добавления задачи


if(isset($_GET["id"]))
{

    $sha=1;
    if($row_work_zz55['potential']==1)
    {
        $sha=3;
    }

    echo '<input type="hidden" value="'.ht($_GET["id"]).'" class="js-id-client-task" name="preorders[id_client]">';
    echo '<input type="hidden" value="'.$sha.'" class="js-client-type-task" name="preorders[client_type]">';
} else {
    echo '<input type="hidden" value="" class="js-id-client-task" name="preorders[id_client]">';
    echo '<input type="hidden" value="" class="js-client-type-task" name="preorders[client_type]">';
}


echo '<input type="hidden" value="0" class="js-add-task-option" name="preorders[task]">';

$query_string='<div ><div class="add_sel_form add-new-olp" style="position:relative; margin-bottom: 0px; border:0px;">';


$query_string.='<div class="pad10" style="padding: 0; z-index:100;"><span class="bookingBox_gr22"></span></div>';







$query_string.='<div class="mobile-white" style="width:100%;"><div class="form_right_say_one " style="padding:0px; width:100%;">';

if(!isset($_GET["id"])) {
    $query_string .= '<div class="input-choice-click js-option-task-user js-task-user-sv">
<div class="choice-head">Связать с клиентом<span class="sv-user-taskx js-sv-user-task"><i>→</i><span></span></span></div>
<div class="choice-radio"><div class="center_vert1"><i></i><input name="" id="taskusersv" value="0" type="hidden"></div></div></div>';
} else
{
    $query_string .= '<div class="input-choice-click js-option-task-user js-task-user-sv">
<div class="choice-head">Связать с клиентом<span class="sv-user-taskx js-sv-user-task" style="display: inline;"><i>→</i><span>' . $row_work_zz55["fio"] . '</span></span></div>
<div class="choice-radio"><div class="center_vert1"><i class="active_task_cb"></i><input name="" id="taskusersv" value="1" type="hidden"></div></div></div>';
}


//$query_string.='<div class="add_say_two">';



$query_string.='    <!--input start	-->';


 $os_say55 = array();
 $os_id_say55 = array();
	$su_say55=-1;

$query_string.='<div style="margin-top: 30px;
    position: relative;" class="js-zindex js-vid-oper">	';

$query_string.='<div class="left_drop list_2018 menu1_prime"><label class="">Рекламный источник<span>*</span></label><div class="select eddd zin_2019"><a class="slct" list_number="t3" data_src=""></a><ul class="drop js-visible-mt">';

//если оплачивает клиент
//если начальный аванс был наличкой - то остальные платежи только наличкой
//если начальный аванс был не наличкой - то все методы оплаты



$result_8 = mysql_time_query($link,'select A.* from  booking_sourse as A where A.visible=1 and A.id_a_company IN ('.$id_group_company_list.') order by A.displayOrder');

$num_8 = $result_8->num_rows;
//$row_1 = mysqli_fetch_assoc($result2);
if($result_8)
{

	/*
				   $query_string.='<li class="sel_active"><a href="javascript:void(0);"  rel="'.$os_id_say55[array_search(1, $os_id_say55)].'">'.$os_say55[array_search(0, $os_id_say55)].'</a></li>';
	*/

  			  while($row_8 = mysqli_fetch_assoc($result_8)){



				   $query_string.='<li><a href="javascript:void(0);"  rel="'.$row_8["id"].'">'.$row_8["name"].'</a></li>';


			 }
}



		   $query_string.='</ul><input type="hidden" class="gloab " name="type_booking" id="vid_finance" value=""><div class="div_new_2018"><hr class="one"></div></div></div></div>';




		$query_string.='<!--input end	-->';




$query_string.='<!--input start	--><div style="margin-top: 30px;" class="jj-l2"><div class="input_2018"><label>Комментарий<span>&nbsp;</span></label><div class="otziv_add">';
$query_string.='<textarea cols="10" rows="1" placeholder="" id="quies" name="question" class="di text_area_otziv   input_new_2018  gloab  js-autoResize-form" ></textarea>';
$query_string.='</div><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name" joi=""></div></div>';
$query_string.='</div></div><!--input end	-->';


$query_string .= '<div style="margin-top: 30px;" class="input_doc_turs js-zindex">';

    $query_string .= '<div class="input_2018 input-search-list" list_number="s7">
        <i class="js-open-search"></i><span class="click-search-name"></span>
        <label>Страна</label>

        <input name="country" value="" id="date_124" sopen="search_turcity" class="input_new_2018 required  js-keyup-search " autocomplete="off" type="text">

        <input type="hidden" value="0" class="js-hidden-search" name="id_country">

        <ul class="drop drop-search js-drop-search" style="transform: scaleY(0);">';

            $result_work_zz=mysql_time_query($link,'Select a.* from trips_country as a WHERE a.visible=1 ORDER BY a.eye DESC,a.id limit 0,30');
            $num_results_work_zz = $result_work_zz->num_rows;
            if($num_results_work_zz!=0)
            {

                for ($i=0; $i<$num_results_work_zz; $i++)
                {
                    $row_work_zz = mysqli_fetch_assoc($result_work_zz);
                    $query_string .= '<li><a href="javascript:void(0);" rel="'.$row_work_zz["id"].'">'.$row_work_zz["name"].'</a></li>';
                }
            }

    $query_string .= '</ul>

        <div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';





if(($more_city==1)and($_COOKIE["cc_town".$id_user]==0)) {




    ?>

    <?

    $os_say55 = array();
    $os_id_say55 = array();
    $su_say55=-1;

    $query_string.='<div style="margin-top: 30px;" >	';

    $query_string.='<div class="left_drop menu1_prime"><label class="">Организация<span>*</span></label><div class="select eddd zin_2019"><a class="slct" list_number="t1" data_src=""></a><ul class="drop">';


    $result_8 = mysql_time_query($link,'Select a.name,a.id from a_company as a where a.id IN ('.$id_company_sql.')');

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
                $query_string.='<li class="sel_active"><a href="javascript:void(0);"  rel="'.$row_8["id"].'">'.$row_8["name"].'</a></li>';
            } else
            {
                $query_string.='<li><a href="javascript:void(0);"  rel="'.$row_8["id"].'">'.$row_8["name"].'</a></li>';
            }

        }
    }



    $query_string.='</ul><input type="hidden" class="gloab gloab_potential gloab_turist"  name="id_org" id="pol_clients4554" value=""><div class="div_new_2018"><hr class="one"></div></div></div></div>';
    //echo $query_string;


    ?>

    <?







} else
{

    $result_uuyyt = mysql_time_query($link, 'select name from a_company where id="' . ht($id_company) . '"');
    $num_results_uuyyt = $result_uuyyt->num_rows;

    if ($num_results_uuyyt != 0) {
        $row_uuyyt = mysqli_fetch_assoc($result_uuyyt);
    }


    $query_string.='<!--input start	-->	
        <div style="margin-top: 30px;" ><div class="input_2018"><label>Организация<span>*</span></label><input name="id_company_name" value="'.$row_uuyyt["name"].'" readonly id="date_124" class="input_new_2018 required    no_upperr" autocomplete="off" type="text"><input class="gloab gloab_potential gloab_turist" name="id_org" type="hidden" value="'.$id_company.'"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->	';

}



$query_string .= '<div class="input-choice-click js-option-task-user11 js-task-user-sv11">
<div class="choice-head">Добавить связанную задачу</div>
<div class="choice-radio"><div class="center_vert1"><i></i><input name="" id="taskusersv11" value="0" type="hidden"></div></div></div>';




//форма напоминаний
$query_string.='<div class="form-task-02_form2_preorder bg-preorder">';

$query_string.='<div style="margin-top: 30px;">
<div class="input_2018"><label>Дата напоминания</label>

<div class="help_selection js-vibor-date1"><span class="date_help_sele" tabi="'.date("Y").'-'.
    date("m").'-'.
    date("d").'">Сегодня</span><span class="date_help_sele" tabi="'.date("Y", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")+1), date("Y"))).'-'.
    date("m", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")+1), date("Y"))).'-'.
    date("d", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")+1), date("Y"))).'">Завтра</span><span class="date_help_sele" tabi="'.date("Y", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")+2), date("Y"))).'-'.
    date("m", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")+2), date("Y"))).'-'.
    date("d", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")+2), date("Y"))).'">Послезавтра</span></div>

<input readonly="true" name="task_date" value="" id="date_table_gr221" class="input_new_2018 required gloab1" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"></div></div>
</div> 

<input id="date_hidden_table_gr3301"  name="date_sele_task_form2" value="" type="hidden">';


$query_string.='<div class="pad10" style="padding: 0;"><span class="bookingBox_gr221"></span></div>
            
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
<div class="input_2018"><label>Время</label><input name="task_time_form2" value="'.ipost_($time_task,"").'" id="date_124" class="input_new_2018 required time_input gloab1"  autocomplete="off" maxlength="5" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"></div></div>
</div>';




$query_string.='<!--input start	--><div style="margin-top: 30px;" class="jj-l2"><div class="input_2018"><label>Текст напоминания<span>&nbsp;</span></label><div class="otziv_add">';
$query_string.='<textarea cols="10" rows="1" placeholder="" id="task_comment" name="task_comment" class="di text_area_otziv   input_new_2018  gloab1  js-autoResize-form" ></textarea>';
$query_string.='</div><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name" joi=""></div></div>';
$query_string.='</div></div><!--input end	-->';

$query_string.='</div>';

//форма напоминаний конец





$query_string.='</div>';

//форма задачи
if($status_admin==0)
{
    $query_string.='<div class="center_vert right_task_ccb" style="width: 100%; margin-top:20px;"><div class="add_cff_fin js-add-preorder-x">Добавить</div>';
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


 </script>