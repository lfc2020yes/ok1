<?
session_start();
$url_system=$_SERVER['DOCUMENT_ROOT'].'/'; include_once $url_system.'module/config.php'; include_once $url_system.'module/function.php'; include_once $url_system.'login/function_users.php'; initiate($link); include_once $url_system.'module/access.php';


//правам к просмотру к действиям
$hie = new hierarchy($link,$id_user);
//echo($id_user);
$hie_object=array();
$hie_town=array();
$hie_kvartal=array();
$hie_user=array();
$hie_object=$hie->obj;
$hie_kvartal=$hie->id_kvartal;
$hie_town=$hie->id_town;
$hie_user=$hie->user;

$sign_level=$hie->sign_level;
$sign_admin=$hie->admin;

$role->GetColumns();
$role->GetRows();
$role->GetPermission();
//правам к просмотру к действиям

$active_menu='statistic';  // в каком меню


$count_write=20;

$edit_price=0;
if ($role->is_column_edit('n_material','price'))
{
	$edit_price=1;
}


$echo_r=1; //выводить или нет ошибку 0 -нет
$error_header=0;
$url_404=$_SERVER['REQUEST_URI'];
//echo($url_404);
$D_404 = explode('/', $url_404);

//index.php не должно быть в $url_404
if (strripos($url_404, 'index.php') !== false) {
   header404(1,$echo_r);
}

//**************************************************
if (( count($_GET) != 1 )and( count($_GET) != 0 ) )
{
   header404(2,$echo_r);
}

if((!$role->permission('Статистика','R'))and($sign_admin!=1))
{
  header404(3,$echo_r);
}



if($error_header==404)
{
	include $url_system.'module/error404.php';
	die();
}

//проверка адреса сайта на существование такой страницы
//проверка адреса сайта на существование такой страницы
//проверка адреса сайта на существование такой страницы

include_once $url_system.'template/html.php'; include $url_system.'module/seo.php';

if($error_header!=404){ SEO('statistic','','','',$link); } else { SEO('0','','','',$link); }

include_once $url_system.'module/config_url.php'; include $url_system.'template/head.php';
?>
</head><body>
<?
echo'<div class="alert_wrapper"><div class="div-box"></div></div>';
include_once $url_system.'template/body_top.php';
?>
<div class="container">
<?
		if ( isset($_COOKIE["iss"]))
		{
          if($_COOKIE["iss"]=='s')
		  {
			  echo'<div class="iss small">';
		  } else
		  {
			  echo'<div class="iss big">';
		  }
		} else
		{
			echo'<div class="iss small">';
		}

?>

<div class="left_block">
	<?

  echo'<div class="content" iu="'.$id_user.'">';


                $act_='display:none;';
	            $act_1='';
	            if(cookie_work('it_','on','.',60,'0'))
	            {
		            $act_='';
					$act_1='on="show"';
	            }

	  include_once $url_system.'template/top_statistic.php';


     echo'<div id="fullpage" class="margin_60" id_content="'.$id_user.'">';

	?>
 <div class="section" id="section1">


     <?
     if((!isset($_GET['tabs'])))
     {
     ?>

	<div class="oka_block_2019" style="min-height:auto !important;">

 <div class="line_mobile_blue">
	 <?
     if(($sign_admin==1)or($sign_level>1))
     {
         echo'Статистика ваших менеджеров';
     } else
     {
         echo'Ваша Статистика';
     }
?>
 <span class="menu-09-count1"></span> </div>

<div class="div_ook hop_ds"><div class="search_task">

    <?




	   $zindex=110;


       $os2 = array( "Текущий месяц","Прошлый месяц","-2 месяца","Выбрать период");
	   $os_id2 = array("0","1","3","2");

    $os2 = array("Текущий месяц","Прошлый месяц","За ".month_rus1(date_step_sql('m', '-2m')).' '.date_step_sql('Y', '-2m').'г.',"За ".month_rus1(date_step_sql('m', '-3m')).' '.date_step_sql('Y', '-3m').'г.'
    ,"За ".month_rus1(date_step_sql('m', '-4m')).' '.date_step_sql('Y', '-4m').'г.'
    ,"За ".month_rus1(date_step_sql('m', '-5m')).' '.date_step_sql('Y', '-5m').'г.'
    ,"За ".month_rus1(date_step_sql('m', '-6m')).' '.date_step_sql('Y', '-6m').'г.'
    ,"За ".month_rus1(date_step_sql('m', '-7m')).' '.date_step_sql('Y', '-7m').'г.'
    ,"За ".month_rus1(date_step_sql('m', '-8m')).' '.date_step_sql('Y', '-8m').'г.'
    ,"За ".month_rus1(date_step_sql('m', '-9m')).' '.date_step_sql('Y', '-9m').'г.'
    ,"За ".month_rus1(date_step_sql('m', '-10m')).' '.date_step_sql('Y', '-10m').'г.'
    ,"За ".month_rus1(date_step_sql('m', '-11m')).' '.date_step_sql('Y', '-11m').'г.'
    ,"За ".month_rus1(date_step_sql('m', '-12m')).' '.date_step_sql('Y', '-12m').'г.'
    );
    $os_id2 = array("0","1","3","4","5","6","7","8","9","10","11","12","13");

		$su_2=0;
		$date_su='';
		if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and(array_search($_COOKIE["su_2s".$id_user],$os_id2)!==false))
		{
			$su_2=$_COOKIE["su_2s".$id_user];
		}
		$val_su2=$os2[array_search($su_2, $os_id2)];


		if ( isset($_COOKIE["sudds".$id_user]))
		{
			//$date_base__=explode(".",$_COOKIE["sudds"]);
		if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==2))
		{
			$date_su=$_COOKIE["sudds_mor".$id_user];
			$val_su2=$_COOKIE["sudds_mor".$id_user];
		}
		}

		$class_js_readonly ??= '';
	    $class_js_search ??='';

		echo'<input id="date_hidden_table" '.$class_js_readonly.' name="date" value="'.$date_su.'" type="hidden"><input id="date_hidden_start" name="start_date" type="hidden"><input id="date_hidden_end" name="end_date" type="hidden">';

		   echo'<div class="left_drop menu1_prime book_menu_sel gop_io js--sort js-call-no-v'.$class_js_search.'" style="z-index:'.$zindex.'"><label>Период</label><div class="select eddd"><a class="slct" list_number="t2" data_src="'.$os_id2[array_search(($_COOKIE["su_2s".$id_user] ?? ''), $os_id2)].'">'.$val_su2.'</a><ul class="drop">';

			$zindex--;

		   for ($i=0; $i<count($os2); $i++)
             {
			   if($su_2==$os_id2[$i])
			   {
				   echo'<li class="sel_active"><a href="javascript:void(0);"  rel="'.$os_id2[$i].'">'.$os2[$i].'</a></li>';
			   } else
			   {
				  echo'<li><a href="javascript:void(0);"  rel="'.$os_id2[$i].'">'.$os2[$i].'</a></li>';
			   }

			 }
		   echo'</ul><input type="hidden" '.$class_js_readonly.' name="sort2s" id="sort2s" value="'.$os_id2[$su_2].'"></div></div>';



    if(($sign_admin==1)or($sign_level>1))
	{


 $os5 = array( "Общая статистика");
	   $os_id5 = array("0");

if($sign_level==2)
{
    array_push($os5,"Моя статистика");
    array_push($os_id5,$id_user);
}

        $mass_ei=users_hierarchy($id_user,$link);
        rm_from_array($id_user,$mass_ei);
        $mass_ei= array_unique($mass_ei);


        foreach ($mass_ei as $keys => $value)
        {
            $result_work_zz=mysql_time_query($link,'Select a.name_small,a.id from r_user as a,r_role as b where a.id_role =b.id and ((b.role="works")or(b.role="gworks")) and a.id="'.$value.'" and a.enabled=1');
            $num_results_work_zz = $result_work_zz->num_rows;
            if($num_results_work_zz!=0)
            {

                for ($i=0; $i<$num_results_work_zz; $i++)
                {
                    $row_work_zz = mysqli_fetch_assoc($result_work_zz);
                    array_push($os5, $row_work_zz["name_small"]);
                    array_push($os_id5, $row_work_zz["id"]);
                }
            }

        }



		$su_5=0;
		if (( isset($_COOKIE["su_5s".$id_user]))and(is_numeric($_COOKIE["su_5s".$id_user]))and(array_search($_COOKIE["su_5s".$id_user],$os_id5)!==false))
		{
			$su_5=$_COOKIE["su_5s".$id_user];
			//echo($su_5);
		}


		   echo'<div class="left_drop menu1_prime book_menu_sel gop_io js--sort '.$class_js_search.'" style="z-index:'.$zindex.'"><label>менеджер</label><div class="select eddd"><a class="slct" list_number="t5" data_src="'.$os_id5[array_search($_COOKIE["su_5s".$id_user], $os_id5)].'">'.$os5[array_search($_COOKIE["su_5s".$id_user], $os_id5)].'</a><ul class="drop">';
	//$os_id2[array_search($su_2, $os_id2)]
			$zindex--;

		   for ($i=0; $i<count($os5); $i++)
             {
			   if($su_5==$os_id5[$i])
			   {
				   echo'<li class="sel_active"><a href="javascript:void(0);"  rel="'.$os_id5[$i].'">'.$os5[$i].'</a></li>';
			   } else
			   {
				  echo'<li><a href="javascript:void(0);"  rel="'.$os_id5[$i].'">'.$os5[$i].'</a></li>';
			   }

			 }
		   echo'</ul><input type="hidden" '.$class_js_readonly.' name="sort5s" id="sort5s" value="'.$os5[$su_5].'"></div></div>';

			}

		 echo'<div class="inline_reload js-reload-top"><a href="statistic_new/" class="show_reload">Применить</a></div>';


    if(($sign_level==3)or($sign_leve==4)) {
        echo '<div class="left_drop menu1_prime book_menu_sel gop_io js--sort '.$class_js_search.'" style="z-index:'.$zindex.'"><a href="CRON/bonus_reload_statistic.php" class="search-count-csv reload-bonus-oo">Обновить бонусы</a></div>';
    }

		//echo'<a href="statistic/" class="show_sort_supply">Применить</a>';
		?>
		<!--<div id="date_table" class="table_suply_x"></div>-->
	<!--<input readonly="true" id="date_table" class="table_suply_x">-->

	<div class="pad10" style="padding: 0;"><span class="bookingBox_range"><div id="date_table" class="table_suply_x_st"></div></span></div>
<script type="text/javascript" src="Js/jquery-ui-1.9.2.custom.min.js"></script>
	<script type="text/javascript" src="Js/jquery.datepicker.extension.range.min.js"></script>
<script type="text/javascript">
(function ($) {
    $.extend($.datepicker, {

        // Reference the orignal function so we can override it and call it later
        _inlineDatepicker2: $.datepicker._inlineDatepicker,

        // Override the _inlineDatepicker method
        _inlineDatepicker: function (target, inst) {

            // Call the original
            this._inlineDatepicker2(target, inst);

            var beforeShow = $.datepicker._get(inst, 'beforeShow');

            if (beforeShow) {
                beforeShow.apply(target, [target, inst]);
            }
        }
    });
}(jQuery));

var disabledDays = [];
 $(document).ready(function(){

window.date_picker_step=0;


$("#date_table").datepicker({
range: 'period', // режим - выбор периода
numberOfMonths: 2,
autoclose: true,
minDate: "-1Y", maxDate: "+0D",
onSelect: function(dateText, inst, extensionRange) {

	$('#date_table').val(jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.startDate) + ' - ' + jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.endDate));

	var iu=$('.content').attr('iu');
	$.cookie("sudds_mor"+iu, null, {path:'/',domain: window.is_session,secure: false});
CookieList("sudds_mor"+iu,jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.startDate) + ' - ' + jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.endDate),'add');


	$('#date_hidden_start').val(jQuery.datepicker.formatDate('yy-mm-dd',extensionRange.startDate));
	$('#date_hidden_end').val(jQuery.datepicker.formatDate('yy-mm-dd',extensionRange.endDate));

	$('[list_number=t2]').empty().append(jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.startDate) + ' - ' + jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.endDate));
		$.cookie("sudds"+iu, null, {path:'/',domain: window.is_session,secure: false});
CookieList("sudds"+iu,$('#date_hidden_start').val()+'/'+$('#date_hidden_end').val(),'add');
		$('.show_sort_supply').removeClass('active_supply');
$('.show_sort_supply').addClass('active_supply');

	window.date_picker_step++;
	if(window.date_picker_step==2)
		{
	//$('#date_table').сlose();
			//$('.datepicker').hide();
	window.date_picker_step=0;
			setTimeout ( function () { $('.bookingBox_range').hide(); }, 1000 );

		}
    },


beforeShow: function(textbox, instance){
setTimeout(function() {
            instance.dpDiv.css({
				width:'100%'
            });
	$('.bookingBox_range').css({
				display:'none'
            });

        }, 10);


<?
if((isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==2))
{
$date_range=explode("/",$_COOKIE["sudds".$id_user]);
echo'var st=\''.ipost_($date_range[0],'').'\';
var st1=\''.ipost_($date_range[1],'').'\';
var st2=\''.ipost_($_COOKIE["sudds_mor".$id_user],'').'\';';
echo'jopacalendar(st,st1,st2);';
}
?>


}

 });




	 });
function resizeDatepicker() {
	//$('.ui-datepicker').width('100%');
}

function jopacalendar(queryDate,queryDate1,date_all)
	{

if(date_all!='')
	{
var dateParts = queryDate.match(/(\d+)/g), realDate = new Date(dateParts[0], dateParts[1] -1, dateParts[2]);
var dateParts1 = queryDate1.match(/(\d+)/g), realDate1 = new Date(dateParts1[0], dateParts1[1] -1, dateParts1[2]);
		//alert(realDate);
$('#date_table').datepicker('setDate', [realDate,realDate1]);
$('#date_table').val(date_all);
		//alert($('#date_table').val());
	}
	}




 </script>

