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

    $os2 = array( "Текущий месяц","Прошлый месяц","За ".month_rus1(date_step_sql('m', '-2m')),"За ".month_rus1(date_step_sql('m', '-3m')));
    $os_id2 = array("0","1","3","4");

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
	 
 <div class="oka_block_1">
<div class="oka1_1" style="padding-top: 30px;">
  <?


	
	
	
  //Получаем комиссию пользователя и его бонусы	
	
  //по умолчанию текущий месяц	
  $month_s=date("Y-m-").'01';
	  $month_s_like=date("Y-m-");
$month_rus=date("m");
$month_rus1=date("m");
  $date_level_bonus=date("Y-m-").'01';


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
  $result_status22=mysql_time_query($link,'SELECT sum(a.sum) as sum from users_commission_trips as a,r_user as b where a.id_users=b.id and b.id_company="'.$id_company.'" and a.date="'.$month_s.'" and not(a.id_users=0)');
			} else
		{
	  if((isset($_COOKIE["su_5s".$id_user]))and($_COOKIE["su_5s".$id_user]!=0)and(($sign_admin==1)or($sign_level>1)))
	  {
	      //статистика по какому то конкретному менеждеру директоров и всех кто выже менеджеров
	  $result_status22=mysql_time_query($link,'SELECT a.sum from users_commission_trips as a,r_user as b where a.id_users=b.id and b.id_company="'.$id_company.'" and  a.id_users="'.htmlspecialchars(trim($_COOKIE["su_5s".$id_user])).'" and a.date="'.$month_s.'"');
	  } else{
	      //своя статистика для менеджеров
  $result_status22=mysql_time_query($link,'SELECT a.sum from users_commission_trips as a,r_user as b where a.id_users=b.id and b.id_company="'.$id_company.'" and a.id_users="'.$id_user.'" and a.date="'.$month_s.'"');
	  }
	  
	  
	  
		}
           if($result_status22->num_rows!=0)
           { 
			     $row_status22 = mysqli_fetch_assoc($result_status22);	
		   } 
	
	       $row_status22["sum"] ??=0;
	
	$bonus=0;
	
 if ((( !isset($_COOKIE["su_5s".$id_user]))or($_COOKIE["su_5s".$id_user]==0))and(($sign_admin==1)or($sign_level>1)))
  {
      //общая статистика по всем подчиненным менеджерам для директоров и всех кто выже менеджеров
				  $result_status223=mysql_time_query($link,'SELECT a.* from users_commission_trips as a,r_user as b where a.id_users=b.id and b.id_company="'.$id_company.'" and a.date="'.$month_s.'"');
				$num223 = $result_status223->num_rows;
				  if($result_status223->num_rows!=0)
                   { 
					 for ($i=0; $i<$num223; $i++)
		         {			   			  			   
			    $row223 = mysqli_fetch_assoc($result_status223);

                     $result_status_b=mysql_time_query($link,'SELECT a.* from users_commission_level as a where a.id_users="'.$row223["id_users"].'" and a.sum_start<="'.$row223["sum"].'" and a.sum_end>"'.$row223["sum"].'" and a.dates="'.$date_level_bonus.'" and a.id_company="'.ht($id_company).'"');

                     if($result_status_b->num_rows==0) {

                         $result_status_b = mysql_time_query($link, 'SELECT a.* from users_commission_level as a where a.id_users=0 and a.sum_start<="' . $row223["sum"] . '" and a.sum_end>"' . $row223["sum"] . '" and a.dates="' . $date_level_bonus . '" and a.id_company="' . ht($id_company) . '"');

                     }
		
           if($result_status_b->num_rows!=0)
           { 
			     $row_status_b = mysqli_fetch_assoc($result_status_b);
			     if($row_status_b["level"]!=1)
				 {
					 $bonus=$bonus+(($row223["sum"]*$row_status_b["proc"])/100);
				 }
		   }	
				  }
				  }
				
				
			} else
			{
  $result_status_b=mysql_time_query($link,'SELECT a.* from users_commission_level as a where a.id_users="'.$id_user.'" and a.sum_start<="'.$row_status22["sum"].'" and a.sum_end>"'.$row_status22["sum"].'"  and a.dates="'.$date_level_bonus.'" and a.id_company="'.ht($id_company).'"');
  if($result_status_b->num_rows==0)
  {
      $result_status_b=mysql_time_query($link,'SELECT a.* from users_commission_level as a where a.id_users=0 and a.sum_start<="'.$row_status22["sum"].'" and a.sum_end>"'.$row_status22["sum"].'"  and a.dates="'.$date_level_bonus.'" and a.id_company="'.ht($id_company).'"');

  }


           if($result_status_b->num_rows!=0)
           { 
			     $row_status_b = mysqli_fetch_assoc($result_status_b);
			     if($row_status_b["level"]!=1)
				 {
					 $bonus=($row_status22["sum"]*$row_status_b["proc"])/100;
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
								$result_pred=mysql_time_query($link,'select * from (
          (SELECT a.id, a.id_exchange, (a.cost_client-a.cost_operator) as com1, ((a.cost_client_exchange-a.cost_operator_exchange)*a.exchange_rates) as com2  FROM trips AS a WHERE a.id_user in('.implode(',',$mass_ei).') and a.visible=1 and ((a.buy_clients=1)and(a.buy_operator=0)) and ((not(a.cost_operator=0))or(not(a.cost_operator_exchange=0))) and  (select v.date from trips_payment_term as v where v.id_trips=a.id and v.visible=1 and v.type=1 and v.proc=100 and v.yes=0 limit 0,1) LIKE "'.date("Y-m").'-%"'.$sql_line.')
          UNION
          (SELECT a.id, a.id_exchange, (a.cost_client-a.cost_operator) as com1, ((a.cost_client_exchange-a.cost_operator_exchange)*a.exchange_rates) as com2  FROM trips AS a WHERE a.id_user in('.implode(',',$mass_ei).') and a.visible=1 and ((a.buy_clients=0)and(a.buy_operator=1)) and ((not(a.cost_operator=0))or(not(a.cost_operator_exchange=0))) and (select v.date from trips_payment_term as v where v.id_trips=a.id and v.visible=1 and v.type=0 and v.proc=100 and v.yes=0 limit 0,1) LIKE "'.date("Y-m").'-%"'.$sql_line.')
          UNION
          (SELECT a.id, a.id_exchange, (a.cost_client-a.cost_operator) as com1, ((a.cost_client_exchange-a.cost_operator_exchange)*a.exchange_rates) as com2  FROM trips AS a WHERE a.id_user in('.implode(',',$mass_ei).') and a.visible=1 and ((a.buy_clients=0)and(a.buy_operator=0)) and ((not(a.cost_operator=0))or(not(a.cost_operator_exchange=0))) and (select v.date from trips_payment_term as v where v.id_trips=a.id and v.visible=1 and v.type=0 and v.proc=100 and v.yes=0 limit 0,1) LIKE "'.date("Y-m").'-%" and  (select v.date from trips_payment_term as v where v.id_trips=a.id and v.visible=1 and v.type=1 and v.proc=100 and v.yes=0 limit 0,1) LIKE "'.date("Y-m").'-%"'.$sql_line.')
              
              
      ) as Z');


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
	
	<div class=" bill_wallet">
		
				<?
		echo'<div class=" cell_small '.$pp_class.'">';
			if($uoo_pp==1)
			{
			  echo'<div class="cell_1">';
			}
			
			echo'<div class="text_wallet1 padd"><span class="bill_str1">→</span>комиссия за '.$month_rus1.'</div>';
			
			echo'<span class="pay_summ_bill1">'.rtrim(rtrim(number_format($row_status22["sum"], 2, '.', ' '),'0'),'.').'</span>';
			
			if($uoo_pp==1)
			{
			

			
			
	
				
				echo'</div><div class="cell_2">';
		
				echo'<div class="text_wallet1 padd"><span class="bill_str1">~</span>предполагаемая комиссия за '.$month_rus1.'</div>';
			
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
			 } else
                 echo'<div class="cell_small cell_big flex_pp"><div class="cell_1">';
					echo'<div class="text_wallet1 padd"><span class="bill_str1">→</span>Ваши личные бонусы</div>';
							
						}
								
			echo'<span class="pay_summ_bill1">'.rtrim(rtrim(number_format($bonus, 2, '.', ' '),'0'),'.').'</span>';

  echo'</div>';
  echo'<div class="cell_2">';

                echo'<div class="text_wallet1 padd"><span class="bill_str1">→</span>Продаж на сумму</div>';

                $sql_kogo='';
                if(((( isset($_COOKIE["su_5s".$id_user]))and(is_numeric($_COOKIE["su_5s".$id_user]))and(array_search($_COOKIE["su_5s".$id_user],$os_id5)!==false)and($_COOKIE["su_5s".$id_user]!=0))or(!isset($_COOKIE["su_5s".$id_user])))and(($sign_admin==1)or($sign_level>1)))
                {
                    $sql_kogo=' and a.id_user="'.ht($_COOKIE["su_5s".$id_user]).'"';
                }

                $sum_no=0;
                $result_uu = mysql_time_query($link, 'select sum(a.cost_client) as summ from trips as a,trips_contract as b where a.id_contract=b.id and a.id_a_company="'.$id_company.'" and a.status=1 and b.date_doc>="'.$date_start_obo.'" and a.buy_clients=0 and b.date_doc<"'.$date_end_obo.'" and a.visible=1 '.$sql_kogo);



                $num_results_uu = $result_uu->num_rows;

                if ($num_results_uu != 0) {



                    $row_uu = mysqli_fetch_assoc($result_uu);
                    $sum_no=$row_uu["summ"];
                    }

                $sum_yes=0;
                  $result_uu = mysql_time_query($link, 'select sum(a.paid_client) as summ from trips as a,trips_contract as b  where a.id_contract=b.id and a.id_a_company="'.$id_company.'" and a.status=1 and b.date_doc>="'.$date_start_obo.'" and a.buy_clients=1 and b.date_doc<"'.$date_end_obo.'" and a.visible=1 '.$sql_kogo);



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
          $result_work_zz=mysql_time_query($link,'Select a.name_user,a.id from r_user as a,r_role as b where a.id_role =b.id and ((b.role="works")or(b.role="gworks")) and a.id="'.$value.'" and a.enabled=1');
          $num_results_work_zz = $result_work_zz->num_rows;
          if($num_results_work_zz!=0)
          {

              for ($i=0; $i<$num_results_work_zz; $i++)
              {
                  $row_8 = mysqli_fetch_assoc($result_work_zz);
                  echo'<div class=" cell_more1 level_50 ww_100">';

                  $result_status22=mysql_time_query($link,'SELECT a.sum from users_commission_trips as a where a.id_users="'.$row_8["id"].'" and a.date="'.$month_s.'"');
                  if($result_status22->num_rows!=0)
                  {
                      $row_status22 = mysqli_fetch_assoc($result_status22);
                  }

                  $bonus=0;
                  $result_status_b=mysql_time_query($link,'SELECT a.* from users_commission_level as a where a.id_users="'.$row_8["id"].'" and a.sum_start<="'.$row_status22["sum"].'" and a.sum_end>"'.$row_status22["sum"].'"  and a.dates="'.$date_level_bonus.'"  and a.id_company="'.ht($id_company).'"');

                  if($result_status_b->num_rows==0) {
                      $result_status_b = mysql_time_query($link, 'SELECT a.* from users_commission_level as a where a.id_users=0 and a.sum_start<="' . $row_status22["sum"] . '" and a.sum_end>"' . $row_status22["sum"] . '"  and a.dates="' . $date_level_bonus . '"  and a.id_company="' . ht($id_company) . '"');
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
                  $result_uu_xo = mysql_time_query($link, 'SELECT a.* from users_commission_level as a where a.id_users="'.$row_8["id"].'" and a.dates="' . date("Y-m-") . '01" and a.id_company="' . ht($id_company) . '" order by a.level');

                  if($result_uu_xo->num_rows==0) {
//общее если нет конкретики по уровням
                      $result_uu_xo = mysql_time_query($link, 'SELECT a.* from users_commission_level as a where a.id_users=0 and a.dates="' . date("Y-m-") . '01" and a.id_company="' . ht($id_company) . '" order by a.level');


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
                  echo'<div class="level_more_j"><strong>'.rtrim(rtrim(number_format(($bonus), 2, '.', ' '),'0'),'.').' руб.</strong> <span>('.$row_status_b["level"].' бонусный уровень)</span></div>';







                  echo'</div>';

              }
          }

      }



		  
		  
	  } else
	  {
	echo'<div class="level_more '.$class_color_level.'">'.$row_status_b["level"].' бонусный уровень <strong>('.$row_status_b["proc"].'%)</strong></div>';
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
	
$result_scores3=mysql_time_query($link,'SELECT count(a.id) as cc FROM trips AS a WHERE a.id_a_company="'.$id_company.'" and a.visible=1 '.$sql_line.' '.$sql_line1);

		 
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


$result_scores3=mysql_time_query($link,'SELECT count(distinct a.id) as cc FROM task_status_history_new AS a,task_new as c WHERE c.id_a_company="'.$id_company.'" and c.id=a.id_task and a.action_history=5 and c.status=1 '.$sql_line.' '.$sql_line1);
		 		 
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


$result_scores3=mysql_time_query($link,'SELECT count(distinct a.id) as cc FROM task_new as a WHERE a.id_a_company="'.$id_company.'" and a.reminder=0 and a.status=0 '.$sql_line.' '.$sql_line1);



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

         $result_scores3=mysql_time_query($link,'SELECT count(a.id) as cc FROM preorders AS a WHERE a.id_company="'.$id_company.'" and a.visible=1 '.$sql_line.' '.$sql_line1);
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
$result_t2=mysql_time_query($link,'SELECT distinct a.id FROM trips AS a WHERE a.id_a_company="'.$id_company.'" and a.visible=1 '.$sql_line.' '.$sql_line1);


	  
  $sql_count='SELECT distinct count(a.id) as kol FROM trips AS a WHERE a.id_a_company="'.$id_company.'" and a.visible=1 '.$sql_line.' '.$sql_line1;
			

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

                  $result_uuy = mysql_time_query($link, 'select A.id,A.discount,A.doc, A.id_user,A.shopper,A.id_shopper,A.id_contract,A.comment,A.number_to,A.hotel,A.id_country,A.place_name,A.date_start,A.date_end,A.number_to,A.id_contract,A.cost_client,A.id_exchange,A.cost_operator_exchange,A.cost_operator,A.cost_client_exchange,A.buy_clients,A.buy_operator,A.paid_operator,A.paid_operator_rates,A.exchange_rates,A.paid_client,A.paid_client_rates,A.date_prepaid,A.comment,A.status_admin from trips as A where A.id="' . ht($row_88['id']) . '"');
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



  $result_t2=mysql_time_query($link,'SELECT distinct a.id FROM trips AS a WHERE a.id_a_company="'.$id_company.'" and a.visible=1 '.$sql_line.' '.$sql_line1);



  $sql_count='SELECT distinct count(a.id) as kol FROM trips AS a WHERE a.id_a_company="'.$id_company.'" and a.visible=1 '.$sql_line.' '.$sql_line1;

	 
	 
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

                          $result_uuy = mysql_time_query($link, 'select A.id,A.discount,A.doc, A.id_user,A.shopper,A.id_shopper,A.id_contract,A.comment,A.number_to,A.hotel,A.id_country,A.place_name,A.date_start,A.date_end,A.number_to,A.id_contract,A.cost_client,A.id_exchange,A.cost_operator_exchange,A.cost_operator,A.cost_client_exchange,A.buy_clients,A.buy_operator,A.paid_operator,A.paid_operator_rates,A.exchange_rates,A.paid_client,A.paid_client_rates,A.date_prepaid,A.comment,A.status_admin from trips as A where A.id="' . ht($row_88['id']) . '"');
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