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



$active_menu='preorders';  // в каком меню


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


if((!$role->permission('Обращения','R'))and($sign_admin!=1))
{
  header404(3,$echo_r);
}

if(isset($_GET["id"])) {
//если есть id то смотрим может ли он смотеть этот тур
    $result_t = mysql_time_query($link, 'select A.id from preorders as A where A.id_company IN (' . $id_company . ') and A.id="' . ht($_GET['id']) . '" and A.visible=1');
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

if($error_header!=404){ SEO('preorders','','','',$link); } else { SEO('0','','','',$link); }

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

	  include_once $url_system.'template/top_preorders.php';


     echo'<div id="fullpage" class="margin_60" id_content="'.$id_user.'">';

	?>
 <div class="section" id="section1">

<?

if(((isset($_GET["tabs"]))and($_GET["tabs"]!=3))or(!isset($_GET["tabs"])))
{
?>


	<div class="oka_block_2019" style="min-height:auto !important;">



        <div class="line_mobile_blue1">




            <div class="menu_client_w_org_mobile">
                <div class="mm_w">
                    <ul class="tabs_hedi js-tabs-menuxx">
                        <?


                        $mass_ei=users_hierarchy($id_user,$link);
                        rm_from_array($id_user,$mass_ei);
                        $mass_ei= array_unique($mass_ei);

                        if(count($mass_ei)>0) {

                            $tabs_menu_x = array("Обращения клиентов", "История действий", "Статистика");
                            $tabs_menu_x_id = array("0", "1", "3");
                            $tabs_menu_x_link = array("", ".tabs-1", ".tabs-3");
                            $tabs_menu_x_class = array("", "click-history-pre", "");

                        } else
                        {
                            $tabs_menu_x = array("Обращения клиентов");
                            $tabs_menu_x_id = array("0");
                            $tabs_menu_x_link = array("");
                        }


                        for ($i=0; $i<count($tabs_menu_x); $i++)
                        {
                            if($i!=0)
                            {

                                if($_GET['tabs']==$tabs_menu_x_id[$i])
                                {
                                    echo'<a href="preorders/'.$tabs_menu_x_link[$i].'" class="tabsss_orgg active '.$tabs_menu_x_class[$i].'" id="'.$tabs_menu_x_id[$i].'">'.$tabs_menu_x[$i].'<span  class="menu-09-count">'.$count_all_bi[$i].'</span> </a>';
                                } else
                                {
                                    echo'<a href="preorders/'.$tabs_menu_x_link[$i].'" class="tabsss_orgg '.$tabs_menu_x_class[$i].'" id="'.$tabs_menu_x_id[$i].'">'.$tabs_menu_x[$i].'<span  class="menu-09-count">'.$count_all_bi[$i].'</span></a>';
                                }

                            } else
                            {

                                if(($_GET['tabs']==$tabs_menu_x_id[$i])or(!isset($_GET['tabs'])))
                                {
                                    echo'<a href="preorders/'.$tabs_menu_x_link[$i].'" class="tabsss_orgg active '.$tabs_menu_x_class[$i].'" id="'.$tabs_menu_x_id[$i].'">'.$tabs_menu_x[$i].'<span  class="menu-09-count">'.$count_all_bi[$i].'</span> </a>';
                                } else
                                {
                                    echo'<a href="preorders/'.$tabs_menu_x_link[$i].'" class="tabsss_orgg '.$tabs_menu_x_class[$i].'" id="'.$tabs_menu_x_id[$i].'">'.$tabs_menu_x[$i].'<span  class="menu-09-count">'.$count_all_bi[$i].'</span></a>';
                                }


                            }

                        }
                        ?>

                    </ul>
                </div>
            </div>



        </div>




<div class="div_ook hop_ds">
	
<?
		 $st_fil1='js-plus-filter no-active';
		 		   if (( isset($_COOKIE["su_7pr".$id_user]))and($_COOKIE["su_7pr".$id_user]=='1')and(!isset($_GET["id"])))
		   {
					   $st_fil1='js-plus-filter active-filter-s';
				   }
	
	
	echo'<div class="search_task '.$st_fil1.'">';

     
	
echo'<h1 class="h1-filter js-h1-filter-preorders js-click-history-m">Расширенные фильтры';
	 
	 		   if ((( isset($_COOKIE["su_7pr".$id_user]))and($_COOKIE["su_7pr".$id_user]=='1')))
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
		if (( isset($_COOKIE["su_2pr".$id_user]))and(is_numeric($_COOKIE["su_2pr".$id_user]))and(array_search($_COOKIE["su_2pr".$id_user],$os_id2)!==false))
		{
			$su_2=$_COOKIE["su_2pr".$id_user];
		}
		$val_su2=$os2[array_search($su_2, $os_id2)];
		
		
		if ( isset($_COOKIE["suddpr".$id_user]))
		{
			//$date_base__=explode(".",$_COOKIE["sudds"]);
		if (( isset($_COOKIE["su_2pr".$id_user]))and(is_numeric($_COOKIE["su_2pr".$id_user]))and($_COOKIE["su_2pr".$id_user]==2))
		{
			$date_su=$_COOKIE["suddpr_mor".$id_user];
			$val_su2=$_COOKIE["suddpr_mor".$id_user];
		}
		}
		$class_js_readonly ??= '';
		$class_js_search ??= '';
		
	    $_COOKIE["su_2pr".$id_user] ??= '';
	$_COOKIE["su_1pr".$id_user] ??= '';
	//$_COOKIE["su_3pr".$id_user] ??= '';
	$_COOKIE["su_4pr".$id_user] ??= '';
	$_COOKIE["su_5pr".$id_user] ??= '';


$class_js_search='';
$class_js_readonly='';
if(( isset($_COOKIE["su_7pp".$id_user]))and($_COOKIE["su_7pp".$id_user]!=''))
{
    $class_js_search='greei_input';
    $class_js_readonly='readonly=""';
}

	
		echo'<input id="date_hidden_table" '.$class_js_readonly.' name="date" value="'.$date_su.'" type="hidden"><input id="date_hidden_start" name="start_date" type="hidden"><input id="date_hidden_end" name="end_date" type="hidden">';

$name_bat='Дата обращения';
if(isset($_GET["tabs"]))
{
    $name_bat='Период события';
}


		   echo'<div class="left_drop menu1_prime book_menu_sel gop_io js--sort js-call-no-v '.$class_js_search.'" style="z-index:'.$zindex.'"><label>'.$name_bat.'</label><div class="select eddd"><a class="slct " list_number="t2" data_src="'.$os_id2[array_search($_COOKIE["su_2pr".$id_user], $os_id2)].'">'.$val_su2.'</a><ul class="drop">';
	
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
		   echo'</ul><input type="hidden" '.$class_js_readonly.' name="sort2tu" id="sort2pr" value="'.$os2[$su_2].'"></div></div>';



		   if(!isset($_GET["tabs"])) {


               $os3 = array("Новое обращение", "Подбор вариантов", "Варианты предложены клиенту", "Обсуждение окончательных вариантов", "Оформлен договор", "Отказ/отмена");
               $os_id3 = array("1", "2", "3", "4", "5", "6");

               $su_3 = array();
               if (isset($_COOKIE["su_3pr" . $id_user])) {
                   $su_3 = explode(",", $_COOKIE["su_3pr" . $id_user]);
               } else {
                   $su_3 = $os_id3;
               }


               $select_val_name = '';
               for ($i = 0; $i < count($su_3); $i++) {
                   if ($select_val_name == '') {
                       $select_val_name = $os3[array_search($su_3[$i], $os_id3)];
                   } else {
                       $select_val_name .= ', ' . $os3[array_search($su_3[$i], $os_id3)];
                   }
               }

               echo '<div class="left_drop menu1_prime book_menu_sel js--sort gop_io ' . $class_js_search . '" style="z-index:' . $zindex . '"><label>Статус</label><div class="select eddd"><a class="slct" list_number="t3" data_src="' . implode(",", $su_3) . '">' . $select_val_name . '</a><ul class="drop-radio js-no-nul-select">';
               $zindex--;

               for ($i = 0; $i < count($os3); $i++) {
                   if ((in_array($os_id3[$i], $su_3)) or ($_COOKIE["su_3pr" . $id_user] == '')) {
                       echo '<li>
				   <div class="choice-radio"><div class="center_vert1"><i class="active_task_cb"></i></div></div>
				   
				   <a href="javascript:void(0);"  rel="' . $os_id3[$i] . '">' . $os3[$i] . '</a></li>';
                   } else {
                       echo '<li> <div class="choice-radio"><div class="center_vert1"><i></i></div></div><a href="javascript:void(0);"  rel="' . $os_id3[$i] . '">' . $os3[$i] . '</a></li>';
                   }

               }
               echo '</ul><input type="hidden" ' . $class_js_readonly . ' name="sort3pr" id="sort3pr" value="' . implode(",", $su_3) . '"></div></div>';


               $os4 = array(
                   "Дата создания обращения"
               );
               $os_id4 = array("0");


               $su_4 = 0;
               if ((isset($_COOKIE["su_4pr" . $id_user])) and (is_numeric($_COOKIE["su_4pr" . $id_user])) and (array_search($_COOKIE["su_4pr" . $id_user], $os_id4) !== false)) {
                   $su_4 = $_COOKIE["su_4pr" . $id_user];
               }


               echo '<div class="left_drop menu1_prime book_menu_sel js--sort gop_io ' . $class_js_search . '" style="z-index:' . $zindex . '"><label>Сортировка</label><div class="select eddd"><a class="slct" list_number="t5" data_src="' . $os_id4[array_search($_COOKIE["su_4pr" . $id_user], $os_id4)] . '">' . $os4[array_search($_COOKIE["su_4pr" . $id_user], $os_id4)] . '</a><ul class="drop">';
               $zindex--;

               for ($i = 0; $i < count($os4); $i++) {
                   if ($su_4 == $os_id4[$i]) {
                       echo '<li class="sel_active"><a href="javascript:void(0);"  rel="' . $os_id4[$i] . '">' . $os4[$i] . '</a></li>';
                   } else {
                       echo '<li><a href="javascript:void(0);"  rel="' . $os_id4[$i] . '">' . $os4[$i] . '</a></li>';
                   }

               }
               echo '</ul><input type="hidden" ' . $class_js_readonly . ' name="sort4pr" id="sort4pr" value="' . $os4[$su_4] . '"></div></div>';


           }



		
     $os5 = array( "Себе");
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
		   array_push($os5, 'Всех подчиненных менеджерах');
	       array_push($os_id5, 'all_subor');		
		}
	 
		$su_5=0;
		if (( isset($_COOKIE["su_5pr".$id_user]))and(array_search($_COOKIE["su_5pr".$id_user],$os_id5)!==false))
		{
			$su_5=$_COOKIE["su_5pr".$id_user];
		}
		
		
		   echo'<div class="left_drop menu1_prime book_menu_sel js--sort gop_io '.$class_js_search.'" style="z-index:'.$zindex.'"><label>На ком</label><div class="select eddd"><a class="slct" list_number="t6" data_src="'.$os_id5[array_search($_COOKIE["su_5pr".$id_user], $os_id5)].'">'.$os5[array_search($_COOKIE["su_5pr".$id_user], $os_id5)].'</a><ul class="drop">';
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
		   echo'</ul><input type="hidden" '.$class_js_readonly.' name="sort5pr" id="sort5pr" value="'.$os5[$su_5].'"></div></div>';



if(!isset($_GET["tabs"])) {


    echo '<div class="left_drop menu1_prime book_menu_sel gop_io" style="z-index:' . $zindex . '"><label>id / клиент</label><div class="select eddd">
		   
		   <input name="sort_stock2" id="name_stock_search_preorders" class="name_stock_search_input js-text-search-x" autocomplete="off" value="' . ipost_(($_COOKIE["su_7pp" . $id_user] ?? ''), '') . '" type="text">';
    $zindex--;

    if ((isset($_COOKIE["su_7pp" . $id_user])) and ($_COOKIE["su_7pp" . $id_user] != '')) {
        echo '<div style="display:block;" class="dell_stock_search_preorders" data-tooltip="Удалить"><span>x</span></div>';
    } else {
        echo '<div  class="dell_stock_search_preorders" data-tooltip="Удалить"><span>x</span></div>';
    }


    echo '</div></div>';


}





if(!isset($_GET["tabs"])) {
    echo '<div class="inline_reload js-reload-top"><a href="preorders/" class="show_reload">Применить</a></div>';
} else
{
    echo '<div class="inline_reload js-reload-top"><a href="preorders/.tabs-1" class="show_reload">Применить</a></div>';
}
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
minDate: "-1Y", maxDate: "+0D",				
onSelect: function(dateText, inst, extensionRange) {

	$('#date_table').val(jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.startDate) + ' - ' + jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.endDate));
	
	var iu=$('.content').attr('iu');
	$.cookie("suddpr_mor"+iu, null, {path:'/',domain: window.is_session,secure: false});