</div></div></div>
     <?
     } else
     {
     //по неделям поиск
     ?>


         	<div class="oka_block_2019" style="min-height:auto !important;">

 <div class="line_mobile_blue">
	 <?

         echo'Статистика по неделям';

?>
     <span class="menu-09-count1"></span> </div>

    <div class="div_ook hop_ds"><div class="search_task">

            <?
/*
            $rangeStart = new DateTime('Monday last week');  //начало прошлой недели
            $rangeEnd = new DateTime('Sunday last week');   //конец прошлой недели

            echo($rangeStart->format('Y-m-d'));
            echo($rangeEnd->format('Y-m-d'));


            $rangeStart = new DateTime('Monday this week');  //начало прошлой недели
            $rangeEnd = new DateTime('Sunday this week');   //конец прошлой недели
            echo($rangeStart->format('Y-m-d'));
            echo($rangeEnd->format('Y-m-d'));
*/

            $start_date_o='';
            $end_date_o='';

            $zindex=110;


            $os2 = array( "Текущая неделя","Прошлая неделя","Выбрать период");
            $os_id2 = array("0","6","2");

            $su_2=0;
            $date_su='';
            if (( isset($_COOKIE["su_2tu_nn".$id_user]))and(is_numeric($_COOKIE["su_2tu_nn".$id_user]))and(array_search($_COOKIE["su_2tu_nn".$id_user],$os_id2)!==false))
            {
                $su_2=$_COOKIE["su_2tu_nn".$id_user];
            }
            $val_su2=$os2[array_search($su_2, $os_id2)];

            if($su_2==0)
            {
                //текущая неделя
                $rangeStart = new DateTime('Monday this week');  //начало прошлой недели
                $rangeEnd = new DateTime('Sunday this week');   //конец прошлой недели
                $start_date_o=$rangeStart->format('Y-m-d');
                $end_date_o=$rangeEnd->format('Y-m-d');
            }
            if($su_2==6)
            {
                //текущая неделя
                $rangeStart = new DateTime('Monday last week');  //начало прошлой недели
                $rangeEnd = new DateTime('Sunday last week');   //конец прошлой недели
                $start_date_o=$rangeStart->format('Y-m-d');
                $end_date_o=$rangeEnd->format('Y-m-d');
            }


            if ( isset($_COOKIE["suddtu_nn".$id_user]))
            {
                //$date_base__=explode(".",$_COOKIE["sudds"]);
                if (( isset($_COOKIE["su_2tu_nn".$id_user]))and(is_numeric($_COOKIE["su_2tu_nn".$id_user]))and($_COOKIE["su_2tu_nn".$id_user]==2))
                {
                    $date_su=$_COOKIE["suddtu_mor_nn".$id_user];
                    $val_su2=$_COOKIE["suddtu_mor_nn".$id_user];
                    $valdd=$_COOKIE["suddtu_nn".$id_user];
                    $date_massdd = explode("/", $valdd);
                    $start_date_o=$date_massdd[0];
                    $end_date_o=$date_massdd[1];
                }
            }
            $class_js_readonly ??= '';
            $class_js_search ??= '';

            $_COOKIE["su_2tu_nn".$id_user] ??= '';


            $class_js_search='';
            $class_js_readonly='';
            /*
            if((( isset($_COOKIE["su_7cu_nn".$id_user]))and($_COOKIE["su_7cu_nn".$id_user]!=''))or(( isset($_COOKIE["su_7xcu_nn".$id_user]))and($_COOKIE["su_7xcu_nn".$id_user]!='')))
            {
                $class_js_search='greei_input';
                $class_js_readonly='readonly=""';
            }
*/

            echo'<input id="date_hidden_table" '.$class_js_readonly.' name="date" value="'.$date_su.'" type="hidden"><input id="date_hidden_start" name="start_date" type="hidden"><input id="date_hidden_end" name="end_date" type="hidden">';

            echo'<div class="left_drop menu1_prime book_menu_sel gop_io js--sort js-call-no-v '.$class_js_search.'" style="z-index:'.$zindex.'"><label>Период</label><div class="select eddd"><a class="slct " list_number="t2" data_src="'.$os_id2[array_search($_COOKIE["su_2tu_nn".$id_user], $os_id2)].'">'.$val_su2.'</a><ul class="drop">';

            $zindex--;

            for ($i=0; $i<count($os2); $i++)
            {
                if($su_2==$os_id2[$i])
                {
                    echo'<li class="sel_active"><a href="javascript:void(0);"  rel="'.$os_id2[$i].'">'.$os2[$i].'</a></li>';
                } else
                {
                    echo'<li><a href="javascript:void(0);"  rel="'.$os_id2[$i].'">'.$os2[$i].'</a></li>';
                }

            }
            echo'</ul><input type="hidden" '.$class_js_readonly.' name="sort2tu_nn" id="sort2tu_nn" value="'.$os2[$su_2].'"></div></div>';


            echo'<div class="inline_reload js-reload-top"><a href="statistic_new/.tabs-1" class="show_reload">Применить</a></div>';




            //echo'<a href="statistic/" class="show_sort_supply">Применить</a>';
            ?>
            <!--<div id="date_table" class="table_suply_x"></div>-->
            <!--<input readonly="true" id="date_table" class="table_suply_x">-->

            <div class="pad10" style="padding: 0;"><span class="bookingBox_range"><div id="date_table" class="table_suply_x_st"></div></span></div>
            <script type="text/javascript" src="Js/jquery-ui-1.9.2.custom.min.js"></script>
            <script type="text/javascript" src="Js/jquery.datepicker.extension.range.min.js"></script>
            <script type="text/javascript">
                (function ($) {
                    $.extend($.datepicker, {

                        // Reference the orignal function so we can override it and call it later
                        _inlineDatepicker2: $.datepicker._inlineDatepicker,

                        // Override the _inlineDatepicker method
                        _inlineDatepicker: function (target, inst) {

                            // Call the original
                            this._inlineDatepicker2(target, inst);

                            var beforeShow = $.datepicker._get(inst, 'beforeShow');

                            if (beforeShow) {
                                beforeShow.apply(target, [target, inst]);
                            }
                        }
                    });
                }(jQuery));

                var disabledDays = [];
                $(document).ready(function(){

                    window.date_picker_step=0;


                    $("#date_table").datepicker({
                        range: 'period', // режим - выбор периода
                        numberOfMonths: 2,
                        autoclose: true,
                        firstDay: 1,
                        minDate: "-2Y", maxDate: "+0D",
                        onSelect: function(dateText, inst, extensionRange) {

                            $('#date_table').val(jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.startDate) + ' - ' + jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.endDate));

                            var iu=$('.content').attr('iu');
                            $.cookie("suddtu_mor_nn"+iu, null, {path:'/',domain: window.is_session,secure: false});
                            CookieList("suddtu_mor_nn"+iu,jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.startDate) + ' - ' + jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.endDate),'add');


                            $('#date_hidden_start').val(jQuery.datepicker.formatDate('yy-mm-dd',extensionRange.startDate));
                            $('#date_hidden_end').val(jQuery.datepicker.formatDate('yy-mm-dd',extensionRange.endDate));

                            $('[list_number=t2]').empty().append(jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.startDate) + ' - ' + jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.endDate));
                            $.cookie("suddtu_nn"+iu, null, {path:'/',domain: window.is_session,secure: false});
                            CookieList("suddtu_nn"+iu,$('#date_hidden_start').val()+'/'+$('#date_hidden_end').val(),'add');
                            $('.js-reload-top').removeClass('active-r');
                            $('.js-reload-top').addClass('active-r');

                            window.date_picker_step++;
                            if(window.date_picker_step==2)
                            {
                                //$('#date_table').сlose();
                                //$('.datepicker').hide();
                                window.date_picker_step=0;
                                setTimeout ( function () { $('.bookingBox_range').hide(); }, 1000 );

                            }
                        },


                        beforeShow: function(textbox, instance){
                            setTimeout(function() {
                                instance.dpDiv.css({
                                    width:'100%'
                                });
                                $('.bookingBox_range').css({
                                    display:'none'
                                });

                            }, 10);


                            <?
                            if((isset($_COOKIE["su_2tu_nn".$id_user]))and(is_numeric($_COOKIE["su_2tu_nn".$id_user]))and($_COOKIE["su_2tu_nn".$id_user]==2))
                            {
                                $date_range=explode("/",$_COOKIE["suddtu_nn".$id_user]);
                                echo'var st=\''.ipost_($date_range[0],'').'\';
var st1=\''.ipost_($date_range[1],'').'\';
var st2=\''.ipost_($_COOKIE["suddtu_mor_nn".$id_user],'').'\';';
                                echo'jopacalendar(st,st1,st2);';
                            }
                            ?>


                        }

                    });




                });
                function resizeDatepicker() {
                    //$('.ui-datepicker').width('100%');
                }

                function jopacalendar(queryDate,queryDate1,date_all)
                {

                    if(date_all!='')
                    {
                        var dateParts = queryDate.match(/(\d+)/g), realDate = new Date(dateParts[0], dateParts[1] -1, dateParts[2]);
                        var dateParts1 = queryDate1.match(/(\d+)/g), realDate1 = new Date(dateParts1[0], dateParts1[1] -1, dateParts1[2]);
                        //alert(realDate);
                        $('#date_table').datepicker('setDate', [realDate,realDate1]);
                        $('#date_table').val(date_all);
                        //alert($('#date_table').val());
                    }
                }




            </script>

        </div></div></div>


      <?
     }
     ?>

 <div class="oka_block_1">
