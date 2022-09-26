<?php
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


$active_menu='tours';  // в каком меню


$count_write=50;			
		
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


if((!$role->permission('Туры','R'))and($sign_admin!=1))
{
  header404(3,$echo_r);
}

if(isset($_GET["id"])) {
//если есть id то смотрим может ли он смотеть этот тур
    $result_t = mysql_time_query($link, 'select A.id from trips as A where A.id_a_company  IN (' . $id_company . ') and A.id="' . ht($_GET['id']) . '" and A.visible=1');
    $num_results_t = $result_t->num_rows;
    if ($num_results_t == 0) {
        header404(322, $echo_r);
    }
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

if($error_header!=404){ SEO('tours','','','',$link); } else { SEO('0','','','',$link); }

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
  

<?
echo'<div class="content" iu="'.$id_user.'">';
	
	
                $act_='display:none;';
	            $act_1='';
	            if(cookie_work('it_','on','.',60,'0'))
	            {
		            $act_='';
					$act_1='on="show"';
	            }

	  include_once $url_system.'template/top_tours.php';


     echo'<div id="fullpage" class="margin_60" id_content="'.$id_user.'">';

	?>
 <div class="section" id="section1">
	 

	<div class="oka_block_2019" style="min-height:auto !important;">
 
 <div class="line_mobile_blue">Оформленные туры</div>

<div class="div_ook hop_ds">
	
<?
		 $st_fil1='js-plus-filter no-active';
		 		   if (( isset($_COOKIE["su_7tu".$id_user]))and($_COOKIE["su_7tu".$id_user]=='1')and(!isset($_GET["id"])))
		   {
					   $st_fil1='js-plus-filter active-filter-s';
				   }
	
	
	echo'<div class="search_task '.$st_fil1.'">';

     
	
echo'<h1 class="h1-filter js-h1-filter-turs">Расширенные фильтры';
	 
	 		   if ((( isset($_COOKIE["su_7tu".$id_user]))and($_COOKIE["su_7tu".$id_user]=='1')))
		   {
	 echo'<div class="choice-radio"><div class="center_vert1"><i class="active_task_cb"></i></div><input name="task[filter]" value="1" type="hidden"></div>'; 
			} else
			   {
				   echo'<div class="choice-radio"><div class="center_vert1"><i></i></div><input name="task[filter]" value="1" type="hidden"></div>';
			   }
	 echo'<span class="search-count-task"></span>';
echo'</h1>';	
	
	
	
 $zindex=110;

		
       $os2 = array( "За все время","Сегодня","За 7 дней","В этом месяце","за 30 дней","Выбрать период");
	   $os_id2 = array("0","6","1","5","3","2");
		
		$su_2=0;
		$date_su='';
		if (( isset($_COOKIE["su_2tu".$id_user]))and(is_numeric($_COOKIE["su_2tu".$id_user]))and(array_search($_COOKIE["su_2tu".$id_user],$os_id2)!==false))
		{
			$su_2=$_COOKIE["su_2tu".$id_user];
		}
		$val_su2=$os2[array_search($su_2, $os_id2)];
		
		
		if ( isset($_COOKIE["suddtu".$id_user]))
		{
			//$date_base__=explode(".",$_COOKIE["sudds"]);
		if (( isset($_COOKIE["su_2tu".$id_user]))and(is_numeric($_COOKIE["su_2tu".$id_user]))and($_COOKIE["su_2tu".$id_user]==2))
		{
			$date_su=$_COOKIE["suddtu_mor".$id_user];
			$val_su2=$_COOKIE["suddtu_mor".$id_user];
		}
		}
		$class_js_readonly ??= '';
		$class_js_search ??= '';
		
	    $_COOKIE["su_2tu".$id_user] ??= '';
	$_COOKIE["su_1tu".$id_user] ??= '';
	$_COOKIE["su_3tu".$id_user] ??= '';
	$_COOKIE["su_4tu".$id_user] ??= '';
	$_COOKIE["su_5tu".$id_user] ??= '';


$class_js_search='';
$class_js_readonly='';
if((( isset($_COOKIE["su_7cu".$id_user]))and($_COOKIE["su_7cu".$id_user]!=''))or(( isset($_COOKIE["su_7xcu".$id_user]))and($_COOKIE["su_7xcu".$id_user]!='')))
{
    $class_js_search='greei_input';
    $class_js_readonly='readonly=""';
}

	
		echo'<input id="date_hidden_table" '.$class_js_readonly.' name="date" value="'.$date_su.'" type="hidden"><input id="date_hidden_start" name="start_date" type="hidden"><input id="date_hidden_end" name="end_date" type="hidden">';
	
		   echo'<div class="left_drop menu1_prime book_menu_sel gop_io js--sort js-call-no-v '.$class_js_search.'" style="z-index:'.$zindex.'"><label>Дата оформления</label><div class="select eddd"><a class="slct " list_number="t2" data_src="'.$os_id2[array_search($_COOKIE["su_2tu".$id_user], $os_id2)].'">'.$val_su2.'</a><ul class="drop">';
	
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
		   echo'</ul><input type="hidden" '.$class_js_readonly.' name="sort2tu" id="sort2tu" value="'.$os2[$su_2].'"></div></div>';
		

	
	
	
	
	   //$zindex=110;

       $os = array(
               "Любой",
           "Неоплаченные",
           "Неоплаченные туристом",
           "Неоплаченные туроператору",
           "Полностью оплаченные",
           "Полностью оплаченные аннулированные",
           "оплаченные туристом",
           "оплаченные туроператору",
           "Просрочена оплата от туриста",
           "Просрочена оплата туроператору");
	   $os_id = array("0","1","2","3","4","9","5","6","7","8");
	   

	/*
	  	if(( isset($_COOKIE["su_7ta".$id_user]))and($_COOKIE["su_7ta".$id_user]!=''))
		{
		   $class_js_search='greei_input';
	       $class_js_readonly='readonly=""';
		}
	*/	
		$su_1=0;
		if (( isset($_COOKIE["su_1tu".$id_user]))and(is_numeric($_COOKIE["su_1tu".$id_user]))and(array_search($_COOKIE["su_1tu".$id_user],$os_id)!==false))
		{
			$su_1=$_COOKIE["su_1tu".$id_user];
		}
		
		
		   echo'<div class="left_drop menu1_prime book_menu_sel js--sort gop_io '.$class_js_search.'" style="z-index:'.$zindex.'"><label>Статус оплаты</label><div class="select eddd"><a class="slct" list_number="t3" data_src="'.$os_id[array_search($_COOKIE["su_1tu".$id_user], $os_id)].'">'.$os[array_search($_COOKIE["su_1tu".$id_user], $os_id)].'</a><ul class="drop">';
			$zindex--;

		   for ($i=0; $i<count($os); $i++)
             {   
			   if($su_1==$os_id[$i])
			   {
				   echo'<li class="sel_active"><a href="javascript:void(0);"  rel="'.$os_id[$i].'">'.$os[$i].'</a></li>';
			   } else
			   {
				  echo'<li><a href="javascript:void(0);"  rel="'.$os_id[$i].'">'.$os[$i].'</a></li>'; 
			   }
			 
			 }
		   echo'</ul><input type="hidden" name="sort1tu" id="sort1tu" value="'.$os[$su_1].'"></div></div>';




$os3 = array(
    "Любое",
    "3 ближайших дня",
    "Сегодня",
    "Завтра",
    "+30 дней",
    "Текущий месяц"
   );
$os_id3 = array("0","1","2","3","4","5");



$su_3=0;
if (( isset($_COOKIE["su_3tu".$id_user]))and(is_numeric($_COOKIE["su_3tu".$id_user]))and(array_search($_COOKIE["su_3tu".$id_user],$os_id3)!==false))
{
    $su_3=$_COOKIE["su_3tu".$id_user];
}


echo'<div class="left_drop menu1_prime book_menu_sel js--sort gop_io '.$class_js_search.'" style="z-index:'.$zindex.'"><label>Начало тура</label><div class="select eddd"><a class="slct" list_number="t4" data_src="'.$os_id3[array_search($_COOKIE["su_3tu".$id_user], $os_id3)].'">'.$os3[array_search($_COOKIE["su_3tu".$id_user], $os_id3)].'</a><ul class="drop">';
$zindex--;

for ($i=0; $i<count($os3); $i++)
{
    if($su_3==$os_id3[$i])
    {
        echo'<li class="sel_active"><a href="javascript:void(0);"  rel="'.$os_id3[$i].'">'.$os3[$i].'</a></li>';
    } else
    {
        echo'<li><a href="javascript:void(0);"  rel="'.$os_id3[$i].'">'.$os3[$i].'</a></li>';
    }

}
echo'</ul><input type="hidden" '.$class_js_readonly.' name="sort3tu" id="sort3tu" value="'.$os3[$su_3].'"></div></div>';


$os4 = array(
		               "Дата оформления тура",
                   "Дата вылета",
                   "Дата прилета",
                   "срок полной оплаты от туриста",
                   "срок полной оплаты туроператору",
                   "срок следующей оплаты от туриста",
                   "срок следующей оплаты туроператору",
                   "Стоимость тура",
                   "размер комиссии",
    "Еще полетят");
	   $os_id4 = array("0","1","2","3","4","5","6","7","8","9");
	
	 
	 
		$su_4=0;
		if (( isset($_COOKIE["su_4tu".$id_user]))and(is_numeric($_COOKIE["su_4tu".$id_user]))and(array_search($_COOKIE["su_4tu".$id_user],$os_id4)!==false))
		{
			$su_4=$_COOKIE["su_4tu".$id_user];
		}
		
		
		   echo'<div class="left_drop menu1_prime book_menu_sel js--sort gop_io '.$class_js_search.'" style="z-index:'.$zindex.'"><label>Сортировка</label><div class="select eddd"><a class="slct" list_number="t5" data_src="'.$os_id4[array_search($_COOKIE["su_4tu".$id_user], $os_id4)].'">'.$os4[array_search($_COOKIE["su_4tu".$id_user], $os_id4)].'</a><ul class="drop">';
			$zindex--;

		   for ($i=0; $i<count($os4); $i++)
             {   
			   if($su_4==$os_id4[$i])
			   {
				   echo'<li class="sel_active"><a href="javascript:void(0);"  rel="'.$os_id4[$i].'">'.$os4[$i].'</a></li>';
			   } else
			   {
				  echo'<li><a href="javascript:void(0);"  rel="'.$os_id4[$i].'">'.$os4[$i].'</a></li>'; 
			   }
			 
			 }
		   echo'</ul><input type="hidden" '.$class_js_readonly.' name="sort4tu" id="sort4tu" value="'.$os4[$su_4].'"></div></div>';


		
     $os5 = array( "Мной");
	 $os_id5 = array("0");	
	
	
	//выводим и всех подчинненных, следовательно для простых менеджеров подчиненных нет
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
			   array_push($os5, $row_work_zz["name_small"]);
			   array_push($os_id5, $row_work_zz["id"]);
		   }
		}
	 
			}
	 
	 
	if(($sign_level==2)or($sign_level==3)or($sign_level==4))
		{
		   array_push($os5, 'Всеми подчиненными менеджерами');
	       array_push($os_id5, 'all_subor');		
		}
	 
		$su_5=0;
		if (( isset($_COOKIE["su_5tu".$id_user]))and(array_search($_COOKIE["su_5tu".$id_user],$os_id5)!==false))
		{
			$su_5=$_COOKIE["su_5tu".$id_user];
		}
		
		
		   echo'<div class="left_drop menu1_prime book_menu_sel js--sort gop_io '.$class_js_search.'" style="z-index:'.$zindex.'"><label>Тур оформлен</label><div class="select eddd"><a class="slct" list_number="t6" data_src="'.$os_id5[array_search($_COOKIE["su_5tu".$id_user], $os_id5)].'">'.$os5[array_search($_COOKIE["su_5tu".$id_user], $os_id5)].'</a><ul class="drop">';
	//$os_id2[array_search($su_2, $os_id2)]
			$zindex--;

		   for ($i=0; $i<count($os5); $i++)
             {   
			   if((string)$su_5==$os_id5[$i])
			   {
				   echo'<li class="sel_active"><a href="javascript:void(0);"  rel="'.$os_id5[$i].'">'.$os5[$i].'</a></li>';
			   } else
			   {
				  echo'<li><a href="javascript:void(0);"  rel="'.$os_id5[$i].'">'.$os5[$i].'</a></li>'; 
			   }
			 
			 }
		   echo'</ul><input type="hidden" '.$class_js_readonly.' name="sort5tu" id="sort5tu" value="'.$os5[$su_5].'"></div></div>';






