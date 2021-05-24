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



$active_menu='clients';  // в каком меню


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

//**************************************************
if (( count($_GET) != 1 )and( count($_GET) != 0 )and( count($_GET) != 2 ) )
{
   header404(2,$echo_r);		
}
if(isset($_GET["tabs"]))
{
	if(($_GET["tabs"]!=1)and($_GET["tabs"]!=2))
	{
		header404(67,$echo_r);
	}
}

if((!$role->permission('Клиенты','R'))and($sign_admin!=1))
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

if($error_header!=404){ SEO('clients','','','',$link); } else { SEO('0','','','',$link); }

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

	  include_once $url_system.'template/top_clients.php';


     echo'<div id="fullpage" class="margin_60" id_content="'.$id_user.'">';

	?>
 <div class="section" id="section1">
	 

	<div class="oka_block_2019" style="min-height:auto !important;">
 
 <div class="line_mobile_blue1">
	 
	 
	 
	 
<div class="menu_client_w_org_mobile">
   <div class="mm_w">
	   <ul class="tabs_hedi js-tabs-menuxx">
		  <?
		   
			
       $tabs_menu_x = array( "Туристы","Организации","Потенциальные туристы");
	   $tabs_menu_x_id = array("0","1","2");
	   $tabs_menu_x_link = array("",".tabs-1",".tabs-2");   
	   	
		   
	    for ($i=0; $i<count($tabs_menu_x); $i++)
             {   
			   if($i!=0)
			   {
			
			   if($_GET['tabs']==$tabs_menu_x_id[$i])
			   {
				   echo'<a href="clients/'.$tabs_menu_x_link[$i].'" class="tabsss_orgg active" id="'.$tabs_menu_x_id[$i].'">'.$tabs_menu_x[$i].'<span  class="menu-09-count">'.$count_all_bi[$i].'</span> </a>';
			   } else
			   {
				  echo'<a href="clients/'.$tabs_menu_x_link[$i].'" class="tabsss_orgg" id="'.$tabs_menu_x_id[$i].'">'.$tabs_menu_x[$i].'<span  class="menu-09-count">'.$count_all_bi[$i].'</span></a>';
			   }
				   
			   } else
			   {
			   
			   if(($_GET['tabs']==$tabs_menu_x_id[$i])or(!isset($_GET['tabs'])))
			   {
				   echo'<a href="clients/'.$tabs_menu_x_link[$i].'" class="tabsss_orgg active" id="'.$tabs_menu_x_id[$i].'">'.$tabs_menu_x[$i].'<span  class="menu-09-count">'.$count_all_bi[$i].'</span> </a>';
			   } else
			   {
				  echo'<a href="clients/'.$tabs_menu_x_link[$i].'" class="tabsss_orgg" id="'.$tabs_menu_x_id[$i].'">'.$tabs_menu_x[$i].'<span  class="menu-09-count">'.$count_all_bi[$i].'</span></a>';
			   }
				   
				   
			   }
			 
			 }
?>

	   </ul>
   </div>
</div>		 
	 		
		
		
</div>

