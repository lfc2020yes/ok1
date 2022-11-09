<?

//бонусы выплачиваются за прошлый месяц в этом месяце
//поэтому за текущий месяц считаем в расходы бонусы за прошлый месяц и так далее


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



$active_menu='finance';  // в каком меню


$count_write=20;			
		
$edit_price=0;

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

if((!$role->permission('Финансы','R'))and($sign_admin!=1))
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

if($error_header!=404){ SEO('finance','','','',$link); } else { SEO('0','','','',$link); }

include_once $url_system.'module/config_url.php'; include $url_system.'template/head.php';
?>
</head><body>
<?
//$secret="xGLbxvu9lOE";
//$token=token_access_compile(142,'bt_trips_b',$secret);
//echo('токен 1-'.$token.'<br>');

//$secret1="xGL234u9lOE";
//$token1=token_access_compile(813,'bt_trips_btttefs',$secret1);
//echo('токен 2-'.$token1.'<br>');

//$token1[2]='dtE0KNOt3/MHxSp1z5EvqhjJk9ZKQOOzTaGkx8EMURc=';
//$token1[2]='s 5KzioLlSmIVRL9j 5sMbF7Qn0FmKLCJpRn6Og/Vrw=';
//$secr="xGLbxvu9lOEP453g";

/*
$token1[2]=decode_x($token1[2],$secr);
echo('!-'.$token1[2]);
*/
/*
if(!token_access_new($token,'bt_trips_b',142,$secret,2880)) {
   echo"!";
}
if(!token_access_new($token1,'bt_trips_btttefs',813,$secret1,2880)) {
    echo"!";
}
*/


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
//сообщения после добавление редактирования чего то
//сообщения после добавление редактирования чего то
//сообщения после добавление редактирования чего то

$echo_help=0;
if (( isset($_GET["a"]))and($_GET["a"]=='yes'))
{
    echo'<script type="text/javascript">
        $(function (){
            alert_message(\'ok\',\'Данные по сотруднику изменены\');
            });
</script>';

    $echo_help++;
}
if (( isset($_GET["a"]))and($_GET["a"]=='add'))
{
    echo'<script type="text/javascript">
        $(function (){
            alert_message(\'ok\',\'Новая операция добавлена\');
            });
</script>';

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

	  include_once $url_system.'template/top_finance.php';


     echo'<div id="fullpage" class="margin_60" id_content="'.$id_user.'">';

	?>
 <div class="section" id="section1">
	 

	<div class="oka_block_2019" style="min-height:auto !important;">
 
 <div class="line_mobile_blue">
	 <?
         echo'Ваш финансовый учет';
?>
 <span class="menu-09-count1"></span> </div>

<div class="div_ook hop_ds"><div class="search_task">

    <? 
	   $zindex=110;


       $os2 = array( "Текущий месяц","Прошлый месяц","-2 месяца","Выбрать период");
	   $os_id2 = array("0","1","3","2");

    $os2 = array( "Текущий месяц","Прошлый месяц","За ".month_rus1(date_step_sql('m', '-2m')),"За ".month_rus1(date_step_sql('m', '-3m')),"Выбрать период");
    $os_id2 = array("0","1","3","4","2");

		$su_2=0;
		$date_su='';
		if (( isset($_COOKIE["su_2f".$id_user]))and(is_numeric($_COOKIE["su_2f".$id_user]))and(array_search($_COOKIE["su_2f".$id_user],$os_id2)!==false))
		{
			$su_2=$_COOKIE["su_2f".$id_user];
		}
		$val_su2=$os2[array_search($su_2, $os_id2)];
		
		
		if ( isset($_COOKIE["suddf".$id_user]))
		{
			//$date_base__=explode(".",$_COOKIE["sudds"]);
		if (( isset($_COOKIE["su_2f".$id_user]))and(is_numeric($_COOKIE["su_2f".$id_user]))and($_COOKIE["su_2f".$id_user]==2))
		{
			$date_su=$_COOKIE["suddf_mor".$id_user];
			$val_su2=$_COOKIE["suddf_mor".$id_user];
		}
		}
	
		$class_js_readonly ??= '';
	    $class_js_search ??='';
		
		echo'<input id="date_hidden_table" '.$class_js_readonly.' name="date" value="'.$date_su.'" type="hidden"><input id="date_hidden_start" name="start_date" type="hidden"><input id="date_hidden_end" name="end_date" type="hidden">';
	
		   echo'<div class="left_drop menu1_prime book_menu_sel gop_io js--sort js-call-no-v'.$class_js_search.'" style="z-index:'.$zindex.'; max-width: 500px !important;"><label>Период</label><div class="select eddd"><a class="slct" list_number="t2" data_src="'.$os_id2[array_search(($_COOKIE["su_2f".$id_user] ?? ''), $os_id2)].'">'.$val_su2.'</a><ul class="drop">';
	
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
		   echo'</ul><input type="hidden" '.$class_js_readonly.' name="sort2f" id="sort2f" value="'.$os_id2[$su_2].'"></div></div>';


	
		 echo'<div class="inline_reload js-reload-top"><a href="finance/" class="show_reload">Применить</a></div>';
		
		//echo'<a href="statistic/" class="show_sort_supply">Применить</a>';
		?>
		<!--<div id="date_table" class="table_suply_x"></div>-->
	<!--<input readonly="true" id="date_table" class="table_suply_x">-->
		
	<div class="pad10" style="padding: 0;"><span class="bookingBox_range"><div id="date_table" class="table_suply_x_st"></div></span></div>		

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
//alert("!");
	$('#date_table').val(jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.startDate) + ' - ' + jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.endDate));
	
	var iu=$('.content').attr('iu');
	$.cookie("suddf_mor"+iu, null, {path:'/',domain: window.is_session,secure: false});
CookieList("suddf_mor"+iu,jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.startDate) + ' - ' + jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.endDate),'add');
	
	
	$('#date_hidden_start').val(jQuery.datepicker.formatDate('yy-mm-dd',extensionRange.startDate));
	$('#date_hidden_end').val(jQuery.datepicker.formatDate('yy-mm-dd',extensionRange.endDate));
	
	$('[list_number=t2]').empty().append(jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.startDate) + ' - ' + jQuery.datepicker.formatDate('d MM yy'+' г.',extensionRange.endDate));		
		$.cookie("suddf"+iu, null, {path:'/',domain: window.is_session,secure: false});
CookieList("suddf"+iu,$('#date_hidden_start').val()+'/'+$('#date_hidden_end').val(),'add');

		//$('.show_sort_supply').removeClass('active_supply');