echo'<div class="left_drop menu1_prime book_menu_sel gop_io" style="z-index:'.$zindex.'"><label>id / номер договора (D...)</label><div class="select eddd">
		   
		   <input name="sort_stock2" id="name_stock_search_tours" class="name_stock_search_input js-text-search-x" autocomplete="off" value="'.ipost_(($_COOKIE["su_7cu".$id_user] ?? ''),'').'" type="text">';
$zindex--;

if (( isset($_COOKIE["su_7cu".$id_user]))and($_COOKIE["su_7cu".$id_user]!=''))
{
    echo'<div style="display:block;" class="dell_stock_search_tours" data-tooltip="Удалить"><span>x</span></div>';
} else
{
    echo'<div  class="dell_stock_search_tours" data-tooltip="Удалить"><span>x</span></div>';
}


echo'</div></div>';








echo'<div class="left_drop menu1_prime book_menu_sel gop_io" style="z-index:'.$zindex.'"><label>Номер заявки у ТО</label><div class="select eddd">
		   
		   <input name="sort_stock2" id="name_stock_search_toursi" class="name_stock_search_inputi js-text-search-xi" autocomplete="off" value="'.ipost_(($_COOKIE["su_7xcu".$id_user] ?? ''),'').'" type="text">';
$zindex--;

if (( isset($_COOKIE["su_7xcu".$id_user]))and($_COOKIE["su_7xcu".$id_user]!=''))
{
    echo'<div style="display:block;" class="dell_stock_search_toursi" data-tooltip="Удалить"><span>x</span></div>';
} else
{
    echo'<div  class="dell_stock_search_toursi" data-tooltip="Удалить"><span>x</span></div>';
}


echo'</div></div>';







	 echo'<div class="inline_reload js-reload-top"><a href="tours/" class="show_reload">Применить</a></div>';
		
		//echo'<a href="clients/" class="show_sort_supply">Применить</a>';
		?>
		<div class="pad10" style="padding: 0;"><span class="bookingBox_range"><div id="date_table" class="table_suply_x_st"></div></span></div>		
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
	
	var iu=$('.content').attr('iu');
	$.cookie("suddtu_mor"+iu, null, {path:'/',domain: window.is_session,secure: false});
CookieList("suddtu_mor"+iu,jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.startDate) + ' - ' + jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.endDate),'add');
	
	
	$('#date_hidden_start').val(jQuery.datepicker.formatDate('yy-mm-dd',extensionRange.startDate));
	$('#date_hidden_end').val(jQuery.datepicker.formatDate('yy-mm-dd',extensionRange.endDate));
	
	$('[list_number=t2]').empty().append(jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.startDate) + ' - ' + jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.endDate));		
		$.cookie("suddtu"+iu, null, {path:'/',domain: window.is_session,secure: false});