<div class="oka1_1" style="padding-top: 30px;">
  <?
  if((isset($_GET['tabs'])))
  {
//echo'<div class="oka1_1" style="padding-top: 30px;">';

      $mass_ei = $mass_ei ?? array();

      //добавляем еще себя к статистике
      array_push($mass_ei, $id_user);


      echo'<div class="freeze_22"><div id="fixed-headers"><table>
    <thead>
      <tr>
        <th rowspan="2" class="stichy-hh" style="vertical-align: middle">Менеджер</th>
        
        <th colspan="13" style="font-family: \'GEInspiraBold\';
color: rgba(0, 0, 0, 0.7);
font-size: 14px;">С '.time_fly_xxd($start_date_o.' 00:00:00').' - '.time_fly_xxd($end_date_o.' 00:00:00').'</th>
      </tr>
          <tr>';


        echo'<th >Новых обращений</th>
        <th >Успешных обращений <br> (c 27.03.2023)</th>
        <th >отказы по обращениям <br> (c 30.03.2023)</th>
        <th >Коэффициент эффективности обработки обращений <br> КО </th>
        <th >Новых договоров</th>
        <th >id новых договоров<br>комиссия с них</th>
        <th >Общая комиссия с новых</th>
        <th >Закрыли договоров не новых</th>
        <th >id закрытых договоров не новых<br>комиссия с них</th>
        <th >Общая комиссия с закрытых старых</th>
        <th >Общая комиссия всех закрытых договоров за период</th>
        <th >Общая сумма всех закрытых договоров за период</th>
        <th >Средний процент комиссии<br>КПД</th>
      </tr>
    </thead>
    <tbody>';

      $all_pp=0;
      $all_virushka_meneger=0;
      $all_preoprders_time=0;
      $all_preoprders_time_yes=0;
      $all_preoprders_time_no=0;
         foreach ($mass_ei as $keys => $value)
        {

  $result_work_zz=mysql_time_query($link,'Select a.name_user,a.id from r_user as a,r_role as b where a.id_role =b.id and ((b.role="works")or(b.role="gworks")or(a.id="'.$id_user.'")) and a.id="'.$value.'" and a.enabled=1');
  $num_results_work_zz = $result_work_zz->num_rows;
  if($num_results_work_zz!=0) {

      $row_38 = mysqli_fetch_assoc($result_work_zz);


      echo'<tr><th>'.$row_38["name_user"].'</th>';


      //$start_date_o
      //$end_date_o
      $sql_su5xxx=' AND ((R.id_user="'.$value.'"))';

      //Новых заявок
      $active_p=0;
      $result_uu_all = mysql_time_query($link, 'select count(R.id) as cc from preorders as R where R.id_company IN ('.$id_company.') and R.visible="1" and R.date_create>="'.$start_date_o.' 00:00:00" and R.date_create<="'.$end_date_o.' 23:59:59"  '.$sql_su5xxx);
      $num_results_uu_all  = $result_uu_all ->num_rows;

      if ($num_results_uu_all  != 0) {
          $row_uu_all  = mysqli_fetch_assoc($result_uu_all );
          if($row_uu_all["cc"]!='')
          {
              $active_p=$row_uu_all["cc"];
          }
      }
      echo'<td>'.$active_p.'</td>';
      $all_preoprders_time=$all_preoprders_time+$active_p;

$KO=0;
      //Удачных заявок - не важно как давно они были заведены
      $active_p=0;
      $result_uu_all = mysql_time_query($link, 'select count(R.id) as cc from preorders as R where R.id_company IN ('.$id_company.') and R.visible="1" and R.status=5 and R.doc_yes=1 and R.datetime_yes>="'.$start_date_o.' 00:00:00" and R.datetime_yes<="'.$end_date_o.' 23:59:59"  '.$sql_su5xxx);
      $num_results_uu_all  = $result_uu_all ->num_rows;

      if ($num_results_uu_all  != 0) {
          $row_uu_all  = mysqli_fetch_assoc($result_uu_all );
          if($row_uu_all["cc"]!='')
          {
              $active_p=$row_uu_all["cc"];
          }
      }
      echo'<td>'.$active_p.'</td>';
      $all_preoprders_time_yes=$all_preoprders_time_yes+$active_p;
$kko=$active_p;


      //Отказы по обращениям
      $active_p=0;
      $result_uu_all = mysql_time_query($link, 'select count(R.id) as cc from preorders as R where R.id_company IN ('.$id_company.') and R.visible="1" and R.status=6 and R.doc_yes=0 and R.datetime_yes>="'.$start_date_o.' 00:00:00" and R.datetime_yes<="'.$end_date_o.' 23:59:59"  '.$sql_su5xxx);
      $num_results_uu_all  = $result_uu_all ->num_rows;

      if ($num_results_uu_all  != 0) {
          $row_uu_all  = mysqli_fetch_assoc($result_uu_all );
          if($row_uu_all["cc"]!='')
          {
              $active_p=$row_uu_all["cc"];
          }
      }
      echo'<td>'.$active_p.'</td>';
      $all_preoprders_time_no=$all_preoprders_time_no+$active_p;

      if(($kko+$active_p)!=0) {
          $KO = ($kko / ($kko + $active_p)) * 100;
      }
      echo'<td>'.rtrim(rtrim(number_format($KO, 2, '.', ' '),'0'),'.').'%</td>';


      //Новых договор - не важно оплачены или нет
      $active_p=0;
      $result_uu_all = mysql_time_query($link, 'select count(R.id) as cc from trips as R where R.id_a_company IN ('.$id_company.') and R.visible="1" and R.commission_fix=0 and R.datecreate>="'.$start_date_o.' 00:00:00" and R.datecreate<="'.$end_date_o.' 23:59:59"  '.$sql_su5xxx);
      $num_results_uu_all  = $result_uu_all ->num_rows;

      if ($num_results_uu_all  != 0) {
          $row_uu_all  = mysqli_fetch_assoc($result_uu_all );
          if($row_uu_all["cc"]!='')
          {
              $active_p=$row_uu_all["cc"];
          }
      }
      echo'<td>'.$active_p.'</td>';


      //id Новых договор + комиссия
      $active_p='—';
      $all_uie=0;
      $all_cost_trips=0;


      $result_uu_all = mysql_time_query($link, 'select R.id,R.
date_buy_all,R.commission,R.status,R.paid_client from trips as R where R.id_a_company IN ('.$id_company.') and R.visible="1" and R.commission_fix=0 and R.datecreate>="'.$start_date_o.' 00:00:00" and R.datecreate<="'.$end_date_o.' 23:59:59"  '.$sql_su5xxx);
      $num_results_uu_all  = $result_uu_all ->num_rows;

      if ($num_results_uu_all  != 0) {

          while ($row_uu_all = mysqli_fetch_assoc($result_uu_all)) {

$beznal='';
              $beznal_tool='';

$pay_b=0;


              $result_uu_bez1 = mysql_time_query($link, 'select count(A.id) as cc from trips_payment as A where A.id_trips="' . ht($row_uu_all['id']) . '" and A.who=0 and A.id_operation=1 and not(A.id_payment_method=2) and not(A.id_payment_method=5) and A.visible=1');
              $num_results_uu_bez1 = $result_uu_bez1->num_rows;

              if ($num_results_uu_bez1 != 0) {
                  $row_uu_bez1 = mysqli_fetch_assoc($result_uu_bez1);
                  if($row_uu_bez1["cc"]!=0) {
                      //странный случай когда от клиента есть и нал и безнал
                      $beznal='Б';
                      $pay_b=1;
                      $beznal_tool='Безнал';
                  }
              }



              $result_uu_bez = mysql_time_query($link, 'select count(A.id) as cc from trips_payment as A where A.id_trips="' . ht($row_uu_all['id']) . '" and A.who=0 and A.id_operation=1 and (A.id_payment_method=2 or A.id_payment_method=5) and A.visible=1');
              $num_results_uu_bez = $result_uu_bez->num_rows;





              if ($num_results_uu_bez != 0) {
                  $row_uu_bez = mysqli_fetch_assoc($result_uu_bez);
                  if($row_uu_bez["cc"]!=0)
                  {
                      if($pay_b==1)
                      {
                          $beznal = 'НБ';
                          $beznal_tool='оплаты смешаны';
                      } else {
                          $beznal = 'Н';
                          $beznal_tool='Наличные';
                      }
                      $pay_b=1;
                  }

              }


              $comm_dd='(~)';
              if($row_uu_all["date_buy_all"]!='0000-00-00 00:00:00')
              {
                  if($row_uu_all["commission"]>=0) {
                      $comm_dd = '(+' . $row_uu_all["commission"] . ')';
                  } else
                  {
                      $comm_dd = '(' . $row_uu_all["commission"] . ')';
                  }


                  if($row_uu_all["status"]!=2) {
                      $all_uie = $all_uie + $row_uu_all["commission"];
                      $all_cost_trips=$all_cost_trips + $row_uu_all["paid_client"];
                  }
              }
              $status_jhcc='';
               if($row_uu_all["status"]==2) {
                   $status_jhcc='red_ccf';
               }


              if($active_p=='—')
              {
                  $active_p='<span class="noww"><a class="noww '.$status_jhcc.'" target="_blank" href="/tours/.id-'.$row_uu_all["id"].'">'.$row_uu_all["id"].' '.$comm_dd.'</a><span data-tooltip="'.$beznal_tool.'" style="color: rgba(0, 0, 0, 0.2); padding-left:5px;">'.$beznal.'</span></span>';
              } else
              {
                  $active_p.='<br><span class="noww"><a class="noww '.$status_jhcc.'" target="_blank" href="/tours/.id-'.$row_uu_all["id"].'">'.$row_uu_all["id"].' '.$comm_dd.'</a><span data-tooltip="'.$beznal_tool.'" style="color: rgba(0, 0, 0, 0.2); padding-left:5px;">'.$beznal.'</span></span>';
              }

          }
      }
      echo'<td>'.$active_p.'</td>';
      echo'<td class="noww">'.rtrim(rtrim(number_format($all_uie, 2, '.', ' '),'0'),'.').'</td>';

      //Не новых договоров - но полность оплаченных и учтенные комиссией в этот период
      $active_p=0;
      $result_uu_all = mysql_time_query($link, 'select count(R.id) as cc from trips as R where R.id_a_company IN ('.$id_company.') and R.visible="1" and R.commission_fix=0 and ((R.datecreate<"'.$start_date_o.' 00:00:00") or (R.datecreate>"'.$end_date_o.' 23:59:59")) and R.date_buy_all>="'.$start_date_o.' 00:00:00" and R.date_buy_all<="'.$end_date_o.' 23:59:59"  '.$sql_su5xxx);


      $num_results_uu_all  = $result_uu_all ->num_rows;

      if ($num_results_uu_all  != 0) {
          $row_uu_all  = mysqli_fetch_assoc($result_uu_all );
          if($row_uu_all["cc"]!='')
          {
              $active_p=$row_uu_all["cc"];
          }
      }
      echo'<td>'.$active_p.'</td>';


      //id Не новых договор но закрытых в этот период
      $active_p='—';
      $all_uie1=0;
      $result_uu_all = mysql_time_query($link, 'select R.id,R.commission,R.status,R.paid_client from trips as R where R.id_a_company IN ('.$id_company.') and R.visible="1" and R.commission_fix=0 and ((R.datecreate<"'.$start_date_o.' 00:00:00") or (R.datecreate>"'.$end_date_o.' 23:59:59")) and R.date_buy_all>="'.$start_date_o.' 00:00:00" and R.date_buy_all<="'.$end_date_o.' 23:59:59"  '.$sql_su5xxx);
      $num_results_uu_all  = $result_uu_all ->num_rows;

      if ($num_results_uu_all  != 0) {

          while ($row_uu_all = mysqli_fetch_assoc($result_uu_all)) {


              $comm_dd='(~)';

                  if($row_uu_all["commission"]>=0) {
                      $comm_dd = '(+' . $row_uu_all["commission"] . ')';
                  } else
                  {
                      $comm_dd = '(' . $row_uu_all["commission"] . ')';
                  }

if($row_uu_all["status"]!=2) {
                      $all_uie1 = $all_uie1 + $row_uu_all["commission"];
    $all_cost_trips=$all_cost_trips + $row_uu_all["paid_client"];
                  }

              $status_jhcc='';
               if($row_uu_all["status"]==2) {
                   $status_jhcc='red_ccf';
               }

              if($active_p=='—')
              {
                  $active_p='<a class="noww '.$status_jhcc.'" target="_blank" href="/tours/.id-'.$row_uu_all["id"].'">'.$row_uu_all["id"].' '.$comm_dd.'</a>';
              } else
              {
                  $active_p.='<br><a class="noww '.$status_jhcc.'" target="_blank" href="/tours/.id-'.$row_uu_all["id"].'">'.$row_uu_all["id"].' '.$comm_dd.'</a>';
              }

          }
      }
      echo'<td >'.$active_p.'</td>';
        echo'<td class="noww">'.rtrim(rtrim(number_format($all_uie1, 2, '.', ' '),'0'),'.').'</td>';
        echo'<td class="noww">'.rtrim(rtrim(number_format(($all_uie1+$all_uie), 2, '.', ' '),'0'),'.').'</td>';
        $vsy_cc=($all_uie1+$all_uie);
      $all_pp=$all_pp+$vsy_cc;

      $all_virushka_meneger=$all_virushka_meneger+$all_cost_trips;


        $koof=0;
        if($vsy_cc!=0) {
            $koof = ($vsy_cc/$all_cost_trips)*100;

        }

      echo'<td class="noww">'.rtrim(rtrim(number_format($all_cost_trips, 2, '.', ' '),'0'),'.').'</td>';

      echo'<td class="noww">'.rtrim(rtrim(number_format($koof, 2, '.', ' '),'0'),'.').'%</td>';

      echo'</tr>';

  }
        }

         //итоги вывод
      $all_koof=0;
if($all_virushka_meneger!=0) {
    $all_koof = ($all_pp / $all_virushka_meneger) * 100;
}
      echo'<tr><th>Итоги по менеджерам</th><td>'.$all_preoprders_time.'</td><td>'.$all_preoprders_time_yes.'</td><td>'.$all_preoprders_time_no.'</td><td colspan="7"></td><td class="noww">'.rtrim(rtrim(number_format($all_pp, 2, '.', ' '),'0'),'.').'</td><td class="noww">'.rtrim(rtrim(number_format($all_virushka_meneger, 2, '.', ' '),'0'),'.').'</td><td>'.rtrim(rtrim(number_format($all_koof, 2, '.', ' '),'0'),'.').'%</td></tr>';


      echo'</tbody>
</table></div></div>';

//echo'</div>';



  } else
  {


  $LIKE='';
  if(is_numeric($id_company))
  {
      $LIKE=' and ((b.id_company LIKE "'.ht($id_company).',%")or(b.id_company LIKE "%,'.ht($id_company).',%")or(b.id_company LIKE "%,'.ht($id_company).'")or(b.id_company="'.ht($id_company).'")) ';
  } else
  {
      $date_new_ada = explode(",", ht($id_company));
      for ($ada = 0; $ada < count($date_new_ada); $ada++) {

          if($LIKE=='')
          {
              $LIKE=' and ( ((b.id_company LIKE "'.ht($date_new_ada[$ada]).',%")or(b.id_company LIKE "%,'.ht($date_new_ada[$ada]).',%")or(b.id_company LIKE "%,'.ht($date_new_ada[$ada]).'")or(b.id_company="'.ht($date_new_ada[$ada]).'")) ';
          } else
          {
              $LIKE.='or ((b.id_company LIKE "'.ht($date_new_ada[$ada]).',%")or(b.id_company LIKE "%,'.ht($date_new_ada[$ada]).',%")or(b.id_company LIKE "%,'.ht($date_new_ada[$ada]).'")or(b.id_company="'.ht($date_new_ada[$ada]).'")) ';
          }

      }
      if($LIKE!='')
      {
          $LIKE.=') ';
      }


  }


  //Получаем комиссию пользователя и его бонусы

  //по умолчанию текущий месяц
  $month_s=date("Y-m-").'01';
	  $month_s_like=date("Y-m-");
$month_rus=date("m");
$month_rus1=date("m");
  $date_level_bonus=date("Y-m-").'01';

  $day_montch= cal_days_in_month(CAL_GREGORIAN, date("j"), date("Y")); // 31


  $date_start_obo=date("Y-m-").'01 00:00:00';
  $date_end_obo=date_step_sql('Y-m', '+1m').'-01 00:00:00';

  if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and(array_search($_COOKIE["su_2s".$id_user],$os_id2)!==false)and($_COOKIE["su_2s".$id_user]==1))
  {
		//находим прошлый месяц
      $month_s=$date_start=date_step_sql('Y-m', '-1m').'-01';
      $month_s_like=$date_start=date_step_sql('Y-m', '-1m');
      $month_rus=date_step_sql('m', '-1m');
      $month_rus1=date_step_sql('m', '-1m');

      $date_level_bonus=date_step_sql('Y-m', '-1m').'-01';

      $date_start_obo=date_step_sql('Y-m', '-1m').'-01 00:00:00';
      $date_end_obo=date("Y-m-").'01 00:00:00';

  }

  if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and(array_search($_COOKIE["su_2s".$id_user],$os_id2)!==false)and($_COOKIE["su_2s".$id_user]==3))
  {
      //находим -2 месяца назад

      $month_s=$date_start=date_step_sql('Y-m', '-2m').'-01';
      $month_s_like=$date_start=date_step_sql('Y-m', '-2m');
      $month_rus=date_step_sql('m', '-2m');
      $month_rus1=date_step_sql('m', '-2m');

      $date_end=date_step_sql('Y-m-', '-1m').'01';

      $date_level_bonus=date_step_sql('Y-m', '-2m').'-01';

      $date_start_obo=date_step_sql('Y-m', '-2m').'-01 00:00:00';
      $date_end_obo=date_step_sql('Y-m', '-1m').'-01 00:00:00';

  }
  if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and(array_search($_COOKIE["su_2s".$id_user],$os_id2)!==false)and($_COOKIE["su_2s".$id_user]==4))
  {
      //находим -3месяца назад

      $month_s=$date_start=date_step_sql('Y-m', '-3m').'-01';
      $month_s_like=$date_start=date_step_sql('Y-m', '-3m');
      $month_rus=date_step_sql('m', '-3m');
      $month_rus1=date_step_sql('m', '-3m');

      $date_end=date_step_sql('Y-m-', '-2m').'01';

      $date_level_bonus=date_step_sql('Y-m', '-3m').'-01';

      $date_start_obo=date_step_sql('Y-m', '-3m').'-01 00:00:00';
      $date_end_obo=date_step_sql('Y-m', '-2m').'-01 00:00:00';
  }
  if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and(array_search($_COOKIE["su_2s".$id_user],$os_id2)!==false)and($_COOKIE["su_2s".$id_user]==5))
  {
      //находим -3месяца назад

      $month_s=$date_start=date_step_sql('Y-m', '-4m').'-01';
      $month_s_like=$date_start=date_step_sql('Y-m', '-4m');
      $month_rus=date_step_sql('m', '-4m');
      $month_rus1=date_step_sql('m', '-4m');

      $date_end=date_step_sql('Y-m-', '-3m').'01';

      $date_level_bonus=date_step_sql('Y-m', '-4m').'-01';

      $date_start_obo=date_step_sql('Y-m', '-4m').'-01 00:00:00';
      $date_end_obo=date_step_sql('Y-m', '-3m').'-01 00:00:00';
  }
  if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and(array_search($_COOKIE["su_2s".$id_user],$os_id2)!==false)and($_COOKIE["su_2s".$id_user]==6))
  {
      //находим -3месяца назад

      $month_s=$date_start=date_step_sql('Y-m', '-5m').'-01';
      $month_s_like=$date_start=date_step_sql('Y-m', '-5m');
      $month_rus=date_step_sql('m', '-5m');
      $month_rus1=date_step_sql('m', '-5m');

      $date_end=date_step_sql('Y-m-', '-4m').'01';

      $date_level_bonus=date_step_sql('Y-m', '-5m').'-01';

      $date_start_obo=date_step_sql('Y-m', '-5m').'-01 00:00:00';
      $date_end_obo=date_step_sql('Y-m', '-4m').'-01 00:00:00';
  }
  if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and(array_search($_COOKIE["su_2s".$id_user],$os_id2)!==false)and($_COOKIE["su_2s".$id_user]==7))
  {
      //находим -3месяца назад

      $month_s=$date_start=date_step_sql('Y-m', '-6m').'-01';
      $month_s_like=$date_start=date_step_sql('Y-m', '-6m');
      $month_rus=date_step_sql('m', '-6m');
      $month_rus1=date_step_sql('m', '-6m');

      $date_end=date_step_sql('Y-m-', '-5m').'01';

      $date_level_bonus=date_step_sql('Y-m', '-6m').'-01';

      $date_start_obo=date_step_sql('Y-m', '-6m').'-01 00:00:00';
      $date_end_obo=date_step_sql('Y-m', '-5m').'-01 00:00:00';
  }
  if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and(array_search($_COOKIE["su_2s".$id_user],$os_id2)!==false)and($_COOKIE["su_2s".$id_user]==8))
  {
      //находим -3месяца назад

      $month_s=$date_start=date_step_sql('Y-m', '-7m').'-01';
      $month_s_like=$date_start=date_step_sql('Y-m', '-7m');
      $month_rus=date_step_sql('m', '-7m');
      $month_rus1=date_step_sql('m', '-7m');

      $date_end=date_step_sql('Y-m-', '-6m').'01';

      $date_level_bonus=date_step_sql('Y-m', '-7m').'-01';

      $date_start_obo=date_step_sql('Y-m', '-7m').'-01 00:00:00';
      $date_end_obo=date_step_sql('Y-m', '-6m').'-01 00:00:00';
  }
  if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and(array_search($_COOKIE["su_2s".$id_user],$os_id2)!==false)and($_COOKIE["su_2s".$id_user]==9))
  {
      //находим -3месяца назад

      $month_s=$date_start=date_step_sql('Y-m', '-8m').'-01';
      $month_s_like=$date_start=date_step_sql('Y-m', '-8m');
      $month_rus=date_step_sql('m', '-8m');
      $month_rus1=date_step_sql('m', '-8m');

      $date_end=date_step_sql('Y-m-', '-7m').'01';

      $date_level_bonus=date_step_sql('Y-m', '-8m').'-01';

      $date_start_obo=date_step_sql('Y-m', '-8m').'-01 00:00:00';
      $date_end_obo=date_step_sql('Y-m', '-7m').'-01 00:00:00';
  }
  if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and(array_search($_COOKIE["su_2s".$id_user],$os_id2)!==false)and($_COOKIE["su_2s".$id_user]==10))
  {
      //находим -3месяца назад

      $month_s=$date_start=date_step_sql('Y-m', '-9m').'-01';
      $month_s_like=$date_start=date_step_sql('Y-m', '-9m');
      $month_rus=date_step_sql('m', '-9m');
      $month_rus1=date_step_sql('m', '-9m');

      $date_end=date_step_sql('Y-m-', '-8m').'01';

      $date_level_bonus=date_step_sql('Y-m', '-9m').'-01';

      $date_start_obo=date_step_sql('Y-m', '-9m').'-01 00:00:00';
      $date_end_obo=date_step_sql('Y-m', '-8m').'-01 00:00:00';
  }
  if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and(array_search($_COOKIE["su_2s".$id_user],$os_id2)!==false)and($_COOKIE["su_2s".$id_user]==11))
  {
      //находим -3месяца назад

      $month_s=$date_start=date_step_sql('Y-m', '-10m').'-01';
      $month_s_like=$date_start=date_step_sql('Y-m', '-10m');
      $month_rus=date_step_sql('m', '-10m');
      $month_rus1=date_step_sql('m', '-10m');

      $date_end=date_step_sql('Y-m-', '-9m').'01';

      $date_level_bonus=date_step_sql('Y-m', '-10m').'-01';

      $date_start_obo=date_step_sql('Y-m', '-10m').'-01 00:00:00';
      $date_end_obo=date_step_sql('Y-m', '-9m').'-01 00:00:00';
  }
  if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and(array_search($_COOKIE["su_2s".$id_user],$os_id2)!==false)and($_COOKIE["su_2s".$id_user]==12))
  {
      //находим -3месяца назад

      $month_s=$date_start=date_step_sql('Y-m', '-11m').'-01';
      $month_s_like=$date_start=date_step_sql('Y-m', '-11m');
      $month_rus=date_step_sql('m', '-11m');
      $month_rus1=date_step_sql('m', '-11m');

      $date_end=date_step_sql('Y-m-', '-10m').'01';

      $date_level_bonus=date_step_sql('Y-m', '-11m').'-01';

      $date_start_obo=date_step_sql('Y-m', '-11m').'-01 00:00:00';
      $date_end_obo=date_step_sql('Y-m', '-10m').'-01 00:00:00';
  }
  if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and(array_search($_COOKIE["su_2s".$id_user],$os_id2)!==false)and($_COOKIE["su_2s".$id_user]==13))
  {
      //находим -3месяца назад

      $month_s=$date_start=date_step_sql('Y-m', '-12m').'-01';
      $month_s_like=$date_start=date_step_sql('Y-m', '-12m');
      $month_rus=date_step_sql('m', '-12m');
      $month_rus1=date_step_sql('m', '-12m');

      $date_end=date_step_sql('Y-m-', '-11m').'01';

      $date_level_bonus=date_step_sql('Y-m', '-12m').'-01';

      $date_start_obo=date_step_sql('Y-m', '-12m').'-01 00:00:00';
      $date_end_obo=date_step_sql('Y-m', '-11m').'-01 00:00:00';
  }

  $month_rus1='за '.month_rus1($month_rus);
