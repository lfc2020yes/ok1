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



$active_menu='task';  // в каком меню


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


if((!$role->permission('Задачи','R'))and($sign_admin!=1))
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

if($error_header!=404){ SEO('task','','','',$link); } else { SEO('0','','','',$link); }

include_once $url_system.'module/config_url.php'; include $url_system.'template/head.php';
?>
</head><body>
<?
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

	  include_once $url_system.'template/top_tasks.php';


     echo'<div id="fullpage" class="margin_60" id_content="'.$id_user.'">';

	?>
 <div class="section" id="section1">
	 

	<div class="oka_block_2019" style="min-height:auto !important;">
 
 <div class="line_mobile_blue">Ваши задачи</div>

<div class="div_ook hop_ds">
	
<?
		 $st_fil1='js-plus-filter no-active';
		 		   if (( isset($_COOKIE["su_7ta".$id_user]))and($_COOKIE["su_7ta".$id_user]=='1'))
		   {
					   $st_fil1='js-plus-filter active-filter-s';
				   }
	
	
	echo'<div class="search_task '.$st_fil1.'">';

     
	
echo'<h1 class="h1-filter js-h1-filter">Расширенные фильтры';
	 
	 		   if ((( isset($_COOKIE["su_7ta".$id_user]))and($_COOKIE["su_7ta".$id_user]=='1')))
		   {
	 echo'<div class="choice-radio"><div class="center_vert1"><i class="active_task_cb"></i></div><input name="task[filter]" value="1" type="hidden"></div>'; 
			} else
			   {
				   echo'<div class="choice-radio"><div class="center_vert1"><i></i></div><input name="task[filter]" value="1" type="hidden"></div>';
			   }
	 echo'<span class="search-count-task"></span>';