<div class="div_ook hop_ds"><div class="search_task">

    <? 
	
	if(!isset($_GET["tabs"]))
	{
	
	
	
	   $zindex=110;

       $os = array( "По алфавиту","Новые","По вылету (Заявки)","Сейчас Отдыхают (Заявки)","Отдохнули (Заявки)","По вылету (Туры)");
	   $os_id = array("0","1","2","3","4","5");
	   
	 
	 $class_js_search='';
	 $class_js_readonly='';
	  	if(( isset($_COOKIE["su_7c".$id_user]))and($_COOKIE["su_7c".$id_user]!=''))
		{
		   $class_js_search='greei_input';
	       $class_js_readonly='readonly=""';
		}
		
		$su_1=0;
		if (( isset($_COOKIE["su_1c".$id_user]))and(is_numeric($_COOKIE["su_1c".$id_user]))and(array_search($_COOKIE["su_1c".$id_user],$os_id)!==false))
		{
			$su_1=$_COOKIE["su_1c".$id_user];
		}
		
		
		   echo'<div class="left_drop menu1_prime book_menu_sel js--sort gop_io '.$class_js_search.'" style="z-index:'.$zindex.'"><label>Сортировка</label><div class="select eddd"><a class="slct" list_number="t1" data_src="'.$os_id[array_search(($_COOKIE["su_1c".$id_user] ?? ''), $os_id)].'">'.$os[array_search(($_COOKIE["su_1c".$id_user]  ?? ''), $os_id)].'</a><ul class="drop">';
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
		   echo'</ul><input type="hidden" name="sort1c" id="sort1c" value="'.$os[$su_1].'"></div></div>'; 
	 
		
		
		
       $os2 = array( "Не важно", "сегодня","завтра","в этом месяце","в следующем месяце","выбрать");
	   $os_id2 = array("0", "1","3","4","5","2");	
		
		$su_2=0;
		$date_su='';
		if (( isset($_COOKIE["su_2c".$id_user]))and(is_numeric($_COOKIE["su_2c".$id_user]))and(array_search($_COOKIE["su_2c".$id_user],$os_id2)!==false))
		{
			$su_2=$_COOKIE["su_2c".$id_user];
		}
		$val_su2=$os2[array_search($su_2, $os_id2)];
		
		
		if ( isset($_COOKIE["suddc".$id_user]))
		{
			$date_base__=explode(".",$_COOKIE["suddc".$id_user]);
		if (( isset($_COOKIE["su_2c".$id_user]))and(is_numeric($_COOKIE["su_2c".$id_user]))and($_COOKIE["su_2c".$id_user]==2)and(checkdate(date_minus_null($date_base__[1]), date_minus_null($date_base__[0]),$date_base__[2])))
		{
			$date_su=$_COOKIE["suddc".$id_user];
			$val_su2=$_COOKIE["suddc".$id_user];
		}
		}
		
		
		echo'<input id="date_hidden_table" '.$class_js_readonly.' name="date" value="'.$date_su.'" type="hidden">';
		   echo'<div class="left_drop menu1_prime book_menu_sel js--sort gop_io '.$class_js_search.'" style="z-index:'.$zindex.'"><label>День рождения</label><div class="select eddd"><a class="slct" list_number="t2" data_src="'.$os_id2[array_search(($_COOKIE["su_2c".$id_user] ?? ''), $os_id2)].'">'.$val_su2.'</a><ul class="drop">';
	
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
		   echo'</ul><input type="hidden" '.$class_js_readonly.' name="sort2c" id="sort2c" value="'.$os2[$su_1].'"></div></div>'; 		
		

       $os3 = array( "любой", "покупал","обращался");
	   $os_id3 = array("0","5","1");	
		
		$su_3=0;
		if (( isset($_COOKIE["su_3c".$id_user]))and(is_numeric($_COOKIE["su_3c".$id_user]))and(array_search($_COOKIE["su_3c".$id_user],$os_id3)!==false))
		{
			$su_3=$_COOKIE["su_3c".$id_user];
		}
		
		
		   echo'<div class="left_drop menu1_prime book_menu_sel js--sort gop_io '.$class_js_search.'" style="z-index:'.$zindex.'"><label>Статус</label><div class="select eddd"><a class="slct" list_number="t3" data_src="'.$os_id3[array_search(($_COOKIE["su_3c".$id_user] ?? ''), $os_id3)].'">'.$os3[array_search(($_COOKIE["su_3c".$id_user] ?? ''), $os_id3)].'</a><ul class="drop">';
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
		   echo'</ul><input type="hidden" '.$class_js_readonly.' name="sort3c" id="sort3c" value="'.$su_3.'"></div></div>'; 

   

		       $os4 = array( "Не важно");
	   $os_id4 = array("0");	
		
	 $result_work_zz=mysql_time_query($link,'Select a.id,a.name from options_client as a where a.visible=1 order by a.displayOrder');				 
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
		if (( isset($_COOKIE["su_4c".$id_user]))and(is_numeric($_COOKIE["su_4c".$id_user]))and(array_search($_COOKIE["su_4c".$id_user],$os_id4)!==false))
		{
			$su_4=$_COOKIE["su_4c".$id_user];
		}
		
		
		   echo'<div class="left_drop menu1_prime book_menu_sel js--sort gop_io '.$class_js_search.'" style="z-index:'.$zindex.'"><label>Особенности</label><div class="select eddd"><a class="slct" list_number="t4" data_src="'.$os_id4[array_search(($_COOKIE["su_4c".$id_user] ?? ''), $os_id4)].'">'.$os4[array_search(($_COOKIE["su_4c".$id_user] ?? ''), $os_id4)].'</a><ul class="drop">';
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
		   echo'</ul><input type="hidden" '.$class_js_readonly.' name="sort4c" id="sort4c" value="'.$os4[$su_4].'"></div></div>'; 


		
     $os5 = array( "Не важно","Мои клиенты");
	 $os_id5 = array("0","777");	
		
	 $result_work_zz=mysql_time_query($link,'Select a.id,a.name_small from r_user as a where a.id_role=2 and a.id_company="'.$id_company.'" and not(a.id="'.$id_user.'") order by a.name_small');
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
		if (( isset($_COOKIE["su_5c".$id_user]))and(is_numeric($_COOKIE["su_5c".$id_user]))and(array_search($_COOKIE["su_5c".$id_user],$os_id5)!==false))
		{
			$su_5=$_COOKIE["su_5c".$id_user];
		}
		
		
		   echo'<div class="left_drop menu1_prime book_menu_sel js--sort gop_io '.$class_js_search.'" style="z-index:'.$zindex.'"><label>менеджер</label><div class="select eddd"><a class="slct" list_number="t5" data_src="'.$os_id5[array_search(($_COOKIE["su_5c".$id_user] ?? ''), $os_id5)].'">'.$os5[array_search(($_COOKIE["su_5c".$id_user] ?? ''), $os_id5)].'</a><ul class="drop">';
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
		   echo'</ul><input type="hidden" '.$class_js_readonly.' name="sort5c" id="sort5c" value="'.$su_5.'"></div></div>'; 
		
	
		
	
	echo'<div class="left_drop menu1_prime book_menu_sel gop_io" style="z-index:'.$zindex.'"><label>ФИО / Телефон / code</label><div class="select eddd">
		   
		   <input name="sort_stock2" id="name_stock_search" class="name_stock_search_input" autocomplete="off" value="'.ipost_(($_COOKIE["su_7c".$id_user] ?? ''),'').'" type="text">';
		   		$zindex--;

		   if (( isset($_COOKIE["su_7c".$id_user]))and($_COOKIE["su_7c".$id_user]!=''))
		   {
		   echo'<div style="display:block;" class="dell_stock_search" data-tooltip="Удалить"><span>x</span></div>';
		   } else
		   {
			 echo'<div  class="dell_stock_search" data-tooltip="Удалить"><span>x</span></div>';  
		   }

		   
		   echo'</div></div>';
/*
        echo'<div class="left_drop menu1_prime book_menu_sel gop_io" style="z-index:105">
<a href="clients/csv/csv.php" class="search-count-csv">excel</a>
        </div>';
*/

	 echo'<div class="inline_reload js-reload-top"><a href="clients/" class="show_reload">Применить</a></div>'; 
		
		//echo'<a href="clients/" class="show_sort_supply">Применить</a>';
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
			var iu=$('.content').attr('iu');	
		$('[list_number=t2]').empty().append($('#date_hidden_table').val());		
		$.cookie("suddc"+iu, null, {path:'/',domain: window.is_session,secure: false}); 	
CookieList("suddc"+iu,$('#date_hidden_table').val(),'add');		
				
				
$('.js-reload-top').removeClass('active-r');
$('.js-reload-top').addClass('active-r');	
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

	
<?
	}
	else
	{
		
		if($_GET["tabs"]==1)
		//для организаций поиск
		{
	
	   $zindex=110;

       $os = array( "По алфавиту","Новые");
	   $os_id = array("0","1");
	   
	 
	 $class_js_search='';
	 $class_js_readonly='';
	  	if(( isset($_COOKIE["su_7co".$id_user]))and($_COOKIE["su_7co".$id_user]!=''))
		{
		   $class_js_search='greei_input';
	       $class_js_readonly='readonly=""';
		}
		
		$su_1=0;
		if (( isset($_COOKIE["su_1co".$id_user]))and(is_numeric($_COOKIE["su_1co".$id_user]))and(array_search($_COOKIE["su_1co".$id_user],$os_id)!==false))
		{
			$su_1=$_COOKIE["su_1co".$id_user];
		}
		
		
		   echo'<div class="left_drop menu1_prime book_menu_sel js--sort gop_io '.$class_js_search.'" style="z-index:'.$zindex.'"><label>Сортировка</label><div class="select eddd"><a class="slct" list_number="t1" data_src="'.$os_id[array_search(($_COOKIE["su_1co".$id_user] ?? ''), $os_id)].'">'.$os[array_search(($_COOKIE["su_1co".$id_user] ?? ''), $os_id)].'</a><ul class="drop">';
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
		   echo'</ul><input type="hidden" name="sort1co" id="sort1co" value="'.$os[$su_1].'"></div></div>'; 
	 
		
		
		
       

		
     $os5 = array( "Не важно","Мои клиенты");
	 $os_id5 = array("0","777");	
		
	 $result_work_zz=mysql_time_query($link,'Select a.id,a.name_small from r_user as a where a.id_role=2 and a.id_company="'.$id_company.'" and not(a.id="'.$id_user.'") order by a.name_small');
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
		if (( isset($_COOKIE["su_5co".$id_user]))and(is_numeric($_COOKIE["su_5co".$id_user]))and(array_search($_COOKIE["su_5co".$id_user],$os_id5)!==false))
		{
			$su_5=$_COOKIE["su_5co".$id_user];
		}
		
		
		   echo'<div class="left_drop menu1_prime book_menu_sel js--sort gop_io '.$class_js_search.'" style="z-index:'.$zindex.'"><label>менеджер</label><div class="select eddd"><a class="slct" list_number="t5" data_src="'.$os_id5[array_search(($_COOKIE["su_5co".$id_user] ?? ''), $os_id5)].'">'.$os5[array_search(($_COOKIE["su_5co".$id_user] ?? ''), $os_id5)].'</a><ul class="drop">';
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
		   echo'</ul><input type="hidden" '.$class_js_readonly.' name="sort5co" id="sort5co" value="'.$su_5.'"></div></div>'; 
		
	
		
	
	echo'<div class="left_drop menu1_prime book_menu_sel gop_io" style="z-index:'.$zindex.'"><label>Поиск по названию / ИНН</label><div class="select eddd">
		   
		   <input name="sort_stock2" id="name_stock_searcho" class="name_stock_search_input" autocomplete="off" value="'.ipost_(($_COOKIE["su_7co".$id_user] ?? ''),'').'" type="text">';
		   		$zindex--;

		   if (( isset($_COOKIE["su_7co".$id_user]))and($_COOKIE["su_7co".$id_user]!=''))
		   {
		   echo'<div style="display:block;" class="dell_stock_searcho" data-tooltip="Удалить"><span>x</span></div>';
		   } else
		   {
			 echo'<div  class="dell_stock_searcho" data-tooltip="Удалить"><span>x</span></div>';  
		   }

		   
		   echo'</div></div>';
	
	 echo'<div class="inline_reload js-reload-top"><a href="clients/?tabs=1" class="show_reload">Применить</a></div>'; 
		

		
		
	
	
	} else
	{
		//линия поиска для потенциальных клиентов
				       $os4 = array( "Не важно");
	   $os_id4 = array("0");		
	
	   $zindex=110;

       $os = array( "По алфавиту","Новые");
	   $os_id = array("0","1");
	   $os3 = array( "любой", "покупал","обращался");
	   $os_id3 = array("0","5","1");
       $os2 = array( "Не важно", "сегодня","завтра","в этом месяце","в следующем месяце","выбрать");
	   $os_id2 = array("0", "1","3","4","5","2");	
			
	 $class_js_search='';
	 $class_js_readonly='';
	  	if(( isset($_COOKIE["su_7c".$id_user]))and($_COOKIE["su_7c".$id_user]!=''))
		{
		   $class_js_search='greei_input';
	       $class_js_readonly='readonly=""';
		}
		
		$su_1=0;
		if (( isset($_COOKIE["su_1c".$id_user]))and(is_numeric($_COOKIE["su_1c".$id_user]))and(array_search($_COOKIE["su_1c".$id_user],$os_id)!==false))
		{
			$su_1=$_COOKIE["su_1c".$id_user];
		}
		
		
		   echo'<div class="left_drop menu1_prime book_menu_sel js--sort gop_io '.$class_js_search.'" style="z-index:'.$zindex.'"><label>Сортировка</label><div class="select eddd"><a class="slct" list_number="t1" data_src="'.$os_id[array_search($_COOKIE["su_1c".$id_user], $os_id)].'">'.$os[array_search($_COOKIE["su_1c".$id_user], $os_id)].'</a><ul class="drop">';
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
		   echo'</ul><input type="hidden" name="sort1c" id="sort1c" value="'.$os[$su_1].'"></div></div>'; 
	 
		
		
		
       
		
     $os5 = array( "Не важно","Мои клиенты");
	 $os_id5 = array("0","777");	
		
	 $result_work_zz=mysql_time_query($link,'Select a.id,a.name_small from r_user as a where a.id_role=2 and a.id_company="'.$id_company.'" and not(a.id="'.$id_user.'") order by a.name_small');
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
		if (( isset($_COOKIE["su_5c".$id_user]))and(is_numeric($_COOKIE["su_5c".$id_user]))and(array_search($_COOKIE["su_5c".$id_user],$os_id5)!==false))
		{
			$su_5=$_COOKIE["su_5c".$id_user];
		}
		
		
		   echo'<div class="left_drop menu1_prime book_menu_sel js--sort gop_io '.$class_js_search.'" style="z-index:'.$zindex.'"><label>менеджер</label><div class="select eddd"><a class="slct" list_number="t5" data_src="'.$os_id5[array_search($_COOKIE["su_5c".$id_user], $os_id5)].'">'.$os5[array_search($_COOKIE["su_5c".$id_user], $os_id5)].'</a><ul class="drop">';
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
		   echo'</ul><input type="hidden" '.$class_js_readonly.' name="sort5c" id="sort5c" value="'.$su_5.'"></div></div>'; 
		
	
		
	
	echo'<div class="left_drop menu1_prime book_menu_sel gop_io" style="z-index:'.$zindex.'"><label>ФИО / Телефон / code</label><div class="select eddd">
		   
		   <input name="sort_stock2" id="name_stock_search" class="name_stock_search_input" autocomplete="off" value="'.ipost_(($_COOKIE["su_7c".$id_user] ?? ''),'').'" type="text">';
		   		$zindex--;

		   if (( isset($_COOKIE["su_7c".$id_user]))and($_COOKIE["su_7c".$id_user]!=''))
		   {
		   echo'<div style="display:block;" class="dell_stock_search" data-tooltip="Удалить"><span>x</span></div>';
		   } else
		   {
			 echo'<div  class="dell_stock_search" data-tooltip="Удалить"><span>x</span></div>';  
		   }

		   
		   echo'</div></div>';





	
	 echo'<div class="inline_reload js-reload-top"><a href="clients/?tabs=2" class="show_reload">Применить</a></div>'; 
		

		
		
	
	
	
	}
	}
		
