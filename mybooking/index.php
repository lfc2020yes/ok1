<?php
session_start();
$url_system=$_SERVER['DOCUMENT_ROOT'].'/'; include_once $url_system.'module/config.php'; include_once $url_system.'module/function.php'; include_once $url_system.'login/function_users.php'; initiate($link); include_once $url_system.'module/access.php';



//правам к просмотру к действиям
$hie = new hierarchy($link,$id_user);
$hie_object=array();
$hie_town=array();
$hie_kvartal=array();
$hie_user=array();	
$hie_object=$hie->obj;
$hie_kvartal=$hie->id_kvartal;
$hie_town=$hie->id_town;
$hie_user=$hie->user;

//print_r($hie->user);


$sign_level=$hie->sign_level;
$sign_admin=$hie->admin;


$role->GetColumns();
$role->GetRows();
$role->GetPermission();
//правам к просмотру к действиям


$active_menu='index';


//проверим можно редактировать или нет цены в наряде
$edit_price=0;
if ($role->is_column_edit('n_material','price'))
{
	$edit_price=1;
}


//проверка адреса сайта на существование такой страницы
//проверка адреса сайта на существование такой страницы
//проверка адреса сайта на существование такой страницы
$error_header=0;
$url_404=$_SERVER['REQUEST_URI'];
//echo($url_404);
$D_404 = explode('/', $url_404);

//index.php не должно быть в $url_404
if (strripos($url_404, 'new_index.php') !== false) {
           header("HTTP/1.1 404 Not Found");
	       header("Status: 404 Not Found");
	       $error_header=404;
}

if((( count($_GET)!= 0 ))and(( count($_GET)!= 1 )))
{	 
           header("HTTP/1.1 404 Not Found");
	       header("Status: 404 Not Found");
	       $error_header=404;	   
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

if($error_header!=404){ SEO('umatask','','','',$link); } else { SEO('0','','','',$link); }

include_once $url_system.'module/config_url.php'; include $url_system.'template/head.php';
?>
</head><body>
<?

echo'<div class="alert_wrapper"><div class="div-box"></div></div>';
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
//echo(mktime());

/*
        $result_town=mysql_time_query($link,'select A.id_town,B.town,A.kvartal from i_kvartal as A,i_town as B where A.id_town=B.id and A.id="'.$row_list["id_kvartal"].'"');
        $num_results_custom_town = $result_town->num_rows;
        if($num_results_custom_town!=0)
        {
			$row_town = mysqli_fetch_assoc($result_town);	
		}
*/
?>

<div class="left_block">
  <div class="content">

<?
                $act_='display:none;';
	            $act_1='';
	            if(cookie_work('it_','on','.',60,'0'))
	            {
		            $act_='';
					$act_1='on="show"';
	            }

	  include_once $url_system.'template/top_index.php';


    echo'<div id="fullpage" class="margin_60" id_content="'.$id_user.'">';
	?>
	<div class="section" id="section0">
<div class="oka_block"><div class="oka1 task-left js-task-left" style="width:100%;">
<?
	


?><div class="pad10" style="padding: 0;"><span class="bookingBox_range"><div id="date_table" class="table_suply_x_st"></div></span></div>
<div class="winner_2020">

<div class="text-h-22">Что мы бронируем?</div>

<div class="rating">

<div class="rating-model">
    <div class="model-1">

    <?
    $date_sql_start = date_step_sql('Y-m-d', '-7d') . ' 00:00:00';
    $date_sql_end = date_step_sql('Y-m-d', '+1d') . ' 00:00:00';
    $sql_user_buy = " and A.datecreate>'" . $date_sql_start . "' and A.datecreate<'" . $date_sql_end . "'";
    $name_hh='Покупали на этой неделе';

    if((isset($_GET["period"]))and($_GET["period"]=='more'))
    {
        $date_su=$_COOKIE["suddccc_mor".$id_user];
        $val_su2=$_COOKIE["suddccc".$id_user];

        $val_su22 = explode("/", ht($val_su2));


        $date_sql_start = $val_su22[0] . ' 00:00:00';
        $date_sql_end = $val_su22[1] . ' 00:00:00';
        $sql_user_buy = " and A.datecreate>='" . $date_sql_start . "' and A.datecreate<'" . $date_sql_end . "'";
        $name_hh='Бронировали в период ('.$_COOKIE["suddccc_mor".$id_user].')';
    }

    echo'<form id="js-send-more" action="mybooking/"  style=" display:none;" method="get" enctype="multipart/form-data"><input type="hidden" value="more" name="period"></form><input id="date_hidden_table" '.$class_js_readonly.' name="date" value="'.$date_su.'" type="hidden"><input id="date_hidden_start" name="start_date" type="hidden"><input id="date_hidden_end" name="end_date" type="hidden">';

?>

<!--<script type="text/javascript" src="Js/jquery-ui-1.9.2.custom.min.js"></script>
	<script type="text/javascript" src="Js/jquery.datepicker.extension.range.min.js"></script>-->
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
minDate: "-2Y", maxDate: "+0D",
onSelect: function(dateText, inst, extensionRange) {

	$('#date_table').val(jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.startDate) + ' - ' + jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.endDate));

	var iu=$('.users_rule').attr('id_hax');


	$.cookie("suddccc_mor"+iu, null, {path:'/',domain: window.is_session,secure: false});
