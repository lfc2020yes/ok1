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
<div class="oka_block">
<?
	
//сегодня задачи и напоминания
$max_day_ring=3;
	$flag_est_task=0;
$pros=0;		
//общие задачи, личные задачи невыполненные		
$title_task = array("Задачи на Сегодня", "Завтра", "Послезавтра");		
for ($p=0; $p<3; $p++)
{
		$date_end_plus3=date_step_sql('Y-m-d','+'.$p.'d');
		$result_8 = mysql_time_query($link,'
select * from( 
(
select A.*,0 as flag from  task_new as A WHERE A.id_user_responsible="'.ht($id_user).'" and A.visible=1 and A.id_a_company="'.ht($id_company).'" and A.status=0 and  LOWER(A.ring_datetime) LIKE "'.$date_end_plus3.' %"
)
UNION
(
select A.*,1 as flag from  task_new as A WHERE A.id_user_responsible LIKE "'.$id_user.',%" and A.visible=1 and A.id_a_company="'.ht($id_company).'" and A.status=0 and  LOWER(A.ring_datetime) LIKE "'.$date_end_plus3.' %"
)
UNION
(
select A.*,1 as flag from  task_new as A WHERE A.id_user_responsible LIKE "%,'.$id_user.',%" and A.visible=1 and A.id_a_company="'.ht($id_company).'" and A.status=0 and  LOWER(A.ring_datetime) LIKE "'.$date_end_plus3.' %"
)
UNION
(
select A.*,1 as flag from  task_new as A WHERE A.id_user_responsible LIKE "%,'.$id_user.'" and A.visible=1 and A.id_a_company="'.ht($id_company).'" and A.status=0 and  LOWER(A.ring_datetime) LIKE "'.$date_end_plus3.' %"
)


) Z order by Z.reminder,Z.ring_datetime 

');
	

	
	
$num_8 = $result_8->num_rows;	
$task_cloud ??='';	
if($num_8>0)
{
	$flag_est_task++;
$task_cloud.='<div class="ring_block js-ring-'.$p.'">';	
} else
{
$task_cloud.='<div style="display:none" class="ring_block js-ring-'.$p.'">';	
}
	$task_cloud.='<div class="h1-ring"><span>'.$title_task[$p].'</span><i></i></div>'; 
	if(($num_8-$max_day_ring)>0)
	{
	$task_cloud.='<div class="eshe-ring js-eshe-ring"  max="'.$max_day_ring.'"><span class="ring-x1">еще '.($num_8-$max_day_ring).'</span><span class="ring-x2">Скрыть</span></div>';
	} else
	{
		$task_cloud.='<div style="display:none;"  max="'.$max_day_ring.'" class="eshe-ring js-eshe-ring"><span class="ring-x1"></span><span class="ring-x2">Скрыть</span></div>';
	}
	
	$task_cloud.='<div class="block-ring-x">';
	if(($result_8)and($num_8>0))
{
	$count_ring=0;
	 $class_ring='';
  	 while($row_8 = mysqli_fetch_assoc($result_8)){
				 if($count_ring>=$max_day_ring)
				 {
				  $class_ring='max-day-ring';
				 }

	include $url_system.'task/code/block_index.php';
	$task_cloud.=$task_cloud_block;
	
	
}
		}
$task_cloud.='</div>';
$task_cloud.='</div>';	
	
}

	if($flag_est_task!=0)
	{	
echo'<div class="oka1 task-left js-task-left">';
	} else
	{
echo'<div class="oka1 task-left js-task-left" style="width:100%;">	';	
	}
	

	//echo'<h2>Добро пожаловать в систему заявок, '.$rowxs["name_user"].'!</h2>';

	if((isset($_GET["a"]))and($_GET["a"]=='yes'))
	{
	
$result_txs=mysql_time_query($link,'Select a.name_user,a.timelast,a.id from r_user as a where a.id="'.$id_user.'"');
	            if($result_txs->num_rows!=0)
	            {   
		          $rowxs = mysqli_fetch_assoc($result_txs);
					
				}
	echo'<h2 class="hello">Добро пожаловать в систему задач, '.$rowxs["name_user"].'!</h2>';
		
					echo'<div class="help_div da_book1"><div class="not_boolingh"></div><span class="h5"><span>Не забудьте посмотреть все созданные задачи на сегодня, заявки по которым необходимо перезвонить, оформить документы. Все необходимое можно найти в ваших уведомлениях.</span></span></div>';	
	} else
	{
		$num_7=$num_7 ?? '';
			if($num_7!=0)
	        {	
					//echo'<p>У вас есть нерешенные задачи. Не забудьте посмотреть и исполнить их. Следите за уведомлениями системы, вашей комиссией и бонусами.</p>';
				
				echo'<div class="help_div da_book1"><div class="not_boolingh"></div><span class="h5"><span>У вас есть нерешенные задачи. Не забудьте посмотреть и исполнить их. Следите за уведомлениями системы, вашей комиссией и бонусами.</span></span></div>';
				
			} else
			{
								echo'<div class="help_div da_book1"><div class="not_boolingh"></div><span class="h5"><span>Добавляйте новые заявки, следите за вашей комиссией и бонусами. Ищите ваших клиентов по множеству параметров, отслеживайте время вылетов и много другое.</span></span></div>';
			}
	}

//вывод рейтинг менеджеров и других работников
//|
//V

?>
<div class="winner_2020">

<span class="title">Рейтинг менеджеров</span>
<div class="rating">

<div class="rating-model">
    <div class="model-1">
    <?
    $result_uu = mysql_time_query($link, 'select A.* from rating as A where A.visible=1 and A.id_a_company="'.$id_company.'" order by A.displayOrder');
    $query_rating='';
    if ($result_uu) {
        $i = 0;
        while ($row_uu = mysqli_fetch_assoc($result_uu)) {

            $query_rating.='<div class="link-rating" id_r="'.$row_uu["number"].'">'.$row_uu["name"].'</div>';

            $hide='hide';
            if($row_uu["default"]==1) {  $hide='';  }
            echo'<div class="js-rating '.$hide.'" idrr="'.$row_uu["number"].'"> <span class="title_name">'.$row_uu["name"].'</span>';
            $date_start_plus3 = date_step_sql('Y-m-d', '-1d');
            $result_uu1 = mysql_time_query($link, 'select A.*,B.name_user from users_rating as A,r_user as B where B.id=A.id_users and A.date="'.$date_start_plus3.'" and A.id_a_company="'.$id_company.'" and A.number_rating="' . ht($row_uu["number"]) . '" order by A.numbers');

            if ($result_uu1) {
                $i = 0;
                while ($row_uu1 = mysqli_fetch_assoc($result_uu1)) {

                    echo'<div class="block-rating">
<div class="number">'.$row_uu1["numbers"].'</div>';
$class_stt='r_center';

                    if($row_uu1["numbers_old"]!=0)
                    {
                        $razn=abs($row_uu1["numbers_old"]-$row_uu1["numbers"]);
                    }
                    $toolt='';
if(($row_uu1["numbers"]>$row_uu1["numbers_old"])and($row_uu1["numbers_old"]!=0)) { $class_stt='r_bottom'; $toolt='data-tooltip="минус '.$razn.' '.PadejNumber($razn,'позиция,позиции,позиций').'"'; }
if($row_uu1["numbers"]<$row_uu1["numbers_old"]) { $class_stt='r_top'; $toolt='data-tooltip="плюс '.$razn.' '.PadejNumber($razn,'позиция,позиции,позиций').'"'; }

$win='';





                    $date_start_plus2 = date_step_sql('Y-m-', '-1m').'01';
                    $result_uu2 = mysql_time_query($link, 'select A.id from users_rating_record as A where A.id_a_company="'.$id_company.'" and A.number_rating="' . ht($row_uu["number"]) . '" and A.date="'.$date_start_plus2.'" and A.id_users_winner="' . ht($row_uu1["id_users"]) . '"');
                    $num_results_uu2 = $result_uu2->num_rows;

                    if ($num_results_uu2 != 0) {
                        //$date_start_plus2 = date_step_sql('m', '-1m');
                        switch(date_step_sql('m', '-1m'))
                        {
                            case "01": { $winner_monch="январь";  break; }
                            case "02": { $winner_monch="февраль"; break; }
                            case "03": { $winner_monch="март"; break; }
                            case "04": { $winner_monch="апрель"; break; }
                            case "05": { $winner_monch="май"; break; }
                            case "06": {  $winner_monch="июнь"; break; }
                            case "07": {  $winner_monch="июль"; break; }
                            case "08": { $winner_monch1="август"; break; }
                            case "09": { $winner_monch="сентябрь"; break; }
                            case "10": { $winner_monch="октябрь"; break; }
                            case "11": {  $winner_monch="ноябрь"; break; }
                            case "12": {  $winner_monch="декабрь"; break; }
                        }


                        $win='<span data-tooltip="Победитель в прошлом месяце" class="winner">'.$winner_monch.'</span>';
                    }


echo'<div class="top"><span '.$toolt.' class="'.$class_stt.'"><i></i></span></div>
<div class="name">'.$row_uu1["name_user"].$win.'</div>';
if($row_uu1["numbers"]==1)
{
    echo'<div class="ball"><span class="yellow-ball">'.$row_uu1["rates"].'</span></div>';
} else
{
    echo'<div class="ball">'.$row_uu1["rates"].'</div>';
}




//echo'<div class="ball">'.$row_uu1["rates"].'</div>';
echo'</div>';

                }
            }


            echo'</div>';

        }
    }


    ?>
</div>

<div class="model-2"><span class="title_name">Другие рейтинги</span>

    <div class="all-rating js-all-rating">
        <?

        echo ($query_rating);
        ?>

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
	

<strong class="str_f">Интересные данные на сегодня</strong>	

<div class="oka_fact">
	
<div class="gr-50">

<?
	
/*	
$result_scores=mysql_time_query($link,'Select count(a.id) as cc from booking as a where a.visible=1 and a.id_user in('.implode(',',$hie->user).') and a.status NOT IN ("3", "4")');
$row__221= mysqli_fetch_assoc($result_scores);	  
echo'<span class="span-4">'.$row__221["cc"].'</span>';	

$result_scores2=mysql_time_query($link,'Select count(a.id) as cc from booking as a where a.visible=1 and a.id_user in('.implode(',',$hie->user).')');
$row__222= mysqli_fetch_assoc($result_scores2);	 
	
$result_scores3=mysql_time_query($link,'Select count(a.id) as cc from booking as a where a.visible=1 and a.id_user in('.implode(',',$hie->user).') and a.status="3"');
$row__223= mysqli_fetch_assoc($result_scores3);	
*/

$mass_ei=users_hierarchy($id_user,$link);
rm_from_array($id_user,$mass_ei);
$mass_ei= array_unique($mass_ei);

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


$result_scores=mysql_time_query($link,'Select count(A.id) as cc from trips as A where A.visible=1 '.$sql_su5_search.' and A.datecreate LIKE "'.date('Y-m-').'%" ');



$row__221= mysqli_fetch_assoc($result_scores);	  
echo'<span class="span-4">'.$row__221["cc"].'</span>';	
/*
$result_scores2=mysql_time_query($link,'Select count(a.id) as cc from booking as a where a.visible=1 and a.id_object in('.implode(',',$hie->obj).')');
$row__222= mysqli_fetch_assoc($result_scores2);	 
	
$result_scores3=mysql_time_query($link,'Select count(a.id) as cc from booking as a where a.visible=1 and a.id_object in('.implode(',',$hie->obj).') and a.status="3"');
$row__223= mysqli_fetch_assoc($result_scores3);		

	$count_yes =0;
	if($row__222["cc"]!=0)
	{
$count_yes =  round((100*$row__223["cc"])/$row__222["cc"]);
	}
*/



echo'<strong>'.PadejNumber($row__221["cc"],'оформленный тур<br>за '.month_rus1(date('m')).',оформленных тура<br>за '.month_rus(date('m')).',оформленных туров<br>за '.month_rus1(date('m'))).'</strong>';
?>
</div>	
<?
$date_startr=date("Y-m-").'01';
$date_endr=date_step_sql('Y-m-', '+1m').'01';
$ssr=0;

//какой план должен быть
$result_uur = mysql_time_query($link, 'select sum(A.income) as ss   from finance_plane as A where A.id_a_company="'.ht($id_company).'" and  A.date>="' . ht($date_startr) . '" and  A.date<"' . ht($date_endr) . '"');
$num_results_uur = $result_uur->num_rows;

if ($num_results_uur != 0) {
    $row_uur = mysqli_fetch_assoc($result_uur);
    if($row_uur["ss"]!='') {
        $ssr = $row_uur["ss"];
    }
}

//доходы с бонусов
$dox_bonus =0;
$result_status22=mysql_time_query($link,'SELECT sum(a.sum) as summ from users_commission_trips as a,r_user as b where a.id_users=b.id and b.id_company="'.ht($id_company).'" and  not(a.id_users=0) and a.date>="' . ht($date_startr) . '" and  a.date<"' . ht($date_endr) . '"');

$num_results_22 = $result_status22->num_rows;

if ($num_results_22 != 0) {
    $row_uu = mysqli_fetch_assoc($result_status22);
    if($row_uu["summ"]!='') {
        $dox = $row_uu["summ"];
    }
}
$procc=0;
if($ssr!=0) {
    $procc = round(($dox * 100) / $ssr);
}

//кол-во проданный туров в этом месяце
$views=0;
$result_uu = mysql_time_query($link, 'select count(id) as ss from trips where visible=1 and id_a_company="'.ht($id_company).'" and datecreate>="'.$date_startr.'" and datecreate<"'.$date_endr.'"');


$num_results_uu = $result_uu->num_rows;
$views=0;

if ($num_results_uu != 0) {
    $row_uu = mysqli_fetch_assoc($result_uu);
    if (($row_uu["ss"] != '') and ($row_uu["ss"] != 0)) {
        $views=$row_uu["ss"];
    }
}

$sred=0;
if($views!=0) {
    $sred = $dox / $views;
}
//echo($sred);
$eshe_nado=0;
if($sred!=0)
{
    $eshe_nado=round($ssr/$sred) - $views;
}

echo'<div class="gr-50">
    <div class="circle-container"  style="margin-top: -15px;">
        <div class="circlestat" data-dimension="80" data-text="'.$procc.'%" data-width="1" data-fontsize="27" data-percent="'.$procc.'" data-fgcolor="#24c32d" data-bgcolor="rgba(0,0,0,0)" data-fill="#f5f5f6"></div>
    </div>';
if($sred!=0) {
/*
if($procc<100) {
    echo '<strong >~<b>' . $eshe_nado . ' ' . PadejNumber($eshe_nado, 'тур,тура,туров') . '</b> еще <br> необходимо продать </strong >';
} else
{
*/
    //отстаем от прошлого месяца на 12 туров

      $trip_prev_mon=0;
  $date_start=date_step_sql('Y-m-', '-1m').'01';
  $date_end=date_step(date('Y-m-d'),'-1m');

      $result_uurr = mysql_time_query($link, 'select count(id) as ss from trips where visible=1 and id_a_company="'.ht($id_company).'" and datecreate>="'.$date_start.'" and datecreate<"'.$date_end.'"');
      $num_results_uurr = $result_uurr->num_rows;
$views=0;
      if ($num_results_uurr != 0) {
          $row_uurr = mysqli_fetch_assoc($result_uurr);
          $trip_prev_mon=$row_uurr["ss"];
}
            $trip_mon=0;
  $date_start=date('Y-m-').'01';
  $date_end=date('Y-m-d');

      $result_uurr = mysql_time_query($link, 'select count(id) as ss from trips where visible=1 and id_a_company="'.ht($id_company).'" and datecreate>="'.$date_start.'" and datecreate<"'.$date_end.'"');
      $num_results_uurr = $result_uurr->num_rows;
$views=0;
      if ($num_results_uurr != 0) {
          $row_uurr = mysqli_fetch_assoc($result_uurr);
          $trip_mon=$row_uurr["ss"];
}

      $raz_count_trips=abs($trip_mon-$trip_prev_mon);
      $text_stat='отстаем от прошлого месяца на<br>';
      if($trip_mon>$trip_prev_mon)
      {
          $text_stat='превышаем прошлый месяца на<br>';
      }

    echo '<strong >'.$text_stat.'<b>' . $raz_count_trips . ' ' . PadejNumber($raz_count_trips, 'тур,тура,туров') . '</b> </strong >';
//}


    } else
{
    echo'<strong > выполнения из <br> запланированного плана. </strong >';
}

echo'</div>';
?>		
				
</div>

    <?


    //За последние 2 недели по фирме
    //пусть изучают что сейчас популярно и продают

    $date_sql_start = date_step_sql('Y-m-d', '-14d') . ' 00:00:00';
    $date_sql_end = date_step_sql('Y-m-d', '+1') . ' 00:00:00';

    $sql_user_buy = " and A.datecreate>'" . $date_sql_start . "' and A.datecreate<'" . $date_sql_end . "'";

    $result_uuh = mysql_time_query($link, 'select Z.* from (select DISTINCT A.id,A.comment,A.id_user,A.id_country,A.place_name,A.hotel from trips as A where A.id_a_company="'.ht($id_company).'" '.$sql_user_buy.') Z order by rand() limit 6');
    $num_results_uuh = $result_uuh->num_rows;


    if ($result_uuh) {

        echo'<strong class="str_f">Сейчас покупают</strong><div class="oka_fact chat-index buy-nay-index">';

        $i = 0;
        while ($row_uuh = mysqli_fetch_assoc($result_uuh)) {

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



            echo'<div class="gr-51"><div class="one-chat1"><i></i></div><div  class="two-chat1">'.$kuda_trips.'<div ><span class="name-chat">на '.$kogda_l.'</span></div></div></div>';

        }
        echo'</div>';
    }



    //За последний месяц по фирме по всем работникам
    //пусть изучают что люди пишут и что они сами пишут
    $result_uuh = mysql_time_query($link, 'select Z.* from (select DISTINCT A.id,A.comment,A.id_user,A.id_country,A.place_name,A.hotel from trips as A,trips_status_history_new as B where B.id_trips=A.id and A.id_a_company="'.ht($id_company).'" and B.action_history="2" and not(A.comment="") order by B.datetimes desc limit 30) Z order by rand() limit 2');
    $num_results_uuh = $result_uuh->num_rows;


    if ($result_uuh) {

        echo'<strong class="str_f">Последние впечатления по турам</strong><div class="oka_fact chat-index">';

        $i = 0;
        while ($row_uuh = mysqli_fetch_assoc($result_uuh)) {

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


            $result_uur = mysql_time_query($link, 'select name_user from r_user where id="' . ht($row_uuh['id_user']) . '"');
            $num_results_uur = $result_uur->num_rows;

            if ($num_results_uur != 0) {
                $row_uur = mysqli_fetch_assoc($result_uur);
            }

            echo'<div class="gr-50"><div class="one-chat"><i></i></div><div  class="two-chat">'.$row_uuh["comment"].'<div style="margin-top: 10px;"><span class="name-chat">'.$kuda_trips.' ('.$row_uur["name_user"].')</span></div></div></div>';

        }
        echo'</div>';
    }








    ?>







<?

//сегодня задачи и напоминания
$max_day_ring=3;
		
//общие задачи, личные задачи невыполненные		
$p=0;
		$date_end_plus3=date_step_sql('Y-m-d','+'.$p.'d');
		$result_8 = mysql_time_query($link,'
select * from( 
(
select A.*,0 as flag from  task_new as A WHERE A.id_user_responsible="'.ht($id_user).'" and A.visible=1 and A.id_a_company="'.ht($id_company).'" and A.reminder=0 and A.status=0 and  LOWER(A.ring_datetime)<"'.date("Y-m-d").' 00:00:00"
)
UNION
(
select A.*,1 as flag from  task_new as A WHERE A.id_user_responsible LIKE "'.$id_user.',%" and A.visible=1 and A.id_a_company="'.ht($id_company).'" and A.reminder=0 and A.status=0 and  LOWER(A.ring_datetime)<"'.date("Y-m-d").' 00:00:00"
)
UNION
(
select A.*,1 as flag from  task_new as A WHERE A.id_user_responsible LIKE "%,'.$id_user.',%" and A.visible=1 and A.id_a_company="'.ht($id_company).'" and A.reminder=0 and A.status=0 and  LOWER(A.ring_datetime)<"'.date("Y-m-d").' 00:00:00"
)
UNION
(
select A.*,1 as flag from  task_new as A WHERE A.id_user_responsible LIKE "%,'.$id_user.'" and A.visible=1 and A.id_a_company="'.ht($id_company).'" and A.reminder=0 and A.status=0 and LOWER(A.ring_datetime)<"'.date("Y-m-d").' 00:00:00"
)


) Z order by Z.ring_datetime desc 

');
	

	
$num_8 = $result_8->num_rows;	
$pros=1;	
if($num_8>0)
{
echo'<div class="ring_block ring-block-line js-ring-3">';	
} else
{
echo'<div style="display:none;" class="ring_block ring-block-line js-ring-3">';	
}
	echo'<div class="h1-ring"><span>Просроченные задачи</span><i></i></div>'; 
	if(($num_8-$max_day_ring)>0)
	{
	echo'<div max="'.$max_day_ring.'" class="eshe-ring js-eshe-ring"><span class="ring-x1">еще '.($num_8-$max_day_ring).'</span><span class="ring-x2">Скрыть</span></div>';
	} else
	{
	echo'<div style="display:none;" max="'.$max_day_ring.'" class="eshe-ring js-eshe-ring"><span class="ring-x1">еще '.($num_8-$max_day_ring).'</span><span class="ring-x2">Скрыть</span></div>';		
	}
	
	echo'<div class="block-ring-x">';
	if(($result_8)and($num_8>0))
{
	$count_ring=0;
	 $class_ring='';
  	 while($row_8 = mysqli_fetch_assoc($result_8)){
				 if($count_ring>=$max_day_ring)
				 {
				  $class_ring='max-day-ring';
				 }

	include $url_system.'task/code/block_index.php';
		 echo($task_cloud_block);
	
	
	
}
	}
echo'</div>';
echo'</div>';	
	
	
	
?>
	
	
	
</div>
<?
	//галерея задач на день

	if($flag_est_task!=0)
	{	
		echo'<div class="oka2 task-right js-task-cloud" style="padding: 30px;">';
	} else
	{
		echo'<div class="oka2 task-right js-task-cloud" style="padding: 30px; display:none;">';
	}
	?>

	

<?

		echo $task_cloud;
	


		
?>		
	
	
</div>
</div>
 </div>
 <div class="section" id="section1">
 <div class="oka_block_1">
<div class="oka1_1">
<div class="okss">
<?
	
//если я директор или главный директор то показывать всем кто мне подчиняется

//если это обычный менеджер то только свои
//если это главный менеджер то кто ему подчиняется

if(($role->permission('Туры','R'))or($sign_admin==1))
{

if($sign_admin==1)
{
    //админ системы
    $sql_su5_search='';

} else
{
   if($sign_level>=3)
   {
       //если это главный менеджер то кто ему подчиняется
       // главный директор



   } else
   {
       //если это обычный менеджер то только свои
       $sql_su5_search=' and A.id_user="'.$id_user.'" ';
   }
}
$sql_order = ' order by A.datecreate DESC';
 $sql_su7 = ' AND A.id_a_company="' . $id_company . '" ';
$sql_k = 'Select 
  
  DISTINCT A.id
  
  from trips as A
  
  where A.visible=1 ' . $sql_su5_search . ' ' . $sql_su7 . ' ' . $sql_order . ' limit 0,10';

$result_t2 = mysql_time_query($link, $sql_k);


$num_results_t2 = $result_t2->num_rows;
if($num_results_t2!=0) {

    $com = 0;
    $cost = 0;
    $count_y = 0;
    $new_class_block = '';
    echo'<span class="title_book"><i>'.$num_results_t2.'</i>'.PadejNumber($num_results_t2,'последний тур,последних тура,последних туров').'</span></div>';

    for ($ksss=0; $ksss<$num_results_t2; $ksss++)
    {

        $row_88= mysqli_fetch_assoc($result_t2);

        $result_uuy = mysql_time_query($link, 'select A.id,A.discount,A.doc, A.id_user,A.shopper,A.id_shopper,A.id_contract,A.comment,A.number_to,A.hotel,A.id_country,A.place_name,A.date_start,A.date_end,A.number_to,A.id_contract,A.cost_client,A.id_exchange,A.cost_operator_exchange,A.cost_operator,A.cost_client_exchange,A.buy_clients,A.buy_operator,A.paid_operator,A.paid_operator_rates,A.exchange_rates,A.paid_client,A.paid_client_rates,A.date_prepaid,A.comment,A.status_admin from trips as A where A.id="' . ht($row_88['id']) . '"');
        $num_results_uuy = $result_uuy->num_rows;

        if ($num_results_uuy != 0) {
            $row_8 = mysqli_fetch_assoc($result_uuy);
        }



        include $url_system.'tours/code/block_tours.php';
        echo($task_cloud_block);

    }

}

}

	
?>
<div class="mobile-bottom-ot"></div>

</div>
 </div>
 </div>
</div></div></div><?
include_once $url_system.'template/left.php';
?>
</div></div><!--<script src="Js/rem.js" type="text/javascript"></script>--><div id="nprogress"><div class="bar" role="bar" ><div class="peg"></div></div></div>

</body></html>
<script type="text/javascript">
 $(document).ready(function(){ 
$('.circlestat').circliful();	
 });
	$(document).ready(function() {
	/*$('#fullpage').fullpage({
		//options here
		scrollOverflow:true
	});*/


});
</script>

