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



$active_menu='booking';  // в каком меню

		if (( isset($_COOKIE["su_2"]))and(is_numeric($_COOKIE["su_2"]))and($_COOKIE["su_2"]!=0))
		{
$count_write=1000;  //количество выводимых записей на одной странице
		} else
		{
$count_write=30;			
		}
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

if((!$role->permission('Заявки','R'))and($sign_admin!=1))
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

if($error_header!=404){ SEO('booking','','','',$link); } else { SEO('0','','','',$link); }

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
  <div class="content">

<?
                $act_='display:none;';
	            $act_1='';
	            if(cookie_work('it_','on','.',60,'0'))
	            {
		            $act_='';
					$act_1='on="show"';
	            }

	  include_once $url_system.'template/top_booking.php';


     echo'<div id="fullpage" class="margin_60" id_content="'.$id_user.'">';

	?>
 <div class="section" id="section1">
	<div class="oka_block_2019" style="min-height:auto !important;">
 
 <div class="line_mobile_blue">Заявки Туристов
 <span class="menu-09-count1">(<? echo($count_all_clients); ?>)</span> </div>

<div class="div_ook hop_ds"><div class="search_task">
	
   <? 
	 $zindex=110;
	 
       $os = array( "По дате добавления","изменению статуса");
	   $os_id = array("0","1");
	   
	 
	 
		
		$su_1=0;
		if (( isset($_COOKIE["su_1"]))and(is_numeric($_COOKIE["su_1"]))and(array_search($_COOKIE["su_1"],$os_id)!==false))
		{
			$su_1=$_COOKIE["su_1"];
		}
		
		
		   echo'<div class="left_drop menu1_prime book_menu_sel gop_io" style="z-index:'.$zindex.'"><label>Сортировка</label><div class="select eddd"><a class="slct" list_number="t1" data_src="'.$os_id[$su_1].'">'.$os[$su_1].'</a><ul class="drop">';
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
		   echo'</ul><input type="hidden" name="sort1" id="sort1" value="'.$os[$su_1].'"></div></div>'; 
	 
		
		
		
		
       $os2 = array( "любая", "неделя","выбрать","текущий месяц");
	   $os_id2 = array("0", "1","2","3");	
		
		$su_2=0;
		$date_su='';
		if (( isset($_COOKIE["su_2"]))and(is_numeric($_COOKIE["su_2"]))and(array_search($_COOKIE["su_2"],$os_id2)!==false))
		{
			$su_2=$_COOKIE["su_2"];
		}
		$val_su2=$os2[$su_2];
		
		
		if ( isset($_COOKIE["sudd"]))
		{
			$date_base__=explode(".",$_COOKIE["sudd"]);
		if (( isset($_COOKIE["su_2"]))and(is_numeric($_COOKIE["su_2"]))and($_COOKIE["su_2"]==2)and(checkdate(date_minus_null($date_base__[1]), date_minus_null($date_base__[0]),$date_base__[2])))
		{
			$date_su=$_COOKIE["sudd"];
			$val_su2=$_COOKIE["sudd"];
		}
		}
		
		
		echo'<input id="date_hidden_table" name="date" value="'.$date_su.'" type="hidden">';
		   echo'<div class="left_drop menu1_prime book_menu_sel gop_io" style="z-index:'.$zindex.'"><label>Дата добавления</label><div class="select eddd"><a class="slct" list_number="t2" data_src="'.$os_id2[$su_2].'">'.$val_su2.'</a><ul class="drop">';
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
		   echo'</ul><input type="hidden" name="sort2" id="sort2" value="'.$os2[$su_1].'"></div></div>'; 		
		

       $os3 = array( "любой", "не обработанные","Думают","Нужно позвонить","Отказались","Частичная оплата","Забронировали","Аннулировали");
	   $os_id3 = array("0","5","1","2","4","6","3","10");	
		
		$su_3=0;
		if (( isset($_COOKIE["su_3"]))and(is_numeric($_COOKIE["su_3"]))and(array_search($_COOKIE["su_3"],$os_id3)!==false))
		{
			$su_3=$_COOKIE["su_3"];
		}
		
		
		   echo'<div class="left_drop menu1_prime book_menu_sel gop_io" style="z-index:'.$zindex.'"><label>Статус</label><div class="select eddd"><a class="slct" list_number="t3" data_src="'.$os_id3[$su_3].'">'.$os3[array_search($_COOKIE["su_3"], $os_id3)].'</a><ul class="drop">';
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
		   echo'</ul><input type="hidden" name="sort3" id="sort3" value="'.$os3[$su_3].'"></div></div>'; 

   

		       $os4 = array( "Любой");
	   $os_id4 = array("0");	
		
	 $result_work_zz=mysql_time_query($link,'Select a.id,a.name from booking_sourse as a where a.visible=1 order by a.displayOrder');				 
        $num_results_work_zz = $result_work_zz->num_rows;
	    if($num_results_work_zz!=0)
	    {

		   for ($i=0; $i<$num_results_work_zz; $i++)
		   {			   			  			   
			   $row_work_zz = mysqli_fetch_assoc($result_work_zz);
			   array_push($os4, $row_work_zz["name"]);
			   array_push($os_id4, $row_work_zz["id"]);
		   }
		}
	 
	 
	 
		$su_4=0;
		if (( isset($_COOKIE["su_4"]))and(is_numeric($_COOKIE["su_4"]))and(array_search($_COOKIE["su_4"],$os_id4)!==false))
		{
			$su_4=$_COOKIE["su_4"];
		}
		
		
		   echo'<div class="left_drop menu1_prime book_menu_sel gop_io" style="z-index:'.$zindex.'"><label>Источник</label><div class="select eddd"><a class="slct" list_number="t4" data_src="'.$os_id4[$su_4].'">'.$os4[array_search($_COOKIE["su_4"], $os_id4)].'</a><ul class="drop">';
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
		   echo'</ul><input type="hidden" name="sort4" id="sort4" value="'.$os4[$su_4].'"></div></div>'; 
		
		
	  $os5 = array( "Не важно","Мои клиенты");
	   $os_id5 = array("0","777");	
		
	 $result_work_zz=mysql_time_query($link,'Select a.id,a.name_small from r_user as a where a.id_role=2 and a.enabled=1 and not(a.id="'.$id_user.'") order by a.name_small');				 
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
	 
	 
	 
		$su_5=0;
		if (( isset($_COOKIE["su_5"]))and(is_numeric($_COOKIE["su_5"]))and(array_search($_COOKIE["su_5"],$os_id5)!==false))
		{
			$su_5=$_COOKIE["su_5"];
			//echo($su_5);
		}
		
		
		   echo'<div class="left_drop menu1_prime book_menu_sel gop_io" style="z-index:'.$zindex.'"><label>менеджер</label><div class="select eddd"><a class="slct" list_number="t5" data_src="'.$os_id5[array_search($_COOKIE["su_5"], $os_id5)].'">'.$os5[array_search($_COOKIE["su_5"], $os_id5)].'</a><ul class="drop">';
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
		   echo'</ul><input type="hidden" name="sort5" id="sort5" value="'.$os5[$su_5].'"></div></div>'; 
			 
		
	 $os6 = array( "Полный","Краткий");
	   $os_id6 = array("0","1");	
		
		$su_6=0;
		if (( isset($_COOKIE["su_6"]))and(is_numeric($_COOKIE["su_6"]))and(array_search($_COOKIE["su_6"],$os_id3)!==false))
		{
			$su_6=$_COOKIE["su_6"];
		}
		
		
		   echo'<div class="left_drop menu1_prime book_menu_sel gop_io" style="z-index:'.$zindex.'"><label>Вид вывода</label><div class="select eddd"><a class="slct" list_number="t6" data_src="'.$os_id6[$su_6].'">'.$os6[array_search($_COOKIE["su_6"], $os_id6)].'</a><ul class="drop">';
	 $zindex--;
		   for ($i=0; $i<count($os6); $i++)
             {   
			   if($su_6==$os_id6[$i])
			   {
				   echo'<li class="sel_active"><a href="javascript:void(0);"  rel="'.$os_id6[$i].'">'.$os6[$i].'</a></li>';
			   } else
			   {
				  echo'<li><a href="javascript:void(0);"  rel="'.$os_id6[$i].'">'.$os6[$i].'</a></li>'; 
			   }
			 
			 }
		   echo'</ul><input type="hidden" name="sort6" id="sort6" value="'.$os6[$su_6].'"></div></div>'; 

	 
		
		 echo'<div class="inline_reload js-reload-top"><a href="booking/" class="show_reload">Применить</a></div>';  
		?>
		<div id="date_table" class="table_suply_x"></div>
		