//$('.show_sort_supply').addClass('active_supply');
    $('.js-reload-top').addClass('active-r');
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
if((isset($_COOKIE["su_2f".$id_user]))and(is_numeric($_COOKIE["su_2f".$id_user]))and($_COOKIE["su_2f".$id_user]==2))
{
$date_range=explode("/",$_COOKIE["suddf".$id_user]);
echo'var st=\''.ipost_($date_range[0],'').'\';
var st1=\''.ipost_($date_range[1],'').'\';
var st2=\''.ipost_($_COOKIE["suddf_mor".$id_user],'').'\';';
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
	 
 <div class="oka_block">
<div class="oka1 js-finance-operation" style="padding-top: 30px; width: 100%;">
  <?


  //по умолчанию текущий месяц
  $date_start=date("Y-m-").'01';
  $date_end=date_step_sql('Y-m-', '+1m').'01';
  $more_mon=0;

  $date_start_bonus_last=date_step_sql('Y-m-', '-1m').'01';


  if (( isset($_COOKIE["su_2f".$id_user]))and(is_numeric($_COOKIE["su_2f".$id_user]))and(array_search($_COOKIE["su_2f".$id_user],$os_id2)!==false)and($_COOKIE["su_2f".$id_user]==1))
  {
      //находим прошлый месяц
      $date_start=date_step_sql('Y-m-', '-1m').'01';
      $date_start_bonus_last=date_step_sql('Y-m-', '-2m').'01';
      $date_end=date("Y-m-").'01';
  }

  if (( isset($_COOKIE["su_2f".$id_user]))and(is_numeric($_COOKIE["su_2f".$id_user]))and(array_search($_COOKIE["su_2f".$id_user],$os_id2)!==false)and($_COOKIE["su_2f".$id_user]==3))
  {
      //находим -2 месяца назад
      $date_start=date_step_sql('Y-m-', '-2m').'01';
      $date_start_bonus_last=date_step_sql('Y-m-', '-3m').'01';
      $date_end=date_step_sql('Y-m-', '-1m').'01';


  }
  if (( isset($_COOKIE["su_2f".$id_user]))and(is_numeric($_COOKIE["su_2f".$id_user]))and(array_search($_COOKIE["su_2f".$id_user],$os_id2)!==false)and($_COOKIE["su_2f".$id_user]==4))
  {
      //находим -3 месяца назад
      $date_start=date_step_sql('Y-m-', '-3m').'01';
      $date_start_bonus_last=date_step_sql('Y-m-', '-4m').'01';
      $date_end=date_step_sql('Y-m-', '-2m').'01';
  }



  if (( isset($_COOKIE["su_2f".$id_user]))and(is_numeric($_COOKIE["su_2f".$id_user]))and(array_search($_COOKIE["su_2f".$id_user],$os_id2)!==false)and($_COOKIE["su_2f".$id_user]==2))
  {

      $month_rus1='с '.$_COOKIE["sudds_mor".$id_user];

      $date_range=explode("/",$_COOKIE["suddf".$id_user]);
      $date_start=ht(trim($date_range[0]));
      $date_st = explode("-", ht($date_start));
      $date_start=$date_st[0].'-'.$date_st[1].'-01';
      //echo($date_start.' / ');
      $date_end=ht(trim($date_range[1]));

      $date_en = explode("-", ht($date_end));
      $date_end=date_step_sql_more($date_en[0].'-'.$date_en[1].'-01','+1m');
      //echo($date_end);
      $more_mon=1;
  }

  //рассчитаем доходы и расходы за выбранный период

$raz_array=array();
  //расходы
  $rasx=0;
  $result_uu = mysql_time_query($link, 'select sum(A.sum) as ss  from finance_operation as A where A.income=0 and A.visible=1 and A.id_a_company IN ('.ht($id_company).') and  A.date>="' . ht($date_start) . '" and  A.date<"' . ht($date_end) . '"');
  $num_results_uu = $result_uu->num_rows;

  if ($num_results_uu != 0) {
      $row_uu = mysqli_fetch_assoc($result_uu);
      if($row_uu["ss"]!='') {
          $rasx = $row_uu["ss"];
      }
  }
  //расходы на выплату бонусов за выбранный период
if($more_mon==0)
{
    $bonus=0;
    $fix=0;
    //$result_status223=mysql_time_query($link,'SELECT a.* from users_commission_trips as a,r_user as b where a.id_users=b.id and b.id_company="'.$id_company.'" and a.date="'.$date_start.'"');


    $LIKEX='';
    if(is_numeric($id_company))
    {
        $LIKEX=' and ((b.id_company LIKE "'.ht($id_company).',%")or(b.id_company LIKE "%,'.ht($id_company).',%")or(b.id_company LIKE "%,'.ht($id_company).'")or(b.id_company="'.ht($id_company).'")) ';
    } else
    {
        $date_new_ada = explode(",", ht($id_company));
        for ($ada = 0; $ada < count($date_new_ada); $ada++) {

            if($LIKEX=='')
            {
                $LIKEX=' and ( ((b.id_company LIKE "'.ht($date_new_ada[$ada]).',%")or(b.id_company LIKE "%,'.ht($date_new_ada[$ada]).',%")or(b.id_company LIKE "%,'.ht($date_new_ada[$ada]).'")or(b.id_company="'.ht($date_new_ada[$ada]).'")) ';
            } else
            {
                $LIKEX.='or ((b.id_company LIKE "'.ht($date_new_ada[$ada]).',%")or(b.id_company LIKE "%,'.ht($date_new_ada[$ada]).',%")or(b.id_company LIKE "%,'.ht($date_new_ada[$ada]).'")or(b.id_company="'.ht($date_new_ada[$ada]).'")) ';
            }

        }
        if($LIKEX!='')
        {
            $LIKEX.=') ';
        }


    }



    $result_status223=mysql_time_query($link,'SELECT a.* from users_commission_trips as a,r_user as b where a.id_users=b.id '.$LIKEX.' and a.date="'.$date_start_bonus_last.'"');

//echo('SELECT a.* from users_commission_trips as a,r_user as b where a.id_users=b.id '.$LIKEX.' and a.date="'.$date_start_bonus_last.'"');


    $num223 = $result_status223->num_rows;
    if($result_status223->num_rows!=0)
    {
        for ($i=0; $i<$num223; $i++)
        {
            $row223 = mysqli_fetch_assoc($result_status223);


           // $result_status_b=mysql_time_query($link,'SELECT a.* from users_commission_level as a where a.id_users="'.$row223["id_users"].'" and a.sum_start<="'.$row223["sum"].'" and a.sum_end>"'.$row223["sum"].'" and a.dates="'.$date_start.'" and a.id_company="'.ht($id_company).'"');

            $result_status_b=mysql_time_query($link,'SELECT a.* from users_commission_level as a where a.id_users="'.$row223["id_users"].'" and a.sum_start<="'.$row223["sum"].'" and a.sum_end>"'.$row223["sum"].'" and a.dates="'.$date_start_bonus_last.'" and a.id_company IN ('.ht($id_company).')');


            if($result_status_b->num_rows==0)
            {
               // $result_status_b=mysql_time_query($link,'SELECT a.* from users_commission_level as a where a.id_users=0 and a.sum_start<="'.$row223["sum"].'" and a.sum_end>"'.$row223["sum"].'" and a.dates="'.$date_start.'" and a.id_company="'.ht($id_company).'"');

                $result_status_b=mysql_time_query($link,'SELECT a.* from users_commission_level as a where a.id_users=0 and a.sum_start<="'.$row223["sum"].'" and a.sum_end>"'.$row223["sum"].'" and a.dates="'.$date_start_bonus_last.'" and a.id_company IN ('.ht($id_company).')');
            }


            if($result_status_b->num_rows!=0)
            {
                $row_status_b = mysqli_fetch_assoc($result_status_b);
                if($row_status_b["level"]!=1)
                {
                    $bonus=$bonus+(($row223["sum"]*$row_status_b["proc"])/100);
                }
            }

            //echo($row223["sum_fix"]);

            if($row223["sum_fix"]!=0)
            {
                $fix=$fix+$row223["sum_fix"];
            }


        }
    }


}else
{
    //идем по месяцам и считаем сколько выплатили каждому с учетом уровней бонусов за месяц. (бонусные периоды могут быть разные в зависимости от месяца)
    $bonus=0;
    $fix=0;
    $date_start_while=$date_start;
    while ($date_start_while!= $date_end) {

       // echo($date_start.' () ');
        $date_start_while_bonus_last=date_step_sql_more($date_start_while,'-1m');


        //$result_status223=mysql_time_query($link,'SELECT a.* from users_commission_trips as a,r_user as b where a.id_users=b.id and b.id_company="'.$id_company.'" and a.date="'.$date_start_while.'"');

        $LIKEX='';
        if(is_numeric($id_company))
        {
            $LIKEX=' and ((b.id_company LIKE "'.ht($id_company).',%")or(b.id_company LIKE "%,'.ht($id_company).',%")or(b.id_company LIKE "%,'.ht($id_company).'")or(b.id_company="'.ht($id_company).'")) ';
        } else
        {
            $date_new_ada = explode(",", ht($id_company));
            for ($ada = 0; $ada < count($date_new_ada); $ada++) {

                if($LIKEX=='')
                {
                    $LIKEX=' and ( ((b.id_company LIKE "'.ht($date_new_ada[$ada]).',%")or(b.id_company LIKE "%,'.ht($date_new_ada[$ada]).',%")or(b.id_company LIKE "%,'.ht($date_new_ada[$ada]).'")or(b.id_company="'.ht($date_new_ada[$ada]).'")) ';
                } else
                {
                    $LIKEX.='or ((b.id_company LIKE "'.ht($date_new_ada[$ada]).',%")or(b.id_company LIKE "%,'.ht($date_new_ada[$ada]).',%")or(b.id_company LIKE "%,'.ht($date_new_ada[$ada]).'")or(b.id_company="'.ht($date_new_ada[$ada]).'")) ';
                }

            }
            if($LIKEX!='')
            {
                $LIKEX.=') ';
            }


        }


        $result_status223=mysql_time_query($link,'SELECT a.* from users_commission_trips as a,r_user as b where a.id_users=b.id '.$LIKEX.' and a.date="'.$date_start_while_bonus_last.'"');

        $num223 = $result_status223->num_rows;
        if($result_status223->num_rows!=0)
        {
            for ($i=0; $i<$num223; $i++)
            {
                $row223 = mysqli_fetch_assoc($result_status223);

                $result_status_b=mysql_time_query($link,'SELECT a.* from users_commission_level as a where a.id_users="'.$row223["id_users"].'" and a.sum_start<="'.$row223["sum"].'" and a.sum_end>"'.$row223["sum"].'" and a.dates="'.$date_start_while_bonus_last.'" and a.id_company IN ('.ht($id_company).')');

                //$result_status_b=mysql_time_query($link,'SELECT a.* from users_commission_level as a where a.id_users="'.$row223["id_users"].'" and a.sum_start<="'.$row223["sum"].'" and a.sum_end>"'.$row223["sum"].'" and a.dates="'.$date_start_while.'" and a.id_company="'.ht($id_company).'"');

                if($result_status_b->num_rows==0) {

                    //$result_status_b = mysql_time_query($link, 'SELECT a.* from users_commission_level as a where a.id_users=0 and a.sum_start<="' . $row223["sum"] . '" and a.sum_end>"' . $row223["sum"] . '" and a.dates="' . $date_start_while . '" and a.id_company="' . ht($id_company) . '"');

                    $result_status_b = mysql_time_query($link, 'SELECT a.* from users_commission_level as a where a.id_users=0 and a.sum_start<="' . $row223["sum"] . '" and a.sum_end>"' . $row223["sum"] . '" and a.dates="' . $date_start_while_bonus_last . '" and a.id_company IN (' . ht($id_company) . ')');


                }
                if($result_status_b->num_rows!=0)
                {
                    $row_status_b = mysqli_fetch_assoc($result_status_b);
                    if($row_status_b["level"]!=1)
                    {
                        $bonus=$bonus+(($row223["sum"]*$row_status_b["proc"])/100);
                    }
                }


                if($row223["sum_fix"]!=0)
                {
                    $fix=$fix+$row223["sum_fix"];
                }
            }
        }


        $date_start_while=date_step_sql_more($date_start_while,'+1m');

  }


}
//echo($bonus);
  $rasx=$rasx+$bonus+$fix;
  if($bonus!=0)
  {

      $raz_array[]=['name'=>'Выплата Бонусов','val'=>round($bonus)];
  }

  //echo($fix);

  if($fix!=0)
  {

      $raz_array[]=['name'=>'Фиксированные выплаты','val'=>round($fix)];
  }







  //доходы
  //доходы
  //доходы
  //доходы
  //доходы
  //доходы
  //доходы
  //доходы
  //доходы
  //доходы
  //доходы
  //доходы
  //доходы
  //доходы
  //доходы
  //доходы
  //доходы
  //доходы
  //доходы
  //доходы
  //доходы
  //доходы
  //доходы
  //доходы
  //доходы
  //доходы
  //доходы
  //доходы
  //доходы
  //доходы





  $doxod_array=array();

  $dox=0;
  $result_uu = mysql_time_query($link, 'select sum(A.sum) as ss  from finance_operation as A where A.income=1 and A.visible=1 and A.id_a_company IN ('.ht($id_company).') and  A.date>="' . ht($date_start) . '" and  A.date<"' . ht($date_end) . '"');
  $num_results_uu = $result_uu->num_rows;

  if ($num_results_uu != 0) {
      $row_uu = mysqli_fetch_assoc($result_uu);
      if($row_uu["ss"]!='') {
          $dox = $row_uu["ss"];
      }
  }



  $LIKEX='';
  if(is_numeric($id_company))
  {
      $LIKEX=' and ((b.id_company LIKE "'.ht($id_company).',%")or(b.id_company LIKE "%,'.ht($id_company).',%")or(b.id_company LIKE "%,'.ht($id_company).'")or(b.id_company="'.ht($id_company).'")) ';
  } else
  {
      $date_new_ada = explode(",", ht($id_company));
      for ($ada = 0; $ada < count($date_new_ada); $ada++) {

          if($LIKEX=='')
          {
              $LIKEX=' and ( ((b.id_company LIKE "'.ht($date_new_ada[$ada]).',%")or(b.id_company LIKE "%,'.ht($date_new_ada[$ada]).',%")or(b.id_company LIKE "%,'.ht($date_new_ada[$ada]).'")or(b.id_company="'.ht($date_new_ada[$ada]).'")) ';
          } else
          {
              $LIKEX.='or ((b.id_company LIKE "'.ht($date_new_ada[$ada]).',%")or(b.id_company LIKE "%,'.ht($date_new_ada[$ada]).',%")or(b.id_company LIKE "%,'.ht($date_new_ada[$ada]).'")or(b.id_company="'.ht($date_new_ada[$ada]).'")) ';
          }

      }
      if($LIKEX!='')
      {
          $LIKEX.=') ';
      }


  }

  //доходы с бонусов
  $dox_bonus =0;
  $dox_fix=0;
  $result_status22=mysql_time_query($link,'SELECT sum(a.sum) as summ,sum(a.sum_com) as summ_fix from users_commission_trips as a,r_user as b where a.id_users=b.id '.$LIKEX.' and  not(a.id_users=0) and a.date>="' . ht($date_start) . '" and  a.date<"' . ht($date_end) . '"');

  $num_results_22 = $result_status22->num_rows;

  if ($num_results_22 != 0) {
      $row_uu = mysqli_fetch_assoc($result_status22);
      if($row_uu["summ"]!='') {
          $dox_bonus = $row_uu["summ"];
      }
      if($row_uu["summ_fix"]!='') {
          $dox_fix = $row_uu["summ_fix"];
      }

  }
  $dox=$dox+$dox_bonus+$dox_fix;
  if($dox_bonus!=0)
  {

      $doxod_array[]=['name'=>'Комиссии с продаж менеджеров','val'=>round(($dox_bonus))];
  }
  if($dox_fix!=0)
  {
      $doxod_array[]=['name'=>'Комиссии с продаж с фиксированной оплатой','val'=>round(($dox_fix))];
  }

  //echo($dox_bonus);

  //вывод денег
  $viv=0;
  $result_uu = mysql_time_query($link, 'select sum(A.sum) as ss  from finance_operation as A where A.income=2 and A.visible=1 and A.id_a_company IN ('.ht($id_company).') and  A.date>="' . ht($date_start) . '" and  A.date<"' . ht($date_end) . '"');
  $num_results_uu = $result_uu->num_rows;

  if ($num_results_uu != 0) {
      $row_uu = mysqli_fetch_assoc($result_uu);
      if($row_uu["ss"]!='') {
          $viv = $row_uu["ss"];
      }
  }


  //подсчитаем прибыль
  $pri=$dox-$rasx;
  $sim='';
  if($pri>0)
  {
      $sim='+';
  }
  if($pri<0)
  {
      $sim='-';
  }

  //планы за период
  $ss=0;
  $ss1=0;
  $result_uu = mysql_time_query($link, 'select sum(A.income) as ss,sum(A.expense) as ss1   from finance_plane as A where A.id_a_company IN ('.ht($id_company).') and  A.date>="' . ht($date_start) . '" and  A.date<"' . ht($date_end) . '"');
  $num_results_uu = $result_uu->num_rows;

  if ($num_results_uu != 0) {
      $row_uu = mysqli_fetch_assoc($result_uu);
      if($row_uu["ss"]!='') {
          $ss = $row_uu["ss"];
      }
      if($row_uu["ss1"]!='') {
          $ss1 = $row_uu["ss1"];
      }
  }

  $max = max($rasx, $dox, $ss, $ss1);

  if($rasx!=$max) { $rasx1=round($rasx*100/$max); } else {$rasx1=100;}
  if($dox!=$max) { $dox1=round($dox*100/$max); } else {$dox1=100;}
  if($ss!=$max) { $ss11=round($ss*100/$max); } else {$ss11=100;}
  if($ss1!=$max) { $ss12=round($ss1*100/$max); } else {$ss12=100;}
  $class_one='';
  if($dox<$ss) {
      $class_one = 'two-gr-line';
  }

  $dox_format=rtrim(rtrim(number_format(($dox), 2, '.', ' '),'0'),'.');
if($dox_format=='') {$dox_format=0;}

  $dplane_format=rtrim(rtrim(number_format(($ss), 2, '.', ' '),'0'),'.');
  if($dplane_format=='') {$dplane_format=0;}

  $plane_ccc='js-place-finance';
  $plane_ccco='Изменить план';

  if(($more_city==1)and($_COOKIE["cc_town".$id_user]==0)) {

      $plane_ccc='';
      $plane_ccco='План';

  }


  $graf_title_one=' <div class="title-graf '.$class_one.'"><div><span class="cost_circle">+'.$dox_format.'</span>(факт)</div><div class="plan-f '.$plane_ccc.'" data-tooltip="'.$plane_ccco.'"><span class="cost_circle">+'.$dplane_format.'</span>(план)</div></div>';
  $graf_title_two='';
  if($dox<$ss)
  {
      $graf_title_two=$graf_title_one;
      $graf_title_one='';
  }


  echo'<div class="help_div da_book1"><div class="not_boolingh"></div><span class="h5"><span>За текущий месяц добавляем в расходы бонусы и фиксированные выплаты за предыдущий месяц. Доходами же является комиссия за текущий месяц.</span></span></div>';

echo'<div class="oka_fact finance-index"><div class="gr-50 js-fin-0"><div class="two-finance">

<div class="h1-fin">Доходы и Расходы';

if($more_mon==1)
{
    echo'<span class="more-month-fin">('.date_fik($date_start).' - '.date_fik($date_end).')</span>';
}

echo'</div>

<div class="fin-na-100">
<div class="fin-50">
<label>Прибыль</label>
<span class="cost_circle"><i>'.$sim.'</i>'.rtrim(rtrim(number_format((abs($pri)), 2, '.', ' '),'0'),'.').'</span>
</div>
<div class="fin-50">
<label>Вывод денег</label>
<span class="cost_circle">'.rtrim(rtrim(number_format((abs($viv)), 2, '.', ' '),'0'),'.').'</span>
</div>
</div>


<div class="finance-line">
<label>Доходы</label>
<div class="finance-graf">

<div class="line-fin green-fin" rel_w="'.$dox1.'"  style="width:0%">'.$graf_title_one.'</div>
<div class="line-fin green-l-fin"  rel_w="'.$ss11.'" style="width:0%">'.$graf_title_two.'</div>

</div>';


  $class_one='';
  if($rasx<$ss1) {
      $class_one = 'two-gr-line';
  }

  $dox_format=rtrim(rtrim(number_format(($rasx), 2, '.', ' '),'0'),'.');
  if($dox_format=='') {$dox_format=0;}
  $dplane_format=rtrim(rtrim(number_format(($ss1), 2, '.', ' '),'0'),'.');
  if($dplane_format=='') {$dplane_format=0;}


  $plane_ccc='js-place-finance';
  $plane_ccco='Изменить план';

  if(($more_city==1)and($_COOKIE["cc_town".$id_user]==0)) {

      $plane_ccc='';
      $plane_ccco='Общий План';

  }


  $graf_title_one=' <div class="title-graf '.$class_one.'"><div><span class="cost_circle">-'.$dox_format.'</span>(факт)</div><div class="plan-f '.$plane_ccc.'" data-tooltip="'.$plane_ccco.'"><span class="cost_circle">-'.$dplane_format.'</span>(план)</div></div>';

  $graf_title_two='';
  if($rasx<$ss1)
  {
      $graf_title_two=$graf_title_one;
      $graf_title_one='';
  }


  echo'<label style="margin-top: 20px;">Расходы</label>
<div class="finance-graf">

<div class="line-fin red-fin" rel_w="'.$rasx1.'" style="width:0%">'.$graf_title_one.'</div>
<div class="line-fin orance-fin" rel_w="'.$ss12.'" style="width:0%">'.$graf_title_two.'</div>

</div>


</div>



</div></div><div class="gr-50 js-fin-1"><div class="two-finance"><div class="h1-fin">Кол-во продаж</div>

<div id="chartdiv2"></div>';

  $xy=array();
  if($more_mon==1)
  {

  $date_start_while=$date_start;
  while ($date_start_while!= $date_end) {

      //какой то период выбран значит по нему и выводим
      $date_start_while22=date_step_sql_more($date_start_while,'+1m');

      $LIKEX='';
      if(is_numeric($id_company))
      {
          $LIKEX=' and ((b.id_company LIKE "'.ht($id_company).',%")or(b.id_company LIKE "%,'.ht($id_company).',%")or(b.id_company LIKE "%,'.ht($id_company).'")or(b.id_company="'.ht($id_company).'")) ';
      } else
      {
          $date_new_ada = explode(",", ht($id_company));
          for ($ada = 0; $ada < count($date_new_ada); $ada++) {

              if($LIKEX=='')
              {
                  $LIKEX=' and ( ((b.id_company LIKE "'.ht($date_new_ada[$ada]).',%")or(b.id_company LIKE "%,'.ht($date_new_ada[$ada]).',%")or(b.id_company LIKE "%,'.ht($date_new_ada[$ada]).'")or(b.id_company="'.ht($date_new_ada[$ada]).'")) ';
              } else
              {
                  $LIKEX.='or ((b.id_company LIKE "'.ht($date_new_ada[$ada]).',%")or(b.id_company LIKE "%,'.ht($date_new_ada[$ada]).',%")or(b.id_company LIKE "%,'.ht($date_new_ada[$ada]).'")or(b.id_company="'.ht($date_new_ada[$ada]).'")) ';
              }

          }
          if($LIKEX!='')
          {
              $LIKEX.=') ';
          }


      }



      $result_status22 = mysql_time_query($link, 'SELECT sum(a.sum) as summ,sum(a.sum_com) as summ_fix from users_commission_trips as a,r_user as b where a.id_users=b.id '.$LIKEX.' and  not(a.id_users=0) and a.date>="' . ht($date_start_while) . '" and  a.date<"' . ht($date_start_while22) . '"');


      $num_results_uu = $result_status22->num_rows;
$hits=0;
      $fixs=0;
      if ($num_results_uu != 0) {
         $row_uu = mysqli_fetch_assoc($result_status22);

          if (($row_uu["summ"] != '') and ($row_uu["summ"] != 0)) {
                  $hits=round($row_uu["summ"]);
          }
          if (($row_uu["summ_fix"] != '') and ($row_uu["summ_fix"] != 0)) {
              $fixs=round($row_uu["summ_fix"]);
          }

      }

      $result_uu = mysql_time_query($link, 'select count(id) as ss from trips where visible=1 and id_a_company IN ('.ht($id_company).') and datecreate>="'.$date_start_while.'" and datecreate<"'.$date_start_while22.'"');
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


      $xy[] = ['views' => $views, 'hits' => ($hits+$fixs), 'date' => $date_start_while];
      $date_start_while=date_step_sql_more($date_start_while,'+1m');
    }
  } else
  {
//echo($date_end);
      $date_start_while=date_step_sql_more($date_end,'-5m');;

      while ($date_start_while!= $date_end) {

          //какой то период выбран значит по нему и выводим
          $date_start_while22=date_step_sql_more($date_start_while,'+1m');

          $LIKEX='';
          if(is_numeric($id_company))
          {
              $LIKEX=' and ((b.id_company LIKE "'.ht($id_company).',%")or(b.id_company LIKE "%,'.ht($id_company).',%")or(b.id_company LIKE "%,'.ht($id_company).'")or(b.id_company="'.ht($id_company).'")) ';
          } else
          {
              $date_new_ada = explode(",", ht($id_company));
              for ($ada = 0; $ada < count($date_new_ada); $ada++) {

                  if($LIKEX=='')
                  {
                      $LIKEX=' and ( ((b.id_company LIKE "'.ht($date_new_ada[$ada]).',%")or(b.id_company LIKE "%,'.ht($date_new_ada[$ada]).',%")or(b.id_company LIKE "%,'.ht($date_new_ada[$ada]).'")or(b.id_company="'.ht($date_new_ada[$ada]).'")) ';
                  } else
                  {
                      $LIKEX.='or ((b.id_company LIKE "'.ht($date_new_ada[$ada]).',%")or(b.id_company LIKE "%,'.ht($date_new_ada[$ada]).',%")or(b.id_company LIKE "%,'.ht($date_new_ada[$ada]).'")or(b.id_company="'.ht($date_new_ada[$ada]).'")) ';
                  }

              }
              if($LIKEX!='')
              {
                  $LIKEX.=') ';
              }


          }


          $result_status22 = mysql_time_query($link, 'SELECT sum(a.sum) as summ,sum(a.sum_com) as summ_fix from users_commission_trips as a,r_user as b where a.id_users=b.id '.$LIKEX.' and  not(a.id_users=0) and a.date>="' . ht($date_start_while) . '" and  a.date<"' . ht($date_start_while22) . '"');


          $num_results_uu = $result_status22->num_rows;
          $hits=0;
          $fixs=0;
          if ($num_results_uu != 0) {
              $row_uu = mysqli_fetch_assoc($result_status22);
              if (($row_uu["summ"] != '') and ($row_uu["summ"] != 0)) {
                  $hits=round($row_uu["summ"]);
              }
              if (($row_uu["summ_fix"] != '') and ($row_uu["summ_fix"] != 0)) {
                  $fixs=round($row_uu["summ_fix"]);
              }

          }

          $result_uu = mysql_time_query($link, 'select count(id) as ss from trips where visible=1 and id_a_company IN ('.ht($id_company).') and datecreate>="'.$date_start_while.'" and datecreate<"'.$date_start_while22.'"');
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


          $xy[] = ['views' => $views, 'hits' => ($hits+$fixs), 'date' => $date_start_while];
          $date_start_while=date_step_sql_more($date_start_while,'+1m');
      }

  }

  $json2 = json_encode($xy);
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

//

// Increase contrast by taking evey second color
chart2.colors.step = 1;

// Add data
chart2.data = ' . $json2 . ';
//chart2.dateFormatter.dateFormat = "yyyy-MM-dd";
chart2.dataDateFormat = "YYYY-MM-DD";
/*
dataxx = [{
  "val": 90,
  "name":12000
}, {
  "val": 90,
  "name":12000
}, {
  "val": 90,
  "name":12000
}];
*/
/*
chart2.data = [{
  "date": "2018-05-01",
  "views": 90,
  "hits":12000
}, {
  "date": "2018-06-01",
  "views": 51,
  "hits":124644
}, {
  "date": "2018-07-01",
  "views": 65,
  "hits":174644
}];
*/

// Create axes

var dateAxis = chart2.xAxes.push(new am4charts.DateAxis());
dateAxis.renderer.minGridDistance = 20;
dateAxis.dateFormats.setKey("day", "MMMM");


// Create series
function createAxisAndSeries(field, name, opposite, bullet) {
  var valueAxis = chart2.yAxes.push(new am4charts.ValueAxis());
  if(chart2.yAxes.indexOf(valueAxis) != 0){
  	valueAxis.syncWithAxis = chart2.yAxes.getIndex(0);
  }
  
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
      
      
      var triangle = bullet.createChild(am4core.Triangle);
      triangle.stroke = interfaceColors.getFor("background");
      triangle.strokeWidth = 2;
      triangle.direction = "top";
      triangle.width = 12;
      triangle.height = 12;
    
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
createAxisAndSeries("views", "Продажи", false, "");


// Add legend
chart2.legend = new am4charts.Legend();

// Add cursor
chart2.cursor = new am4charts.XYCursor();

 // var axisTooltip = categoryAxis.tooltip;
//axisTooltip.background.fill = am4core.color("#ffffff");
/*
         chart2.legend.getFillFromObject = false;
         chart2.legend.background.fill = am4core.color("#fff");
         chart2.legend.label.fontSize = 12;
         chart2.legend.label.fill = am4core.color("#434443");
         chart2.legend.label.fontFamily = "GEInspiraBold";
*/

// generate some random data, quite different range
function generateChartData() {
  var chartData = [];
  var firstDate = new Date();
  firstDate.setDate(firstDate.getDate() - 100);
  firstDate.setHours(0, 0, 0, 0);


  var hits = 2900;
  var views = 18700;

  for (var i = 0; i < 5; i++) {
    // we create date objects here. In your data, you can have date strings
    // and then set format of your dates using chart.dataDateFormat property,
    // however when possible, use date objects, as this will speed up chart rendering.
    var newDate = new Date(firstDate);
    newDate.setDate(newDate.getDate() + i);

    hits += Math.round((Math.random()<0.5?1:-1)*Math.random()*10);
    views += Math.round((Math.random()<0.5?1:-1)*Math.random()*10);

    chartData.push({
      date: newDate,
      hits: hits,
      views: views
    });
  }
  return chartData;
}

}); // end am4core.ready()