echo'</h1>';	
	
	
	
 $zindex=110;

		
       $os2 = array( "3 ближайших дня","3 ближайших дня + просроченные","Сегодня","Завтра","+30 дней","+30 дней + просроченные","Текущий месяц","Выбрать период");
	   $os_id2 = array("0","6","1","5","3","9","4","2");
		
		$su_2=0;
		$date_su='';
		if (( isset($_COOKIE["su_2ta".$id_user]))and(is_numeric($_COOKIE["su_2ta".$id_user]))and(array_search($_COOKIE["su_2ta".$id_user],$os_id2)!==false))
		{
			$su_2=$_COOKIE["su_2ta".$id_user];
		}
		$val_su2=$os2[array_search($su_2, $os_id2)];
		
		
		if ( isset($_COOKIE["suddta".$id_user]))
		{
			//$date_base__=explode(".",$_COOKIE["sudds"]);
		if (( isset($_COOKIE["su_2ta".$id_user]))and(is_numeric($_COOKIE["su_2ta".$id_user]))and($_COOKIE["su_2ta".$id_user]==2))
		{
			$date_su=$_COOKIE["suddta_mor".$id_user];
			$val_su2=$_COOKIE["suddta_mor".$id_user];
		}
		}
		$class_js_readonly ??= '';
		$class_js_search ??= '';
		
	    $_COOKIE["su_2ta".$id_user] ??= '';
	$_COOKIE["su_1ta".$id_user] ??= '';
	$_COOKIE["su_3ta".$id_user] ??= '';
	$_COOKIE["su_4ta".$id_user] ??= '';
	$_COOKIE["su_5ta".$id_user] ??= '';
	
	
		echo'<input id="date_hidden_table" '.$class_js_readonly.' name="date" value="'.$date_su.'" type="hidden"><input id="date_hidden_start" name="start_date" type="hidden"><input id="date_hidden_end" name="end_date" type="hidden">';
	
		   echo'<div class="left_drop menu1_prime book_menu_sel gop_io js--sort  js-call-no-v'.$class_js_search.'" style="z-index:'.$zindex.'"><label>Период исполнения</label><div class="select eddd"><a class="slct" list_number="t2" data_src="'.$os_id2[array_search($_COOKIE["su_2ta".$id_user], $os_id2)].'">'.$val_su2.'</a><ul class="drop">';
	
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
		   echo'</ul><input type="hidden" '.$class_js_readonly.' name="sort2ta" id="sort2ta" value="'.$os2[$su_2].'"></div></div>'; 		
		

	
	
	
	
	   //$zindex=110;

       $os = array( "Любой","Открытые","Закрытые","Просроченные","Выполненные");
	   $os_id = array("0","1","2","3","4");
	   
	 
	 $class_js_search='';
	 $class_js_readonly='';
	/*
	  	if(( isset($_COOKIE["su_7ta".$id_user]))and($_COOKIE["su_7ta".$id_user]!=''))
		{
		   $class_js_search='greei_input';
	       $class_js_readonly='readonly=""';
		}
	*/	
		$su_1=0;
		if (( isset($_COOKIE["su_1ta".$id_user]))and(is_numeric($_COOKIE["su_1ta".$id_user]))and(array_search($_COOKIE["su_1ta".$id_user],$os_id)!==false))
		{
			$su_1=$_COOKIE["su_1ta".$id_user];
		}
		//echo($class_js_search);
		
		   echo'<div class="left_drop menu1_prime book_menu_sel js--sort gop_io '.$class_js_search.'" style="z-index:'.$zindex.'"><label>Статус задачи</label><div class="select eddd"><a class="slct" list_number="t3" data_src="'.$os_id[array_search($_COOKIE["su_1ta".$id_user], $os_id)].'">'.$os[array_search($_COOKIE["su_1ta".$id_user], $os_id)].'</a><ul class="drop">';
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
		   echo'</ul><input type="hidden" name="sort1ta" id="sort1ta" value="'.$os[$su_1].'"></div></div>'; 
	 
		
		

       $os3 = array("Личные","Общие","День рождение","Время вылета","Время прилета","Впечатление туриста","Оплата от туриста","Оплата туроператору","Срок действия паспорта","Обращения");
	   $os_id3 = array("1","2","3","4","5","6","7","8","9","10");
		
		$su_3=array();
		if ( isset($_COOKIE["su_3ta".$id_user]))
		{
			$su_3=explode(",",$_COOKIE["su_3ta".$id_user]);
		} else
		{
			$su_3=$os_id3;
		}
		
	$select_val_name='';
			   for ($i=0; $i<count($su_3); $i++)
             {  
				   if($select_val_name=='')
				   {
					   $select_val_name=$os3[array_search($su_3[$i],$os_id3)];
				   } else
				   {
					   $select_val_name.=', '.$os3[array_search($su_3[$i],$os_id3)];
				   }
			   }
		
		   echo'<div class="left_drop menu1_prime book_menu_sel js--sort gop_io '.$class_js_search.'" style="z-index:'.$zindex.'"><label>Тип задачи</label><div class="select eddd"><a class="slct" list_number="t4" data_src="'.implode(",",$su_3).'">'.$select_val_name.'</a><ul class="drop-radio js-no-nul-select">';
			$zindex--;

		   for ($i=0; $i<count($os3); $i++)
             {   
			   if ((in_array($os_id3[$i], $su_3))or($_COOKIE["su_3ta".$id_user]==''))
			   {
				   echo'<li>
				   <div class="choice-radio"><div class="center_vert1"><i class="active_task_cb"></i></div></div>
				   
				   <a href="javascript:void(0);"  rel="'.$os_id3[$i].'">'.$os3[$i].'</a></li>';
			   } else
			   {
				  echo'<li> <div class="choice-radio"><div class="center_vert1"><i></i></div></div><a href="javascript:void(0);"  rel="'.$os_id3[$i].'">'.$os3[$i].'</a></li>'; 
			   }
			 
			 }
		   echo'</ul><input type="hidden" '.$class_js_readonly.' name="sort3ta" id="sort3ta" value="'.$su_3.'"></div></div>'; 

   

		       $os4 = array( "Не важно","Назначенные","Выставленные");
	   $os_id4 = array("0","1","2");	
	
	 
	 
		$su_4=0;
		if (( isset($_COOKIE["su_4ta".$id_user]))and(is_numeric($_COOKIE["su_4ta".$id_user]))and(array_search($_COOKIE["su_4ta".$id_user],$os_id4)!==false))
		{
			$su_4=$_COOKIE["su_4ta".$id_user];
		}
		
		
		   echo'<div class="left_drop menu1_prime book_menu_sel js--sort gop_io '.$class_js_search.'" style="z-index:'.$zindex.'"><label>Особенности</label><div class="select eddd"><a class="slct" list_number="t5" data_src="'.$os_id4[array_search($_COOKIE["su_4ta".$id_user], $os_id4)].'">'.$os4[array_search($_COOKIE["su_4ta".$id_user], $os_id4)].'</a><ul class="drop">';
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
		   echo'</ul><input type="hidden" '.$class_js_readonly.' name="sort4ta" id="sort4ta" value="'.$os4[$su_4].'"></div></div>'; 


		
     $os5 = array( "Мои задачи");
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
		   array_push($os5, 'Все подчиненные менеджеры');
	       array_push($os_id5, 'all_subor');		
		}
	 
		$su_5=0;
		if (( isset($_COOKIE["su_5ta".$id_user]))and(array_search($_COOKIE["su_5ta".$id_user],$os_id5)!==false))
		{
			$su_5=$_COOKIE["su_5ta".$id_user];
		}
		
		
		   echo'<div class="left_drop menu1_prime book_menu_sel js--sort gop_io '.$class_js_search.'" style="z-index:'.$zindex.'"><label>менеджер</label><div class="select eddd"><a class="slct" list_number="t6" data_src="'.$os_id5[array_search($_COOKIE["su_5ta".$id_user], $os_id5)].'">'.$os5[array_search($_COOKIE["su_5ta".$id_user], $os_id5)].'</a><ul class="drop">';
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
		   echo'</ul><input type="hidden" '.$class_js_readonly.' name="sort5ta" id="sort5ta" value="'.$os5[$su_5].'"></div></div>'; 
		
	
	 echo'<div class="inline_reload js-reload-top"><a href="task/" class="show_reload">Применить</a></div>'; 
		
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
minDate: "-1Y", maxDate: "+1Y",
onSelect: function(dateText, inst, extensionRange) {

	$('#date_table').val(jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.startDate) + ' - ' + jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.endDate));
	
	var iu=$('.content').attr('iu');
	$.cookie("suddta_mor"+iu, null, {path:'/',domain: window.is_session,secure: false}); 	