<div class="pad10" style="padding: 0;"><span class="bookingBox"></span></div>		
<script type="text/javascript" src="Js/jquery-ui-1.9.2.custom.min.js"></script>
	<script type="text/javascript" src="Js/jquery.datepicker.extension.range.min.js"></script>
<script type="text/javascript">
var disabledDays = [];
 $(document).ready(function(){
	
            $("#date_table").datepicker({ 
altField:'#date_hidden_table',
onClose : function(dateText, inst){
        //alert(dateText); // Âûáðàííàÿ äàòà 
		
    },
altFormat:'dd.mm.yy',
defaultDate:null,
beforeShowDay: disableAllTheseDays,
dateFormat: "d MM yy"+' г.', 
firstDay: 1,	
autoclose: true,
minDate: "-1Y", maxDate: "+1Y",
beforeShow:function(textbox, instance){
	//alert('before');
	setTimeout(function () {
            instance.dpDiv.css({
                position: 'absolute',
				top: 65,
                left: 0
            });
        }, 10);
	
    $('.bookingBox').append($('#ui-datepicker-div'));
    $('#ui-datepicker-div').hide();
} }).hide().on('change', function(){
        $('#date_table').hide();
		$('[list_number=t2]').empty().append($('#date_hidden_table').val());		
		$.cookie("sudd", null, {path:'/',domain: window.is_session,secure: false}); 	
CookieList("sudd",$('#date_hidden_table').val(),'add');		
		$('.show_sort_supply').removeClass('active_supply');
$('.show_sort_supply').addClass('active_supply');		
    });
	 		
 });
	 
	 