//echo('!'.$month_rus1);
  if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and(array_search($_COOKIE["su_2s".$id_user],$os_id2)!==false)and($_COOKIE["su_2s".$id_user]==2))
  {

	  $month_rus1='с '.$_COOKIE["sudds_mor".$id_user];

  }

		   //есть ли запись с такой коммиссией по этому пользователю за данный месяц
  if (((( isset($_COOKIE["su_5s".$id_user]))and(is_numeric($_COOKIE["su_5s".$id_user]))and(array_search($_COOKIE["su_5s".$id_user],$os_id5)!==false)and($_COOKIE["su_5s".$id_user]==0))or(!isset($_COOKIE["su_5s".$id_user])))and(($sign_admin==1)or($sign_level>1)))
  {




	  //общая статистика по всем подчиненным менеджерам для директоров и всех кто выже менеджеров
  $result_status22=mysql_time_query($link,'SELECT sum(a.sum) as sum,sum(a.sum_fix) as sum_fix from users_commission_trips as a,r_user as b where a.id_users=b.id '.$LIKE.' and a.date="'.$month_s.'" and not(a.id_users=0)');
			} else
		{
	  if((isset($_COOKIE["su_5s".$id_user]))and($_COOKIE["su_5s".$id_user]!=0)and(($sign_admin==1)or($sign_level>1)))
	  {
	      //статистика по какому то конкретному менеждеру директоров и всех кто выже менеджеров
	  $result_status22=mysql_time_query($link,'SELECT a.sum,a.sum_fix from users_commission_trips as a,r_user as b where a.id_users=b.id '.$LIKE.' and  a.id_users="'.htmlspecialchars(trim($_COOKIE["su_5s".$id_user])).'" and a.date="'.$month_s.'"');
	  } else{
	      //своя статистика для менеджеров
  $result_status22=mysql_time_query($link,'SELECT a.sum,a.sum_fix from users_commission_trips as a,r_user as b where a.id_users=b.id '.$LIKE.' and a.id_users="'.$id_user.'" and a.date="'.$month_s.'"');
	  }



		}
           if($result_status22->num_rows!=0)
           {
			     $row_status22 = mysqli_fetch_assoc($result_status22);
		   }

	       $row_status22["sum"] ??=0;



           $row_status22["sum_fix"] ??=0;

	$bonus=0;

 if((( !isset($_COOKIE["su_5s".$id_user]))or($_COOKIE["su_5s".$id_user]==0))and(($sign_admin==1)or($sign_level>1)))
  {
      //общая статистика по всем подчиненным менеджерам для директоров и всех кто выже менеджеров
				  $result_status223=mysql_time_query($link,'SELECT a.* from users_commission_trips as a,r_user as b where a.id_users=b.id '.$LIKE.' and a.date="'.$month_s.'"');
				$num223 = $result_status223->num_rows;
				  if($result_status223->num_rows!=0)
                   {
					 for ($i=0; $i<$num223; $i++)
		         {
			    $row223 = mysqli_fetch_assoc($result_status223);

                     $result_status_b=mysql_time_query($link,'SELECT a.* from users_commission_level as a where a.id_users="'.$row223["id_users"].'" and a.sum_start<="'.$row223["sum"].'" and a.sum_end>"'.$row223["sum"].'" and a.dates="'.$date_level_bonus.'" and a.id_company IN ('.ht($id_company).')');

                     if($result_status_b->num_rows==0) {

                         $result_status_b = mysql_time_query($link, 'SELECT a.* from users_commission_level as a where a.id_users=0 and a.sum_start<="' . $row223["sum"] . '" and a.sum_end>"' . $row223["sum"] . '" and a.dates="' . $date_level_bonus . '" and a.id_company IN (' . ht($id_company) . ')');

                     }

           if($result_status_b->num_rows!=0)
           {
			     $row_status_b = mysqli_fetch_assoc($result_status_b);
			     if($row_status_b["level"]!=1)
				 {
					 $bonus=$bonus+(($row223["sum"]*$row_status_b["proc"])/100)+$row223["sum_fix"];
				 }else
                 {
                     $bonus=$bonus+$row223["sum_fix"];
                 }
		   }
				  }
				  }


			} else
			{

  if ((( !isset($_COOKIE["su_5s".$id_user]))or($_COOKIE["su_5s".$id_user]!=0))and(($sign_admin==1)or($sign_level>1)))
  {
      $result_status_b = mysql_time_query($link, 'SELECT a.* from users_commission_level as a where a.id_users="' . ht($_COOKIE["su_5s".$id_user]) . '" and a.sum_start<="' . $row_status22["sum"] . '" and a.sum_end>"' . $row_status22["sum"] . '"  and a.dates="' . $date_level_bonus . '" and a.id_company IN (' . ht($id_company) . ')');
  }else {


      $result_status_b = mysql_time_query($link, 'SELECT a.* from users_commission_level as a where a.id_users="' . $id_user . '" and a.sum_start<="' . $row_status22["sum"] . '" and a.sum_end>"' . $row_status22["sum"] . '"  and a.dates="' . $date_level_bonus . '" and a.id_company IN (' . ht($id_company) . ')');
  }
  if($result_status_b->num_rows==0)
  {
      $result_status_b=mysql_time_query($link,'SELECT a.* from users_commission_level as a where a.id_users=0 and a.sum_start<="'.$row_status22["sum"].'" and a.sum_end>"'.$row_status22["sum"].'"  and a.dates="'.$date_level_bonus.'" and a.id_company IN ('.ht($id_company).')');

  }

               // echo("!!!");
           if($result_status_b->num_rows!=0)
           {
			     $row_status_b = mysqli_fetch_assoc($result_status_b);

			     if($row_status_b["level"]!=1)
				 {

				     $bonus=(($row_status22["sum"]*$row_status_b["proc"])/100)+$row_status22["sum_fix"];
				 } else
                 {

                     $bonus=$row_status22["sum_fix"];
                 }
		   }

			}

	$uoo_pp=0;
	$pp_class='';
				  if ((! isset($_COOKIE["su_2s".$id_user]))or((is_numeric($_COOKIE["su_2s".$id_user]))and(array_search($_COOKIE["su_2s".$id_user],$os_id2)!==false)and($_COOKIE["su_2s".$id_user]==0)))
  {
				$uoo_pp=1;
					  	$pp_class='flex_pp';


					$sql_line=' and a.id_user="'.$id_user.'" ';
		 if(($sign_admin==1)or($sign_level>1))
		 {
			$sql_line='';
		 }
			  if (( isset($_COOKIE["su_5s".$id_user]))and(is_numeric($_COOKIE["su_5s".$id_user]))and(array_search($_COOKIE["su_5s".$id_user],$os_id5)!==false)and($_COOKIE["su_5s".$id_user]==0)and(($sign_admin==1)or($sign_level>1)))
  {
			$sql_line='';
  } else
			  {
				  if (( isset($_COOKIE["su_5s".$id_user]))and(is_numeric($_COOKIE["su_5s".$id_user]))and(array_search($_COOKIE["su_5s".$id_user],$os_id5)!==false)and(($sign_admin==1)or($sign_level>1)))
                  {
					  $sql_line=' and a.id_user="'.$_COOKIE["su_5s".$id_user].'" ';
				  }
			  }

			  //добавить себя в подчиненных
      //учесть в предполагаемой комиссии только своих подчиненных и себя если ты главный менеджер

      $mass_ei = $mass_ei ?? array();


      if(($sign_level==2)or($sign_level==1))
      {
          array_push($mass_ei, $id_user);
      }

  if(($sign_level!=3)and($sign_level!=4)) {

      $result_pred = mysql_time_query($link, 'select * from (
          (SELECT a.id, a.id_exchange, (a.cost_client-a.cost_operator) as com1, ((a.cost_client_exchange-a.cost_operator_exchange)*a.exchange_rates) as com2  FROM trips AS a WHERE a.id_user in(' . implode(',', $mass_ei) . ') and a.visible=1 and a.commission_fix=0 and ((a.buy_clients=1)and(a.buy_operator=0)) and ((not(a.cost_operator=0))or(not(a.cost_operator_exchange=0))) and  (select v.date from trips_payment_term as v where v.id_trips=a.id and v.visible=1 and v.type=1 and v.proc=100 and v.yes=0 limit 0,1) LIKE "' . date("Y-m") . '-%"' . $sql_line . ')
          UNION
          (SELECT a.id, a.id_exchange, (a.cost_client-a.cost_operator) as com1, ((a.cost_client_exchange-a.cost_operator_exchange)*a.exchange_rates) as com2  FROM trips AS a WHERE a.id_user in(' . implode(',', $mass_ei) . ') and a.visible=1 and a.commission_fix=0 and ((a.buy_clients=0)and(a.buy_operator=1)) and ((not(a.cost_operator=0))or(not(a.cost_operator_exchange=0))) and (select v.date from trips_payment_term as v where v.id_trips=a.id and v.visible=1 and v.type=0 and v.proc=100 and v.yes=0 limit 0,1) LIKE "' . date("Y-m") . '-%"' . $sql_line . ')
          UNION
          (SELECT a.id, a.id_exchange, (a.cost_client-a.cost_operator) as com1, ((a.cost_client_exchange-a.cost_operator_exchange)*a.exchange_rates) as com2  FROM trips AS a WHERE a.id_user in(' . implode(',', $mass_ei) . ') and a.visible=1 and a.commission_fix=0 and ((a.buy_clients=0)and(a.buy_operator=0)) and ((not(a.cost_operator=0))or(not(a.cost_operator_exchange=0))) and (select v.date from trips_payment_term as v where v.id_trips=a.id and v.visible=1 and v.type=0 and v.proc=100 and v.yes=0 limit 0,1) LIKE "' . date("Y-m") . '-%" and  (select v.date from trips_payment_term as v where v.id_trips=a.id and v.visible=1 and v.type=1 and v.proc=100 and v.yes=0 limit 0,1) LIKE "' . date("Y-m") . '-%"' . $sql_line . ')
              
              
      ) as Z');
  } else
  {
      $result_pred = mysql_time_query($link, 'select * from (
          (SELECT a.id, a.id_exchange, (a.cost_client-a.cost_operator) as com1, ((a.cost_client_exchange-a.cost_operator_exchange)*a.exchange_rates) as com2  FROM trips AS a WHERE a.id_user in(' . implode(',', $mass_ei) . ') and a.visible=1 and ((a.buy_clients=1)and(a.buy_operator=0)) and ((not(a.cost_operator=0))or(not(a.cost_operator_exchange=0))) and  (select v.date from trips_payment_term as v where v.id_trips=a.id and v.visible=1 and v.type=1 and v.proc=100 and v.yes=0 limit 0,1) LIKE "' . date("Y-m") . '-%"' . $sql_line . ')
          UNION
          (SELECT a.id, a.id_exchange, (a.cost_client-a.cost_operator) as com1, ((a.cost_client_exchange-a.cost_operator_exchange)*a.exchange_rates) as com2  FROM trips AS a WHERE a.id_user in(' . implode(',', $mass_ei) . ') and a.visible=1 and ((a.buy_clients=0)and(a.buy_operator=1)) and ((not(a.cost_operator=0))or(not(a.cost_operator_exchange=0))) and (select v.date from trips_payment_term as v where v.id_trips=a.id and v.visible=1 and v.type=0 and v.proc=100 and v.yes=0 limit 0,1) LIKE "' . date("Y-m") . '-%"' . $sql_line . ')
          UNION
          (SELECT a.id, a.id_exchange, (a.cost_client-a.cost_operator) as com1, ((a.cost_client_exchange-a.cost_operator_exchange)*a.exchange_rates) as com2  FROM trips AS a WHERE a.id_user in(' . implode(',', $mass_ei) . ') and a.visible=1 and ((a.buy_clients=0)and(a.buy_operator=0)) and ((not(a.cost_operator=0))or(not(a.cost_operator_exchange=0))) and (select v.date from trips_payment_term as v where v.id_trips=a.id and v.visible=1 and v.type=0 and v.proc=100 and v.yes=0 limit 0,1) LIKE "' . date("Y-m") . '-%" and  (select v.date from trips_payment_term as v where v.id_trips=a.id and v.visible=1 and v.type=1 and v.proc=100 and v.yes=0 limit 0,1) LIKE "' . date("Y-m") . '-%"' . $sql_line . ')
              
              
      ) as Z');
  }

      $all_comm=0;
                if($result_pred->num_rows!=0)
                {

                        while ( $row_pred = mysqli_fetch_assoc($result_pred)) {
//по каждому туру вычитаем еще все потери на комиссиях
                            $result_uu_rate=mysql_time_query($link,'select a.char,a.small_name,a.code from booking_exchange as a  where a.id="'.ht($row_pred["id_exchange"]).'"');
                            $num_results_uu_rate = $result_uu_rate->num_rows;

                            if($num_results_uu_rate!=0) {
                                $row_uu_rate = mysqli_fetch_assoc($result_uu_rate);
                            }
                            if ($row_uu_rate["char"] == "₽") {

                                $all_comm=$all_comm+$row_pred["com1"];

                            } else
                            {
                                $all_comm=$all_comm+$row_pred["com2"];
                            }

                            $result_poteri = mysql_time_query($link, 'select sum(A.commission) as vse from trips_payment as A where A.id_trips="' . ht($row_pred["id"]) . '" and A.visible=1');
                            $num_results_poteri = $result_poteri->num_rows;

                            if ($num_results_poteri != 0) {
                                $row_poteri = mysqli_fetch_assoc($result_poteri);
                                $all_comm=$all_comm-$row_poteri["vse"];

                            }

                        }


                    if($all_comm==0)
					{
						$uoo_pp=0;
						$pp_class='';
					}

				}

				  }
?>


<?

$echo_max_min=1; //выводить по умолчания

//выше обычного менеджера и у него по умолчанию все подпиченный или насильно выбрано
if(($sign_admin==1)or($sign_level>1))
{

    if(!isset($_COOKIE["su_5s".$id_user])) {$echo_max_min=0;}
    if((isset($_COOKIE["su_5s".$id_user]))and($_COOKIE["su_5s".$id_user]==0)) {$echo_max_min=0;}

}