CookieList("suddccc_mor"+iu,jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.startDate) + ' - ' + jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.endDate),'add');


	$('#date_hidden_start').val(jQuery.datepicker.formatDate('yy-mm-dd',extensionRange.startDate));
	$('#date_hidden_end').val(jQuery.datepicker.formatDate('yy-mm-dd',extensionRange.endDate));

		$.cookie("suddccc"+iu, null, {path:'/',domain: window.is_session,secure: false});
CookieList("suddccc"+iu,$('#date_hidden_start').val()+'/'+$('#date_hidden_end').val(),'add');


	window.date_picker_step++;
	if(window.date_picker_step==2)
		{
	//$('#date_table').сlose();
			//$('.datepicker').hide();
	window.date_picker_step=0;
			setTimeout ( function () { $('.bookingBox_range').hide(); $('#js-send-more').submit(); }, 1000 );


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
    if((isset($_GET["period"]))and($_GET["period"]=='more'))
{
$date_range=explode("/",$_COOKIE["suddccc".$id_user]);
echo'var st=\''.ipost_($date_range[0],'').'\';
var st1=\''.ipost_($date_range[1],'').'\';
var st2=\''.ipost_($_COOKIE["suddccc_mor".$id_user],'').'\';';
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

<?

        //За последние 2 недели по фирме
    //пусть изучают что сейчас популярно и продают




    //неделя
    if(!isset($_GET["period"])) {

        $date_sql_start = date_step_sql('Y-m-d', '-7d') . ' 00:00:00';
        $date_sql_end = date_step_sql('Y-m-d', '+1d') . ' 00:00:00';
        $sql_user_buy = " and A.datecreate>'" . $date_sql_start . "' and A.datecreate<'" . $date_sql_end . "'";
        $name_hh='Покупали на этой неделе';
    }
    //сегодня
    if((isset($_GET["period"]))and($_GET["period"]=='day')) {
        $sql_user_buy = " and A.datecreate LIKE '" . date('Y-m-d') . "%'";
        $name_hh='Бронировали сегодня';
    }
    //месяц
    if((isset($_GET["period"]))and($_GET["period"]=='mon')) {

        $date_sql_start = date_step_sql('Y-m-d', '-1m') . ' 00:00:00';
        $date_sql_end = date_step_sql('Y-m-d', '+1d') . ' 00:00:00';
        $sql_user_buy = " and A.datecreate>'" . $date_sql_start . "' and A.datecreate<'" . $date_sql_end . "'";
        $name_hh='Бронировали в этом месяце';
    }
    //календарный год
    if((isset($_GET["period"]))and($_GET["period"]=='year')) {

        $sql_user_buy = " and A.datecreate>'" . date('Y-') . "01-01 00:00:00'";
        $name_hh='Бронировали в '.date('Y').' году';
    }

    echo' <div class="js-rating " idrr="1"> <span class="title_name">'.$name_hh.'</span></div>';

    $result_uuh = mysql_time_query($link, 'select Z.* from (select DISTINCT A.id,A.comment,A.flight_there_route,A.id_user,A.place_name,A.hotel,A.datecreate,A.id_country,A.count_day from trips as A where A.id_a_company IN ('.ht($id_group_company_list).') '.$sql_user_buy.') Z order by Z.id_country,Z.datecreate desc');

    echo 'select Z.* from (select DISTINCT A.id,A.comment,A.flight_there_route,A.id_user,A.place_name,A.hotel,A.datecreate,A.id_country,A.count_day from trips as A where A.id_a_company IN ('.ht($id_group_company_list).') '.$sql_user_buy.') Z order by Z.id_country,Z.datecreate desc';

    $num_results_uuh = $result_uuh->num_rows;

    $mass_country = array();
    $mass_country_count_trips= array();

    if($num_results_uuh==0)
    {
        echo'<div class="message_search_b js-message-doc-search" style="font-size: 14px;"><span>Туры за выбранный период не найдены. Измените параметры и попробуйте еще раз.</span></div>';
    }


    if ($result_uuh) {

        echo'<div class="oka_fact chat-index buy-nay-index">';

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


            if($row_uuh['place_name']!='')
            {
                $kuda_trips.=', '.$row_uuh['place_name'];
            }
            if($row_uuh['hotel']!='')
            {
                $kuda_trips.=' / '.$row_uuh['hotel'];
            }


            $result_mi=mysql_time_query($link,'SELECT a.* FROM trips_fly_history AS a WHERE a.id_trips="'.$row_uuh["id"].'" order by a.datetime DESC limit 0,1');

            if($result_mi->num_rows!=0)
            {
                $row_mi = mysqli_fetch_assoc($result_mi);
                $startx=$row_mi["start_fly"];
            }
            $kogda_l='';

            if($startx!='0000-00-00 00:00:00') {


                $date_massff = explode(" ", ht($startx));
                $kogda_l= date_fik($date_massff[0]);
            }



            echo'<div class="gr-55" '.$id_link.'><div class="buy-b-number-22"><a href="tours/.id-'.$row_uuh["id"].'">'.$row_uuh["id"].'</a></div><div  class="two-chat1 two-chat1-new">'.$kuda_trips.'<div ><span class="name-chat">на '.$kogda_l.'</span></div></div>

<div  class="two-chat1-22">'.abs($row_uuh["count_day"]).' <i>'.PadejNumber(abs($row_uuh["count_day"]),'ночь,ночи,ночей').'</i></div>

<div  class="two-chat1-223">'.rooo($row_uuh["flight_there_route"],'','—').'</div>

</div>';

        }


        array_push($mass_country_count_trips, $count_trips);


        echo'</div>';
    }
   // echo "<pre> $arFiles: " . print_r($mass_country, true) . "</pre>";
    //echo "<pre> $arFiles: " . print_r($mass_country_count_trips, true) . "</pre>";


    echo'<div class="js-count-trips-c trips-cc-22">';
    for ($i = 0; $i < count($mass_country); $i++) {


        $result_uu = mysql_time_query($link, 'select name from trips_country where id="' . ht($mass_country[$i]) . '"');
        $num_results_uu = $result_uu->num_rows;

        if ($num_results_uu != 0) {
            $row_uu = mysqli_fetch_assoc($result_uu);
           echo'<div link="'.$mass_country[$i].'" class="list-country-c js-list-country-c">'.$row_uu["name"].'<i>'.$mass_country_count_trips[$i].'</i></div>';


        }


    }
    echo'</div>';

    ?>
</div>

<div class="model-2"><span class="title_name">Другой период</span>

    <div class="all-rating js-all-step-bro all-rating-22">
        <a href="mybooking/day/" class="link-rating" id_r="0">за этот день</a>
    <a href="mybooking/" class="link-rating" id_r="1">неделя</a>
    <a href="mybooking/mon/" class="link-rating" id_r="2">месяц</a>
        <a href="mybooking/year/" class="link-rating" id_r="2"><? echo(date('Y')); ?> год </a>
    <div class="link-rating js-more-cal-22" id_r="3">Период</div>
    </div>


</div>

</div>

</div>
</div>




<?
//X
//|
//вывод рейтинг менеджеров и других работников


	
	?>	
	

	

 </div></div></div><?
include_once $url_system.'template/left.php';
?>
</div></div><!--<script src="Js/rem.js" type="text/javascript"></script>--><div id="nprogress"><div class="bar" role="bar" ><div class="peg"></div></div></div>

</body></html>
<script type="text/javascript">
 $(document).ready(function(){

     $('.js-rating').after($('.js-count-trips-c'));
     $('.js-count-trips-c').show();


$('.circlestat').circliful();	
 });
	$(document).ready(function() {
	/*$('#fullpage').fullpage({
		//options here
		scrollOverflow:true
	});*/


});
</script>

