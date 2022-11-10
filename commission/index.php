<?
session_start();
$url_system=$_SERVER['DOCUMENT_ROOT'].'/'; include_once $url_system.'module/config.php'; include_once $url_system.'module/function.php'; include_once $url_system.'login/function_users.php'; initiate($link); include_once $url_system.'module/access.php';

$active_menu='commission';  // в каком меню

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

if((!$role->permission('Комиссии','R'))and($sign_admin!=1))
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

if($error_header!=404){ SEO('commission','','','',$link); } else { SEO('0','','','',$link); }

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

	  include_once $url_system.'template/top_commission.php';


     echo'<div id="fullpage" class="margin_60" id_content="'.$id_user.'">';

	?>
 <div class="section" id="section1">
     <div class="oka_block">
         <div class="oka1 oka-newx" style="width:100%;">







  <div class="liderbord_2021">
        <span class="title">Текущие комиссии</span>
        <div class="lider-box lider_header">
            <div class="lider-date">Дата</div>
            <div class="lider-country">Страна</div>
            <div class="lider-comm">Комиссия</div>
            <div class="lider-promo">Промокод</div>
            <div class="lider-status">Статус</div>
        </div>


        <?

        $result_te = mysql_time_query($link, 'select *,c.name,b.id_promo,b.id as id_tripss from affiliates_history_trips as a,trips as b,trips_country as c where a.id_trips=b.id and b.id_country=c.id and a.id_users="' . ht($id_user) . '" order by a.datetimes desc');

        if ($result_te) {

            $i = 0;
            while ($row_te = mysqli_fetch_assoc($result_te)) {
$status_a='Блок';
if($row_te["block"]==0)
{
    $status_a='Доступна';
}

$promo='—';
    $promo_tooltip='';
if($row_te["id_promo"]!=0)
{
    $result_ty = mysql_time_query($link, 'select * from affiliates_promo_code where id="' . ht($row_te["id_promo"]) . '"');
    $num_results_ty = $result_ty->num_rows;

    if ($num_results_ty != 0) {
        $row_ty = mysqli_fetch_assoc($result_ty);
        $promo=$row_ty["name"];
        $promo_tooltip='data-tooltip="ПРОМОКОД - '.$row_ty["bonus"].'"';
    }
}


echo'        <div class="lider-box lider_more">
            <div class="lider-date"><span class="aff_mo">Дата</span>'.time_stamp_mess($row_te["datetimes"]).'</div>
            <div class="lider-country"><span class="aff_mo">Страна</span>'.$row_te["name"].' <i class="i-com-partnership">('.$row_te["id_tripss"].')</i></div>
            <div class="lider-comm"><span>+'.rtrim(rtrim(number_format(($row_te["comission"]), 2, '.', ' '),'0'),'.').' RUB</span><div>'.$row_te["proc"].'%</div></div>
            <div class="lider-promo">';
if($promo!='—') {
    echo'<span class="pro-promo" '.$promo_tooltip.' > '.$promo.'</span>';
} else
{
    echo($promo);
}
echo'</div>
            <div class="lider-status"><span class="aff_mo">Статус</span>'.$status_a.'</div>
        </div>';

            }
        }

        ?>




         </div>
<?


	  
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