CookieList("suddpr_mor"+iu,jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.startDate) + ' - ' + jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.endDate),'add');
	
	
	$('#date_hidden_start').val(jQuery.datepicker.formatDate('yy-mm-dd',extensionRange.startDate));
	$('#date_hidden_end').val(jQuery.datepicker.formatDate('yy-mm-dd',extensionRange.endDate));
	
	$('[list_number=t2]').empty().append(jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.startDate) + ' - ' + jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.endDate));		
		$.cookie("suddpr"+iu, null, {path:'/',domain: window.is_session,secure: false});
CookieList("suddpr"+iu,$('#date_hidden_start').val()+'/'+$('#date_hidden_end').val(),'add');

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
if((isset($_COOKIE["su_2pr".$id_user]))and(is_numeric($_COOKIE["su_2pr".$id_user]))and($_COOKIE["su_2pr".$id_user]==2))
{
$date_range=explode("/",$_COOKIE["suddpr".$id_user]);
echo'var st=\''.ipost_($date_range[0],'').'\';
var st1=\''.ipost_($date_range[1],'').'\';
var st2=\''.ipost_($_COOKIE["suddpr_mor".$id_user],'').'\';';
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
if(!isset($_GET["tabs"])) {
    $st_fil = '';
    if (((isset($_COOKIE["su_7pr" . $id_user])) and ($_COOKIE["su_7pr" . $id_user] == '2')) or (!isset($_COOKIE["su_7pr" . $id_user]))) {
        if (!isset($_GET["id"])) {
            $st_fil = 'active-filter-s';
        }
    }

    echo '<div class="filter-wois ' . $st_fil . '"><h1 class="h1-filter js-h1-filter-preorders">Быстрые фильтры';

    if ($st_fil != '') {
        echo '<div class="choice-radio"><div class="center_vert1"><i class="active_task_cb"></i></div><input name="turs[filter]" value="2" type="hidden"></div>';
    } else {
        echo '<div class="choice-radio"><div class="center_vert1"><i></i></div><input name="turs[filter]" value="2" type="hidden"></div> ';
    }

    echo '<span class="search-count-task"></span>';


    echo '</h1>';


    $mass_ei = users_hierarchy($id_user, $link);
    array_push($mass_ei, $id_user);
    $mass_ei = array_unique($mass_ei);
    $count_filter = 1;
    if (count($mass_ei) > 1) {
        $count_filter = 2;
        //управляет другими работниками
        $result_6 = mysql_time_query($link, "select A.* from preorders_quick_filters as A WHERE A.visible=1 order by A.displayOrder");
    } else {
        //может видеть только свои
        $result_6 = mysql_time_query($link, "select A.* from preorders_quick_filters as A WHERE A.visible=1 and A.disable=0 order by A.displayOrder");
    }


//$row_1 = mysqli_fetch_assoc($result2);
    if ($result_6) {
        $i = 0;
        $end = 0;
        while ($row_6 = mysqli_fetch_assoc($result_6)) {

            if ($count_filter == 1) {

                if (($i == 0) or ($i == 2) or ($i == 4) or ($i == 6)) {
                    if ($i != 0) {
                        $end = 0;
                        echo '</div>';
                    }


                    echo '<div class="filter-block">';
                    $end = 1;
                }
            } else {
                if (($i == 0) or ($i == 3) or ($i == 6) or ($i == 9)) {
                    if ($i != 0) {
                        $end = 0;
                        echo '</div>';
                    }


                    echo '<div class="filter-block">';
                    $end = 1;
                }
            }


            $eshe_filter = '';
            /*
            if($row_6["number"]==4)
            {
                $eshe_filter=' (вылет с '.date("d.m.Y").')';
            }
     */
            if ((((isset($_COOKIE["su_7fpr" . $id_user]))) and ($_COOKIE["su_7fpr" . $id_user] == $row_6["id"])) or ((!isset($_COOKIE["su_7fpr" . $id_user])) and ($row_6["default"] == 1))) {
                echo '<div class="fi-at-pr active-fi" id="' . $row_6["id"] . '"><a href="preorders/">' . $row_6["name"] . $eshe_filter . '</a></div>';
            } else {
                echo '<div class="fi-at-pr" id="' . $row_6["id"] . '"><a href="preorders/">' . $row_6["name"] . $eshe_filter . '</a></div>';
            }
            $i++;
        }
        if ($end != 0) {
            echo '</div>';
        }
    }
    echo '</div>';
}



}
?>	 
	 
 <div class="oka_block_1">