?>
	
	
</div></div></div>		 
	 
 <div class="oka_block_1">
<div class="oka1_1" style="padding-top: 30px;">
  <?


//сообщения после добавление редактирования чего то	
//сообщения после добавление редактирования чего то
//сообщения после добавление редактирования чего то
	
	$echo_help=0;
    if (( isset($_GET["a"]))and($_GET["a"]=='yes'))
    {
echo'<div class="help_div da_book1 js-hide-help"><div class="not_boolingh"></div><span class="h5"><span>Новый клиент добавлен в систему</span></span></div>';
		$echo_help++;
	}
    if (( isset($_GET["a"]))and($_GET["a"]=='save'))
    {
echo'<div class="help_div da_book1 js-hide-help"><div class="not_boolingh"></div><span class="h5"><span>Данные по клиенты успешно изменены</span></span></div>';
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

	$sql_dop='';
			$sql_dop1='';
			$sql_dop2='';
	$sql_su2='';
	$sql_su3='';
$sql_su4='';
$sql_su5='';	
	$sql_su2_='';
	$sql_su3_='';
$sql_su4_='';
$sql_su5_='';		

	//сортировка сортировка сортировка
	if((!isset($_GET["tabs"]))or($_GET["tabs"]==2))
	{
			
	   if((isset($_GET["tabs"]))and($_GET["tabs"]==2))
	   {
		  $sql_p=' and b.id_a_company="'.$id_company.'" and ((b.potential=1)or(b.potential=2)) ';
	      $sql_p_=' and a.id_a_company="'.$id_company.'" and ((a.potential=1)or(a.potential=2)) ';
	   } else
	   {
		  $sql_p=' and b.id_a_company="'.$id_company.'" and b.potential=0 ';
	      $sql_p_=' and a.id_a_company="'.$id_company.'" and a.potential=0 ';		   
	   }
			
			
	  $sql_su1=' order by b.fio ';
	  $sql_su1_=' order by a.fio';
 		if (( isset($_COOKIE["su_1c".$id_user]))and(is_numeric($_COOKIE["su_1c".$id_user]))and(array_search($_COOKIE["su_1c".$id_user],$os_id)!==false))
		{
			if($_COOKIE["su_1c".$id_user]==1)
			{
				$sql_su1=' order by b.datetime desc';
				$sql_su1_=' order by a.datetime desc';
			}
			if($_COOKIE["su_1c".$id_user]==2)
			{
				$sql_su1=' order by p.datet desc';
				$sql_su1_=' order by p.datet desc';
			}
		}


	
	//день рождения день рождения
	  $sql_su2='';
	  $sql_su2_='';
 		if (( isset($_COOKIE["su_2c".$id_user]))and(is_numeric($_COOKIE["su_2c".$id_user]))and(array_search($_COOKIE["su_2c".$id_user],$os_id2)!==false)and($_COOKIE["su_2c".$id_user]!=0))
		{
		
			
			
			if( isset($_COOKIE["suddc".$id_user]))
			{
					$date_base__=explode(".",$_COOKIE["suddc".$id_user]);
				//выбрал конкретную дату
				if (( isset($_COOKIE["su_2c".$id_user]))and(is_numeric($_COOKIE["su_2c".$id_user]))and($_COOKIE["su_2c".$id_user]==2)and(checkdate(date_minus_null($date_base__[1]), date_minus_null($date_base__[0]),$date_base__[2])))
				{
					
				  $sql_su2=' and b.date_birthday LIKE "%-'.$date_base__[1].'-'.$date_base__[0].'"';
				 
				  $sql_su2_=' and a.date_birthday LIKE "%-'.$date_base__[1].'-'.$date_base__[0].'"';					
		
					
				}
			}
			if($_COOKIE["su_2c".$id_user]==1)
			{
				
				
				//сегодня
				$date_joi='-'.date("m").'-'.date("d");				
				$sql_su2=' and b.date_birthday LIKE "%'.$date_joi.'" ';
				$sql_su2_=' and a.date_birthday LIKE "%'.$date_joi.'" ';
								
			}
			
			if($_COOKIE["su_2c".$id_user]==3)
			{
				//завтра				
				$date_joi='-'.date("m", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")+1), date("Y"))).'-'.date("d", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")+1), date("Y")));
				
				$sql_su2=' and b.date_birthday LIKE "%'.$date_joi.'" ';				
				$sql_su2_=' and a.date_birthday LIKE "%'.$date_joi.'" ';
				
			}
			if($_COOKIE["su_2c".$id_user]==4)
			{
				//в этом месяце				
				$date_joi='-'.date("m").'-';
				
				$sql_su2=' and b.date_birthday LIKE "%'.$date_joi.'%" ';				
				$sql_su2_=' and a.date_birthday LIKE "%'.$date_joi.'%" ';
				$sql_su1=' order by DAY(b.date_birthday)';
				$sql_su1_=' order by DAY(a.date_birthday)';
			}
			if($_COOKIE["su_2c".$id_user]==5)
			{
				//в следующем месяце				
				$date_joi='-'.date("m", mktime(date("G"), date("i"), date("s"), (date("n")+1),date("j"), date("Y"))).'-';
				
				$sql_su2=' and b.date_birthday LIKE "%'.$date_joi.'%" ';				
				$sql_su2_=' and a.date_birthday LIKE "%'.$date_joi.'%" ';
				$sql_su1=' order by DAY(b.date_birthday)';
				$sql_su1_=' order by DAY(a.date_birthday)';
			}			
		}		  
	
	
	  //статус статус статус
	
	  $sql_su3='';
	  $sql_su3_='';
 		if (( isset($_COOKIE["su_3c".$id_user]))and(is_numeric($_COOKIE["su_3c".$id_user]))and(array_search($_COOKIE["su_3c".$id_user],$os_id3)!==false)and($_COOKIE["su_3c".$id_user]!=0))
		{
			//покупали
			    if($_COOKIE["su_3c".$id_user]==5)
				{
				$sql_su3=' and ((h.status=3)or(h.status=6)) ';
				$sql_su3_=$sql_su3;
				}
			//обращался
				if($_COOKIE["su_3c".$id_user]==1)
				{
					
				}
		}	  

      //особенности особенности особенности
	  $sql_su4='';
	  $sql_su4_='';
	
	$sql_dop='';
	$sql_dop1='';
	$sql_dop1='';
 		if (( isset($_COOKIE["su_4c".$id_user]))and(is_numeric($_COOKIE["su_4c".$id_user]))and(array_search($_COOKIE["su_4c".$id_user],$os_id4)!==false)and($_COOKIE["su_4c".$id_user]!=0))
		{
				$sql_su4=' and x.id_option="'.htmlspecialchars(trim($_COOKIE["su_4c".$id_user])).'" ';

				$sql_su4_=$sql_su4;	
			
			$sql_dop=' ,k_clients_options as x ';
			$sql_dop1=' and x.id_k_clients=b.id ';
			$sql_dop2=' and x.id_k_clients=a.id ';
		}		
	  
	
	//какому менеджеру принадлежит
	      //особенности особенности особенности
	  $sql_su5='';
	  $sql_su5_='';
	  /*if($sign_admin==1)
	  {*/
 		if (( isset($_COOKIE["su_5c".$id_user]))and(is_numeric($_COOKIE["su_5c".$id_user]))and(array_search($_COOKIE["su_5c".$id_user],$os_id5)!==false)and($_COOKIE["su_5c".$id_user]!=0))
		{
			
			if($_COOKIE["su_5c".$id_user]==777)
			{
				$sql_su5=' and b.id_user="'.$id_user.'"';

				$sql_su5_=' and a.id_user="'.$id_user.'"';				
			} else
			{
				$sql_su5=' and b.id_user="'.htmlspecialchars(trim($_COOKIE["su_5c".$id_user])).'"';

				$sql_su5_=' and a.id_user="'.htmlspecialchars(trim($_COOKIE["su_5c".$id_user])).'"';
			}
		}	
					
		//} 
	  
	
	//echo($sql_su5);
	//поиск по телефону коду или фио
	//если поиск по названию то остальные критерии поиска не работают
 		if(( isset($_COOKIE["su_7c".$id_user]))and($_COOKIE["su_7c".$id_user]!=''))
		{
			
		/*$result_t2=mysql_time_query($link,'Select 
  
  DISTINCT b.*
  
  from k_clients as b'.$sql_dop.'
  
  where b.visible=1 '.$sql_dop1.' '.$sql_su2.' '.$sql_su3.' '.$sql_su4.' '.$sql_su5.' '.$sql_su1.' '.limitPage('n_st',$count_write));
	 */ 
	$query=mb_convert_case(htmlspecialchars($_COOKIE["su_7c".$id_user]), MB_CASE_LOWER, "UTF-8");
			
$result_t2=mysql_time_query($link,'select * from(     
   (   
SELECT b.fio,b.id,b.phone,b.code,b.comment,b.id_user FROM k_clients AS b where b.visible=1 '.$sql_p.' AND LOWER(b.fio) LIKE "'.$query.'%"   
)
UNION
(

SELECT b.fio,b.id,b.phone,b.code,b.comment,b.id_user FROM k_clients AS b where b.visible=1 '.$sql_p.' AND LOWER(b.fio) LIKE "%'.$query.'%" 
AND b.code NOT IN 
(SELECT b.code FROM k_clients b WHERE b.visible=1 '.$sql_p.' AND LOWER(b.fio) LIKE "'.$query.'%")
) 
UNION
(
SELECT b.fio,b.id,b.phone,b.code,b.comment,b.id_user FROM k_clients AS b where  b.visible=1 '.$sql_p.' AND LOWER(b.phone) LIKE "%'.$query.'%"  
AND b.code NOT IN 
(SELECT b.code FROM k_clients b WHERE b.visible=1 '.$sql_p.' AND LOWER(b.fio) LIKE "'.$query.'%")
AND b.code NOT IN 
(SELECT b.code FROM k_clients b WHERE b.visible=1 '.$sql_p.' AND LOWER(b.fio) LIKE "%'.$query.'%")
) 

UNION
(
SELECT b.fio,b.id,b.phone,b.code,b.comment,b.id_user FROM k_clients AS b where b.visible=1 '.$sql_p.' AND b.code="'.$query.'"  
AND b.code NOT IN (SELECT b.code FROM k_clients b WHERE b.visible=1 '.$sql_p.' AND LOWER(b.fio) LIKE "'.$query.'%" ) AND b.code 
NOT IN (SELECT b.code FROM k_clients b WHERE b.visible=1 '.$sql_p.' AND LOWER(b.fio) LIKE "%'.$query.'%") AND b.code 
NOT IN (SELECT b.code FROM k_clients b WHERE b.visible=1 '.$sql_p.' AND LOWER(b.phone) LIKE "%'.$query.'%")
) 

) Z order by Z.fio '.limitPage('n_st',$count_write));		
	
			
	  
  $sql_count='select count(Z.id) as kol from(     
   (   
SELECT b.fio,b.id,b.phone,b.code FROM k_clients AS b where b.visible=1 '.$sql_p.' AND LOWER(b.fio) LIKE "'.$query.'%"   
)
UNION
(

SELECT b.fio,b.id,b.phone,b.code FROM k_clients AS b where b.visible=1 '.$sql_p.' AND LOWER(b.fio) LIKE "%'.$query.'%" 
AND b.code NOT IN 
(SELECT b.code FROM k_clients b WHERE b.visible=1 '.$sql_p.' AND LOWER(b.fio) LIKE "'.$query.'%")
) 
UNION
(
SELECT b.fio,b.id,b.phone,b.code FROM k_clients AS b where b.visible=1 '.$sql_p.' AND LOWER(b.phone) LIKE "%'.$query.'%"  
AND b.code NOT IN 
(SELECT b.code FROM k_clients b WHERE b.visible=1 '.$sql_p.' AND LOWER(b.fio) LIKE "'.$query.'%")
AND b.code NOT IN 
(SELECT b.code FROM k_clients b WHERE b.visible=1 '.$sql_p.' AND LOWER(b.fio) LIKE "%'.$query.'%")
) 

UNION
(
SELECT b.fio,b.id,b.phone,b.code FROM k_clients AS b where b.visible=1 '.$sql_p.' AND b.code="'.$query.'"  
AND b.code NOT IN (SELECT b.code FROM k_clients b WHERE b.visible=1 '.$sql_p.' AND LOWER(b.fio) LIKE "'.$query.'%" ) AND b.code 
NOT IN (SELECT b.code FROM k_clients b WHERE b.visible=1 '.$sql_p.' AND LOWER(b.fio) LIKE "%'.$query.'%") AND b.code 
NOT IN (SELECT b.code FROM k_clients b WHERE b.visible=1 '.$sql_p.' AND LOWER(b.phone) LIKE "%'.$query.'%")
) 

) Z';	
		
		} else
		{
	
	
	
	if ((( isset($_COOKIE["su_1c".$id_user]))and(is_numeric($_COOKIE["su_1c".$id_user]))and(array_search($_COOKIE["su_1c".$id_user],$os_id)!==false))and(($_COOKIE["su_1c".$id_user]==2)or($_COOKIE["su_1c".$id_user]==3)or($_COOKIE["su_1c".$id_user]==4)or($_COOKIE["su_1c".$id_user]==5))and(((isset($_COOKIE["su_7c".$id_user]))and($_COOKIE["su_7c".$id_user]==''))or(!isset($_COOKIE["su_7c".$id_user]))))
		{
	
		if($_COOKIE["su_1c".$id_user]==2)
		{
		
			 
	$sql_mi='
  
  select * from(     
   (   
  Select 
  
  DISTINCT h.id as id_booking,b.*,w.start_fly as d_fly1,w.start_fly,w.end_fly,h.title,w.number_op,w.date_fly,w.id_operator,w.id as id_offers
  
  from k_clients as b,booking as h,booking_offers as w'.$sql_dop.'
  
  where w.id_booking=h.id and w.start_fly>="'.date("Y-m-d").' 00:00:00" and ((h.status=3)or(h.status=6))  and h.visible=1 '.$sql_p.'  and h.id_client=b.id and b.visible=1 AND w.status=2  
  
  AND w.id NOT IN (SELECT C.id_offers FROM booking_offers_fly_history AS C WHERE C.id_offers=w.id)
  
  '.$sql_dop1.' '.$sql_su2.' '.$sql_su3.' '.$sql_su4.' '.$sql_su5.' 
  
  )
  UNION
(
  Select 
  
  DISTINCT h.id as id_booking,b.*,w.end_fly as d_fly1,w.start_fly,w.end_fly,h.title,w.number_op,w.date_fly,w.id_operator,w.id as id_offers
  
  from k_clients as b,booking as h,booking_offers as w'.$sql_dop.'
  
  where w.id_booking=h.id and w.end_fly>="'.date("Y-m-d").' 00:00:00" and ((h.status=3)or(h.status=6))   and h.visible=1 '.$sql_p.' and h.id_client=b.id and b.visible=1 AND w.status=2
  
   AND w.id NOT IN ( SELECT C.id_offers FROM booking_offers_fly_history AS C WHERE C.id_offers=w.id)
  
  '.$sql_dop1.' '.$sql_su2.' '.$sql_su3.' '.$sql_su4.' '.$sql_su5.' and w.id NOT IN (   Select 
  
  w.id
  
  from k_clients as b,booking as h,booking_offers as w'.$sql_dop.'
  
  where w.id_booking=h.id '.$sql_p.' and w.start_fly>="'.date("Y-m-d").' 00:00:00" and ((h.status=3)or(h.status=6))  and h.visible=1  AND w.status=2 and h.id_client=b.id and b.visible=1   AND w.id NOT IN ( SELECT C.id_offers FROM booking_offers_fly_history AS C WHERE C.id_offers=w.id) '.$sql_dop1.' '.$sql_su2.' '.$sql_su3.' '.$sql_su4.' '.$sql_su5.'  ) 
)
  UNION
(
  Select 
  
  DISTINCT h.id as id_booking,b.*,
    (SELECT yy.start_fly FROM booking_offers_fly_history AS yy WHERE yy.id_offers=w.id ORDER BY yy.datetime DESC LIMIT 0,1) AS d_fly1,
  (SELECT yy.start_fly FROM booking_offers_fly_history AS yy WHERE yy.id_offers=w.id ORDER BY yy.datetime DESC LIMIT 0,1) AS start_fly,
  (SELECT yy.end_fly FROM booking_offers_fly_history AS yy WHERE yy.id_offers=w.id ORDER BY yy.datetime DESC LIMIT 0,1) AS end_fly,
  
  h.title,w.number_op,w.date_fly,w.id_operator,w.id as id_offers
  
  from k_clients as b,booking as h,booking_offers as w,booking_offers_fly_history as xx'.$sql_dop.'
  
  where xx.id_offers=w.id and w.id_booking=h.id and xx.start_fly>="'.date("Y-m-d").' 00:00:00" and ((h.status=3)or(h.status=6))  and h.visible=1 '.$sql_p.'  AND w.status=2 and h.id_client=b.id and b.visible=1  
  '.$sql_dop1.' '.$sql_su2.' '.$sql_su3.' '.$sql_su4.' '.$sql_su5.' 
)

  UNION
(

 Select 
  
  DISTINCT h.id as id_booking,b.*,
    (SELECT yy.end_fly FROM booking_offers_fly_history AS yy WHERE yy.id_offers=w.id ORDER BY yy.datetime DESC LIMIT 0,1) AS d_fly1,
  (SELECT yy.start_fly FROM booking_offers_fly_history AS yy WHERE yy.id_offers=w.id ORDER BY yy.datetime DESC LIMIT 0,1) AS start_fly,
  (SELECT yy.end_fly FROM booking_offers_fly_history AS yy WHERE yy.id_offers=w.id ORDER BY yy.datetime DESC LIMIT 0,1) AS end_fly,
  
  h.title,w.number_op,w.date_fly,w.id_operator,w.id as id_offers
  
  from k_clients as b,booking as h,booking_offers as w,booking_offers_fly_history as xx'.$sql_dop.'
  
  where xx.id_offers=w.id and w.id_booking=h.id and xx.end_fly>="'.date("Y-m-d").' 00:00:00" and ((h.status=3)or(h.status=6))  and h.visible=1 '.$sql_p.'  and h.id_client=b.id and b.visible=1 AND w.status=2 and w.id NOT IN (Select 
  
  w.id
  
  from k_clients as b,booking as h,booking_offers as w,booking_offers_fly_history as xx'.$sql_dop.'
  
  where xx.id_offers=w.id and w.id_booking=h.id and xx.start_fly>="'.date("Y-m-d").' 00:00:00" and ((h.status=3)or(h.status=6))  and h.visible=1 '.$sql_p.'  AND w.status=2 and h.id_client=b.id and b.visible=1  
  '.$sql_dop1.' '.$sql_su2.' '.$sql_su3.' '.$sql_su4.' '.$sql_su5.') 
  
  
  
  '.$sql_dop1.' '.$sql_su2.' '.$sql_su3.' '.$sql_su4.' '.$sql_su5.' 

)


) Z order by Z.d_fly1 '.limitPage('n_st',$count_write);
		
	//echo($sql_mi);	
		
$result_t2=mysql_time_query($link,$sql_mi);		
		
		
	  $sql_count='select count(DISTINCT Z.id) as kol from(     
   (   
  Select 
  
  DISTINCT h.id as id_booking,b.*,w.start_fly as d_fly1,w.start_fly,w.end_fly,h.title,w.number_op,w.date_fly,w.id_operator
  
  from k_clients as b,booking as h,booking_offers as w'.$sql_dop.'
  
  where w.id_booking=h.id and w.start_fly>="'.date("Y-m-d").' 00:00:00" and ((h.status=3)or(h.status=6))  and h.visible=1 '.$sql_p.' and h.id_client=b.id and b.visible=1 AND w.status=2  
  
  AND w.id NOT IN (SELECT C.id_offers FROM booking_offers_fly_history AS C WHERE C.id_offers=w.id)
  
  '.$sql_dop1.' '.$sql_su2.' '.$sql_su3.' '.$sql_su4.' '.$sql_su5.' 
  
  )
  UNION
(
  Select 
  
  DISTINCT h.id as id_booking,b.*,w.end_fly as d_fly1,w.start_fly,w.end_fly,h.title,w.number_op,w.date_fly,w.id_operator
  
  from k_clients as b,booking as h,booking_offers as w'.$sql_dop.'
  
  where w.id_booking=h.id and w.end_fly>="'.date("Y-m-d").' 00:00:00" and ((h.status=3)or(h.status=6))  and h.visible=1  and h.id_client=b.id and b.visible=1 '.$sql_p.' AND w.status=2 
  
   AND w.id NOT IN ( SELECT C.id_offers FROM booking_offers_fly_history AS C WHERE C.id_offers=w.id)
  
  '.$sql_dop1.' '.$sql_su2.' '.$sql_su3.' '.$sql_su4.' '.$sql_su5.' and w.id NOT IN (   Select 
  
  w.id
  
  from k_clients as b,booking as h,booking_offers as w'.$sql_dop.'
  
  where w.id_booking=h.id and w.start_fly>="'.date("Y-m-d").' 00:00:00" and ((h.status=3)or(h.status=6))  and h.visible=1  AND w.status=2 and h.id_client=b.id and b.visible=1 '.$sql_p.'  AND w.id NOT IN ( SELECT C.id_offers FROM booking_offers_fly_history AS C WHERE C.id_offers=w.id) '.$sql_dop1.' '.$sql_su2.' '.$sql_su3.' '.$sql_su4.' '.$sql_su5.'  ) 
)
  UNION
(
  Select 
  
  DISTINCT h.id as id_booking,b.*,
    (SELECT yy.start_fly FROM booking_offers_fly_history AS yy WHERE yy.id_offers=w.id ORDER BY yy.datetime DESC LIMIT 0,1) AS d_fly1,
  (SELECT yy.start_fly FROM booking_offers_fly_history AS yy WHERE yy.id_offers=w.id ORDER BY yy.datetime DESC LIMIT 0,1) AS start_fly,
  (SELECT yy.end_fly FROM booking_offers_fly_history AS yy WHERE yy.id_offers=w.id ORDER BY yy.datetime DESC LIMIT 0,1) AS end_fly,
  
  h.title,w.number_op,w.date_fly,w.id_operator
  
  from k_clients as b,booking as h,booking_offers as w,booking_offers_fly_history as xx'.$sql_dop.'
  
  where xx.id_offers=w.id and w.id_booking=h.id and xx.start_fly>="'.date("Y-m-d").' 00:00:00" and ((h.status=3)or(h.status=6))  and h.visible=1 '.$sql_p.' AND w.status=2 and h.id_client=b.id and b.visible=1  
  '.$sql_dop1.' '.$sql_su2.' '.$sql_su3.' '.$sql_su4.' '.$sql_su5.' 
)

  UNION
(

 Select 
  
  DISTINCT h.id as id_booking,b.*,
    (SELECT yy.end_fly FROM booking_offers_fly_history AS yy WHERE yy.id_offers=w.id ORDER BY yy.datetime DESC LIMIT 0,1) AS d_fly1,
  (SELECT yy.start_fly FROM booking_offers_fly_history AS yy WHERE yy.id_offers=w.id ORDER BY yy.datetime DESC LIMIT 0,1) AS start_fly,
  (SELECT yy.end_fly FROM booking_offers_fly_history AS yy WHERE yy.id_offers=w.id ORDER BY yy.datetime DESC LIMIT 0,1) AS end_fly,
  
  h.title,w.number_op,w.date_fly,w.id_operator
  
  from k_clients as b,booking as h,booking_offers as w,booking_offers_fly_history as xx'.$sql_dop.'
  
  where xx.id_offers=w.id and w.id_booking=h.id and xx.end_fly>="'.date("Y-m-d").' 00:00:00" and ((h.status=3)or(h.status=6))  and h.visible=1 '.$sql_p.' AND w.status=2 and h.id_client=b.id and b.visible=1 and w.id NOT IN (Select 
  
  w.id
  
  from k_clients as b,booking as h,booking_offers as w,booking_offers_fly_history as xx'.$sql_dop.'
  
  where xx.id_offers=w.id and w.id_booking=h.id and xx.start_fly>="'.date("Y-m-d").' 00:00:00" and ((h.status=3)or(h.status=6))  and h.visible=1 '.$sql_p.' AND w.status=2 and h.id_client=b.id and b.visible=1  
  '.$sql_dop1.' '.$sql_su2.' '.$sql_su3.' '.$sql_su4.' '.$sql_su5.') 
  
  
  
  '.$sql_dop1.' '.$sql_su2.' '.$sql_su3.' '.$sql_su4.' '.$sql_su5.' 

)


) Z';  
	  
		
	    
		}
		if($_COOKIE["su_1c".$id_user]==3)
		{
			 
	$sql_mi='
  
  select * from(     
   (   
  Select 
  
  DISTINCT h.id as id_booking,b.*,w.start_fly as d_fly1,w.start_fly,w.end_fly,h.title,w.number_op,w.date_fly,w.id_operator,w.id as id_offers
  
  from k_clients as b,booking as h,booking_offers as w'.$sql_dop.'
  
  where w.id_booking=h.id and w.end_fly>"'.date("Y-m-d").' '.date("H:i:s").'" and w.start_fly<="'.date("Y-m-d").' 00:00:00" and ((h.status=3)or(h.status=6))  and h.visible=1 '.$sql_p.' and h.id_client=b.id and b.visible=1 AND w.status=2  
  
  AND w.id NOT IN (SELECT C.id_offers FROM booking_offers_fly_history AS C WHERE C.id_offers=w.id)
  
  '.$sql_dop1.' '.$sql_su2.' '.$sql_su3.' '.$sql_su4.' '.$sql_su5.' 
  
  )
  UNION
(
  Select 
  
  DISTINCT h.id as id_booking,b.*,
    (SELECT yy.start_fly FROM booking_offers_fly_history AS yy WHERE yy.id_offers=w.id ORDER BY yy.datetime DESC LIMIT 0,1) AS d_fly1,
  (SELECT yy.start_fly FROM booking_offers_fly_history AS yy WHERE yy.id_offers=w.id ORDER BY yy.datetime DESC LIMIT 0,1) AS start_fly,
  (SELECT yy.end_fly FROM booking_offers_fly_history AS yy WHERE yy.id_offers=w.id ORDER BY yy.datetime DESC LIMIT 0,1) AS end_fly,
  
  h.title,w.number_op,w.date_fly,w.id_operator,w.id as id_offers
  
  from k_clients as b,booking as h,booking_offers as w,booking_offers_fly_history as xx'.$sql_dop.'
  
  where xx.id_offers=w.id and w.id_booking=h.id and xx.end_fly>"'.date("Y-m-d").' '.date("H:i:s").'" and xx.start_fly<="'.date("Y-m-d").' 00:00:00" and ((h.status=3)or(h.status=6))  and h.visible=1  and h.id_client=b.id and b.visible=1 '.$sql_p.' AND w.status=2  
  '.$sql_dop1.' '.$sql_su2.' '.$sql_su3.' '.$sql_su4.' '.$sql_su5.' 
)

) Z order by Z.d_fly1 '.limitPage('n_st',$count_write);
		
	//echo($sql_mi);	
		
$result_t2=mysql_time_query($link,$sql_mi);		
		
		
	  $sql_count='select count(DISTINCT Z.id) as kol from(     
   (   
  Select 
  
  DISTINCT h.id as id_booking,b.*,w.start_fly as d_fly1,w.start_fly,w.end_fly,h.title,w.number_op,w.date_fly,w.id_operator
  
  from k_clients as b,booking as h,booking_offers as w'.$sql_dop.'
  
  where w.id_booking=h.id and w.end_fly>"'.date("Y-m-d").' '.date("H:i:s").'" and w.start_fly<="'.date("Y-m-d").' 00:00:00" and ((h.status=3)or(h.status=6))  and h.visible=1 '.$sql_p.' AND w.status=2 and h.id_client=b.id and b.visible=1  
  
  AND w.id NOT IN (SELECT C.id_offers FROM booking_offers_fly_history AS C WHERE C.id_offers=w.id)
  
  '.$sql_dop1.' '.$sql_su2.' '.$sql_su3.' '.$sql_su4.' '.$sql_su5.' 
  
  )
  UNION
(
  Select 
  
  DISTINCT h.id as id_booking,b.*,
    (SELECT yy.start_fly FROM booking_offers_fly_history AS yy WHERE yy.id_offers=w.id ORDER BY yy.datetime DESC LIMIT 0,1) AS d_fly1,
  (SELECT yy.start_fly FROM booking_offers_fly_history AS yy WHERE yy.id_offers=w.id ORDER BY yy.datetime DESC LIMIT 0,1) AS start_fly,
  (SELECT yy.end_fly FROM booking_offers_fly_history AS yy WHERE yy.id_offers=w.id ORDER BY yy.datetime DESC LIMIT 0,1) AS end_fly,
  
  h.title,w.number_op,w.date_fly,w.id_operator
  
  from k_clients as b,booking as h,booking_offers as w,booking_offers_fly_history as xx'.$sql_dop.'
  
  where xx.id_offers=w.id and w.id_booking=h.id and xx.end_fly>"'.date("Y-m-d").' '.date("H:i:s").'" and xx.start_fly<="'.date("Y-m-d").' 00:00:00" and ((h.status=3)or(h.status=6))  and h.visible=1  AND w.status=2 and h.id_client=b.id and b.visible=1 '.$sql_p.'  
  '.$sql_dop1.' '.$sql_su2.' '.$sql_su3.' '.$sql_su4.' '.$sql_su5.' 
)

) Z';  
	  
		
	    
		}	
		if($_COOKIE["su_1c".$id_user]==4)
		{
		//прилетели
			
	$sql_mi='
  
  select * from(     
   (   
  Select 
  
  DISTINCT h.id as id_booking,b.*,w.end_fly,h.title,w.number_op,w.date_fly,w.id_operator,w.id as id_offers,w.comment_client,h.id_user as uss,w.status as stt,h.status as stt1 
  
  from k_clients as b,booking as h,booking_offers as w'.$sql_dop.'
  
  where w.id_booking=h.id and w.end_fly<="'.date("Y-m-d").' '.date("H:i:s").'" and ((h.status=3)or(h.status=6)) and h.id_client=b.id and b.visible=1 '.$sql_p.' AND w.status=2 and h.visible=1  
  
  AND w.id NOT IN (SELECT C.id_offers FROM booking_offers_fly_history AS C WHERE C.id_offers=w.id)
  
  '.$sql_dop1.' '.$sql_su2.' '.$sql_su3.' '.$sql_su4.' '.$sql_su5.' 
  
  )
  UNION
(
  Select 
  
  DISTINCT h.id as id_booking,b.*,
  (SELECT yy.end_fly FROM booking_offers_fly_history AS yy WHERE yy.id_offers=w.id ORDER BY yy.datetime DESC LIMIT 0,1) AS end_fly,
  
  h.title,w.number_op,w.date_fly,w.id_operator,w.id as id_offers,w.comment_client,h.id_user as uss,w.status as stt,h.status as stt1 
  
  from k_clients as b,booking as h,booking_offers as w,booking_offers_fly_history as xx'.$sql_dop.'
  
  where xx.id_offers=w.id and w.id_booking=h.id and xx.end_fly<="'.date("Y-m-d").' '.date("H:i:s").'"  and ((h.status=3)or(h.status=6)) AND w.status=2  and h.visible=1 '.$sql_p.' and h.id_client=b.id and b.visible=1  
  '.$sql_dop1.' '.$sql_su2.' '.$sql_su3.' '.$sql_su4.' '.$sql_su5.' 
)

) Z order by Z.end_fly desc '.limitPage('n_st',$count_write);
		
	//echo($sql_mi);	
		
$result_t2=mysql_time_query($link,$sql_mi);		
		
		
	  $sql_count='select count(DISTINCT Z.id) as kol from(     
   (   
  Select 
  
  DISTINCT h.id as id_booking,b.*,w.end_fly,h.title,w.number_op,w.date_fly,w.id_operator
  
  from k_clients as b,booking as h,booking_offers as w'.$sql_dop.'
  
  where w.id_booking=h.id and w.end_fly<="'.date("Y-m-d").' '.date("H:i:s").'" and ((h.status=3)or(h.status=6))  and h.visible=1 '.$sql_p.' and h.id_client=b.id and b.visible=1 AND w.status=2  
  
  AND w.id NOT IN (SELECT C.id_offers FROM booking_offers_fly_history AS C WHERE C.id_offers=w.id)
  
  '.$sql_dop1.' '.$sql_su2.' '.$sql_su3.' '.$sql_su4.' '.$sql_su5.' 
  
  )
  UNION
(
  Select 
  
  DISTINCT h.id as id_booking,b.*,
  (SELECT yy.end_fly FROM booking_offers_fly_history AS yy WHERE yy.id_offers=w.id ORDER BY yy.datetime DESC LIMIT 0,1) AS end_fly,
  
  h.title,w.number_op,w.date_fly,w.id_operator
  
  from k_clients as b,booking as h,booking_offers as w,booking_offers_fly_history as xx'.$sql_dop.'
  
  where xx.id_offers=w.id and w.id_booking=h.id and xx.end_fly<="'.date("Y-m-d").' '.date("H:i:s").'"  and ((h.status=3)or(h.status=6))  and h.visible=1 '.$sql_p.' and h.id_client=b.id and b.visible=1 AND w.status=2   
  '.$sql_dop1.' '.$sql_su2.' '.$sql_su3.' '.$sql_su4.' '.$sql_su5.' 
)

) Z';  
	  
		
	    
		}
		//echo($_COOKIE["su_1c".$id_user]);
		if($_COOKIE["su_1c".$id_user]==5)
            {
//по вылету по новым турам
            /*
            (SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=b.id ORDER BY yy.datetime DESC LIMIT 0,1) AS start_fly,
  (SELECT yy.end_fly FROM trips_fly_history AS yy WHERE yy.id_trips=b.id ORDER BY yy.datetime DESC LIMIT 0,1) AS end_fly,
b.shopper,
b.id_shopper,
b.id_operator,
b.id_contract,
b.number_to,
b.hotel,
b.id_country,
b.place_name
  */

                $sql_mi='
  
  select DISTINCT Z.id_trips,Z.fio,Z.phone,Z.code,Z.id from(     
   
(
  Select 
  
  DISTINCT b.id as id_trips, t.*,
    (SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=b.id ORDER BY yy.datetime DESC LIMIT 0,1) AS d_fly1
  
  from trips as b,k_clients as t, trips_fly_history as xx'.$sql_dop.'
  
  where t.id=b.id_shopper and b.shopper=1 and xx.id_trips=b.id and (SELECT ysy.start_fly FROM trips_fly_history AS ysy WHERE ysy.id_trips=b.id ORDER BY ysy.datetime DESC LIMIT 0,1)>="'.date("Y-m-d").' 00:00:00" and b.visible=1 and b.id_a_company="'.$id_company.'" '.$sql_su5.' 
)

  UNION
(
Select 
  
  DISTINCT b.id as id_trips, t.*,
    (SELECT yy.end_fly FROM trips_fly_history AS yy WHERE yy.id_trips=b.id ORDER BY yy.datetime DESC LIMIT 0,1) AS d_fly1
  
  from trips as b,k_clients as t, trips_fly_history as xx'.$sql_dop.'
  
  where t.id=b.id_shopper and b.shopper=1 and xx.id_trips=b.id and (SELECT ysy.end_fly FROM trips_fly_history AS ysy WHERE ysy.id_trips=b.id ORDER BY ysy.datetime DESC LIMIT 0,1)>="'.date("Y-m-d").' 00:00:00" and b.visible=1 and b.id_a_company="'.$id_company.'" '.$sql_su5.' 
)


) Z order by Z.d_fly1 '.limitPage('n_st',$count_write);

//echo $sql_mi;
                $result_t2=mysql_time_query($link,$sql_mi);


                $sql_count=' select count(DISTINCT Z.id_trips) as kol from(     
   
(
  Select 
  
  DISTINCT b.id as id_trips, t.*,
    (SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=b.id ORDER BY yy.datetime DESC LIMIT 0,1) AS d_fly1
  
  from trips as b,k_clients as t, trips_fly_history as xx'.$sql_dop.'
  
  where t.id=b.id_shopper and b.shopper=1 and xx.id_trips=b.id and (SELECT ysy.start_fly FROM trips_fly_history AS ysy WHERE ysy.id_trips=b.id ORDER BY ysy.datetime DESC LIMIT 0,1)>="'.date("Y-m-d").' 00:00:00" and b.visible=1 and b.id_a_company="'.$id_company.'" '.$sql_su5.' 
)

  UNION
(
Select 
  
  DISTINCT b.id as id_trips, t.*,
    (SELECT yy.end_fly FROM trips_fly_history AS yy WHERE yy.id_trips=b.id ORDER BY yy.datetime DESC LIMIT 0,1) AS d_fly1
  
  from trips as b,k_clients as t, trips_fly_history as xx'.$sql_dop.'
  
  where t.id=b.id_shopper and b.shopper=1 and xx.id_trips=b.id and (SELECT ysy.end_fly FROM trips_fly_history AS ysy WHERE ysy.id_trips=b.id ORDER BY ysy.datetime DESC LIMIT 0,1)>="'.date("Y-m-d").' 00:00:00" and b.visible=1 and b.id_a_company="'.$id_company.'" '.$sql_su5.' 
)


) Z';



            }
	} else
	{
	
 		if (( isset($_COOKIE["su_3c".$id_user]))and(is_numeric($_COOKIE["su_3c".$id_user]))and(array_search($_COOKIE["su_3c".$id_user],$os_id3)!==false)and($_COOKIE["su_3c".$id_user]!=0))
		{
				
	
  $result_t2=mysql_time_query($link,'Select 
  
  DISTINCT b.*
  
  from k_clients as b,booking as h'.$sql_dop.'
  
  where h.id_client=b.id and b.visible=1 '.$sql_p.' '.$sql_dop1.' '.$sql_su2.' '.$sql_su3.' '.$sql_su4.' '.$sql_su5.' '.$sql_su1.' '.limitPage('n_st',$count_write));
	  
		
				
	  
  $sql_count='Select 
  
  count(DISTINCT a.id) as kol
  
  from k_clients as a,booking as h'.$sql_dop.'
  
  where h.id_client=a.id and a.visible=1 '.$sql_p_.' '.$sql_dop2.' '.$sql_su2_.' '.$sql_su3_.' '.$sql_su4_.' '.$sql_su5_;
		} else
		{
  $result_t2=mysql_time_query($link,'Select 
  
  DISTINCT b.*
  
  from k_clients as b'.$sql_dop.'
  
  where b.visible=1 '.$sql_p.' '.$sql_dop1.' '.$sql_su2.' '.$sql_su3.' '.$sql_su4.' '.$sql_su5.' '.$sql_su1.' '.limitPage('n_st',$count_write));
	  
		
				
	  
  $sql_count='Select 
  
  count(DISTINCT a.id) as kol
  
  from k_clients as a'.$sql_dop.'
  
  where a.visible=1 '.$sql_p_.' '.$sql_dop2.' '.$sql_su2_.' '.$sql_su3_.' '.$sql_su4_.' '.$sql_su5_;			
		}
	}
	}
//echo($sql_count);
$result_t221=mysql_time_query($link,$sql_count);	  
$row__221= mysqli_fetch_assoc($result_t221);	  

//echo' <h3 class="head_h" style=" margin-bottom:0px;">Cнабжение<i>'.$row__221["kol"].'</i><div></div></h3> ';	
	

echo'<div class="okss"><span class="title_book yop_booking"><i>'.$row__221["kol"].'</i><span>'.PadejNumber($row__221["kol"],'найденный турист,найденных туриста,найденных туристов').'</span></span></div>';
			
		} else
		{
		//организации
		
				  $sql_p=' and b.id_a_company="'.$id_company.'"';
	      $sql_p_=' and a.id_a_company="'.$id_company.'"';	
		
		 $sql_su1=' order by b.name ';
	  $sql_su1_=' order by a.name';
 		if (( isset($_COOKIE["su_1co".$id_user]))and(is_numeric($_COOKIE["su_1co".$id_user]))and(array_search($_COOKIE["su_1co".$id_user],$os_id)!==false))
		{
			if($_COOKIE["su_1co".$id_user]==1)
			{
				$sql_su1=' order by b.datetimes desc';
				$sql_su1_=' order by a.datetimes desc';
			}
		}
	//какому менеджеру принадлежит
	      //особенности особенности особенности
	  $sql_su5='';
	  $sql_su5_='';
	  /*if($sign_admin==1)
	  {*/
 		if (( isset($_COOKIE["su_5co".$id_user]))and(is_numeric($_COOKIE["su_5co".$id_user]))and(array_search($_COOKIE["su_5co".$id_user],$os_id5)!==false)and($_COOKIE["su_5co".$id_user]!=0))
		{
			if($_COOKIE["su_5co".$id_user]==777)
			{
				$sql_su5=' and b.id_user="'.$id_user.'"';

				$sql_su5_=' and a.id_user="'.$id_user.'"';				
			} else
			{
				$sql_su5=' and b.id_user="'.htmlspecialchars(trim($_COOKIE["su_5co".$id_user])).'"';

				$sql_su5_=' and a.id_user="'.htmlspecialchars(trim($_COOKIE["su_5co".$id_user])).'"';
			}
		}	
					
		//}			
			
	//поиск по телефону коду или фио
	//если поиск по названию то остальные критерии поиска не работают
 		if(( isset($_COOKIE["su_7co".$id_user]))and($_COOKIE["su_7co".$id_user]!=''))
		{
			

	$query=mb_convert_case(htmlspecialchars($_COOKIE["su_7co".$id_user]), MB_CASE_LOWER, "UTF-8");
			
$result_t2=mysql_time_query($link,'select * from(     
   (   
SELECT b.name,b.id,b.head,b.adress_ur,b.datetimes,b.id_user,b.comment FROM k_organization AS b where b.visible=1 '.$sql_p.' AND LOWER(b.name) LIKE "'.$query.'%"   
)
UNION
(

SELECT b.name,b.id,b.head,b.adress_ur,b.datetimes,b.id_user,b.comment FROM k_organization AS b where b.visible=1 '.$sql_p.' AND LOWER(b.name) LIKE "%'.$query.'%" 
AND b.id NOT IN 
(SELECT b.id FROM k_organization b WHERE b.visible=1 '.$sql_p.' AND LOWER(b.name) LIKE "'.$query.'%")
) 
UNION
(
SELECT b.name,b.id,b.head,b.adress_ur,b.datetimes,b.id_user,b.comment FROM k_organization AS b where b.visible=1 '.$sql_p.' AND LOWER(b.code_inn) LIKE "'.$query.'%"  
AND b.id NOT IN 
(SELECT b.id FROM k_organization b WHERE b.visible=1 '.$sql_p.' AND LOWER(b.name) LIKE "'.$query.'%")
AND b.id NOT IN 
(SELECT b.id FROM k_organization b WHERE b.visible=1 '.$sql_p.' AND LOWER(b.name) LIKE "%'.$query.'%")
) 


) Z order by Z.name '.limitPage('n_st',$count_write));		
	
			
	  
  $sql_count='select count(Z.id) as kol from(     
   (   
SELECT b.name,b.id,b.head,b.adress_ur,b.datetimes,b.id_user FROM k_organization AS b where b.visible=1 '.$sql_p.' AND LOWER(b.name) LIKE "'.$query.'%"   
)
UNION
(

SELECT b.name,b.id,b.head,b.adress_ur,b.datetimes,b.id_user FROM k_organization AS b where b.visible=1 '.$sql_p.' AND LOWER(b.name) LIKE "%'.$query.'%" 
AND b.id NOT IN 
(SELECT b.id FROM k_organization b WHERE b.visible=1 '.$sql_p.' AND LOWER(b.name) LIKE "'.$query.'%")
) 
UNION
(
SELECT b.name,b.id,b.head,b.adress_ur,b.datetimes,b.id_user FROM k_organization AS b where b.visible=1 '.$sql_p.' AND LOWER(b.code_inn) LIKE "'.$query.'%"  
AND b.id NOT IN 
(SELECT b.id FROM k_organization b WHERE b.visible=1 '.$sql_p.' AND LOWER(b.name) LIKE "'.$query.'%")
AND b.id NOT IN 
(SELECT b.id FROM k_organization b WHERE b.visible=1 '.$sql_p.' AND LOWER(b.name) LIKE "%'.$query.'%")
) 


) Z';	
		
		} else
		{
	
	
  $result_t2=mysql_time_query($link,'Select 
  
  DISTINCT b.name,b.id,b.head,b.adress_ur,b.datetimes,b.id_user,b.comment
  
  from k_organization as b'.$sql_dop.'
  
  where b.visible=1 '.$sql_p.' '.$sql_dop1.' '.$sql_su2.' '.$sql_su3.' '.$sql_su4.' '.$sql_su5.' '.$sql_su1.' '.limitPage('n_st',$count_write));
	  
		
				
	  
  $sql_count='Select 
  
  count(DISTINCT a.id) as kol
  
  from k_organization as a'.$sql_dop.'
  
  where a.visible=1 '.$sql_p_.' '.$sql_dop2.' '.$sql_su2_.' '.$sql_su3_.' '.$sql_su4_.' '.$sql_su5_;			
		
	
	}
//echo($sql_count);
$result_t221=mysql_time_query($link,$sql_count);	  
$row__221= mysqli_fetch_assoc($result_t221);	  

//echo' <h3 class="head_h" style=" margin-bottom:0px;">Cнабжение<i>'.$row__221["kol"].'</i><div></div></h3> ';	
	

echo'<div class="okss"><span class="title_book yop_booking"><i>'.$row__221["kol"].'</i><span>'.PadejNumber($row__221["kol"],'найденная организация,найденных организации,найденных организаций').'</span></span></div>';			
			
			
		}
			
					 if(!isset($_GET["tabs"]))
				 {
					 echo'<span class="add-next-user"></span>';
				 } else
					 {
				 if($_GET["tabs"]==1)
				 {
					 echo'<span class="add-next-org"></span>';
				 }				 
				 if($_GET["tabs"]==2)
				 {
					 echo'<span class="add-next-poten"></span>';
				 }	
					 }
	  
                  $num_results_t2 = $result_t2->num_rows;
	              if($num_results_t2!=0)
	              {
	
				$com=0;
			    $cost=0;
					  $count_y=0;
$new_class_block='';
	       for ($ksss=0; $ksss<$num_results_t2; $ksss++)
                            {

					$row_8= mysqli_fetch_assoc($result_t2);
	
		

$cll='';
//забронировано						 

if(!isset($_GET["tabs"]))
{

include $url_system.'clients/temp/output_user.php';
echo $temp;

} else
		   {
	if($_GET["tabs"]==1)
	{
	//вывод организации	
include $url_system.'clients/temp/output_org.php';
echo $temp;
	}
	if($_GET["tabs"]==2)
	{
	//вывод потенциальных клиентов
include $url_system.'clients/temp/output_poten.php';
echo $temp;
	}	

}

								  
						 
					 }
 
							
					  
	  $count_pages=CountPage($sql_count,$link,$count_write);
	  if($count_pages>1)
	  {
		  if(!isset($_GET["tabs"]))
		  {
			  displayPageLink_new('clients/','clients/.page-',"", NumberPageActive('n_st'),$count_pages ,5,9,"journal_oo",1); 
		  } else
		  {
			  displayPageLink_new('clients/.tabs-'.$_GET["tabs"],'clients/.tabs-'.$_GET["tabs"].'.page-',"", NumberPageActive('n_st'),$count_pages ,5,9,"journal_oo",1); 			  
		  }
		  
	  }
		
					  
					  
 } else
				  {
					  
//echo'<div class="booking_div da_book1"><div class="not_booling"></div><span class="h4" style="width:calc(100% - 60px)"><span>Клиентов с такими параметрами пока нет. Измените параметры и попробуйте еще раз.</span></span></div>';
					  
					  
echo'<div class="message_search_b"><span>Клиентов с такими параметрами пока нет. Измените параметры и попробуйте еще раз.</span></div>';						  
					  
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