</script>



</div></div></div><div class="oka_fact finance-index"><div class="gr-50 js-fin-2"><div class="two-finance"><div class="h1-fin">Структура доходов</div>';


  $result_uu = mysql_time_query($link, 'select distinct A.id_type,C.name,(select sum(b.sum) from finance_operation as b where b.income=1 and b.id_type=A.id_type and b.visible=1 and b.id_a_company IN ('.ht($id_company).') and  b.date>="' . ht($date_start) . '" and  b.date<"' . ht($date_end) . '" ) as ss  from finance_operation as A, finance_operation_type as C where C.id=A.id_type and A.income=1 and A.visible=1 and A.id_a_company IN ('.ht($id_company).') and  A.date>="' . ht($date_start) . '" and  A.date<"' . ht($date_end) . '"');
  $num_results_uu = $result_uu->num_rows;

  if ($num_results_uu != 0) {
  while ($row_uu = mysqli_fetch_assoc($result_uu)) {
      if (($row_uu["ss"] != '') and ($row_uu["ss"] != 0)) {
          $doxod_array[] = ['name' => $row_uu["name"], 'val' => round($row_uu["ss"])];
      }
  }
  }
  //сортируем двухмерный массив
  $volume  = array_column($doxod_array, 'val');
  $edition = array_column($doxod_array, 'name');

  array_multisort($volume, SORT_DESC, $edition, SORT_ASC, $doxod_array);

  $json = json_encode($doxod_array);

