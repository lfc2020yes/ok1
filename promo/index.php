<?
session_start();
$url_system=$_SERVER['DOCUMENT_ROOT'].'/'; include_once $url_system.'module/config.php'; include_once $url_system.'module/function.php'; include_once $url_system.'login/function_users.php'; initiate($link); include_once $url_system.'module/access.php';

$active_menu='promo';  // в каком меню

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

if((!$role->permission('Промокоды','R'))and($sign_admin!=1))
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

if($error_header!=404){ SEO('promo','','','',$link); } else { SEO('0','','','',$link); }

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

	  include_once $url_system.'template/top_promo.php';


     echo'<div id="fullpage" class="margin_60" id_content="'.$id_user.'">';

	?>
 <div class="section" id="section1">
     <div class="oka_block">
         <div class="oka1 oka-newx" style="width:100%;">




<?
if($id_role==7)
{

             $result_de = mysql_time_query($link, 'select * from affiliates_promo_code where id_users="' . ht($id_user) . '" and visible=1  order by date_create desc');
             $num_results_de = $result_de->num_rows;



             ?>


             <div class="liderbord_2020">

                 <span class="title">Ваши промокоды</span>

                 <div class="leaderbord-promo">

                     <?
                     if ($result_de) {
                         while ($row_de = mysqli_fetch_assoc($result_de)) {

                             $date_mass = explode(" ", ht($row_de['date_end']));
                             $date_mass1 = explode("-", ht($date_mass[0]));
                             $date_start = $date_mass1[2] . '.' . $date_mass1[1] . '.' . $date_mass1[0];


                             $d_day=dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_de['date_end']);
$class_promo='';
            $status='Действует';

                             $class_ppr='';
                             if(($d_day>0)and($row_de['status']==2))
                             {
                                 $class_promo='red-promo';
                                 $class_ppr='red-ppr';
                                 $status='Акция завершена';
                             }

                             if($row_de['status']==0)
                             {
                                 $status='Сохранен';
                             }
                             if($row_de['status']==1)
                             {
                                 $status='На согласовании';
                                 $class_promo='yellow-promo';
                             }
                             if($row_de['status']==3)
                             {
                                 $status='Отклонен';
                                 $class_promo='red-promo';
                             }


                             echo '<div class="promo-block" promo="'.$row_de['id'].'">';
                             if($row_de['status']==1) {
                                 echo '<div data-tooltip="удалить" class="dell-promo js-dell-promo"></div>';
                             }
                             echo '<div class="promo-white '.$class_ppr.'">



                    <div class="promo-60">
                        <div class="title-60"><span class="'.$class_promo.'"></span> <div>'.$status.'</div></div>
                        <div class="promo-img"><div class="title-p">' . $row_de["name"] . '</div></div>
                    </div>
                    <div class="promo-40">
                        <span>' . $row_de["bonus"] . '</span>
                        <div class="promo-d">Действует до ' . $date_start . '</div>

                        <div class="rating-ship-x">';

                             $count_promi = 0;
                             $result_uuvv = mysql_time_query($link, 'select count(id) as cc from trips where id_promo="' . ht($row_de["id"]) . '"');
                             $num_results_uuvv = $result_uuvv->num_rows;

                             if ($num_results_uuvv != 0) {
                                 $row_uuvv = mysqli_fetch_assoc($result_uuvv);
                                 if ($row_uuvv["cc"] != '') {
                                     $count_promi = $row_uuvv["cc"];
                                 }
                             }

                             echo '<span class="name-border">Использовали</span><div><span class="cost_border ">' . $count_promi . '</span></div>

                        </div>


                    </div>

                </div>
            </div>';

                         }
                     }
                     ?>
                     <div class="promo-block">
                         <div class="promo-white promo-pp">
                             <?
                             if (($role->permission('Промокоды','A'))or($sign_admin==1))
                             {
                                 echo'<div data-tooltip="Добавить промокод" class="promo_plus js-add-promocod"></div>';
                             }
                             ?>



                         </div>
                     </div>


                 </div>




             </div>

             <?
} else
{
    //вывод для руководителей

$all=0;
    $result_uu_all = mysql_time_query($link, 'select count(id) as cc from affiliates_promo_code where visible="1"');
    $num_results_uu_all  = $result_uu_all ->num_rows;

    if ($num_results_uu_all  != 0) {
        $row_uu_all  = mysqli_fetch_assoc($result_uu_all );
        if($row_uu_all["cc"]!='')
        {
            $all=$row_uu_all["cc"];
        }
    }
    $active_p=0;
    $result_uu_all = mysql_time_query($link, 'select count(id) as cc from affiliates_promo_code where visible="1" and status=2 and date_end>"'.date('Y-m-d H:i:s').'"');
    $num_results_uu_all  = $result_uu_all ->num_rows;

    if ($num_results_uu_all  != 0) {
        $row_uu_all  = mysqli_fetch_assoc($result_uu_all );
        if($row_uu_all["cc"]!='')
        {
            $active_p=$row_uu_all["cc"];
        }
    }


    $dox=0;
    $result_uu_all = mysql_time_query($link, 'select sum(commission) as cc from trips where visible="1" and status=1 and buy_clients=1 and buy_operator=1 and (not(id_promo=0) or not(id_affiliates=0))');
    $num_results_uu_all  = $result_uu_all ->num_rows;

    if ($num_results_uu_all  != 0) {
        $row_uu_all  = mysqli_fetch_assoc($result_uu_all );
        if($row_uu_all["cc"]!='')
        {
            $dox=$row_uu_all["cc"];
        }
    }



    echo'<div class="bord-promo">

<div class="block-ppi"><div class="rating-ship"><span class="name-border">Кол-во промокодов</span><div><span class="cost_border ">'.$all.'</span></div></div></div>

        <div class="block-ppi"><div class="rating-ship"><span class="name-border">Действующих промокодов</span><div><span class="cost_border ">'.$active_p.'</span></div></div></div>

        <div class="block-ppi"><div class="rating-ship"><span class="name-border">Доход с промокодов</span><div><span class="cost_border leaderborder-rub">'.rtrim(rtrim(number_format(($dox), 2, '.', ' '),'0'),'.').'</span></div></div></div>

    </div>';
?>


    <div class="liderbord_2023">
        <span class="title">Все промокоды</span>
        <div class="lider-box lider_header">
            <div class="lider-date">Название</div>
            <div class="lider-country">Партнер</div>
            <div class="lider-comm">Комментарий</div>
            <div class="lider-promo">Время действия</div>
            <div class="lider-status">Статус</div>
        </div>


        <?

        $result_te = mysql_time_query($link, 'select a.*,b.
name_user  from affiliates_promo_code as a,r_user as b where a.id_users=b.id and a.visible=1 and not(a.status="0") order by a.date_create desc');

        if ($result_te) {

            $i = 0;
            while ($row_te = mysqli_fetch_assoc($result_te)) {

                $class_party='';
                if(($row_te["status"]==3))
                {
                    $class_party='red-party';
                }
                $date_mass = explode(" ", ht($row_te['date_end']));
                $date_mass1 = explode("-", ht($date_mass[0]));
                $date_start = $date_mass1[2] . '.' . $date_mass1[1] . '.' . $date_mass1[0];

$class_jj='';
                $d_day=dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_te['date_end']);
                if($d_day>0)
                {
                    $class_jj='red-jj';
                }

echo'        <div class="lider-box js-promo-list lider_more '.$class_party.'" promo="'.$row_te["id"].'">
            <div class="lider-date"><span class="pro-promo">'.$row_te["name"].'</span></div>
            <div class="lider-country"><span class="aff_mo">Партнер</span>'.$row_te["name_user"].'<i>'.time_stamp_mess($row_te["date_create"]).'</i></div>
            <div class="lider-comm"><span class="aff_mo">Комментарий</span>';

                if($row_te["comment"]!='') {
                    echo($row_te["comment"]);
                } else
                {
                    echo('—');
                }

echo'</div>
            <div class="lider-promo"><span class="aff_mo">Действует</span><span class="'.$class_jj.'">до '.$date_start.'</span>';

echo'</div>
            <div class="lider-status">';


                if($row_te["status"]==1)
                {
                    echo'<div id-bdata="'.$row_te["id"].'"  class="sogl-promo js-sogl-block"><i>Согласовать</i></div>';
                }

                if($row_te["status"]==3)
                {
                   // echo'<div id-bdata="'.$row_te["id"].'"  class="sogl-promo js-sogl-block"><i>Согласовать</i></div>';

                    echo('Отклонен');
                }

                if($row_te["status"]==2)
                {
                    // echo'<div id-bdata="'.$row_te["id"].'"  class="sogl-promo js-sogl-block"><i>Согласовать</i></div>';

                    echo('Согласован');
                }


                echo'</div>';
                echo'</div>';
            }
        }

        ?>




         </div>




<?





         }

       
        


	
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