if ($echo_max_min==1) {

    $id_uuu=$id_user;
    if((isset($_COOKIE["su_5s".$id_user]))and($_COOKIE["su_5s".$id_user]!=0))
    {
        //может ли им управлять

        if (array_search($_COOKIE["su_5s".$id_user], $mass_ei) !== false) {
            $id_uuu=$_COOKIE["su_5s".$id_user];
        }


    }

    $result_max=mysql_time_query($link,'SELECT a.* from users_commission_plane as a where a.id_users="'.$id_uuu.'" and a.dates="'.$date_level_bonus.'"');

   // echo 'SELECT a.* from users_commission_plane as a where a.id_users="'.$id_uuu.'" and a.dates="'.$date_level_bonus.'"';

    $num_results_max = $result_max->num_rows;
    $min='—';
    $max='—';
    if ($num_results_max != 0) {
        $row_max = mysqli_fetch_assoc($result_max);
        if($row_max["min"]!=0)
        {
            $min=rtrim(rtrim(number_format($row_max["min"], 2, '.', ' '),'0'),'.');
            $min_x=$row_max["min"];
        }
        if($row_max["max"]!=0)
        {
            $max=rtrim(rtrim(number_format($row_max["max"], 2, '.', ' '),'0'),'.');
            $max_x=$row_max["max"];
        }

    }





    echo '<div class="bord-promo statistic-promo">

        <div class="block-ppi">
        
        
        <div class="two-finance">

<div class="h1-fin">Ваш план продаж</div>

<div class="fin-na-100">
<div class="fin-50 fin-50-jkk">
<label>MIN план</label>
<span class="cost_circle"><i></i>'.$min.'</span>
</div>
<div class="fin-50 fin-50-jkk">
<label>MAX план</label>
<span class="cost_circle">'.$max.'</span>
</div>
</div>';

    $procc=0;
    $eshe_nado=6;
    /*
    max - 100
    факт - x
    */
    //$row_status22["sum"]=240000;
if(($max_x!='—')and($max_x!=0)) {
    $procc = round($row_status22["sum"] * 100 / $max_x);
    if($procc>100)
    {
        $procc=100;
    }
}


    $ost_ot_plane=0;
$do_plane='Осталось до MIN плана';
    if(($min_x!='—')and($min_x!=0))
    {
        $ost_ot_plane=$min_x-$row_status22["sum"];
        if($ost_ot_plane<0)
        {
            $ost_ot_plane=0;

            //план выполнен
            $do_plane='Осталось до MAX плана';
            //смотрим сколько до мах плана
            if(($max_x!='—')and($max_x!=0)) {
                $ost_ot_plane = $max_x - $row_status22["sum"];
                if ($ost_ot_plane < 0) {
                    $ost_ot_plane = 0;

                }
            }
        }
    }


    echo'<div class="gr-50">
    <div class="circle-container"  style="margin-top: -15px;">
        <div class="circlestat" data-dimension="80" data-text="'.$procc.'" data-text-pr="%" data-width="1" data-fontsize="27" data-percent="'.$procc.'" data-fgcolor="#24c32d" data-bgcolor="rgba(0,0,0,0.2)" data-fill="#f5f5f6"></div>
    </div>';
    echo '<strong ><b>'.rtrim(rtrim(number_format($row_status22["sum"], 2, '.', ' '),'0'),'.').'  РУБ. → Факт</b>  <br> '.rtrim(rtrim(number_format($ost_ot_plane, 2, '.', ' '),'0'),'.').'  РУБ. → '.$do_plane.'  </strong ></div>';


        
        
        
        echo'</div>';

    if ((( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and(array_search($_COOKIE["su_2s".$id_user],$os_id2)!==false)and($_COOKIE["su_2s".$id_user]==0))or( !isset($_COOKIE["su_2s".$id_user]))) {
     if($day_montch!=0) {
       $v_den = $max_x / $day_montch;
       $doljen_yje=(date('j')-1)*$v_den;
       //echo($doljen_yje);
       if($row_status22["sum"]<$doljen_yje)
       {

           echo'<div class="txt-dd" >
<div  class="status_admin s_pr_4 xx-22x">Вы отстаете от запланированного MIN плана по дням на '.rtrim(rtrim(number_format(($doljen_yje-$row_status22["sum"]), 2, '.', ' '),'0'),'.').'  РУБ.</div>
</div>';

       } else
       {
           if($doljen_yje>0)
           {
               echo'<div class="txt-dd" >
<div  class="status_admin s_pr_3 xx-22x">На текущий день у вас один из лучших показателей по продажам. Так держать. </div>
</div>';
           }
       }

     }
    }

echo'</div>

        <div class="block-ppi">
        
        <div class="fin-na-100" style="margin-top:0px;">
<div class="fin-50" style="margin-top:0px;">
 <div class="h1-fin" style="margin-bottom:10px;">Ваши показатели</div>
 
 
<div class="pass_wh_y"><label>КПД</label><span>—%</span></div>
<div class="pass_wh_y"><label>КО</label><span>—%</span></div>';

$doc_count=0;
    $sql_user_buy = ' and A.datecreate>="'.$date_start_obo.'" and A.datecreate<"'.$date_end_obo.'"';

    $result_uuh = mysql_time_query($link, 'select DISTINCT count(A.id) as ccf from trips as A where A.commission_fix=0 and A.id_user='.ht($id_uuu).'  '.$sql_user_buy.'');
    $num_results_uuh = $result_uuh->num_rows;
if($num_results_uuh!=0) {
    $row_uuh = mysqli_fetch_assoc($result_uuh);
    $doc_count=$row_uuh["ccf"];
}



echo'<div class="pass_wh_y"><label>Договоров</label><span>'.$doc_count.'</span></div>';

//Новых заявок
    $active_p=0;
    $result_uu_all = mysql_time_query($link, 'select count(R.id) as cc from preorders as R where R.id_company IN ('.$id_company.') and R.visible="1" and R.date_create>="'.$date_start_obo.' 00:00:00" and R.date_create<="'.$date_end_obo.' 23:59:59" and R.id_user='.ht($id_uuu).' ');
    $num_results_uu_all  = $result_uu_all ->num_rows;

    if ($num_results_uu_all  != 0) {
        $row_uu_all  = mysqli_fetch_assoc($result_uu_all );
        if($row_uu_all["cc"]!='')
        {
            $active_p=$row_uu_all["cc"];
        }
    }


echo'<div class="pass_wh_y"><label>Обращений</label><span>'.$active_p.'</span></div>
 
        
 </div>
<div class="fin-50">
<div class="h1-fin" style="margin-bottom:10px;">Направления продаж</div>

<div class="js-count-trips-c trips-cc-22" style="display: block;">';

    $sql_user_buy = ' and A.datecreate>="'.$date_start_obo.'" and A.datecreate<"'.$date_end_obo.'"';

    $result_uuh = mysql_time_query($link, 'select Z.* from (select DISTINCT A.id,A.comment,A.flight_there_route,A.id_user,A.place_name,A.hotel,A.datecreate,A.id_country,A.count_day from trips as A where A.commission_fix=0 and A.id_user='.ht($id_uuu).'  '.$sql_user_buy.') Z order by Z.id_country,Z.datecreate desc');




    $num_results_uuh = $result_uuh->num_rows;

    $mass_country = array();
    $mass_country_count_trips= array();
    if ($result_uuh) {



        $i = 0;
        $count_trips=0;
        while ($row_uuh = mysqli_fetch_assoc($result_uuh)) {

            $id_link='';
            if($i==0)
            {
                array_push($mass_country, $row_uuh['id_country']);
                $id_link='id="'.$row_uuh['id_country'].'-bb"';
            }
            $i++;

            if( end($mass_country)!=$row_uuh['id_country']) {
                $id_link='id="'.$row_uuh['id_country'].'-bb"';
                array_push($mass_country, $row_uuh['id_country']);
                array_push($mass_country_count_trips, $count_trips);
                $count_trips=1;

            } else
            {
                $count_trips++;
            }

            $kuda_trips='';


            $result_uu = mysql_time_query($link, 'select name from trips_country where id="' . ht($row_uuh ["id_country"]) . '"');
            $num_results_uu = $result_uu->num_rows;

            if ($num_results_uu != 0) {
                $row_uu = mysqli_fetch_assoc($result_uu);
                $kuda_trips.=$row_uu["name"];
            }
        }

        array_push($mass_country_count_trips, $count_trips);

    }



    for ($i = 0; $i < count($mass_country); $i++) {


        $result_uu = mysql_time_query($link, 'select name from trips_country where id="' . ht($mass_country[$i]) . '"');
        $num_results_uu = $result_uu->num_rows;

        if ($num_results_uu != 0) {
            $row_uu = mysqli_fetch_assoc($result_uu);
            echo'<div link="'.$mass_country[$i].'" class="list-country-c js-list-country-c">'.$row_uu["name"].'<i>'.$mass_country_count_trips[$i].'</i></div>';


        }


    }
/*
<div link="1" class="list-country-c ">Турция<i>1</i></div>
<div link="2" class="list-country-c ">Россия<i>1</i></div>
<div link="2" class="list-country-c list-country-c-more ">ОАЭ<i>11</i></div>
*/

echo'</div>

</div></div>
        

        
        
        
        </div>

    </div>';
}


  ?>




	<div class=" bill_wallet">

				<?
		echo'<div class=" cell_small '.$pp_class.'">';
			if($uoo_pp==1)
			{
			  echo'<div class="cell_1">';
			}

			echo'<div class="text_wallet1 padd"><span class="bill_str1">→</span>комиссия '.$month_rus1.'</div>';

			echo'<span class="pay_summ_bill1">'.rtrim(rtrim(number_format($row_status22["sum"], 2, '.', ' '),'0'),'.').'</span>';

			if($uoo_pp==1)
			{






				echo'</div><div class="cell_2">';

				echo'<div class="text_wallet1 padd"><span class="bill_str1">~</span>предполагаемая комиссия '.$month_rus1.'</div>';

			echo'<span class="pay_summ_bill1">~'.rtrim(rtrim(number_format($all_comm, 2, '.', ' '),'0'),'.').'</span>';
							echo'</div>';
  }


			echo'</div>';


		?>

				<?
  if (( isset($_COOKIE["su_5s".$id_user]))and(is_numeric($_COOKIE["su_5s".$id_user]))and(array_search($_COOKIE["su_5s".$id_user],$os_id5)!==false)and($_COOKIE["su_5s".$id_user]==0))
  {
      echo'<div class="cell_small cell_big flex_pp"><div class="cell_1">';
					echo'<div class="text_wallet1 padd"><span class="bill_str1">→</span>К выплате</div>';





						} else
						{

	  	     if((($sign_admin==1)or($sign_level>1))and(!isset($_COOKIE["su_5s".$id_user])))
		 {
             echo'<div class="cell_small cell_big  flex_pp"><div class="cell_1">';
				 	echo'<div class="text_wallet1 padd"><span class="bill_str1">→</span>К выплате</div>';
			 } else {
                 echo'<div class="cell_small cell_big flex_pp"><div class="cell_1">';
					echo'<div class="text_wallet1 padd"><span class="bill_str1">→</span>Личные бонусы</div>';}

						}

			echo'<span class="pay_summ_bill1">'.rtrim(rtrim(number_format($bonus, 2, '.', ' '),'0'),'.').'</span>';

  echo'</div>';
  echo'<div class="cell_2">';

                echo'<div class="text_wallet1 padd"><span class="bill_str1">→</span>Продаж на сумму</div>';

                $sql_kogo=' and a.id_user="'.ht($id_user).'"';
                if(((( isset($_COOKIE["su_5s".$id_user]))and(is_numeric($_COOKIE["su_5s".$id_user]))and(array_search($_COOKIE["su_5s".$id_user],$os_id5)!==false)and($_COOKIE["su_5s".$id_user]!=0))or(!isset($_COOKIE["su_5s".$id_user])))and(($sign_admin==1)or($sign_level>1)))
                {
                    $sql_kogo=' and a.id_user="'.ht($_COOKIE["su_5s".$id_user]).'"';
                }
                if(((( isset($_COOKIE["su_5s".$id_user]))and(is_numeric($_COOKIE["su_5s".$id_user]))and(array_search($_COOKIE["su_5s".$id_user],$os_id5)!==false)and($_COOKIE["su_5s".$id_user]==0))or(!isset($_COOKIE["su_5s".$id_user])))and(($sign_admin==1)or($sign_level>1)))
                {
                    $sql_kogo='';
                }


                $sum_no=0;

                if((($sign_level==3)or($sign_level==4))and($sql_kogo=='')) {


                    $result_uu = mysql_time_query($link, 'select sum(a.cost_client) as summ from trips as a,trips_contract as b where a.id_contract=b.id and a.id_a_company IN (' . $id_company . ') and a.status=1 and b.date_doc>="' . $date_start_obo . '" and a.buy_clients=0 and b.date_doc<"' . $date_end_obo . '" and a.visible=1 ' . $sql_kogo);
                } else
                {
                    $result_uu = mysql_time_query($link, 'select sum(a.cost_client) as summ from trips as a,trips_contract as b where a.id_contract=b.id and a.id_a_company IN (' . $id_company . ') and a.commission_fix=0 and a.status=1 and b.date_doc>="' . $date_start_obo . '" and a.buy_clients=0 and b.date_doc<"' . $date_end_obo . '" and a.visible=1 ' . $sql_kogo);




                }



                $num_results_uu = $result_uu->num_rows;

                if ($num_results_uu != 0) {



                    $row_uu = mysqli_fetch_assoc($result_uu);
                    $sum_no=$row_uu["summ"];
                    }

                $sum_yes=0;
                if((($sign_level==3)or($sign_level==4))and($sql_kogo=='')) {
                    $result_uu = mysql_time_query($link, 'select sum(a.paid_client) as summ from trips as a,trips_contract as b  where a.id_contract=b.id and a.id_a_company IN (' . $id_company . ') and a.status=1 and b.date_doc>="' . $date_start_obo . '" and a.buy_clients=1 and b.date_doc<"' . $date_end_obo . '" and a.visible=1 ' . $sql_kogo);
                } else
                {
                    $result_uu = mysql_time_query($link, 'select sum(a.paid_client) as summ from trips as a,trips_contract as b  where a.id_contract=b.id and a.id_a_company IN (' . $id_company . ') and  a.status=1 and a.commission_fix=0 and b.date_doc>="' . $date_start_obo . '" and a.buy_clients=1 and b.date_doc<"' . $date_end_obo . '" and a.visible=1 ' . $sql_kogo);
                }


                $num_results_uu = $result_uu->num_rows;

                if ($num_results_uu != 0) {



                    $row_uu = mysqli_fetch_assoc($result_uu);
                    $sum_yes=$row_uu["summ"];
                    }

                    echo'<span class="pay_summ_bill1">'.rtrim(rtrim(number_format(($sum_yes+$sum_no), 2, '.', ' '),'0'),'.').'</span>';




  echo'</div>';

				?>
			</div>
	<?
	$class_level='level_50';
  if ((( !isset($_COOKIE["su_2s".$id_user]))or($_COOKIE["su_2s".$id_user]==0))and(($sign_admin!=1)and($sign_level==1)))
  {

		$ost_do_level=$row_status_b["sum_end"]-$row_status22["sum"];

		if($ost_do_level<7000)
		{
			$class_level='';
	echo'<div class=" cell_more">';



		echo'<div class="level_mess"><div class="not_boolingh"></div><span class="h5"><span>Необходимо еще получить комиссию в размере <strong>'.rtrim(rtrim(number_format(($row_status_b["sum_end"]-$row_status22["sum"]), 2, '.', ' '),'0'),'.').' руб.</strong> для перехода на следующий бонусный уровень</span></span></div>';


		?>
	</div>
		<?
		}

 }
		  if (((( isset($_COOKIE["su_5s".$id_user]))and(is_numeric($_COOKIE["su_5s".$id_user]))and(array_search($_COOKIE["su_5s".$id_user],$os_id5)!==false)and($_COOKIE["su_5s".$id_user]==0))or(!isset($_COOKIE["su_5s".$id_user])))and(($sign_admin==1)or($sign_level>1)))
  {
		  } else
		  {
	echo'<div class=" cell_more1 '.$class_level.'">';
		  }

	$class_color_level='';
	if($row_status_b["level"]==1)
	{
		$class_color_level='red_level';
	}

	if($row_status_b["level"]==2)
	{
		$class_color_level='orange_level';
	}

	  if(((( isset($_COOKIE["su_5s".$id_user]))and(is_numeric($_COOKIE["su_5s".$id_user]))and(array_search($_COOKIE["su_5s".$id_user],$os_id5)!==false)and($_COOKIE["su_5s".$id_user]==0))or(!isset($_COOKIE["su_5s".$id_user])))and(($sign_admin==1)or($sign_level>1)))
  {
		  //выводим общую статистику кто сколько коммиссия сколько бонусов



      $mass_ei=users_hierarchy($id_user,$link);
      rm_from_array($id_user,$mass_ei);
      $mass_ei= array_unique($mass_ei);

      //если это главный менеджер то добавить и себя в статистику общую
      if($sign_level==2)
      {
          array_push($mass_ei, $id_user);
      }


      foreach ($mass_ei as $keys => $value)
      {
          $result_work_zz=mysql_time_query($link,'Select a.name_user,a.id,a.id_company from r_user as a,r_role as b where a.id_role =b.id and ((b.role="works")or(b.role="gworks")) and a.id="'.$value.'" and a.enabled=1');
          $num_results_work_zz = $result_work_zz->num_rows;
          if($num_results_work_zz!=0)
          {

              for ($i=0; $i<$num_results_work_zz; $i++)
              {
                  $row_8 = mysqli_fetch_assoc($result_work_zz);
                  echo'<div class=" cell_more1 level_50 ww_100">';

                  $result_status22=mysql_time_query($link,'SELECT a.sum,a.sum_fix from users_commission_trips as a where a.id_users="'.$row_8["id"].'" and a.date="'.$month_s.'"');

                 // echo('SELECT a.sum,a.sum_fix from users_commission_trips as a where a.id_users="'.$row_8["id"].'" and a.date="'.$month_s.'"');
                  if($result_status22->num_rows!=0)
                  {
                      $row_status22 = mysqli_fetch_assoc($result_status22);
                  }

                  $bonus=0;
                  $fix=0;
//echo($row_status22["sum_fix"]);
                  if($row_status22["sum_fix"]!='')
                  {
                      $fix=$row_status22["sum_fix"];
                  }


                  $result_status_b=mysql_time_query($link,'SELECT a.* from users_commission_level as a where a.id_users="'.$row_8["id"].'" and a.sum_start<="'.$row_status22["sum"].'" and a.sum_end>"'.$row_status22["sum"].'"  and a.dates="'.$date_level_bonus.'"  and a.id_company IN ('.ht($id_company).')');

                  if($result_status_b->num_rows==0) {
                      $result_status_b = mysql_time_query($link, 'SELECT a.* from users_commission_level as a where a.id_users=0 and a.sum_start<="' . $row_status22["sum"] . '" and a.sum_end>"' . $row_status22["sum"] . '"  and a.dates="' . $date_level_bonus . '"  and a.id_company IN (' . ht($id_company) . ')');
                  }
                  if($result_status_b->num_rows!=0)
                  {
                      $row_status_b = mysqli_fetch_assoc($result_status_b);
                      if($row_status_b["level"]!=1)
                      {
                          $bonus=($row_status22["sum"]*$row_status_b["proc"])/100;
                      }
                  }

                  $class_color_level='';
                  if($row_status_b["level"]==1)
                  {
                      $class_color_level='red_level';
                  }

                  if($row_status_b["level"]==2)
                  {
                      $class_color_level='orange_level';
                  }


                  echo'<div class="material-prime-v2 level_more '.$class_color_level.'">
	
	<div class="le_1">'.$row_8["name_user"];



                  echo '<span class="edit_panel11_mat"><span data-tooltip="узнать limit level" for="' . $row_8["id"] . '" class="history_icon_level">M</span>';

                              echo '<div class="history_act_mat history-prime-mat">
                                             <div class="line_brock"><div class="count_brock count_brock_1"><span>Уровень</span></div><div class="count_brock count_brock_2"><span>Комиссия</span></div><div class="count_brock count_brock_3"><span>Процент</span></div></div>';



//для конкретного пользователя
                  $result_uu_xo = mysql_time_query($link, 'SELECT a.* from users_commission_level as a where a.id_users="'.$row_8["id"].'" and a.dates="'.$date_level_bonus.'" and a.id_company IN (' . ht($id_company) . ') order by a.level');

                  /*   echo('SELECT a.* from users_commission_level as a where a.id_users="'.$row_8["id"].'" and a.dates="'.$date_level_bonus.'" and a.id_company IN (' . ht($id_company) . ') order by a.level');
*/
                  if($result_uu_xo->num_rows==0) {
//общее если нет конкретики по уровням
                      $result_uu_xo = mysql_time_query($link, 'SELECT a.* from users_commission_level as a where a.id_users=0 and a.dates="' . $date_level_bonus . '" and a.id_company IN (' . ht($row_8["id_company"]) . ') order by a.level');



                  }




                                  while ($row_uu_xo = mysqli_fetch_assoc($result_uu_xo)) {


                                      echo '<div class="line_brock"><div class="count_brock count_brock_1">'.$row_uu_xo["level"].'</div><div class="count_brock count_brock_2">' . rtrim(rtrim(number_format($row_uu_xo["sum_start"], 2, '.', ' '),'0'),'.') . '<b>₽</b> - ' . rtrim(rtrim(number_format($row_uu_xo["sum_end"], 2, '.', ' '),'0'),'.') . '<b>₽</b></div>
<div class="count_brock count_brock_3">';
                                      echo $row_uu_xo["proc"].'<b>%</b>';


                                      echo'</div>

</div>';

                                  }


                              echo'</div>';
                              echo '</span>';




                  echo'</div>
	<div class="le_2">'.rtrim(rtrim(number_format(($row_status22["sum"]), 2, '.', ' '),'0'),'.').' РУБ.</div>	
	
	</div>';
                  echo'<div class="level_more_j">


<strong>'.rtrim(rtrim(number_format(($bonus), 2, '.', ' '),'0'),'.').' руб.';

                  if($fix!=0)
                  {
                      echo' + <i data-tooltip="Фиксированные выплаты" style="font-style: normal;border-radius: 2px; background-color: #ffec57;padding: 0 5px;">'.rtrim(rtrim(number_format(($fix), 2, '.', ' '),'0'),'.').' руб.</i>';
                  }

                  echo'</strong> <span>('.$row_status_b["level"].' бонусный уровень)</span>';




echo'</div>';







                  echo'</div>';

              }
          }

      }





	  } else
	  {
	echo'<div class="level_more material-prime-v2 '.$class_color_level.'">'.$row_status_b["level"].' бонусный уровень <strong>('.$row_status_b["proc"].'%)</strong>';



          echo '<span class="edit_panel11_mat"><span data-tooltip="узнать limit level" for="' . $row_8["id"] . '" class="history_icon_level">M</span>';

          echo '<div class="history_act_mat history-prime-mat">
                                             <div class="line_brock"><div class="count_brock count_brock_1"><span>Уровень</span></div><div class="count_brock count_brock_2"><span>Комиссия</span></div><div class="count_brock count_brock_3"><span>Процент</span></div></div>';


          $id_users_moss=$id_user;

        if((isset($_COOKIE["su_5s".$id_user]))and($_COOKIE["su_5s".$id_user]!=0)and(($sign_admin==1)or($sign_level>1)))
        {

            $id_users_moss=$_COOKIE["su_5s".$id_user];

        }


//для конкретного пользователя
          $result_uu_xo = mysql_time_query($link, 'SELECT a.* from users_commission_level as a where a.id_users="'.ht($id_users_moss).'" and a.dates="'.$date_level_bonus.'" and a.id_company IN (' . ht($id_company) . ') order by a.level');

          if($result_uu_xo->num_rows==0) {
//общее если нет конкретики по уровням

              $result_uu__p = mysql_time_query($link, 'select id_company from r_user where id="' . ht($id_users_moss) . '"');
              $num_results_uu__p = $result_uu__p->num_rows;

              if ($num_results_uu__p != 0) {
                  $row_uu__p = mysqli_fetch_assoc($result_uu__p);
              }


              $result_uu_xo = mysql_time_query($link, 'SELECT a.* from users_commission_level as a where a.id_users=0 and a.dates="' . $date_level_bonus . '" and a.id_company IN (' . ht($row_uu__p["id_company"]) . ') order by a.level');

              //echo('SELECT a.* from users_commission_level as a where a.id_users=0 and a.dates="' . $date_level_bonus . '" and a.id_company IN (' . ht($id_company) . ') order by a.level');

          }




          while ($row_uu_xo = mysqli_fetch_assoc($result_uu_xo)) {


              echo '<div class="line_brock"><div class="count_brock count_brock_1">'.$row_uu_xo["level"].'</div><div class="count_brock count_brock_2">' . rtrim(rtrim(number_format($row_uu_xo["sum_start"], 2, '.', ' '),'0'),'.') . '<b>₽</b> - ' . rtrim(rtrim(number_format($row_uu_xo["sum_end"], 2, '.', ' '),'0'),'.') . '<b>₽</b></div>
<div class="count_brock count_brock_3">';
              echo $row_uu_xo["proc"].'<b>%</b>';


              echo'</div>

</div>';

          }


          echo'</div>';
          echo '</span>';





          echo'</div>';
		echo'<div class="level_more_j">комиссия < <strong>'.rtrim(rtrim(number_format(($row_status_b["sum_end"]), 2, '.', ' '),'0'),'.').' руб.</strong></div>';
	  }

			  if (((( isset($_COOKIE["su_5s".$id_user]))and(is_numeric($_COOKIE["su_5s".$id_user]))and(array_search($_COOKIE["su_5s".$id_user],$os_id5)!==false)and($_COOKIE["su_5s".$id_user]==0))or(!isset($_COOKIE["su_5s".$id_user])))and(($sign_admin==1)or($sign_level>1)))
  {

			  } else
			  {
				  echo'</div>';
			  }
		?>



	</div>
<!--<li><a href="/">Главная</a></li>-->
<?
if ((!isset($_COOKIE["su_5s".$id_user]))or(( isset($_COOKIE["su_5s".$id_user]))and(($_COOKIE["su_5s".$id_user]==0))))
{
    if(($sign_admin==1)or($sign_level>1))
    {
        echo'<strong class="str_f_1">Общая статистика '.$month_rus1.'</strong>';
        } else
    {
        if(($sign_admin!=1)and($sign_level==1)) {
            echo '<strong class="str_f_1">Ваша статистика ' . $month_rus1 . '</strong>';
        } else
        {
            echo'<strong class="str_f_1">Cтатистика '.$month_rus1.'</strong>';
        }

}
//echo'<strong class="str_f_1">Ваша статистика '.$month_rus1.'</strong>';

}
?>

	 <div class="flex_stati">
	 <div class="oka_fact_1">

<?
//*************************************************

?>

<?

$mass_ei=users_hierarchy($id_user,$link);
//rm_from_array($id_user,$mass_ei);
array_push($mass_ei, $id_user);
$mass_ei= array_unique($mass_ei);


//ПРОДАЖ ЗА МЕСЯЦ
//*************************************************
//по умолчанию текущий месяц
$date_start=date("Y-m-").'01 00:00:00';
$date_end=date_step_sql('Y-m','+1m').'-01 00:00:00';



//$sql_line1=' and b.datetime>="'.$date_start.'" and b.datetime<"'.$date_end.'"';

if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==1))
{
   //прошлый месяц
$date_end=date("Y-m-").'01 00:00:00';
$date_start=date_step_sql('Y-m','-1m').'-01 00:00:00';
}
if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==3))
{
    //-1 месяц
    $date_end=date_step_sql('Y-m','-1m').'-01 00:00:00';
    $date_start=date_step_sql('Y-m','-2m').'-01 00:00:00';
}
if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==4))
{
    //-2 месяц
    $date_end=date_step_sql('Y-m','-2m').'-01 00:00:00';
    $date_start=date_step_sql('Y-m','-3m').'-01 00:00:00';
}
$sql_line1=' and a.datecreate>="'.$date_start.'" and a.datecreate<"'.$date_end.'"';


