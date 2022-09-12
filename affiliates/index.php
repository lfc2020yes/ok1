<?
session_start();
$url_system=$_SERVER['DOCUMENT_ROOT'].'/'; include_once $url_system.'module/config.php'; include_once $url_system.'module/function.php'; include_once $url_system.'login/function_users.php'; initiate($link); include_once $url_system.'module/access.php';

$active_menu='affiliates';  // в каком меню

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


		
$count_write=1000;  //количество выводимых записей на одной странице
		


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

if((!$role->permission('Партнеры','R'))and($sign_admin!=1))
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

if($error_header!=404){ SEO('affiliates','','','',$link); } else { SEO('0','','','',$link); }

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



//сообщения после добавление редактирования чего то
//сообщения после добавление редактирования чего то
//сообщения после добавление редактирования чего то

$echo_help=0;
if (( isset($_GET["a"]))and($_GET["a"]=='yes'))
{
echo'<script type="text/javascript">
        $(function (){
            alert_message(\'ok\',\'Данные по партнеру изменены\');
            });
</script>';

    $echo_help++;
}
if (( isset($_GET["a"]))and($_GET["a"]=='add'))
{
    echo'<script type="text/javascript">
        $(function (){
            alert_message(\'ok\',\'Новый партнер добавлен\');
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

	  include_once $url_system.'template/top_affiliates.php';


     echo'<div id="fullpage" class="margin_60" id_content="'.$id_user.'">';

	?>
 <div class="section" id="section1">
     <div class="oka_block">
         <div class="oka1 oka-newx" style="width:100%;">
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
	  $sql_su1=' order by b.name_user';
	  //$sql_su1_=' order by a.date_create desc';
 		
	  
	  $sql_su2='';
	  $sql_su2_='';
 	
			
				  
	  //echo("!".$sql_su2);
	  
	  $sql_su3='';
	  $sql_su3_='';
 		 


	  $sql_su4='';
	  $sql_su4_='';


  $mass_ei=users_hierarchy_plus_disabled($id_user,$link);
  rm_from_array($id_user,$mass_ei);
  $mass_ei= array_unique($mass_ei);


  $result_t2=mysql_time_query($link,'Select 
  
  DISTINCT b.*
  
  from r_user as b where b.id_role="7" and  b.id_company IN ('.$id_company.')
  
  '.$sql_su1.' '.limitPage('n_st',$count_write));

				
	  
  $sql_count='Select 
  
  count(b.id) as kol
  
  from r_user as b where b.id_role="7" and b.id_company IN ('.$id_company.')';
			

$result_t221=mysql_time_query($link,$sql_count);	  
$row__221= mysqli_fetch_assoc($result_t221);	  

//echo' <h3 class="head_h" style=" margin-bottom:0px;">Cнабжение<i>'.$row__221["kol"].'</i><div></div></h3> ';	
	

echo'<div class="okss"><span class="title_book yop_booking"><i class="smena_">'.$row__221["kol"].'</i><span class="smena_1">'.PadejNumber($row__221["kol"],'Партнер,Партнера,Партнеров').'</span></span></div>';
	
	  
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
               $class_party='';
               if(($row_8["enabled"]==0))
               {
                   $class_party='red-party';
               }

               echo'<div class="users_block users_block_2020 affiliates_block '.$class_party.'" op_rel="'.$row_8["id"].'">';
						 
echo'<div class="users-b-number">'.$row_8["id"].'</div>';

               $online='<div class="no_online s-'.$row_8["id"].'-party"></div>';
               if(online_user($row_8["timelast"],$row_8["id"],0)) { $online='<div class="online s-'.$row_8["id"].'-party"></div>';}

echo'<div class="name-user-57"><a href="affiliates/'.$row_8["id"].'/" class="h57-2020"><span>'.$row_8["name_user"].'</span>'.$online.'';

               $result_txs=mysql_time_query($link,'Select a.name_role from r_role as a where a.id="'.htmlspecialchars(trim($row_8["id_role"])).'"');

               if($result_txs->num_rows!=0)
               {
                   //такая работа есть
                   $rowxs = mysqli_fetch_assoc($result_txs);
                   $online='';
               }
               $kogda='';
if($row_8["timelast"]!='')
    {
        $kogda=time_stamp(date('Y-m-d H:i:s',$row_8["timelast"]));
    }


               echo'</a><div class="tender-status">'.$rowxs["name_role"].'</div>

<div class="tender-status">'.$kogda.'</div>';


               if($more_city==1)
               {
                   //выводить к какой организации относится тур
                   $exp_org = explode(",", ht($row_8["id_company"]));

                   for ($io = 0; $io < count($exp_org); $io++) {


                   $result_cop = mysql_time_query($link, 'select * from a_company where id="'.ht($exp_org[$io]).'"');
                   $num_results_cop = $result_cop->num_rows;

                   if ($num_results_cop != 0) {
                       $row_cop = mysqli_fetch_assoc($result_cop);
                       if($io!=0)
                           {
                               echo', ';
                           }

                       echo' <div class="city_dop_viv">'.$row_cop["name"].'</div>';
                   }
}

               }


echo'</div>';
					
		$result_status22=mysql_time_query($link,'SELECT a.all_comission,a.paid_comission,a.block_comission FROM affiliates AS a WHERE a.id_users="'.htmlspecialchars(trim($row_8["id"])).'"');
                if($result_status22->num_rows!=0)
                {  
                   $row_status22 = mysqli_fetch_assoc($result_status22);
				}

               $result_status22=mysql_time_query($link,'SELECT count(a.id) as cc FROM k_clients AS a WHERE a.visible=1 and a.id_affiliates="'.htmlspecialchars(trim($row_8["id"])).'"');
               if($result_status22->num_rows!=0)
               {
                   $row_status23 = mysqli_fetch_assoc($result_status22);
               }

               echo'<div class="center-com-part"><div data-tooltip="Всего комиссия" class=" calc-balance cost_circle rate_yyy">'.number_format((((float)$row_status22["all_comission"]-(float)$row_status22["paid_comission"])), 2, '.', ' ').'</div><div class="cost_all_trips">к выплате<span style="" class="cost_circle rate_yyy cacl-rrate js-buy-affiliates k-vip-affiliates">'.number_format(((float)((float)$row_status22["all_comission"]-(float)$row_status22["paid_comission"]-(float)$row_status22["block_comission"])), 2, '.', ' ').'</span></div>
<div style="" class="cost_all_trips">скоро<span style="" class="cost_circle rate_yyy cacl-rrate">'.number_format(((float)((float)$row_status22["block_comission"])), 2, '.', ' ').'</span></div>
</div>';


              // echo'<div class="yop_count" data-tooltip="Кол-во туров"><i></i>'.$row_status22["cc"].'</div>';

               echo'<div class="yop_count yop_count_users" data-tooltip="Кол-во клиентов"><i></i>'.$row_status23["cc"].'</div>';

               $phone_format='';
               if($row_8["phone"]!='') {
                   $phone_format = phone_format($row_8["phone"]);
               }

echo'<div class="tender-date" data-tooltip="Телефон">'.$phone_format.'<span>'.$row_8["login"].'</span></div>';

               echo'<div class="tender-but">';
                if($row_8["enabled"]==1)
	  {
			   echo'<div id-bdata="'.$row_8["id"].'"  class="yes-tender party-options js-partner-block"><span>Заблокировать</span><i>Открыть доступ</i></div>';
			  } else
			  {
			   echo'<div id-bdata="'.$row_8["id"].'"  class="yes-tender party-options block-party js-partner-block"><span>Заблокировать</span><i>Открыть доступ</i></div>';
			  }

echo'</div>';
/*
if(($sign_admin==1)and($row_status22["cc"]==0))
{
echo'<div class="font-ranks del_users_" data-tooltip="Удалить" id_rel="'.$row_8["id"].'"><span class="font-ranks-inner">x</span></div>';
}	else
{
	echo'<div class="font-ranks"></div>';
}
	*/
echo'</div>';						 


								  
						 
					 }
 
					  

					  
					  
 } else
				  {



                      echo'<div class="help_div da_book1"><div class="not_boolingh"></div><span class="h5"><span>Партнеры не найдены.</span></span></div>';
					  
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