<div class="oka1_1 new-preorders-view" style=" text-align:left;">
  <?

  if(((isset($_GET["tabs"]))and($_GET["tabs"]!=3))or(!isset($_GET["tabs"])))
  {

//сообщения после добавление редактирования чего то	
//сообщения после добавление редактирования чего то
//сообщения после добавление редактирования чего то
	
	$echo_help=0;
    if (( isset($_GET["a"]))and($_GET["a"]=='yes'))
    {
echo'<div class="help_div da_book1 js-hide-help"><div class="not_boolingh"></div><span class="h5"><span>Новое обращение добавлено в систему</span></span></div>';
		$echo_help++;
	}
    if (( isset($_GET["a"]))and($_GET["a"]=='save'))
    {
echo'<div class="help_div da_book1 js-hide-help"><div class="not_boolingh"></div><span class="h5"><span>Данные по обращению успешно изменены</span></span></div>';
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


if(isset($_GET["id"]))
{

    $sql_k='Select DISTINCT A.id from preorders as A where A.visible=1 AND A.id="'.ht($_GET["id"]).'" and A.id_company IN ('.$id_company.') ';
//echo $sql_k;
    $result_t2 = mysql_time_query($link, $sql_k);

    $sql_count = 'Select count(DISTINCT A.id) as kol from preorders as A where A.visible=1 AND A.id="'.ht($_GET["id"]).'" and A.id_company IN ('.$id_company.')';


} else {

    if ((((isset($_COOKIE["su_7pr" . $id_user])) and ($_COOKIE["su_7pr" . $id_user] == '1')))or
    (isset($_GET["tabs"])))
    {
//расширенный поиск

        $sql_su1 = '';
        $sql_su2 = '';
        $sql_su3 = '';
        $sql_su4 = '';
        $sql_su5 = '';
        $sql_su5_search = '';
        $sql_su7 = ' AND A.id_company IN (' . $id_company . ') ';

        //********************************************************************
//********************************************************************
//********************************************************************
        //тур оформлен
        //|
        //V
        $flag_vstt=0;
        if((string)$su_5=='0')
        {

            if(((!isset($_COOKIE["su_7pr" . $id_user])))or(($_COOKIE["su_7pr" . $id_user] != '1')))
            {

                $flag_vstt=1;

            } else {
                $query_user = $id_user;
            }

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
        if(( isset($_COOKIE["su_7pp".$id_user]))and($_COOKIE["su_7pp".$id_user]!=''))
        {
            $query=trimc(mb_convert_case(htmlspecialchars($_COOKIE["su_7pp".$id_user]), MB_CASE_LOWER, "UTF-8"));

            if (!is_numeric($query))
                {
                //поиск по клиенту
                mb_internal_encoding("UTF-8");
                $query = mb_substr( $query, 1);

                $sql_k='select A.id from preorders as A,k_clients as J where A.id_k_clients=J.id and A.visible=1 and A.id_type_clients=1 '.$sql_su5_search.' '.$sql_su7.' AND LOWER(J.fio) LIKE "%'.$query.'%"';

                $sql_count = 'select count(A.id) as kol from preorders as A,k_clients as J where A.id_k_clients=J.id and A.visible=1 and A.id_type_clients=1 '.$sql_su5_search.' '.$sql_su7.' AND LOWER(J.fio) LIKE "%'.$query.'%"';

            } else
            {
                 //поиск по id

                $sql_k='select A.id from preorders as A where  A.visible=1 '.$sql_su5_search.' '.$sql_su7.' and A.id="'.$query.'"';

                $sql_count = 'select count(A.id) as kol from preorders as A where  A.visible=1 '.$sql_su5_search.' '.$sql_su7.' and A.id="'.$query.'"';

            }

//echo($sql_k);

        } else{

        $sql_order = ' order by A.date_create desc';




        $sql_order = '';
        $sql_columb='';

        $sql_table='';
        $sql_table1='';   //trips_payment_term - сроки
        $sql_table2='';   //trips_fly_history  - история вылетов
        $sql_table3='';

        $sql_svyz_table='';
        $sql_svyz_table1=''; //trips_payment_term - сроки
        $sql_svyz_table2=''; //trips_fly_history  - история вылетов


        ///поиск для расширенных фильтров



//********************************************************************
//********************************************************************
//********************************************************************
/*
$os2 = array( "За все время","Сегодня","За 7 дней","В этом месяце","за 30 дней","Выбрать период");
$os_id2 = array("0","6","1","5","3","2");
*/

            if(!isset($_GET["tabs"])) {
                //дата оформления
                //|
                //V
                if ($su_2 == 0) {
                    //За все время
                    $sql_su2 = '';
                }
                if ($su_2 == 6) {
                    //Сегодня

                    $sql_su2 = 'and A.date_create LIKE "' . date("Y-m-d") . '%"';
                }
                if ($su_2 == 1) {
                    //за 7 дней
                    $date_end_start = date_step_sql('Y-m-d', '-7d') . ' 00:00:00';
                    $date_end_end = date_step_sql('Y-m-d', '+1d') . ' 00:00:00';
                    $sql_su2 = ' and A.date_create>="' . $date_end_start . '" and  A.date_create<"' . $date_end_end . '"';
                }
                if ($su_2 == 5) {
                    //В этом месяце
                    $date_end_start = date_step_sql('Y-m', '+0d') . '-01 00:00:00';
                    $date_end_end = date_step_sql('Y-m', '+1m') . '-01 00:00:00';

                    $sql_su2 = ' and A.date_create>="' . $date_end_start . '" and  A.date_create<"' . $date_end_end . '"';
                }
                if ($su_2 == 3) {
                    //за 30 дней
                    $date_end_start = date_step_sql('Y-m-d', '-30d') . ' 00:00:00';
                    $date_end_end = date_step_sql('Y-m-d', '+1d') . ' 00:00:00';
                    $sql_su2 = ' and A.date_create>="' . $date_end_start . '" and  A.date_create<"' . $date_end_end . '"';
                }
                if ($su_2 == 2) {
                    //Выбранные период пользователем
                    $date_range = explode("/", $_COOKIE["suddpr" . $id_user]);
                    $sql_su2 = ' and A.date_create>="' . ht($date_range[0]) . ' 00:00:00" and A.date_create<="' . ht($date_range[1]) . ' 23:59:59"';
                }

            } else
            {
                if ($su_2 == 0) {
                    //За все время
                    $sql_su2 = '';
                }
                if ($su_2 == 6) {
                    //Сегодня

                    $sql_su2 = 'and xx.datetimes LIKE "' . date("Y-m-d") . '%"';
                }
                if ($su_2 == 1) {
                    //за 7 дней
                    $date_end_start = date_step_sql('Y-m-d', '-7d') . ' 00:00:00';
                    $date_end_end = date_step_sql('Y-m-d', '+1d') . ' 00:00:00';
                    $sql_su2 = ' and xx.datetimes>="' . $date_end_start . '" and  xx.datetimes<"' . $date_end_end . '"';
                }
                if ($su_2 == 5) {
                    //В этом месяце
                    $date_end_start = date_step_sql('Y-m', '+0d') . '-01 00:00:00';
                    $date_end_end = date_step_sql('Y-m', '+1m') . '-01 00:00:00';

                    $sql_su2 = ' and xx.datetimes>="' . $date_end_start . '" and  xx.datetimes<"' . $date_end_end . '"';
                }
                if ($su_2 == 3) {
                    //за 30 дней
                    $date_end_start = date_step_sql('Y-m-d', '-30d') . ' 00:00:00';
                    $date_end_end = date_step_sql('Y-m-d', '+1d') . ' 00:00:00';
                    $sql_su2 = ' and xx.datetimes>="' . $date_end_start . '" and  xx.datetimes<"' . $date_end_end . '"';
                }
                if ($su_2 == 2) {
                    //Выбранные период пользователем
                    $date_range = explode("/", $_COOKIE["suddpr" . $id_user]);
                    $sql_su2 = ' and xx.datetimes>="' . ht($date_range[0]) . ' 00:00:00" and xx.datetimes<="' . ht($date_range[1]) . ' 23:59:59"';
                }
            }
        //X
        //|
        //дата оформления

//********************************************************************
//********************************************************************
//********************************************************************
            //статус
            //|
            //V
            $flag_obs=0;
            $su_3 = $su_3 ?? [];


            if(count($su_3)!=0)
            {

                    $new_act="'".implode("','",$su_3)."'";
                    $sql_su3=' AND A.status IN ('.$new_act.')';

            }
            //X
            //|
            //статус

//********************************************************************
//********************************************************************
//********************************************************************
        //Сортировка
        //|
        //V
        if($su_4 == 0) {
            //Дата создания
            $sql_order = ' order by A.date_create DESC';
        }
        /*
        if($su_4 == 1) {
            //Дата последнего изменения
            $sql_su2 = '';
            $sql_su3='';
            $sql_table2=',preorders_status_history_new as xx';
            $sql_svyz_table2=' AND xx.id_preorder=A.id ';


            $sql_columb.=',xx.datetimes';
            //$sql_su4 = ' and (SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1)>="'.date("Y-m-d").' 00:00:00" ';
             $sql_order = ' order by xx.datetimes DESC';
        }
*/
        //X
        //|
        //Сортировка

//********************************************************************
//********************************************************************
//********************************************************************
            if(isset($_GET["tabs"])) {

                $sql_su3='';
                $sql_table2=',preorders_status_history_new as xx';
                $sql_svyz_table2=' AND xx.id_preorder=A.id ';


                $sql_columb.=',xx.datetimes,xx.id as ids,A.id_type_clients,A.id_k_clients';
                //$sql_su4 = ' and (SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1)>="'.date("Y-m-d").' 00:00:00" ';
                $sql_order = ' order by xx.datetimes DESC';

            }


        $sql_table=$sql_table1.$sql_table2.$sql_table3;
        $sql_svyz_table=$sql_svyz_table1.$sql_svyz_table2;

        $sql_k = 'Select 
  
  DISTINCT A.id'.$sql_columb.'
  
  from preorders as A'.$sql_table.'
  
  where A.visible=1 '.$sql_svyz_table.' ' . $sql_su2 . ' ' . $sql_su1 . ' ' . $sql_su3 . ' ' . $sql_su4 . ' ' . $sql_su5 . ' ' . $sql_su7 . ' ' . $sql_order . ' ' . limitPage('n_st', $count_write);

//echo($sql_k);
            if(!isset($_GET["tabs"])) {
                $sql_count = 'Select 
  
  count(DISTINCT A.id) as kol' . $sql_columb . '
  
  from preorders as A' . $sql_table . '
  
  where A.visible=1 ' . $sql_svyz_table . ' ' . $sql_su2 . ' ' . $sql_su1 . ' ' . $sql_su3 . ' ' . $sql_su4 . ' ' . $sql_su5 . ' ' . $sql_su7;
            } else
            {
                $sql_count = 'Select 
  
  count(DISTINCT xx.id) as kol' . $sql_columb . '
  
  from preorders as A' . $sql_table . '
  
  where A.visible=1 ' . $sql_svyz_table . ' ' . $sql_su2 . ' ' . $sql_su1 . ' ' . $sql_su3 . ' ' . $sql_su4 . ' ' . $sql_su5 . ' ' . $sql_su7;
            }

            //echo($sql_count);

        }

        $result_t2 = mysql_time_query($link, $sql_k);




    } else {


        //быстрые фильтры
        //быстрые фильтры ищут только по своим турам
        if (((isset($_COOKIE["su_7fpr" . $id_user]))) and (is_numeric($_COOKIE["su_7fpr" . $id_user]))) {
            $result_uu = mysql_time_query($link, 'select a.number from preorders_quick_filters as a where a.id="' . ht($_COOKIE["su_7fpr" . $id_user]) . '" and a.visible=1');
        } else {
            $result_uu = mysql_time_query($link, 'select a.number from preorders_quick_filters as a where a.default=1 and a.visible=1');
        }
        $num_results_uu = $result_uu->num_rows;

        if ($num_results_uu != 0) {
            $row_uu = mysqli_fetch_assoc($result_uu);

            $sql_order = ' order by A.date_create desc ';

//пользователь по умолчанию пустой (все пользователи компании)
            $sql_user_my = ' and A.id_user="' . $id_user . '"';

            $mass_ei=users_hierarchy($id_user,$link);
            array_push($mass_ei, $id_user);
            $mass_ei= array_unique($mass_ei);


            //Все обращения свои+сотрудников подчиненных
            if ($row_uu["number"] == 11) {


                $sql_user_my = ' and A.id_user IN (' . implode(",", $mass_ei) . ')';


                $sql_k = 'Select DISTINCT A.id from preorders as A where A.visible=1 AND A.id_company IN (' . $id_company . ') ' . $sql_user . ' ' . $sql_user_my . ' ' . $sql_order . ' ' . limitPage('n_st', $count_write);

//echo($sql_k);

                $result_t2 = mysql_time_query($link, $sql_k);

                $sql_count = 'Select count(DISTINCT A.id) as kol from preorders as A where A.visible=1 AND A.id_company IN (' . $id_company . ') ' . $sql_user_my . ' ' . $sql_user;
            }

            //Назначенные на меня. Все обращения
            if ($row_uu["number"] == 10) {
                $sql_k = 'Select DISTINCT A.id from preorders as A where A.visible=1 AND A.id_company IN (' . $id_company . ') ' . $sql_user . ' ' . $sql_user_my . ' ' . $sql_order . ' ' . limitPage('n_st', $count_write);

//echo($sql_k);

                $result_t2 = mysql_time_query($link, $sql_k);

                $sql_count = 'Select count(DISTINCT A.id) as kol from preorders as A where A.visible=1 AND A.id_company IN (' . $id_company . ') ' . $sql_user_my . ' ' . $sql_user;
            }

            //Назначенные на меня. Все открытые обращения
            if ($row_uu["number"] == 1) {
                $sql_k = 'Select DISTINCT A.id from preorders as A where A.visible=1 AND not(A.status IN("5","6"))  and A.id_company IN (' . $id_company . ') ' . $sql_user . ' ' . $sql_user_my . ' ' . $sql_order . ' ' . limitPage('n_st', $count_write);

                //echo($sql_k);

                $result_t2 = mysql_time_query($link, $sql_k);

                $sql_count = 'Select count(DISTINCT A.id) as kol from preorders as A where A.visible=1 and not(A.status IN("5","6"))  AND A.id_company IN (' . $id_company . ') ' . $sql_user_my . ' ' . $sql_user;
            }

            //Все открытые обращения свои+подчиненных
            if ($row_uu["number"] == 2) {

                $sql_user_my = ' and A.id_user IN (' . implode(",", $mass_ei) . ')';

                $sql_k = 'Select DISTINCT A.id from preorders as A where A.visible=1 AND not(A.status IN("5","6"))  and A.id_company IN (' . $id_company . ') ' . $sql_user . ' ' . $sql_user_my . ' ' . $sql_order . ' ' . limitPage('n_st', $count_write);

                //echo($sql_k);

                $result_t2 = mysql_time_query($link, $sql_k);

                $sql_count = 'Select count(DISTINCT A.id) as kol from preorders as A where A.visible=1 and not(A.status IN("5","6"))  AND A.id_company IN (' . $id_company . ') ' . $sql_user_my . ' ' . $sql_user;
            }

            //Назначенные на меня. Все отказы обращения
            if ($row_uu["number"] == 4) {
                $sql_k = 'Select DISTINCT A.id from preorders as A where A.visible=1 AND A.status="6"  and A.id_company IN (' . $id_company . ') ' . $sql_user . ' ' . $sql_user_my . ' ' . $sql_order . ' ' . limitPage('n_st', $count_write);

                //echo($sql_k);

                $result_t2 = mysql_time_query($link, $sql_k);

                $sql_count = 'Select count(DISTINCT A.id) as kol from preorders as A where A.visible=1 and A.status="6"  AND A.id_company IN (' . $id_company . ') ' . $sql_user_my . ' ' . $sql_user;
            }

            //Все отказы обращения свои+подчиненных
            if ($row_uu["number"] == 5) {
                $sql_user_my = ' and A.id_user IN (' . implode(",", $mass_ei) . ')';
                $sql_k = 'Select DISTINCT A.id from preorders as A where A.visible=1 AND A.status="6"  and A.id_company IN (' . $id_company . ') ' . $sql_user . ' ' . $sql_user_my . ' ' . $sql_order . ' ' . limitPage('n_st', $count_write);

                //echo($sql_k);

                $result_t2 = mysql_time_query($link, $sql_k);

                $sql_count = 'Select count(DISTINCT A.id) as kol from preorders as A where A.visible=1 and A.status="6"  AND A.id_company IN (' . $id_company . ') ' . $sql_user_my . ' ' . $sql_user;
            }

            //Назначенные на меня. Все в архиве обращения
            if ($row_uu["number"] == 7) {
                $sql_k = 'Select DISTINCT A.id from preorders as A where A.visible=1 AND A.status="5"  and A.id_company IN (' . $id_company . ') ' . $sql_user . ' ' . $sql_user_my . ' ' . $sql_order . ' ' . limitPage('n_st', $count_write);

                //echo($sql_k);

                $result_t2 = mysql_time_query($link, $sql_k);

                $sql_count = 'Select count(DISTINCT A.id) as kol from preorders as A where A.visible=1 and A.status="5"  AND A.id_company IN (' . $id_company . ') ' . $sql_user_my . ' ' . $sql_user;
            }
//Все в архиве обращения свои+подчиненных
            if ($row_uu["number"] == 8) {
                $sql_user_my = ' and A.id_user IN (' . implode(",", $mass_ei) . ')';
                $sql_k = 'Select DISTINCT A.id from preorders as A where A.visible=1 AND A.status="5"  and A.id_company IN (' . $id_company . ') ' . $sql_user . ' ' . $sql_user_my . ' ' . $sql_order . ' ' . limitPage('n_st', $count_write);

                //echo($sql_k);

                $result_t2 = mysql_time_query($link, $sql_k);

                $sql_count = 'Select count(DISTINCT A.id) as kol from preorders as A where A.visible=1 and A.status="5"  AND A.id_company IN (' . $id_company . ') ' . $sql_user_my . ' ' . $sql_user;
            }

            //Все сегодня обращения
            if ($row_uu["number"] == 3) {
if(count($mass_ei)>1)
{
    $sql_user_my = ' and A.id_user IN (' . implode(",", $mass_ei) . ')';
}
                $sql_user = " and A.date_create LIKE '" . date("Y-m-d") . "%' ";

                $sql_k = 'Select DISTINCT A.id from preorders as A where A.visible=1 AND A.id_company IN (' . $id_company . ') ' . $sql_user . ' ' . $sql_user_my . ' ' . $sql_order . ' ' . limitPage('n_st', $count_write);

                //echo($sql_k);

                $result_t2 = mysql_time_query($link, $sql_k);

                $sql_count = 'Select count(DISTINCT A.id) as kol from preorders as A where A.visible=1  AND A.id_company IN (' . $id_company . ') ' . $sql_user_my . ' ' . $sql_user;
            }
//Все вчера обращения
            if ($row_uu["number"] == 6) {
                if(count($mass_ei)>1)
                {
                    $sql_user_my = ' and A.id_user IN (' . implode(",", $mass_ei) . ')';
                }
                $date_sql_start = date_step_sql('Y-m-d', '-1d');
                $sql_user = " and A.date_create LIKE '" . $date_sql_start . "%' ";


                $sql_k = 'Select DISTINCT A.id from preorders as A where A.visible=1 AND A.id_company IN (' . $id_company . ') ' . $sql_user . ' ' . $sql_user_my . ' ' . $sql_order . ' ' . limitPage('n_st', $count_write);

                //echo($sql_k);

                $result_t2 = mysql_time_query($link, $sql_k);

                $sql_count = 'Select count(DISTINCT A.id) as kol from preorders as A where A.visible=1  AND A.id_company IN (' . $id_company . ') ' . $sql_user_my . ' ' . $sql_user;
            }

            //Все за 30 дней обращения
            if ($row_uu["number"] == 12) {
                if(count($mass_ei)>1)
                {
                    $sql_user_my = ' and A.id_user IN (' . implode(",", $mass_ei) . ')';
                }
                $date_sql_start = date_step_sql('Y-m-d', '-30d') . ' 00:00:00';
                $date_sql_end = date_step_sql('Y-m-d', '+1') . ' 00:00:00';

                $sql_user = " and A.date_create>'" . $date_sql_start . "' and A.date_create<'" . $date_sql_end . "'";

                $sql_k = 'Select DISTINCT A.id from preorders as A where A.visible=1 AND A.id_company IN (' . $id_company . ') ' . $sql_user . ' ' . $sql_user_my . ' ' . $sql_order . ' ' . limitPage('n_st', $count_write);

                //echo($sql_k);

                $result_t2 = mysql_time_query($link, $sql_k);

                $sql_count = 'Select count(DISTINCT A.id) as kol from preorders as A where A.visible=1  AND A.id_company IN (' . $id_company . ') ' . $sql_user_my . ' ' . $sql_user;
            }


            //Все за 7 дней обращения
            if ($row_uu["number"] == 9) {
                if(count($mass_ei)>1)
                {
                    $sql_user_my = ' and A.id_user IN (' . implode(",", $mass_ei) . ')';
                }
                $date_sql_start = date_step_sql('Y-m-d', '-7d') . ' 00:00:00';
                $date_sql_end = date_step_sql('Y-m-d', '+1') . ' 00:00:00';

                $sql_user = " and A.date_create>'" . $date_sql_start . "' and A.date_create<'" . $date_sql_end . "'";

                $sql_k = 'Select DISTINCT A.id from preorders as A where A.visible=1 AND A.id_company IN (' . $id_company . ') ' . $sql_user . ' ' . $sql_user_my . ' ' . $sql_order . ' ' . limitPage('n_st', $count_write);

                //echo($sql_k);

                $result_t2 = mysql_time_query($link, $sql_k);

                $sql_count = 'Select count(DISTINCT A.id) as kol from preorders as A where A.visible=1  AND A.id_company IN (' . $id_company . ') ' . $sql_user_my . ' ' . $sql_user;
            }



        }

    }

}
		
		
	
	
//echo($sql_count);
$result_t221=mysql_time_query($link,$sql_count);	  
$row__221= mysqli_fetch_assoc($result_t221);	  

//echo' <h3 class="head_h" style=" margin-bottom:0px;">Cнабжение<i>'.$row__221["kol"].'</i><div></div></h3> ';	
	

//echo'<div class="okss"><span class="title_book yop_booking"><i>'.$row__221["kol"].'</i><span>'.PadejNumber($row__221["kol"],'найденная задача,найденных задачи,найденных задач').'</span></span></div>';			
  if(!isset($_GET["tabs"])) {
      echo '<div class="hidden-count-task">' . $row__221["kol"] . ' ' . PadejNumber($row__221["kol"], 'найденное обращение,найденных обращения,найденных обращений') . '</div>';
  } else
  {
      echo '<div class="hidden-count-task">' . $row__221["kol"] . ' ' . PadejNumber($row__221["kol"], 'найденное событие,найденных события,найденных событий') . '</div>';
  }
			

				  echo'<span class="add-next-task"></span>';
				
	  
                  $num_results_t2 = $result_t2->num_rows;
	              if($num_results_t2!=0)
	              {
	
				$com=0;
			    $cost=0;
					  $count_y=0;
$new_class_block='';


  if(!isset($_GET["tabs"])) {
      echo '<div class="ring_block ring-block-line js-global-preorders-link">';
  } else
  {
      echo '<div class="ring_block js-global-preorders-link1">';
  }
                      $date_paid='';
                      $gallery_id=1;
	       for ($ksss=0; $ksss<$num_results_t2; $ksss++) {
               if (!isset($_GET["tabs"])) {
                   $row_88 = mysqli_fetch_assoc($result_t2);

                   $result_uuy = mysql_time_query($link, 'select `id`,
  `id_company`,
  `id_user`,
  `id_type_clients`,
  `id_k_clients`,
  `id_booking_sourse`,
  `id_country`,
  `text`,
  `id_mark`,
  `date_create`,
  `visible`,
  `status`,
  `id_reasons` from preorders as A where A.id="' . ht($row_88['id']) . '"');
                   $num_results_uuy = $result_uuy->num_rows;

                   if ($num_results_uuy != 0) {
                       $row_8 = mysqli_fetch_assoc($result_uuy);
                   }
                   $new_pre = 1;
                   include $url_system . 'preorders/code/block_preorders.php';
                   echo($task_cloud_block);


               } else {


                   $row_88 = mysqli_fetch_assoc($result_t2);
                   $opl=0;
                   $result_uuy = mysql_time_query($link, 'select `id`,
  `id_user`,
  `datetimes`,
  `comment`,
       action_history from preorders_status_history_new as A where A.id="' . ht($row_88['ids']) . '"');
                   $num_results_uuy = $result_uuy->num_rows;

                   if ($num_results_uuy != 0) {
                       $row_8 = mysqli_fetch_assoc($result_uuy);
                   }
                   $ddd  = explode(" ",$row_88["datetimes"]);
                   $day_raz=dateDiff_1(date('Y-m-d'),$ddd[0]);


                   if($ddd[0]!=$date_paid)
                   {
                       $date_paid=$ddd[0]; $opl=1;
                       $mess=time_stamp_mess($row_88["datetimes"]);
                   }

                   if($opl==1)
                   {
                       echo'<div class="okss"><span class="title_book" style="padding-left: 0px;">'.$mess.'</span></div>';
                   }

                   include $url_system . 'preorders/code/block_history.php';
                   echo($task_cloud_block);



               }
           }
 echo'</div>';
							
					  
	  $count_pages=CountPage($sql_count,$link,$count_write);
	  if($count_pages>1)
	  {
          if(!isset($_GET["tabs"])) {
              displayPageLink_new('preorders/', 'preorders/.page-', "", NumberPageActive('n_st'), $count_pages, 5, 9, "journal_oo", 1);
          } else
          {
              displayPageLink_new('preorders/.tabs-1', 'preorders/.tabs-1.page-', "", NumberPageActive('n_st'), $count_pages, 5, 9, "journal_oo", 1);
          }
		  
	  }
		
					  
					  
 } else
				  {
					  
//echo'<div class="booking_div da_book1"><div class="not_booling"></div><span class="h4" style="width:calc(100% - 60px)"><span>Клиентов с такими параметрами пока нет. Измените параметры и попробуйте еще раз.</span></span></div>';

  if(!isset($_GET["tabs"])) {
      echo '<div class="message_search_b js-message-preorders-search"><span>Обращений с такими параметрами пока нет. Измените параметры и попробуйте еще раз.</span></div>';
      echo '<div class="ring_block ring-block-line js-global-preorders-link"></div>';
  } else
  {
      echo '<div class="message_search_b js-message-preorders-search1"><span>Событий с такими параметрами пока нет. Измените параметры и попробуйте еще раз.</span></div>';
      echo '<div class="ring_block ring-block-line js-global-preorders-link1"></div>';
  }
				  }
	  
?>

       
        
  <?       

  } else
  {

//вывод для руководителей

$all=0;

//собрать только тех кем руководит
$mass_ei=users_hierarchy($id_user,$link);
rm_from_array($id_user,$mass_ei);
$mass_ei= array_unique($mass_ei);
$sql_su5='';
if(count($mass_ei)!=0)
{
    $io=0;
    $sql_su5=' AND (';

    foreach ($mass_ei as $key => $value)
    {
        if($io==0) {

            $sql_su5.='((R.id_user="'.$value.'"))';

        } else
        {
            $sql_su5.='or((R.id_user="'.$value.'"))';
        }
        $io++;

    }
    $sql_su5.=' )';
}

$all=0;
$result_uu_all = mysql_time_query($link, 'select count(R.id) as cc from preorders as R where R.id_company IN ('.$id_company.') and R.visible="1" and not(R.status=5)and not(R.status=6) '.$sql_su5);
$num_results_uu_all  = $result_uu_all ->num_rows;

if ($num_results_uu_all  != 0) {
    $row_uu_all  = mysqli_fetch_assoc($result_uu_all );
    if($row_uu_all["cc"]!='')
    {
        $all=$row_uu_all["cc"];
    }
}
$active_p=0;
$result_uu_all = mysql_time_query($link, 'select count(R.id) as cc from preorders as R where R.id_company IN ('.$id_company.') and R.visible="1" and R.status=5 '.$sql_su5);
$num_results_uu_all  = $result_uu_all ->num_rows;

if ($num_results_uu_all  != 0) {
    $row_uu_all  = mysqli_fetch_assoc($result_uu_all );
    if($row_uu_all["cc"]!='')
    {
        $active_p=$row_uu_all["cc"];
    }
}

$all_2=0;
$result_uu_all = mysql_time_query($link, 'select count(R.id) as cc from preorders as R where R.id_company IN ('.$id_company.') and R.visible=1 '.$sql_su5);



$num_results_uu_all  = $result_uu_all ->num_rows;

if ($num_results_uu_all  != 0) {
    $row_uu_all  = mysqli_fetch_assoc($result_uu_all );
    if($row_uu_all["cc"]!='')
    {
        $all_2=$row_uu_all["cc"];
    }
}


$dox=($active_p*100)/$all_2;





echo'<div class="bord-promo" style="margin-top: -30px;">

<div class="block-ppi ppi-new-23">

<div class="rating-ship rating-ship-54"><span class="name-border">Открытых обращений</span><div><span class="cost_border ">'.$all.'</span></div></div>';



$rangeStart = new DateTime('Monday last week');  //начало прошлой недели
$rangeEnd = new DateTime('Sunday last week');   //конец прошлой недели

$active_p=0;
$result_uu_all = mysql_time_query($link, 'select count(R.id) as cc from preorders as R where R.id_company IN ('.$id_company.') and R.visible="1" and R.date_create>="'.$rangeStart->format('Y-m-d').' 00:00:00" and R.date_create<="'.$rangeEnd->format('Y-m-d').' 23:59:59"  '.$sql_su5);
$num_results_uu_all  = $result_uu_all ->num_rows;

if ($num_results_uu_all  != 0) {
    $row_uu_all  = mysqli_fetch_assoc($result_uu_all );
    if($row_uu_all["cc"]!='')
    {
        $active_p=$row_uu_all["cc"];
    }
}

echo'<div class="rating-ship-55">
   <div class="title-ppi" data-tooltip="новых на прошлой неделе">Новых неделя - <span class="cost_border ">'.$active_p.'</span></div>';


$rangeStart = new DateTime('Monday last week');  //начало прошлой недели
$rangeEnd = new DateTime('Sunday last week');   //конец прошлой недели

$active_p=0;
$result_uu_all = mysql_time_query($link, 'select count(R.id) as cc from preorders as R where R.id_company IN ('.$id_company.') and R.visible="1" and R.status=5  and R.date_create>="'.$rangeStart->format('Y-m-d').' 00:00:00" and R.date_create<="'.$rangeEnd->format('Y-m-d').' 23:59:59"  '.$sql_su5);
$num_results_uu_all  = $result_uu_all ->num_rows;

if ($num_results_uu_all  != 0) {
    $row_uu_all  = mysqli_fetch_assoc($result_uu_all );
    if($row_uu_all["cc"]!='')
    {
        $active_p=$row_uu_all["cc"];
    }
}


echo'<div class="title-ppi" data-tooltip="успешных на прошлой неделе">Успешных неделя - <span class="cost_border ">'.$active_p.'</span></div>';



$rangeStart = date('Y-m-01');  //начало месяца
$rangeEnd = date('Y-m-t');   //конец месяца


$active_p=0;
$result_uu_all = mysql_time_query($link, 'select count(R.id) as cc from preorders as R where R.id_company IN ('.$id_company.') and R.visible="1"  and R.date_create>="'.$rangeStart.' 00:00:00" and R.date_create<="'.$rangeEnd.' 23:59:59"  '.$sql_su5);
$num_results_uu_all  = $result_uu_all ->num_rows;

if ($num_results_uu_all  != 0) {
    $row_uu_all  = mysqli_fetch_assoc($result_uu_all );
    if($row_uu_all["cc"]!='')
    {
        $active_p=$row_uu_all["cc"];
    }
}

echo'<div class="title-ppi" data-tooltip="Всего обращений в этом месяце">Новых месяц - <span class="cost_border ">'.$active_p.'</span></div>';


echo'</div>

</div>

        <div class="block-ppi"><div class="rating-ship"><span class="name-border">Успешных обращений</span><div><span class="cost_border ">'.$active_p.'</span></div></div></div>

        <div class="block-ppi"><div class="rating-ship rating-ship-proc"><span class="name-border">Общий коэффициент</span><div><span class="cost_border leaderborder-proc">'.rtrim(rtrim(number_format(($dox), 2, '.', ' '),'0'),'.').'</span></div></div></div>

    </div>';
?>


      <div class="liderbord_2023">
          <span class="title">Обращения по менеджерам</span>
          <div class="lider-box lider_header">
              <div class="lider-date">Менеджер</div>
              <div class="lider-country">Активных/Успешных</div>
              <div class="lider-comm">Новых (30 дней)</div>
              <div class="lider-promo">Старых (>30 дней)</div>
              <div class="lider-status">Коэффициент</div>
          </div>


          <?


          $mass_ei=users_hierarchy($id_user,$link);
          rm_from_array($id_user,$mass_ei);
          $mass_ei= array_unique($mass_ei);
          $sql_su5='';
          if(count($mass_ei)!=0) {
              foreach ($mass_ei as $key => $value) {

                  $result_uu = mysql_time_query($link, 'select name_user from r_user where id="' . ht($value) . '"');
                  $num_results_uu = $result_uu->num_rows;

                  if ($num_results_uu != 0) {
                      $row_uu = mysqli_fetch_assoc($result_uu);





                      $all=0;
                      $result_uu_all = mysql_time_query($link, 'select count(R.id) as cc from preorders as R where R.id_company IN ('.$id_company.') and R.visible="1" and not(R.status=5)and not(R.status=6) and R.id_user="'.$value.'"');
                      $num_results_uu_all  = $result_uu_all ->num_rows;

                      if ($num_results_uu_all  != 0) {
                          $row_uu_all  = mysqli_fetch_assoc($result_uu_all );
                          if($row_uu_all["cc"]!='')
                          {
                              $all=$row_uu_all["cc"];
                          }
                      }
                      if($all==0)
                      {
                          $all='—';
                      }

                      //минус месяц
                      $date_end=date('Y-m-d');

                      $date_start_while=date_step_sql_more($date_end,'-1m');

                      $active_p=0;
                      $result_uu_all = mysql_time_query($link, 'select count(R.id) as cc from preorders as R where R.id_company IN ('.$id_company.') and R.visible="1" and not(R.status=5)and not(R.status=6) and R.date_create>="'.$date_start_while.' 00:00:00" and R.id_user="'.$value.'"');


                      $num_results_uu_all  = $result_uu_all ->num_rows;

                      if ($num_results_uu_all  != 0) {
                          $row_uu_all  = mysqli_fetch_assoc($result_uu_all );
                          if($row_uu_all["cc"]!='')
                          {
                              $active_p=$row_uu_all["cc"];
                          }
                      }


                      $active_p1=0;
                      $result_uu_all = mysql_time_query($link, 'select count(R.id) as cc from preorders as R where R.id_company IN ('.$id_company.') and R.visible="1" and not(R.status=5)and not(R.status=6) and R.date_create<"'.$date_start_while.' 00:00:00" and R.id_user="'.$value.'"');


                      $num_results_uu_all  = $result_uu_all ->num_rows;

                      if ($num_results_uu_all  != 0) {
                          $row_uu_all  = mysqli_fetch_assoc($result_uu_all );
                          if($row_uu_all["cc"]!='')
                          {
                              $active_p1=$row_uu_all["cc"];
                          }
                      }


                      $all_2=0;
                      $result_uu_all = mysql_time_query($link, 'select count(R.id) as cc from preorders as R where R.id_company IN ('.$id_company.') and R.visible=1 and R.id_user="'.$value.'"');



                      $num_results_uu_all  = $result_uu_all ->num_rows;

                      if ($num_results_uu_all  != 0) {
                          $row_uu_all  = mysqli_fetch_assoc($result_uu_all );
                          if($row_uu_all["cc"]!='')
                          {
                              $all_2=$row_uu_all["cc"];
                          }
                      }



                      $active_p_x=0;
                      $result_uu_all = mysql_time_query($link, 'select count(R.id) as cc from preorders as R where R.id_company IN ('.$id_company.') and R.visible="1" and R.status=5 and R.id_user="'.$value.'"');


                      $num_results_uu_all  = $result_uu_all ->num_rows;

                      if ($num_results_uu_all  != 0) {
                          $row_uu_all  = mysqli_fetch_assoc($result_uu_all );
                          if($row_uu_all["cc"]!='')
                          {
                              $active_p_x=$row_uu_all["cc"];
                          }
                      }

                      $dox=0;
                      if($all_2!=0) {

                          $dox = ($active_p_x * 100) / $all_2;

                      }





                      $class_party='';
                  if(($row_te["status"]==3))
                  {
                      $class_party='red-party';
                  }


                  $class_jj='';
                  $d_day=dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_te['date_end']);
                  if($d_day>0)
                  {
                      $class_jj='red-jj';
                  }

                  if($active_p_x==0)
                  {
                      $active_p_x='—';
                  }


                  echo'        <div class="lider-box js-promo-list lider_more '.$class_party.'" promo="'.$row_te["id"].'">
            <div class="lider-date">'.$row_uu["name_user"].'</div>
            <div class="lider-country"><span class="aff_mo">Активных/Успешных</span>'.$all.' / '.$active_p_x.'</div>
            <div class="lider-comm"><span class="aff_mo">Новых (30 дней)</span>';

                  if($active_p!=0) {
                      echo($active_p);
                  } else
                  {
                      echo('—');
                  }

                  echo'</div>
            <div class="lider-promo" style="color: #ef4084;"><span class="aff_mo">Старых (>30 дней)</span>';

                      if($active_p1!=0) {
                          echo($active_p1);
                      } else
                      {
                          echo('—');
                      }

                  echo'</div>
            <div class="lider-status"><span class="aff_mo">Коэффицент</span>';

                      echo(rtrim(rtrim(number_format(($dox), 2, '.', ' '),'0'),'.'));







                  echo'</div>';
                  echo'</div>';
              }
          }
          }
          ?>




      </div>




      <?



  }
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

         $( "#js-shots" ).lightGallery( {
             selector: '.item_photo_yes',
             download: false,
             thumbnail:false,
             showThumbByDefault:false
             //zoom: true
         } );


     $('.js-shots').each(function (i, elem) {
         $('#'+$(this).attr("id")).lightGallery({
             selector: '.item_photo_yes',
             download: false,
             thumbnail:false,
             showThumbByDefault:false
         });
     })

count_task();
classblockTrips();
 });
</script>


</body></html>