?>

 <script type="text/javascript">


         /**
          * ---------------------------------------
          * This demo was created using amCharts 4.
          *
          * For more information visit:
          * https://www.amcharts.com/
          *
          * Documentation is available at:
          * https://www.amcharts.com/docs/v4/
          * ---------------------------------------
          */

// Create chart instance
         am4core.useTheme(am4themes_animated);

         window.chart = am4core.create("chartdiv", am4charts.PieChart);
         chart.data = <?php echo $json;?>;

// Add and configure Series

         var pieSeries = chart.series.push(new am4charts.PieSeries());
         pieSeries.dataFields.value = "val";
         pieSeries.dataFields.category = "name";

         pieSeries.labels.template.disabled = true;
         //pieSeries.ticks.template.disabled = true;

         pieSeries.tooltip.getFillFromObject = false;
         pieSeries.tooltip.background.fill = am4core.color("#fff");
         pieSeries.tooltip.label.fontSize = 12;
         pieSeries.tooltip.label.fill = am4core.color("#434443");
         pieSeries.tooltip.label.fontFamily = 'GEInspiraBold';

         chart.seriesContainer.zIndex = -1;
         chart.innerRadius = am4core.percent(70);

         var container = new am4core.Container();
         container.parent = pieSeries;
         container.horizontalCenter = "middle";
         container.verticalCenter = "middle";
         container.width = am4core.percent(20) / Math.sqrt(2);
         container.fill = "white";

         var label1 = new am4core.Label();
         label1.parent = container;
         //label1.text = "Доходы";
         label1.html = "<span class=\"finn-er\">Доходы</span>";
         label1.y = 10;
         label1.horizontalCenter = "middle";
         label1.fontSize = 20;

         var label = new am4core.Label();
         label.parent = container;
         //label.text = "{values.value.sum} ₽";
         label.html = "<span class=\"finn-er1\">{values.value.sum} <i>₽</i></span>";
         label.horizontalCenter = "middle";
         label.verticalCenter = "middle";
         label.fontSize = 30;

         function legendCreate() {
             // populate our custom legend when chart renders
             $('#legenddiv').empty();
             window.chart.customLegend = document.getElementById('legenddiv');
             pieSeries.dataItems.each(function (row, i) {
                 var color = chart.colors.getIndex(i);
                 var percent = Math.round(Math.round(row.values.value.percent * 100) / 100);
                 var value = row.value;
                 legenddiv.innerHTML += '<div class="legend-item lege-' + i + '" id="legend-item-' + i + '" onclick="toggleSlice(' + i + ');" onmouseover="hoverSlice(' + i + ');" onmouseout="blurSlice(' + i + ');" style=""><div class="legend-value">' + percent + '%</div><div class="legend-marker" style="background: ' + color + '"></div><div class="name-legend">' + row.category + '</div></div>';
             });
         }

         // Create custom legend
         chart.events.on("ready", function (event) {

             legendCreate();


         });

         function toggleSlice(item) {
             var slice = pieSeries.dataItems.getIndex(item);
             if (slice.visible) {
                 slice.hide();
                 $('.lege-' + item).addClass('hide-legend');
             } else {
                 slice.show();
                 $('.lege-' + item).removeClass('hide-legend');
             }
         }

         function hoverSlice(item) {
             var slice = pieSeries.slices.getIndex(item);
             slice.isHover = true;
         }

         function blurSlice(item) {
             var slice = pieSeries.slices.getIndex(item);
             slice.isHover = false;
         }

 </script>
