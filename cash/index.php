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



$active_menu='cash';  // в каком меню


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

if((!$role->permission('Касса','R'))and($sign_admin!=1))
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

if($error_header!=404){ SEO('cash','','','',$link); } else { SEO('0','','','',$link); }

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

	  include_once $url_system.'template/top_cash.php';


     echo'<div id="fullpage" class="margin_60" id_content="'.$id_user.'">';

	?>
 <div class="section" id="section1">

	 
 <div class="oka_block">


     <div class="oka1" style="width:100%;">
         <div class="cash-content">


         <div class="cash-money ">

<?
            echo'<div class="h1-fin">Наличные офис</div>



             <div class="money-summ money-cash-rub"><span style="color: #fff;" data-duration="3000" class="js-animate-number" old_number="0">'.$row_uu['cash_spot'].'</span></div>';

                 ?>
             <div class="fin-na-100">
                 <div class="fin-50">
                     <label>Приход</label>
                     <?
                     $result_plus = mysql_time_query($link, 'select sum(C.summ) as simm from cash_operation as C where C.id_office="'.ht($su_5).'" and C.id_where=1 and C.date LIKE "'.date('Y-m-d').' %"');
                     $num_results_plus = $result_plus->num_rows;
                     $miin=0;
                     if ($num_results_plus != 0) {
                         $row_plus = mysqli_fetch_assoc($result_plus);
                         if($row_plus["simm"]!='')
                         {
                             $miin=$row_plus["simm"];
                         }
                     }

                     echo'<span class="cost_circle"><i class="grennvod"></i><div>+&nbsp;<span data-duration="3000" class="js-animate-number js-number-plus" old_number="0">'.$miin.'</span></div></span>';

                     ?>
                 </div>
                 <div class="fin-50">
                     <label>Расход</label>
                     <?
                     $result_plus1 = mysql_time_query($link, 'select sum(C.summ) as simm from cash_operation as C where C.id_office="'.ht($su_5).'" and C.id_from=1 and C.date LIKE "'.date('Y-m-d').' %"');


                     $num_results_plus1 = $result_plus1->num_rows;

                     $miin=0;
                     if ($num_results_plus1 != 0) {

                         $row_plus1 = mysqli_fetch_assoc($result_plus1);
                         if($row_plus1["simm"]!='')
                         {
                             $miin=$row_plus1["simm"];
                         }
                     }


                     echo'<span class="cost_circle"><i ></i><div>-&nbsp;<span data-duration="3000" class="js-animate-number js-number-minus" old_number="0">'.$miin.'</span></div></span>';

                     ?>
                 </div>
             </div>

             <div style="margin-top: 15px;" class="js-kuda-dd">

                 <?
                 $echo_tt='~';
                 $date_start='';
                 $name_start='';
                 $toolt_xx='';
                 $result_cl = mysql_time_query($link, 'select * from cash_close_shift where id_office="' . ht($su_5) . '" order by date_close desc limit 1');
                 $num_results_cl = $result_cl->num_rows;

                 if ($num_results_cl != 0) {
                     $row_cl = mysqli_fetch_assoc($result_cl);

                     $date_massx = explode(" ", ht($row_cl['date_close']));
                     $date_mass = explode("-", ht($date_massx[0]));
                     $date_start = $date_mass[2] . '.' . $date_mass[1] . '.' . $date_mass[0];

                     $toolt_xx='подтвержденная сумма - '.$row_cl["summ"].' ₽';

                     $result_uuy=mysql_time_query($link,'select name_user from r_user where id="'.ht($row_cl["id_user"]).'"');
                     $num_results_uuy = $result_uuy->num_rows;

                     if($num_results_uuy!=0) {
                         $row_uuy = mysqli_fetch_assoc($result_uuy);
                         $name_start=$row_uuy["name_user"];
                     }


                     $echo_tt = $date_start.' - '.$name_start;

                 }

                 echo'<div class="sdat-cash">Последняя закрытая смена <span data-tooltip="'.$toolt_xx.'">('.$echo_tt.')</span> </div>';
                 ?>



                 <div class="close-cash-day js-close-cash-day" style="background-color: #fd8080 !important; margin-right:5px;">Закрыть смену</div>