function resizeDatepicker() {
    setTimeout(function() { $('.bookingBox > .ui-datepicker').width('100%'); }, 10);
}	 

function jopacalendar(queryDate,queryDate1,date_all) 
	{
	
if(date_all!='')
	{
var dateParts = queryDate.match(/(\d+)/g), realDate = new Date(dateParts[0], dateParts[1] -1, dateParts[2]); 
var dateParts1 = queryDate1.match(/(\d+)/g), realDate1 = new Date(dateParts1[0], dateParts1[1] -1, dateParts1[2]); 	 	 
	}
	}
	
	
	
 </script>			
	
</div></div></div>		
	 
	 
 <div class="oka_block_1">
<div class="oka1_1" style="padding-top: 30px;">
  <?


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
	  $sql_su1=' order by b.date_create desc';
	  $sql_su1_=' order by a.date_create desc';
 		if (( isset($_COOKIE["su_1"]))and(is_numeric($_COOKIE["su_1"]))and(array_search($_COOKIE["su_1"],$os_id)!==false))
		{
			if($_COOKIE["su_1"]==1)
			{
				$sql_su1=' order by date_create desc';
				$sql_su1_=' order by date_create desc';
			}
		}

	  
	  $sql_su2='';
	  $sql_su2_='';
 		if (( isset($_COOKIE["su_2"]))and(is_numeric($_COOKIE["su_2"]))and(array_search($_COOKIE["su_2"],$os_id2)!==false)and($_COOKIE["su_2"]!=0))
		{
			$date_base__=explode(".",$_COOKIE["sudd"]);
			if( isset($_COOKIE["sudd"]))
			{
				//выбрал конкретную дату
				if (( isset($_COOKIE["su_2"]))and(is_numeric($_COOKIE["su_2"]))and($_COOKIE["su_2"]==2)and(checkdate(date_minus_null($date_base__[1]), date_minus_null($date_base__[0]),$date_base__[2])))
				{
					/*
				  $sql_su2=' and b.date_create="'.$date_base__[2].'-'.$date_base__[1].'-'.$date_base__[0].'"';
				  $sql_su2_=' and a.date_create="'.$date_base__[2].'-'.$date_base__[1].'-'.$date_base__[0].'"';
*/
				  $sql_su2=' and b.date_create between "'.$date_base__[2].'-'.$date_base__[1].'-'.$date_base__[0].' 00:00:00" and "'.$date_base__[2].'-'.$date_base__[1].'-'.$date_base__[0].' 23:59:59"';
				 
				  $sql_su2_=' and a.date_create between "'.$date_base__[2].'-'.$date_base__[1].'-'.$date_base__[0].' 00:00:00" and "'.$date_base__[2].'-'.$date_base__[1].'-'.$date_base__[0].' 23:59:59"';					
		
					
					
				  if($_COOKIE["su_1"]==1)
			      {
					  
				  $sql_su2=' and c.datetime between "'.$date_base__[2].'-'.$date_base__[1].'-'.$date_base__[0].' 00:00:00" and "'.$date_base__[2].'-'.$date_base__[1].'-'.$date_base__[0].' 23:59:59"';
				 
				  $sql_su2_=' and d.datetime between "'.$date_base__[2].'-'.$date_base__[1].'-'.$date_base__[0].' 00:00:00" and "'.$date_base__[2].'-'.$date_base__[1].'-'.$date_base__[0].' 23:59:59"';		  
					  
					  
				  }
				}
			}
			if($_COOKIE["su_2"]==1)
			{
				//сегодня дата
				
				//дата через 7 дней
				
				$sql_su2=' and b.date_create between "'.
					date("Y", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-7), date("Y"))).'-'.
					date("m", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-7), date("Y"))).'-'.
					date("d", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-7), date("Y"))).' '. 
					date("H", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-7), date("Y"))).':'.
					date("i", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-7), date("Y"))).':'.
					date("s", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-7), date("Y"))).'" and "'.
					date("Y").'-'.
					date("m").'-'.
					date("d").' '. 
					date("H").':'.
					date("i").':'.
					date("s").'" ';
				
				//echo($sql_su2);
				
				
				$sql_su2_=' and a.date_create between "'.
					date("Y", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-7), date("Y"))).'-'.
					date("m", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-7), date("Y"))).'-'.
					date("d", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-7), date("Y"))).' '. 
					date("H", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-7), date("Y"))).':'.
					date("i", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-7), date("Y"))).':'.
					date("s", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-7), date("Y"))).'" and "'.
					date("Y").'-'.
					date("m").'-'.
					date("d").' '. 
					date("H").':'.
					date("i").':'.
					date("s").'" ';
				
				if($_COOKIE["su_1"]==1)
			    {
	
							$sql_su2=' and c.datetime between "'.
					date("Y", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-7), date("Y"))).'-'.
					date("m", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-7), date("Y"))).'-'.
					date("d", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-7), date("Y"))).' '. 
					date("H", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-7), date("Y"))).':'.
					date("i", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-7), date("Y"))).':'.
					date("s", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-7), date("Y"))).'" and "'.
					date("Y").'-'.
					date("m").'-'.
					date("d").' '. 
					date("H").':'.
					date("i").':'.
					date("s").'" ';
				
				//echo($sql_su2);
				
				
				$sql_su2_=' and d.datetime between "'.
					date("Y", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-7), date("Y"))).'-'.
					date("m", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-7), date("Y"))).'-'.
					date("d", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-7), date("Y"))).' '. 
					date("H", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-7), date("Y"))).':'.
					date("i", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-7), date("Y"))).':'.
					date("s", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-7), date("Y"))).'" and "'.
					date("Y").'-'.
					date("m").'-'.
					date("d").' '. 
					date("H").':'.
					date("i").':'.
					date("s").'" ';	
				
			    }
				
				
			//WHERE ("'.date("Y").'-'.date("m").'-'.date("d").'" between sk.start_date and sk.end_date)
			}
			
			if($_COOKIE["su_2"]==3)
			{
				//текущий месяц
				
				//дата через 7 дней
				
				$sql_su2=' and b.date_create between "'.
					date("Y", mktime(date("G"), date("i"), date("s"), date("n"),1, date("Y"))).'-'.
					date("m", mktime(date("G"), date("i"), date("s"), date("n"),1, date("Y"))).'-'.
					date("d", mktime(date("G"), date("i"), date("s"), date("n"),1, date("Y"))).' '. 
					date("H", mktime(date("G"), date("i"), date("s"), date("n"),1, date("Y"))).':'.
					date("i", mktime(date("G"), date("i"), date("s"), date("n"),1, date("Y"))).':'.
					date("s", mktime(date("G"), date("i"), date("s"), date("n"),1, date("Y"))).'" and "'.
					date("Y").'-'.
					date("m").'-'.
					date("d").' '. 
					date("H").':'.
					date("i").':'.
					date("s").'" ';
				
				//echo($sql_su2);
				
				
				$sql_su2_=' and a.date_create between "'.
					date("Y", mktime(date("G"), date("i"), date("s"), date("n"),1, date("Y"))).'-'.
					date("m", mktime(date("G"), date("i"), date("s"), date("n"),1, date("Y"))).'-'.
					date("d", mktime(date("G"), date("i"), date("s"), date("n"),1, date("Y"))).' '. 
					date("H", mktime(date("G"), date("i"), date("s"), date("n"),1, date("Y"))).':'.
					date("i", mktime(date("G"), date("i"), date("s"), date("n"),1, date("Y"))).':'.
					date("s", mktime(date("G"), date("i"), date("s"), date("n"),1, date("Y"))).'" and "'.
					date("Y").'-'.
					date("m").'-'.
					date("d").' '. 
					date("H").':'.
					date("i").':'.
					date("s").'" ';
				
				if($_COOKIE["su_1"]==1)
			    {
	
				$sql_su2=' and c.datetime between "'.
					date("Y", mktime(date("G"), date("i"), date("s"), date("n"),1, date("Y"))).'-'.
					date("m", mktime(date("G"), date("i"), date("s"), date("n"),1, date("Y"))).'-'.
					date("d", mktime(date("G"), date("i"), date("s"), date("n"),1, date("Y"))).' '. 
					date("H", mktime(date("G"), date("i"), date("s"), date("n"),1, date("Y"))).':'.
					date("i", mktime(date("G"), date("i"), date("s"), date("n"),1, date("Y"))).':'.
					date("s", mktime(date("G"), date("i"), date("s"), date("n"),1, date("Y"))).'" and "'.
					date("Y").'-'.
					date("m").'-'.
					date("d").' '. 
					date("H").':'.
					date("i").':'.
					date("s").'" ';
				
				//echo($sql_su2);
				
				
				$sql_su2_=' and d.datetime between "'.
					date("Y", mktime(date("G"), date("i"), date("s"), date("n"),1, date("Y"))).'-'.
					date("m", mktime(date("G"), date("i"), date("s"), date("n"),1, date("Y"))).'-'.
					date("d", mktime(date("G"), date("i"), date("s"), date("n"),1, date("Y"))).' '. 
					date("H", mktime(date("G"), date("i"), date("s"), date("n"),1, date("Y"))).':'.
					date("i", mktime(date("G"), date("i"), date("s"), date("n"),1, date("Y"))).':'.
					date("s", mktime(date("G"), date("i"), date("s"), date("n"),1, date("Y"))).'" and "'.
					date("Y").'-'.
					date("m").'-'.
					date("d").' '. 
					date("H").':'.
					date("i").':'.
					date("s").'" ';
				
			    }
				
				
			//WHERE ("'.date("Y").'-'.date("m").'-'.date("d").'" between sk.start_date and sk.end_date)
			}
		}		  
	  //echo("!".$sql_su2);
	  
	  $sql_su3='';
	  $sql_su3_='';
 		if (( isset($_COOKIE["su_3"]))and(is_numeric($_COOKIE["su_3"]))and(array_search($_COOKIE["su_3"],$os_id3)!==false)and($_COOKIE["su_3"]!=0))
		{
				$sql_su3=' and b.status='.htmlspecialchars(trim($_COOKIE["su_3"]));
				$sql_su3_=' and a.status='.htmlspecialchars(trim($_COOKIE["su_3"]));
		}	  


	  $sql_su4='';
	  $sql_su4_='';
 		if (( isset($_COOKIE["su_4"]))and(is_numeric($_COOKIE["su_4"]))and(array_search($_COOKIE["su_4"],$os_id4)!==false)and($_COOKIE["su_4"]!=0))
		{
				$sql_su4=' and ((LOWER(b.id_booking_sourse) LIKE "'.htmlspecialchars(trim($_COOKIE["su_4"])).',%")or(LOWER(b.id_booking_sourse) LIKE "%,'.htmlspecialchars(trim($_COOKIE["su_4"])).'")or(LOWER(b.id_booking_sourse) LIKE "%,'.htmlspecialchars(trim($_COOKIE["su_4"])).',%")or(b.id_booking_sourse="'.htmlspecialchars(trim($_COOKIE["su_4"])).'"))';

				$sql_su4_=' and ((LOWER(a.id_booking_sourse) LIKE "'.htmlspecialchars(trim($_COOKIE["su_4"])).',%")or(LOWER(a.id_booking_sourse) LIKE "%,'.htmlspecialchars(trim($_COOKIE["su_4"])).'")or(LOWER(a.id_booking_sourse) LIKE "%,'.htmlspecialchars(trim($_COOKIE["su_4"])).',%")or(a.id_booking_sourse="'.htmlspecialchars(trim($_COOKIE["su_4"])).'"))';			
		}	
	
	
		  $sql_su5='';
	  $sql_su5_='';
 		if (( isset($_COOKIE["su_5"]))and(is_numeric($_COOKIE["su_5"]))and(array_search($_COOKIE["su_5"],$os_id5)!==false)and($_COOKIE["su_5"]!=0))
		{
				if($_COOKIE["su_5"]=='777')
				{
				   $sql_su5=' and b.id_user='.$id_user;
				   $sql_su5_=' and a.id_user='.$id_user;
				} else
				{

				   $sql_su5=' and b.id_user='.htmlspecialchars(trim($_COOKIE["su_5"]));
				   $sql_su5_=' and a.id_user='.htmlspecialchars(trim($_COOKIE["su_5"]));	
				}
		}	
	
	
	  
			if($_COOKIE["su_1"]==1)
			{	  
  $result_t2=mysql_time_query($link,'Select 
  
  DISTINCT b.*,g.name,(select t.datetime from booking_status_history as t where t.id_booking=b.id order by t.datetime desc limit 1) as date_create
  
  from booking as b, booking_status_history as c, booking_status as g
  
  where b.visible=1 and g.result_number=b.status and g.id_system=1 and b.id=c.id_booking and b.id_object in('.implode(',',$hie->obj).') '.$sql_su2.' '.$sql_su3.' '.$sql_su4.' '.$sql_su5.' '.$sql_su1.' '.limitPage('n_st',$count_write));
				
				
 
  $sql_count='Select 
count(DISTINCT a.id) as kol
from booking as a, booking_status_history as d
where a.visible=1 and a.id=d.id_booking and a.id_object in('.implode(',',$hie->obj).') '.$sql_su2_.' '.$sql_su3_.' '.$sql_su4_.' '.$sql_su5_;
				
				
			} else
			{
  $result_t2=mysql_time_query($link,'Select 
  
  DISTINCT b.*,g.name
  
  from booking as b, booking_status as g
  
  where b.visible=1 and g.result_number=b.status and g.id_system=1 and b.id_object in('.implode(',',$hie->obj).') '.$sql_su2.' '.$sql_su3.' '.$sql_su4.' '.$sql_su5.' '.$sql_su1.' '.limitPage('n_st',$count_write));
	  
		
				
	  
  $sql_count='Select 
  
  count(DISTINCT a.id) as kol
  
  from booking as a
  
  where a.visible=1 and a.id_object in('.implode(',',$hie->obj).') '.$sql_su2_.' '.$sql_su3_.' '.$sql_su4_.' '.$sql_su5_;
			}

$result_t221=mysql_time_query($link,$sql_count);	  
$row__221= mysqli_fetch_assoc($result_t221);	  

//echo' <h3 class="head_h" style=" margin-bottom:0px;">Cнабжение<i>'.$row__221["kol"].'</i><div></div></h3> ';	
	

echo'<div class="okss"><span class="title_book yop_booking"><i>'.$row__221["kol"].'</i><span>'.PadejNumber($row__221["kol"],'найденная заявка,найденные заявки,найденных заявок').'</span></span></div>';
	
	  
                  $num_results_t2 = $result_t2->num_rows;
	              if($num_results_t2!=0)
	              {
	
				$com=0;
			    $cost=0;
				$count_y=0;
				$large_booking=0;  // по умолчанию полный вывод
				if((isset($_COOKIE["su_6"]))and($_COOKIE["su_6"]==1))
				{
					$large_booking=1;  //краткий
				}
					  
              while($row_8 = mysqli_fetch_assoc($result_t2))
              {				  
				 include $url_system.'booking/code/booking_block.php'; 				  
			  }

 
					  
		if (( isset($_COOKIE["su_2"]))and(is_numeric($_COOKIE["su_2"]))and($_COOKIE["su_2"]!=0)and(($sign_admin==1)or($pok_com==1)))
		{	

if($count_y!=0)
{
	$proc_realiz=round($cost/$count_y,1); 			
} else
{
	$proc_realiz=0;
}
	/*		
echo'<div class="booking_div da_book1"><div class="not_booling "></div><span class="h4"><span>Итого комиссия за выбранный период</span></span><div class="yop_commi" data-tooltip="Комиссия"><div><span>+ '.rtrim(rtrim(number_format($com, 2, '.', ' '),'0'),'.').' руб.</span><i>~'.$proc_realiz.'%</i></div></div></div>';
	*/		
echo'<div class="new-itog-plus">
	<div class="not_booling "></div>
	<div class="text-itog">Итого комиссия за выбранный период</div>
	<div class="yop_commi" data-tooltip="Комиссия"><div><span>+ '.rtrim(rtrim(number_format($com, 2, '.', ' '),'0'),'.').' руб.</span><i>~'.$proc_realiz.'%</i></div></div>
	</div>';		
			
			
		} else
		{
					  
	  $count_pages=CountPage($sql_count,$link,$count_write);
	  if($count_pages>1)
	  {
			  displayPageLink_new('booking/','booking/.page-',"", NumberPageActive('n_st'),$count_pages ,5,9,"journal_oo",1); 
	  }
		}
					  
					  
 } else
				  {
					  
//echo'<div class="booking_div da_book1"><div class="not_booling"></div><span class="h4" style="width:calc(100% - 60px)"><span>Заявок с такими параметрами пока нет. Измените параметры и попробуйте еще раз.</span></span></div>';
echo'<div class="message_search_b"><span>Заявок с такими параметрами пока нет. Измените параметры и попробуйте еще раз.</span></div>';	  					  
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
</div><script src="Js/rem.js" type="text/javascript"></script>

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