<?

echo'<div class="fin-na-100">
<div class="fin-50"><div id="chartdiv"></div></div><div class="fin-50" id="legenddiv"></div></div>';

echo'</div></div>

<div class="gr-50 js-fin-3"><div class="two-finance"><div class="h1-fin">Структура Расходов</div>';

  $result_uu = mysql_time_query($link, 'select distinct A.id_type,C.name,(select sum(b.sum) from finance_operation as b where b.income=0 and b.id_type=A.id_type and b.visible=1 and b.id_a_company IN ('.ht($id_company).') and  b.date>="' . ht($date_start) . '" and  b.date<"' . ht($date_end) . '" ) as ss  from finance_operation as A, finance_operation_type as C where C.id=A.id_type and A.income=0 and A.visible=1 and A.id_a_company IN ('.ht($id_company).') and  A.date>="' . ht($date_start) . '" and  A.date<"' . ht($date_end) . '"');



  $num_results_uu = $result_uu->num_rows;

  if ($num_results_uu != 0) {
while ($row_uu = mysqli_fetch_assoc($result_uu)) {
    if (($row_uu["ss"] != '') and ($row_uu["ss"] != 0)) {
        $raz_array[] = ['name' => $row_uu["name"], 'val' => round($row_uu["ss"])];
    }
}
  }
