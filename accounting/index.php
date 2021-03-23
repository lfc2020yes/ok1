<?php
session_start();

//бухлатерия
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



$active_menu='accounting';  // в каком меню


$count_write=150;
		
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


if((!$role->permission('Бухгалтерия','R'))and($sign_admin!=1))
{
  header404(3,$echo_r);
}

if(isset($_GET["id"])) {
//если есть id то смотрим может ли он смотеть этот тур
    $result_t = mysql_time_query($link, 'select A.id from trips as A where A.id="' . ht($_GET['id']) . '" and A.visible=1');
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

if($error_header!=404){ SEO('accounting','','','',$link); } else { SEO('0','','','',$link); }

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

	  include_once $url_system.'template/top_accounting.php';


     echo'<div id="fullpage" class="margin_60" id_content="'.$id_user.'">';

	?>
 <div class="section" id="section1">
	 

	<div class="oka_block_2019" style="min-height:auto !important;">



        <div class="line_mobile_blue">Бухгалтерия (Сводная таблица туров)</div>




<div class="div_ook hop_ds">
	
<?

					   $st_fil1='js-plus-filter active-filter-s';

	
	
	echo'<div class="search_task '.$st_fil1.'">';

     
	
echo'<h1 class="h1-filter js-h1-filter-doc ">Расширенные фильтры';
	 

	 echo'<div class="choice-radio"><div class="center_vert1"><i class="active_task_cb"></i></div><input name="task[filter]" value="1" type="hidden"></div>'; 

	 echo'<span class="search-count-task"></span>';
echo'</h1>';	
	
	
	
 $zindex=110;

$os2 = array( "Текущий месяц","Прошлый месяц","За ".month_rus1(date_step_sql('m', '-2m')),"За ".month_rus1(date_step_sql('m', '-3m')),"Текущий год","Выбрать период");
$os_id2 = array("0","1","3","4","5","2");

/*
$os2 = array( "За все время","Сегодня","За 7 дней","В этом месяце","за 30 дней","Выбрать период");
	   $os_id2 = array("0","6","1","5","3","2");
*/
		$su_2=0;
		$date_su='';
		if (( isset($_COOKIE["su_2bc".$id_user]))and(is_numeric($_COOKIE["su_2bc".$id_user]))and(array_search($_COOKIE["su_2bc".$id_user],$os_id2)!==false))
		{
			$su_2=$_COOKIE["su_2bc".$id_user];
		}
		$val_su2=$os2[array_search($su_2, $os_id2)];
		
		
		if ( isset($_COOKIE["suddbc".$id_user]))
		{
			//$date_base__=explode(".",$_COOKIE["sudds"]);
		if (( isset($_COOKIE["su_2bc".$id_user]))and(is_numeric($_COOKIE["su_2bc".$id_user]))and($_COOKIE["su_2bc".$id_user]==2))
		{
			$date_su=$_COOKIE["suddbc_mor".$id_user];
			$val_su2=$_COOKIE["suddbc_mor".$id_user];
		}
		}
		$class_js_readonly ??= '';
		$class_js_search ??= '';
		
	    $_COOKIE["su_2bc".$id_user] ??= '';
	$_COOKIE["su_1cc".$id_user] ??= '';
	//$_COOKIE["su_3pr".$id_user] ??= '';
	$_COOKIE["su_4cc".$id_user] ??= '';
	$_COOKIE["su_5bc".$id_user] ??= '';


$class_js_search='';
$class_js_readonly='';


	
		echo'<input id="date_hidden_table" '.$class_js_readonly.' name="date" value="'.$date_su.'" type="hidden"><input id="date_hidden_start" name="start_date" type="hidden"><input id="date_hidden_end" name="end_date" type="hidden">';


    $name_bat='Период';



		   echo'<div class="left_drop menu1_prime book_menu_sel gop_io js--sort js-call-no-v '.$class_js_search.'" style="z-index:'.$zindex.'"><label>'.$name_bat.'</label><div class="select eddd"><a class="slct " list_number="t2" data_src="'.$os_id2[array_search($_COOKIE["su_2bc".$id_user], $os_id2)].'">'.$val_su2.'</a><ul class="drop">';
	
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
		   echo'</ul><input type="hidden" '.$class_js_readonly.' name="sort2bc" id="sort2bc" value="'.$os2[$su_2].'"></div></div>';

		
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
		if (( isset($_COOKIE["su_5bc".$id_user]))and(array_search($_COOKIE["su_5bc".$id_user],$os_id5)!==false))
		{
			$su_5=$_COOKIE["su_5bc".$id_user];
		}
		
		
		   echo'<div class="left_drop menu1_prime book_menu_sel js--sort gop_io '.$class_js_search.'" style="z-index:'.$zindex.'"><label>Получен/Оплачен</label><div class="select eddd"><a class="slct" list_number="t6" data_src="'.$os_id5[array_search($_COOKIE["su_5bc".$id_user], $os_id5)].'">'.$os5[array_search($_COOKIE["su_5bc".$id_user], $os_id5)].'</a><ul class="drop">';
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
		   echo'</ul><input type="hidden" '.$class_js_readonly.' name="sort5bc" id="sort5bc" value="'.$os5[$su_5].'"></div></div>';







    echo '<div class="inline_reload js-reload-top"><a href="accounting/" class="show_reload">Применить</a></div>';

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
	$.cookie("suddbc_mor"+iu, null, {path:'/',domain: window.is_session,secure: false});
CookieList("suddbc_mor"+iu,jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.startDate) + ' - ' + jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.endDate),'add');
	
	
	$('#date_hidden_start').val(jQuery.datepicker.formatDate('yy-mm-dd',extensionRange.startDate));
	$('#date_hidden_end').val(jQuery.datepicker.formatDate('yy-mm-dd',extensionRange.endDate));
	
	$('[list_number=t2]').empty().append(jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.startDate) + ' - ' + jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.endDate));		
		$.cookie("suddbc"+iu, null, {path:'/',domain: window.is_session,secure: false});