CookieList("suddtu"+iu,$('#date_hidden_start').val()+'/'+$('#date_hidden_end').val(),'add');

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
if((isset($_COOKIE["su_2tu".$id_user]))and(is_numeric($_COOKIE["su_2tu".$id_user]))and($_COOKIE["su_2tu".$id_user]==2))
{
$date_range=explode("/",$_COOKIE["suddtu".$id_user]);
echo'var st=\''.ipost_($date_range[0],'').'\';
var st1=\''.ipost_($date_range[1],'').'\';
var st2=\''.ipost_($_COOKIE["suddtu_mor".$id_user],'').'\';';
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
	
	
		
?>
	
	
</div></div></div>		 

<?
//выводим быстрые фильтры
	 $st_fil='';
		 		   if ((( isset($_COOKIE["su_7tu".$id_user]))and($_COOKIE["su_7tu".$id_user]=='2'))or(!isset($_COOKIE["su_7tu".$id_user]))) {
                       if (!isset($_GET["id"])) {
                           $st_fil = 'active-filter-s';
                       }
                   }
	 
echo'<div class="filter-wois '.$st_fil.'"><h1 class="h1-filter js-h1-filter-turs">Быстрые фильтры';
	 
	 	   if ($st_fil!='')
		   {
	 echo'<div class="choice-radio"><div class="center_vert1"><i class="active_task_cb"></i></div><input name="turs[filter]" value="2" type="hidden"></div>';
			} else
			{
	 echo'<div class="choice-radio"><div class="center_vert1"><i></i></div><input name="turs[filter]" value="2" type="hidden"></div> ';
			}
	 
	echo'<span class="search-count-task"></span>';
	
	
echo'</h1>';	 

	 
$result_6 = mysql_time_query($link,"select A.* from trips_quick_filters as A WHERE A.visible=1 order by A.displayOrder");
//$row_1 = mysqli_fetch_assoc($result2);
if($result_6)
{ 
   $i=0;
	$end=0;
   while($row_6 = mysqli_fetch_assoc($result_6)){ 
	   if(($i==0)or($i==4)or($i==8)or($i==12))
	   {
		   if($i!=0)
		   {
			   $end=0;
			   echo'</div>';
		   }
		   
		   
		   echo'<div class="filter-block">';
		   $end=1;
	   }
	   $eshe_filter='';
	   if($row_6["number"]==4)
       {
           $eshe_filter=' (вылет с '.date("d.m.Y").')';
       }

	  		if (((( isset($_COOKIE["su_7ftu".$id_user])))and($_COOKIE["su_7ftu".$id_user]==$row_6["id"]))or((!isset($_COOKIE["su_7ftu".$id_user]))and($row_6["default"]==1)))
		{
	   echo'<div class="fi-at active-fi" id="'.$row_6["id"].'"><a href="tours/">'.$row_6["name"].$eshe_filter.'</a></div>';
			} else
			{
		 echo'<div class="fi-at" id="'.$row_6["id"].'"><a href="tours/">'.$row_6["name"].$eshe_filter.'</a></div>';
			}
	   $i++;
   }
	if($end!=0)
	{
		echo'</div>';
	}
}
echo'</div>';	
?>	 
	 
 <div class="oka_block_1">
<div class="oka1_1 new-task-view" style="">
  <?


//сообщения после добавление редактирования чего то	
//сообщения после добавление редактирования чего то
//сообщения после добавление редактирования чего то
	
	$echo_help=0;
    if (( isset($_GET["a"]))and($_GET["a"]=='yes'))
    {
echo'<div class="help_div da_book1 js-hide-help"><div class="not_boolingh"></div><span class="h5"><span>Новая задача добавлена в систему</span></span></div>';
		$echo_help++;
	}
    if (( isset($_GET["a"]))and($_GET["a"]=='save'))
    {
echo'<div class="help_div da_book1 js-hide-help"><div class="not_boolingh"></div><span class="h5"><span>Данные по задаче успешно изменены</span></span></div>';
		$echo_help++;
	}	
	if($echo_help!=0)
	{
?>
<script type="text/javascript">
$(function (){ 
setTimeout ( function () { 
	
	$('.js-hide-help').slideUp("slow");	var title_url=$(document).attr('title'); var url=window.location.href; var url1 = removeParam("a", url); History.pushState('', title_url, url1);					 
						 
	}, 5000 );
});
</script>
<?	
	}
//сообщения после добавление редактирования чего то	
//сообщения после добавление редактирования чего то
//сообщения после добавление редактирования чего то
	
	
//echo'<span class="hh1" style=" margin-bottom:0px;">Наряды</span>';

	
	//echo'</div><div class="content_block block_primes1">';  
	  
	//echo'</div>';
	
	//echo'<div class="content_block1">';	
/*
<div class="close_all_r">закрыть все</div>
<div data-tooltip="Удалить всю себестоимость" class="del_seb"></div>
<div data-tooltip="Добавить раздел" class="add_seb"></div>
';
*/
  
	  
	  	//echo'</div>';  
	   //$os = array( "дата поставки", "по алфавиту","новые");
	   //$os_id = array("0", "1", "2");	
  if((isset($_GET["id"]))and(isset($_POST["status"]))and($_POST["status"]=='doc')) {

      $result_uu = mysql_time_query($link, 'select A.id_contract,B.name from trips as A, trips_contract as B where A.id="' . ht($_GET['id']) . '" and A.id_contract=B.id');
      $num_results_uu = $result_uu->num_rows;

      if ($num_results_uu != 0) {
          $row_uu = mysqli_fetch_assoc($result_uu);


          $result_uuee = mysql_time_query($link, 'select A.*,B.id,B.name from trips_contract_version as A, trips_contract as B where B.id="' . ht($row_uu['id_contract']) . '" and B.id=A.id_trips_contract  limit 0,1');

          $num_results_uuee = $result_uuee->num_rows;

          if ($result_uuee) {
              $row_uuee = mysqli_fetch_assoc($result_uuee);


              echo '<div class="block-tours js-doc-create create-block" style="margin-top: 0px; display: block;">
            <div class="block-add-tours-gl">

                <div class="block-h1">Документы</div>
<span class="js-alert-doc"><span class="doc_add_number"><a class="ioo" href="' . $base_usr . '/tours/doc/doc-' . $row_uuee["id"] . '_' . $row_uuee["version"] . '.docx">Договор №' . ht(trim($row_uu['name'])) . '</a></span></span>
            </div>
        </div>';
          }
      }
  }

if(isset($_GET["id"]))
{

    $sql_k='Select DISTINCT A.id from trips as A where A.visible=1 AND A.id="'.ht($_GET["id"]).'" and A.id_a_company IN ('.$id_company.') ';
//echo $sql_k;
    $result_t2 = mysql_time_query($link, $sql_k);

    $sql_count = 'Select count(DISTINCT A.id) as kol from trips as A where A.visible=1 AND A.id="'.ht($_GET["id"]).'" and A.id_a_company IN ('.$id_company.')';


} else {

    if (((isset($_COOKIE["su_7tu" . $id_user])) and ($_COOKIE["su_7tu" . $id_user] == '1'))) {
//расширенный поиск

        $sql_su1 = '';
        $sql_su2 = '';
        $sql_su3 = '';
        $sql_su4 = '';
        $sql_su5 = '';
        $sql_su5_search = '';
        $sql_su7 = ' AND A.id_a_company  IN (' . $id_company . ') ';

        //********************************************************************
//********************************************************************
//********************************************************************
        //тур оформлен
        //|
        //V
        $flag_vstt=0;
        if((string)$su_5=='0')
        {
            $query_user=$id_user;
        } else
        {

            $mass_ei=users_hierarchy($id_user,$link);
            rm_from_array($id_user,$mass_ei);
            $mass_ei= array_unique($mass_ei);

            if(((string)$su_5!='0')and(is_numeric($su_5)))
            {
                if (in_array($su_5, $mass_ei)) {
                    $query_user=$su_5;
                }

            }

            if($su_5=='all_subor')
            {
                $flag_vstt=1;
            }

        }


        //выставленные
        if($flag_vstt==0)
        {
            $sql_su5=' AND ((A.id_user="'.$query_user.'"))';
        } else
        {
            if(count($mass_ei)!=0)
            {
                $io=0;
                $sql_su5=' AND (';

                foreach ($mass_ei as $key => $value)
                {
                    if($io==0) {

                        $sql_su5.='((A.id_user="'.$value.'"))';

                    } else
                    {
                        $sql_su5.='or((A.id_user="'.$value.'"))';
                    }
                    $io++;

                }
                $sql_su5.=' )';
            }
        }


//Для поиска по id и номеру договора ищем по всем возможным для работника подчиненным

        if(count($mass_ei)!=0)
        {
            $io=0;
            $sql_su5_search=' AND (';

            foreach ($mass_ei as $key => $value)
            {
                if($io==0) {

                    $sql_su5_search.='((A.id_user="'.$value.'"))';

                } else
                {
                    $sql_su5_search.='or((A.id_user="'.$value.'"))';
                }
                $io++;

            }
            if($io!=0)
            {
                $sql_su5_search.='or((A.id_user="'.$id_user.'"))';
            } else
            {
                $sql_su5_search.='((A.id_user="'.$id_user.'"))';
            }

            $sql_su5_search.=' )';
        }



        //X
        //|
        //тур оформлен

//********************************************************************
//********************************************************************
//********************************************************************


        //поиск по id/ номеру договора
        //45          D45
        //если поиск по названию то остальные критерии поиска не работают
        if((( isset($_COOKIE["su_7cu".$id_user]))and($_COOKIE["su_7cu".$id_user]!=''))or(( isset($_COOKIE["su_7xcu".$id_user]))and($_COOKIE["su_7xcu".$id_user]!='')))
        {

            $query=trimc(mb_convert_case(htmlspecialchars($_COOKIE["su_7cu".$id_user]), MB_CASE_LOWER, "UTF-8"));

            $query1=trimc(mb_convert_case(htmlspecialchars($_COOKIE["su_7xcu".$id_user]), MB_CASE_LOWER, "UTF-8"));


            if(trim($query1)!='')
            {
                //поиск по номеру заявки ТО
                $sql_k = 'select A.id from trips as A where  A.visible=1 ' . $sql_su5_search . ' ' . $sql_su7 . ' and A.number_to="' . $query1 . '"';

                $sql_count = 'select count(A.id) as kol from trips as A where  A.visible=1 ' . $sql_su5_search . ' ' . $sql_su7 . ' and A.number_to="' . $query1 . '"';

            } else {

                if ($query[0] == 'd') {
                    //поиск по номеру договора
                    mb_internal_encoding("UTF-8");
                    $query = mb_substr($query, 1);

                    $sql_k = 'select A.id from trips as A,trips_contract as J where A.id_contract=J.id and A.visible=1 ' . $sql_su5_search . ' ' . $sql_su7 . ' and J.number="' . $query . '"';

                    $sql_count = 'select count(A.id) as kol from trips as A,trips_contract as J where A.id_contract=J.id and A.visible=1 ' . $sql_su5_search . ' ' . $sql_su7 . ' and J.number="' . $query . '"';

                } else {
                    //поиск по id

                    $sql_k = 'select A.id from trips as A where  A.visible=1 ' . $sql_su5_search . ' ' . $sql_su7 . ' and A.id="' . $query . '"';

                    $sql_count = 'select count(A.id) as kol from trips as A where  A.visible=1 ' . $sql_su5_search . ' ' . $sql_su7 . ' and A.id="' . $query . '"';

                }
            }

//echo($sql_k);

        } else{

        $sql_order = ' order by A.datecreate';




        $sql_order = '';
        $sql_columb='';

        $sql_table='';
        $sql_table1='';   //trips_payment_term - сроки
        $sql_table2='';   //trips_fly_history  - история вылетов
        $sql_table3='';

        $sql_svyz_table='';
        $sql_svyz_table1=''; //trips_payment_term - сроки
        $sql_svyz_table2=''; //trips_fly_history  - история вылетов

            $sql_22='';
        ///поиск для расширенных фильтров



//********************************************************************
//********************************************************************
//********************************************************************
        //дата оформления
        //|
        //V
        if ($su_2 == 0) {
            //За все время
            $sql_su2 = '';
        }
        if ($su_2 == 6) {
            //Сегодня

            $sql_su2 = ' A.datecreate LIKE "'.date("Y-m-").'%"';
        }
        if ($su_2 == 1) {
            //за 7 дней
            $date_end_start = date_step_sql('Y-m-d', '-7d') . ' 00:00:00';
            $date_end_end = date_step_sql('Y-m-d', '+1d') . ' 00:00:00';
            $sql_su2 = ' and A.datecreate>="' . $date_end_start . '" and  A.datecreate<"' . $date_end_end . '"';
        }
        if ($su_2 == 5) {
            //В этом месяце
            $date_end_start = date_step_sql('Y-m', '+0d') . '-01 00:00:00';
            $date_end_end=date_step_sql('Y-m','+1m').'-01 00:00:00';

            $sql_su2 = ' and A.datecreate>="' . $date_end_start . '" and  A.datecreate<"' . $date_end_end . '"';
        }
        if ($su_2 == 3) {
            //за 30 дней
            $date_end_start = date_step_sql('Y-m-d', '-30d') . ' 00:00:00';
            $date_end_end = date_step_sql('Y-m-d', '+1d') . ' 00:00:00';
            $sql_su2 = ' and A.datecreate>="' . $date_end_start . '" and  A.datecreate<"' . $date_end_end . '"';
        }
        if ($su_2 == 2) {
            //Выбранные период пользователем
            $date_range = explode("/", $_COOKIE["suddtu" . $id_user]);
            $sql_su2 = ' and A.datecreate>="' . ht($date_range[0]) . ' 00:00:00" and A.datecreate<="' . ht($date_range[1]) . ' 23:59:59"';
        }
        //X
        //|
        //дата оформления

//********************************************************************
//********************************************************************
//********************************************************************
        //статус оплаты
        //|
        //V

        if($su_1 == 0) {
        //Любой
        $sql_su1 = '';


        }
        if($su_1 == 1) {
            //Неоплаченные
            $sql_su1 = ' AND ((A.buy_clients=0)or(A.buy_operator=0))';

        }
        if($su_1 == 2) {
            //Неоплаченные туристом
            $sql_su1 = ' AND (A.buy_clients=0)';

        }
        if($su_1 == 3) {
            //Неоплаченные туроператору
            $sql_su1 = ' AND (A.buy_operator=0)';

        }
        if($su_1 == 4) {
            //Полностью оплаченные
            $sql_su1 = ' AND ((A.buy_clients=1)and(A.buy_operator=1))';
        }
            if($su_1 == 9) {
                //Полностью оплаченные аннулированные
                $sql_su1 = ' AND ((A.buy_clients=1)and(A.buy_operator=1)) AND A.status=2 ';
            }
        if($su_1 == 5) {
            //оплаченные туристом
            $sql_su1 = ' AND (A.buy_clients=1)';
        }
        if($su_1 == 6) {
            //оплаченные туроператору
            $sql_su1 = ' AND (A.buy_operator=1)';
        }
        if($su_1 == 7) {
            //Просрочена оплата от туриста


            $sql_su1 = ' and B.visible=1 and B.yes=0 and B.type=0 and B.date<"' . date("Y-m-d") . '"';
            $sql_table1=',trips_payment_term as B';
            $sql_svyz_table1=' AND B.id_trips=A.id ';
        }
        if($su_1 == 8) {
            //Просрочена оплата туроператору
            $sql_su1 = ' and B.visible=1 and B.yes=0 and B.type=1 and B.date<"' . date("Y-m-d") . '"';
            $sql_table1=',trips_payment_term as B';
            $sql_svyz_table1=' AND B.id_trips=A.id ';
        }
        //X
        //|
        //статус оплаты

//********************************************************************
//********************************************************************
//********************************************************************
        //Начало тура
        //|
        //V

        if($su_3 == 0) {
            //Любоe
            $sql_su3 = '';
        }
        if($su_3 == 1) {
            //3 ближайших дня
            $date_end_start = date_step_sql('Y-m-d', '+0d') . ' 00:00:00';
            $date_end_end = date_step_sql('Y-m-d', '+4d') . ' 00:00:00';
            $sql_table2=',trips_fly_history as xx';
            $sql_svyz_table2=' AND xx.id_trips=A.id ';

            $sql_su3 = ' and (SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1)>="' . $date_end_start . '" and (SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1)<"' . $date_end_end . '"';


        }
        if($su_3 == 2) {
            //Сегодня
            $date_end_start = date_step_sql('Y-m-d', '+0d') . ' 00:00:00';
            $date_end_end = date_step_sql('Y-m-d', '+1d') . ' 00:00:00';
            $sql_table2=',trips_fly_history as xx';
            $sql_svyz_table2=' AND xx.id_trips=A.id ';
            $sql_su3 = ' and (SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1)>="' . $date_end_start . '" and (SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1)<"' . $date_end_end . '"';

        }
        if($su_3 == 3) {
            //Завтра

            $date_end_start = date_step_sql('Y-m-d', '+1d') . ' 00:00:00';
            $date_end_end = date_step_sql('Y-m-d', '+2d') . ' 00:00:00';
            $sql_table2=',trips_fly_history as xx';
            $sql_svyz_table2=' AND xx.id_trips=A.id ';
            $sql_su3 = ' and (SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1)>="' . $date_end_start . '" and (SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1)<"' . $date_end_end . '"';

        }
        if($su_3 == 4) {
            //+30 дней

            $date_end_start = date_step_sql('Y-m-d', '+0d') . ' 00:00:00';
            $date_end_end = date_step_sql('Y-m-d', '+30d') . ' 00:00:00';
            $sql_table2=',trips_fly_history as xx';
            $sql_svyz_table2=' AND xx.id_trips=A.id ';
            $sql_su3 = ' and (SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1)>="' . $date_end_start . '" and (SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1)<"' . $date_end_end . '"';

        }
        if($su_3 == 5) {
            //Текущий месяц
            $date_end_start = date_step_sql('Y-m', '+0d') . '-01 00:00:00';
            $date_end_end = date_step_sql('Y-m', '+1m') . '-01 00:00:00';
            $sql_table2=',trips_fly_history as xx';
            $sql_svyz_table2=' AND xx.id_trips=A.id ';
            $sql_su3 = ' and (SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1)>="' . $date_end_start . '" and (SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1)<"' . $date_end_end . '"';

        }
        //X
        //|
        //Начало тура

//********************************************************************
//********************************************************************
//********************************************************************


//********************************************************************
//********************************************************************
//********************************************************************
        //Сортировка
        //|
        //V
        if($su_4 == 0) {
            //Дата оформления тура
            $sql_order = ' order by A.datecreate DESC';
        }
        if($su_4 == 1) {
            //Дата вылета
            $sql_table2=',trips_fly_history as xx';
            $sql_svyz_table2=' AND xx.id_trips=A.id ';
            $sql_columb.=',(SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1) as fly_start';
            //$sql_su4 = ' and (SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1)>="'.date("Y-m-d").' 00:00:00" ';
             $sql_order = ' order by fly_start';
        }
        if($su_4 == 2) {
            //Дата прилета
            $sql_table2=',trips_fly_history as xx';
            $sql_svyz_table2=' AND xx.id_trips=A.id ';
            $sql_columb.=',(SELECT yy.end_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1) as fly_end';
            //$sql_su4 = ' and (SELECT yy.end_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1)>="'.date("Y-m-d").' 00:00:00" ';
            $sql_order = ' order by fly_end';
        }
        if($su_4 == 3) {
            //срок полной оплаты от туриста

            $sql_table1=',trips_payment_term as B';
            $sql_svyz_table1=' AND B.id_trips=A.id ';
            $sql_columb.=',(SELECT rr.date FROM trips_payment_term AS rr WHERE rr.visible=1 and rr.proc=100 and rr.type=0 and rr.id_trips=A.id ORDER BY rr.id DESC LIMIT 0,1) as srok_poln';
            $sql_su4 = ' AND B.yes=0 and b.type=0';
            $sql_order = ' order by srok_poln';

        }
        if($su_4 == 4) {
            //срок полной оплаты туроператору


            $sql_table1=',trips_payment_term as B';
            $sql_svyz_table1=' AND B.id_trips=A.id ';
            $sql_columb.=',(SELECT rr.date FROM trips_payment_term AS rr WHERE rr.visible=1 and rr.proc=100 and rr.type=1 and rr.id_trips=A.id ORDER BY rr.id DESC LIMIT 0,1) as srok_poln';
            $sql_su4 = ' AND B.yes=0 and b.type=1';
            $sql_order = ' order by srok_poln';

        }
        if($su_4 == 5) {
            //срок следующей оплаты от туриста

            $sql_table1=',trips_payment_term as B';
            $sql_svyz_table1=' AND B.id_trips=A.id ';
            $sql_columb.=',(SELECT rr.date FROM trips_payment_term AS rr WHERE rr.visible=1 and rr.yes=0 and rr.type=0 and rr.id_trips=A.id ORDER BY rr.proc LIMIT 0,1) as srok_sled';
            $sql_su4 = ' AND B.yes=0 and b.type=0';
            $sql_order = ' order by srok_sled';

        }
        if($su_4 == 6) {
            //срок следующей оплаты туроператору
            $sql_table1=',trips_payment_term as B';
            $sql_svyz_table1=' AND B.id_trips=A.id ';
            $sql_columb.=',(SELECT rr.date FROM trips_payment_term AS rr WHERE rr.visible=1 and rr.yes=0 and rr.type=1 and rr.id_trips=A.id ORDER BY rr.proc LIMIT 0,1) as srok_sled';
            $sql_su4 = ' AND B.yes=0 and b.type=1';
            $sql_order = ' order by srok_sled';
        }
        if($su_4 == 7) {
            //Стоимость тура
            $sql_order = ' order by A.cost_client DESC ';
        }
        if($su_4 == 8) {
            //размер комиссии
            $sql_order = ' order by A.commission DESC';
        }
            if($su_4 == 9) {

                $sql_22='SELECT * FROM ( ';
                $sql_table2=',trips_fly_history as xx';
                $sql_svyz_table2=' AND xx.id_trips=A.id ';
                $sql_columb.=',(SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1) as fly_start';
                //$sql_su4 = ' and (SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1)>="'.date("Y-m-d").' 00:00:00" ';
                $sql_order = ' ) as ZZ where ZZ.fly_start>="'.date('Y-m-d').' 00:00:00" order by ZZ.fly_start';
                //$sql_order__ = ' ) as ZZ where ZZ.fly_start>="'.date('Y-m-d').' 00:00:00"';
            }
        //X
        //|
        //Сортировка

//********************************************************************
//********************************************************************
//********************************************************************






        $sql_table=$sql_table1.$sql_table2.$sql_table3;
        $sql_svyz_table=$sql_svyz_table1.$sql_svyz_table2;

        $sql_k = $sql_22.' Select 
  
  DISTINCT A.id'.$sql_columb.'
  
  from trips as A'.$sql_table.'
  
  where A.visible=1 '.$sql_svyz_table.' ' . $sql_su2 . ' ' . $sql_su1 . ' ' . $sql_su3 . ' ' . $sql_su4 . ' ' . $sql_su5 . ' ' . $sql_su7 . ' ' . $sql_order . ' ' . limitPage('n_st', $count_write);

//echo($sql_k);

            if($su_4 == 9) {


                $sql_k = 'SELECT   count(DISTINCT AA.id) as kol FROM ( '. $sql_22.' Select 
  
  DISTINCT A.id'.$sql_columb.'
  
  from trips as A'.$sql_table.'
  
  where A.visible=1 '.$sql_svyz_table.' ' . $sql_su2 . ' ' . $sql_su1 . ' ' . $sql_su3 . ' ' . $sql_su4 . ' ' . $sql_su5 . ' ' . $sql_su7 . ' ' . $sql_order . ' ) as AA ';

                echo($sql_k);


/*
            $sql_count = 'Select 
  
  count(DISTINCT A.id) as kol' . $sql_columb . '
  
  from trips as A' . $sql_table . '
  
  where A.visible=1 ' . $sql_svyz_table . ' ' . $sql_su2 . ' ' . $sql_su1 . ' ' . $sql_su3 . ' ' . $sql_su4 . ' ' . $sql_su5 . ' ' . $sql_su7;
  */

            } else
            {
                $sql_count = 'Select 
  
  count(DISTINCT A.id) as kol' . $sql_columb . '
  
  from trips as A' . $sql_table . '
  
  where A.visible=1 ' . $sql_svyz_table . ' ' . $sql_su2 . ' ' . $sql_su1 . ' ' . $sql_su3 . ' ' . $sql_su4 . ' ' . $sql_su5 . ' ' . $sql_su7;
            }
        }

        $result_t2 = mysql_time_query($link, $sql_k);




    } else {


        //быстрые фильтры
        //быстрые фильтры ищут только по своим турам
        if (((isset($_COOKIE["su_7ftu" . $id_user]))) and (is_numeric($_COOKIE["su_7ftu" . $id_user]))) {
            $result_uu = mysql_time_query($link, 'select a.number from trips_quick_filters as a where a.id="' . ht($_COOKIE["su_7ftu" . $id_user]) . '" and a.visible=1');
        } else {
            $result_uu = mysql_time_query($link, 'select a.number from trips_quick_filters as a where a.default=1 and a.visible=1');
        }
        $num_results_uu = $result_uu->num_rows;

        if ($num_results_uu != 0) {
            $row_uu = mysqli_fetch_assoc($result_uu);

            $sql_order = ' order by A.datecreate desc ';

//пользователь по умолчанию пустой (все пользователи компании)
            $sql_user_my = ' and A.id_user="' . $id_user . '"';

            //Все туры
            if ($row_uu["number"] == 1) {
                //Все туры
                $sql_k = 'Select DISTINCT A.id from trips as A where A.visible=1 AND A.id_a_company IN (' . $id_company . ') ' . $sql_user . ' ' . $sql_user_my . ' ' . $sql_order . ' ' . limitPage('n_st', $count_write);

//echo($sql_k);	

                $result_t2 = mysql_time_query($link, $sql_k);

                $sql_count = 'Select count(DISTINCT A.id) as kol from trips as A where A.visible=1 AND A.id_a_company IN (' . $id_company . ') ' . $sql_user_my . ' ' . $sql_user;
            }

            //туры оформленные сегодня
            if ($row_uu["number"] == 2) {
                //туры оформленные сегодня

                $sql_user = " and A.datecreate LIKE '" . date("Y-m-d") . "%' ";

                $sql_k = 'Select DISTINCT A.id from trips as A where A.visible=1 AND A.id_a_company IN (' . $id_company . ') ' . $sql_user . ' ' . $sql_user_my . ' ' . $sql_order . '  ' . limitPage('n_st', $count_write);

//echo($sql_k);

                $result_t2 = mysql_time_query($link, $sql_k);

                $sql_count = 'Select count(DISTINCT A.id) as kol from trips as A where A.visible=1 AND A.id_a_company IN (' . $id_company . ') ' . $sql_user_my . '  ' . $sql_user;


            }

            //Ближайшие оплаты от туристов
            if ($row_uu["number"] == 3) {
                //Ближайшие оплаты от туристов

                $sql_order = " order by B.date ";

                $sql_k = 'Select DISTINCT A.id from trips as A,trips_payment_term as B where B.id_trips=A.id and B.visible=1 and B.yes=0 and B.type=0 and A.visible=1 and B.date>="' . date("Y-m-d") . '" AND A.id_a_company IN (' . $id_company . ') ' . $sql_user . ' ' . $sql_user_my . ' ' . $sql_order . ' ' . limitPage('n_st', $count_write);

//echo($sql_k);

                $result_t2 = mysql_time_query($link, $sql_k);

                $sql_count = 'Select count(DISTINCT A.id) as kol from trips as A,trips_payment_term as B where B.id_trips=A.id and B.visible=1 and B.yes=0 and B.type=0 and B.date>="' . date("Y-m-d") . '" and A.visible=1 AND A.id_a_company IN (' . $id_company . ') ' . $sql_user_my . ' ' . $sql_user;


            }

            //Ближайшие (вылет с 05.06.2020)
            if ($row_uu["number"] == 4) {
                //Ближайшие (вылет с 05.06.2020)


                $sql_k = '
select DISTINCT Z.id from(
   (
  Select

  DISTINCT A.id,
    (SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1) AS d_fly1
  
  from trips as A,trips_fly_history as xx

  where xx.id_trips=A.id and A.visible=1 AND A.id_a_company IN (' . $id_company . ') ' . $sql_user . ' ' . $sql_user_my . '  and (SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1)>="' . date("Y-m-d") . ' 00:00:00"
)

  UNION
(

  Select

  DISTINCT A.id,
    (SELECT yy.end_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1) AS d_fly1
  
  from trips as A,trips_fly_history as xx

  where xx.id_trips=A.id and A.visible=1 AND A.id_a_company IN (' . $id_company . ') ' . $sql_user . ' ' . $sql_user_my . '  and (SELECT yy.end_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1)>="' . date("Y-m-d") . ' 00:00:00"

)


) Z order by Z.d_fly1 ' . limitPage('n_st', $count_write);


//echo($sql_k);

                $result_t2 = mysql_time_query($link, $sql_k);

                $sql_count = '
select count(DISTINCT Z.id) as kol from(
   (
  Select

  DISTINCT A.id,
    (SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1) AS d_fly1
  
  from trips as A,trips_fly_history as xx

  where xx.id_trips=A.id and A.visible=1 AND A.id_a_company IN (' . $id_company . ') ' . $sql_user . ' ' . $sql_user_my . '  and (SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1)>="' . date("Y-m-d") . ' 00:00:00"
)

  UNION
(

  Select

  DISTINCT A.id,
    (SELECT yy.end_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1) AS d_fly1
  
  from trips as A,trips_fly_history as xx

  where xx.id_trips=A.id and A.visible=1 AND A.id_a_company IN (' . $id_company . ') ' . $sql_user . ' ' . $sql_user_my . '  and (SELECT yy.end_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1)>="' . date("Y-m-d") . ' 00:00:00"

)


) Z';
            }

            //Оформленные за 7 дней
            if ($row_uu["number"] == 5) {
                //Оформленные за 7 дней

                $date_sql_start = date_step_sql('Y-m-d', '-7d') . ' 00:00:00';
                $date_sql_end = date_step_sql('Y-m-d', '+1') . ' 00:00:00';

                $sql_user = " and A.datecreate>'" . $date_sql_start . "' and A.datecreate<'" . $date_sql_end . "'";

                $sql_k = 'Select DISTINCT A.id from trips as A where A.visible=1 AND A.id_a_company IN (' . $id_company . ') ' . $sql_user . ' ' . $sql_user_my . ' ' . $sql_order . '  ' . limitPage('n_st', $count_write);

//echo($sql_k);

                $result_t2 = mysql_time_query($link, $sql_k);

                $sql_count = 'Select count(DISTINCT A.id) as kol from trips as A where A.visible=1 AND A.id_a_company IN (' . $id_company . ') ' . $sql_user_my . '  ' . $sql_user;


            }

            //Ближайшие оплаты туроператорам
            if ($row_uu["number"] == 6) {
                //Ближайшие оплаты туроператорам
                $sql_order = " order by B.date ";

                $sql_k = 'Select DISTINCT A.id from trips as A,trips_payment_term as B where B.id_trips=A.id and B.visible=1 and B.yes=0 and B.type=1 and A.visible=1 and B.date>="' . date("Y-m-d") . '" AND A.id_a_company IN (' . $id_company . ') ' . $sql_user . ' ' . $sql_user_my . ' ' . $sql_order . ' ' . limitPage('n_st', $count_write);

//echo($sql_k);

                $result_t2 = mysql_time_query($link, $sql_k);

                $sql_count = 'Select count(DISTINCT A.id) as kol from trips as A,trips_payment_term as B where B.id_trips=A.id and B.visible=1 and B.yes=0 and B.type=1 and B.date>="' . date("Y-m-d") . '" and A.visible=1 AND A.id_a_company IN (' . $id_company . ') ' . $sql_user_my . ' ' . $sql_user;
            }

            //Ближайшие оплаченные
            if ($row_uu["number"] == 7) {
                //Ближайшие оплаченные

                $sql_user = ' and A.buy_clients=1 and A.buy_operator=1 ';
                $sql_k = '
select DISTINCT Z.id from(
   (
  Select

  DISTINCT A.id,
    (SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1) AS d_fly1
  
  from trips as A,trips_fly_history as xx

  where xx.id_trips=A.id and A.visible=1 AND A.id_a_company IN (' . $id_company . ') ' . $sql_user . ' ' . $sql_user_my . '  and xx.start_fly>="' . date("Y-m-d") . ' 00:00:00"
)

  UNION
(

  Select

  DISTINCT A.id,
    (SELECT yy.end_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1) AS d_fly1
  
  from trips as A,trips_fly_history as xx

  where xx.id_trips=A.id and A.visible=1 AND A.id_a_company IN (' . $id_company . ') ' . $sql_user . ' ' . $sql_user_my . '  and xx.end_fly>="' . date("Y-m-d") . ' 00:00:00"

)


) Z order by Z.d_fly1 ' . limitPage('n_st', $count_write);


//echo($sql_k);

                $result_t2 = mysql_time_query($link, $sql_k);

                $sql_count = '
select count(DISTINCT Z.id) as kol from(
   (
  Select

  DISTINCT A.id,
    (SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1) AS d_fly1
  
  from trips as A,trips_fly_history as xx

  where xx.id_trips=A.id and A.visible=1 AND A.id_a_company IN (' . $id_company . ') ' . $sql_user . ' ' . $sql_user_my . '  and xx.start_fly>="' . date("Y-m-d") . ' 00:00:00"
)

  UNION
(

  Select

  DISTINCT A.id,
    (SELECT yy.end_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1) AS d_fly1
  
  from trips as A,trips_fly_history as xx

  where xx.id_trips=A.id and A.visible=1 AND A.id_a_company IN (' . $id_company . ') ' . $sql_user . ' ' . $sql_user_my . '  and xx.end_fly>="' . date("Y-m-d") . ' 00:00:00"

)


) Z';

            }

            //Оформленные в этом месяце
            if ($row_uu["number"] == 8) {
                //Оформленные в этом месяце


                $sql_user = " and A.datecreate LIKE '" . date("Y-m-") . "%' ";

                $sql_k = 'Select DISTINCT A.id from trips as A where A.visible=1 AND A.id_a_company IN (' . $id_company . ') ' . $sql_user . ' ' . $sql_user_my . ' ' . $sql_order . '  ' . limitPage('n_st', $count_write);

//echo($sql_k);

                $result_t2 = mysql_time_query($link, $sql_k);

                $sql_count = 'Select count(DISTINCT A.id) as kol from trips as A where A.visible=1 AND A.id_a_company IN (' . $id_company . ') ' . $sql_user_my . '  ' . $sql_user;

            }

            //Просроченные оплаты от туристов
            if ($row_uu["number"] == 9) {

                $sql_order = " order by B.date ";

                $sql_k = 'Select DISTINCT A.id from trips as A,trips_payment_term as B where B.id_trips=A.id and B.visible=1 and B.yes=0 and B.type=0 and A.visible=1 and B.date<"' . date("Y-m-d") . '" AND A.id_a_company IN (' . $id_company . ') ' . $sql_user . ' ' . $sql_user_my . ' ' . $sql_order . ' ' . limitPage('n_st', $count_write);

//echo($sql_k);

                $result_t2 = mysql_time_query($link, $sql_k);

                $sql_count = 'Select count(DISTINCT A.id) as kol from trips as A,trips_payment_term as B where B.id_trips=A.id and B.visible=1 and B.yes=0 and B.type=0 and B.date<"' . date("Y-m-d") . '" and A.visible=1 AND A.id_a_company IN (' . $id_company . ') ' . $sql_user_my . ' ' . $sql_user;

            }

            //Ближайшие неоплаченные
            if ($row_uu["number"] == 10) {
                //Ближайшие неоплаченные


                $sql_user = ' and (not(A.buy_clients=1) or not(A.buy_operator=1)) ';

                $sql_k = '
select DISTINCT Z.id from(
   (
  Select

  DISTINCT A.id,
    (SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1) AS d_fly1
  
  from trips as A,trips_fly_history as xx

  where xx.id_trips=A.id and A.visible=1 AND A.id_a_company IN (' . $id_company . ') ' . $sql_user . ' ' . $sql_user_my . '  and xx.start_fly>="' . date("Y-m-d") . ' 00:00:00"
)

  UNION
(

  Select

  DISTINCT A.id,
    (SELECT yy.end_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1) AS d_fly1
  
  from trips as A,trips_fly_history as xx

  where xx.id_trips=A.id and A.visible=1 AND A.id_a_company IN (' . $id_company . ') ' . $sql_user . ' ' . $sql_user_my . '  and xx.end_fly>="' . date("Y-m-d") . ' 00:00:00"

)


) Z order by Z.d_fly1 ' . limitPage('n_st', $count_write);


//echo($sql_k);

                $result_t2 = mysql_time_query($link, $sql_k);

                $sql_count = '
select count(DISTINCT Z.id) as kol from(
   (
  Select

  DISTINCT A.id,
    (SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1) AS d_fly1
  
  from trips as A,trips_fly_history as xx

  where xx.id_trips=A.id and A.visible=1 AND A.id_a_company IN (' . $id_company . ') ' . $sql_user . ' ' . $sql_user_my . '  and xx.start_fly>="' . date("Y-m-d") . ' 00:00:00"
)

  UNION
(

  Select

  DISTINCT A.id,
    (SELECT yy.end_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1) AS d_fly1
  
  from trips as A,trips_fly_history as xx

  where xx.id_trips=A.id and A.visible=1 AND A.id_a_company IN (' . $id_company . ') ' . $sql_user . ' ' . $sql_user_my . '  and xx.end_fly>="' . date("Y-m-d") . ' 00:00:00"

)


) Z';


            }

            //Оформленные за 30 дней
            if ($row_uu["number"] == 11) {
                //Оформленные за 30 дней


                $date_sql_start = date_step_sql('Y-m-d', '-30d') . ' 00:00:00';
                $date_sql_end = date_step_sql('Y-m-d', '+1') . ' 00:00:00';

                $sql_user = " and A.datecreate>'" . $date_sql_start . "' and A.datecreate<'" . $date_sql_end . "'";

                $sql_k = 'Select DISTINCT A.id from trips as A where A.visible=1 AND A.id_a_company IN (' . $id_company . ') ' . $sql_user . ' ' . $sql_user_my . ' ' . $sql_order . '  ' . limitPage('n_st', $count_write);

//echo($sql_k);

                $result_t2 = mysql_time_query($link, $sql_k);

                $sql_count = 'Select count(DISTINCT A.id) as kol from trips as A where A.visible=1 AND A.id_a_company IN (' . $id_company . ') ' . $sql_user_my . '  ' . $sql_user;


            }

            //Просроченные оплаты туроператорам
            if ($row_uu["number"] == 12) {
                //Просроченные оплаты туроператорам

                $sql_order = " order by B.date ";

                $sql_k = 'Select DISTINCT A.id from trips as A,trips_payment_term as B where B.id_trips=A.id and B.visible=1 and B.yes=0 and B.type=1 and A.visible=1 and B.date<"' . date("Y-m-d") . '" AND A.id_a_company IN (' . $id_company . ') ' . $sql_user . ' ' . $sql_user_my . ' ' . $sql_order . ' ' . limitPage('n_st', $count_write);

//echo($sql_k);

                $result_t2 = mysql_time_query($link, $sql_k);

                $sql_count = 'Select count(DISTINCT A.id) as kol from trips as A,trips_payment_term as B where B.id_trips=A.id and B.visible=1 and B.yes=0 and B.type=1 and B.date<"' . date("Y-m-d") . '" and A.visible=1 AND A.id_a_company IN (' . $id_company . ') ' . $sql_user_my . ' ' . $sql_user;
            }


            //Аннулированные
            if ($row_uu["number"] == 13) {
                //Аннулированные
                $sql_user = " and A.status=4 ";


                $sql_k = 'Select DISTINCT A.id from trips as A where A.visible=1 AND A.id_a_company IN (' . $id_company . ') ' . $sql_user . ' ' . $sql_user_my . ' ' . $sql_order . ' ' . limitPage('n_st', $count_write);

//echo($sql_k);

                $result_t2 = mysql_time_query($link, $sql_k);

                $sql_count = 'Select count(DISTINCT A.id) as kol from trips as A where A.visible=1 AND A.id_a_company IN (' . $id_company . ') ' . $sql_user_my . ' ' . $sql_user;
            }

            //Документы не выданы
            if ($row_uu["number"] == 14) {
                //Документы не выданы
                $sql_user = " and (A.doc='0000-00-00')or(A.doc='') ";


                $sql_k = 'Select DISTINCT A.id from trips as A where A.visible=1 AND A.id_a_company IN (' . $id_company . ') ' . $sql_user . ' ' . $sql_user_my . ' ' . $sql_order . ' ' . limitPage('n_st', $count_write);

//echo($sql_k);

                $result_t2 = mysql_time_query($link, $sql_k);

                $sql_count = 'Select count(DISTINCT A.id) as kol from trips as A where A.visible=1 AND A.id_a_company IN (' . $id_company . ') ' . $sql_user_my . ' ' . $sql_user;
            }

            //Время вылетов не заполнено
            if ($row_uu["number"] == 15) {
                //Время вылетов не заполнено

                $sql_k = '


Select DISTINCT A.id
  
  from trips as A where A.visible=1 AND A.id_a_company IN (' . $id_company . ') ' . $sql_user . ' ' . $sql_user_my . '  and (((SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1)="0000-00-00 00:00:00")or((SELECT yy.end_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1)="0000-00-00 00:00:00")) order by A.datecreate DESC
 ' . limitPage('n_st', $count_write);


//echo($sql_k);

                $result_t2 = mysql_time_query($link, $sql_k);

                $sql_count = '
Select count(DISTINCT A.id) as kol
  
  from trips as A where A.visible=1 AND A.id_a_company IN (' . $id_company . ') ' . $sql_user . ' ' . $sql_user_my . '  and (((SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1)="0000-00-00 00:00:00")or((SELECT yy.end_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1)="0000-00-00 00:00:00"))';
            }

        }

    }

}
		
		
	
	
//echo($sql_count);
$result_t221=mysql_time_query($link,$sql_count);	  
$row__221= mysqli_fetch_assoc($result_t221);	  