$volume  = array_column($raz_array, 'val');
$edition = array_column($raz_array, 'name');

array_multisort($volume, SORT_DESC, $edition, SORT_ASC, $raz_array);

  $json1 = json_encode($raz_array);
?>

 <script type="text/javascript">


         /**
          * ---------------------------------------
          * This demo was created using amCharts 4.
          *
          * For more information visit:
          * https://www.amcharts.com/
          *
          * Documentation is available at:
          * https://www.amcharts.com/docs/v4/
          * ---------------------------------------
          */

// Create chart instance
         //am4core.useTheme(am4themes_animated);

         window.chart1 = am4core.create("chartdiv1", am4charts.PieChart);
         chart1.data = <?php echo $json1;?>;

// Add and configure Series

         pieSeries1 = chart1.series.push(new am4charts.PieSeries());
         pieSeries1.dataFields.value = "val";
         pieSeries1.dataFields.category = "name";
         pieSeries1.labels.template.disabled = true;
         //pieSeries.ticks.template.disabled = true;

         pieSeries1.tooltip.getFillFromObject = false;
         pieSeries1.tooltip.background.fill = am4core.color("#fff");
         pieSeries1.tooltip.label.fontSize = 12;
         pieSeries1.tooltip.label.fill = am4core.color("#434443");
         pieSeries1.tooltip.label.fontFamily = 'GEInspiraBold';

         chart1.seriesContainer.zIndex = -1;
         chart1.innerRadius = am4core.percent(70);

         var container1 = new am4core.Container();
         container1.parent = pieSeries1;
         container1.horizontalCenter = "middle";
         container1.verticalCenter = "middle";
         container1.width = am4core.percent(20) / Math.sqrt(2);
         container1.fill = "white";

         var label11 = new am4core.Label();
         label11.parent = container1;
         //label1.text = "Доходы";
         label11.html = "<span class=\"finn-er\">Расходы</span>";
         label11.y = 10;
         label11.horizontalCenter = "middle";
         label11.fontSize = 20;

         var label22 = new am4core.Label();
         label22.parent = container1;
         //label.text = "{values.value.sum} ₽";
         label22.html = "<span class=\"finn-er1\">{values.value.sum} <i>₽</i></span>";
         label22.horizontalCenter = "middle";
         label22.verticalCenter = "middle";
         label22.fontSize = 30;

         function legendCreate1() {
             // populate our custom legend when chart renders
             $('#legenddiv1').empty();
             window.chart1.customLegend = document.getElementById('legenddiv1');

             pieSeries1.dataItems.each(function (row, i) {
                 var color = window.chart1.colors.getIndex(i);
                 var percent = Math.round(Math.round(row.values.value.percent * 100) / 100);
                 var value = row.value;
                 legenddiv1.innerHTML += '<div class="legend-item legex-' + i + '" id="legend-item-' + i + '" onclick="toggleSlice1(' + i + ');" onmouseover="hoverSlice1(' + i + ');" onmouseout="blurSlice1(' + i + ');" style=""><div class="legend-value">' + percent + '%</div><div class="legend-marker" style="background: ' + color + '"></div><div class="name-legend">' + row.category + '</div></div>';
             });
         }

         // Create custom legend
         chart1.events.on("ready", function (event) {
             legendCreate1();
         });

         function toggleSlice1(item) {
             var slice = pieSeries1.dataItems.getIndex(item);
             if (slice.visible) {
                 slice.hide();
                 $('.legex-' + item).addClass('hide-legend');
             } else {
                 slice.show();
                 $('.legex-' + item).removeClass('hide-legend');
             }
         }

         function hoverSlice1(item) {
             var slice = pieSeries1.slices.getIndex(item);
             slice.isHover = true;
         }

         function blurSlice1(item) {
             var slice = pieSeries1.slices.getIndex(item);
             slice.isHover = false;
         }

 </script>