//выбрал конкретный период
if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==2))
 {


	$date_range=explode("/",$_COOKIE["sudds".$id_user]);
	$sql_line1=' and b.datetime>="'.htmlspecialchars(trim($date_range[0])).' 00:00:00" and b.datetime<"'.htmlspecialchars(trim($date_range[1])).' 00:00:00"';
 }

	//по умолчанию для обычного пользователя
		 $sql_line=' and a.id_user="'.$id_user.'" ';

		 if($sign_admin==1)
		 {
			$sql_line='';
		 }

		 if(($sign_level>1)and($sign_admin!=1))
         {
             $sql_line=' and a.id_user in('.implode(',',$mass_ei).')';
         }

			  if (( isset($_COOKIE["su_5s".$id_user]))and(is_numeric($_COOKIE["su_5s".$id_user]))and(array_search($_COOKIE["su_5s".$id_user],$os_id5)!==false)and($_COOKIE["su_5s".$id_user]==0)and(($sign_admin==1)or($sign_level>1)))
  {
			$sql_line='';
      if($sign_level==2)
      {
          $sql_line=' and a.id_user in('.implode(',',$mass_ei).')';
      }
  } else
			  {
				  if (( isset($_COOKIE["su_5s".$id_user]))and(is_numeric($_COOKIE["su_5s".$id_user]))and(array_search($_COOKIE["su_5s".$id_user],$os_id5)!==false)and(($sign_admin==1)or($sign_level>1)))
                  {
					  $sql_line=' and a.id_user="'.$_COOKIE["su_5s".$id_user].'" ';
				  }
			  }

$result_scores3=mysql_time_query($link,'SELECT count(a.id) as cc FROM trips AS a WHERE a.id_a_company IN ('.$id_company.') and a.visible=1 '.$sql_line.' '.$sql_line1);


$row__223= mysqli_fetch_assoc($result_scores3);

echo'<div class="gr-50"><span class="span-4">'.$row__223["cc"].'</span>';
echo'<strong>'.PadejNumber($row__223["cc"],'продажа за месяц,продажи за месяц,продаж за месяц').'</strong></div>';
//*************************************************
//*************************************************
?>

<?

//*************************************************
//выполненных задач
//по умолчанию текущий месяц

$date_start=date("Y-m-").'01 00:00:00';
$date_end=date_step_sql('Y-m','+1m').'-01 00:00:00';

$sql_line1=' and a.datetimes>="'.$date_start.'" and a.datetimes<"'.$date_end.'"';
if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==1))
 {
   //прошлый месяц
$date_end=date("Y-m-").'01 00:00:00';
$date_start=date_step_sql('Y-m','-1m').'-01 00:00:00';

$sql_line1=' and a.datetimes>="'.$date_start.'" and a.datetimes<"'.$date_end.'"';
}
if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==3))
{
    //-1 месяц
    $date_end=date_step_sql('Y-m','-1m').'-01 00:00:00';
    $date_start=date_step_sql('Y-m','-2m').'-01 00:00:00';

    $sql_line1=' and a.datetimes>="'.$date_start.'" and a.datetimes<"'.$date_end.'"';
}
if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==4))
{
    //-2 месяц
    $date_end=date_step_sql('Y-m','-2m').'-01 00:00:00';
    $date_start=date_step_sql('Y-m','-3m').'-01 00:00:00';

    $sql_line1=' and a.datetimes>="'.$date_start.'" and a.datetimes<"'.$date_end.'"';
}


$result_scores3=mysql_time_query($link,'SELECT count(distinct a.id) as cc FROM task_status_history_new AS a,task_new as c WHERE c.id_a_group IN ('.$id_group_u.') and c.id=a.id_task and a.action_history=5 and c.status=1 '.$sql_line.' '.$sql_line1);

$row__223= mysqli_fetch_assoc($result_scores3);

echo'<div class="gr-50"><span class="span-4 span-4-blue">'.$row__223["cc"].'</span>';
echo'<strong>'.PadejNumber($row__223["cc"],'выполненная задача,выполненные задачи,выполненных задач').'</strong></div>';
//*************************************************
//*************************************************


//*************************************************
//невыполненных задач
//по умолчанию текущий месяц

$date_start=date("Y-m-").'01 00:00:00';
$date_end=date_step_sql('Y-m','+1m').'-01 00:00:00';

$sql_line1=' and a.ring_datetime>="'.$date_start.'" and a.ring_datetime<"'.$date_end.'"';
if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==1))
 {
   //прошлый месяц

$date_end=date("Y-m-").'01 00:00:00';
$date_start=date_step_sql('Y-m','-1m').'-01 00:00:00';

$sql_line1=' and a.ring_datetime>="'.$date_start.'" and a.ring_datetime<"'.$date_end.'"';
}

if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==3))
{
    //-1 месяц
    $date_end=date_step_sql('Y-m','-1m').'-01 00:00:00';
    $date_start=date_step_sql('Y-m','-2m').'-01 00:00:00';

    $sql_line1=' and a.ring_datetime>="'.$date_start.'" and a.ring_datetime<"'.$date_end.'"';
}
if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==4))
{
    //-2 месяц
    $date_end=date_step_sql('Y-m','-2m').'-01 00:00:00';
    $date_start=date_step_sql('Y-m','-3m').'-01 00:00:00';

    $sql_line1=' and a.ring_datetime>="'.$date_start.'" and a.ring_datetime<"'.$date_end.'"';
}

//выбрал конкретный период
if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==2))
 {


	$date_range=explode("/",$_COOKIE["sudds".$id_user]);
	$sql_line1=' and a.ring_datetime>="'.htmlspecialchars(trim($date_range[0])).' 00:00:00" and a.ring_datetime<"'.htmlspecialchars(trim($date_range[1])).' 00:00:00"';
 }


$sql_line=' and a.id_user_responsible="'.$id_user.'" ';
if($sign_admin==1)
{
    $sql_line='';
}

if(($sign_level>1)and($sign_admin!=1))
{
    $sql_line=' and a.id_user_responsible in('.implode(',',$mass_ei).')';
}

if (( isset($_COOKIE["su_5s".$id_user]))and(is_numeric($_COOKIE["su_5s".$id_user]))and(array_search($_COOKIE["su_5s".$id_user],$os_id5)!==false)and($_COOKIE["su_5s".$id_user]==0)and(($sign_admin==1)or($sign_level>1)))
{
    $sql_line='';
    if($sign_level==2)
    {
        $sql_line=' and a.id_user_responsible in('.implode(',',$mass_ei).')';
    }
} else
{
    if (( isset($_COOKIE["su_5s".$id_user]))and(is_numeric($_COOKIE["su_5s".$id_user]))and(array_search($_COOKIE["su_5s".$id_user],$os_id5)!==false)and(($sign_admin==1)or($sign_level>1)))
    {
        $sql_line=' and a.id_user_responsible="'.$_COOKIE["su_5s".$id_user].'" ';
    }
}


$result_scores3=mysql_time_query($link,'SELECT count(distinct a.id) as cc FROM task_new as a WHERE a.id_a_group IN ('.$id_group_u.') and a.reminder=0 and a.status=0 '.$sql_line.' '.$sql_line1);



$row__223= mysqli_fetch_assoc($result_scores3);

echo'<div class="gr-50"><span class="span-4" style="background-color:#fd8080;">'.$row__223["cc"].'</span>';
echo'<strong>'.PadejNumber($row__223["cc"],'невыполненная задача,невыполненные задачи,невыполненных задач').'</strong></div>';
//*************************************************
//*************************************************

?>


<?

         //ОБРАЩЕНИЙ ЗА МЕСЯЦ
         //*************************************************
         //по умолчанию текущий месяц
         $date_start=date("Y-m-").'01 00:00:00';
         $date_end=date_step_sql('Y-m','+1m').'-01 00:00:00';


         //$sql_line1=' and b.datetime>="'.$date_start.'" and b.datetime<"'.$date_end.'"';

         if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==1))
         {
         //прошлый месяц
         $date_end=date("Y-m-").'01 00:00:00';
         $date_start=date_step_sql('Y-m','-1m').'-01 00:00:00';
         }
         if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==3))
         {
         //-1 месяц
         $date_end=date_step_sql('Y-m','-1m').'-01 00:00:00';
         $date_start=date_step_sql('Y-m','-2m').'-01 00:00:00';
         }

         if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==4))
         {
         //-2 месяц
         $date_end=date_step_sql('Y-m','-2m').'-01 00:00:00';
         $date_start=date_step_sql('Y-m','-3m').'-01 00:00:00';
         }