//echo' <h3 class="head_h" style=" margin-bottom:0px;">Cнабжение<i>'.$row__221["kol"].'</i><div></div></h3> ';	
	

//echo'<div class="okss"><span class="title_book yop_booking"><i>'.$row__221["kol"].'</i><span>'.PadejNumber($row__221["kol"],'найденная задача,найденных задачи,найденных задач').'</span></span></div>';			
			
echo'<div class="hidden-count-task">'.$row__221["kol"].' '.PadejNumber($row__221["kol"],'найденный тур,найденных тура,найденных туров').'</div>';
		
			

				  echo'<span class="add-next-task"></span>';
				
	  
                  $num_results_t2 = $result_t2->num_rows;
	              if($num_results_t2!=0)
	              {
	
				$com=0;
			    $cost=0;
					  $count_y=0;
$new_class_block='';
					  echo'<div class="ring_block ring-block-line js-global-task-link">';
	       for ($ksss=0; $ksss<$num_results_t2; $ksss++)
                            {

					$row_88= mysqli_fetch_assoc($result_t2);

                    $result_uuy = mysql_time_query($link, 'select A.id,A.discount,A.doc,A.id_a_company, A.id_user,A.shopper,A.id_shopper,A.id_contract,A.comment,A.number_to,A.hotel,A.id_country,A.place_name,A.date_start,A.date_end,A.number_to,A.id_contract,A.cost_client,A.id_exchange,A.cost_operator_exchange,A.cost_operator,A.cost_client_exchange,A.buy_clients,A.buy_operator,A.paid_operator,A.paid_operator_rates,A.exchange_rates,A.paid_client,A.paid_client_rates,A.date_prepaid,A.comment,A.status_admin from trips as A where A.id="' . ht($row_88['id']) . '"');
                    $num_results_uuy = $result_uuy->num_rows;

                    if ($num_results_uuy != 0) {
                        $row_8 = mysqli_fetch_assoc($result_uuy);
                    }


	
	include $url_system.'tours/code/block_tours.php';
		 echo($task_cloud_block);		  
						 
					 }
 echo'</div>';
							
					  
	  $count_pages=CountPage($sql_count,$link,$count_write);
	  if($count_pages>1)
	  {

			  displayPageLink_new('tours/','tours/.page-',"", NumberPageActive('n_st'),$count_pages ,5,9,"journal_oo",1);
		  
		  
	  }
		
					  
					  
 } else
				  {
					  
//echo'<div class="booking_div da_book1"><div class="not_booling"></div><span class="h4" style="width:calc(100% - 60px)"><span>Клиентов с такими параметрами пока нет. Измените параметры и попробуйте еще раз.</span></span></div>';
					  
					  
echo'<div class="message_search_b js-message-task-search"><span>Оформленных туров с такими параметрами пока нет. Измените параметры и попробуйте еще раз.</span></div>';
					 echo'<div class="ring_block ring-block-line js-global-task-link"></div>'; 
				  }
	  
?>

       
        
  <?       

	
    ?>
    </div>
  </div>

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

count_task();
classblockTrips();
 });
</script>


</body></html>