<?

echo'<div class="fin-na-100">
<div class="fin-50"><div id="chartdiv1"></div></div><div class="fin-50" id="legenddiv1"></div></div>';


echo'</div></div>


</div>';




$result_uu = mysql_time_query($link, 'select A.*,C.name  from finance_operation as A, finance_operation_type as C where C.id=A.id_type and A.income=0 and A.visible=1 and A.id_a_company IN ('.ht($id_company).') and  A.date>="' . ht($date_start) . '" and  A.date<"' . ht($date_end) . '" order by A.date_create desc');

$num_results_uu = $result_uu->num_rows;

if ($result_uu) {
    $i = 0;
    //echo('<div class="px_bg_trips" style="display: block;">');
    $query_string='';
    while ($row_uu = mysqli_fetch_assoc($result_uu)) {
        //echo("!");
        $edit_moo=1;
        include $url_system.'finance/code/block_buy.php';


    }

}
if($num_results_uu!=0) {
    echo '<div class="px_bg_fin js-oper-0" style="display: block; margin-top:20px;"><div class="h1-finx">Операции по расходам <span class="menu-09-count-fin">' . $num_results_uu . '</span></div>' . $query_string . '</div>';
} else
{
    echo '<div class="px_bg_fin js-oper-0" style="display: none; margin-top:20px;"><div class="h1-finx">Операции по расходам <span class="menu-09-count-fin">0</span></div></div>';
}