if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==5))
{
    //-2 месяц
    $date_end=date_step_sql('Y-m','-3m').'-01 00:00:00';
    $date_start=date_step_sql('Y-m','-4m').'-01 00:00:00';
}
if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==6))
{
    //-2 месяц
    $date_end=date_step_sql('Y-m','-4m').'-01 00:00:00';
    $date_start=date_step_sql('Y-m','-5m').'-01 00:00:00';
}
if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==7))
{
    //-2 месяц
    $date_end=date_step_sql('Y-m','-5m').'-01 00:00:00';
    $date_start=date_step_sql('Y-m','-6m').'-01 00:00:00';
}
if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==8))
{
    //-2 месяц
    $date_end=date_step_sql('Y-m','-6m').'-01 00:00:00';
    $date_start=date_step_sql('Y-m','-7m').'-01 00:00:00';
}
if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==9))
{
    //-2 месяц
    $date_end=date_step_sql('Y-m','-7m').'-01 00:00:00';
    $date_start=date_step_sql('Y-m','-8m').'-01 00:00:00';
}
if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==10))
{
    //-2 месяц
    $date_end=date_step_sql('Y-m','-8m').'-01 00:00:00';
    $date_start=date_step_sql('Y-m','-9m').'-01 00:00:00';
}
if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==11))
{
    //-2 месяц
    $date_end=date_step_sql('Y-m','-9m').'-01 00:00:00';
    $date_start=date_step_sql('Y-m','-10m').'-01 00:00:00';
}
if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==12))
{
    //-2 месяц
    $date_end=date_step_sql('Y-m','-10m').'-01 00:00:00';
    $date_start=date_step_sql('Y-m','-11m').'-01 00:00:00';
}
if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==13))
{
    //-2 месяц
    $date_end=date_step_sql('Y-m','-11m').'-01 00:00:00';
    $date_start=date_step_sql('Y-m','-12m').'-01 00:00:00';
}

$sql_line1=' and a.date_create>="'.$date_start.'" and a.date_create<"'.$date_end.'"';


         //выбрал конкретный период
         if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==2))
         {


         $date_range=explode("/",$_COOKIE["sudds".$id_user]);
         $sql_line1=' and a.date_create>="'.htmlspecialchars(trim($date_range[0])).' 00:00:00" and a.date_create<"'.htmlspecialchars(trim($date_range[1])).' 00:00:00"';
         }

         //по умолчанию для обычного пользователя
         $sql_line=' and a.id_user="'.$id_user.'" ';

         if($sign_admin==1)
         {
         $sql_line='';
         }

         if(($sign_level>1)and($sign_admin!=1))
         {
         $sql_line=' and a.id_user in('.implode(',',$mass_ei).')';
         }

         if (( isset($_COOKIE["su_5s".$id_user]))and(is_numeric($_COOKIE["su_5s".$id_user]))and(array_search($_COOKIE["su_5s".$id_user],$os_id5)!==false)and($_COOKIE["su_5s".$id_user]==0)and(($sign_admin==1)or($sign_level>1)))
         {
         $sql_line='';
         if($sign_level==2)
         {
         $sql_line=' and a.id_user in('.implode(',',$mass_ei).')';
         }
         } else
         {
         if (( isset($_COOKIE["su_5s".$id_user]))and(is_numeric($_COOKIE["su_5s".$id_user]))and(array_search($_COOKIE["su_5s".$id_user],$os_id5)!==false)and(($sign_admin==1)or($sign_level>1)))
         {
         $sql_line=' and a.id_user="'.$_COOKIE["su_5s".$id_user].'" ';
         }
         }

         $result_scores3=mysql_time_query($link,'SELECT count(a.id) as cc FROM preorders AS a WHERE a.id_company IN ('.$id_company.') and a.visible=1 '.$sql_line.' '.$sql_line1);
//echo 'SELECT count(a.id) as cc FROM preorders AS a WHERE a.id_company="'.$id_company.'" and a.visible=1 '.$sql_line.' '.$sql_line1;

         $row__223= mysqli_fetch_assoc($result_scores3);

         echo'<div class="gr-50"><span class="span-4">'.$row__223["cc"].'</span>';
             echo'<strong>'.PadejNumber($row__223["cc"],'обращение за месяц,обращения за месяц,обращений за месяц').'</strong></div>';
         //*************************************************
         //*************************************************
         ?>


</div>
</div>
     <?
     /*
     if ((!isset($_COOKIE["su_5s".$id_user]))or(( isset($_COOKIE["su_5s".$id_user]))and(($_COOKIE["su_5s".$id_user]!=0))))
*/
     if ((!isset($_COOKIE["su_5s".$id_user]))or(( isset($_COOKIE["su_5s".$id_user]))))

     {

     ?>

     <div class="statistic-2022-graf">
<?

         echo'<div class="h1-fin">Статистика продаж за год</div>

         <div id="chartdiv2" style="min-height:300px;"></div></div>
         <div class="statistic-2022-graf">
         <div class="h1-fin">Сумма продаж за год</div>
         <div id="chartdiv3" style="min-height:300px;"></div>';
         $xy=array();
$xy1=array();
$date_end=date('Y-m-'.'01');

         $date_start_while=date_step_sql_more($date_end,'-12m');

$id_user_2022=$id_user;
if ((!isset($_COOKIE["su_5s".$id_user]))or(( isset($_COOKIE["su_5s".$id_user]))and(($_COOKIE["su_5s".$id_user]!=0))))
{
    if(isset($_COOKIE["su_5s".$id_user]))
    {
        $id_user_2022=$_COOKIE["su_5s".$id_user];
    }

}


         while ($date_start_while!= $date_end) {

         //какой то период выбран значит по нему и выводим
         $date_start_while22=date_step_sql_more($date_start_while,'+1m');





         $result_status22 = mysql_time_query($link, 'SELECT sum(a.sum) as summ from users_commission_trips as a,r_user as b where a.id_users=b.id '.$LIKE.' and  a.id_users='.ht($id_user_2022).' and a.date>="' . ht($date_start_while) . '" and  a.date<"' . ht($date_start_while22) . '"');


         $num_results_uu = $result_status22->num_rows;
         $hits=0;
         $bonus=0;
         if ($num_results_uu != 0) {
         $row_uu = mysqli_fetch_assoc($result_status22);
         if (($row_uu["summ"] != '') and ($row_uu["summ"] != 0)) {
         $hits=round($row_uu["summ"]);
         }

         }


         if($hits!=0)
         {

             $date_level_bonus='';

             $result_status_b=mysql_time_query($link,'SELECT a.* from users_commission_level as a where a.id_users="'.ht($id_user_2022).'" and a.sum_start<="'.$row_uu["summ"].'" and a.sum_end>"'.$row_uu["summ"].'"  and a.dates="'.$date_start_while22.'" and a.id_company IN ('.ht($id_company).')');

             if($result_status_b->num_rows==0)
             {
                 $result_status_b=mysql_time_query($link,'SELECT a.* from users_commission_level as a where a.id_users=0 and a.sum_start<="'.$row_uu["summ"].'" and a.sum_end>"'.$row_uu["summ"].'"  and a.dates="'.$date_start_while22.'" and a.id_company IN ('.ht($id_company).')');

             }


             if($result_status_b->num_rows!=0)
             {
                 $row_status_b = mysqli_fetch_assoc($result_status_b);
                 if($row_status_b["level"]!=1)
                 {
                     $bonus=round(($row_uu["summ"]*$row_status_b["proc"])/100);
                 }
             }

         }



         $result_uu = mysql_time_query($link, 'select count(id) as ss from trips where visible=1 and id_a_company IN ('.ht($id_company).') and id_user="'.ht($id_user_2022).'" and datecreate>="'.$date_start_while.'" and datecreate<"'.$date_start_while22.'" and commission_fix=0');
         $num_results_uu = $result_uu->num_rows;
         $views=0;

         if ($num_results_uu != 0) {
         $row_uu = mysqli_fetch_assoc($result_uu);
         if (($row_uu["ss"] != '') and ($row_uu["ss"] != 0)) {
         $views=$row_uu["ss"];
         }
         }
         $date_mass = explode("-", ht($date_start_while));
         //$xy[]['date']=$date_start_while;


/*
             $result_uu = mysql_time_query($link, 'select sum(cost_client) as ss from trips where visible=1 and id_a_company IN ('.ht($id_company).') and id_user="'.ht($id_user_2022).'" and datecreate>="'.$date_start_while.'" and datecreate<"'.$date_start_while22.'"');
*/

             $date_mass_ee = explode(" ", ht($date_start_while));
             $date_mass_nn = explode(" ", ht($date_start_while22));

             $result_uu = mysql_time_query($link, 'select sum(a.cost_client) as ss from trips as a,trips_contract as b where a.id_contract=b.id and a.id_a_company IN (' . $id_company . ') and a.id_user="'.ht($id_user_2022).'" and a.status=1 and a.commission_fix=0 and b.date_doc>="' . $date_mass_ee[0] . '" and b.date_doc<"' . $date_mass_nn[0] . '" and a.visible=1 ');



             $num_results_uu = $result_uu->num_rows;
             $bab=0;

             if ($num_results_uu != 0) {
                 $row_uu = mysqli_fetch_assoc($result_uu);
                 if (($row_uu["ss"] != '') and ($row_uu["ss"] != 0)) {
                     $bab=$row_uu["ss"];
                 }
             }
             $date_mass = explode("-", ht($date_start_while));



         $xy[] = ['views' => $views, 'hits' => $hits,'bonus'=>$bonus, 'date' => $date_start_while];
         $xy1[] = ['hits' => $bab,'date' => $date_start_while];
         $date_start_while=date_step_sql_more($date_start_while,'+1m');
         }



         $json2 = json_encode($xy);
         $json3 = json_encode($xy1);
         //print_r($json2);
         echo'<script src="public/no_public/core.js"></script>
         <script src="public/no_public/charts.js"></script>
         <script src="public/no_public/animated.js"></script>';
         echo'<script>

             am4core.ready(function() {

// Themes begin
                 am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
                 window.chart2 = am4core.create("chartdiv2", am4charts.XYChart);

// Increase contrast by taking evey second color
                 chart2.colors.step = 3;

                 chart2.data = ' . $json2 . ';
//chart2.dateFormatter.dateFormat = "yyyy-MM-dd";
                 chart2.dataDateFormat = "YYYY-MM-DD";

                 var dateAxis = chart2.xAxes.push(new am4charts.DateAxis());
                 dateAxis.renderer.minGridDistance = 20;
                 dateAxis.dateFormats.setKey("day", "MMMM");
                   dateAxis.cursorTooltipEnabled=false;
// Create series
                 function createAxisAndSeries(field, name, opposite, bullet) {
                    
                     var valueAxis = chart2.yAxes.push(new am4charts.ValueAxis());
             valueAxis.visible=false;
              valueAxis.cursorTooltipEnabled=false;
                       //  valueAxis.syncWithAxis = chart2.yAxes.getIndex(0);
                     

                     var series = chart2.series.push(new am4charts.LineSeries());
                     series.dataFields.valueY = field;
                     series.dataFields.dateX = "date";
                     series.strokeWidth = 2;
                     series.yAxis = valueAxis;
                     series.name = name;
                     series.dataFields.fill = am4core.color("#fff");


                     //series.fill = am4core.color("#434443");
                     series.tooltipText = "{name}: {valueY}[/]";

                     series.tooltip.getFillFromObject = false;
                     series.tooltip.background.fill = am4core.color("#fff");
                     series.tooltip.label.fontSize = 12;
                     series.tooltip.label.fill = am4core.color("#434443");
                     series.tooltip.label.fontFamily = "GEInspiraBold";

                     var segment = series.segments.template;
                     segment.interactionsEnabled = true;

                     var hs = segment.states.create("hover");
                     hs.properties.strokeWidth = 4;


                     //series.tensionX = 0;
                     series.showOnInit = true;

                     var interfaceColors = new am4core.InterfaceColorSet();

                     switch(bullet) {
                         case "triangle":
                             var bullet = series.bullets.push(new am4charts.Bullet());
                             bullet.width = 12;
                             bullet.height = 12;
                             bullet.horizontalCenter = "middle";
                             bullet.verticalCenter = "middle";
                             bullet.fill = am4core.color("#00b05a");

                             var triangle = bullet.createChild(am4core.Triangle);
                            triangle.stroke = interfaceColors.getFor("background");
                            // triangle.stroke.fill= am4core.color("#00b05a");
                             triangle.strokeWidth = 2;
                             triangle.direction = "top";
                             triangle.width = 12;
                             triangle.height = 12;
                             triangle.fill = am4core.color("#00b05a");

                             break;
                             
                         case "rectangle":
                             var bullet = series.bullets.push(new am4charts.Bullet());
                             bullet.width = 10;
                             bullet.height = 10;
                             bullet.horizontalCenter = "middle";
                             bullet.verticalCenter = "middle";

                             var rectangle = bullet.createChild(am4core.Rectangle);
                             rectangle.stroke = interfaceColors.getFor("background");
                             rectangle.strokeWidth = 2;
                             rectangle.width = 10;
                             rectangle.height = 10;
                             break;
                         default:
                             /*
                           var bullet = series.bullets.push(new am4charts.CircleBullet());
                           bullet.circle.stroke.fill = am4core.color("#434443");
                           bullet.circle.strokeWidth = 2;
                           */
                             var circleBullet = series.bullets.push(new am4charts.CircleBullet());
                             /*
                             circleBullet.fill=am4core.color("#fff");
                             circleBullet.circle.radius=10;
                             circleBullet.circle.fillOpacity=1;
                             circleBullet.circle.strokeWidth = 2;
                             circleBullet.strokeOpacity=1;
                             */
                             
                             var labelBullet = series.bullets.push(new am4charts.LabelBullet());
                             labelBullet.label.text = "{valueY}";
                             labelBullet.label.fontSize=14;
                             labelBullet.label.fill = am4core.color("#383738");
                             labelBullet.label.dy=-15;
                             labelBullet.label.fontFamily = "GEInspiraBold";
                             break;
                     }

                     valueAxis.renderer.line.strokeOpacity = 1;
                     valueAxis.renderer.line.strokeWidth = 2;
                     valueAxis.renderer.line.stroke = series.stroke;
                     //valueAxis.renderer.labels.template.fill = series.stroke;

                     //valueAxis.renderer.labels.fontSize = 12;
                     //valueAxis.renderer.labels.fill = am4core.color("#434443");
                     // valueAxis.renderer.labels.fontFamily = \"GEInspiraBold\";

                     valueAxis.renderer.labels.template.fill = am4core.color("#797779");
                     valueAxis.renderer.labels.template.fontSize = 12;
                     valueAxis.renderer.labels.template.fontFamily = "GEInspiraRegular";
                     valueAxis.renderer.opposite = opposite;

                     valueAxis.renderer.grid.template.strokeOpacity = 1;
                     valueAxis.renderer.grid.template.stroke = am4core.color("#eeefee");
                     valueAxis.renderer.grid.template.strokeWidth = 1;


//dateAxis.renderer.inside = true;

                     dateAxis.renderer.labels.template.fill = am4core.color("#797779");
                     dateAxis.renderer.labels.template.fontSize = 11;
                     dateAxis.renderer.labels.template.fontFamily = "GEInspiraRegular";


                 }

                 createAxisAndSeries("hits", "Комиссия", true, "rectangle");
                 createAxisAndSeries("bonus", "Бонусы", true, "triangle");
                 createAxisAndSeries("views", "Продажи", false, "");


// Add legend
                 chart2.legend = new am4charts.Legend();

// Add cursor
                 chart2.cursor = new am4charts.XYCursor();







                 //график номер 2
                 //график номер 2
                 //график номер 2

                  window.chart3 = am4core.create("chartdiv3", am4charts.XYChart);

// Increase contrast by taking evey second color
                 chart3.colors.step = 3;

                 chart3.data = ' . $json3 . ';

                 chart3.dataDateFormat = "YYYY-MM-DD";

                 var dateAxis = chart3.xAxes.push(new am4charts.DateAxis());
                 dateAxis.renderer.minGridDistance = 20;
                 dateAxis.dateFormats.setKey("day", "MMMM");
                   dateAxis.cursorTooltipEnabled=false;
// Create series
                 function createAxisAndSeries1(field, name, opposite, bullet) {

                     var valueAxis = chart3.yAxes.push(new am4charts.ValueAxis());
             valueAxis.visible=false;
              valueAxis.cursorTooltipEnabled=false;


                     var series = chart3.series.push(new am4charts.LineSeries());
                     series.dataFields.valueY = field;
                     series.dataFields.dateX = "date";
                     series.strokeWidth = 2;
                     series.yAxis = valueAxis;
                     series.name = name;
                     series.dataFields.fill = am4core.color("#fff");


                     //series.fill = am4core.color("#434443");
                     series.tooltipText = "{name}: {valueY}[/]";

                     series.tooltip.getFillFromObject = false;
                     series.tooltip.background.fill = am4core.color("#fff");
                     series.tooltip.label.fontSize = 12;
                     series.tooltip.label.fill = am4core.color("#434443");
                     series.tooltip.label.fontFamily = "GEInspiraBold";

                     var segment = series.segments.template;
                     segment.interactionsEnabled = true;

                     var hs = segment.states.create("hover");
                     hs.properties.strokeWidth = 4;


                     //series.tensionX = 0;
                     series.showOnInit = true;

                     var interfaceColors = new am4core.InterfaceColorSet();

                     switch(bullet) {
                         case "triangle":
                             var bullet = series.bullets.push(new am4charts.Bullet());
                             bullet.width = 12;
                             bullet.height = 12;
                             bullet.horizontalCenter = "middle";
                             bullet.verticalCenter = "middle";
                             bullet.fill = am4core.color("#00b05a");

                             var triangle = bullet.createChild(am4core.Triangle);
                            triangle.stroke = interfaceColors.getFor("background");
                            // triangle.stroke.fill= am4core.color("#00b05a");
                             triangle.strokeWidth = 2;
                             triangle.direction = "top";
                             triangle.width = 12;
                             triangle.height = 12;
                             triangle.fill = am4core.color("#00b05a");

                             break;

                         case "rectangle":
                             var bullet = series.bullets.push(new am4charts.Bullet());
                             bullet.width = 10;
                             bullet.height = 10;
                             bullet.horizontalCenter = "middle";
                             bullet.verticalCenter = "middle";

                             var rectangle = bullet.createChild(am4core.Rectangle);
                             rectangle.stroke = interfaceColors.getFor("background");
                             rectangle.strokeWidth = 2;
                             rectangle.width = 10;
                             rectangle.height = 10;
                             break;
                         default:
                             /*
                           var bullet = series.bullets.push(new am4charts.CircleBullet());
                           bullet.circle.stroke.fill = am4core.color("#434443");
                           bullet.circle.strokeWidth = 2;
                           */
                             var circleBullet = series.bullets.push(new am4charts.CircleBullet());
                             /*
                             circleBullet.fill=am4core.color("#fff");
                             circleBullet.circle.radius=10;
                             circleBullet.circle.fillOpacity=1;
                             circleBullet.circle.strokeWidth = 2;
                             circleBullet.strokeOpacity=1;
                             */

                             var labelBullet = series.bullets.push(new am4charts.LabelBullet());
                             labelBullet.label.text = "{valueY}";
                             labelBullet.label.fontSize=14;
                             labelBullet.label.fill = am4core.color("#383738");
                             labelBullet.label.dy=-15;
                             labelBullet.label.fontFamily = "GEInspiraBold";
                             break;
                     }

                     valueAxis.renderer.line.strokeOpacity = 1;
                     valueAxis.renderer.line.strokeWidth = 2;
                     valueAxis.renderer.line.stroke = series.stroke;
                     //valueAxis.renderer.labels.template.fill = series.stroke;

                     //valueAxis.renderer.labels.fontSize = 12;
                     //valueAxis.renderer.labels.fill = am4core.color("#434443");
                     // valueAxis.renderer.labels.fontFamily = \"GEInspiraBold\";

                     valueAxis.renderer.labels.template.fill = am4core.color("#797779");
                     valueAxis.renderer.labels.template.fontSize = 12;
                     valueAxis.renderer.labels.template.fontFamily = "GEInspiraRegular";
                     valueAxis.renderer.opposite = opposite;

                     valueAxis.renderer.grid.template.strokeOpacity = 1;
                     valueAxis.renderer.grid.template.stroke = am4core.color("#eeefee");
                     valueAxis.renderer.grid.template.strokeWidth = 1;


//dateAxis.renderer.inside = true;

                     dateAxis.renderer.labels.template.fill = am4core.color("#797779");
                     dateAxis.renderer.labels.template.fontSize = 11;
                     dateAxis.renderer.labels.template.fontFamily = "GEInspiraRegular";


                 }

                 createAxisAndSeries1("hits", "Общая сумма продаж", true, "rectangle");


// Add legend
                 chart3.legend = new am4charts.Legend();

// Add cursor
                 chart3.cursor = new am4charts.XYCursor();


















             }); // end am4core.ready()

         </script>



     </div>';

}


	/*
  $result_t2=mysql_time_query($link,'Select

  DISTINCT b.*,g.name

  from booking as b, booking_status as g

  where b.visible=1 and g.result_number=b.status and g.id_system=1 and b.id_object in('.implode(',',$hie->obj).') '.$sql_su2.' '.$sql_su3.' '.$sql_su4.' '.$sql_su5.' '.$sql_su1.' '.limitPage('n_st',$count_write));
	*/