CookieList("suddbc"+iu,$('#date_hidden_start').val()+'/'+$('#date_hidden_end').val(),'add');

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
if((isset($_COOKIE["su_2bc".$id_user]))and(is_numeric($_COOKIE["su_2bc".$id_user]))and($_COOKIE["su_2bc".$id_user]==2))
{
$date_range=explode("/",$_COOKIE["suddbc".$id_user]);
echo'var st=\''.ipost_($date_range[0],'').'\';
var st1=\''.ipost_($date_range[1],'').'\';
var st2=\''.ipost_($_COOKIE["suddbc_mor".$id_user],'').'\';';
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
?>	 
	 
 <div class="oka_block_1">
<div class="oka1_1 new-preorders-view" style="">
  <?


//сообщения после добавление редактирования чего то	
//сообщения после добавление редактирования чего то
//сообщения после добавление редактирования чего то

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

    $sql_k='Select DISTINCT A.id from trips as A where A.visible=1 AND A.id="'.ht($_GET["id"]).'" and A.id_a_company="'.$id_company.'" ';
//echo $sql_k;
    $result_t2 = mysql_time_query($link, $sql_k);

    $sql_count = 'Select count(DISTINCT A.id) as kol from trips as A where A.visible=1 AND A.id="'.ht($_GET["id"]).'" and A.id_a_company="'.$id_company.'"';


} else {


//расширенный поиск

        $sql_su1 = '';
        $sql_su2 = '';
        $sql_su3 = '';
        $sql_su4 = '';
        $sql_su5 = '';
        $sql_su5_search = '';
        $sql_su7 = ' AND A.id_a_company="' . $id_company . '" ';

        //********************************************************************
//********************************************************************
//********************************************************************
        //тур оформлен
        //|
        //V
        $flag_vstt=0;
        if((string)$su_5=='0')
        {

            $query_user = $id_user;



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

        $sql_order = ' order by B.date_doc desc';




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
    //по умолчанию текущий месяц

    $date_start=date("Y-m").'-01';
    $date_end=date_step_sql('Y-m','+1m').'-01';


    //дата оформления
                //|
                //V

                if ($su_2 == 1) {
                    //прошлый месяц
                    $date_end=date("Y-m").'-01';
                    $date_start=date_step_sql('Y-m','-1m').'-01';

                }
                if ($su_2 == 3) {
                    //-1 месяц
                    $date_end=date_step_sql('Y-m','-1m').'-01';
                    $date_start=date_step_sql('Y-m','-2m').'-01';
                   }
                if ($su_2 == 4) {
                    //-2 месяц
                    $date_end=date_step_sql('Y-m','-2m').'-01';
                    $date_start=date_step_sql('Y-m','-3m').'-01';
                }
    if ($su_2 == 5) {
        //текущий год
        $date_end=date_step_sql('Y-m-d','+1d');
        $date_start=date('Y').'-01-01';
    }
    $sql_su2 = ' and B.date_doc>="' . $date_start . '" and  B.date_doc<"' . $date_end . '"';

    if ($su_2 == 2) {
        //Выбранные период пользователем
        $date_range = explode("/", $_COOKIE["suddbc" . $id_user]);
        $sql_su2 = ' and B.date_doc>="' . ht($date_range[0]) . '" and B.date_doc<="' . ht($date_range[1]) . '"';
    }
        //X
        //|
        //дата оформления

//********************************************************************
//********************************************************************
//********************************************************************


//********************************************************************
//********************************************************************
//********************************************************************


//********************************************************************
//********************************************************************
//********************************************************************


                $sql_su3='';
                $sql_table2=',trips_contract as B';
                $sql_svyz_table2=' AND B.id=A.id_contract ';


                $sql_columb.=',B.*';

                //$sql_su4 = ' and (SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1)>="'.date("Y-m-d").' 00:00:00" ';
                //$sql_order = ' order by xx.datetimes DESC';


    $sql_order = ' order by A.datecreate DESC';



    $sql_table=$sql_table1.$sql_table2.$sql_table3;
    $sql_svyz_table=$sql_svyz_table1.$sql_svyz_table2;

    $sql_k = 'Select A.*
  
  from trips as A'.$sql_table.'
  
  where A.visible=1 '.$sql_svyz_table.' ' . $sql_su2 . ' ' . $sql_su1 . ' ' . $sql_su3 . ' ' . $sql_su4 . ' ' . $sql_su5 . ' ' . $sql_su7 . ' ' . $sql_order . ' ' . limitPage('n_st', $count_write);

//echo($sql_k);

    $sql_count = 'Select 
  
  count(DISTINCT A.id) as kol'.$sql_columb.'
  
  from trips as A'.$sql_table.'
  
  where A.visible=1 '.$sql_svyz_table.' ' . $sql_su2 . ' ' . $sql_su1 . ' ' . $sql_su3 . ' ' . $sql_su4 . ' ' . $sql_su5 . ' ' . $sql_su7;


            //echo($sql_count);



        $result_t2 = mysql_time_query($link, $sql_k);






}
		
		
	
	
//echo($sql_count);
$result_t221=mysql_time_query($link,$sql_count);	  
$row__221= mysqli_fetch_assoc($result_t221);	  

//echo' <h3 class="head_h" style=" margin-bottom:0px;">Cнабжение<i>'.$row__221["kol"].'</i><div></div></h3> ';	
	

//echo'<div class="okss"><span class="title_book yop_booking"><i>'.$row__221["kol"].'</i><span>'.PadejNumber($row__221["kol"],'найденная задача,найденных задачи,найденных задач').'</span></span></div>';			

      echo '<div class="hidden-count-task">' . $row__221["kol"] . ' ' . PadejNumber($row__221["kol"], 'найденный тур,найденных тура,найденных тура') . '</div>';

			

				  echo'<span class="add-next-task"></span>';
				
	  
                  $num_results_t2 = $result_t2->num_rows;
	              if($num_results_t2!=0)
	              {
	
				$com=0;
			    $cost=0;
					  $count_y=0;
$new_class_block='';


      echo '<div class="ring_block js-global-doc-link1" style="page-break-inside: avoid">';

                      $date_paid='';
	       for ($ksss=0; $ksss<$num_results_t2; $ksss++) {

                   $row_88 = mysqli_fetch_assoc($result_t2);

                   include $url_system . 'accounting/code/block_doc.php';
                   echo($task_cloud_block);




           }
 echo'</div>';
							
					  
	  $count_pages=CountPage($sql_count,$link,$count_write);
	  if($count_pages>1)
	  {

              displayPageLink_new('accounting/', 'accounting/.page-', "", NumberPageActive('n_st'), $count_pages, 5, 9, "journal_oo", 1);

		  
	  }
		
					  
					  
 } else
				  {
					  
//echo'<div class="booking_div da_book1"><div class="not_booling"></div><span class="h4" style="width:calc(100% - 60px)"><span>Клиентов с такими параметрами пока нет. Измените параметры и попробуйте еще раз.</span></span></div>';

  if(!isset($_GET["tabs"])) {
      echo '<div class="message_search_b js-message-doc-search"><span>Туров с такими параметрами пока нет. Измените параметры и попробуйте еще раз.</span></div>';
      echo '<div class="ring_block ring-block-line js-global-preorders-link"></div>';
  } else
  {
      echo '<div class="message_search_b js-message-doc-search1"><span>Туров с такими параметрами пока нет. Измените параметры и попробуйте еще раз.</span></div>';
      echo '<div class="ring_block ring-block-line js-global-doc-link1"></div>';
  }
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