<?
                 if(($role->permission('Касса','S'))or($sign_admin==1)) {
echo'<div class="js-kuda-dd1">';


                     $echo_tt = '~';
                     $date_start = '';
                     $name_start = '';
                     $toolt_xx = '';
                     $result_cl = mysql_time_query($link, 'select * from cash_spot_history where id_office="' . ht($su_5) . '" and check_global=1 order by date desc limit 1');
                     $num_results_cl = $result_cl->num_rows;

                     if ($num_results_cl != 0) {
                         $row_cl = mysqli_fetch_assoc($result_cl);

                         $date_massx = explode(" ", ht($row_cl['date']));
                         $date_mass = explode("-", ht($date_massx[0]));
                         $date_start = $date_mass[2] . '.' . $date_mass[1] . '.' . $date_mass[0];

                         $toolt_xx = 'подтвержденная сумма - ' . $row_cl["summ"] . ' ₽';

                         $result_uuy = mysql_time_query($link, 'select name_user from r_user where id="' . ht($row_cl["check_user"]) . '"');
                         $num_results_uuy = $result_uuy->num_rows;

                         if ($num_results_uuy != 0) {
                             $row_uuy = mysqli_fetch_assoc($result_uuy);
                             $name_start = $row_uuy["name_user"];
                         }


                         $echo_tt = $date_start . ' - ' . $name_start;

                     }

                     echo '<div class="sdat-cash1">Последняя проверка <span data-tooltip="' . $toolt_xx . '">(' . $echo_tt . ')</span> </div>';


                     echo'<div class="close-cash-day js-yes-cash-time" style = "background-color: #35deb8 !important; margin-right:5px;" > Проверено</div>';

echo'</div>';
                 }
                 ?>

             </div>
         </div><div class="cash-plus">
                 <?
                 $where_global=' where global=0';
                 if(($sign_level>=3)or($sign_admin==1))
                 {
                     $where_global='';
                 }

                 $result_uu_te = mysql_time_query($link, 'select * from cash_operation_template '.$where_global);

                 if ($result_uu_te) {
                     $i = 0;
                     while ($row_uu_te = mysqli_fetch_assoc($result_uu_te)) {

                         echo'<div temp="'.$row_uu_te["id"].'" class="buy-cash-22 js-add-cash">'.$row_uu_te["title"].'</div>';
                     }
                 }
                 /*
<div temp="1" class="buy-cash-22 js-add-cash">от клиента → наличные</div>
                 <div temp="2" class="buy-cash-22 js-add-cash">наличные → на р/с</div>
                 <div temp="3" class="buy-cash-22 js-add-cash">наличные → сбербанк онлайн</div>
                 <div temp="4" class="buy-cash-22 js-add-cash">наличные → за услугу</div>
*/
                 ?>


             </div>
     </div>


<?
//операции по кассе
         $result_uu = mysql_time_query($link, 'select C.*  from cash_operation as C where C.id_office="'.ht($su_5).'" and C.date LIKE "'.date('Y-m-d').' %" order by C.date desc');

         $num_results_uu = $result_uu->num_rows;

         if ($result_uu) {
         $i = 0;
         //echo('<div class="px_bg_trips" style="display: block;">');
             $query_string='';
             while ($row_uu = mysqli_fetch_assoc($result_uu)) {
             //echo("!");
             $edit_moo=1;
             include $url_system.'cash/code/block_buy.php';


             }

             }
             if($num_results_uu!=0) {
             echo '<div class="px_bg_fin js-cash-cloud js-oper-0" style="display: block; margin-top:20px;"><div class="h1-finx">Операции по кассе (сегодня)<span class="menu-09-count-fin">' . $num_results_uu . '</span></div>' . $query_string . '</div>';
             } else
             {
             echo '<div class="px_bg_fin js-cash-cloud js-oper-0" style="display: none; margin-top:20px;"><div class="h1-finx">Операции по кассе (сегодня)<span class="menu-09-count-fin">0</span></div></div>';
             }

if (($role->permission('Касса', 'S')) or ($sign_admin == 1)) {
    echo '<a href="cash/all/" class="cash-all-operation-search">↓ Все операции</a>';
}

        ?>


     </div>




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
     number_animate();
 });
</script>



</body></html>