//по умолчанию текущий месяц

$date_start=date("Y-m-").'01 00:00:00';
$date_end=date_step_sql('Y-m','+1m').'-01 00:00:00';



//$sql_line1=' and b.datetime>="'.$date_start.'" and b.datetime<"'.$date_end.'"';

if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==1))
{
    //прошлый месяц
    $date_end=date("Y-m-").'01 00:00:00';
    $date_start=date_step_sql('Y-m','-1m').'-01 00:00:00';
}
if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==3))
{
    //-1 месяц
    $date_end=date_step_sql('Y-m','-1m').'-01 00:00:00';
    $date_start=date_step_sql('Y-m','-2m').'-01 00:00:00';
}
if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==4))
{
    //-2 месяц
    $date_end=date_step_sql('Y-m','-2m').'-01 00:00:00';
    $date_start=date_step_sql('Y-m','-3m').'-01 00:00:00';
}
if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==5))
{
    //-2 месяц
    $date_end=date_step_sql('Y-m','-4m').'-01 00:00:00';
    $date_start=date_step_sql('Y-m','-5m').'-01 00:00:00';
}
if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==6))
{
    //-2 месяц
    $date_end=date_step_sql('Y-m','-5m').'-01 00:00:00';
    $date_start=date_step_sql('Y-m','-6m').'-01 00:00:00';
}
if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==7))
{
    //-2 месяц
    $date_end=date_step_sql('Y-m','-6m').'-01 00:00:00';
    $date_start=date_step_sql('Y-m','-7m').'-01 00:00:00';
}
if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==8))
{
    //-2 месяц
    $date_end=date_step_sql('Y-m','-7m').'-01 00:00:00';
    $date_start=date_step_sql('Y-m','-8m').'-01 00:00:00';
}
if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==9))
{
    //-2 месяц
    $date_end=date_step_sql('Y-m','-8m').'-01 00:00:00';
    $date_start=date_step_sql('Y-m','-9m').'-01 00:00:00';
}
if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==10))
{
    //-2 месяц
    $date_end=date_step_sql('Y-m','-9m').'-01 00:00:00';
    $date_start=date_step_sql('Y-m','-10m').'-01 00:00:00';
}
if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==11))
{
    //-2 месяц
    $date_end=date_step_sql('Y-m','-10m').'-01 00:00:00';
    $date_start=date_step_sql('Y-m','-11m').'-01 00:00:00';
}
if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==12))
{
    //-2 месяц
    $date_end=date_step_sql('Y-m','-11m').'-01 00:00:00';
    $date_start=date_step_sql('Y-m','-12m').'-01 00:00:00';
}
if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==13))
{
    //-2 месяц
    $date_end=date_step_sql('Y-m','-12m').'-01 00:00:00';
    $date_start=date_step_sql('Y-m','-13m').'-01 00:00:00';
}
$sql_line1=' and a.date_buy_all>="'.$date_start.'" and a.date_buy_all<"'.$date_end.'"';


//выбрал конкретный период
if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==2))
{


    $date_range=explode("/",$_COOKIE["sudds".$id_user]);
    $sql_line1=' and b.date_buy_all>="'.htmlspecialchars(trim($date_range[0])).' 00:00:00" and b.date_buy_all<"'.htmlspecialchars(trim($date_range[1])).' 00:00:00"';
}


$sql_line=' and a.id_user="'.$id_user.'" ';
if($sign_admin==1)
{
    $sql_line='';
}

if(($sign_level>1)and($sign_admin!=1))
{
    $sql_line=' and a.id_user in('.implode(',',$mass_ei).')';
}

if (( isset($_COOKIE["su_5s".$id_user]))and(is_numeric($_COOKIE["su_5s".$id_user]))and(array_search($_COOKIE["su_5s".$id_user],$os_id5)!==false)and($_COOKIE["su_5s".$id_user]==0)and(($sign_admin==1)or($sign_level>1)))
{
    $sql_line='';
    if($sign_level==2)
    {
        $sql_line=' and a.id_user in('.implode(',',$mass_ei).')';
    }
} else
{
    if (( isset($_COOKIE["su_5s".$id_user]))and(is_numeric($_COOKIE["su_5s".$id_user]))and(array_search($_COOKIE["su_5s".$id_user],$os_id5)!==false)and(($sign_admin==1)or($sign_level>1)))
    {
        $sql_line=' and a.id_user="'.$_COOKIE["su_5s".$id_user].'" ';
    }
}
$result_t2=mysql_time_query($link,'SELECT distinct a.id FROM trips AS a WHERE a.id_a_company IN ('.$id_company.') and a.visible=1 '.$sql_line.' '.$sql_line1);



  $sql_count='SELECT distinct count(a.id) as kol FROM trips AS a WHERE a.id_a_company IN ('.$id_company.') and a.visible=1 '.$sql_line.' '.$sql_line1;


$result_t221=mysql_time_query($link,$sql_count);
$row__221= mysqli_fetch_assoc($result_t221);



echo'<div class="okss"><span class="title_book yop_booking"><i>'.$row__221["kol"].'</i><span>'.PadejNumber($row__221["kol"],'бонусная история '.$month_rus1.',бонусная история '.$month_rus1.',бонусная история '.$month_rus1).'</span></span></div>';





                  $num_results_t2 = $result_t2->num_rows;
	              if($num_results_t2!=0)
	              {

				$com=0;
			    $cost=0;
				$count_y=0;
				$large_booking=1;  // краткий вывод

              while($row_88 = mysqli_fetch_assoc($result_t2))
              {

                  $result_uuy = mysql_time_query($link, 'select A.id,A.discount,A.doc,A.id_a_company, A.id_user,A.shopper,A.id_shopper,A.id_contract,A.comment,A.number_to,A.hotel,A.id_country,A.place_name,A.date_start,A.date_end,A.number_to,A.id_contract,A.cost_client,A.id_exchange,A.cost_operator_exchange,A.cost_operator,A.cost_client_exchange,A.buy_clients,A.buy_operator,A.paid_operator,A.paid_operator_rates,A.exchange_rates,A.paid_client,A.paid_client_rates,A.date_prepaid,A.comment,A.status_admin,A.
commission_fix from trips as A where A.id="' . ht($row_88['id']) . '"');
                  $num_results_uuy = $result_uuy->num_rows;

                  if ($num_results_uuy != 0) {
                      $row_8 = mysqli_fetch_assoc($result_uuy);
                  }


                  $prof=1;  //есть возможность выбирать несколько туров
                  include $url_system.'tours/code/block_tours.php';
                  echo($task_cloud_block);
			  }
				  }



  else
				  {

//echo'<div class="booking_div da_book1"><div class="not_booling"></div><span class="h4" style="width:calc(100% - 60px)"><span>Бонусная история за выбранный период пуста. Попробуйте изменить период.</span></span></div>';

echo'<div class="message_search_b"><span>Бонусная история за выбранный период пуста. Попробуйте изменить период.</span></div>';


				  }

?>



  <?
  $prof=0;
//$result_t2=mysql_time_query($link,'SELECT distinct c.*,d.name FROM booking_offers AS a,booking_status_history as b,booking as c,booking_status as d WHERE d.id_system=1 and d.result_number=c.status and c.id=a.id_booking and a.id_booking=b.id_booking and a.status=2 and c.visible=1 and (b.status=3) '.$sql_line.' '.$sql_line1);
  $date_start=date("Y-m-").'01 00:00:00';
  $date_end=date_step_sql('Y-m','+1m').'-01 00:00:00';



  //$sql_line1=' and b.datetime>="'.$date_start.'" and b.datetime<"'.$date_end.'"';

  if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==1))
  {
      //прошлый месяц
      $date_end=date("Y-m-").'01 00:00:00';
      $date_start=date_step_sql('Y-m','-1m').'-01 00:00:00';
  }
  if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==3))
  {
      //-1 месяц
      $date_end=date_step_sql('Y-m','-1m').'-01 00:00:00';
      $date_start=date_step_sql('Y-m','-2m').'-01 00:00:00';
  }
  if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==4))
  {
      //-2 месяц
      $date_end=date_step_sql('Y-m','-2m').'-01 00:00:00';
      $date_start=date_step_sql('Y-m','-3m').'-01 00:00:00';
  }
  $sql_line1=' and a.datecreate>="'.$date_start.'" and a.datecreate<"'.$date_end.'"';


  //выбрал конкретный период
  if (( isset($_COOKIE["su_2s".$id_user]))and(is_numeric($_COOKIE["su_2s".$id_user]))and($_COOKIE["su_2s".$id_user]==2))
  {


      $date_range=explode("/",$_COOKIE["sudds".$id_user]);
      $sql_line1=' and b.datecreate>="'.htmlspecialchars(trim($date_range[0])).' 00:00:00" and b.datecreate<"'.htmlspecialchars(trim($date_range[1])).' 00:00:00"';
  }



  $result_t2=mysql_time_query($link,'SELECT distinct a.id FROM trips AS a WHERE a.id_a_company IN ('.$id_company.') and a.visible=1 '.$sql_line.' '.$sql_line1);



  $sql_count='SELECT distinct count(a.id) as kol FROM trips AS a WHERE a.id_a_company IN ('.$id_company.') and a.visible=1 '.$sql_line.' '.$sql_line1;



$result_t221=mysql_time_query($link,$sql_count);
$row__221= mysqli_fetch_assoc($result_t221);



echo'<div class="okss" style="margin-top:20px;"><span class="title_book yop_booking"><i>'.$row__221["kol"].'</i><span>'.PadejNumber($row__221["kol"],'история продаж '.$month_rus1.',история продаж '.$month_rus1.',история продаж '.$month_rus1).'</span></span></div>';


                  $num_results_t2 = $result_t2->num_rows;
	              if($num_results_t2!=0)
	              {

				$com=0;
			    $cost=0;
				$count_y=0;
				$large_booking=1;  // краткий вывод

                      while($row_88 = mysqli_fetch_assoc($result_t2))
                      {

                          $result_uuy = mysql_time_query($link, 'select A.id,A.discount,A.doc, A.id_a_company, A.id_user,A.shopper,A.id_shopper,A.id_contract,A.comment,A.number_to,A.hotel,A.id_country,A.place_name,A.date_start,A.date_end,A.number_to,A.id_contract,A.cost_client,A.id_exchange,A.cost_operator_exchange,A.cost_operator,A.cost_client_exchange,A.buy_clients,A.buy_operator,A.paid_operator,A.paid_operator_rates,A.exchange_rates,A.paid_client,A.paid_client_rates,A.date_prepaid,A.comment,A.status_admin,A.
commission_fix from trips as A where A.id="' . ht($row_88['id']) . '"');
                          $num_results_uuy = $result_uuy->num_rows;

                          if ($num_results_uuy != 0) {
                              $row_8 = mysqli_fetch_assoc($result_uuy);
                          }



                          include $url_system.'tours/code/block_tours.php';
                          echo($task_cloud_block);
                      }
				  }



  else
				  {

//echo'<div class="booking_div da_book1"><div class="not_booling"></div><span class="h4" style="width:calc(100% - 60px)"><span>Бонусная история за выбранный период пуста. Попробуйте изменить период.</span></span></div>';

echo'<div class="message_search_b"><span>История продаж за выбранный период пуста. Попробуйте изменить период.</span></div>';


				  }

?>


    </div>
  </div>
    <?
    }
    ?>


</div>

<?
include_once $url_system.'template/left.php';
?>

</div>
</div><!--<script src="Js/rem.js" type="text/javascript"></script>-->

<div id="nprogress">
<div class="bar" role="bar" >
<div class="peg"></div>
</div>
</div>

<script type="text/javascript">
 $(document).ready(function(){
$('.circlestat').circliful();
 });
</script>


</body></html>