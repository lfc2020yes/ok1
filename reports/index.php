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



$active_menu='reports';  // в каком меню

		
$count_write=1000;  //количество выводимых записей на одной странице
		
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

if((!$role->permission('Отчеты','R'))and($sign_admin!=1))
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

if($error_header!=404){ SEO('reports','','','',$link); } else { SEO('0','','','',$link); }

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

	  include_once $url_system.'template/top_reports.php';


     echo'<div id="fullpage" id_content="'.$id_user.'">';

	?>
 <div class="section" id="section1">
 <div class="oka_block_1">
<div class="oka1_1">
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
	  $sql_su1=' order by b.datetimes desc';
	  //$sql_su1_=' order by a.date_create desc';
 		
	  
	  $sql_su2='';
	  $sql_su2_='';
 	
			
				  
	  //echo("!".$sql_su2);
	  
	  $sql_su3='';
	  $sql_su3_='';
 		 


	  $sql_su4='';
	  $sql_su4_='';
 		
			
  $result_t2=mysql_time_query($link,'Select 
  
  DISTINCT b.*
  
  from reports as b where b.visible=1 
  
  '.$sql_su1.' '.limitPage('n_st',$count_write));
	  
		
				
	  
  $sql_count='Select 
  
  count(DISTINCT a.id) as kol
  
  from reports as a where a.visible=1 
  
  '.$sql_su2_.' '.$sql_su3_.' '.$sql_su4_;
			

$result_t221=mysql_time_query($link,$sql_count);	  
$row__221= mysqli_fetch_assoc($result_t221);	  

//echo' <h3 class="head_h" style=" margin-bottom:0px;">Cнабжение<i>'.$row__221["kol"].'</i><div></div></h3> ';	
	

echo'<div class="okss"><span class="title_book yop_booking"><i class="smena_">'.$row__221["kol"].'</i><span class="smena_1">'.PadejNumber($row__221["kol"],'отчет,отчета,отчетов').'</span></span></div>';
	
	  
                  $num_results_t2 = $result_t2->num_rows;
	              if($num_results_t2!=0)
	              {
	
				$com=0;
			    $cost=0;
					  $count_y=0;

					  
					  ?>	
				  
					<?  
					  $copy=0;
	       for ($ksss=0; $ksss<$num_results_t2; $ksss++)
                     {

					$row_8= mysqli_fetch_assoc($result_t2);
	
			 

$cll='';
//забронировано						 


echo'<div class="reports_block" op_rel="'.$row_8["id"].'">';
						 
echo'<div class="open_operator"></div>';						 

echo'<div class="h57"><a href="reports/'.$row_8["id"].'/" class="h58"><span>'.$row_8["name"].'<div class="number_zayy">('.$row_8["id"].')</div>';

	

echo'</span>';

						 

						 
						 echo'</a>';	
if(($sign_admin==1))
{
echo'<div class="font-ranks del_reports_" data-tooltip="Удалить" id_rel="'.$row_8["id"].'"><span class="font-ranks-inner">x</span></div>';
} 	
echo'</div>';						 
echo'<div data-tooltip="Страна" class="login_o  btn">'.$row_8["country"].'</div>';						 
echo'<div data-tooltip="Дата поездки" class="login_o  btn">'.date_fik($row_8["date_"]).'</div>';							 
				 
		$result_txs=mysql_time_query($link,'Select a.id,a.name_user,a.timelast from r_user as a where a.id="'.htmlspecialchars(trim($row_8["id_user"])).'"');
      
	    if($result_txs->num_rows!=0)
	    {   
		//такая работа есть
		$rowxs = mysqli_fetch_assoc($result_txs);
											  $online='';	
				  if(online_user($rowxs["timelast"],$rowxs["id"],$id_user)) { $online='<div class="online"></div>';}		
		echo'<div class="yop_count1"><div  sm="'.$row_8["id_user"].'"   data-tooltip="'.$rowxs["name_user"].'" class="user_soz send_mess">'.$online.avatar_img('<img src="img/users/',$row_8["id_user"],'_100x100.jpg">').'</div></div>';
	    }									 
						 
						 
	
						


	echo'<div class="font-ranks"></div>';

						 						
echo'</div>';						 


								  
						 
					 }
 
					  

					  
					  
 } else
				  {
					  
echo'<div class="booking_div da_book1"><div class="not_booling"></div><span class="h4" style="width:calc(100% - 60px)"><span>Отчеты не найдены.</span></span></div>';
					  
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