$result_uu = mysql_time_query($link, 'select A.*,C.name  from finance_operation as A, finance_operation_type as C where C.id=A.id_type and A.income=1 and A.visible=1 and A.id_a_company IN ('.ht($id_company).') and  A.date>="' . ht($date_start) . '" and  A.date<"' . ht($date_end) . '" order by A.date_create desc');

$num_results_uu = $result_uu->num_rows;

if ($result_uu) {
    $i = 0;
    $query_string='';
    while ($row_uu = mysqli_fetch_assoc($result_uu)) {
        //echo("!");
        $edit_moo=1;
        include $url_system.'finance/code/block_buy.php';


    }

}
if($num_results_uu!=0) {
    echo '<div class="px_bg_fin js-oper-1" style="display: block; margin-top:20px;"><div class="h1-finx">Операции по Доходам <span class="menu-09-count-fin">' . $num_results_uu . '</span></div>' . $query_string . '</div>';
} else
{
    echo '<div class="px_bg_fin js-oper-1" style="display: none; margin-top:20px;"><div class="h1-finx">Операции по Доходам <span class="menu-09-count-fin">0</span></div></div>';
}

$result_uu = mysql_time_query($link, 'select A.*  from finance_operation as A where A.income=2 and A.visible=1 and A.id_a_company IN ('.ht($id_company).') and  A.date>="' . ht($date_start) . '" and  A.date<"' . ht($date_end) . '" order by A.date_create desc' );

$num_results_uu = $result_uu->num_rows;

if ($result_uu) {
    $i = 0;
    $query_string='';
    while ($row_uu = mysqli_fetch_assoc($result_uu)) {
        //echo("!");
        $edit_moo=1;
        include $url_system.'finance/code/block_buy.php';


    }

}
if($num_results_uu!=0) {
    echo '<div class="px_bg_fin js-oper-2" style="display: block; margin-top:20px;"><div class="h1-finx">Вывод денег <span class="menu-09-count-fin">' . $num_results_uu . '</span></div>' . $query_string . '</div>';
} else
{
    echo '<div class="px_bg_fin js-oper-2" style="display: none; margin-top:20px;"><div class="h1-finx">Вывод денег <span class="menu-09-count-fin">0</span></div></div>';
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
//$('.circlestat').circliful();
 });
</script>


</body></html>