CookieList("suddta_mor"+iu,jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.startDate) + ' - ' + jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.endDate),'add');
	
	
	$('#date_hidden_start').val(jQuery.datepicker.formatDate('yy-mm-dd',extensionRange.startDate));
	$('#date_hidden_end').val(jQuery.datepicker.formatDate('yy-mm-dd',extensionRange.endDate));
	
	$('[list_number=t2]').empty().append(jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.startDate) + ' - ' + jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.endDate));		
		$.cookie("suddta"+iu, null, {path:'/',domain: window.is_session,secure: false}); 	
CookieList("suddta"+iu,$('#date_hidden_start').val()+'/'+$('#date_hidden_end').val(),'add');
	
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
if((isset($_COOKIE["su_2ta".$id_user]))and(is_numeric($_COOKIE["su_2ta".$id_user]))and($_COOKIE["su_2ta".$id_user]==2))
{
$date_range=explode("/",$_COOKIE["suddta".$id_user]);	
echo'var st=\''.ipost_($date_range[0],'').'\';
var st1=\''.ipost_($date_range[1],'').'\';
var st2=\''.ipost_($_COOKIE["suddta_mor".$id_user],'').'\';';
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
		 		   if ((( isset($_COOKIE["su_7ta".$id_user]))and($_COOKIE["su_7ta".$id_user]=='2'))or(!isset($_COOKIE["su_7ta".$id_user])))
		   {
					   $st_fil='active-filter-s';
				   }
	 
	 
echo'<div class="filter-wois '.$st_fil.'"><h1 class="h1-filter js-h1-filter">Быстрые фильтры';
	 
	 	   if ($st_fil!='')
		   {
	 echo'<div class="choice-radio"><div class="center_vert1"><i class="active_task_cb"></i></div><input name="task[filter]" value="2" type="hidden"></div>'; 
			} else
			{
	 echo'<div class="choice-radio"><div class="center_vert1"><i></i></div><input name="task[filter]" value="2" type="hidden"></div> ';
			}
	 
	echo'<span class="search-count-task"></span>';
	
	
echo'</h1>';	 

	 
$result_6 = mysql_time_query($link,"select A.* from task_quick_filters as A WHERE A.visible=1 order by A.displayOrder");
//$row_1 = mysqli_fetch_assoc($result2);
if($result_6)
{ 
   $i=0;
	$end=0;
   while($row_6 = mysqli_fetch_assoc($result_6)){ 
	   if(($i==0)or($i==3)or($i==6)or($i==9))
	   {
		   if($i!=0)
		   {
			   $end=0;
			   echo'</div>';
		   }
		   
		   
		   echo'<div class="filter-block">';
		   $end=1;
	   }
	  		if (((( isset($_COOKIE["su_7fta".$id_user])))and($_COOKIE["su_7fta".$id_user]==$row_6["id"]))or((!isset($_COOKIE["su_7fta".$id_user]))and($row_6["default"]==1)))
		{
	   echo'<div class="fi-a active-fi" id="'.$row_6["id"].'"><a href="task/">'.$row_6["name"].'</a></div>';
			} else
			{
		 echo'<div class="fi-a" id="'.$row_6["id"].'"><a href="task/">'.$row_6["name"].'</a></div>';		
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

  $sql_su1='';
  $sql_su2='';
  $sql_su3='';
  $sql_su4='';
  $sql_su5='';
  $sql_su6='';
  $sql_su7='';
  $sql_order='';
	
	
if ((( isset($_COOKIE["su_7ta".$id_user]))and($_COOKIE["su_7ta".$id_user]=='1')))
{
	  $sql_order=' order by A.ring_datetime ';
	  $sql_order=' order by A.ring_datetime';
	
	
	///поиск для расширенных фильтров
	if($su_2==0)
	{
		//Три ближайщих дня
		$date_end_start=date_step_sql('Y-m-d','+0d').' 00:00:00';
		$date_end_end=date_step_sql('Y-m-d','+3d').' 00:00:00';
		$sql_su2=' and A.ring_datetime>="'.$date_end_start.'" and  A.ring_datetime<"'.$date_end_end.'"';
	}
	if($su_2==6)
	{
		//Три ближайщих дня + просроченные
		$date_end_start=date_step_sql('Y-m-d','+0d').' 00:00:00';
		$date_end_end=date_step_sql('Y-m-d','+3d').' 00:00:00';
		$sql_su2=' and ((A.ring_datetime>="'.$date_end_start.'" and  A.ring_datetime<"'.$date_end_end.'")or((A.ring_datetime<"'.date("Y-m-d").' '.date("H:i:s").'")and(A.reminder=0)))';
	}
	if($su_2==1)
	{
		//Только сегодня
		$date_end_start=date_step_sql('Y-m-d','+0d').' 00:00:00';
		$date_end_end=date_step_sql('Y-m-d','+1d').' 00:00:00';
		$sql_su2=' and A.ring_datetime>="'.$date_end_start.'" and  A.ring_datetime<"'.$date_end_end.'"';
	}
	if($su_2==5)
	{
		//Только завтра
		$date_end_start=date_step_sql('Y-m-d','+1d').' 00:00:00';
		$date_end_end=date_step_sql('Y-m-d','+2d').' 00:00:00';
		$sql_su2=' and A.ring_datetime>="'.$date_end_start.'" and  A.ring_datetime<"'.$date_end_end.'"';
	}
	if($su_2==3)
	{
		//+30 дней
		$date_end_start=date_step_sql('Y-m-d','+0d').' 00:00:00';
		$date_end_end=date_step_sql('Y-m-d','+30d').' 00:00:00';
		$sql_su2=' and A.ring_datetime>="'.$date_end_start.'" and  A.ring_datetime<"'.$date_end_end.'"';
	}
    if($su_2==9)
    {
        //+30 дней + просроченные
        $date_end_start=date_step_sql('Y-m-d','+0d').' 00:00:00';
        $date_end_end=date_step_sql('Y-m-d','+30d').' 00:00:00';
        $sql_su2=' and ((A.ring_datetime>="'.$date_end_start.'" and  A.ring_datetime<"'.$date_end_end.'")or((A.ring_datetime<"'.date("Y-m-d").' '.date("H:i:s").'")and(A.reminder=0)))';
    }


	if($su_2==4)
	{
		//текущий месяц
		$date_end_start=date_step_sql('Y-m','+0d').'-01 00:00:00';
		$date_end_end=date_step_sql('Y-m','+1m').'-01 00:00:00';		
		$sql_su2=' and (((A.ring_datetime>="'.$date_end_start.'") and  (A.ring_datetime<"'.$date_end_end.'") and(A.reminder=0))or((A.ring_datetime>="'.date("Y-m-d").' '.date("H:i:s").'") and  (A.ring_datetime<"'.$date_end_end.'") and(A.reminder=1))) ';
	}
	if($su_2==2)
	{
		//Выбранные период пользователем
		$date_range=explode("/",$_COOKIE["suddta".$id_user]);	
	$sql_su2=' and A.ring_datetime>="'.ht($date_range[0]).' 00:00:00" and A.ring_datetime<="'.ht($date_range[1]).' 23:59:59" and A.reminder=0';
	}

	//статус задачи
	//статус задачи
	//статус задачи
	if($su_1==1)
	{
		//открытые задачи
		$sql_su1=' and A.status="0"';
	}
	if($su_1==2)
	{
		//закрытые задачи
		$sql_su1=' and A.status="2"';
	}	
	if($su_1==4)
	{
		//выполне задачи
		$sql_su1=' and A.status="1"';
	}
	if($su_1==3)
	{
		//просроченные невыполн. задачи
		$sql_su1=' and A.status="0" and A.ring_datetime<"'.date("Y-m-d").' '.date("H:i:s").'"';
	}
	//статус задачи
	//статус задачи
	//статус задачи
	
	
	
	//тип задачи
	//тип задачи
	//тип задачи
	$flag_obs=0;
	if(count($su_3)!=0)
	{
		$mas_action_f=array();
		   for ($i=0; $i<count($su_3); $i++)
           {  
			  switch($su_3[$i])
              {
						  
			case "1":{
			//личные задачи
			 array_push($mas_action_f,"14");
			array_push($mas_action_f,"13");
				array_push($mas_action_f,"12");
				array_push($mas_action_f,"11");
				array_push($mas_action_f,"10");
				array_push($mas_action_f,"9");

			 break;
		    }					  
			case "3":{
			//варенье
			 array_push($mas_action_f,"7"); 
			 break;
		    }						  
			case "4":{
			//Время вылета
			 array_push($mas_action_f,"5");
                array_push($mas_action_f,"15");
                break;
		    }
			case "5":{
			//Время прилета
			 array_push($mas_action_f,"6");
                array_push($mas_action_f,"16");
			 break;
		    }					  
			case "6":{
			//Узнать впечатление
			 array_push($mas_action_f,"8");
                array_push($mas_action_f,"17");
                break;
		    }
             case "7":{
                      //оплата от туриста
                      array_push($mas_action_f,"4");
                      break;
                  }
                  case "8":{
                      //оплата туроператору
                      array_push($mas_action_f,"18");
                      break;
                  }
                  case "9":{
                      //оплата туроператору
                      array_push($mas_action_f,"21");
                      break;
                  }
                  case "10":{
                      //оплата туроператору
                      array_push($mas_action_f,"20");
                      break;
                  }
                  case "2":{
			//общие задачи
			 //array_push($mas_action_f,"8");
					if(count($su_3)==1)
	{
				$sql_su7=' AND A.id_user_responsible LIKE "%,%"';
					}
				$flag_obs=1;
			 break;
		    }			  
					  
			  }
		   }
			if(count($mas_action_f)!=0)
	{
				$new_act="'".implode("','",$mas_action_f)."'";
		$sql_su3=' AND A.action IN ('.$new_act.')';

			}
	}
	
	//тип задачи
	//тип задачи
	//тип задачи	
	//echo($su_5);
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
	
	
	//особенности
	//особенности
	//особенности
	if($su_4==1)
	{
		//назначенние
		if($flag_vstt==0)
		{
			$ob_s='(A.id_user_responsible="'.$query_user.'")or';
			if($flag_obs==1)
			{
				//$ob_s='';
			}
		$sql_su4=' AND ('.$ob_s.'(A.id_user_responsible LIKE "'.$query_user.',%")or(A.id_user_responsible LIKE "%,'.$query_user.',%")or(A.id_user_responsible LIKE "%,'.$query_user.'"))';
		} else
		{
			if(count($mass_ei)!=0)
			{
				$io=0;
				$sql_su4=' AND (';
				
			foreach ($mass_ei as $key => $value) 
            {
				if($io==0) {
			
			$ob_s='(A.id_user_responsible="'.$value.'")or';
			if($flag_obs==1)
			{
				//$ob_s='';
			}
					$sql_su4.='('.$ob_s.'(A.id_user_responsible LIKE "'.$value.',%")or(A.id_user_responsible LIKE "%,'.$value.',%")or(A.id_user_responsible LIKE "%,'.$value.'"))';
					
				} else
				{
			$ob_s='(A.id_user_responsible="'.$value.'")or';
			if($flag_obs==1)
			{
				//$ob_s='';
			}					
					$sql_su4.='or('.$ob_s.'(A.id_user_responsible LIKE "'.$value.',%")or(A.id_user_responsible LIKE "%,'.$value.',%")or(A.id_user_responsible LIKE "%,'.$value.'"))';
				}
				$io++;
			
			}
				$sql_su4.=' )';
			}
		}		
	}
	if($su_4==2)
	{
		//выставленные
		if($flag_vstt==0)
		{
		$sql_su4=' AND ((A.id_user="'.$query_user.'"))';
		} else
		{
			if(count($mass_ei)!=0)
			{
				$io=0;
				$sql_su4=' AND (';
				
			foreach ($mass_ei as $key => $value) 
            {
				if($io==0) {
				
					$sql_su4.='((A.id_user="'.$value.'"))';
					
				} else
				{
					$sql_su4.='or((A.id_user="'.$value.'"))';
				}
				$io++;
			
			}
				$sql_su4.=' )';
			}
		}
		
	}
	
	
	if($su_4==0)
	{
		//любые но связанные с менеджером или несколькими менеджера сразу
		if($flag_vstt==0)
		{
			//echo($flag_vstt);
		$ob_s='(A.id_user_responsible="'.$query_user.'")or';
			if($flag_obs==1)
			{
				//$ob_s='';
			}		
			
		$sql_su4x1=' AND (('.$ob_s.'(A.id_user_responsible LIKE "'.$query_user.',%")or(A.id_user_responsible LIKE "%,'.$query_user.',%")or(A.id_user_responsible LIKE "%,'.$query_user.'"))';
		} else
		{
			if(count($mass_ei)!=0)
			{
				$io=0;
				$sql_su4x1=' AND ((';
				
			foreach ($mass_ei as $key => $value) 
            {
				if($io==0) {
				
						$ob_s='(A.id_user_responsible="'.$value.'")or';
			if($flag_obs==1)
			{
				//$ob_s='';
			}		
					
					$sql_su4x1.='('.$ob_s.'(A.id_user_responsible LIKE "'.$value.',%")or(A.id_user_responsible LIKE "%,'.$value.',%")or(A.id_user_responsible LIKE "%,'.$value.'"))';
					
				} else
				{
					
			$ob_s='(A.id_user_responsible="'.$value.'")or';
			if($flag_obs==1)
			{
				//$ob_s='';
			}
					$sql_su4x1.='or('.$ob_s.'(A.id_user_responsible LIKE "'.$value.',%")or(A.id_user_responsible LIKE "%,'.$value.',%")or(A.id_user_responsible LIKE "%,'.$value.'"))';
				}
				$io++;
			
			}
				$sql_su4x1.=' )';
			}
		}
		
		//выставленные
		if($flag_vstt==0)
		{
		$sql_su4x2=' or (A.id_user="'.$query_user.'"))';
		} else
		{
			if(count($mass_ei)!=0)
			{
				$io=0;
				$sql_su4x2=' or (';
				
			foreach ($mass_ei as $key => $value) 
            {
				if($io==0) {
				
					$sql_su4x2.='((A.id_user="'.$value.'"))';
					
				} else
				{
					$sql_su4x2.='or((A.id_user="'.$value.'"))';
				}
				$io++;
			
			}
				$sql_su4x2.=' ))';
			}
		}
		
	$sql_su4=$sql_su4x1.' '.$sql_su4x2;
		
		
	}
	
	//особенности
	//особенности
	//особенности		
	
	$sql_k='Select 
  
  DISTINCT A.*
  
  from task_new as A
  
  where A.visible=1 '.$sql_su2.' '.$sql_su1.' '.$sql_su3.' '.$sql_su4.' '.$sql_su7.' '.$sql_order.' '.limitPage('n_st',$count_write);
	
//echo($sql_k);
	
  $result_t2=mysql_time_query($link,$sql_k);
	  

  $sql_count='Select 
  
  count(DISTINCT A.id) as kol
  
  from task_new as A 
  
  where A.visible=1 '.$sql_su2.' '.$sql_su1.' '.$sql_su3.' '.$sql_su7.' '.$sql_su4;		
	
} else
{
	

	//быстрые фильтры
	if (((isset($_COOKIE["su_7fta".$id_user])))and(is_numeric($_COOKIE["su_7fta".$id_user])))
		{
		$result_uu=mysql_time_query($link,'select a.number from task_quick_filters as a where a.id="'.ht($_COOKIE["su_7fta".$id_user]).'" and a.visible=1');
	} else
	{
		$result_uu=mysql_time_query($link,'select a.number from task_quick_filters as a where a.default=1 and a.visible=1');		
	}
	$num_results_uu = $result_uu->num_rows;

   if($num_results_uu!=0)
   {                 
	$row_uu = mysqli_fetch_assoc($result_uu);
	   
	$sql_order=' order by A.ring_datetime ';   
	   
    if($row_uu["number"]==1)
	{
		//Назначенные мне. Открытые
	$sql_k='Select DISTINCT A.* from task_new as A where A.visible=1 AND A.status=0 AND ((A.id_user_responsible="'.$id_user.'")or(A.id_user_responsible LIKE "'.$id_user.',%")or(A.id_user_responsible LIKE "%,'.$id_user.',%")or(A.id_user_responsible LIKE "%,'.$id_user.'")) '.$sql_order.' '.limitPage('n_st',$count_write);
	
//echo($sql_k);	
	
    $result_t2=mysql_time_query($link,$sql_k);			
	  
    $sql_count='Select count(DISTINCT A.id) as kol from task_new as A where A.visible=1 AND A.status=0 AND ((A.id_user_responsible="'.$id_user.'")or(A.id_user_responsible LIKE "'.$id_user.',%")or(A.id_user_responsible LIKE "%,'.$id_user.',%")or(A.id_user_responsible LIKE "%,'.$id_user.'"))';		   
	}
    if($row_uu["number"]==2)
	{
		//выставленные мной. Открытые
	$sql_k='Select DISTINCT A.* from task_new as A where A.visible=1 AND A.status=0 AND ((A.id_user="'.$id_user.'")) '.$sql_order.' '.limitPage('n_st',$count_write);
	
//echo($sql_k);	
	
    $result_t2=mysql_time_query($link,$sql_k);			
	  
    $sql_count='Select count(DISTINCT A.id) as kol from task_new as A where A.visible=1 AND A.status=0 AND ((A.id_user_responsible="'.$id_user.'"))';		   
	}
	if($row_uu["number"]==3)
	{
		//все Открытые связанные с пользователем
	$sql_k='Select DISTINCT A.* from task_new as A where A.visible=1 AND A.status=0 AND (((A.id_user_responsible="'.$id_user.'")or(A.id_user_responsible LIKE "'.$id_user.',%")or(A.id_user_responsible LIKE "%,'.$id_user.',%")or(A.id_user_responsible LIKE "%,'.$id_user.'"))or(A.id_user="'.$id_user.'")) '.$sql_order.' '.limitPage('n_st',$count_write);
	
//echo($sql_k);	
	
    $result_t2=mysql_time_query($link,$sql_k);			
	  
    $sql_count='Select count(DISTINCT A.id) as kol from task_new as A where A.visible=1 AND A.status=0 AND (((A.id_user_responsible="'.$id_user.'")or(A.id_user_responsible LIKE "'.$id_user.',%")or(A.id_user_responsible LIKE "%,'.$id_user.',%")or(A.id_user_responsible LIKE "%,'.$id_user.'"))or(A.id_user="'.$id_user.'"))';		   
	   
	}   
	   
	    if($row_uu["number"]==4)
	{
		//Назначенные мне. просроченные 
	$sql_k='Select DISTINCT A.* from task_new as A where A.visible=1 AND A.status=0 AND ((A.id_user_responsible="'.$id_user.'")or(A.id_user_responsible LIKE "'.$id_user.',%")or(A.id_user_responsible LIKE "%,'.$id_user.',%")or(A.id_user_responsible LIKE "%,'.$id_user.'")) and A.ring_datetime<"'.date("Y-m-d").' '.date("H:i:s").'" '.$sql_order.' '.limitPage('n_st',$count_write);
	
//echo($sql_k);	
	
    $result_t2=mysql_time_query($link,$sql_k);			
	  
    $sql_count='Select count(DISTINCT A.id) as kol from task_new as A where A.visible=1 AND A.status=0 AND ((A.id_user_responsible="'.$id_user.'")or(A.id_user_responsible LIKE "'.$id_user.',%")or(A.id_user_responsible LIKE "%,'.$id_user.',%")or(A.id_user_responsible LIKE "%,'.$id_user.'")) and A.ring_datetime<"'.date("Y-m-d").' '.date("H:i:s").'"';		   
	} 
	    if($row_uu["number"]==5)
	{
		//Выставленные мной. Просроченные 
	$sql_k='Select DISTINCT A.* from task_new as A where A.visible=1 AND A.status=0 AND ((A.id_user="'.$id_user.'")) and A.ring_datetime<"'.date("Y-m-d").' '.date("H:i:s").'" '.$sql_order.' '.limitPage('n_st',$count_write);
	
//echo($sql_k);	
	
    $result_t2=mysql_time_query($link,$sql_k);			
	  
    $sql_count='Select count(DISTINCT A.id) as kol from task_new as A where A.visible=1 AND A.status=0 AND ((A.id_user_responsible="'.$id_user.'")) and A.ring_datetime<"'.date("Y-m-d").' '.date("H:i:s").'"';		   
	}   
	   
	if($row_uu["number"]==6)
	{
		//все просроченные связанные с пользователем
	$sql_k='Select DISTINCT A.* from task_new as A where A.visible=1 AND A.status=0 AND (((A.id_user_responsible="'.$id_user.'")or(A.id_user_responsible LIKE "'.$id_user.',%")or(A.id_user_responsible LIKE "%,'.$id_user.',%")or(A.id_user_responsible LIKE "%,'.$id_user.'"))or(A.id_user="'.$id_user.'")) and A.ring_datetime<"'.date("Y-m-d").' '.date("H:i:s").'" '.$sql_order.' '.limitPage('n_st',$count_write);
	
//echo($sql_k);	
	
    $result_t2=mysql_time_query($link,$sql_k);			
	  
    $sql_count='Select count(DISTINCT A.id) as kol from task_new as A where A.visible=1 AND A.status=0 AND (((A.id_user_responsible="'.$id_user.'")or(A.id_user_responsible LIKE "'.$id_user.',%")or(A.id_user_responsible LIKE "%,'.$id_user.',%")or(A.id_user_responsible LIKE "%,'.$id_user.'"))or(A.id_user="'.$id_user.'")) and A.ring_datetime<"'.date("Y-m-d").' '.date("H:i:s").'"';		   
	   
	} 	   
	   
	    if($row_uu["number"]==7)
	{
		//Назначенные мне. закрытые
	$sql_k='Select DISTINCT A.* from task_new as A where A.visible=1 AND A.status=2 AND ((A.id_user_responsible="'.$id_user.'")or(A.id_user_responsible LIKE "'.$id_user.',%")or(A.id_user_responsible LIKE "%,'.$id_user.',%")or(A.id_user_responsible LIKE "%,'.$id_user.'")) '.$sql_order.' '.limitPage('n_st',$count_write);
	
//echo($sql_k);	
	
    $result_t2=mysql_time_query($link,$sql_k);			
	  
    $sql_count='Select count(DISTINCT A.id) as kol from task_new as A where A.visible=1 AND A.status=2 AND ((A.id_user_responsible="'.$id_user.'")or(A.id_user_responsible LIKE "'.$id_user.',%")or(A.id_user_responsible LIKE "%,'.$id_user.',%")or(A.id_user_responsible LIKE "%,'.$id_user.'"))';		   
	}
    if($row_uu["number"]==8)
	{
		//выставленные мной. закрытые
	$sql_k='Select DISTINCT A.* from task_new as A where A.visible=1 AND A.status=2 AND ((A.id_user="'.$id_user.'")) '.$sql_order.' '.limitPage('n_st',$count_write);
	
//echo($sql_k);	
	
    $result_t2=mysql_time_query($link,$sql_k);			
	  
    $sql_count='Select count(DISTINCT A.id) as kol from task_new as A where A.visible=1 AND A.status=2 AND ((A.id_user_responsible="'.$id_user.'"))';		   
	}
	if($row_uu["number"]==9)
	{
		//все закрытые связанные с пользователем
	$sql_k='Select DISTINCT A.* from task_new as A where A.visible=1 AND A.status=2 AND (((A.id_user_responsible="'.$id_user.'")or(A.id_user_responsible LIKE "'.$id_user.',%")or(A.id_user_responsible LIKE "%,'.$id_user.',%")or(A.id_user_responsible LIKE "%,'.$id_user.'"))or(A.id_user="'.$id_user.'")) '.$sql_order.' '.limitPage('n_st',$count_write);
	
//echo($sql_k);	
	
    $result_t2=mysql_time_query($link,$sql_k);			
	  
    $sql_count='Select count(DISTINCT A.id) as kol from task_new as A where A.visible=1 AND A.status=2 AND (((A.id_user_responsible="'.$id_user.'")or(A.id_user_responsible LIKE "'.$id_user.',%")or(A.id_user_responsible LIKE "%,'.$id_user.',%")or(A.id_user_responsible LIKE "%,'.$id_user.'"))or(A.id_user="'.$id_user.'"))';		   
	   
	}    

	    if($row_uu["number"]==10)
	{
		//Назначенные мне. все
	$sql_k='Select DISTINCT A.* from task_new as A where A.visible=1 AND ((A.id_user_responsible="'.$id_user.'")or(A.id_user_responsible LIKE "'.$id_user.',%")or(A.id_user_responsible LIKE "%,'.$id_user.',%")or(A.id_user_responsible LIKE "%,'.$id_user.'")) '.$sql_order.' '.limitPage('n_st',$count_write);
	
//echo($sql_k);	
	
    $result_t2=mysql_time_query($link,$sql_k);			
	  
    $sql_count='Select count(DISTINCT A.id) as kol from task_new as A where A.visible=1 AND ((A.id_user_responsible="'.$id_user.'")or(A.id_user_responsible LIKE "'.$id_user.',%")or(A.id_user_responsible LIKE "%,'.$id_user.',%")or(A.id_user_responsible LIKE "%,'.$id_user.'"))';		   
	}
    if($row_uu["number"]==11)
	{
		//выставленные мной. все
	$sql_k='Select DISTINCT A.* from task_new as A where A.visible=1 AND ((A.id_user="'.$id_user.'")) '.$sql_order.' '.limitPage('n_st',$count_write);
	
//echo($sql_k);	
	
    $result_t2=mysql_time_query($link,$sql_k);			
	  
    $sql_count='Select count(DISTINCT A.id) as kol from task_new as A where A.visible=1 AND ((A.id_user_responsible="'.$id_user.'"))';		   
	}
	if($row_uu["number"]==12)
	{
		//все связанные с пользователем
	$sql_k='Select DISTINCT A.* from task_new as A where A.visible=1 AND (((A.id_user_responsible="'.$id_user.'")or(A.id_user_responsible LIKE "'.$id_user.',%")or(A.id_user_responsible LIKE "%,'.$id_user.',%")or(A.id_user_responsible LIKE "%,'.$id_user.'"))or(A.id_user="'.$id_user.'")) '.$sql_order.' '.limitPage('n_st',$count_write);
	
//echo($sql_k);	
	
    $result_t2=mysql_time_query($link,$sql_k);			
	  
    $sql_count='Select count(DISTINCT A.id) as kol from task_new as A where A.visible=1 AND (((A.id_user_responsible="'.$id_user.'")or(A.id_user_responsible LIKE "'.$id_user.',%")or(A.id_user_responsible LIKE "%,'.$id_user.',%")or(A.id_user_responsible LIKE "%,'.$id_user.'"))or(A.id_user="'.$id_user.'"))';		   
	   
	} 	   
	   
   }
	
}
	
//echo($sql_k);
		
		
	
	
//echo($sql_count);
$result_t221=mysql_time_query($link,$sql_count);	  
$row__221= mysqli_fetch_assoc($result_t221);	  

//echo' <h3 class="head_h" style=" margin-bottom:0px;">Cнабжение<i>'.$row__221["kol"].'</i><div></div></h3> ';	
	

//echo'<div class="okss"><span class="title_book yop_booking"><i>'.$row__221["kol"].'</i><span>'.PadejNumber($row__221["kol"],'найденная задача,найденных задачи,найденных задач').'</span></span></div>';			
			
echo'<div class="hidden-count-task">'.$row__221["kol"].' '.PadejNumber($row__221["kol"],'найденная задача,найденных задачи,найденных задач').'</div>';			
		
			

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

					$row_8= mysqli_fetch_assoc($result_t2);
	
	include $url_system.'task/code/block_task.php';
		 echo($task_cloud_block);		  
						 
					 }
 echo'</div>';
							
					  
	  $count_pages=CountPage($sql_count,$link,$count_write);
	  if($count_pages>1)
	  {

			  displayPageLink_new('task/','task/.page-',"", NumberPageActive('n_st'),$count_pages ,5,9,"journal_oo",1); 
		  
		  
	  }
		
					  
					  
 } else
				  {
					  
//echo'<div class="booking_div da_book1"><div class="not_booling"></div><span class="h4" style="width:calc(100% - 60px)"><span>Клиентов с такими параметрами пока нет. Измените параметры и попробуйте еще раз.</span></span></div>';
					  
					  
echo'<div class="message_search_b js-message-task-search"><span>Задач с такими параметрами пока нет. Измените параметры и попробуйте еще раз.</span></div>';						  
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
	 
 });
</script>


</body></html>